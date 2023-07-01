<?php

declare(strict_types=1);

namespace PHPForge\Widget\Attribute\Input;

/**
 * Is used by widgets which can be multiple.
 */
trait CanBeMultiple
{
    /**
     * Returns a new instances specifying the boolean multiple attribute, if set, means the user can enter comma
     * separated email addresses in the email widget or can choose more than one file with the file input.
     *
     * @param bool $value Whether the element allows multiple values.
     *
     * @link https://html.spec.whatwg.org/multipage/input.html#attr-input-multiple
     */
    public function multiple(bool $value = true): static
    {
        $new = clone $this;
        $new->attributes['multiple'] = $value;

        return $new;
    }
}
