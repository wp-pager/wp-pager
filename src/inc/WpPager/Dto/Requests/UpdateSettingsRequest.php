<?php

declare(strict_types=1);

namespace WpPager\Dto\Requests;

class UpdateSettingsRequest
{
    public function __construct(public readonly string $settings_json)
    {
    }
}
