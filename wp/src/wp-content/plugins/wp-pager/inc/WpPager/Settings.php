<?php

declare(strict_types=1);

namespace WpPager;

class Settings
{
    /**
     * @return array<string, mixed>
     */
    public function get(): array
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
}
