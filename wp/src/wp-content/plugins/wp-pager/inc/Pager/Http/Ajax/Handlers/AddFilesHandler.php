<?php

declare(strict_types=1);

namespace Pager\Http\Ajax\Handlers;

use JsonException;
use Pager\Dto\Requests\AddFilesRequest;
use Pager\File;

class AddFilesHandler extends Handler
{
    public function __construct(private readonly AddFilesRequest $request)
    {
    }

    /**
     * @throws JsonException
     */
    public function handle(): string
    {
        $files = (new File())->addFiles($this->request->new_files);
        return $this->success($files);
    }
}
