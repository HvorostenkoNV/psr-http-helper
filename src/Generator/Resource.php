<?php
declare(strict_types=1);

namespace HNV\Http\Helper\Generator;

use LogicException;

use function is_resource;
use function fopen;
use function fclose;
/** ***********************************************************************************************
 * Single resource generator.
 *
 * @package HNV\Psr\Http\Helper
 * @author  Hvorostenko
 *************************************************************************************************/
class Resource extends AbstractGenerator implements GeneratorInterface
{
    /** **********************************************************************
     * Constructor.
     *
     * @param string    $file               File path.
     * @param string    $mode               Resource access mode.
     ************************************************************************/
    public function __construct(public string $file, public string $mode) {}
    /** **********************************************************************
     * @inheritDoc
     *
     * @return resource                     Generated resource.
     ************************************************************************/
    public function generate(): mixed
    {
        $resource = fopen($this->file, $this->mode);

        if ($resource === false) {
            throw new LogicException(
                "resource creating failed, access mode is \"$this->mode\""
            );
        }

        $this->clear(function() use ($resource) {
            if (is_resource($resource)) {
                fclose($resource);
            }
        });

        return $resource;
    }
}
