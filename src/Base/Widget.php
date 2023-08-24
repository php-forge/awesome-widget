<?php

declare(strict_types=1);

namespace PHPForge\Widget\Base;

use PHPForge\Widget\ElementInterface;
use PHPForge\Widget\Event;
use PHPForge\Widget\Factory\SimpleFactory;
use ReflectionClass;

abstract class Widget implements ElementInterface
{
    use Event\HasAfterRun;
    use Event\HasBeforeRun;

    public function __construct(protected readonly array $definitions = [])
    {
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
        return $this->run();
    }

    final public static function widget(mixed ...$args): static
    {
        $reflection = new ReflectionClass(static::class);

        /** @var static $widget */
        $widget = $reflection->newInstanceArgs($args);

        if ($widget->definitions === []) {
            return $widget;
        }

        return SimpleFactory::factory($widget->definitions, $widget);
    }

    /**
     * Renders widget content.
     *
     * This method is used by {@see render()} and is meant to be overridden when implementing concrete widget.
     */
    abstract protected function run(): string;
}
