<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Widget;

use PHPForge\Widget\Element;
use PHPForge\Widget\Tests\Support\Widget\Widget;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CookbookTest extends TestCase
{
    public function testCookbook(): void
    {
        $this->assertSame(
            '<id="test-id">',
            Widget::widget()->cookbook('cookbook-id', 'test-id')->render()
        );
    }

    public function testGetCookbooks(): void
    {
        $instance = new class () extends Element {
            protected function run(): string
            {
                return '';
            }

            public function cookbooks(): array
            {
                return $this->getCookbooks('');
            }
        };

        $this->assertEmpty($instance->cookbooks());
    }
}
