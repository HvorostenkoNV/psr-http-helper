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

    public function dataProviderModesNormalizable(): iterable
    {
        yield ['r', AccessMode::READ_ONLY_POINTER_START];
        yield ['rb', AccessMode::READ_ONLY_POINTER_START];

        yield ['r+', AccessMode::READ_AND_WRITE_POINTER_START];
        yield ['rb+', AccessMode::READ_AND_WRITE_POINTER_START];

        yield ['w', AccessMode::WRITE_ONLY_FORCE_CLEAR_FORCE_CREATE];
        yield ['wb', AccessMode::WRITE_ONLY_FORCE_CLEAR_FORCE_CREATE];

        yield ['w+', AccessMode::READ_AND_WRITE_FORCE_CLEAR_FORCE_CREATE];
        yield ['wb+', AccessMode::READ_AND_WRITE_FORCE_CLEAR_FORCE_CREATE];

        yield ['a', AccessMode::WRITE_ONLY_POINTER_END_FORCE_CREATE];
        yield ['ab', AccessMode::WRITE_ONLY_POINTER_END_FORCE_CREATE];

        yield ['a+', AccessMode::READ_AND_WRITE_POINTER_END_FORCE_CREATE];
        yield ['ab+', AccessMode::READ_AND_WRITE_POINTER_END_FORCE_CREATE];

        yield ['x', AccessMode::WRITE_ONLY_POINTER_START_EXPECT_NO_FILE];
        yield ['xb', AccessMode::WRITE_ONLY_POINTER_START_EXPECT_NO_FILE];

        yield ['x+', AccessMode::READ_AND_WRITE_POINTER_START_EXPECT_NO_FILE];
        yield ['xb+', AccessMode::READ_AND_WRITE_POINTER_START_EXPECT_NO_FILE];

        yield ['c', AccessMode::WRITE_ONLY_POINTER_START_FORCE_CREATE];
        yield ['cb', AccessMode::WRITE_ONLY_POINTER_START_FORCE_CREATE];

        yield ['c+', AccessMode::READ_AND_WRITE_POINTER_START_FORCE_CREATE];
        yield ['cb+', AccessMode::READ_AND_WRITE_POINTER_START_FORCE_CREATE];
    }

    public function dataProviderModesInvalid(): iterable
    {
        yield ['someValue1'];
        yield ['someValue2'];
        yield ['someValue3'];
    }
}
