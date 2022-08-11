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
use PHPUnit\Framework\{
    Attributes,
    TestCase,
};

use function is_resource;
use function stream_get_meta_data;

/**
 * @internal
 */
#[Attributes\CoversClass(ResourceGenerator::class)]
#[Attributes\Small]
class ResourceGeneratorTest extends TestCase
{
    #[Attributes\Test]
    public function generate(): void
    {
        $file       = (new FileGenerator())->generate();
        $generator  = new ResourceGenerator($file, AccessMode::READ_ONLY_POINTER_START);
        $recourse   = $generator->generate();

        static::assertTrue(
            is_resource($recourse),
            'Generated data is not a resource'
        );
    }

    #[Attributes\Test]
    #[Attributes\DataProvider('dataProviderModes')]
    public function generatedResourceIsSuitable(AccessMode $mode): void
    {
        $file           = (new FileGenerator())->generate();
        $generator      = new ResourceGenerator($file, $mode);
        $recourse       = $generator->generate();
        $recourseData   = stream_get_meta_data($recourse);

        static::assertSame(
            $recourseData['mode'],
            $mode->value,
            'Generated recourse has not the same access mode as expects'
        );
        static::assertTrue(
            $recourseData['seekable'],
            'Generated recourse is not seekable as it should be'
        );
    }

    public function dataProviderModes(): iterable
    {
        foreach (AccessMode::get(AccessModeType::ALL, AccessModeType::EXPECT_NO_FILE) as $mode) {
            yield [$mode];
        }
    }
}
