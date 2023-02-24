<?php

declare(strict_types=1);

namespace Pager\Http\Ajax\Handlers;

use JsonException;
use Pager\Dto\Requests\DeleteFileRequest;
use Pager\File;

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
