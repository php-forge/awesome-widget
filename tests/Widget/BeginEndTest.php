<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Widget;

use PHPForge\Widget\Tests\Support\Widget\Widget;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class BeginEndTest extends TestCase
{
    public function testRender(): void
    {
        Widget::widget()->id('test')->begin();

        $output = Widget::end();

        $this->assertSame('<id="test">', $output);
    }
}
