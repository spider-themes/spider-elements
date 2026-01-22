<?php
namespace SPEL\includes\Admin;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Admin_Settings
 *
 * @package spiderElements\includes\Admin
 */
class Dashboard {

	const PAGE_ID = 'spider_elements_settings';

	/**
	 * List of Spider Elements admin page slugs
	 */
	private array $plugin_pages = [
		'spider_elements_settings',
		'spider_elements_elements',
		'spider_elements_features',
		'spider_elements_integration',
	];

	public function __construct() {
		add_action( 'admin_menu', [ $this, 'add_menu_page' ] );
		add_action( 'admin_init', [ $this, 'hide_admin_notices' ] );
	}


	/**
	 * Hide all admin notices on Spider Elements pages.
	 *
	 * @return void
	 */
	public function hide_admin_notices(): void {
		// Check if we're on a Spider Elements page
		if ( ! isset( $_GET['page'] ) || ! in_array( $_GET['page'], $this->plugin_pages, true ) ) {
			return;
		}

		// Remove all admin notices
		remove_all_actions( 'admin_notices' );
		remove_all_actions( 'all_admin_notices' );
	}


	/**
	 * Add menu page to the WordPress admin dashboard.
	 *
	 * @return void
	 */
	public function add_menu_page(): void {
		// Add main menu page
		add_menu_page(
			esc_html__( 'Spider Elements', 'spider-elements' ),
			esc_html__( 'Spider Elements', 'spider-elements' ),
			'manage_options',
			'spider_elements_settings',
			[ $this, 'render_plugin_page' ],
			$this->icon(),
			30
		);

		// Add submenus (matching the tab-menu items in sidebar)
		add_submenu_page(
			'spider_elements_settings',
			esc_html__( 'Dashboard', 'spider-elements' ),
			esc_html__( 'Dashboard', 'spider-elements' ),
			'manage_options',
			'spider_elements_settings', // Same as parent to make it the default
			[ $this, 'render_plugin_page' ]
		);

		add_submenu_page(
			'spider_elements_settings',
			esc_html__( 'Elements', 'spider-elements' ),
			esc_html__( 'Elements', 'spider-elements' ),
			'manage_options',
			'spider_elements_elements',
			[ $this, 'render_plugin_page' ]
		);

		add_submenu_page(
			'spider_elements_settings',
			esc_html__( 'Features', 'spider-elements' ),
			esc_html__( 'Features', 'spider-elements' ),
			'manage_options',
			'spider_elements_features',
			[ $this, 'render_plugin_page' ]
		);

		add_submenu_page(
			'spider_elements_settings',
			esc_html__( 'Integration', 'spider-elements' ),
			esc_html__( 'Integration', 'spider-elements' ),
			'manage_options',
			'spider_elements_integration',
			[ $this, 'render_plugin_page' ]
		);
	}


	/**
	 * Get the active tab based on the current page URL.
	 *
	 * @return string
	 */
	public function get_active_tab(): string {
		$page = isset( $_GET['page'] ) ? sanitize_text_field( $_GET['page'] ) : 'spider_elements_settings';

		$tab_map = [
			'spider_elements_settings'    => 'welcome',
			'spider_elements_elements'    => 'elements',
			'spider_elements_features'    => 'features',
			'spider_elements_integration' => 'integration',
		];

		return $tab_map[ $page ] ?? 'welcome';
	}


	/**
	 * Render the content of the menu page.
	 * This is where you would add your custom HTML
	 *
	 * @return void
	 */
	public function render_plugin_page(): void {
		// Get the active tab based on which submenu was clicked
		$active_tab = $this->get_active_tab();

		// Map tab names to submenu page slugs
		$tab_to_page = [
			'welcome'     => 'spider_elements_settings',
			'elements'    => 'spider_elements_elements',
			'features'    => 'spider_elements_features',
			'integration' => 'spider_elements_integration',
		];

		// Get the page slug for the active tab
		$current_page = $tab_to_page[ $active_tab ] ?? 'spider_elements_settings';
		$form_action  = admin_url( 'admin.php?page=' . $current_page );

		echo '<form action="' . esc_url( $form_action ) . '" method="post" id="spel_settings" name="spel_settings" class="wrapper spel_dashboard" data-active-tab="' . esc_attr( $active_tab ) . '">';

		// Hidden field to track current active tab (updated by JavaScript)
		echo '<input type="hidden" name="spel_active_tab" id="spel_active_tab" value="' . esc_attr( $active_tab ) . '">';

		//Sidebar's menu
		echo '<div class="sidebar_navigation">';

		if ( file_exists( __DIR__ . '/dashboard/sidebar.php' ) ) {
			require_once __DIR__ . '/dashboard/sidebar.php';
		}

		echo '</div>'; //End of sidebar menu


		// Tab contents
		echo '<div class="tab_contents">';

		if ( file_exists( __DIR__ . '/dashboard/welcome.php' ) ) {
			require_once __DIR__ . '/dashboard/welcome.php';
		}

		if ( file_exists( __DIR__ . '/dashboard/elements.php' ) ) {
			require_once __DIR__ . '/dashboard/elements.php';
		}

		if ( file_exists( __DIR__ . '/dashboard/features.php' ) ) {
			require_once __DIR__ . '/dashboard/features.php';
		}

		if ( file_exists( __DIR__ . '/dashboard/integration.php' ) ) {
			require_once __DIR__ . '/dashboard/integration.php';
		}

		if ( file_exists( __DIR__ . '/dashboard/popup-pro.php' ) ) {
			require_once __DIR__ . '/dashboard/popup-pro.php';
		}

		echo '</div>'; //End of tab contents

		echo '</form>'; //End of wrapper

	}


