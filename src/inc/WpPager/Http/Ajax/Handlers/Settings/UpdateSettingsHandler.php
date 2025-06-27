<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax\Handlers\Settings;

use JsonException;
use WpPager\Dto\ImageFile;
use WpPager\Dto\Option;
use WpPager\Dto\Requests\UpdateSettingsRequest;
use WpPager\Json;
use WpPager\OptionsStorage;
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
        $storage = new OptionsStorage();
        $options = $storage->get();

        if ($this->request->settings_json === '') {
            return $this->success($options);
        }

        /** @var null|array{
         *     albumMaxWidth: int,
         * } $input */
        $input = Json::decode($this->request->settings_json);

        if (empty($input) || !is_array($input)) {
            return $this->success($storage->get());
        }

        $options->albumMaxWidth = $input['albumMaxWidth'] ?? $options->albumMaxWidth;
        $storage->save($options);

        return $this->success($input);
    }
}
