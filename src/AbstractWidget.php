<?php

declare(strict_types=1);

namespace PHPForge\Widget;

use ReflectionClass;
use RuntimeException;

use function array_pop;
use function get_class;

/**
 * AbstractWidget is the base class for widgets. A widget is a reusable component that can be used in different views.
 * It encapsulates the rendering logic of a particular UI component.
 */
abstract class AbstractWidget extends Base\AbstractBaseWidget
{
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

    final public function render(): string
    {
        if (!$this->beforeRun()) {
            return '';
        }

        return $this->afterRun($this->run());
    }

    final public static function widget(mixed ...$args): static
    {
        $reflection = new ReflectionClass(static::class);

        /** @var static $widget */
        $widget = $reflection->newInstanceArgs($args);

        if ($widget->definitions === []) {
            return $widget;
        }

        return Factory\SimpleWidgetFactory::factory($widget->definitions, $widget);
    }
}
