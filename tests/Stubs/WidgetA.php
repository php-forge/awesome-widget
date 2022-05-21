<?php

declare(strict_types=1);

namespace Forge\Widget\Tests\Stubs;

use Forge\Widget\AbstractWidget;
use Forge\Widget\Html\Attributes;

class WidgetA extends AbstractWidget
{
    protected function run(): string
    {
        return '<' . trim((new Attributes())->render($this->attributes)) . '>';
    }

    public function id(string $value): self
    {
        $new = clone $this;
        $new->attributes['id'] = $value;
        return $new;
    }
}
