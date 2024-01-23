<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Factory;

use PHPForge\Widget\Factory\SimpleFactory;
use PHPForge\Widget\Tests\Support\Widget\DefaultDefinition;
use PHPForge\Widget\Tests\Support\Widget\Widget;
use PHPForge\Widget\Tests\Support\Widget\WidgetConstructor;
use PHPUnit\Framework\TestCase;
use ReflectionException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class SimpleFactoryTest extends TestCase
{
    /**
     * @depends testCreateWithDefaultDefinitions
     */
    public function testConfigure(): void
    {
        $widget = SimpleFactory::configure(
            Widget::widget(),
            [
                'id()' => ['id-configure'],
            ]
        );

        $this->assertSame('<id="id-configure">', $widget->render());
    }

    /**
     * @throws ReflectionException
     */
    public function testCreate(): void
    {
        $widget = SimpleFactory::create(
            Widget::class,
            [
                [
                    'id()' => ['id-create'],
                ],
            ]
        );

        $this->assertSame('<id="id-create">', $widget->render());
    }

    /**
     * @throws ReflectionException
     */
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

    /**
     * @depends testCreateWithDefaultDefinitions
     */
    public function testLoadDefaultDefinitions(): void
    {
        $widget = SimpleFactory::configure(DefaultDefinition::widget(), []);

        $this->assertSame('<id="id-default-definitions">', $widget->render());
    }

    /**
     * @depends testCreateWithDefaultDefinitions
     */
    public function testPriority(): void
    {
        $widget = SimpleFactory::configure(
            DefaultDefinition::widget(),
            [
                'id()' => ['id-configure'],
            ]
        );

        $this->assertSame('<id="id-configure">', $widget->render());
    }
}
