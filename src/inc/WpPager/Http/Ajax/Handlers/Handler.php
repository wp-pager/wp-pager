<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax\Handlers;

use WpPager\Http\Ajax\AjaxResponse;

abstract class Handler
{
    use AjaxResponse;

    abstract public function handle(): string;
}
