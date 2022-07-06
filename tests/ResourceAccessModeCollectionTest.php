<?php

declare(strict_types=1);

namespace HNV\Http\HelperTests;

use HNV\Http\Helper\Collection\Resource\{
    AccessMode,
    AccessModeType,
};
use HNV\Http\Helper\Generator\File as FileGenerator;
use PHPUnit\Framework\TestCase;

use function fopen;
use function stream_get_meta_data;

/**
 * @internal
 * @covers AccessMode
 * @small
 */
class ResourceAccessModeCollectionTest extends TestCase
{
    /**
     * @covers          AccessMode::get
     * @dataProvider    dataProviderModesSuitable
     */
    public function testSuitable(AccessMode $mode): void
    {
        $file           = (new FileGenerator())->generate();
        $recourse       = fopen($file, $mode->value);
        $recourseData   = stream_get_meta_data($recourse);

        static::assertTrue(
            $recourseData['seekable'],
            'Provided access mode is not readable'
        );
    }

    /**
     * @covers          AccessMode::get
     * @dataProvider    dataProviderModesNotSuitable
     */
    public function testNotSuitable(AccessMode $mode): void
    {
        static::expectWarning();

        $file = (new FileGenerator())->generate();
        fopen($file, $mode->value);
    }

    /**
     * Data provider: resource open modes seekable.
     */
    public function dataProviderModesSuitable(): array
    {
        $result = [];

        foreach (AccessMode::get(AccessModeType::ALL, AccessModeType::EXPECT_NO_FILE) as $mode) {
            $result[] = [$mode];
        }

        return $result;
    }

    /**
     * Data provider: resource open modes NOT seekable.
     */
    public function dataProviderModesNotSuitable(): array
    {
        $result = [];

        foreach (AccessMode::get(AccessModeType::EXPECT_NO_FILE) as $mode) {
            $result[] = [$mode];
        }

        return $result;
    }
}
