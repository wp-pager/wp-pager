<?php

declare(strict_types=1);

namespace Pager\Http\Ajax\Handlers;

use JsonException;

class DeleteFileHandler extends Handler
{
    /**
     * @throws JsonException
     */
    public function handle(): string
    {
        return $this->success();
    }
}
