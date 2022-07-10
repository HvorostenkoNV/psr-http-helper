<?php

declare(strict_types=1);

namespace HNV\Http\HelperTests;

use HNV\Http\Helper\Collection\Resource\{
    AccessMode,
    AccessModeType,
};
use HNV\Http\Helper\Generator\File as FileGenerator;
use PHPUnit\Framework\{
    Attributes,
    TestCase,
};

use function fopen;
use function stream_get_meta_data;

/**
 * @internal
 */
#[Attributes\CoversClass(AccessMode::class)]
#[Attributes\Small]
class ResourceAccessModeCollectionTest extends TestCase
{
    #[Attributes\Test]
    #[Attributes\DataProvider('dataProviderModesSuitable')]
    public function suitable(AccessMode $mode): void
    {
        $file           = (new FileGenerator())->generate();
        $recourse       = fopen($file, $mode->value);
        $recourseData   = stream_get_meta_data($recourse);

        static::assertTrue(
            $recourseData['seekable'],
            "Access mode [{$mode->value}] should allow resource to be readable"
        );
    }

    #[Attributes\Test]
    #[Attributes\DataProvider('dataProviderModesNotSuitable')]
    public function notSuitable(AccessMode $mode): void
    {
        $this->expectWarning();

        $file = (new FileGenerator())->generate();
        fopen($file, $mode->value);

        static::fail("Expects PHP warning using access mode [{$mode->value}]");
    }

    public function dataProviderModesSuitable(): array
    {
        $result = [];

        foreach (AccessMode::get(AccessModeType::ALL, AccessModeType::EXPECT_NO_FILE) as $mode) {
            $result[] = [$mode];
        }

        return $result;
    }

    public function dataProviderModesNotSuitable(): array
    {
        $result = [];

        foreach (AccessMode::get(AccessModeType::EXPECT_NO_FILE) as $mode) {
            $result[] = [$mode];
        }

        return $result;
    }
}
