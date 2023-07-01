<?php

declare(strict_types=1);

namespace PHPForge\Widget\Attribute\Custom;

use PHPForge\Widget\Attribute\Enum\DataAttributes;

/**
 * Is used by widgets which have a data attribute.
 */
trait HasData
{
    /**
     * Returns a new instance specifying the data attribute.
     *
     * @param DataAttributes $dataAttributes The data attribute.
     * @param mixed $value The value of the data attribute.
     */
    public function dataAttributes(DataAttributes $dataAttributes, mixed $value): static
    {
        $new = clone $this;
        $new->attributes[$dataAttributes->value] = $value;

        return $new;
    }
}
