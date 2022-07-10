<?php

declare(strict_types=1);

namespace HNV\Http\HelperTests;

use HNV\Http\Helper\Generator\Directory as DirectoryGenerator;
use PHPUnit\Framework\{
    Attributes,
    TestCase,
};

/**
 * @internal
 */
#[Attributes\CoversClass(DirectoryGenerator::class)]
#[Attributes\Small]
class DirectoryGeneratorTest extends TestCase
{
    #[Attributes\Test]
    public function generate(): void
    {
        $generator  = new DirectoryGenerator();
        $directory  = $generator->generate();

        static::assertDirectoryExists(
            $directory,
            'Generated data is not a directory'
        );
    }

    #[Attributes\Test]
    public function generatedDirectoryIsSuitable(): void
    {
        $generator  = new DirectoryGenerator();
        $directory  = $generator->generate();

        static::assertIsReadable(
            $directory,
            'Generated directory is not readable'
        );
        static::assertIsWritable(
            $directory,
            'Generated directory is not writable'
        );
    }
}
