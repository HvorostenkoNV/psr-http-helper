<?php

declare(strict_types = 1);

namespace HNV\Http\Helper\Collection;

use function array_column;

/**
 * Enumeration values primitives set provider helper.
 *
 * @method static array cases()
 */
trait CasesValuesProviderTrait
{
    /**
     * @return array
     */
    public static function casesValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
