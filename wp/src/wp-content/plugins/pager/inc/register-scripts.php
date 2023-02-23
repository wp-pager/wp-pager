<?php

declare( strict_types=1 );

add_action( 'wp_enqueue_scripts', 'pager_register_shortcode_scripts' );

function pager_register_shortcode_scripts(): void {
	wp_register_script( 'pager-album', PAGER_URL . 'assets/album.js', [], PAGER_VERSION, true );
}

add_action( 'admin_enqueue_scripts', 'pager_register_admin_scripts' );

function pager_register_admin_scripts(): void {
	wp_register_script( 'pager-admin', PAGER_URL . 'assets/admin.js', [], PAGER_VERSION, true );

	wp_localize_script( 'pager-admin', 'pager', [
		'nonce'   => wp_create_nonce( 'pager_delete_file' ),
		'ajaxUrl' => admin_url( 'admin-ajax.php' ),
		'rootUrl' => PAGER_URL,
		'files'   => pager_get_files(),
	] );
}
