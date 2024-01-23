<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Support\Widget;

final class BlockConstructor extends \PHPForge\Widget\Block
{
    private string $id = '';

    public function id(string $value): self
    {
        $new = clone $this;
        $new->id = $value;

        return $new;
    }

    protected function run(): string
    {
        return '<id="' . $this->id . '">';
    }
}
