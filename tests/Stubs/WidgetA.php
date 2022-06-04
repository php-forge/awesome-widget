<?php

declare(strict_types=1);

namespace Forge\Widget\Tests\Stubs;

use Forge\Html\Attribute\Attributes;
use Forge\Widget\AbstractWidget;

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
