<?php

declare(strict_types=1);

namespace HNV\Http\HelperTests;

use HNV\Http\Helper\Generator\File as FileGenerator;
use PHPUnit\Framework\TestCase;

use function is_file;
use function pathinfo;

use const PATHINFO_EXTENSION;

/**
 * File generator test.
 *
 * @internal
 * @covers FileGenerator
 * @small
 */
class FileGeneratorTest extends TestCase
{
    /**
     * Test "FileGenerator::generate" provides any file.
     *
     * @covers FileGenerator::generate
     */
    public function testProvidesAnyValue(): void
    {
        $generator  = new FileGenerator();
        $file       = $generator->generate();

        static::assertTrue(
            is_file($file),
            'Provided value is not a file'
        );
    }

    /**
     * Test "FileGenerator::generate" provides file in expected condition.
     *
     * @covers FileGenerator::generate
     */
    public function testProvidesFileInSuitableState(): void
    {
        $generator  = new FileGenerator();
        $file       = $generator->generate();

        static::assertIsReadable(
            $file,
            'Provided file is not readable'
        );
        static::assertIsWritable(
            $file,
            'Provided file is not writable'
        );
    }

    /**
     * Test "FileGenerator::generate" provides file with extension, that was given.
     *
     * @covers          FileGenerator::generate
     * @dataProvider    dataProviderExtensions
     *
     * @param string $extension file extension
     */
    public function testProvidesFileWithGivenExtension(string $extension): void
    {
        $generator  = new FileGenerator($extension);
        $file       = $generator->generate();

        static::assertSame(
            $extension,
            pathinfo($file, PATHINFO_EXTENSION),
            'Provided file has not the same extension, as given'
        );
    }

    /**
     * Test "FileGenerator::generate" provides file with no extension, if it was not given.
     *
     * @covers FileGenerator::generate
     */
    public function testProvidesFileWithoutExtension(): void
    {
        $generator  = new FileGenerator();
        $file       = $generator->generate();

        static::assertSame(
            '',
            pathinfo($file, PATHINFO_EXTENSION),
            'Provided file has any extension, while must be without it'
        );
    }

    /**
     * Data provider: files extensions.
     *
     * @return array data
     */
    public function dataProviderExtensions(): array
    {
        return [
            ['xxx'],
            ['yyy'],
            ['jpg'],
            ['txt'],
            ['ts'],
            ['nx'],
        ];
    }
}
