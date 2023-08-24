<?php

declare(strict_types=1);

namespace PHPForge\Widget;

use RuntimeException;

use function array_pop;
use function get_class;

abstract class Block extends Base\Widget implements BlockInterface
{
    /**
     * The widgets that are currently opened and not yet closed.
     * This property is maintained by {@see begin()} and {@see end()} methods.
     *
     * @var static[]
     */
    private static array $stack = [];
    private bool $beginExecuted = false;

    public function begin(): string
    {
        self::$stack[] = $this;
        $this->beginExecuted = true;

        return '';
    }

    final public static function end(): string
    {
        $class = static::class;

        if (self::$stack === []) {
            throw new RuntimeException("Unexpected $class::end() call. A matching begin() is not found.");
        }

        $widget = array_pop(self::$stack);
        $widgetClass = get_class($widget);

        if ($widgetClass !== static::class) {
            throw new RuntimeException("Expecting end() of $widgetClass found $class.");
        }

        return $widget->render();
    }

    public function isBeginExecuted(): bool
    {
        return $this->beginExecuted;
    }

    final public function render(): string
    {
        if (!$this->beforeRun()) {
            return '';
        }

        return $this->afterRun($this->run());
    }
}