	/**
	 * Return the base64 encoded SVG icon.
	 *
	 * @return string
	 */
	public function icon(): string {
		return 'data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODYiIGhlaWdodD0iODMiIHZpZXdCb3g9IjAgMCA4NiA4MyIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPGcgY2xpcC1wYXRoPSJ1cmwoI2NsaXAwXzRfMjExMikiPgo8cGF0aCBkPSJNODYgMTkuNjE0MlYxNS45OTc2VjBINzAuMjI4M0gxNS43NzE3QzcuMDYwNTcgMCAwIDcuMTYxNzEgMCAxNS45OTc2SDc2LjAxMjJDNzguNzMxNCAxOC4yNTg0IDgyLjIwODcgMTkuNjE0MiA4NiAxOS42MTQyWiIgZmlsbD0idXJsKCNwYWludDBfbGluZWFyXzRfMjExMikiLz4KPHBhdGggZD0iTTAgNjMuMzg1N1Y2Ny4wMDI0VjgzSDE1Ljc3MTdINzAuMjI4M0M3OC45Mzk0IDgzIDg2IDc1LjgzODIgODYgNjcuMDAyNEg5Ljk4Nzc4QzcuMjY4NjUgNjQuNzQxNSAzLjc5MTI3IDYzLjM4NTcgMCA2My4zODU3WiIgZmlsbD0idXJsKCNwYWludDFfbGluZWFyXzRfMjExMikiLz4KPHBhdGggZD0iTTcwLjIyODMgMzMuNTAxMkgwQzAgNDIuMzM3MSA3LjA2MDU3IDQ5LjQ5ODggMTUuNzcxNyA0OS40OTg4SDg2Qzg2IDQwLjY2MjkgNzguOTM5NCAzMy41MDEyIDcwLjIyODMgMzMuNTAxMloiIGZpbGw9InVybCgjcGFpbnQyX2xpbmVhcl80XzIxMTIpIi8+CjwvZz4KPGRlZnM+CjxsaW5lYXJHcmFkaWVudCBpZD0icGFpbnQwX2xpbmVhcl80XzIxMTIiIHgxPSIwIiB5MT0iOS44MDcxMSIgeDI9Ijg2IiB5Mj0iOS44MDcxMSIgZ3JhZGllbnRVbml0cz0idXNlclNwYWNlT25Vc2UiPgo8c3RvcCBzdG9wLWNvbG9yPSIjNzQ2MEZGIi8+CjxzdG9wIG9mZnNldD0iMSIgc3RvcC1jb2xvcj0iIzlENzBGRiIvPgo8L2xpbmVhckdyYWRpZW50Pgo8bGluZWFyR3JhZGllbnQgaWQ9InBhaW50MV9saW5lYXJfNF8yMTEyIiB4MT0iMCIgeTE9IjczLjE5MjkiIHgyPSI4NiIgeTI9IjczLjE5MjkiIGdyYWRpZW50VW5pdHM9InVzZXJTcGFjZU9uVXNlIj4KPHN0b3Agc3RvcC1jb2xvcj0iIzc0NjBGRiIvPgo8c3RvcCBvZmZzZXQ9IjEiIHN0b3AtY29sb3I9IiM5RDcwRkYiLz4KPC9saW5lYXJHcmFkaWVudD4KPGxpbmVhckdyYWRpZW50IGlkPSJwYWludDJfbGluZWFyXzRfMjExMiIgeDE9IjAiIHkxPSI0MS41IiB4Mj0iODYiIHkyPSI0MS41IiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSI+CjxzdG9wIHN0b3AtY29sb3I9IiM3NDYwRkYiLz4KPHN0b3Agb2Zmc2V0PSIxIiBzdG9wLWNvbG9yPSIjOUQ3MEZGIi8+CjwvbGluZWFyR3JhZGllbnQ+CjxjbGlwUGF0aCBpZD0iY2xpcDBfNF8yMTEyIj4KPHJlY3Qgd2lkdGg9Ijg2IiBoZWlnaHQ9IjgzIiBmaWxsPSJ3aGl0ZSIvPgo8L2NsaXBQYXRoPgo8L2RlZnM+Cjwvc3ZnPgo=';
	}


}