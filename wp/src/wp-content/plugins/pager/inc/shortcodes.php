<?php

declare( strict_types=1 );

add_shortcode( 'pager_menu', 'pager_menu_shortcode' );

function pager_menu_shortcode(): string {
	function enqueue_scripts() {
		wp_enqueue_script( 'main', PAGER_URL . 'assets/main.js', [], PAGER_VERSION, true );
	}

	add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );

	return '<div id="pager-app"></div>';
}