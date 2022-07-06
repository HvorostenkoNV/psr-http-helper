<?php

declare(strict_types=1);

namespace HNV\Http\HelperTests;

use HNV\Http\Helper\Generator\{
    File        as FileGenerator,
    Resource    as ResourceGenerator,
};
use PHPUnit\Framework\TestCase;

use function is_resource;
use function stream_get_meta_data;

/**
 * Resource generator test.
 *
 * @internal
 * @covers ResourceGenerator
 * @small
 */
class ResourceGeneratorTest extends TestCase
{
    /**
     * Test "ResourceGenerator::generate" provides any recourse.
     *
     * @covers ResourceGenerator::generate
     */
    public function testProvidesAnyValue(): void
    {
        $file       = (new FileGenerator())->generate();
        $generator  = new ResourceGenerator($file, 'r');
        $recourse   = $generator->generate();

        static::assertTrue(
            is_resource($recourse),
            'Provided value is not a resource'
        );
    }

    /**
     * Test "ResourceGenerator::generate" provides recourse in expected condition.
     *
     * @covers          ResourceGenerator::generate
     * @dataProvider    dataProviderRecourseOpenModes
     *
     * @param string $mode resource open mode
     */
    public function testProvidesRecourseInSuitableState(string $mode): void
    {
        $file           = (new FileGenerator())->generate();
        $generator      = new ResourceGenerator($file, $mode);
        $recourse       = $generator->generate();
        $recourseData   = stream_get_meta_data($recourse);

        static::assertSame(
            $recourseData['mode'],
            $mode,
            'Provided recourse with not the same mode'
        );
    }

    /**
     * Data provider: resource open modes.
     *
     * @return array data
     */
    public function dataProviderRecourseOpenModes(): array
    {
        return [
            ['r'],
            ['w'],
            ['a'],
        ];
    }
}
