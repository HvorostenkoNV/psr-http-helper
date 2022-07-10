<?php

declare(strict_types=1);

namespace HNV\Http\Helper\Generator;

use LogicException;

use function is_file;
use function rename;
use function strlen;
use function sys_get_temp_dir;
use function tempnam;
use function unlink;

class File extends ClearableGenerator implements GeneratorInterface
{
    public function __construct(private readonly string $extension = '')
    {
    }

    /**
     * {@inheritDoc}
     *
     * @return string generated temporary file path
     */
    public function generate(): string
    {
        $filePath           = $this->createTemporaryFile();
        $filePathComplete   = strlen($this->extension) > 0
            ? $this->addTemporaryFileExtension($filePath, $this->extension)
            : $filePath;

        $this->clear(function () use ($filePathComplete): void {
            if (is_file($filePathComplete)) {
                unlink($filePathComplete);
            }
        });

        return $filePathComplete;
    }

    private function createTemporaryFile(): string
    {
        $temporaryDirectory = sys_get_temp_dir();
        $temporaryFile      = tempnam($temporaryDirectory, 'UT');

        if ($temporaryFile === false) {
            throw new LogicException('temporary file creating failed');
        }

        return $temporaryFile;
    }

    private function addTemporaryFileExtension(string $filePath, string $extension): string
    {
        $filePathWithExtension  = "{$filePath}.{$extension}";
        $renameSuccess          = rename($filePath, $filePathWithExtension);

        if ($renameSuccess === false) {
            throw new LogicException('file renaming failed');
        }

        return $filePathWithExtension;
    }
}
