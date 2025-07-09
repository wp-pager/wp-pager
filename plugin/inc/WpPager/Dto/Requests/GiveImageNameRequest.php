<?php

declare(strict_types=1);

namespace WpPager\Dto\Requests;

class GiveImageNameRequest
{
    public function __construct(public string $title, public int $page)
    {
    }
}
