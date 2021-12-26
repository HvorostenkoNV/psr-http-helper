<?php
declare(strict_types=1);

namespace HNV\Http\HelperTests;

use Throwable;
use PHPUnit\Framework\TestCase;
use HNV\Http\Helper\Generator\Directory as DirectoryGenerator;

use function is_dir;
use function is_readable;
use function is_writable;
/** ***********************************************************************************************
 * Directory generator test.
 *
 * @package HNV\Psr\Http\Tests\Helper
 * @author  Hvorostenko
 *************************************************************************************************/
class DirectoryGeneratorTest extends TestCase
{
    /** **********************************************************************
     * Test "DirectoryGenerator::generate" provides any directory.
     *
     * @covers  DirectoryGenerator::generate
     *
     * @return  void
     * @throws  Throwable
     ************************************************************************/
    public function testProvidesAnyValue(): void
    {
        $generator  = new DirectoryGenerator();
        $directory  = $generator->generate();

        self::assertTrue(
            is_dir($directory),
            'Provided value is not a directory'
        );
    }
    /** **********************************************************************
     * Test "DirectoryGenerator::generate" provides directory in expected condition.
     *
     * @covers  DirectoryGenerator::generate
     *
     * @return  void
     * @throws  Throwable
     ************************************************************************/
    public function testProvidesDirectoryInSuitableState(): void
    {
        $generator  = new DirectoryGenerator();
        $directory  = $generator->generate();

        self::assertTrue(
            is_readable($directory),
            'Provided directory is not readable'
        );
        self::assertTrue(
            is_writable($directory),
            'Provided directory is not writable'
        );
    }
}
