<?php

declare(strict_types=1);

namespace WpPager\Dto;

class ImageFile
{
    public function __construct(
        public int $page,
        public string $name,
        public string $url,
        public string $path,
        public bool $visible,
    ) {
    }
}
