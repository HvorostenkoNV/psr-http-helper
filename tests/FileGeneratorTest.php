<?php

declare(strict_types=1);

namespace HNV\Http\HelperTests;

use HNV\Http\Helper\Generator\File as FileGenerator;
use PHPUnit\Framework\TestCase;

use function is_file;
use function pathinfo;

use const PATHINFO_EXTENSION;

/**
 * @internal
 * @covers FileGenerator
 * @small
 */
class FileGeneratorTest extends TestCase
{
    /**
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
     * @covers          FileGenerator::generate
     * @dataProvider    dataProviderExtensions
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
