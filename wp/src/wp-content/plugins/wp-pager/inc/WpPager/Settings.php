<?php

declare(strict_types=1);

namespace WpPager;

use JsonException;

class Settings
{
    /**
     * @return array<string, mixed>
     */
    public function get(): ?array
    {
        if (!file_exists(PAGER_SETTINGS_URL)) {
            file_put_contents(PAGER_SETTINGS_URL, '[]');
        }

        $content = file_get_contents(PAGER_SETTINGS_URL);

        if (!$content) {
            return null;
        }

        return Json::decode($content) ?? [];
    }

    /**
     * @throws JsonException
     */
    public function update(array $input): void
    {
        file_put_contents(PAGER_SETTINGS_URL, Json::encode($input));
    }
}
