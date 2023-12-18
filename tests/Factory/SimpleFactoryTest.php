<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Factory;

use PHPForge\Widget\Factory\SimpleFactory;
use PHPForge\Widget\Tests\Support\Widget\Widget;
use PHPForge\Widget\Tests\Support\Widget\WidgetConstructor;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class SimpleFactoryTest extends TestCase
{
    public function testCreate(): void
    {
        $widget = SimpleFactory::create(Widget::class, [['id()' => ['id-create']]]);

        $this->assertSame('<id="id-create">', $widget->render());
    }

    public function testCreateWithDefaultDefinitions(): void
    {
        $defaultDefinitions = [
            Widget::class => [
                'id()' => ['id-widget'],
            ],
            WidgetConstructor::class => [
                'id()' => ['id-constructor'],
            ],
        ];

        SimpleFactory::defaultDefinitions($defaultDefinitions);
        $widget = SimpleFactory::create(Widget::class, []);

        $this->assertSame('<id="id-widget">', $widget->render());
    }

    public function testConfigure(): void
    {
        $configWidget = SimpleFactory::configure(Widget::widget(), ['id()' => ['id-configure']]);

        $this->assertSame('<id="id-configure">', $configWidget->render());
    }
}
