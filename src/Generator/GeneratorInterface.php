<?php
declare(strict_types=1);

namespace HNV\Http\Helper\Generator;
/** ***********************************************************************************************
 * Generator interface.
 *
 * @package HNV\Psr\Http\Helper
 * @author  Hvorostenko
 *************************************************************************************************/
interface GeneratorInterface
{
    /** **********************************************************************
     * Generate data.
     *
     * @return  mixed                       Generation result.
     ************************************************************************/
    public function generate(): mixed;
}