<?php

declare(strict_types=1);

namespace Pager\Http\Ajax;

use Pager\Http\Ajax\Handlers\Handler;

class Entry
{
    /**
     * @return array<string, callable(): string>
     */
    public function getHandlers(): array
    {
        return [
            'pager_delete_file' => function ($request): Handler {
                //
            },
        ];
    }
}
