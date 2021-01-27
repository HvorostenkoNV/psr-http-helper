<?php
declare(strict_types=1);

namespace HNV\Http\Helper\Normalizer;
/** ***********************************************************************************************
 * Normalizer interface.
 *
 * @package HNV\Psr\Http\Helper
 * @author  Hvorostenko
 *************************************************************************************************/
interface NormalizerInterface
{
    /** **********************************************************************
     * Normalize data.
     *
     * @param   mixed $value                Value.
     *
     * @return  mixed                       Normalized value.
     * @throws  NormalizingException        Normalizing error.
     ************************************************************************/
    public static function normalize(mixed $value): mixed;
}