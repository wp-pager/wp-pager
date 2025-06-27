<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax\Handlers\Files;

use JsonException;
use WpPager\Dto\ImageFile;
use WpPager\Dto\Requests\SetFilesRequest;
use WpPager\Http\Ajax\Handlers\Handler;
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
        $temp_files = Json::decode($this->request->files_json);

        if (!is_array($temp_files)) {
            return $this->error('Invalid files');
        }

        $files = [];

        foreach ($temp_files as $key => $file) {
            $files[] = ImageFile::fromArray($file);
        }

        (new File())->saveFiles($files);

        return $this->success();
    }
}
