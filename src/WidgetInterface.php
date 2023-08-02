<?php

declare(strict_types=1);

namespace PHPForge\Widget;

use RuntimeException;
use Stringable;

/**
 * AbstractBaseWidget is the base class for widgets. A widget is a reusable component that can be used in different
 * views.
 */
interface WidgetInterface extends Stringable
{
    /**
     * Used to open a wrapping widget (the one with begin/end).
     *
     * When implementing this method, don't forget to call parent::begin().
     *
     * @return string Opening part of widget markup.
     */
    public function begin(): string;

    /**
     * Checks that the widget was opened with {@see begin()}.
     *
     * @return bool Whether the widget was opened with {@see begin()}.
     */
    public function isBeginExecuted(): bool;

    /**
     * Executes the widget.
     *
     * @return string The result of widget execution to be outputted.
     */
    public function render(): string;

    /**
     * Checks that the widget was opened with {@see begin()}. If so, runs it and returns content generated.
     *
     * @throws RuntimeException
     */
    public static function end(): string;

    /**
     * Creates a widget instance.
     *
     * @param mixed ...$args The constructor arguments for the widget.
     */
    public static function widget(mixed ...$args): self;
}
