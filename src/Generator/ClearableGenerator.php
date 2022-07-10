<?php

declare(strict_types=1);

namespace HNV\Http\Helper\Generator;

use function register_shutdown_function;

/**
 * Clearable abstract generator.
 *
 * Provides functionality to control and clear data after program ends.
 */
abstract class ClearableGenerator
{
    protected function clear(callable $callback): void
    {
        register_shutdown_function($callback);
    }
}
