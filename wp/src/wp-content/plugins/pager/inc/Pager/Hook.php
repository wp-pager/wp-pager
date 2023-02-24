<?php

declare(strict_types=1);

namespace Pager;

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
        add_action('wp_enqueue_scripts', function () {
            wp_register_script('pager-album', PAGER_URL . 'assets/album.js', [], PAGER_VERSION, true);
        });

        add_action('admin_enqueue_scripts', function () {
            wp_register_script('pager-admin', PAGER_URL . 'assets/admin.js', [], PAGER_VERSION, true);

            wp_localize_script('pager-admin', 'pager', [
                'nonce'   => wp_create_nonce('pager_delete_file'),
                'ajaxUrl' => admin_url('admin-ajax.php'),
                'rootUrl' => PAGER_URL,
            ]);
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
                'Pager',
                'Pager',
                'manage_options',
                'pager',
                $handler,
                'dashicons-format-gallery',
                20
            );
        });
    }
}
