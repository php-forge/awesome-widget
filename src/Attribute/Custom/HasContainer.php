<?php

declare(strict_types=1);

namespace PHPForge\Widget\Attribute\Custom;

use Yii\Html\Helper\CssClass;

/**
 * Provides methods to configure the HTML container.
 */
trait HasContainer
{
    protected bool $container = true;
    protected array $containerAttributes = [];

    /**
     * Return new instance specifying when the container its enabled or disabled.
     *
     * @param bool $value `true` to enable container, `false` to disable.
     */
    public function container(bool $value): static
    {
        $new = clone $this;
        $new->container = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying the `HTML` container attributes.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function containerAttributes(array $values = []): static
    {
        $new = clone $this;
        $new->containerAttributes = $values;

        return $new;
    }

    /**
     * Returns a new instance specifying the `CSS` HTML container class name.
     *
     * @param string $value The css class name.
     */
    public function containerClass(string $value): static
    {
        $new = clone $this;
        CssClass::add($new->containerAttributes, $value);

        return $new;
    }
}
