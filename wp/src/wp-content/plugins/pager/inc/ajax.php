<?php

declare( strict_types=1 );

add_action( 'wp_ajax_pager_delete_file', 'pager_delete_file_endpoint' );
add_action( 'wp_ajax_nopriv_pager_delete_file', 'pager_delete_file_endpoint' );

/**
 * @throws JsonException
 */
function pager_delete_file_endpoint(): void {
	$id = (int) $_POST['id'];

	$files = pager_delete_file( $id );

	wp_send_json_success( $files );
}

add_action( 'wp_ajax_pager_get_files', 'pager_get_files_endpoint' );
add_action( 'wp_ajax_nopriv_pager_get_files', 'pager_get_files_endpoint' );

/**
 * @throws JsonException
 */
function pager_get_files_endpoint(): void {
	$files = pager_get_files();
	wp_send_json_success( $files );
}
