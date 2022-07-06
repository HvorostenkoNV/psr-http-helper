<?php

declare(strict_types=1);

namespace HNV\Http\Helper\Generator;

use LogicException;

use function is_dir;
use function mkdir;
use function sys_get_temp_dir;
use function uniqid;
use function unlink;

use const DIRECTORY_SEPARATOR;

/**
 * Temporary directory generator.
 */
class Directory extends ClearableGenerator implements GeneratorInterface
{
    /**
     * {@inheritDoc}
     *
     * @return string generated temporary directory path
     */
    public function generate(): string
    {
        $directoryPath = $this->createTemporaryDirectory();

        $this->clear(function () use ($directoryPath): void {
            if (is_dir($directoryPath)) {
                unlink($directoryPath);
            }
        });

        return $directoryPath;
    }

    /**
     * Create temporary directory and get its path.
     */
    private function createTemporaryDirectory(): string
    {
        $temporaryDirectory = sys_get_temp_dir();
        $directoryName      = uniqid('UT', true);
        $directoryPath      = $temporaryDirectory.DIRECTORY_SEPARATOR.$directoryName;
        $creatingSuccess    = mkdir($directoryPath, 0o777, true);

        if ($creatingSuccess === false) {
            throw new LogicException('temporary directory creating failed');
        }

        return $directoryPath;
    }
}
