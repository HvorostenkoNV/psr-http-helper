<?php
declare(strict_types=1);

namespace HNV\Http\Helper\Collection;
/** ***********************************************************************************************
 * Special character`s collection.
 *
 * @package HNV\Psr\Http\Helper
 * @author  Hvorostenko
 *************************************************************************************************/
class SpecialCharacters implements CollectionInterface
{
    /** **********************************************************************
     * @inheritDoc
     ************************************************************************/
    public static function get(): array
    {
        return [
            '`', '\'', '"',

            '[', ']',
            '{', '}',
            '(', ')',

            '\\', '|', '/',

            '+', '-', '=',
            '*', '%',

            '^', '<', '>',

            ',', '.', ':', ';',

            '~', '!', '@',
            '#', '№', '$',
            '&', '?', '_',
        ];
    }
}
