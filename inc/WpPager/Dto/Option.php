<?php

declare(strict_types=1);

namespace WpPager\Dto;

class Option
{
    public int $albumMaxWidth = 1000;

    /**
     * @var array<int, ImageFile>
     */
    public array $files = [];
}
