<?php

declare(strict_types=1);

namespace HNV\Http\HelperTests;

use HNV\Http\Helper\Collection\Resource\{
    AccessMode,
    AccessModeType,
};
use HNV\Http\Helper\Generator\{
    File        as FileGenerator,
    Resource    as ResourceGenerator,
};
use PHPUnit\Framework\TestCase;

use function is_resource;
use function stream_get_meta_data;

/**
 * @internal
 * @covers ResourceGenerator
 * @small
 */
class ResourceGeneratorTest extends TestCase
{
    /**
     * @covers ResourceGenerator::generate
     */
    public function testProvidesAnyValue(): void
    {
        $file       = (new FileGenerator())->generate();
        $generator  = new ResourceGenerator($file, AccessMode::READ_ONLY_POINTER_START);
        $recourse   = $generator->generate();

        static::assertTrue(
            is_resource($recourse),
            'Provided value is not a resource'
        );
    }

    /**
     * @covers          ResourceGenerator::generate
     * @dataProvider    dataProviderRecourseOpenModes
     */
    public function testProvidesRecourseInSuitableState(AccessMode $mode): void
    {
        $file           = (new FileGenerator())->generate();
        $generator      = new ResourceGenerator($file, $mode);
        $recourse       = $generator->generate();
        $recourseData   = stream_get_meta_data($recourse);

        static::assertSame(
            $recourseData['mode'],
            $mode->value,
            'Provided recourse with not the same mode'
        );
        static::assertTrue(
            $recourseData['seekable'],
            'Provided recourse is not seekable as it should be'
        );
    }

    /**
     * Data provider: resource open modes.
     */
    public function dataProviderRecourseOpenModes(): array
    {
        $result = [];

        foreach (AccessMode::get(AccessModeType::ALL, AccessModeType::EXPECT_NO_FILE) as $mode) {
            $result[] = [$mode];
        }

        return $result;
    }
}
