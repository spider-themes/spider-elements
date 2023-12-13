<?php
/**
 * Plugin Name: Spider Elements
 * Description: Spider Elements is a hassle-free addon bundle with super useful widgets for building beautiful websites. Plug and play to create stunning designs effortlessly.
 * Author: spider-themes
 * Version: 0.5.0
 * Requires at least: 5.0
 * Tested up to: 6.4.2
 * Requires PHP: 7.4
 * Elementor requires at least: 3.0.0
 * Elementor tested up to: 3.18.2
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text domain: spider-elements
 * Domain Path: /languages
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
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
    final class SPEL
    {

        /**
         * Plugin Version
         *
         * Holds the version of the plugin.
         *
         * @var string The plugin version.
         */
        const VERSION = '0.5.0';

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
         *
         * @access public
         * @static
         *
         */
        public static function instance ()
        {
            if (is_null(self::$_instance)) {
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
        public function __construct ()
        {

            // Include Files
            $this->core_includes();

            // define constants
            $this->define_constants();

            // Init Plugin
            add_action('plugins_loaded', array( $this, 'init_plugin' ));

            add_action('init', [ $this, 'i18n' ]);

            // Register Category
            add_action('elementor/elements/categories_registered', [ $this, 'elements_register_category' ]);

            // Register widgets
            add_action('elementor/widgets/register', [ $this, 'on_widgets_registered' ]);

            // Register Icon
            add_filter('elementor/icons_manager/additional_tabs', [ $this, 'elegant_icons' ]);

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
        public function __clone ()
        {
            // Cloning instances of the class is forbidden
            _doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'spider-elements'), self::VERSION);
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
        public function __wakeup ()
        {
            // Un-serializing instances of the class is forbidden.
            _doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'spider-elements'), '1.7.0');
        }


        /***
         * Added Custom Font Icon Integrated Elementor Icon Library
         */
        public function elegant_icons ($custom_fonts)
        {
            $css_data = plugins_url('assets/vendors/elegant-icon/style.css', __FILE__);
            $json_data = plugins_url('assets/vendors/elegant-icon/elegant-icons.json', __FILE__);

            $custom_fonts[ 'elegant-icon' ] = [
                'name' => 'elegant-icon',
                'label' => esc_html__('Elegant Icons', 'spider-elements'),
                'url' => $css_data,
                'prefix' => '',
                'displayPrefix' => '',
                'labelIcon' => 'icon_star',
                'ver' => '',
                'fetchJson' => $json_data,
                'native' => true,
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
        public function core_includes ()
        {

            // Extra functions
            require_once __DIR__ . '/includes/extra.php';

            // Admin and Frontend Scripts Loaded
            if (is_admin()) {
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
        public function i18n ()
        {
            load_plugin_textdomain('spider-elements', false, plugin_basename(dirname(__FILE__)) . '/languages');
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
        public function init_plugin ()
        {

            // Check if Elementor installed and activated
            if (!did_action('elementor/loaded')) {
                add_action('admin_notices', [ $this, 'admin_notice_missing_main_plugin' ]);

                return;
            }

            // Check for a required Elementor version
            if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
                add_action('admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ]);

                return;
            }

            // Check for a required PHP version
            if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
                add_action('admin_notices', [ $this, 'admin_notice_minimum_php_version' ]);
            }

        }

        /**
         * Admin notice
         *
         * Warning when the site doesn't have Elementor installed or activated.
         *
         * @access public
         */
        public function admin_notice_missing_main_plugin ()
        {

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
        public function admin_notice_minimum_elementor_version ()
        {

            if (isset($_GET[ 'activate' ])) {
                // Ensure it's a valid action (optional, depending on your needs)
                if (isset($_GET[ 'activate' ]) && $_GET[ 'activate' ] === 'spider-elements-activation') {

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

            printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
        }

        /**
         * Admin notice
         *
         * Warning when the site doesn't have a minimum required PHP version.
         *
         *
         * @access public
         */
        public function admin_notice_minimum_php_version ()
        {

            if (isset($_GET[ 'activate' ])) {
                // Ensure it's a valid action (optional, depending on your needs)
                if (isset($_GET[ 'activate' ]) && $_GET[ 'activate' ] === 'spider-elements-activation') {

                    // After activation is complete, remove the 'activate' parameter
                    unset($_GET[ 'activate' ]);

                    // Redirect to a specific page after activation (optional)
                    wp_redirect(admin_url('admin.php?page=spider-elements-settings'));
                    exit;
                }
            }

            $message = sprintf(
            /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
                esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'spider-elements'),
                '<strong>' . esc_html__('Spider Elements', 'spider-elements') . '</strong>',
                '<strong>' . esc_html__('PHP', 'spider-elements') . '</strong>',
                self::MINIMUM_PHP_VERSION
            );

            printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
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
         * @access public
         */
        public function on_widgets_registered ()
        {
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
        private function include_widgets ()
        {

            require_once(__DIR__ . '/widgets/Accordion.php');
            require_once(__DIR__ . '/widgets/Alerts_Box.php');
            require_once(__DIR__ . '/widgets/Animated_Heading.php');
            require_once(__DIR__ . '/widgets/Before_after.php');
            require_once(__DIR__ . '/widgets/Blog_Grid.php');
            require_once(__DIR__ . '/widgets/Buttons.php');
            require_once(__DIR__ . '/widgets/Cheat_sheet.php');
            require_once(__DIR__ . '/widgets/Counter.php');
            require_once(__DIR__ . '/widgets/Integrations.php');
            require_once(__DIR__ . '/widgets/List_Item.php');
            require_once(__DIR__ . '/widgets/Pricing_Table_Switcher.php');
            require_once(__DIR__ . '/widgets/Pricing_Table_Tabs.php');
            require_once(__DIR__ . '/widgets/Skill_Showcase.php');
            require_once(__DIR__ . '/widgets/Tabs.php');
            require_once(__DIR__ . '/widgets/Team_Carousel.php');
            require_once(__DIR__ . '/widgets/Testimonial.php');
            require_once(__DIR__ . '/widgets/Video_Popup.php');

        }

        /**
         * Register Widgets
         *
         * Register new Elementor widgets.
         */
        private function register_widgets ()
        {

            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\Alerts_Box());
            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\Accordion());
            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\Animated_Heading());
            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\Before_After());
            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\Blog_Grid());
            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\Buttons());
            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\Cheat_sheet());
            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\Counter());
            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\Integrations());
            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\List_Item());
            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\Pricing_Table_Switcher());
            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\Pricing_Table_Tabs());
            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\Skill_Showcase());
            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\Tabs());
            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\Team_Carousel());
            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\Testimonial());
            \Elementor\Plugin::instance()->widgets_manager->register(new \SPEL\Widgets\Video_Popup());

        }


        /**
         * @return void
         * @access public
         * @static
         */
        public function define_constants ()
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