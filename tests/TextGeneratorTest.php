<?php

declare(strict_types=1);

namespace HNV\Http\HelperTests;

use HNV\Http\Helper\Generator\Text as TextGenerator;
use PHPUnit\Framework\{
    Attributes,
    TestCase,
};

use function in_array;
use function strlen;

/**
 * @internal
 */
#[Attributes\CoversClass(TextGenerator::class)]
#[Attributes\Small]
class TextGeneratorTest extends TestCase
{
    #[Attributes\Test]
    public function generate(): void
    {
        $generator  = new TextGenerator();
        $value      = $generator->generate();

        static::assertTrue(
            strlen($value) > 0,
            'Generated data is empty string'
        );
    }

    #[Attributes\Test]
    public function generatesRandomValue(): void
    {
        $generator  = new TextGenerator();
        $values     = [];

        for ($iteration = 1; $iteration <= 100000; $iteration++) {
            $value = $generator->generate();
            $values[$value] ??= 0;
            $values[$value]++;
        }

        static::assertTrue(
            !in_array(2, $values, true),
            'Text generating randomizing is not enough'
        );
    }
}
