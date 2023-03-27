<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax\Handlers\Files;

use JsonException;
use WpPager\Dto\Requests\GiveImageNameRequest;
use WpPager\File;
use WpPager\Http\Ajax\Handlers\Handler;

class GiveImageNameHandler extends Handler
{
    public function __construct(private readonly GiveImageNameRequest $request)
    {
    }

    /**
     * @throws JsonException
     */
    public function handle(): string
    {
        $files = (new File())->giveImageTitle($this->request->page, $this->request->title);
        return $this->success($files);
    }
}
