<?php

declare(strict_types=1);

namespace Pager\Http;

class Request
{
    /**
     * @return array<int, array<int, string>>
     */
    public static function getFiles(?string $files_key = null): array
    {
        $files = $_FILES[$files_key ?? 'files'] ?? [];

        $file_count = count($files['name']);
        $file_keys = array_keys($files);
        $result = [];

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $result[$i][$key] = $files[$key][$i];
            }
        }

        return $result;
    }
}
