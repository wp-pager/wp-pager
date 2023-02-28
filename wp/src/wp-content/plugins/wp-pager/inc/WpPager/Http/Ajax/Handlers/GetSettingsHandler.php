<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax\Handlers;

use WpPager\Settings;

class GetSettingsHandler extends Handler
{
    public function handle(): string
    {
        $settings = new Settings();
        return $this->success($settings->get());
    }
}
