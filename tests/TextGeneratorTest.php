<?php
declare(strict_types=1);

namespace HNV\Http\HelperTests;

use Throwable;
use PHPUnit\Framework\TestCase;
use HNV\Http\Helper\Generator\Text as TextGenerator;

use function strlen;
use function in_array;
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
    public function testProvidesAnyValue(): void
    {
        $generator  = new TextGenerator();
        $value      = $generator->generate();

        self::assertTrue(
            strlen($value) > 0,
            'Provided value is empty string'
        );
    }
    /** **********************************************************************
     * Test "Text::generate" provides not enough random value.
     *
     * @covers  Text::generate
     *
     * @return  void
     * @throws  Throwable
     ************************************************************************/
    public function testProvidesRandomValue(): void
    {
        $generator  = new TextGenerator();
        $values     = [];

        for ($iteration = 1; $iteration <= 100000; $iteration++) {
            $value          = $generator->generate();
            $values[$value] = $values[$value] ?? 0;
            $values[$value]++;
        }

        self::assertTrue(
            !in_array(2, $values),
            'Text generating randomizing is not enough'
        );
    }
}
