<?php
declare(strict_types=1);

namespace HNV\Http\Helper\Collection;

use function count;
/** ***********************************************************************************************
 * Abstract collection, provides collection caching functionality.
 *
 * @package HNV\Psr\Http\Helper
 * @author  Hvorostenko
 *************************************************************************************************/
abstract class AbstractCollection implements CollectionInterface
{
    private static array $collection = [];
    /** **********************************************************************
     * @inheritDoc
     ************************************************************************/
    public static function get(): array
    {
        if (count(self::$collection) === 0) {
            self::$collection = self::create();
        }

        return self::$collection;
    }
    /** **********************************************************************
     * Create collection.
     *
     * @return  array                       Created collection data.
     ************************************************************************/
    protected static function create(): array
    {
        return [];
    }
}