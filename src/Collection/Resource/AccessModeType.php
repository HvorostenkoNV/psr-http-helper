<?php

declare(strict_types=1);

namespace HNV\Http\Helper\Collection\Resource;

/**
 * Resource access modes types collection.
 */
enum AccessModeType
{
    case READABLE;
    case READABLE_ONLY;
    case WRITABLE;
    case WRITABLE_ONLY;
    case READABLE_AND_WRITABLE;
    case FORCE_CLEAR;
    case EXPECT_NO_FILE;
    case ALL;
}
