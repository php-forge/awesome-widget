<?php

declare(strict_types=1);

namespace PHPForge\Widget\Attribute;

/**
 * Is used by widgets which have an ismap attribute.
 */
trait HasIsmap
{
    /**
     * Returns a new instance specially this ismap attribute indicates that the image is part of a server-side map.
     *
     * If so, the coordinates where the user clicked on the image are sent to the server.
     */
    public function ismap(): static
    {
        $new = clone $this;
        $new->attributes['ismap'] = true;

        return $new;
    }
}
