<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Input;

use InvalidArgumentException;
use PHPForge\Widget\Exception\AttributeNotSet;
use PHPForge\Widget\Tests\Support\Form\TestForm;
use PHPForge\Widget\Tests\Support\Widget\InputWidget;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    public function testDirname(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The value cannot be empty.');

        InputWidget::widget(new TestForm(), 'string')->dirname('')->render();
    }

    public function testGetAttributeNotSet(): void
    {
        $this->expectException(AttributeNotSet::class);
        $this->expectExceptionMessage('Failed to create widget because "attribute" is not set or not exists.');

        InputWidget::widget(new TestForm(), '');
    }

    public function testGetAttributeNotExist(): void
    {
        $this->expectException(AttributeNotSet::class);
        $this->expectExceptionMessage('Failed to create widget because "attribute" is not set or not exists.');

        InputWidget::widget(new TestForm(), 'noExist');
    }

    public function testStep(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must be a number.');

        InputWidget::widget(new TestForm(), 'string')->step('x')->render();
    }
}
