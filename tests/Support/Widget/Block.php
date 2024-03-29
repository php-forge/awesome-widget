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

    protected function beforeRun(): bool
    {
        if ($this->id === 'before-run') {
            return false;
        }

        return parent::beforeRun();
    }

    protected function run(): string
    {
        return match ($this->isBeginExecuted()) {
            true => '<id="' . $this->id . '-begin">',
            default => '<id="' . $this->id . '">',
        };
    }
}
