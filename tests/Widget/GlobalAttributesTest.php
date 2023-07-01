<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Widget;

use PHPForge\Widget\AbstractWidget;
use PHPForge\Widget\Attribute\Enum\DataAttributes;
use PHPForge\Widget\Tests\Support\Widget\Widget;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class GlobalAttributesTest extends TestCase
{
    public function testAutocomplete(): void
    {
        $this->assertSame('<autocomplete="on">', Widget::widget()->autocomplete('on')->render());
    }

    public function testCols(): void
    {
        $this->assertSame('<cols="0">', Widget::widget()->cols(0)->render());
    }

    public function testContent(): void
    {
        $this->assertSame('<test &amp; test>', Widget::widget()->content('test & test')->render());
    }

    public function testContentWithEncodeFalse(): void
    {
        $this->assertSame('<test & test>', Widget::widget()->content('test & test', false)->render());
    }

    public function testContentWithStringable(): void
    {
        $this->assertSame(
            '<test &amp; test>',
            Widget::widget()
                ->content(
                    new class () {
                        public function __toString(): string
                        {
                            return 'test & test';
                        }
                    }
                )->render()
        );
    }

    public function testContentWithStringableWithEncodeFalse(): void
    {
        $this->assertSame(
            '<test & test>',
            Widget::widget()
                ->content(
                    new class () {
                        public function __toString(): string
                        {
                            return 'test & test';
                        }
                    },
                    false,
                )->render()
        );
    }

    public function testContentWithWigetInterface(): void
    {
        $this->assertSame(
            '<test & test>',
            Widget::widget()
                ->content(
                    new class () extends AbstractWidget {
                        protected function run(): string
                        {
                            return 'test & test';
                        }
                    }
                )->render()
        );
    }

    public function testCrossorigin(): void
    {
        $this->assertSame('<crossorigin="anonymous">', Widget::widget()->crossorigin('anonymous')->render());
    }

    public function testDataAttributes(): void
    {
        $this->assertSame('<data-method="POST">', Widget::widget()->dataAttributes(DataAttributes::METHOD, 'POST')->render());
    }

    public function testDownload(): void
    {
        $this->assertSame('<download>', Widget::widget()->download()->render());
    }

    public function testHref(): void
    {
        $this->assertSame('<href="http://test.com">', Widget::widget()->href('http://test.com')->render());
    }

    public function testHreflang(): void
    {
        $this->assertSame('<hreflang="en">', Widget::widget()->hreflang('en')->render());
    }

    public function testIsmap(): void
    {
        $this->assertSame('<ismap>', Widget::widget()->ismap()->render());
    }

    public function testLoading(): void
    {
        $this->assertSame('<loading="eager">', Widget::widget()->loading('eager')->render());
    }

    public function testPing(): void
    {
        $this->assertSame('<ping="http://test.com">', Widget::widget()->ping('http://test.com')->render());
    }

    public function testRel(): void
    {
        $this->assertSame('<rel="icon">', Widget::widget()->rel('icon')->render());
    }

    public function testReferrerpolicy(): void
    {
        $this->assertSame('<referrerpolicy="no-referrer">', Widget::widget()->referrerpolicy('no-referrer')->render());
    }

    public function testRows(): void
    {
        $this->assertSame('<rows="0">', Widget::widget()->rows(0)->render());
    }

    public function testSizes(): void
    {
        $this->assertSame(
            '<sizes="(max-width: 300px) 100vw, 300px">',
            Widget::widget()->sizes('(max-width: 300px) 100vw, 300px')->render(),
        );
    }

    public function testSrcset(): void
    {
        $this->assertSame(
            '<srcset="small.jpg 300w, medium.jpg 1000w, big.jpg 2000w">',
            Widget::widget()->srcset('small.jpg 300w', 'medium.jpg 1000w', 'big.jpg 2000w')->render(),
        );
    }

    public function testStyle(): void
    {
        $this->assertSame('<style="color: red">', Widget::widget()->style('color: red')->render());
    }

    public function testTagName(): void
    {
        $this->assertSame('<tag>', Widget::widget()->tagName('tag')->render());
    }

    public function testTarget(): void
    {
        $this->assertSame('<target="_blank">', Widget::widget()->target('_blank')->render());
    }

    public function testWrap(): void
    {
        $this->assertSame('<wrap="hard">', Widget::widget()->wrap()->render());

        $this->assertSame('<wrap="soft">', Widget::widget()->wrap('soft')->render());
    }
}
