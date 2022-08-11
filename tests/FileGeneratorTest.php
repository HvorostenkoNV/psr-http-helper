<?php

declare(strict_types=1);

namespace HNV\Http\HelperTests;

use HNV\Http\Helper\Generator\File as FileGenerator;
use PHPUnit\Framework\{
    Attributes,
    TestCase,
};

use function is_file;
use function pathinfo;

use const PATHINFO_EXTENSION;

/**
 * @internal
 */
#[Attributes\CoversClass(FileGenerator::class)]
#[Attributes\Small]
class FileGeneratorTest extends TestCase
{
    #[Attributes\Test]
    public function generate(): void
    {
        $generator  = new FileGenerator();
        $file       = $generator->generate();

        static::assertTrue(
            is_file($file),
            'Generated data is not a file'
        );
    }

    #[Attributes\Test]
    public function generatedFileIsSuitable(): void
    {
        $generator  = new FileGenerator();
        $file       = $generator->generate();

        static::assertIsReadable(
            $file,
            'Generated file is not readable'
        );
        static::assertIsWritable(
            $file,
            'Generated file is not writable'
        );
    }

    #[Attributes\Test]
    #[Attributes\DataProvider('dataProviderExtensions')]
    public function generatedFileExtension(string $extension): void
    {
        $generator  = new FileGenerator($extension);
        $file       = $generator->generate();

        static::assertSame(
            $extension,
            pathinfo($file, PATHINFO_EXTENSION),
            'Generated file has not the same extension as expects'
        );
    }

    #[Attributes\Test]
    public function generatedFileWithoutExtension(): void
    {
        $generator  = new FileGenerator();
        $file       = $generator->generate();

        static::assertSame(
            '',
            pathinfo($file, PATHINFO_EXTENSION),
            'Generated file has any extension, while must be without it'
        );
    }

    public function dataProviderExtensions(): iterable
    {
        yield ['xxx'];
        yield ['yyy'];
        yield ['jpg'];
        yield ['txt'];
        yield ['ts'];
        yield ['nx'];
    }
}
