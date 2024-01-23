<?php

declare(strict_types=1);

namespace PHPForge\Widget\Tests\Factory;

use InvalidArgumentException;
use PHPForge\Widget\Factory\SimpleFactory;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    public function testConfigure(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'The provided widget must be an instance of "PHPForge\Widget\Base\Widget", "stdClass" given.'
        );

        SimpleFactory::configure(
            new stdClass(),
            [
                'id()' => ['id-configure'],
            ]
        );
    }
}
