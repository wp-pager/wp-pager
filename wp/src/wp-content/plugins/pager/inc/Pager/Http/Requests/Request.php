<?php

declare(strict_types=1);

namespace Pager\Http\Requests;

abstract class Request
{
    public function __construct(protected array $request)
    {
    }
}
