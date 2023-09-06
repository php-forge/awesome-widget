<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Widget;

use PHPForge\Widget\Tests\Support\Widget\Block;
use PHPForge\Widget\Tests\Support\Widget\Widget;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class BeforeRunTest extends TestCase
{
    public function testBlock(): void
    {
        $this->assertEmpty(Block::widget()->id('beforerun')->render());
    }

    public function testElement(): void
    {
        $this->assertEmpty(Widget::widget()->id('beforerun')->render());
    }
}
