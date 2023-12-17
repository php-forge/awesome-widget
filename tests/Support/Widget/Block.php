<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Support\Widget;

final class Block extends \PHPForge\Widget\Block
{
    private string $id = '';

    public function id(string $value): self
    {
        $new = clone $this;
        $new->id = $value;

        return $new;
    }

    public function begin(): string
    {
        return parent::begin();
    }

    protected function beforeRun(): bool
    {
        if ($this->id === 'beforerun') {
            return false;
        }

        return parent::beforeRun();
    }

    protected function run(): string
    {
        return '<id="' . $this->id . '">';
    }
}
