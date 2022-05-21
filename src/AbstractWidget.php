<?php

declare(strict_types=1);

namespace Forge\Widget;

use ReflectionClass;
use ReflectionException;
use RuntimeException;

use function call_user_func_array;
use function get_class;

/**
 * Widget generates a string content based on some logic and input data.
 *
 * These are typically used in templates to conceal complex HTML rendering logic.
 *
 * This is the base class that is meant to be inherited when implementing your own widgets.
 */
abstract class AbstractWidget
{
    protected array $attributes = [];

    public function __construct()
    {
    }

    /**
     * Renders widget content.
     *
     * This method is used by {@see render()} and is meant to be overridden when implementing concrete widget.
     */
    abstract protected function run(): string;

    /**
     * The widgets that are currently opened and not yet closed.
     * This property is maintained by {@see begin()} and {@see end()} methods.
     *
     * @var static[]
     */
    private static array $stack = [];

    /**
     * The HTML attributes. The following special options are recognized.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static
     */
    public function attributes(array $values): static
    {
        $new = clone $this;
        $new->attributes = array_merge($this->attributes, $values);
        return $new;
    }

    /**
     * Used to open a wrapping widget (the one with begin/end).
     *
     * When implementing this method, don't forget to call parent::begin().
     *
     * @return string Opening part of widget markup.
     */
    public function begin(): string
    {
        self::$stack[] = $this;
        return '';
    }

    /**
     * Allows not to call `->render()` explicitly:
     *
     * ```php
     * <?= MyWidget::create(); ?>
     * ```
     */
    final public function __toString(): string
    {
        return $this->render();
    }

    /**
     * Creates a widget instance.
     *
     * @param string $loadConfigFile The file path to load configuration from (if any).
     * @param array $config The configuration array for factory.
     * @param array $constructorArguments The constructor arguments for the widget.
     *
     * @psalm-param array<int, mixed> $constructorArguments
     *
     * @throws ReflectionException
     *
     * @return static widget instance
     */
    final public static function create(
        string $loadConfigFile = '',
        array $config = [],
        array $constructorArguments = []
    ): static {
        $reflection = new ReflectionClass(static::class);
        $shortName = $reflection->getShortName();
        $widget = $reflection->newInstanceArgs($constructorArguments);
        /** @var static */
        return $widget->configure($widget, $config, $shortName, $loadConfigFile);
    }

    /**
     * Checks that the widget was opened with {@see begin()}. If so, runs it and returns content generated.
     *
     * @throws RuntimeException
     */
    final public static function end(): string
    {
        $class = static::class;

        if (self::$stack === []) {
            throw new RuntimeException("Unexpected $class::end() call. A matching begin() is not found.");
        }

        $widget = array_pop(self::$stack);
        $widgetClass = get_class($widget);

        if ($widgetClass !== static::class) {
            throw new RuntimeException("Expecting end() of $widgetClass found $class.");
        }

        return $widget->render();
    }

    /**
     * Executes the widget.
     *
     * @return string The result of widget execution to be outputted.
     */
    final public function render(): string
    {
        if (!$this->beforeRun()) {
            return '';
        }

        return $this->afterRun($this->run());
    }

    /**
     * This method is invoked right after a widget is executed.
     *
     * The return value of the method will be used as the widget return value.
     *
     * If you override this method, your code should look like the following:
     *
     * ```php
     * public function afterRun(string $result): string
     * {
     *     $result = parent::afterRun($result);
     *     // your custom code here
     *     return $result;
     * }
     * ```
     *
     * @param string $result The widget return result.
     *
     * @return string The processed widget result.
     */
    protected function afterRun(string $result): string
    {
        return $result;
    }

    /**
     * This method is invoked right before the widget is executed.
     *
     * The return value of the method will determine whether the widget should continue to run.
     *
     * When overriding this method, make sure you call the parent implementation like the following:
     *
     * ```php
     * public function beforeRun(): bool
     * {
     *     if (!parent::beforeRun()) {
     *         return false;
     *     }
     *
     *     // your custom code here
     *
     *     return true; // or false to not run the widget
     * }
     * ```
     *
     * @return bool Whether the widget should continue to be executed.
     */
    protected function beforeRun(): bool
    {
        return true;
    }

    /**
     * Configures a widget with the given configuration.
     *
     * @param object $widget The widget to be configured.
     * @param array $config The methods to be called.
     * @param string $shortName The short name widget.
     * @param string $loadConfigFile The file path to load configuration from (if any).
     *
     * @return object The widget itself.
     */
    private function configure(object $widget, array $config, string $shortName, string $loadConfigFile): object
    {
        /** @var string */
        $path = match (defined('WIDGET_CONFIG_FILE')) {
            true => WIDGET_CONFIG_FILE,
            false => $loadConfigFile,
        };

        if (is_file($path)) {
            /** @var mixed */
            $file = include $path;
            /** @var array */
            $definitions = isset($file[$shortName]) && is_array($file[$shortName]) ? $file[$shortName] : [];
            $widget = $this->factory($definitions, $widget);
        }

        return $this->factory($config, $widget);
    }

    private function factory(array $definitions, object $widget): object
    {
        /**
         * @var array<string, mixed> $definitions
         * @var mixed $arguments
         */
        foreach ($definitions as $action => $arguments) {
            if (str_ends_with($action, '()')) {
                /** @var mixed */
                $setter = call_user_func_array([$widget, substr($action, 0, -2)], $arguments);

                if ($setter instanceof $widget) {
                    /** @var object */
                    $widget = $setter;
                }
            }
        }

        return $widget;
    }
}
