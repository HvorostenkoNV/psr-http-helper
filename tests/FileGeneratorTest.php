<?php
declare(strict_types=1);

namespace HNV\Http\HelperTests;

use Throwable;
use PHPUnit\Framework\TestCase;
use HNV\Http\Helper\Generator\File as FileGenerator;

use function is_file;
use function is_readable;
use function is_writable;
use function pathinfo;

use const PATHINFO_EXTENSION;
/** ***********************************************************************************************
 * File generator test.
 *
 * @package HNV\Psr\Http\Tests\Helper
 * @author  Hvorostenko
 *************************************************************************************************/
class FileGeneratorTest extends TestCase
{
    /** **********************************************************************
     * Test "FileGenerator::generate" provides any file.
     *
     * @covers  FileGenerator::generate
     *
     * @return  void
     * @throws  Throwable
     ************************************************************************/
    public function testProvidesAnyValue(): void
    {
        $generator  = new FileGenerator();
        $file       = $generator->generate();

        self::assertTrue(
            is_file($file),
            'Provided value is not a file'
        );
    }
    /** **********************************************************************
     * Test "FileGenerator::generate" provides file in expected condition.
     *
     * @covers  FileGenerator::generate
     *
     * @return  void
     * @throws  Throwable
     ************************************************************************/
    public function testProvidesFileInSuitableState(): void
    {
        $generator  = new FileGenerator();
        $file       = $generator->generate();

        self::assertTrue(
            is_readable($file),
            'Provided file is not readable'
        );
        self::assertTrue(
            is_writable($file),
            'Provided file is not writable'
        );
    }
    /** **********************************************************************
     * Test "FileGenerator::generate" provides file with extension, that was given.
     *
     * @covers          FileGenerator::generate
     * @dataProvider    dataProviderExtensions
     *
     * @param           string $extension   File extension.
     *
     * @return          void
     * @throws          Throwable
     ************************************************************************/
    public function testProvidesFileWithGivenExtension(string $extension): void
    {
        $generator  = new FileGenerator($extension);
        $file       = $generator->generate();

        self::assertEquals(
            $extension,
            pathinfo($file, PATHINFO_EXTENSION),
            'Provided file has not the same extension, as given'
        );
    }
    /** **********************************************************************
     * Test "FileGenerator::generate" provides file with no extension, if it was not given.
     *
     * @covers  FileGenerator::generate
     *
     * @return  void
     * @throws  Throwable
     ************************************************************************/
    public function testProvidesFileWithoutExtension(): void
    {
        $generator  = new FileGenerator();
        $file       = $generator->generate();

        self::assertEquals(
            '',
            pathinfo($file, PATHINFO_EXTENSION),
            'Provided file has any extension, while must be without it'
        );
    }
    /** **********************************************************************
     * Data provider: files extensions.
     *
     * @return  array                       Data.
     ************************************************************************/
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
