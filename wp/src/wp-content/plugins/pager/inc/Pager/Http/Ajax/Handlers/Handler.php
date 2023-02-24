<?php

declare(strict_types=1);

namespace Pager\Http\Ajax\Handlers;

use Pager\Http\Ajax\AjaxResponse;

abstract class Handler
{
    use AjaxResponse;

    abstract public function handle(): string;
}
