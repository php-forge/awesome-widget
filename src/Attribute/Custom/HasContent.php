<?php

declare(strict_types=1);

namespace PHPForge\Widget\Attribute\Custom;

use PHPForge\Widget\WidgetInterface;
use Stringable;
use Yii\Html\Helper\Encode;

/**
 * Is used by widgets which have content value.
 */
trait HasContent
{
    protected string $content = '';

    /**
     * Returns a new instance specifying the content value of the widget.
     *
     * @param string|Stringable $value The content value.
     * @param bool $encode Whether to encode the content value.
     */
    public function content(string|Stringable|WidgetInterface $value, bool $encode = true): static
    {
        if ($encode && !($value instanceof WidgetInterface)) {
            $value = Encode::content($value);
        }

        $new = clone $this;
        $new->content = (string) $value;

        return $new;
    }
}
