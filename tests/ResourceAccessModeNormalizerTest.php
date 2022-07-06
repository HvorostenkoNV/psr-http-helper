<?php

declare(strict_types=1);

namespace HNV\Http\HelperTests;

use HNV\Http\Helper\Collection\Resource\AccessMode;
use HNV\Http\Helper\Normalizer\{
    NormalizingException,
    Resource\AccessMode as AccessModeNormalizer,
};
use PHPUnit\Framework\TestCase;

/**
 * @internal
 * @covers AccessModeNormalizer
 * @small
 */
class ResourceAccessModeNormalizerTest extends TestCase
{
    /**
     * @covers          AccessModeNormalizer::normalize
     * @dataProvider    dataProviderModesNormalizable
     */
    public function testNormalize(string $mode, AccessMode $modeNormalized): void
    {
        try {
            static::assertSame(
                $modeNormalized,
                AccessModeNormalizer::normalize($mode),
                'Normalized access mode is not as expected'
            );
        } catch (NormalizingException) {
            static::fail('Exception is not expected');
        }
    }

    /**
     * @covers          AccessModeNormalizer::normalize
     * @dataProvider    dataProviderModesInvalid
     */
    public function testThrowsException(string $mode): void
    {
        $this->expectException(NormalizingException::class);

        AccessModeNormalizer::normalize($mode);

        static::fail("access mode [{$mode}] is invalid and expects exception");
    }

    /**
     * Data provider: resource open modes and their normalized representations.
     */
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

    /**
     * Data provider: resource open modes invalid values.
     */
    public function dataProviderModesInvalid(): array
    {
        return [
            ['someValue1'],
            ['someValue2'],
            ['someValue3'],
        ];
    }
}
