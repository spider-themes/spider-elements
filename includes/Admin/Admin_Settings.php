<?php
namespace Spider_Elements_Assets\includes\Admin;

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Class Admin_Settings
 * @package spiderElements\includes\Admin
 */
class Admin_Settings {

	const PAGE_ID = 'spider_elements_settings';

	public function __construct() {

		add_action( 'admin_menu', [ $this, 'add_menu_page' ] );


	}


	/**
	 * @return void
	 * Add menu page to the WordPress admin dashboard.
	 */
	public function add_menu_page() {

		add_menu_page(
			__( 'Spider Elements', 'spider-elements' ),
			__( 'Spider Elements', 'spider-elements' ),
			'manage_options',
			self::PAGE_ID,
			[ $this, 'render_plugin_page' ],
			$this->spe_icon(),
			30
		);

	}


	/**
	 * @return void
	 * Render the content of the menu page.
	 * This is where you would add your custom HTML
	 */
	public function render_plugin_page() {

		echo '<form action="" method="post" id="spe-settings" name="spe-settings" class="wrapper spe_dashboard">';

			//Sidebar's menu
			echo '<div class="sidebar_navigation">';

				if ( file_exists(require_once __DIR__ . '/templates/sidebar.php') ) {
					require_once __DIR__ . 'parts/sidebar.php';
				}

			echo '</div>'; //End of sidebar menu


			// Tab contents
			echo '<div class="tab_contents">';

				if ( file_exists(require_once __DIR__ . '/templates/dashboard.php') ) {
					require_once __DIR__ . 'parts/dashboard.php';
				}

				if ( file_exists(require_once __DIR__ . '/templates/elements.php') ) {
					require_once __DIR__ . 'parts/elements.php';
				}

				if ( file_exists(require_once __DIR__ . '/templates/features.php') ) {
					require_once __DIR__ . 'parts/features.php';
				}

				if ( file_exists(require_once __DIR__ . '/templates/api-settings.php') ) {
					require_once __DIR__ . 'parts/api-settings.php';
				}

				if ( file_exists(require_once __DIR__ . '/templates/integration.php') ) {
					require_once __DIR__ . 'parts/integration.php';
				}

				if ( file_exists(require_once __DIR__ . '/templates/go-premium.php') ) {
					require_once __DIR__ . 'parts/go-premium.php';
				}

			echo '</div>'; //End of tab contents

		echo '</form>'; //End of wrapper

	}


	/**
	 * @return string
	 * Return the base64 encoded SVG icon.
	 */
	public function spe_icon() {
		return 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODYiIGhlaWdodD0iODMiIHZpZXdCb3g9IjAgMCA4NiA4MyIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGcgY2xpcC1wYXRoPSJ1cmwoI2NsaXAwXzRfMjExMikiPgo8cGF0aCBkPSJNODYgMTkuNjE0MlYxNS45OTc2VjBINzAuMjI4M0gxNS43NzE3QzcuMDYwNTcgMCAwIDcuMTYxNzEgMCAxNS45OTc2SDc2LjAxMjJDNzguNzMxNCAxOC4yNTg0IDgyLjIwODcgMTkuNjE0MiA4NiAxOS42MTQyWiIgZmlsbD0idXJsKCNwYWludDBfbGluZWFyXzRfMjExMikiLz4KPHBhdGggZD0iTTAgNjMuMzg1N1Y2Ny4wMDI0VjgzSDE1Ljc3MTdINzAuMjI4M0M3OC45Mzk0IDgzIDg2IDc1LjgzODIgODYgNjcuMDAyNEg5Ljk4Nzc4QzcuMjY4NjUgNjQuNzQxNSAzLjc5MTI3IDYzLjM4NTcgMCA2My4zODU3WiIgZmlsbD0idXJsKCNwYWludDFfbGluZWFyXzRfMjExMikiLz4KPHBhdGggZD0iTTcwLjIyODMgMzMuNTAxMkgwQzAgNDIuMzM3MSA3LjA2MDU3IDQ5LjQ5ODggMTUuNzcxNyA0OS40OTg4SDg2Qzg2IDQwLjY2MjkgNzguOTM5NCAzMy41MDEyIDcwLjIyODMgMzMuNTAxMloiIGZpbGw9InVybCgjcGFpbnQyX2xpbmVhcl80XzIxMTIpIi8+CjwvZz4KPGRlZnM+CjxsaW5lYXJHcmFkaWVudCBpZD0icGFpbnQwX2xpbmVhcl80XzIxMTIiIHgxPSIwIiB5MT0iOS44MDcxMSIgeDI9Ijg2IiB5Mj0iOS44MDcxMSIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiPgo8c3RvcCBzdG9wLWNvbG9yPSIjNzQ2MEZGIi8+CjxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iIzlENzBGRiIvPgo8L2xpbmVhckdyYWRpZW50Pgo8bGluZWFyR3JhZGllbnQgaWQ9InBhaW50MV9saW5lYXJfNF8yMTEyIiB4MT0iMCIgeTE9IjczLjE5MjkiIHgyPSI4NiIgeTI9IjczLjE5MjkiIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIj4KPHN0b3Agc3RvcC1jb2xvcj0iIzc0NjBGRiIvPgo8c3RvcCBvZmZzZXQ9IjEiIHN0b3AtY29sb3I9IiM5RDcwRkYiLz4KPC9saW5lYXJHcmFkaWVudD4KPGxpbmVhckdyYWRpZW50IGlkPSJwYWludDJfbGluZWFyXzRfMjExMiIgeDE9IjAiIHkxPSI0MS41IiB4Mj0iODYiIHkyPSI0MS41IiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+CjxzdG9wIHN0b3AtY29sb3I9IiM3NDYwRkYiLz4KPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjOUQ3MEZGIi8+CjwvbGluZWFyR3JhZGllbnQ+CjxjbGlwUGF0aCBpZD0iY2xpcDBfNF8yMTEyIj4KPHJlY3Qgd2lkdGg9Ijg2IiBoZWlnaHQ9IjgzIiBmaWxsPSJ3aGl0ZSIvPgo8L2NsaXBQYXRoPgo8L2RlZnM+Cjwvc3ZnPgo=';
	}


}

new Admin_Settings();