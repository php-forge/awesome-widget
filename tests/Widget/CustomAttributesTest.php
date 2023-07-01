<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Widget;

use PHPForge\Widget\Tests\Support\Widget\Widget;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CustomAttributesTest extends TestCase
{
    public function testAttributes(): void
    {
        $this->assertSame(
            '<class="text-danger" id="id-test">',
            Widget::widget()->id('id-test')->attributes(['class' => 'text-danger'])->render(),
        );
    }
}
