<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Support\Form;

use PHPForge\FormModel\AbstractFormModel;
use PHPForge\FormModel\FormModelInterface;

final class RuleHtmlAttributesForm extends AbstractFormModel
{
    private array $array = [];
    private string|null $string = '';

    public function getRuleHtmlAttributes(FormModelInterface $formModel, string $attribute): array
    {
        return match ($attribute) {
            'string' => ['required' => true],
            default => [],
        };
    }
}
