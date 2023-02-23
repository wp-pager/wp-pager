<?php

declare( strict_types=1 );

function enqueue_scripts() {
	wp_enqueue_script( 'main', PAGER_URL . 'assets/main.js', [], PAGER_VERSION, true );
}

add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );