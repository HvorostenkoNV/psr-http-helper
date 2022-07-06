<?php

declare(strict_types=1);

namespace HNV\Http\Helper\Collection\Resource;

use HNV\Http\Helper\Collection\CasesValuesProviderTrait;

use function array_filter;
use function in_array;

/**
 * Resource access modes collection.
 */
enum AccessMode : string
{
    use CasesValuesProviderTrait;

    case READ_ONLY_POINTER_START                        = 'rb';
    case READ_AND_WRITE_POINTER_START                   = 'rb+';
    case WRITE_ONLY_FORCE_CLEAR_FORCE_CREATE            = 'wb';
    case READ_AND_WRITE_FORCE_CLEAR_FORCE_CREATE        = 'wb+';
    case WRITE_ONLY_POINTER_END_FORCE_CREATE            = 'ab';
    case READ_AND_WRITE_POINTER_END_FORCE_CREATE        = 'ab+';
    case WRITE_ONLY_POINTER_START_EXPECT_NO_FILE        = 'xb';
    case READ_AND_WRITE_POINTER_START_EXPECT_NO_FILE    = 'xb+';
    case WRITE_ONLY_POINTER_START_FORCE_CREATE          = 'cb';
    case READ_AND_WRITE_POINTER_START_FORCE_CREATE      = 'cb+';
    /**
     * Get collection of asked type. Skip values form another type, if filter requested.
     *
     * @return self[]
     */
    public static function get(AccessModeType $type, ?AccessModeType $filter = null): array
    {
        $result         = self::getCollection($type);
        $valuesToSkip   = $filter ? self::getCollection($filter) : [];

        return $valuesToSkip
            ? array_filter($result, fn (self $mode) => !in_array($mode, $valuesToSkip, true))
            : $result;
    }

    /**
     * Get collection of given type.
     *
     * @return self[]
     */
    private static function getCollection(AccessModeType $type): array
    {
        return match ($type) {
            AccessModeType::ALL                   => self::cases(),
            AccessModeType::READABLE              => [
                self::READ_ONLY_POINTER_START,
                self::READ_AND_WRITE_POINTER_START,
                self::READ_AND_WRITE_FORCE_CLEAR_FORCE_CREATE,
                self::READ_AND_WRITE_POINTER_END_FORCE_CREATE,
                self::READ_AND_WRITE_POINTER_START_EXPECT_NO_FILE,
                self::READ_AND_WRITE_POINTER_START_FORCE_CREATE,
            ],
            AccessModeType::WRITABLE              => [
                self::READ_AND_WRITE_POINTER_START,
                self::WRITE_ONLY_FORCE_CLEAR_FORCE_CREATE,
                self::READ_AND_WRITE_FORCE_CLEAR_FORCE_CREATE,
                self::WRITE_ONLY_POINTER_END_FORCE_CREATE,
                self::READ_AND_WRITE_POINTER_END_FORCE_CREATE,
                self::WRITE_ONLY_POINTER_START_EXPECT_NO_FILE,
                self::READ_AND_WRITE_POINTER_START_EXPECT_NO_FILE,
                self::WRITE_ONLY_POINTER_START_FORCE_CREATE,
                self::READ_AND_WRITE_POINTER_START_FORCE_CREATE,
            ],
            AccessModeType::FORCE_CLEAR           => [
                self::WRITE_ONLY_FORCE_CLEAR_FORCE_CREATE,
                self::READ_AND_WRITE_FORCE_CLEAR_FORCE_CREATE,
            ],
            AccessModeType::EXPECT_NO_FILE        => [
                self::WRITE_ONLY_POINTER_START_EXPECT_NO_FILE,
                self::READ_AND_WRITE_POINTER_START_EXPECT_NO_FILE,
            ],
            AccessModeType::READABLE_ONLY         => self::get(
                AccessModeType::READABLE,
                AccessModeType::WRITABLE,
            ),
            AccessModeType::WRITABLE_ONLY         => self::get(
                AccessModeType::WRITABLE,
                AccessModeType::READABLE,
            ),
            AccessModeType::READABLE_AND_WRITABLE => (
                function () {
                    $readable   = self::get(AccessModeType::READABLE);
                    $writable   = self::get(AccessModeType::WRITABLE);
                    $result     = [];

                    foreach ($readable as $mode) {
                        if (in_array($mode, $writable, true)) {
                            $result[] = $mode;
                        }
                    }

                    return $result;
                }
            )(),
        };
    }
}
