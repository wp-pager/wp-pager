<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax\Handlers\Settings;

use JsonException;
use WpPager\OptionsStorage;
use WpPager\Http\Ajax\Handlers\Handler;

class GetSettingsHandler extends Handler
{
    /**
     * @throws JsonException
     */
    public function handle(): string
    {
        $settings = new OptionsStorage();
        return $this->success($settings->get());
    }
}
