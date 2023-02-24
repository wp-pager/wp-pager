<?php

declare(strict_types=1);

namespace Pager\Dto;

class ImageFile
{
    public function __construct(
        public int $id,
        public string $url,
        public string $path,
    ) {
    }
}
