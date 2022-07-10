<?php

declare(strict_types=1);

namespace HNV\Http\HelperTests;

use HNV\Http\Helper\Collection\Resource\AccessMode;
use HNV\Http\Helper\Normalizer\{
    NormalizingException,
    Resource\AccessMode as AccessModeNormalizer,
};
use PHPUnit\Framework\{
    Attributes,
    TestCase,
};

/**
 * @internal
 */
#[Attributes\CoversClass(AccessModeNormalizer::class)]
#[Attributes\Small]
class ResourceAccessModeNormalizerTest extends TestCase
{
    #[Attributes\Test]
    #[Attributes\DataProvider('dataProviderModesNormalizable')]
    public function normalize(string $mode, AccessMode $modeNormalized): void
    {
        try {
            static::assertSame(
                $modeNormalized,
                AccessModeNormalizer::normalize($mode)
            );
        } catch (NormalizingException) {
            static::fail('Exception is not expected');
        }
    }

    #[Attributes\Test]
    #[Attributes\DataProvider('dataProviderModesInvalid')]
    public function throwsException(string $mode): void
    {
        $this->expectException(NormalizingException::class);

        AccessModeNormalizer::normalize($mode);
    }

    public function dataProviderModesNormalizable(): array
    {
        return [
            ['r', AccessMode::READ_ONLY_POINTER_START],
            ['rb', AccessMode::READ_ONLY_POINTER_START],

            ['r+', AccessMode::READ_AND_WRITE_POINTER_START],
            ['rb+', AccessMode::READ_AND_WRITE_POINTER_START],

            ['w', AccessMode::WRITE_ONLY_FORCE_CLEAR_FORCE_CREATE],
            ['wb', AccessMode::WRITE_ONLY_FORCE_CLEAR_FORCE_CREATE],

            ['w+', AccessMode::READ_AND_WRITE_FORCE_CLEAR_FORCE_CREATE],
            ['wb+', AccessMode::READ_AND_WRITE_FORCE_CLEAR_FORCE_CREATE],

            ['a', AccessMode::WRITE_ONLY_POINTER_END_FORCE_CREATE],
            ['ab', AccessMode::WRITE_ONLY_POINTER_END_FORCE_CREATE],

            ['a+', AccessMode::READ_AND_WRITE_POINTER_END_FORCE_CREATE],
            ['ab+', AccessMode::READ_AND_WRITE_POINTER_END_FORCE_CREATE],

            ['x', AccessMode::WRITE_ONLY_POINTER_START_EXPECT_NO_FILE],
            ['xb', AccessMode::WRITE_ONLY_POINTER_START_EXPECT_NO_FILE],

            ['x+', AccessMode::READ_AND_WRITE_POINTER_START_EXPECT_NO_FILE],
            ['xb+', AccessMode::READ_AND_WRITE_POINTER_START_EXPECT_NO_FILE],

            ['c', AccessMode::WRITE_ONLY_POINTER_START_FORCE_CREATE],
            ['cb', AccessMode::WRITE_ONLY_POINTER_START_FORCE_CREATE],

            ['c+', AccessMode::READ_AND_WRITE_POINTER_START_FORCE_CREATE],
            ['cb+', AccessMode::READ_AND_WRITE_POINTER_START_FORCE_CREATE],
        ];
    }

    public function dataProviderModesInvalid(): array
    {
        return [
            ['someValue1'],
            ['someValue2'],
            ['someValue3'],
        ];
    }
}
