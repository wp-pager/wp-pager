<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax;

use JsonException;
use WpPager\Json;

trait AjaxResponse
{
    /**
     * @throws JsonException
     */
    public function success(array|object|null $data = null, ?string $message = null): string
    {
        return $this->json($data, true, $message);
    }

    /**
     * @throws JsonException
     */
    public function error(string $message): string
    {
        return $this->json(null, false, $message);
    }

    /**
     * @throws JsonException
     */
    private function json(array|object|null $data, bool $success, ?string $message = null): string
    {
        $result = Json::encode(compact('data', 'success', 'message'));

        if (!$result) {
            throw new JsonException('Ошибка кодировки результата');
        }

        return $result;
    }
}
