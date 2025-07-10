<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax\Handlers\Files;

use JsonException;
use WpPager\Http\Ajax\Handlers\Handler;
use WpPager\File;

class DeleteAllFilesHandler extends Handler
{
    /**
     * @throws JsonException
     */
    public function handle(): string
    {
        (new File())->deleteAll();
        return $this->success();
    }
}
