<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Support\Widget;

use PHPForge\Widget\Element;

final class DefaultDefinition extends Element
{
    protected string $id = '';

    public function id(string $value): self
    {
        $new = clone $this;
        $new->id = $value;

        return $new;
    }

    protected function afterRun(string $result): string
    {
        $result = parent::afterRun($result);

        if ($this->id === 'afterrun') {
            $result = '<div>' . $result . '</div>';
        }

        return $result;
    }

    protected function beforeRun(): bool
    {
        if ($this->id === 'beforerun') {
            return false;
        }

        return parent::beforeRun();
    }

    protected function loadDefaultDefinitions(): array
    {
        return [
            'id()' => ['id-default-definitions'],
        ];
    }

    protected function run(): string
    {
        return '<id="' . $this->id . '">';
    }
}
