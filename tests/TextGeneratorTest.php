<?php
declare(strict_types=1);

namespace HNV\Http\HelperTests;

use Throwable;
use PHPUnit\Framework\TestCase;
use HNV\Http\Helper\Generator\Text as TextGenerator;

use function strlen;
/** ***********************************************************************************************
 * Text generator test.
 *
 * @package HNV\Psr\Http\Tests\Helper
 * @author  Hvorostenko
 *************************************************************************************************/
class TextGeneratorTest extends TestCase
{
    /** **********************************************************************
     * Test "Text::generate" provides any text value.
     *
     * @covers  Text::generate
     *
     * @return  void
     * @throws  Throwable
     ************************************************************************/
    public function testProvidesNewInstance(): void
    {
        $generator  = new TextGenerator();
        $value      = $generator->generate();

        self::assertTrue(
            strlen($value) > 0
        );
    }
}
