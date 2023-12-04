<?php
/**
 * Plugin Name: Spider Elements
 * Description: Spider Elements is a hassle-free addon bundle with super useful widgets for building beautiful websites. Plug and play to create stunning designs effortlessly.
 * Author: spider-themes
 * Version: 0.4.0
 * Requires at least: 5.0
 * Tested up to: 6.4.1
 * Requires PHP: 7.4
 * Elementor requires at least: 3.0.0
 * Elementor tested up to: 3.19.0
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text domain: spider-elements
 * Domain Path: /languages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Spider_Elements class.
 *
 * The main class that initiates and runs the addon.
 *
 */
if ( ! class_exists( 'Spider_Elements') ) {

	/**
	 * Class Spider_Elements
	 */
	final class Spider_Elements {

		/**
		 * Plugin Version
		 *
		 * Holds the version of the plugin.
		 *
		 * @var string The plugin version.
		 */
		const VERSION = '0.4.0';

		/**
		 * Minimum Elementor Version
		 *
		 * @var string Minimum Elementor version required to run the plugin.
		 */
		const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

		/**
		 * Minimum PHP Version
		 *
		 * Holds the minimum PHP version required to run the plugin.
		 *
		 * @var string Minimum PHP version required to run the plugin.
		 */
		const MINIMUM_PHP_VERSION = '7.4';


		/**
		 * Instance
		 *
		 * Holds a single instance of the `Spider_Elements` class.
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
         * Constructor
         *
         * Initialize the Spider Elements plugins.
         *
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
            add_action( 'elementor/elements/categories_registered', [ $this, 'elements_register_category' ] );

            // Register widgets
            add_action( 'elementor/widgets/register', [ $this, 'on_widgets_registered' ] );

            // Register Icon
            add_filter( 'elementor/icons_manager/additional_tabs', [ $this, 'spe_elegant_icons' ] );

        }


		/**
		 * Clone
		 *
		 * Disable class cloning.
		 *
		 * @return void
		 *
		 * @access protected
		 *
		 */
		public function __clone() {
			// Cloning instances of the class is forbidden
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'spider-elements' ), self::VERSION );
		}


		/**
		 * Wakeup
		 *
		 * Disable unserializing the class.
		 *
		 * @return void
		 *
		 * @access protected
		 *
		 */
		public function __wakeup() {
			// Un-serializing instances of the class is forbidden.
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'spider-elements' ), '1.7.0' );
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


		/**
		 * Include Files
		 *
		 * Load core files required to run the plugin.
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
		 * @access public
		 */
		public function admin_notice_missing_main_plugin() {

			$screen = get_current_screen();
			if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
				return;
			}

			$plugin                 = 'elementor/elementor.php';
			$plugin_name            = esc_html__( 'Spider Elements', 'spider-elements' );
			$installed_plugins      = get_plugins();
			$is_elementor_installed = isset( $installed_plugins[ $plugin ] );

			if ( $is_elementor_installed ) {
				if ( ! current_user_can( 'activate_plugins' ) ) {
					return;
				}
				$button_text = __( 'Activate Elementor', 'spider-elements' );
				$button_link = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s',
					'activate-plugin_' . $plugin );
				$message     = sprintf( __( '<strong>%1$s</strong> requires <strong>Elementor</strong> plugin to be active. Please activate Elementor to continue.',
					'spider-elements' ), $plugin_name
				);
			} else {
				if ( ! current_user_can( 'install_plugins' ) ) {
					return;
				}
				$button_text = __( 'Install Elementor', 'spider-elements' );
				$button_link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ),
					'install-plugin_elementor' );
				$message     = sprintf( __( '<strong>%1$s requires Elementor</strong> plugin to be installed and activated. Please install Elementor to continue.',
					'spider-elements' ), $plugin_name
				);
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
		 * @access public
		 */
		public function admin_notice_minimum_elementor_version() {

			if (isset($_GET['activate'])) {
				// Ensure it's a valid action (optional, depending on your needs)
				if (isset($_GET['activate']) && $_GET['activate'] === 'spider-elements-activation') {

					// After activation is complete, remove the 'activate' parameter
					unset($_GET['activate']);

					// Redirect to a specific page after activation (optional)
					wp_redirect(admin_url('admin.php?page=spider-elements-settings'));
					exit;
				}
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
		 *
		 * @access public
		 */
		public function admin_notice_minimum_php_version() {

			if (isset($_GET['activate'])) {
				// Ensure it's a valid action (optional, depending on your needs)
				if (isset($_GET['activate']) && $_GET['activate'] === 'spider-elements-activation') {

					// After activation is complete, remove the 'activate' parameter
					unset($_GET['activate']);

					// Redirect to a specific page after activation (optional)
					wp_redirect(admin_url('admin.php?page=spider-elements-settings'));
					exit;
				}
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
		 */
		public function elements_register_category() {

			\Elementor\Plugin::instance()->elements_manager->add_category( 'spider-elements', [
				'title' => __( 'Spider Elements', 'spider-elements' ),
			], 1 );

		}

		/**
		 * Register New Widgets
		 *
		 * Include Spider Elements widgets files and register them in Elementor.
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
		 * @access private
		 */
		private function include_widgets() {

            require_once( __DIR__ . '/widgets/Accordion.php' );
            require_once( __DIR__ . '/widgets/Alerts_Box.php' );
            require_once( __DIR__ . '/widgets/Animated_Heading.php' );
            require_once( __DIR__ . '/widgets/Before_after.php' );
            require_once( __DIR__ . '/widgets/Blog_Grid.php' );
            require_once( __DIR__ . '/widgets/Buttons.php' );
            require_once( __DIR__ . '/widgets/Cheat_sheet.php' );
            require_once( __DIR__ . '/widgets/Counter.php' );
            require_once( __DIR__ . '/widgets/Integrations.php' );
            require_once( __DIR__ . '/widgets/List_Item.php' );
            require_once( __DIR__ . '/widgets/Pricing_Table_Switcher.php' );
            require_once( __DIR__ . '/widgets/Pricing_Table_Tabs.php' );
            require_once( __DIR__ . '/widgets/Skill_Showcase.php' );
            require_once( __DIR__ . '/widgets/Tabs.php' );
            require_once( __DIR__ . '/widgets/Team_Carousel.php' );
            require_once( __DIR__ . '/widgets/Testimonial.php' );
            require_once( __DIR__ . '/widgets/Video_Playlist.php' );
            require_once( __DIR__ . '/widgets/Video_Popup.php' );

		}

		/**
		 * Register Widgets
		 *
		 * Register new Elementor widgets.
		 */
		private function register_widgets() {

            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Alerts_Box() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Accordion() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Animated_Heading() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Before_After() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Blog_Grid() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Buttons() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Cheat_sheet() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Counter() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Integrations() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\List_Item() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Pricing_Table_Switcher() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Pricing_Table_Tabs() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Skill_Showcase() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Tabs() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Team_Carousel() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Testimonial() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Video_Playlist() );
            \Elementor\Plugin::instance()->widgets_manager->register( new \Spider_Elements\Widgets\Video_Popup() );


		}


		/**
		 * @return void
		 * @access public
		 * @static
		 */
		public function define_constants() {

			//SPF(Short form - Spider Elements)
			define( 'SPE_VERSION', self::VERSION );
			define( 'SPE_FILE', __FILE__ );
			define( 'SPE_PATH', __DIR__ );
			define( 'SPE_URL', plugins_url( '', SPE_FILE ) );
			define( 'SPE_ASSETS', SPE_URL . '/assets' );
			define( 'SPE_CSS', SPE_URL . '/assets/css' );
			define( 'SPE_JS', SPE_URL . '/assets/js' );
			define( 'SPE_IMG', SPE_URL . '/assets/images' );
			define( 'SPE_VEND', SPE_URL . '/assets/vendors' );
		}


	}
}


/**
 * Initialize the main plugin class
 *
 * @return \Spider_Elements
 *
 */
if ( ! function_exists( 'Spider_Elements' ) ) {

    function Spider_Elements () {
        return Spider_Elements::instance();
    }

    //kick-off the plugin
    Spider_Elements();
}