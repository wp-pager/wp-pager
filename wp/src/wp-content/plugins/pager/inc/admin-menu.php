<?php

declare( strict_types=1 );

add_action( 'admin_menu', 'pager_admin_menu' );

function pager_admin_menu(): void {
	add_menu_page( 'Pager',
		'Pager',
		'manage_options',
		'pager',
		'pager_admin_page',
		'dashicons-format-gallery',
		20 );
}

function pager_admin_page(): void {
	wp_enqueue_script( 'pager-admin' );

	echo <<<HTML
	<div class="wrap">
		<h1>Pager Settings</h1>
		<div id="pager-admin-app"></div>
	</div>
	HTML;
}