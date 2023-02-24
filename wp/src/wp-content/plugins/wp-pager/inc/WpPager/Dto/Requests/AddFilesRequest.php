<?php

declare(strict_types=1);

namespace WpPager\Dto\Requests;

class AddFilesRequest
{
    /**
     * @param array<int, array{
     *     name: string,
     *     type: string,
     *     tmp_name: string,
     *     error: int,
     *     size: int
     * }> $new_files
     */
    public function __construct(public readonly array $new_files)
    {
    }
}
