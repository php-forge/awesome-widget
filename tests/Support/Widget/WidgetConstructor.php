<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Support\Widget;

use PHPForge\Html\Helper\Attributes;
use PHPForge\Widget\AbstractWidget;

final class WidgetConstructor extends AbstractWidget
{
    protected array $attributes = [];

    public function __construct(private Attributes $attributesHelper, array $definitions = [])
    {
        parent::__construct($definitions);
    }

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

    protected function beforeRun(): bool
    {
        if (isset($this->attributes['id']) && $this->attributes['id'] === 'beforerun') {
            return false;
        }

        return parent::beforeRun();
    }

    protected function afterRun(string $result): string
    {
        $result = parent::afterRun($result);

        if (isset($this->attributes['id']) && $this->attributes['id'] === 'afterrun') {
            $result = '<div>' . $result . '</div>';
        }

        return $result;
    }

    protected function run(): string
    {
        return '<' . trim($this->attributesHelper->render($this->attributes)) . '>';
    }
}
