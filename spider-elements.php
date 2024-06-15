<?php
/**
 * Plugin Name: Spider Elements
 * Requires Plugins: elementor
 * Plugin URI: https://wordpress-plugins.spider-themes.net/spider-elements/
 * Description: Spider Elements is a hassle-free addon bundle with super useful widgets for building beautiful websites. Plug and play to create stunning designs effortlessly.
 * Version: 1.1.0
 * Requires at least: 5.0
 * Tested up to: 6.5.4
 * Requires PHP: 7.4
 * Author: spider-themes
 * Author URI: https://spider-themes.net/spider-elements
 * Domain Path: /languages
 * License: GPL2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text domain: spider-elements
 * Elementor requires at least: 3.0.0
 * Elementor tested up to: 3.20.3
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * SPEL class.
 *
 * The main class that initiates and runs the addon.
 *
 */
if (!class_exists('SPEL')) {

	/**
	 * Class SPEL
	 */
	final class SPEL {

        /**
         * Plugin Version
         *
         * Holds the version of the plugin.
         *
         * @var string The plugin version.
         */
        const VERSION = '1.1.0';

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
         * Holds a single instance of the `SPEL` class.
         *
         * @access private
         * @static
         *
         * @var SPEL A single instance of the class.
         */
        private static $_instance = null;


		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 *
		 * @return SPEL An instance of the class.
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
            add_action('plugins_loaded', array( $this, 'init_plugin' ));

            // Load text domain for localization
            add_action('init', [ $this, 'i18n' ]);

            // Register Category
            add_action('elementor/elements/categories_registered', [ $this, 'elements_register_category' ]);

            // Register widgets
            add_action('elementor/widgets/register', [ $this, 'on_widgets_registered' ], 99 );

            // Register Icon
            add_filter('elementor/icons_manager/additional_tabs', [ $this, 'elegant_icons' ]);

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
			_doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'spider-elements' ), self::VERSION );
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


		/***
		 * Added Custom Font Icon Integrated Elementor Icon Library
		 */
		public function elegant_icons( $custom_fonts ) {
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
		 * @since 1.7.0
		 *
		 * @access public
		 */
		public function core_includes() {

			// Extra functions
			require_once __DIR__ . '/includes/extra.php';

			require_once __DIR__ . '/includes/Admin/Module_Settings.php';

			// Admin and Frontend Scripts Loaded
			if ( is_admin() ) {
				require_once __DIR__ . '/includes/Admin/Assets.php';
				require_once __DIR__ . '/includes/Admin/Admin_Settings.php';
				require_once __DIR__ . '/includes/classes/Plugin_Installer.php';
			} else {
				require_once __DIR__ . '/includes/Frontend/Assets.php';
			}
		}

        /**
         * Load Textdomain
         *
         * Load plugin localization files.
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


            if ( is_admin() ) {
                //Admin
                new SPEL\includes\Admin\Admin_Settings();

                //Classes
                new SPEL\includes\classes\Plugin_Installer();
            }

		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have Elementor installed or activated.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function admin_notice_missing_main_plugin() {

            $screen = get_current_screen();
            if (isset($screen->parent_file) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id) {
                return;
            }

            $plugin = 'elementor/elementor.php';
            $plugin_name = esc_html__('Spider Elements', 'spider-elements');
            $elementor_name = esc_html__('Elementor', 'spider-elements');
            $installed_plugins = get_plugins();
            $is_elementor_installed = isset($installed_plugins[ $plugin ]);

            if ($is_elementor_installed) {
                if (!current_user_can('activate_plugins')) {
                    return;
                }
                $button_text = esc_html__('Activate Elementor', 'spider-elements');
                $button_link = wp_nonce_url('plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s',
                    'activate-plugin_' . $plugin);
                $message = sprintf(
                /* translators: 1: Plugin name, 2: Elementor plugin name */
                    esc_html__('%1$s requires %2$s plugin to be active. Please activate the %2$s to continue.', 'spider-elements'),
                    '<strong>' . $plugin_name . '</strong>',
                    '<strong>' . $elementor_name . '</strong>'
                );
            } else {
                if (!current_user_can('install_plugins')) {
                    return;
                }
                $button_text = esc_html__('Install Elementor', 'spider-elements');
                $button_link = wp_nonce_url(self_admin_url('update.php?action=install-plugin&plugin=elementor'),
                    'install-plugin_elementor');
                $message = sprintf(
                /* translators: 1: Plugin name, 2: Elementor plugin name */
                    esc_html__('%1$s requires %2$s plugin to be installed and activated. Please install the %2$s to continue.', 'spider-elements'),
                    '<strong>' . $plugin_name . '</strong>',
                    '<strong>' . $elementor_name . '</strong>'
                );
            }

            //Admin Notice
            if (is_readable(__DIR__ . '/includes/Admin/notices.php')) {
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

            if (isset($_GET['activate']) && isset($_GET['_wpnonce'])) {

                // Ensure it's a valid action (optional, depending on your needs)
                if ($_GET['activate'] === 'spider-elements-activation' && wp_verify_nonce($_GET['_wpnonce'], 'spider-elements-activation')) {

                    // After activation is complete, remove the 'activate' parameter
                    unset($_GET[ 'activate' ]);

                    // Redirect to a specific page after activation (optional)
                    wp_redirect(admin_url('admin.php?page=spider-elements-settings'));
                    exit;
                }
            }

            $message = sprintf(
                /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
                esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'spider-elements'),
                '<strong>' . esc_html__('Spider Elements', 'spider-elements') . '</strong>',
                '<strong>' . esc_html__('Elementor', 'spider-elements') . '</strong>',
                self::MINIMUM_ELEMENTOR_VERSION
            );

            printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', wp_kses($message, ['strong' => [] ] ) );
		}

        /**
         * Admin notice
         *
         * Warning when the site doesn't have a minimum required PHP version.
         */
		public function admin_notice_minimum_php_version() {

            // Verify nonce
            if (isset($_GET['activate']) && isset($_GET['nonce']) && wp_verify_nonce($_GET['nonce'], 'spider-elements-activation')) {

                // After activation is complete, remove the 'activate' parameter
                unset($_GET['activate']);

                // Redirect to a specific page after activation (optional)
                wp_redirect(admin_url('admin.php?page=spider-elements-settings'));
                exit;
            }

            // Create nonce
            $nonce = wp_create_nonce('spider-elements-activation');

            // Activation URL with nonce
            $activation_url = add_query_arg(array(
                'page' => 'spider-elements-settings',
                'activate' => 'spider-elements-activation',
                'nonce' => $nonce
            ), admin_url('admin.php'));

            // Message about minimum PHP version
            $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
                esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'spider-elements'),
                '<strong>' . esc_html__('Spider Elements', 'spider-elements') . '</strong>',
                '<strong>' . esc_html__('PHP', 'spider-elements') . '</strong>',
                self::MINIMUM_PHP_VERSION
            );

            // Display admin notice with activation link
            printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p><p><a href="%2$s">%3$s</a></p></div>',
                wp_kses($message, ['strong' => []]),
                esc_url($activation_url),
                esc_html__('Activate Now', 'spider-elements')
            );
		}


        /**
         * Add new Elementor Categories
         *
         * Register new widget categories for Spider Elements widgets.
         */
        public function elements_register_category ()
        {

            \Elementor\Plugin::instance()->elements_manager->add_category('spider-elements', [
                'title' => esc_html__('Spider Elements', 'spider-elements'),
            ], 1);

        }

		/**
		 * Register New Widgets
		 *
		 * Include Spider Elements widgets files and register them in Elementor.
		 *
		 * @since 1.0.0
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
			require_once( __DIR__ . '/widgets/Video_Playlist.php' );
			require_once( __DIR__ . '/widgets/Alerts_Box.php' );
			require_once( __DIR__ . '/widgets/Accordion.php' );
			require_once( __DIR__ . '/widgets/Testimonial.php' );
			require_once( __DIR__ . '/widgets/Pricing_Table_Tabs.php' );
			require_once( __DIR__ . '/widgets/Pricing_Table_Switcher.php' );
			require_once( __DIR__ . '/widgets/List_Item.php' );
			require_once( __DIR__ . '/widgets/Cheat_sheet.php' );
			require_once( __DIR__ . '/widgets/Team_Carousel.php' );
			require_once( __DIR__ . '/widgets/Integrations.php' );
			require_once( __DIR__ . '/widgets/Before_after.php' );
			require_once( __DIR__ . '/widgets/Video_Popup.php' );
			require_once( __DIR__ . '/widgets/Blog_Grid.php' );
			require_once( __DIR__ . '/widgets/Skill_Showcase.php' );
			require_once( __DIR__ . '/widgets/Timeline.php' );
			require_once( __DIR__ . '/widgets/Buttons.php' );
			require_once( __DIR__ . '/widgets/Animated_Heading.php' );
//            require_once( __DIR__ . '/widgets/Marquee_Slides.php' );
            require_once( __DIR__ . '/widgets/Counter.php' );
            require_once( __DIR__ . '/widgets/Instagram.php' );
            require_once( __DIR__ . '/widgets/Fullscreen_Slider.php' );
            require_once( __DIR__ . '/widgets/Icon_box.php' );


		}

		/**
		 * Register Widgets
		 *
		 * Register new Elementor widgets.
		 *
		 * @since 1.0.0
		 *
		 * @access private
		 */
		private function register_widgets() {
			
			// Register each widget class
			$widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
			$elements_opt = get_option( 'spe_widget_settings' );

			if ( isset( $elements_opt[ 'docy_accordion' ] ) && $elements_opt[ 'docy_accordion' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Accordion() );
			}
			if ( isset( $elements_opt[ 'docly_alerts_box' ] ) && $elements_opt[ 'docly_alerts_box' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Alerts_Box() );
			}
			if ( isset( $elements_opt[ 'spe_animated_heading' ] ) && $elements_opt[ 'spe_animated_heading' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Animated_Heading() );
			}
			if ( isset( $elements_opt[ 'spe_after_before_widget' ] ) && $elements_opt[ 'spe_after_before_widget' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Before_After() );
			}
			if ( isset( $elements_opt[ 'docy_blog_grid' ] ) && $elements_opt[ 'docy_blog_grid' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Blog_Grid() );
			}
			if ( isset( $elements_opt[ 'spe_buttons' ] ) && $elements_opt[ 'spe_buttons' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Buttons() );
			}
			if ( isset( $elements_opt[ 'docly_cheatsheet' ] ) && $elements_opt[ 'docly_cheatsheet' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Cheat_sheet() );
			}
			if ( isset( $elements_opt[ 'spe_counter' ] ) && $elements_opt[ 'spe_counter' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Counter() );
			}
			if ( isset( $elements_opt[ 'spe_instagram' ] ) && $elements_opt[ 'spe_instagram' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Instagram() );
			}
			if ( isset( $elements_opt[ 'docy_integrations' ] ) && $elements_opt[ 'docy_integrations' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Integrations() );
			}
			if ( isset( $elements_opt[ 'docly_list_item' ] ) && $elements_opt[ 'docly_list_item' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\List_Item() );
			}
//			if ( isset( $elements_opt[ 'spe_marquee_slides' ] ) && $elements_opt[ 'spe_marquee_slides' ] == 'on' ) {
//				$widgets_manager->register( new \SPEL\Widgets\Marquee_Slides() );
//			}
			if ( isset( $elements_opt[ 'landpagy_pricing_table_switcher' ] ) && $elements_opt[ 'landpagy_pricing_table_switcher' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Pricing_Table_Switcher() );
			}
			if ( isset( $elements_opt[ 'landpagy_pricing_table_tabs' ] ) && $elements_opt[ 'landpagy_pricing_table_tabs' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Pricing_Table_Tabs() );
			}
			if ( isset( $elements_opt[ 'spe_skill_showcase_widget' ] ) && $elements_opt[ 'spe_skill_showcase_widget' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Skill_Showcase() );
			}
			if ( isset( $elements_opt[ 'docy_tabs' ] ) && $elements_opt[ 'docy_tabs' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Tabs() );
			}
			if ( isset( $elements_opt[ 'docy_team_carousel' ] ) && $elements_opt[ 'docy_team_carousel' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Team_Carousel() );
			}
			if ( isset( $elements_opt[ 'docy_testimonial' ] ) && $elements_opt[ 'docy_testimonial' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Testimonial() );
			}
			if ( isset( $elements_opt[ 'spe_timeline_widget' ] ) && $elements_opt[ 'spe_timeline_widget' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Timeline() );
			}
			if ( isset( $elements_opt[ 'docy_videos_playlist' ] ) && $elements_opt[ 'docy_videos_playlist' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Video_Playlist() );
			}
			if ( isset( $elements_opt[ 'docy_video_popup' ] ) && $elements_opt[ 'docy_video_popup' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Video_Popup() );
			}
			if ( isset( $elements_opt[ 'spel_icon_box' ] ) && $elements_opt[ 'spel_icon_box' ] == 'on' ) {
				$widgets_manager->register( new \SPEL\Widgets\Icon_box() );
			}


		}


		/**
		 * @return void
		 * @since 1.7.0
		 * @access public
		 * @static
		 */
		public function define_constants() {

            //SPEL(Short form - Spider Elements)
            define('SPEL_VERSION', self::VERSION);
            define('SPEL_FILE', __FILE__);
            define('SPEL_PATH', __DIR__);
            define('SPEL_URL', plugins_url('', SPEL_FILE));
            define('SPEL_ASSETS', SPEL_URL . '/assets');
            define('SPEL_CSS', SPEL_URL . '/assets/css');
            define('SPEL_JS', SPEL_URL . '/assets/js');
            define('SPEL_IMG', SPEL_URL . '/assets/images');
            define('SPEL_VEND', SPEL_URL . '/assets/vendors');
		}


	}
}


/**
 * Initialize the main plugin class
 *
 * @return \SPEL
 *
 */
if (!function_exists('spel')) {

    function spel ()
    {
        return SPEL::instance();
    }

    //kick-off the plugin
    spel();
}