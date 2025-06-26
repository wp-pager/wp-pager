<?php

declare(strict_types=1);

namespace WpPager\Dto\Requests;

class SetFilesRequest
{
    public function __construct(public readonly string $files_json)
    {
    }
}
