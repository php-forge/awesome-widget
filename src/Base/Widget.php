<?php

declare(strict_types=1);

namespace PHPForge\Widget\Base;

use PHPForge\Widget\ElementInterface;
use PHPForge\Widget\Event;
use PHPForge\Widget\Factory\SimpleFactory;

/**
 * An abstract class that implements the ElementInterface.
 *
 * It provides the basic structure and functionality for widgets in the PHPForge packages.
 */
abstract class Widget implements ElementInterface
{
    use Event\HasAfterRun;
    use Event\HasBeforeRun;

    /**
     * @psalm-param array<string, mixed> $definitions
     */
    public function __construct(public readonly array $definitions = []) {}

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

    /**
     * This method is a static factory method that creates an instance of the widget.
     * It uses the ReflectionClass to create a new instance of the widget with the provided arguments.
     * If the widget's definitions are empty, it returns the widget.
     * Otherwise, it uses the SimpleFactory to create the widget with the definitions and the widget itself.
     *
     * @param mixed ...$args The arguments to pass to the widget's constructor.
     *
     * @return static The created widget instance.
     */
    final public static function widget(mixed ...$args): static
    {
        return SimpleFactory::create(static::class, $args);
    }

    /**
     * Renders widget content.
     *
     * This method is used by {@see render()} and is meant to be overridden when implementing concrete widget.
     */
    abstract protected function run(): string;

    /**
     * This method is used to configure the widget with the provided default definitions.
     */
    protected function loadDefaultDefinitions(): array
    {
        return [];
    }
}
