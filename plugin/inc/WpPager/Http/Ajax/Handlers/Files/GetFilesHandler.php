<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax\Handlers\Files;

use JsonException;
use WpPager\File;
use WpPager\Http\Ajax\Handlers\Handler;

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
