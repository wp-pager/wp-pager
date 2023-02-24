<?php

declare( strict_types=1 );

$handlers = [
	'pager_delete_file' => 'pager_delete_file_endpoint',
	'pager_get_files'   => 'pager_get_files_endpoint',
];

foreach ( $handlers as $name => $handler ) {
	add_action( "wp_ajax_{$name}", $handler );
	add_action( "wp_ajax_nopriv_{$name}", $handler );
}

/**
 * @throws JsonException
 */
function pager_delete_file_endpoint(): void {
	$id = (int) $_POST['id'];

	$files = pager_delete_file( $id );

	wp_send_json_success( $files );
}

/**
 * @throws JsonException
 */
function pager_get_files_endpoint(): void {
	$files = pager_get_files();
	wp_send_json_success( $files );
}
