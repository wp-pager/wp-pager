<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax\Handlers\Files;

use JsonException;
use WpPager\Dto\Requests\AddFilesRequest;
use WpPager\Http\Ajax\Handlers\Handler;
use WpPager\File;

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
