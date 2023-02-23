<?php

declare( strict_types=1 );

add_shortcode( 'pager_menu', 'pager_menu_shortcode' );

function pager_menu_shortcode(): string {
	wp_enqueue_script( 'pager-album' );

	return '<div id="pager-album-app"></div>';
}