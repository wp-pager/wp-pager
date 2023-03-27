<?php

declare(strict_types=1);

namespace WpPager;

use Exception;

abstract class Helper
{
    public static function fileVersion(string $file): int
    {
        try {
            return filemtime(get_template_directory() . "/$file") ?? 0;
        } catch (Exception) {
            return 0;
        }
    }
}