<?php

declare(strict_types=1);

namespace HNV\Http\Helper\Normalizer;

interface NormalizerInterface
{
    /**
     * Normalize data.
     *
     * @throws NormalizingException normalizing error
     */
    public static function normalize(mixed $value): mixed;
}
