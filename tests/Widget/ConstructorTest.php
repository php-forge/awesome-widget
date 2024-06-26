<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Widget;

use PHPForge\Widget\Tests\Support\Widget\WidgetConstructor;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ConstructorTest extends TestCase
{
    public function testRender(): void
    {
        $output = WidgetConstructor::widget()->id('w0');

        $this->assertSame('<id="w0">', $output->render());
    }

    public function testConstructorWithDefinitions(): void
    {
        $output = WidgetConstructor::widget(['id()' => ['w1']]);

        $this->assertSame('<id="w1">', $output->render());
    }
}
