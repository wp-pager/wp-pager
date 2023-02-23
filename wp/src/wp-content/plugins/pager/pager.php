<?php

declare( strict_types=1 );

/*
Plugin Name: Pager
Author: Serhii Cho
Author URI: https://serhii.io/
Description: Pager is an open-source and free WordPress plugin for displaying images in a form of a restaurant menu. The main advantage of such plugin is that you can turn pages of the menu by swiping on mobile and desktop devices.
Version: 1.0.0
License: no
License URI: https://serhii.io/
Text Domain: pager
Tags: custom-background, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready
*/

defined( 'ABSPATH' ) || exit( 'ABSPATH is not defined' );
define( 'PAGER_VERSION', '1.0.0' );
define( 'PAGER_PATH', plugin_dir_path( __FILE__ ) );
define( 'PAGER_URL', plugin_dir_url( __FILE__ ) );
define( 'PAGER_FILES_URL', PAGER_PATH . 'storage/files.json' );

ini_set( 'error_reporting', 'E_ALL & ~E_DEPRECATEDT' );

require_once __DIR__ . '/inc/file-handler.php';
require_once __DIR__ . '/inc/register-scripts.php';
require_once __DIR__ . '/inc/shortcodes.php';
require_once __DIR__ . '/inc/admin-menu.php';
require_once __DIR__ . '/inc/ajax.php';
