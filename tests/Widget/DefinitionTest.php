<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Widget;

use PHPForge\Widget\Tests\Support\Widget\Widget;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class DefinitionTest extends TestCase
{
    public function testRender(): void
    {
        $this->assertSame(
            '<id="test-id">',
            Widget::widget(
                [
                    'id()' => ['test-id'],
                ]
            )->render()
        );
    }
}
