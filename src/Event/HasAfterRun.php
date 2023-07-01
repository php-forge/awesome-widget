<?php

declare(strict_types=1);

namespace PHPForge\Widget\Event;

/**
 * HasAfterRun is event that's triggered right after the widget is executed.
 */
trait HasAfterRun
{
    /**
     * This method is invoked right after a widget is executed.
     *
     * The return value of the method will be used as the widget return value.
     *
     * If you override this method, your code should look like the following:
     *
     * ```php
     * public function afterRun(string $result): string
     * {
     *     $result = parent::afterRun($result);
     *     // your custom code here
     *     return $result;
     * }
     * ```
     *
     * @param string $result The widget return result.
     *
     * @return string The processed widget result.
     */
    protected function afterRun(string $result): string
    {
        return $result;
    }
}
