<?php
declare(strict_types=1);

namespace HNV\Http\Helper\Generator;

use function str_repeat;
use function rand;
/** ***********************************************************************************************
 * Text generator.
 *
 * @package HNV\Psr\Http\Helper
 * @author  Hvorostenko
 *************************************************************************************************/
class Text implements GeneratorInterface
{
    /** **********************************************************************
     * @inheritDoc
     *
     * @return string                       Generated random text.
     ************************************************************************/
    public function generate(): string
    {
        return str_repeat("data-data\n", rand(5, 15));
    }
}
