<?php

declare(strict_types=1);

namespace Pager;

use JsonException;

abstract class Json
{
    /**
     * @throws JsonException
     */
    public static function decode(string $input)
    {
        return json_decode($input, true, 512, JSON_THROW_ON_ERROR);
    }

    /**
     * @throws JsonException
     */
    public static function encode(array|object $input): string
    {
        $result = json_encode($input, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        if (!$result) {
            throw new JsonException('JSON parsing error');
        }

        return $result;
    }
}
