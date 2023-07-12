<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Widget;

use PHPForge\Widget\Tests\Support\Widget\Widget;
use PHPForge\Widget\Tests\Support\Widget\WidgetConstructor;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    public function testStackTracking(): void
    {
        $widget = Widget::widget();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            'Unexpected PHPForge\Widget\Tests\Support\Widget\Widget::end() call. A matching begin() is not found.'
        );

        $widget::end();
    }

    public function testStackTrackingWithDiferentClass(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            'Expecting end() of PHPForge\Widget\Tests\Support\Widget\Widget found PHPForge\Widget\Tests\Support\Widget\WidgetConstructor.'
        );

        Widget::widget()->begin();
        WidgetConstructor::end();
    }
}
