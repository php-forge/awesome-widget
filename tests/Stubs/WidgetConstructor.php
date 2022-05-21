<?php

declare(strict_types=1);

namespace Forge\Widget\Tests\Stubs;

use Forge\Widget\AbstractWidget;
use Forge\Widget\Html\Attributes;

final class WidgetConstructor extends AbstractWidget
{
    public function __construct(private Attributes $attributes)
    {
    }

    protected function run(): string
    {
        return '<' . trim($this->attributes->render($this->attributes)) . '>';
    }

    public function id(string $value): self
    {
        $new = clone $this;
        $new->attributes['id'] = $value;
        return $new;
    }
}
