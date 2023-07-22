<?php

declare(strict_types=1);

namespace PHPForge\Widget\Base;

use PHPForge\Widget\Event;
use PHPForge\Widget\WidgetInterface;

abstract class AbstractBaseWidget implements WidgetInterface
{
    use Event\HasAfterRun;
    use Event\HasBeforeRun;

    /**
     * The widgets that are currently opened and not yet closed.
     * This property is maintained by {@see begin()} and {@see end()} methods.
     *
     * @var static[]
     */
    protected static array $stack = [];

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

    public function begin(): string
    {
        self::$stack[] = $this;

        return '';
    }

    /**
     * Renders widget content.
     *
     * This method is used by {@see render()} and is meant to be overridden when implementing concrete widget.
     */
    abstract protected function run(): string;
}
