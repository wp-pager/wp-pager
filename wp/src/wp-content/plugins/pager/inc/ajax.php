<?php

declare( strict_types=1 );

add_action( 'wp_ajax_pager_delete_file', 'pager_delete_file_endpoint' );
add_action( 'wp_ajax_nopriv_pager_delete_file', 'pager_delete_file_endpoint' );

/**
 * @throws JsonException
 */
function pager_delete_file_endpoint(): void {
	$id = (int) $_POST['id'];

	pager_delete_file( $id );

	wp_send_json_success();
}

