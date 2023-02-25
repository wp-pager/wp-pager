<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax\Handlers;

use JsonException;
use WpPager\Dto\Requests\SetFilesRequest;
use WpPager\File;
use WpPager\Json;

class SetFilesHandler extends Handler
{
    public function __construct(private readonly SetFilesRequest $request)
    {
    }

    /**
     * @throws JsonException
     */
    public function handle(): string
    {
        $files = Json::decode($this->request->files_json);

        (new File())->saveFiles($files);

        return $this->success();
    }
}
