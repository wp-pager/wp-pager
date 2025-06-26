<?php

declare(strict_types=1);

namespace WpPager\Http;

use WpPager\Exceptions\MissingRequestParameter;

class Request
{
    /**
     * @param array<int, string> $request
     */
    public function __construct(private readonly array $request)
    {
    }

    /**
     * @throws MissingRequestParameter
     */
    public function get(string $key): string
    {
        if (!isset($this->request[$key])) {
            throw new MissingRequestParameter("Missing request parameter: '{$key}'");
        }

        return $this->request[$key];
    }

    /**
     * @throws MissingRequestParameter
     */
    public function int(string $key): int
    {
        return (int) $this->get($key);
    }

    /**
     * @return array<int, array<int, string>>
     */
    public function files(?string $key = null): array
    {
        $files = $_FILES[$key ?? 'files'] ?? [];

        $file_count = count($files['name']);
        $file_keys = array_keys($files);
        $result = [];

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $k) {
                $result[$i][$k] = $files[$k][$i];
            }
        }

        return $result;
    }
}
