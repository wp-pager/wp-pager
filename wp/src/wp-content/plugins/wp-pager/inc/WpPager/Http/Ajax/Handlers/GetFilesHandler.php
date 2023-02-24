<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax\Handlers;

use JsonException;
use WpPager\File;

class GetFilesHandler extends Handler
{
    /**
     * @throws JsonException
     */
    public function handle(): string
    {
        $files = (new File())->getFiles();
        return $this->success($files);
    }
}
