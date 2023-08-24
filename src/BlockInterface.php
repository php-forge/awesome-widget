<?php

declare(strict_types=1);

namespace PHPForge\Widget;

use RuntimeException;

interface BlockInterface extends ElementInterface
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
     * Checks that the widget was opened with {@see begin()}. If so, runs it and returns content generated.
     *
     * @throws RuntimeException
     */
    public static function end(): string;

    /**
     * Checks that the widget was opened with {@see begin()}.
     *
     * @return bool Whether the widget was opened with {@see begin()}.
     */
    public function isBeginExecuted(): bool;
}
