<?php

declare(strict_types=1);

namespace PHPForge\Widget;

use Stringable;

/**
 * This interface extends the Stringable interface and provides methods for rendering a widget and creating a widget instance.
 */
interface ElementInterface extends Stringable
{
    /**
     * Executes the widget.
     *
     * This method is responsible for executing the widget and returning the result of the execution as a string.
     *
     * @return string The result of widget execution to be outputted.
     */
    public function render(): string;

    /**
     * Creates a widget instance.
     *
     * This method is responsible for creating a new instance of the widget. The constructor arguments for the widget are passed as parameters.
     *
     * @param mixed ...$args The constructor arguments for the widget.
     *
     * @return static Returns an instance of the widget.
     */
    public static function widget(mixed ...$args): static;
}
