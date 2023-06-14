<?php
/**
 * Plugin Name: Spider Elements
 * Plugin URI: https://spider-themes.net/
 * Description: Spider Elements sample asset for elementor widegts.
 * Version: 1.0.0
 * Requires at least: 5.0
 * Tested up to: 6.2
 * Requires PHP: 7.4
 * Author: spider-themes
 * Author URI: https://spider-themes.net/
 * Text domain: spider-elements
 * Domain Path: /languages
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Elementor tested up to: 3.5.0
 * Elementor Pro tested up to: 3.5.0
 */

/*
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

defined('ABSPATH') or die( 'Hey, what are you doing here? You silly human!' ) ;

/**
 * Main Spider Elements Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class Spider_Elements {

	/**
	 * Plugin Version
	 *
	 * Holds the version of the plugin.
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * Holds the minimum PHP version required to run the plugin.
	 *
	 * @since 1.7.0
	 * @since 1.7.1 Moved from property with that name to a constant.
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.4';


	/**
	 * Instance
	 *
	 * Holds a single instance of the `Listy_Core` class.
	 *
	 * @since 1.7.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Spider_Elements A single instance of the class.
	 */
	private static  $_instance = null ;


	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.7.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Spider_Elements An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Clone
	 *
	 * Disable class cloning.
	 *
	 * @since 1.7.0
	 *
	 * @access protected
	 *
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'spider-elements' ), '1.0.0' );
	}


	/**
	 * Wakeup
	 *
	 * Disable unserializing the class.
	 *
	 * @since 1.7.0
	 *
	 * @access protected
	 *
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden.
		_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'spider-elements' ), '1.7.0' );
	}


	/**
	 * Constructor
	 *
	 * Initialize the Listy Core plugins.
	 *
	 * @since 1.7.0
	 *
	 * @access public
	 */
	public function __construct() {

		// Include Files
		$this->core_includes();

		// define constants
		$this->define_constants();

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );

		add_action( 'init', [ $this, 'i18n' ] );

		// Register Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'se_elements_register_category' ] );

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'on_widgets_registered' ] );

		// Register Icon
		add_filter( 'elementor/icons_manager/additional_tabs', [ $this, 'sp_font_icons' ] );
		//self :: generate_custom_font_icons();

	}


	/***
	 * Added Custom Font Icon Integrated Elementor Icon Library
	 */
	public function sp_font_icons( $custom_fonts ) {
		$css_data  = plugins_url( 'assets/vendors/elegant-icon/style.css', __FILE__ );
		$json_data = plugins_url( 'assets/vendors/elegant-icon/eleganticons.json', __FILE__ );

		$custom_fonts['elegant-icon'] = [
			'name'          => 'elegant-icon',
			'label'         => esc_html__( 'Elegant Icons', 'docy' ),
			'url'           => $css_data,
			'prefix'        => '',
			'displayPrefix' => '',
			'labelIcon'     => 'icon_star',
			'ver'           => '',
			'fetchJson'     => $json_data,
			'native'        => true,
		];

		return $custom_fonts;
	}


	public static function generate_custom_font_icons() {
		$css_source = '';
		global $wp_filesystem;
		require_once( ABSPATH . '/wp-admin/includes/file.php' );
		WP_Filesystem();
		$css_file = DOCY_PATH . '/assets/vendors/elegant-icon/style.css';
		if ( $wp_filesystem->exists( $css_file ) ) {
			$css_source = $wp_filesystem->get_contents( $css_file );
		}
		preg_match_all( "/\.(.*?):\w*?\s*?{/", $css_source, $matches, PREG_SET_ORDER, 0 );
		$iconList = [];
		foreach ( $matches as $match ) {
			$icon       = str_replace( '', '', $match[1] );
			$icons      = explode( ' ', $icon );
			$iconList[] = current( $icons );
		}
		$icons        = new \stdClass();
		$icons->icons = $iconList;
		$icon_data    = json_encode( $icons );
		$js_file      = DOCY_PATH . '/assets/vendors/elegant-icon/eleganticons.json';
		global $wp_filesystem;
		require_once( ABSPATH . '/wp-admin/includes/file.php' );
		WP_Filesystem();
		if ( $wp_filesystem->exists( $js_file ) ) {
			$content = $wp_filesystem->put_contents( $js_file, $icon_data );
		}
	}


	/**
	 * Include Files
	 *
	 * Load core files required to run the plugin.
	 *
	 * @since 1.7.0
	 *
	 * @access public
	 */
	public function core_includes() {

		// Extra functions
		require_once __DIR__ . '/includes/extra.php';

		//Shortcodes
		require_once __DIR__ . '/shortcodes/direction.php';

		// Admin and Frontend Scripts Loaded
		if ( is_admin() ) {
			require_once __DIR__ . '/includes/Admin/Assets.php';
		} else {
			require_once __DIR__ . '/includes/Frontend/Assets.php';
		}

	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * @since 1.7.0
	 *
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'spider-elements', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
	}


	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init_plugin() {

		// Check if Elementor installed and activated
		if ( !did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.1.0
	 * @since 1.7.0 Moved from a standalone function to a class method.
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'spider-elements' ),
			'<strong>' . esc_html__( 'Spider Elements', 'spider-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'spider-elements' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'spider-elements' ),
			'<strong>' . esc_html__( 'Spider Elements', 'spider-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'spider-elements' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.7.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'spider-elements' ),
			'<strong>' . esc_html__( 'Spider Elements', 'spider-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'spider-elements' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Add new Elementor Categories
	 *
	 * Register new widget categories for Listy Core widgets.
	 *
	 * @since 1.0.0
	 * @since 1.7.1 The method moved to this class.
	 *
	 * @access public
	 */
	public function se_elements_register_category() {

		\Elementor\Plugin::instance()->elements_manager->add_category( 'spider-elements', [
			'title' => __( 'Spider Elements', 'spider-elements' ),
		], 1 );

	}

	/**
	 * Register New Widgets
	 *
	 * Include Listy Core widgets files and register them in Elementor.
	 *
	 * @since 1.0.0
	 * @since 1.7.1 The method moved to this class.
	 *
	 * @access public
	 */
	public function on_widgets_registered() {
		$this->include_widgets();
		$this->register_widgets();
	}


	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.2.0
	 * @access private
	 */
	private function include_widgets() {

		require_once( __DIR__ . '/widgets/Tabs.php' );
		require_once( __DIR__ . '/widgets/Video_playlist.php' );
		require_once( __DIR__ . '/widgets/Alerts_box.php' );
		require_once( __DIR__ . '/widgets/Accordion_article.php' );
		require_once( __DIR__ . '/widgets/Accordion.php' );
		require_once( __DIR__ . '/widgets/Testimonial.php' );
		require_once( __DIR__ . '/widgets/Quote.php' );
		require_once( __DIR__ . '/widgets/Pricing_Table_Tabs.php' );
		require_once( __DIR__ . '/widgets/Pricing_Table_Switcher.php' );
		require_once( __DIR__ . '/widgets/List_item.php' );
		require_once( __DIR__ . '/widgets/Cheat_sheet.php' );
		require_once( __DIR__ . '/widgets/Hotspot.php' );
		require_once( __DIR__ . '/widgets/Stacked_Image.php' );

	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.0.0
	 * @since 1.7.1 The method moved to this class.
	 *
	 * @access private
	 */
	private function register_widgets() {
		\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Tabs() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Video_playlist() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Alerts_box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Accordion_article() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Accordion() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Testimonial() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Quote() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Pricing_Table_Tabs() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Pricing_Table_Switcher() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\List_item() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Cheat_sheet() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Hotspot() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Stacked_Image() );
	}


	/**
	 * @return void
	 * @since 1.7.0
	 * @access public
	 * @static
	 */
    public function define_constants() {

        //SPF(Short form - Spider Elements)
        define( 'SE_VERSION', self::VERSION );
        define( 'SE_FILE', __FILE__ );
        define( 'SE_PATH', __DIR__ );
        define( 'SE_URL', plugins_url( '', SE_FILE ) );
        define( 'SE_ASSETS', SE_URL . '/assets' );
        define( 'SE_CSS', SE_URL . '/assets/css' );
        define( 'SE_JS', SE_URL . '/assets/js' );
        define( 'SE_IMG', SE_URL . '/assets/images' );
        define( 'SE_VEND', SE_URL . '/assets/vendors' );

    }


}

// Instantiate Spider_Elements.
new Spider_Elements();
