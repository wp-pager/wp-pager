<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax\Handlers;

use JsonException;
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
