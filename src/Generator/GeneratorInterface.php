<?php

declare(strict_types=1);

namespace HNV\Http\Helper\Generator;

/**
 * Generator interface.
 */
interface GeneratorInterface
{
    /**
     * Generate data.
     */
    public function generate(): mixed;
}
