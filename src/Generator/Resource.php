<?php

declare(strict_types=1);

namespace HNV\Http\Helper\Generator;

use HNV\Http\Helper\Collection\Resource\AccessMode;
use LogicException;

use function fclose;
use function fopen;
use function is_resource;

class Resource extends ClearableGenerator implements GeneratorInterface
{
    public function __construct(
        private readonly string $file,
        private readonly AccessMode $mode
    ) {
    }

    /**
     * {@inheritDoc}
     *
     * @return resource
     */
    public function generate(): mixed
    {
        $resource = fopen($this->file, $this->mode->value);

        if ($resource === false) {
            throw new LogicException(
                "resource creating failed, access mode is [{$this->mode->value}]"
            );
        }

        $this->clear(function () use ($resource): void {
            if (is_resource($resource)) {
                fclose($resource);
            }
        });

        return $resource;
    }
}
