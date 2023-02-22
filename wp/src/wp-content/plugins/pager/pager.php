<?php

declare(strict_types=1);

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

defined('ABSPATH') || exit('ABSPATH is not defined');

add_filter( 'deprecated_constructor_trigger_error', '__return_false' );

require_once __DIR__ . '/inc/shortcodes.php';