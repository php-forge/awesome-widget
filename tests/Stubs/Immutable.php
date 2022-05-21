<?php

declare(strict_types=1);

namespace Forge\Widget\Tests\Stubs;

use Forge\Widget\AbstractWidget;

final class Immutable extends AbstractWidget
{
    private string $id = 'original';

    protected function run(): string
    {
        return '<run-' . $this->id . '>';
    }

    public function id(string $value): self
    {
        $new = clone $this;
        $new->id = $value;
        return $new;
    }
}
