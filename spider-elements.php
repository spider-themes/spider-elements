<?php
/**
 * Plugin Name: Spider Elements
 * Requires Plugins: elementor
 * Plugin URI: https://wordpress-plugins.spider-themes.net/spider-elements/
 * Description: Spider Elements is a hassle-free addon bundle with super useful widgets for building beautiful websites. Plug and play to create stunning designs effortlessly.
 * Version: 1.5.0
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

if ( function_exists( 'spel_fs' ) ) {
    spel_fs()->set_basename( false, __FILE__ );
} else {

    // DO NOT REMOVE THIS IF; IT IS ESSENTIAL FOR THE `function_exists` CALL ABOVE TO PROPERLY WORK.
    if ( ! function_exists( 'spel_fs' ) ) {
        // Create a helper function for easy SDK access.
        function spel_fs() {
            global $spel_fs;

            if ( ! isset( $spel_fs ) ) {

                // Include Freemius SDK.
                require_once dirname(__FILE__) . '/includes/freemius/start.php';

                $spel_fs = fs_dynamic_init(
                    [
                        'id'                    => '16034',
                        'slug'                  => 'spider-elements',
                        'premium_slug'          => 'spider-elements-pro',
                        'type'                  => 'plugin',
                        'public_key'            => 'pk_711f20dd503c8eb713171079ffeb5',
                        'is_premium'            => false,
                        'premium_suffix'        => 'Pro',
                        'has_premium_version'   => true,
                        'has_paid_plans'        => true,
                        'trial'                 => [
                            'days'              => 14,
                            'is_require_payment'=> true,
                        ],
                        'menu'                  => [
                            'slug'              => 'spider_elements_settings',
                            'contact'           => true,
                            'support'           => false,
                            'first-path'        => 'admin.php?page=spider_elements_settings'
                        ],
                    ]
                );
            }

            return $spel_fs;
        }

        // Init Freemius.
        spel_fs()->add_filter( 'deactivate_on_activation', '__return_false' );
        spel_fs()->add_filter( 'hide_freemius_powered_by', '__return_true' );

        // Init Freemius.
        spel_fs();

        // Signal that SDK was initiated.
        do_action( 'spel_fs_loaded' );
    }
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
        const VERSION = '1.5.0';


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
            add_action('elementor/widgets/register', [ $this, 'widgets_register' ], 99 );

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
			$json_data = plugins_url( 'assets/vendors/elegant-icon/elegant-icons.json', __FILE__ );

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
         * Load Textdomain
         *
         * Load plugin localization files.
         */
        public function i18n(): void
        {
            load_plugin_textdomain( 'spider-elements', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
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
		public function core_includes(): void
        {


			// Extra functions
			require_once __DIR__ . '/includes/functions.php';

            //Action Filter
            require_once __DIR__ . '/includes/filters.php';

			require_once __DIR__ . '/includes/Admin/Module_Settings.php';

			// Admin and Frontend Scripts Loaded
            require_once __DIR__ . '/includes/Admin/Plugin_Installer.php';

            $theme = wp_get_theme();
            if ( spel_is_premium() || in_array($theme->get('Name'), ['jobi', 'Jobi', 'jobi-child', 'Jobi Child']) ) {
                require_once __DIR__ . '/includes/Admin/extension/Heading_Highlighted.php';
                require_once __DIR__ . '/includes/Admin/extension/Features_Badge.php';
            }

            // Admin UI
            if ( is_admin() ) {
				require_once __DIR__ . '/includes/Admin/Assets.php';
				require_once __DIR__ . '/includes/Admin/Dashboard.php';
			}

            // Frontend UI
            require_once __DIR__ . '/includes/Frontend/Assets.php';

		}

        /**
         * Initialize the plugin
         *
         * Validates that Elementor is already loaded.
         * Checks for basic plugin requirements, if one check fail don't continue,
         * if all checks have passed include the plugin class.
         *
         * Fired by `plugins_loaded` action hook.
         *
         * @access public
         */
		public function init_plugin(): void
        {

            $theme = wp_get_theme();
            $features_opt = get_option('spel_features_settings');

            $is_premium_or_theme = spel_is_premium() || in_array($theme->get('Name'), ['jobi', 'Jobi', 'jobi-child', 'Jobi Child']);

            if ( $is_premium_or_theme ) {

                // Get the feature badge status
                $heading_highlighted = $features_opt['spel_heading_highlighted'] ?? '';
                if ($heading_highlighted) {
                    new SPEL\includes\Admin\extension\Heading_Highlighted();
                }

                $badge = $features_opt['spel_badge'] ?? '';
                if ($badge) {
                    new SPEL\includes\Admin\extension\Features_Badge();
                }

            }

            // Admin UI
            if ( is_admin() ) {
                new SPEL\includes\Admin\Dashboard();
                new SPEL\includes\Admin\Assets();
            }

            // Frontend UI
            new SPEL\includes\Admin\Plugin_Installer();
            new SPEL\includes\Frontend\Assets();

		}


        /**
         * Add new Elementor Categories
         *
         * Register new widget categories for Spider Elements widgets.
         */
        public function elements_register_category (): void
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
		public function widgets_register(): void
        {

            // Register each widget class
            $widgets_manager = \Elementor\Plugin::instance()->widgets_manager;
            $elements_opt = get_option( 'spe_widget_settings' );

            if ( isset( $elements_opt[ 'docy_tabs' ] ) && $elements_opt[ 'docy_tabs' ] == 'on' ) {
                require_once( __DIR__ . '/widgets/Tabs.php' );
                $widgets_manager->register( new \SPEL\Widgets\Tabs() );
            }
            if ( isset( $elements_opt[ 'docy_videos_playlist' ] ) && $elements_opt[ 'docy_videos_playlist' ] == 'on' ) {
                require_once( __DIR__ . '/widgets/Video_Playlist.php' );
                $widgets_manager->register( new \SPEL\Widgets\Video_Playlist() );
            }
            if ( isset( $elements_opt[ 'docly_alerts_box' ] ) && $elements_opt[ 'docly_alerts_box' ] == 'on' ) {
                require_once( __DIR__ . '/widgets/Alerts_Box.php' );
                $widgets_manager->register( new \SPEL\Widgets\Alerts_Box() );
            }
            if ( isset( $elements_opt[ 'spel_accordion' ] ) && $elements_opt[ 'spel_accordion' ] == 'on' ) {
                require_once( __DIR__ . '/widgets/Accordion.php' );
                $widgets_manager->register( new \SPEL\Widgets\Accordion() );
            }
            if ( isset( $elements_opt[ 'docy_testimonial' ] ) && $elements_opt[ 'docy_testimonial' ] == 'on' ) {
                require_once( __DIR__ . '/widgets/Testimonial.php' );
                $widgets_manager->register( new \SPEL\Widgets\Testimonial() );
            }
            // if ( isset( $elements_opt[ 'landpagy_pricing_table_tabs' ] ) && $elements_opt[ 'landpagy_pricing_table_tabs' ] == 'on' ) {
            //     require_once( __DIR__ . '/widgets/Pricing_Table_Tabs.php' );
            //     $widgets_manager->register( new \SPEL\Widgets\Pricing_Table_Tabs() );
            // }
            // if ( isset( $elements_opt[ 'landpagy_pricing_table_switcher' ] ) && $elements_opt[ 'landpagy_pricing_table_switcher' ] == 'on' ) {
            ////require_once( __DIR__ . '/widgets/Pricing_Table_Switcher.php' );
            //     $widgets_manager->register( new \SPEL\Widgets\Pricing_Table_Switcher() );
            // }

            if ( isset( $elements_opt[ 'docly_list_item' ] ) && $elements_opt[ 'docly_list_item' ] == 'on' ) {
                require_once( __DIR__ . '/widgets/List_Item.php' );
                $widgets_manager->register( new \SPEL\Widgets\List_Item() );
            }
            if ( isset( $elements_opt[ 'docly_cheatsheet' ] ) && $elements_opt[ 'docly_cheatsheet' ] == 'on' ) {
                require_once( __DIR__ . '/widgets/Cheat_sheet.php' );
                $widgets_manager->register( new \SPEL\Widgets\Cheat_sheet() );
            }
            if ( isset( $elements_opt[ 'docy_team_carousel' ] ) && $elements_opt[ 'docy_team_carousel' ] == 'on' ) {
                require_once( __DIR__ . '/widgets/Team_Carousel.php' );
                $widgets_manager->register( new \SPEL\Widgets\Team_Carousel() );
            }
            if ( isset( $elements_opt[ 'docy_integrations' ] ) && $elements_opt[ 'docy_integrations' ] == 'on' ) {
                require_once( __DIR__ . '/widgets/Integrations.php' );
                $widgets_manager->register( new \SPEL\Widgets\Integrations() );
            }
            if ( isset( $elements_opt[ 'spe_after_before_widget' ] ) && $elements_opt[ 'spe_after_before_widget' ] == 'on' ) {
                require_once( __DIR__ . '/widgets/Before_after.php' );
                $widgets_manager->register( new \SPEL\Widgets\Before_After() );
            }
            if ( isset( $elements_opt[ 'docy_video_popup' ] ) && $elements_opt[ 'docy_video_popup' ] == 'on' ) {
                require_once( __DIR__ . '/widgets/Video_Popup.php' );
                $widgets_manager->register( new \SPEL\Widgets\Video_Popup() );
            }
            if ( isset( $elements_opt[ 'docy_blog_grid' ] ) && $elements_opt[ 'docy_blog_grid' ] == 'on' ) {
                require_once( __DIR__ . '/widgets/Blog_Grid.php' );
                $widgets_manager->register( new \SPEL\Widgets\Blog_Grid() );
            }
            if ( isset( $elements_opt[ 'spe_timeline_widget' ] ) && $elements_opt[ 'spe_timeline_widget' ] == 'on' ) {
                require_once( __DIR__ . '/widgets/Timeline.php' );
                $widgets_manager->register( new \SPEL\Widgets\Timeline() );
            }
            // if ( isset( $elements_opt[ 'spe_buttons' ] ) && $elements_opt[ 'spe_buttons' ] == 'on' ) {
            //require_once( __DIR__ . '/widgets/Buttons.php' );
            //     $widgets_manager->register( new \SPEL\Widgets\Buttons() );
            // }
            // if ( isset( $elements_opt[ 'spel_animated_heading' ] ) && $elements_opt[ 'spel_animated_heading' ] == 'on' ) {
            //require_once( __DIR__ . '/widgets/Animated_Heading.php' );
            //     $widgets_manager->register( new \SPEL\Widgets\Animated_Heading() );
            // }


            if ( isset( $elements_opt[ 'spe_counter' ] ) && $elements_opt[ 'spe_counter' ] == 'on' ) {
                require_once( __DIR__ . '/widgets/Counter.php' );
                $widgets_manager->register( new \SPEL\Widgets\Counter() );
            }

            // if ( isset( $elements_opt[ 'spe_instagram' ] ) && $elements_opt[ 'spe_instagram' ] == 'on' ) {
            //require_once( __DIR__ . '/widgets/Instagram.php' );
            //     $widgets_manager->register( new \SPEL\Widgets\Instagram() );
            // }

            if ( isset( $elements_opt[ 'spel_icon_box' ] ) && $elements_opt[ 'spel_icon_box' ] == 'on' ) {
                require_once( __DIR__ . '/widgets/Icon_box.php' );
                $widgets_manager->register( new \SPEL\Widgets\Icon_box() );
            }

		}


		/**
		 * @return void
		 * @since 1.7.0
		 * @access public
		 * @static
		 */
		public function define_constants(): void
        {

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
 * @return SPEL
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