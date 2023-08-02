<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Widget;

use PHPForge\Html\Helper\Attributes;
use PHPForge\Widget\Tests\Support\Widget\Widget;
use PHPForge\Widget\Tests\Support\Widget\WidgetConstructor;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class beginExecutedTest extends TestCase
{
    public function testIsBeginExecuted(): void
    {
        $widget = Widget::widget();

        $this->assertFalse($widget->isBeginExecuted());

        $widget->begin() . $widget::end();

        $this->assertTrue($widget->isBeginExecuted());
    }

    public function testIsBeginExecutedSeveralWidgets(): void
    {
        $widget = Widget::widget();
        $widgetConstructor = WidgetConstructor::widget(new Attributes());

        $this->assertFalse($widget->isBeginExecuted());
        $this->assertFalse($widgetConstructor->isBeginExecuted());

        $widget->begin() . $widget::end();

        $this->assertFalse($widgetConstructor->isBeginExecuted());
        $this->assertTrue($widget->isBeginExecuted());
    }
}
