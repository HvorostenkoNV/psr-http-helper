<?php

declare(strict_types=1);

namespace HNV\Http\HelperTests;

use HNV\Http\Helper\Generator\Text as TextGenerator;
use PHPUnit\Framework\TestCase;

use function in_array;
use function strlen;

/**
 * @internal
 * @covers TextGenerator
 * @small
 */
class TextGeneratorTest extends TestCase
{
    /**
     * @covers Text::generate
     */
    public function testProvidesAnyValue(): void
    {
        $generator  = new TextGenerator();
        $value      = $generator->generate();

        static::assertTrue(
            strlen($value) > 0,
            'Provided value is empty string'
        );
    }

    /**
     * @covers Text::generate
     */
    public function testProvidesRandomValue(): void
    {
        $generator  = new TextGenerator();
        $values     = [];

        for ($iteration = 1; $iteration <= 100000; $iteration++) {
            $value          = $generator->generate();
            $values[$value] ??= 0;
            $values[$value]++;
        }

        static::assertTrue(
            !in_array(2, $values, true),
            'Text generating randomizing is not enough'
        );
    }
}
