<?php
/**
 * Plugin Name: Spider Elements
 * Plugin URI: https://wordpress-plugins.spider-themes.net/spider-elements/
 * Description: Spider Elements is a hassle-free addon bundle with super useful widgets for building beautiful websites. Plug and play to create stunning designs effortlessly.
 * Version: 1.0.0
 * Requires at least: 5.0
 * Tested up to: 6.2
 * Requires PHP: 7.4
 * Author: spider-themes
 * Author URI: https://spider-themes.net/
 * Domain Path: /languages
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text domain: spider-elements
 * Elementor requires at least: 3.0.0
 * Elementor tested up to: 3.14.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Spider_Elements class.
 *
 * The main class that initiates and runs the addon.
 *
 * @since 1.0.0
 */

if ( ! class_exists( 'Spider_Elements') ) {

	/**
	 * Class Spider_Elements
	 */
	class Spider_Elements {

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
		 * Holds a single instance of the `Spider_Elements` class.
		 *
		 * @since 1.7.0
		 *
		 * @access private
		 * @static
		 *
		 * @var Spider_Elements A single instance of the class.
		 */
		private static $_instance = null;


		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 *
		 * @return Spider_Elements An instance of the class.
		 * @since 1.7.0
		 *
		 * @access public
		 * @static
		 *
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
		 * @return void
		 * @since 1.7.0
		 *
		 * @access protected
		 *
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
		 * @return void
		 * @since 1.7.0
		 *
		 * @access protected
		 *
		 */
		public function __wakeup() {
			// Un-serializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'spider-elements' ), '1.7.0' );
		}


		/**
		 * Constructor
		 *
		 * Initialize the Spider Elements plugins.
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
			add_filter( 'elementor/icons_manager/additional_tabs', [ $this, 'spe_elegant_icons' ] );
			//self :: generate_custom_font_icons();

		}


		/***
		 * Added Custom Font Icon Integrated Elementor Icon Library
		 */
		public function spe_elegant_icons( $custom_fonts ) {
			$css_data  = plugins_url( 'assets/vendors/elegant-icon/style.css', __FILE__ );
			$json_data = plugins_url( 'assets/vendors/elegant-icon/eleganticons.json', __FILE__ );

			$custom_fonts[ 'elegant-icon' ] = [
				'name'          => 'elegant-icon',
				'label'         => esc_html__( 'Elegant Icons', 'spider-elements' ),
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
			$css_file = SPE_PATH . '/assets/vendors/elegant-icon/style.css';
			if ( $wp_filesystem->exists( $css_file ) ) {
				$css_source = $wp_filesystem->get_contents( $css_file );
			}
			preg_match_all( "/\.(.*?):\w*?\s*?{/", $css_source, $matches, PREG_SET_ORDER, 0 );
			$iconList = [];
			foreach ( $matches as $match ) {
				$icon       = str_replace( '', '', $match[ 1 ] );
				$icons      = explode( ' ', $icon );
				$iconList[] = current( $icons );
			}
			$icons        = new stdClass();
			$icons->icons = $iconList;
			$icon_data    = json_encode( $icons );
			$js_file      = SPE_PATH . '/assets/vendors/elegant-icon/eleganticons.json';
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
			if ( ! did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );

				return;
			}

			// Check for required Elementor version
			if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );

				return;
			}

			// Check for required PHP version
			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
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

			$screen = get_current_screen();
			if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
				return;
			}
			$plugin = 'elementor/elementor.php';
			$plugin_name = 'Spider Elements';
			$installed_plugins = get_plugins();
			$is_elementor_installed = isset( $installed_plugins[ $plugin ] );

			if ( $is_elementor_installed ) {
				if ( ! current_user_can( 'activate_plugins' ) ) {
					return;
				}
				$button_text = __( 'Activate Elementor', 'spider-elements' );
				$button_link = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
				$message     = __('<strong>'.$plugin_name.'</strong> requires <strong>Elementor</strong> plugin to be active. Please activate Elementor to continue.', 'spider-elements');
			} else {
				if ( ! current_user_can( 'install_plugins' ) ) {
					return;
				}
				$button_text = __( 'Install Elementor', 'spider-elements' );
				$button_link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
				$message     = sprintf(__('<strong>'.$plugin_name.' requires Elementor</strong> plugin to be installed and activated. Please install Elementor to continue.', 'spider-elements'), '<strong>', '</strong>');
			}

			//Admin Notice
			if ( is_readable( __DIR__ . '/includes/Admin/notices.php' )) {
				require_once __DIR__ . '/includes/Admin/notices.php';
			}

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
			if ( isset( $_GET[ 'activate' ] ) ) {
				unset( $_GET[ 'activate' ] );
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
			if ( isset( $_GET[ 'activate' ] ) ) {
				unset( $_GET[ 'activate' ] );
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
		 * Register new widget categories for Spider Elements widgets.
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
		 * Include Spider Elements widgets files and register them in Elementor.
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
			require_once( __DIR__ . '/widgets/Alerts_Box.php' );
			require_once( __DIR__ . '/widgets/Accordion.php' );
			require_once( __DIR__ . '/widgets/Testimonial.php' );
			require_once( __DIR__ . '/widgets/Pricing_Table_Tabs.php' );
			require_once( __DIR__ . '/widgets/Pricing_Table_Switcher.php' );
			require_once( __DIR__ . '/widgets/List_Item.php' );
			require_once( __DIR__ . '/widgets/Cheat_sheet.php' );
			require_once( __DIR__ . '/widgets/Team_Carousel.php' );
			require_once( __DIR__ . '/widgets/Integrations.php' );
			require_once( __DIR__ . '/widgets/Slideshow.php' );
			require_once( __DIR__ . '/widgets/Before_after.php' );
			require_once( __DIR__ . '/widgets/Video_Popup.php' );
			require_once( __DIR__ . '/widgets/Blog_Grid.php' );
			require_once( __DIR__ . '/widgets/Skill_Showcase.php' );
			require_once( __DIR__ . '/widgets/Timeline.php' );
			require_once( __DIR__ . '/widgets/Buttons.php' );
			require_once( __DIR__ . '/widgets/Animated_Headline.php' );
			// require_once( __DIR__ . '/widgets/Marquee_Slides.php' );

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
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Alerts_Box() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Accordion() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Testimonial() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Pricing_Table_Tabs() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Pricing_Table_Switcher() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\List_Item() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Cheat_sheet() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Team_Carousel() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Integrations() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Diagonal_slideshow () );
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Before_After () );
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Video_Popup() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Blog_Grid() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Skill_Showcase() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Timeline() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Buttons() );
			\Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Animated_Headline() );
			// \Elementor\Plugin::instance()->widgets_manager->register( new Spider_Elements_Assets\Widgets\Marquee_Slides() );
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
			define( 'SPE_PATH', __DIR__ );
			define( 'SE_URL', plugins_url( '', SE_FILE ) );
			define( 'SE_ASSETS', SE_URL . '/assets' );
			define( 'SE_CSS', SE_URL . '/assets/css' );
			define( 'SE_JS', SE_URL . '/assets/js' );
			define( 'SE_IMG', SE_URL . '/assets/images' );
			define( 'SE_VEND', SE_URL . '/assets/vendors' );

		}


	}
}

// Instantiate Spider_Elements.
new Spider_Elements();