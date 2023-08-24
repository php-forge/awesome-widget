<?php

declare(strict_types=1);

namespace PHPForge\Widget;

use Stringable;

interface ElementInterface extends Stringable
{
    /**
     * Executes the widget.
     *
     * @return string The result of widget execution to be outputted.
     */
    public function render(): string;

    /**
     * Creates a widget instance.
     *
     * @param mixed ...$args The constructor arguments for the widget.
     */
    public static function widget(mixed ...$args): self;
}
