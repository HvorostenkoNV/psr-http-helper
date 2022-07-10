<?php

declare(strict_types=1);

namespace HNV\Http\Helper\Normalizer\Resource;

use HNV\Http\Helper\Collection\Resource\AccessMode as AccessModeValue;
use HNV\Http\Helper\Normalizer\{
    NormalizerInterface,
    NormalizingException,
};
use ValueError;

use function str_contains;
use function str_replace;

class AccessMode implements NormalizerInterface
{
    private const SPECIAL_FLAG  = 'b';
    private const POSTFIX       = '+';

    /**
     * {@inheritDoc}
     *
     * @param static $value resource access mode string representation
     */
    public static function normalize(mixed $value): AccessModeValue
    {
        $hasPostfix         = str_contains($value, self::POSTFIX);
        $valueClear         = str_replace([self::SPECIAL_FLAG, self::POSTFIX], '', $value);
        $valueNormalized    = $hasPostfix
            ? $valueClear.self::SPECIAL_FLAG.self::POSTFIX
            : $valueClear.self::SPECIAL_FLAG;

        try {
            return AccessModeValue::from($valueNormalized);
        } catch (ValueError) {
            throw new NormalizingException("mode {$value} is unknown");
        }
    }
}
