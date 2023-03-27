<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax\Handlers\Settings;

use JsonException;
use WpPager\Settings;
use WpPager\Http\Ajax\Handlers\Handler;

class GetSettingsHandler extends Handler
{
    /**
     * @throws JsonException
     */
    public function handle(): string
    {
        $settings = new Settings();
        return $this->success($settings->get());
    }
}
