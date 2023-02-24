<?php

declare(strict_types=1);

namespace Pager\Http\Ajax\Handlers;

use JsonException;
use Pager\File;

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
