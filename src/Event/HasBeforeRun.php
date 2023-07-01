<?php

declare(strict_types=1);

namespace PHPForge\Widget\Event;

/**
 * HasBeforeRun is an event that's triggered right before the widget is executed.
 */
trait HasBeforeRun
{
    /**
     * This method is invoked right before the widget is executed.
     *
     * The return value of the method will decide whether the widget should continue to run.
     *
     * When overriding this method, make sure you call the parent implementation like the following:
     *
     * ```php
     * public function beforeRun(): bool
     * {
     *     if (!parent::beforeRun()) {
     *         return false;
     *     }
     *
     *     // your custom code here
     *
     *     return true; // or false to not run the widget
     * }
     * ```
     *
     * @return bool Whether the widget should continue to be executed.
     */
    protected function beforeRun(): bool
    {
        return true;
    }
}
