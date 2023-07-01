<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Input;

use PHPForge\Widget\Tests\Support\Form\TestForm;
use PHPForge\Widget\Tests\Support\Widget\InputWidget;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends TestCase
{
    public function testImmutability(): void
    {
        $inputWidget = InputWidget::widget(new TestForm(), 'string');

        $this->assertNotSame($inputWidget, $inputWidget->accept(''));
        $this->assertNotSame($inputWidget, $inputWidget->alt(''));
        $this->assertNotSame($inputWidget, $inputWidget->ariaDescribedBy(''));
        $this->assertNotSame($inputWidget, $inputWidget->ariaLabel(''));
        $this->assertNotSame($inputWidget, $inputWidget->attributes([]));
        $this->assertNotSame($inputWidget, $inputWidget->autofocus());
        $this->assertNotSame($inputWidget, $inputWidget->charset(''));
        $this->assertNotSame($inputWidget, $inputWidget->checked(false));
        $this->assertNotSame($inputWidget, $inputWidget->class('class'));
        $this->assertNotSame($inputWidget, $inputWidget->container(true));
        $this->assertNotSame($inputWidget, $inputWidget->containerAttributes());
        $this->assertNotSame($inputWidget, $inputWidget->containerClass(''));
        $this->assertNotSame($inputWidget, $inputWidget->dirname('test'));
        $this->assertNotSame($inputWidget, $inputWidget->disabled());
        $this->assertNotSame($inputWidget, $inputWidget->form(''));
        $this->assertNotSame($inputWidget, $inputWidget->height(0));
        $this->assertNotSame($inputWidget, $inputWidget->id('test'));
        $this->assertNotSame($inputWidget, $inputWidget->label(''));
        $this->assertNotSame($inputWidget, $inputWidget->labelAttributes());
        $this->assertNotSame($inputWidget, $inputWidget->labelClass(''));
        $this->assertNotSame($inputWidget, $inputWidget->max(0));
        $this->assertNotSame($inputWidget, $inputWidget->maxLength(0));
        $this->assertNotSame($inputWidget, $inputWidget->min(''));
        $this->assertNotSame($inputWidget, $inputWidget->minLength(0));
        $this->assertNotSame($inputWidget, $inputWidget->multiple());
        $this->assertNotSame($inputWidget, $inputWidget->name(''));
        $this->assertNotSame($inputWidget, $inputWidget->notLabel());
        $this->assertNotSame($inputWidget, $inputWidget->pattern(''));
        $this->assertNotSame($inputWidget, $inputWidget->placeholder(''));
        $this->assertNotSame($inputWidget, $inputWidget->prefix(''));
        $this->assertNotSame($inputWidget, $inputWidget->prompt(''));
        $this->assertNotSame($inputWidget, $inputWidget->readonly());
        $this->assertNotSame($inputWidget, $inputWidget->required());
        $this->assertNotSame($inputWidget, $inputWidget->size(0));
        $this->assertNotSame($inputWidget, $inputWidget->src(''));
        $this->assertNotSame($inputWidget, $inputWidget->step(0));
        $this->assertNotSame($inputWidget, $inputWidget->style(''));
        $this->assertNotSame($inputWidget, $inputWidget->suffix(''));
        $this->assertNotSame($inputWidget, $inputWidget->tabindex(0));
        $this->assertNotSame($inputWidget, $inputWidget->template(''));
        $this->assertNotSame($inputWidget, $inputWidget->title(''));
        $this->assertNotSame($inputWidget, $inputWidget->type(''));
        $this->assertNotSame($inputWidget, $inputWidget->value(null));
        $this->assertNotSame($inputWidget, $inputWidget->width(0));
    }
}
