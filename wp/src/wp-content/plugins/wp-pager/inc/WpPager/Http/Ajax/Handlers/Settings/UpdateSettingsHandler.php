<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax\Handlers\Settings;

use JsonException;
use WpPager\Dto\Requests\UpdateSettingsRequest;
use WpPager\Json;
use WpPager\Settings;
use WpPager\Http\Ajax\Handlers\Handler;

class UpdateSettingsHandler extends Handler
{
    public function __construct(readonly UpdateSettingsRequest $request)
    {
    }

    /**
     * @throws JsonException
     */
    public function handle(): string
    {
        $settings = new Settings();

        if ($this->request->settings_json === '') {
            return $this->success($settings->get());
        }

        $input = Json::decode($this->request->settings_json);

        if (empty($input) || !is_array($input)) {
            return $this->success($settings->get());
        }

        $settings->update($input);

        return $this->success($input);
    }
}
