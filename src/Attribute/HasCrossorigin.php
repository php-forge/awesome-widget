<?php

declare(strict_types=1);

namespace PHPForge\Widget\Attribute;

use InvalidArgumentException;

use function in_array;

/**
 * Is used by widgets which have a crossorigin attribute.
 */
trait HasCrossorigin
{
    /**
     * Returns a new instance specifying if the fetching of the image must be done using a CORS request.
     *
     * Image data from a CORS-enabled image returned from a CORS request can be reused in the `<canvas>` element without
     * being marked "tainted".
     *
     * @param string $value The crossorigin value.
     */
    public function crossorigin(string $value): static
    {
        if (!in_array($value, ['anonymous', 'use-credentials'], true)) {
            throw new InvalidArgumentException('Invalid crossOrigin value.');
        }

        $new = clone $this;
        $new->attributes['crossorigin'] = $value;

        return $new;
    }
}
