<?php

declare(strict_types=1);

namespace PHPForge\Widget\Factory;

use PHPForge\Widget\Base\Widget;
use ReflectionClass;

use function call_user_func_array;
use function str_ends_with;
use function substr;

/**
 * This class is responsible for creating a widget based on the provided definitions.
 * It uses the factory design pattern to create the widget.
 */
final class SimpleFactory
{
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
     */
    public static function factory(string $class, array $args): Widget
    {
        $reflection = new ReflectionClass($class);

        /** @var Widget $widget */
        $widget = $reflection->newInstanceArgs($args);

        if ($widget->definitions === []) {
            return $widget;
        }

        foreach ($widget->definitions as $action => $arguments) {
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
