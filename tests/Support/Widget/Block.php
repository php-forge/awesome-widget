<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Support\Widget;

use PHPForge\Html\Helper\Attributes;

final class Block extends \PHPForge\Widget\Block
{
    protected array $attributes = [];

    public function attributes(array $values): self
    {
        $new = clone $this;
        $new->attributes = $values;

        return $new;
    }

    public function id(string $id): self
    {
        $new = clone $this;
        $new->attributes['id'] = $id;

        return $new;
    }

    public function begin(): string
    {
        return parent::begin();
    }

    protected function run(): string
    {
        return '<' . trim((new Attributes())->render($this->attributes)) . '>';
    }
}
