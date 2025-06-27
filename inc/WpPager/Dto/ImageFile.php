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
        public ?string $title = null,
    ) {
    }

    public static function fromArray(array $arr): self
    {
        return new self(
            page: $arr['page'],
            name: $arr['name'],
            url: $arr['url'],
            path: $arr['path'],
            visible: $arr['visible'],
            title: $arr['title'] ?? null,
        );
    }
}
