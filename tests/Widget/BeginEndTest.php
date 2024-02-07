<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Widget;

use PHPForge\Widget\Tests\Support\Widget\Block;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class BeginEndTest extends TestCase
{
    public function testRender(): void
    {
        Block::widget()->id('test')->begin();

        $this->assertSame('<id="test-begin">', Block::end());
    }
}
