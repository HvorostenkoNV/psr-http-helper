<?php

declare(strict_types=1);

namespace HNV\Http\Helper\Generator;

use function implode;
use function rand;
use function strlen;

/**
 * Text generator.
 */
class Text implements GeneratorInterface
{
    private const CHARACTERS_IN_USE =
        '0123456789'.
        'abcdefghijklmnopqrstuvwxyz'.
        'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * {@inheritDoc}
     *
     * @return string generated random text
     */
    public function generate(): string
    {
        $characters         = self::CHARACTERS_IN_USE;
        $charactersLength   = strlen($characters);
        $lineLength         = rand(10, 100);
        $linesCount         = rand(5, 200);
        $result             = [];

        while ($linesCount > 0) {
            $line = '';

            while ($lineLength > 0) {
                $line .= $characters[rand(0, $charactersLength - 1)];
                $lineLength--;
            }

            $result[] = $line;
            $linesCount--;
        }

        return implode("\n", $result);
    }
}
