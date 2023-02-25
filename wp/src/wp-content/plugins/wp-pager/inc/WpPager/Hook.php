<?php

declare(strict_types=1);

namespace WpPager;

use JsonException;
use WpPager\Http\Ajax\Entry;

class Hook
{
    public function init(): void
    {
        foreach (get_class_methods($this) as $method) {
            if ($method === __FUNCTION__) {
                continue;
            }

            $this->$method();
        }
    }

    private function registerAssets(): void
    {
        function registerJavaScriptGlobalVariables(string $key): void
        {
            wp_localize_script($key, 'pager', [
                'nonce' => wp_create_nonce('pager-nonce-key'),
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'rootUrl' => PAGER_URL,
            ]);
        }

        add_action('wp_enqueue_scripts', function () {
            wp_register_script('pager-album', PAGER_URL . 'assets/album.js', [], PAGER_VERSION, true);
            registerJavaScriptGlobalVariables('pager-album');
        });

        add_action('admin_enqueue_scripts', function () {
            wp_register_script('pager-admin', PAGER_URL . 'assets/admin.js', [], PAGER_VERSION, true);
            registerJavaScriptGlobalVariables('pager-admin');
        });
    }

    private function registerShortcodes(): void
    {
        add_shortcode('pager_menu', function () {
            wp_enqueue_script('pager-album');
            return '<div id="pager-album-app"></div>';
        });
    }

    private function registerAdminMenu(): void
    {
        add_action('admin_menu', function () {
            $handler = function (): void {
                wp_enqueue_script('pager-admin');
                echo '<div id="pager-admin-app"></div>';
            };

            add_menu_page(
                'WP Pager',
                'WP Pager',
                'manage_options',
                'wp-pager',
                $handler,
                'dashicons-format-gallery',
                20
            );
        });
    }

    /**
     * @throws JsonException
     */
    private function exposeJsonApi(): void
    {
        (new Entry())->init();
    }
}
