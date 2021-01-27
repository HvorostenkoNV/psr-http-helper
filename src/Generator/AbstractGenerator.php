<?php
declare(strict_types=1);

namespace HNV\Http\Helper\Generator;

use function register_shutdown_function;
/** ***********************************************************************************************
 * Generator interface.
 *
 * @package HNV\Psr\Http\Helper
 * @author  Hvorostenko
 *************************************************************************************************/
abstract class AbstractGenerator implements GeneratorInterface
{
    /** **********************************************************************
     * Set clearing callback function, that will be processed on program close.
     *
     * @param   callable $callback          Callback.
     *
     * @return  void
     ************************************************************************/
    protected function clear(callable $callback): void
    {
        register_shutdown_function($callback);
    }
}