<?php

declare(strict_types=1);

namespace PHPForge\Widget\Factory;

use InvalidArgumentException;
use PHPForge\Widget\Base\Widget;
use ReflectionClass;
use ReflectionException;

use function call_user_func_array;
use function get_class;
use function sprintf;
use function str_ends_with;
use function substr;

/**
 * This class is responsible for creating a widget based on the provided definitions.
 * 
 * It uses the factory design pattern to create the widget.
 */
final class SimpleFactory
{
    public static array $defaultDefinitions = [];

    public static function defaultDefinitions(array $definitions): void
    {
        self::$defaultDefinitions = $definitions;
    }

    /**
     * Factory method for creating a widget.
     *
     * This method iterates over the provided definitions and applies them to the widget.
     * If a definition ends with '()', it is treated as a method call on the widget.
     * If the method call returns an instance of the widget, the widget is updated with the returned instance.
     *
     * @param string $class The widget class to create.
     * @param array $args The arguments to pass to the widget's constructor.
     *
     * @psalm-param class-string<Widget> $class
     *
     * @throws ReflectionException
     */
    public static function create(string $class, array $args): Widget
    {
        $reflection = new ReflectionClass($class);

        /** @var Widget $widget */
        $widget = $reflection->newInstanceArgs($args);

        /** @psalm-var array<string, mixed> $defaultDefinitions */
        $defaultDefinitions = self::$defaultDefinitions[$class] ?? [];

        if ($defaultDefinitions !== []) {
            $widget = self::configure($widget, $defaultDefinitions);
        }

        /** @psalm-var array<string, mixed> $loadDefaultDefinitions */
        $loadDefaultDefinitions = $reflection->getMethod('loadDefaultDefinitions')->invoke($widget);

        if ($loadDefaultDefinitions !== []) {
            $widget = self::configure($widget, $loadDefaultDefinitions);
        }

        return self::configure($widget, $widget->definitions);
    }

    /**
     * Configures the widget with the provided definitions.
     *
     * This method iterates over the provided definitions and applies them to the widget.
     *
     * @template T of Widget
     *
     * @param T $widget The widget to configure.
     * @param array $definitions
     *
     * @return Widget The widget with the applied definitions.
     *
     * @psalm-param T $widget The widget to configure.
     * @psalm-param array<string, mixed> $definitions The definitions to apply to the widget.
     *
     * @psalm-return T|Widget
     */
    public static function configure(object $widget, array $definitions)
    {
        if (!$widget instanceof Widget) {
            throw new InvalidArgumentException(
                sprintf(
                    'The provided widget must be an instance of "%s", "%s" given.',
                    Widget::class,
                    get_class($widget)
                )
            );
        }

        if ($definitions === []) {
            return $widget;
        }

        foreach ($definitions as $action => $arguments) {
            if (str_ends_with($action, '()')) {
                $setter = call_user_func_array([$widget, substr($action, 0, -2)], $arguments);

                if ($setter instanceof Widget) {
                    $widget = $setter;
                }
            }
        }

        return $widget;
    }
}
