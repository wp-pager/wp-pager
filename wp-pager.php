<?php

declare(strict_types=1);

/*
Plugin Name: WP Pager
Author: Serhii Cho
Author URI: https://serhii.io/about-me
Description: Welcome to WP Pager, the free WordPress plugin that empowers you to showcase your images in stunning album or gallery format. Our plugin boasts a sleek and user-friendly interface that enables you to effortlessly create and manage image galleries with ease.
Version: 0.15
License: MIT
License URI: https://github.com/SerhiiCho/wp-pager/blob/main/LICENCE
Text Domain: pager
Tags: menu, album, images, files, gallery, restaurant, food, food menu
*/

use WpPager\Hook;
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

defined('ABSPATH') || exit('ABSPATH is not defined');
define('PAGER_PATH', plugin_dir_path(__FILE__));
define('PAGER_UPLOADS_PATH', wp_upload_dir()['basedir'] . '/wp-pager/');
define('PAGER_FILES_PATH', PAGER_UPLOADS_PATH . 'files/');
define('PAGER_URL', plugin_dir_url(__FILE__));
define('PAGER_FILES_URL', content_url('uploads/wp-pager/files/'));

error_reporting(E_ERROR | E_PARSE);

require __DIR__ . '/vendor/autoload.php';

$update_checker = PucFactory::buildUpdateChecker('https://github.com/SerhiiCho/wp-pager', __FILE__, 'wp-pager');
$update_checker->setBranch('main');

(new Hook())->init();
