<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Widget;

use PHPForge\Widget\Tests\Support\Widget\Block;
use PHPForge\Widget\Tests\Support\Widget\BlockConstructor;
use PHPUnit\Framework\TestCase;
use RuntimeException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    public function testStackTracking(): void
    {
        $widget = Block::widget();

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            'Unexpected PHPForge\Widget\Tests\Support\Widget\Block::end() call. A matching begin() is not found.'
        );

        $widget::end();
    }

    public function testStackTrackingWithDiferentClass(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage(
            'Expecting end() of PHPForge\Widget\Tests\Support\Widget\Block found PHPForge\Widget\Tests\Support\Widget\BlockConstructor.'
        );

        Block::widget()->begin();
        BlockConstructor::end();
    }
}
