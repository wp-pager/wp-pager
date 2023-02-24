<?php

declare(strict_types=1);

$handlers = [
    'pager_delete_file'  => 'pager_delete_file_endpoint',
    'pager_upload_files' => 'pager_upload_file_endpoint',
];

foreach ($handlers as $name => $handler) {
    add_action("wp_ajax_{$name}", $handler);
    add_action("wp_ajax_nopriv_{$name}", $handler);
}

/**
 * @throws JsonException
 */
function pager_delete_file_endpoint(): void
{
    $id = (int) $_POST['id'];

    $files = pager_delete_file($id);

    wp_send_json_success($files);
}

/**
 * @throws JsonException
 */
function pager_upload_file_endpoint(): void
{
    $files = pager_get_files_from_request('files');

    $all_files = pager_upload_files($files);
    wp_send_json_success($all_files);
}
