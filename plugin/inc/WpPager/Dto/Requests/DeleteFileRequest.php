<?php

declare(strict_types=1);

namespace WpPager\Dto\Requests;

class DeleteFileRequest
{
    public function __construct(public int $file_id)
    {
    }
}
