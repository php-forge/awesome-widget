<?php


declare(strict_types=1);

namespace PHPForge\Widget;

use RuntimeException;

use function array_pop;
use function get_class;

/**
 * An abstract class that extends Base\Widget and implements BlockInterface.
 * It provides methods to manage and render widgets.
 */
abstract class Block extends Base\Widget implements BlockInterface
{
    /**
     * A flag to check if the begin method has been executed.
     */
    private bool $beginExecuted = false;

    /**
     * The widgets that are currently opened and not yet closed.
     * This property is maintained by {@see begin()} and {@see end()} methods.
     *
     * @psalm-var static[] $stack The widgets that are currently opened and not yet closed.
     */
    private static array $stack = [];

    /**
     * Begins the execution of a widget and adds it to the stack.
     *
     * @return string An empty string.
     */
    public function begin(): string
    {
        self::$stack[] = $this;
        $this->beginExecuted = true;

        return '';
    }

    /**
     * Ends the execution of a widget, removes it from the stack and renders it.
     *
     * @throws RuntimeException if a matching begin() is not found or if the end() of a different widget is found.
     *
     * @return string The rendered widget.
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
     * Checks if the begin method has been executed.
     *
     * @return bool True if the begin method has been executed, false otherwise.
     */
    public function isBeginExecuted(): bool
    {
        return $this->beginExecuted;
    }

    /**
     * Renders the widget if the beforeRun method returns true.
     *
     * @return string The rendered widget or an empty string if the beforeRun method returns false.
     */
    final public function render(): string
    {
        if (!$this->beforeRun()) {
            return '';
        }

        return $this->afterRun($this->run());
    }
}
