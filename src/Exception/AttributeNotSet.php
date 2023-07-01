<?php

declare(strict_types=1);

namespace PHPForge\Widget\Exception;

use InvalidArgumentException;

/**
 * AttributeNotSet is thrown when the widget is created without attribute.
 */
final class AttributeNotSet extends InvalidArgumentException
{
    public function __construct(string $message = '')
    {
        parent::__construct($message ?: $this->getName());
    }

    /**
     * @return string the user-friendly name of this exception
     */
    private function getName(): string
    {
        return 'Failed to create widget because "attribute" is not set or not exists.';
    }
}
