<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax\Handlers\Settings;

use JsonException;
use WpPager\Dto\ImageFile;
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

        if ($this->request->settings_json === '') {
            return $this->success($storage->get());
        }

        /** @var null|array{
         *     page: int,
         *     name: string,
         *     title: string | null,
         *     url: string,
         *     path: string
         * } $input
         */
        $input = Json::decode($this->request->settings_json);

        if (empty($input) || !is_array($input)) {
            return $this->success($storage->get());
        }

        $storage->addFile(new ImageFile(...$input));

        return $this->success($input);
    }
}
