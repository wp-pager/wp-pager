<?php

declare(strict_types=1);

/*
Plugin Name: WP Pager
Author: Serhii Cho
Author URI: https://serhii.io/about-me
Description: WP Pager is a WordPress plugin for displaying images in a form of a restaurant menu.
Version: 0.3.0
Tested up to: 8.0
Requires PHP: 8.1
Donate link: https://www.buymeacoffee.com/serhiicho
License: MIT
License URI: https://github.com/SerhiiCho/wp-pager/blob/main/LICENCE
Text Domain: pager
Tags: menu, album, images, files, gallery, restaurant, food, food menu, restaurant menu, restaurant menu plugin, restaurant menu wordpress, restaurant menu wordpress plugin, restaurant menu wordpress plugin free, restaurant menu wordpress
*/

use WpPager\Hook;

defined('ABSPATH') || exit('ABSPATH is not defined');
define('PAGER_PATH', plugin_dir_path(__FILE__));
define('PAGER_UPLOADS_PATH', wp_upload_dir()['basedir'] . '/wp-pager/');
define('PAGER_FILES_PATH', PAGER_UPLOADS_PATH . 'files/');
define('PAGER_URL', plugin_dir_url(__FILE__));
define('PAGER_FILES_URL', content_url('uploads/wp-pager/files/'));

error_reporting(E_ERROR | E_PARSE);

require __DIR__ . '/vendor/autoload.php';

(new Hook())->init();
