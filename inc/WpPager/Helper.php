<?php

declare(strict_types=1);

namespace WpPager;

use Exception;

abstract class Helper
{
    public static function fileVersion(string $file): int
    {
        try {
            $time = filemtime(PAGER_PATH . $file);
            return is_int($time) ? $time : 0;
        } catch (Exception) {
            return 0;
        }
    }
}
