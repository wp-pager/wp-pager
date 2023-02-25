<?php

declare(strict_types=1);

namespace WpPager\Http\Ajax;

use Throwable;
use JsonException;
use WpPager\Http\Request;
use WpPager\Dto\Requests\AddFilesRequest;
use WpPager\Dto\Requests\DeleteFileRequest;
use WpPager\Http\Ajax\Handlers\DeleteFileHandler;
use WpPager\Http\Ajax\Handlers\GetFilesHandler;
use WpPager\Http\Ajax\Handlers\Handler;
use WpPager\Http\Ajax\Handlers\AddFilesHandler;
use WpPager\Http\Ajax\Handlers\DeleteAllFilesHandler;

class Entry
{
    use AjaxResponse;

    private Request $request;

    public function __construct()
    {
        $this->request = new Request($_POST);
    }

    /**
     * @return array<string, callable(): string>
     */
    public function getHandlers(): array
    {
        return [
            'pager_get_files' => function (): Handler {
                return new GetFilesHandler();
            },
            'pager_delete_file' => function (): Handler {
                $request = new DeleteFileRequest($this->request->int('id'));
                return new DeleteFileHandler($request);
            },
            'pager_add_files' => function (): Handler {
                $request = new AddFilesRequest($this->request->files());
                return new AddFilesHandler($request);
            },
            'pager_delete_all_files' => function (): Handler {
                return new DeleteAllFilesHandler();
            },
        ];
    }

    /**
     * Register all actions for all ajax calls.
     *
     * @throws JsonException
     */
    public function init(): void
    {
        foreach ($this->getHandlers() as $method_name => $handler) {
            $action = function () use ($handler): void {
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
