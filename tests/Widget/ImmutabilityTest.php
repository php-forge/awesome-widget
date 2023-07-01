<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Widget;

use PHPForge\Widget\Attribute\Enum\DataAttributes;
use PHPForge\Widget\Tests\Support\Widget\Widget;
use PHPUnit\Framework\TestCase;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends TestCase
{
    public function testImmutability(): void
    {
        $widget = Widget::widget();

        $this->assertNotSame($widget, $widget->attributes([]));
        $this->assertNotSame($widget, $widget->autocomplete('on'));
        $this->assertNotSame($widget, $widget->cols(0));
        $this->assertNotSame($widget, $widget->content('', false));
        $this->assertNotSame($widget, $widget->crossorigin('anonymous'));
        $this->assertNotSame($widget, $widget->dataAttributes(DataAttributes::MESSAGE, 'Hello World!'));
        $this->assertNotSame($widget, $widget->download());
        $this->assertNotSame($widget, $widget->groups());
        $this->assertNotSame($widget, $widget->href(''));
        $this->assertNotSame($widget, $widget->hreflang('en'));
        $this->assertNotSame($widget, $widget->ismap());
        $this->assertNotSame($widget, $widget->items());
        $this->assertNotSame($widget, $widget->itemsAttributes());
        $this->assertNotSame($widget, $widget->loading('eager'));
        $this->assertNotSame($widget, $widget->ping(''));
        $this->assertNotSame($widget, $widget->referrerpolicy('no-referrer'));
        $this->assertNotSame($widget, $widget->rel('icon'));
        $this->assertNotSame($widget, $widget->rows(0));
        $this->assertNotSame($widget, $widget->sizes(''));
        $this->assertNotSame($widget, $widget->srcset(''));
        $this->assertNotSame($widget, $widget->style(''));
        $this->assertNotSame($widget, $widget->tagName('div'));
        $this->assertNotSame($widget, $widget->target('_blank'));
        $this->assertNotSame($widget, $widget->template(''));
        $this->assertNotSame($widget, $widget->wrap('soft'));
    }
}
