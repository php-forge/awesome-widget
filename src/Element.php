<?php

declare(strict_types=1);

namespace PHPForge\Widget;

/**
 * An abstract class that extends Base\Widget.
 * It provides a method to render widgets.
 */
abstract class Element extends Base\Widget
{
    /**
     * Render the widget.
     *
     * This method first checks if the beforeRun method has been executed.
     * If not, it returns an empty string.
     * If yes, it runs the afterRun method on the result of the run method and returns the result.
     *
     * @return string The rendered widget.
     */
    final public function render(): string
    {
        if (!$this->beforeRun()) {
            return '';
        }

        return $this->afterRun($this->run());
    }
}
