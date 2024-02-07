<?php

declare(strict_types=1);

namespace PHPForge\Widget;

use RuntimeException;

/**
 * This interface extends the ElementInterface and provides methods for managing and rendering widgets.
 * It includes methods for opening a widget, checking if a widget is open, and closing a widget.
 */
interface BlockInterface extends ElementInterface
{
    /**
     * Begins the widget.
     *
     * This method is used to open a wrapping widget (the one with begin/end).
     * When implementing this method, ensure to call parent::begin().
     *
     * @return string Returns the opening part of the widget markup.
     */
    public function begin(): string;

    /**
     * Ends the widget.
     *
     * This method checks if the widget was opened with {@see begin()}.
     * If so, it runs the widget and returns the content generated.
     *
     * @throws RuntimeException Throws an exception if the widget was not opened with {@see begin()}.
     *
     * @return string Returns the content generated by the widget.
     */
    public static function end(): string;
}
