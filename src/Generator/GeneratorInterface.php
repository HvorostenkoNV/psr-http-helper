<?php

declare(strict_types=1);

namespace HNV\Http\Helper\Generator;

interface GeneratorInterface
{
    /**
     * Generate any data.
     */
    public function generate(): mixed;
}
