<?php
declare(strict_types=1);

namespace HNV\Http\Helper\Generator;

use LogicException;

use function is_dir;
use function mkdir;
use function unlink;
use function sys_get_temp_dir;
use function uniqid;

use const DIRECTORY_SEPARATOR;
/** ***********************************************************************************************
 * Temporary directory generator.
 *
 * @package HNV\Psr\Http\Helper
 * @author  Hvorostenko
 *************************************************************************************************/
class Directory extends AbstractGenerator implements GeneratorInterface
{
    /** **********************************************************************
     * @inheritDoc
     *
     * @return string                       Generated temporary directory path.
     ************************************************************************/
    public function generate(): string
    {
        $temporaryDirectory = sys_get_temp_dir();
        $directoryName      = uniqid('UT', true);
        $directoryPath      = $temporaryDirectory.DIRECTORY_SEPARATOR.$directoryName;
        $creatingSuccess    = mkdir($directoryPath, 0777, true);

        if ($creatingSuccess === false) {
            throw new LogicException('temporary directory creating failed');
        }

        $this->clear(function() use ($directoryPath) {
            if (is_dir($directoryPath)) {
                unlink($directoryPath);
            }
        });

        return $directoryPath;
    }
}
