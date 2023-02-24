<?php

declare(strict_types=1);

namespace Pager\Http\Ajax;

use JsonException;
use Pager\Dto\Requests\AddFilesRequest;
use Pager\Dto\Requests\DeleteFileRequest;
use Pager\Http\Ajax\Handlers\DeleteFileHandler;
use Pager\Http\Ajax\Handlers\GetFilesHandler;
use Pager\Http\Ajax\Handlers\Handler;
use Pager\Http\Ajax\Handlers\AddFilesHandler;
use Pager\Http\Request;
use Throwable;

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
                    echo $this->error($e->getMessage());
                }

                exit(200);
            };

            add_action("wp_ajax_{$method_name}", $action);
            add_action("wp_ajax_nopriv_{$method_name}", $action);
        }
    }
}
