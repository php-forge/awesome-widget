<?php

declare(strict_types=1);

namespace PHPForge\Widget\Factory;

use PHPForge\Widget\Base\Widget;

use function call_user_func_array;
use function str_ends_with;
use function substr;

final class SimpleFactory
{
    public static function factory(array $definitions, Widget $widget): Widget
    {
        /**
         * @var array<string, mixed> $definitions
         * @var mixed $arguments
         */
        foreach ($definitions as $action => $arguments) {
            if (str_ends_with($action, '()')) {
                /** @psalm-var mixed $setter */
                $setter = call_user_func_array([$widget, substr($action, 0, -2)], $arguments);

                if ($setter instanceof $widget) {
                    /** @psalm-var object $widget */
                    $widget = $setter;
                }
            }
        }

        /** @psalm-var Widget $widget */
        return $widget;
    }
}
