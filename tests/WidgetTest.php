<?php

declare(strict_types=1);

namespace Forge\Widget\Tests;

use Forge\Html\Attributes;
use Forge\Widget\Tests\Stubs\Immutable;
use Forge\Widget\Tests\Stubs\Widget;
use Forge\Widget\Tests\Stubs\WidgetA;
use Forge\Widget\Tests\Stubs\WidgetB;
use PHPUnit\Framework\TestCase;
use RuntimeException;

use function runkit7_constant_remove;

final class WidgetTest extends TestCase
{
    public function testAfterRun(): void
    {
        Widget::create()->id('afterrun')->begin();
        $output = Widget::end();
        $this->assertSame('<div><id="afterrun"></div>', $output);
    }

    public function testAttributes(): void
    {
        Widget::create()->id('id-test')->attributes(['class' => 'text-danger'])->begin();
        $output = Widget::end();
        $this->assertSame('<id="id-test" class="text-danger">', $output);
    }

    public function testBeforeRun(): void
    {
        Widget::create()->id('beforerun')->begin();
        $output = Widget::end();
        $this->assertEmpty($output);
    }

    public function testBeginEnd(): void
    {
        WidgetA::create()->id('test')->begin();
        $output = WidgetA::end();
        $this->assertSame('<id="test">', $output);
    }

    public function testBeginEndStaticWithImmutableWidget(): void
    {
        Immutable::create()->id('new')->begin();
        $output = Immutable::end();

        $this->assertSame('<run-new>', $output);
    }

    public function testBeginEndWithImmutableWidget(): void
    {
        $widget = Immutable::create()->id('new');
        $widget->begin();
        $output = $widget::end();
        $this->assertSame('<run-new>', $output);
    }

    public function testCreate(): void
    {
        $output = Widget::create()->id('w0')->render();
        $this->assertSame('<id="w0">', $output);
    }

    public function testImmutability(): void
    {
        $widget = Widget::create();
        $this->assertNotSame($widget, $widget->attributes([]));
    }

    /**
     * @depends testBeginEnd
     */
    public function testStackTracking(): void
    {
        $widget = Widget::create();
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            'Unexpected Forge\Widget\Tests\Stubs\Widget::end() call. A matching begin() is not found.'
        );
        $widget::end();
    }

    /**
     * @depends testBeginEnd
     */
    public function testStackTrackingDiferentClass(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            'Expecting end() of Forge\Widget\Tests\Stubs\WidgetA found Forge\Widget\Tests\Stubs\WidgetB.'
        );
        WidgetA::create()->begin();
        WidgetB::end();
    }

    /**
     * @depends testBeginEnd
     */
    public function testStackTrackingDisorder(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            'Unexpected Forge\Widget\Tests\Stubs\WidgetA::end() call. A matching begin() is not found.'
        );
        $a = WidgetA::create();
        $b = WidgetB::create();
        $a::end();
        $b::end();
    }

    public function testStackTrackingWithImmutableWidget(): void
    {
        $widget = Immutable::create();
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            'Unexpected Forge\Widget\Tests\Stubs\Immutable::end() call. A matching begin() is not found.'
        );
        $widget::end();
    }

    public function testToStringWidget(): void
    {
        $output = Widget::create()->id('w0');
        $this->assertSame('<id="w0">', (string) $output);
    }

    public function testWidgetWithConfig(): void
    {
        $output = Widget::create(config: ['attributes()' => [['class' => 'test-class']]])->id('w0');
        $this->assertSame('<id="w0" class="test-class">', $output->render());
    }

    public function testWidgetWithConstructor(): void
    {
        $output = Widget::create(constructorArguments: [new Attributes()])->id('w0');
        $this->assertSame('<id="w0">', $output->render());
    }

    public function testWidgetWithLoadConfigFile(): void
    {
        $output = Widget::create(loadConfigFile: __DIR__ . '/Stubs/Config.php')->id('w0');
        $this->assertSame('<id="w0" class="text-danger">', $output->render());
    }

    public function testWidgetWithLoadConfigFileWithConfig(): void
    {
        $output = Widget::create(
            loadConfigFile: __DIR__ . '/Stubs/Config.php',
            config: ['attributes()' => [['disable' => true]]]
        )->id('w0');
        $this->assertSame('<id="w0" class="text-danger" disable>', $output->render());
    }

    public function testWidgetWithLoadConfigFileWithConstant(): void
    {
        define('WIDGET_CONFIG_FILE', __DIR__ . '/Stubs/ConfigWidget.php');
        $output = Widget::create()->id('w0');
        $this->assertSame('<id="w0" class="text-danger">', $output->render());
        runkit7_constant_remove('WIDGET_CONFIG_FILE');
    }

    public function testWidgetWithImmutableWidget(): void
    {
        $widget = Immutable::create()->id('new');
        $output = $widget->render();
        $this->assertSame('<run-new>', $output);
    }
}
