<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax;

use Throwable;
use JsonException;
use WpPager\Dto\Requests\UpdateSettingsRequest;
use WpPager\Http\Ajax\Handlers\Settings\UpdateSettingsHandler;
use WpPager\Http\Request;
use WpPager\Http\Ajax\Handlers\Handler;
use WpPager\Dto\Requests\AddFilesRequest;
use WpPager\Dto\Requests\SetFilesRequest;
use WpPager\Dto\Requests\DeleteFileRequest;
use WpPager\Exceptions\MissingRequestParameter;
use WpPager\Http\Ajax\Handlers\Files\AddFilesHandler;
use WpPager\Http\Ajax\Handlers\Files\GetFilesHandler;
use WpPager\Http\Ajax\Handlers\Files\SetFilesHandler;
use WpPager\Http\Ajax\Handlers\Files\DeleteFileHandler;
use WpPager\Http\Ajax\Handlers\Files\DeleteAllFilesHandler;
use WpPager\Http\Ajax\Handlers\Settings\GetSettingsHandler;

class Entry
{
    use AjaxResponse;

    private Request $request;

    public function __construct()
    {
        $req = count($_GET) > 0 ? $_GET : $_POST;
        $this->request = new Request($req);
    }

    /**
     * @return array<string, callable(): string>
     */
    public function getHandlers(): array
    {
        return [
            'pager_get_files' => fn (): Handler => new GetFilesHandler(),
            'pager_delete_all_files' => fn (): Handler => new DeleteAllFilesHandler(),
            'pager_get_settings' => fn (): Handler => new GetSettingsHandler(),

            'pager_delete_file' => function (): Handler {
                $request = new DeleteFileRequest($this->request->int('id'));
                return new DeleteFileHandler($request);
            },
            'pager_add_files' => function (): Handler {
                $request = new AddFilesRequest($this->request->files());
                return new AddFilesHandler($request);
            },
            'pager_set_files' => function (): Handler {
                $request = new SetFilesRequest($this->request->get('files'));
                return new SetFilesHandler($request);
            },
            'pager_update_settings' => function (): Handler {
                $request = new UpdateSettingsRequest($this->request->get('settings'));
                return new UpdateSettingsHandler($request);
            },
        ];
    }

    /**
     * Register all actions for all ajax calls.
     *
     * @throws JsonException
     * @throws MissingRequestParameter
     */
    public function init(): void
    {
        foreach ($this->getHandlers() as $method_name => $handler) {
            $action = function () use ($handler): void {
                if (!wp_verify_nonce($this->request->get('nonce'), 'pager-nonce-key')) {
                    echo $this->error('Invalid nonce');
                    exit(200);
                }

                try {
                    echo $handler()->handle();
                } catch (Throwable $e) {
                    $err_msg = $e->getMessage() . ' in ' . $e->getFile() . ' on line ' . $e->getLine();
                    echo $this->error($err_msg);
                }

                exit(200);
            };

            add_action("wp_ajax_{$method_name}", $action);
            add_action("wp_ajax_nopriv_{$method_name}", $action);
        }
    }
}
