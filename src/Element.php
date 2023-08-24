<?php

declare(strict_types=1);

namespace PHPForge\Widget;

abstract class Element extends Base\Widget
{
    final public function render(): string
    {
        if (!$this->beforeRun()) {
            return '';
        }

        return $this->afterRun($this->run());
    }
}
