<?php

declare(strict_types=1);

namespace HNV\Http\HelperTests;

use HNV\Http\Helper\Generator\Directory as DirectoryGenerator;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @covers DirectoryGenerator
 * @small
 */
class DirectoryGeneratorTest extends TestCase
{
    /**
     * @covers DirectoryGenerator::generate
     */
    public function testProvidesAnyValue(): void
    {
        $generator  = new DirectoryGenerator();
        $directory  = $generator->generate();

        static::assertDirectoryExists(
            $directory,
            'Provided value is not a directory'
        );
    }

    /**
     * @covers DirectoryGenerator::generate
     */
    public function testProvidesDirectoryInSuitableState(): void
    {
        $generator  = new DirectoryGenerator();
        $directory  = $generator->generate();

        static::assertIsReadable(
            $directory,
            'Provided directory is not readable'
        );
        static::assertIsWritable(
            $directory,
            'Provided directory is not writable'
        );
    }
}
