<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax\Handlers;

use JsonException;
use WpPager\Dto\Requests\DeleteFileRequest;
use WpPager\File;

class DeleteFileHandler extends Handler
{
    public function __construct(private readonly DeleteFileRequest $request)
    {
    }

    /**
     * @throws JsonException
     */
    public function handle(): string
    {
        $files = (new File())->deleteFile($this->request->file_id);
        return $this->success($files);
    }
}
