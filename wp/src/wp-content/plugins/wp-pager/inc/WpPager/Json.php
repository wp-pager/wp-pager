<?php

declare(strict_types=1);

namespace WpPager;

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
        $flags = JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;
        $result = json_encode($input, $flags);

        if (!$result) {
            throw new JsonException('JSON parsing error');
        }

        return $result;
    }
}
