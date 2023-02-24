<?php

declare(strict_types=1);

namespace Pager\Http\Ajax\Handlers;

use JsonException;
use Pager\Json;

abstract class Handler
{
    abstract public function handle(): string;

    /**
     * @throws JsonException
     */
    public function success(array|object|null $data = null): string
    {
        return $this->json($data, true);
    }

    /**
     * @throws JsonException
     */
    public function error(): string
    {
        return $this->json(null, false);
    }

    /**
     * @throws JsonException
     */
    private function json(array|object|null $data, bool $success): string
    {
        $result = Json::encode(compact('data', 'success'));

        if (!$result) {
            throw new JsonException('Ошибка кодировки результата');
        }

        return $result;
    }
}
