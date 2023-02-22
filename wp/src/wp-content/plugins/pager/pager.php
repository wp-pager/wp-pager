<?php

declare(strict_types=1);

/*
Plugin Name: Nalognl PDF Offer
Author: Serhii Cho
Author URI: https://serhii.io/
Description: Custom plugin for nalog.nl
Version: 1.1.0
License: no
License URI: https://serhii.io/
Text Domain: nalognl_pdf_offer
Tags: custom-background, custom-logo, custom-menu, featured-images, threaded-comments, translation-ready
*/

use NalognlPdfOffer\ExceptionHandler;
use NalognlPdfOffer\Hook;

defined('ABSPATH') || exit('ABSPATH is not defined');
define('NNL_PDF_MAIN_FILE', __FILE__);
define('NNL_PDF_PATH', plugin_dir_path(__FILE__));
define('NNL_PDF_URL', plugin_dir_url(__FILE__));
define('NNL_PDF_STORAGE', NNL_PDF_PATH . 'storage/');
define('NNL_PDF_LOGS', NNL_PDF_STORAGE . 'logs/');
define('NNL_PDF_CONFIG', NNL_PDF_PATH . 'config/');
define('NNL_PDF_LANG', NNL_PDF_STORAGE . 'lang/');

require_once __DIR__ . '/vendor/autoload.php';

try {
    (new Hook())->init();
} catch (Throwable $e) {
    new ExceptionHandler($e);
}
