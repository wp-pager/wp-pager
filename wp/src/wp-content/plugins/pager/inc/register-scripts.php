<?php

declare( strict_types=1 );

add_action( 'wp_enqueue_scripts', 'pager_register_shortcode_scripts' );

function pager_register_shortcode_scripts(): void {
	wp_register_script( 'pager-album', PAGER_URL . 'assets/album.js', [], PAGER_VERSION, true );
}

// register admin script

add_action( 'admin_enqueue_scripts', 'pager_register_admin_scripts' );

function pager_register_admin_scripts(): void {
	wp_register_script( 'pager-admin', PAGER_URL . 'assets/admin.js', [], PAGER_VERSION, true );
}
