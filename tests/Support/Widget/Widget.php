<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Support\Widget;

use PHPForge\Widget\Element;

final class Widget extends Element
{
    protected string $id = '';

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

    protected function afterRun(string $result): string
    {
        $result = parent::afterRun($result);

        if ($this->id === 'after-run') {
            $result = '<div>' . $result . '</div>';
        }

        return $result;
    }

    protected function getCookbooks(string $option): array
    {
        return [
            'cookbook-id' => ['id()' => [$option]],
        ];
    }

    protected function run(): string
    {
        return '<id="' . $this->id . '">';
    }
}
