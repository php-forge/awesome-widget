<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Widget;

use PHPForge\Widget\Tests\Support\Widget\Widget;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class AfterRunTest extends TestCase
{
    public function testRender(): void
    {
        $this->assertSame('<div><id="afterrun"></div>', Widget::widget()->id('afterrun')->render());
    }
}
