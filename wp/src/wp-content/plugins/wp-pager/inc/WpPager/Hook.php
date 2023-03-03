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
                'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBzdGFuZGFsb25lPSJubyI/Pgo8IURPQ1RZUEUgc3ZnIFBVQkxJQyAiLS8vVzNDLy9EVEQgU1ZHIDIwMDEwOTA0Ly9FTiIKICJodHRwOi8vd3d3LnczLm9yZy9UUi8yMDAxL1JFQy1TVkctMjAwMTA5MDQvRFREL3N2ZzEwLmR0ZCI+CjxzdmcgdmVyc2lvbj0iMS4wIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciCiB3aWR0aD0iNDQxLjAwMDAwMHB0IiBoZWlnaHQ9IjQ0Mi4wMDAwMDBwdCIgdmlld0JveD0iMCAwIDQ0MS4wMDAwMDAgNDQyLjAwMDAwMCIKIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIG1lZXQiPgoKPGcgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMC4wMDAwMDAsNDQyLjAwMDAwMCkgc2NhbGUoMC4xMDAwMDAsLTAuMTAwMDAwKSIKZmlsbD0iIzliYTJhNiIgc3Ryb2tlPSJub25lIj4KPHBhdGggZD0iTTE5OTAgNDM4OSBjLTQxMSAtNDIgLTgwOSAtMjA0IC0xMTQ1IC00NjcgLTk3IC03NiAtMjg5IC0yNzEgLTM2MgotMzY3IC0yNjMgLTM0OCAtNDE0IC03MzIgLTQ1MyAtMTE1MCAtNTggLTYyNyAxNjAgLTEyNTEgNTk1IC0xNzA0IDM2NyAtMzgzCjgyOSAtNjEyIDEzNTQgLTY3MiAxNDkgLTE3IDQ1NSAtNyA2MDEgMjAgNDc2IDg2IDg4NSAzMDYgMTIxNSA2NTMgMzIxIDMzOAo1MTkgNzUzIDU4NyAxMjMzIDE5IDEzMyAxNiA0NDUgLTYgNTg1IC0xMDggNzE2IC01NDEgMTMxOCAtMTE4MSAxNjQyIC0yMTkKMTExIC00MjYgMTc4IC02NjAgMjEzIC0xMzQgMjAgLTQxNSAyNyAtNTQ1IDE0eiBtMzkyIC0yOTQgYzM5MSAtMjQgODIwIC0yMTgKMTEyNSAtNTA5IDM4OSAtMzcxIDU5MyAtODQyIDU5MyAtMTM2OCAwIC0yMzYgLTIzIC0zODMgLTkxIC01OTUgLTkzIC0yODYKLTI0MiAtNTI3IC00NjQgLTc0OSAtMjk3IC0yOTcgLTY1NCAtNDc4IC0xMDY2IC01MzggLTEwOCAtMTYgLTM4NSAtMjIgLTQ3MwotMTAgbC00NiA3IDAgNDkzIDAgNDk0IDMwMyAwIGMzMzEgMCA0MjcgOCA1OTIgNTAgNDE3IDEwNSA2NzQgMzYwIDc1OCA3NTAgMjkKMTM0IDI4IDM1OCAtMSA0ODcgLTkzIDQxMSAtMzYzIDY0MyAtODU3IDczOSAtNzkgMTYgLTE3MiAxOCAtNzM3IDIxIGwtNjQ4IDQKLTIgLTE0MjkgLTMgLTE0MzAgLTk1IDU0IGMtMjU3IDE0OCAtNDk5IDM4MSAtNjcwIDY0NCAtMjAzIDMxNCAtMzA5IDc0NCAtMjc5CjExMzggMjkgMzg0IDE3MCA3NDQgNDA4IDEwNDIgMTI5IDE2MiAzNDAgMzQ3IDUxOCA0NTQgMTY2IDk5IDQwMSAxODggNjA0IDIyNwoxMTEgMjEgMzIzIDM4IDQwNCAzMyAyMiAtMiA3OSAtNiAxMjcgLTl6IG0yNTcgLTEyMDUgYzIwMyAtNTAgMzM3IC0xNzQgMzg3Ci0zNTcgMjEgLTc3IDIxIC0yNTggMCAtMzQ2IC00NSAtMTk0IC0xNzMgLTMyMiAtMzgxIC0zODMgLTUwIC0xNCAtMTE0IC0xOAotMzcyIC0yMSBsLTMxMyAtNSAwIDEwMCAwIDk5IDgzIDYgYzQ1IDQgMTI4IDcgMTg1IDcgbDEwMiAwIDAgNTUgMCA1NSAtMTg1IDAKLTE4NSAwIDAgODUgMCA4NSAxNjggMCBjOTMgMCAyMDMgMyAyNDUgNiBsNzcgNyAwIDUzIDAgNTQgLTI0NSAwIC0yNDUgMCAwIDg1CjAgODUgMzM4IDAgYzE4NyAwIDM3MyAzIDQxNSA2IGw3NyA3IDAgODQgMCA4NCAtNDEyIC0yIC00MTMgLTEgLTMgOTIgLTMgOTMKMjk4IC02IGMyNTQgLTUgMzEwIC05IDM4MiAtMjd6Ii8+CjxwYXRoIGQ9Ik0yNDUwIDIwNDUgbDAgLTExNSAxMTUgMCAxMTUgMCAwIDExNSAwIDExNSAtMTE1IDAgLTExNSAwIDAgLTExNXoiLz4KPC9nPgo8L3N2Zz4K',
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
