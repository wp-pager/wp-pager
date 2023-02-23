<?php

declare( strict_types=1 );

/*
Plugin Name: Pager
Author: Serhii Cho
Author URI: https://serhii.io/
Description: WordPress plugin that allows you to easily integrate restaurant menu on your website.
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

ini_set( 'error_reporting', 'E_ALL & ~E_DEPRECATEDT' );

require_once __DIR__ . '/inc/shortcodes.php';
