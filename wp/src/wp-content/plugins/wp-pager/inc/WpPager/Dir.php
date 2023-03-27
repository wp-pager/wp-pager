<?php

declare(strict_types=1);

namespace WpPager;

use RuntimeException;

abstract class Dir
{
    public static function create(string $dir): void
    {
        if (file_exists($dir)) {
            return;
        }

        if (!mkdir($dir, 0777, true) && !is_dir($dir)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $dir));
        }
    }
}