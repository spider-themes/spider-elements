<?php
/**
 * @package SpiderElements
*/
/*
Plugin Name: Spider Elements
Description: Spider Elements sample asset for elementor widegts.
Plugin URI:  https://spider-themes.net/
Version:     1.0.0
Author:      Eh Jewel
Author URI:  https://spider-themes.net/
Text Domain: spider-elements
Elementor tested up to: 3.5.0
Elementor Pro tested up to: 3.5.0
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

use Spider_Elements_Assets\PageSettings\Page_Settings;

defined('ABSPATH') or die( 'Hey, what are you doing here? You silly human!' ) ;

// defind SPIDER_ELEMENTS_PATH
define( 'SPIDER_ELEMENTS_PATH', plugin_dir_path( __FILE__ ) );


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
	 * @since 1.2.1
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		// Init Plugin
		add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );

        // Include Files
        $this->core_includes();

        // define constants
        $this->define_constants();

        $this->add_page_settings_controls();
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
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

        // Register Category
        add_action( 'elementor/elements/categories_registered', [ $this, 'se_elements_register_category' ] );

        // Register widgets
        add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

        // Register Icon
        add_filter( 'elementor/icons_manager/additional_tabs', [ $this, 'sp_font_icons' ] );
	}


    public function core_includes() {

        // Extra functions
        require_once __DIR__ . '/includes/extra.php';
        require_once __DIR__ . '/includes/se_helper.php';
        require_once __DIR__ . '/includes/icons.php';

        if ( !is_admin() ) {
            require_once __DIR__ . '/includes/Frontend/Assets.php';
        }

    }


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


    public function add_page_settings_controls() {
        require_once( __DIR__ . '/page-settings/manager.php' );
        new Page_Settings();
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


    public function se_elements_register_category($elements_manager) {
        $elements_manager->add_category(
            'spider-elements',
            [
                'title' => __( 'Spider Elements', 'spider-elements' ),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    /**
     * Clone
     *
     * Disable class cloning.
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
     * Admin notice
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 1.0.0
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
     * @since 1.0.0
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
     * Register Widgets
     *
     * Register new Elementor widgets.
     *
     * @since 1.2.0
     * @access public
     *
     * @param $widgets_manager Elementor widgets manager.
     */
    public function register_widgets( $widgets_manager ) {

        // Its is now safe to include Widgets files
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
        require_once( __DIR__ . '/widgets/Info_box.php' );
        require_once( __DIR__ . '/widgets/Cheat_sheet.php' );
        require_once( __DIR__ . '/widgets/Call_to_action.php' );

        // Register Widgets
        $widgets_manager->register( new Spider_Elements_Assets\Widgets\Tabs() );
        $widgets_manager->register( new Spider_Elements_Assets\Widgets\Video_playlist() );
        $widgets_manager->register( new Spider_Elements_Assets\Widgets\Alerts_box() );
        $widgets_manager->register( new Spider_Elements_Assets\Widgets\Accordion_article() );
        $widgets_manager->register( new Spider_Elements_Assets\Widgets\Accordion() );
        $widgets_manager->register( new Spider_Elements_Assets\Widgets\Testimonial() );
        $widgets_manager->register( new Spider_Elements_Assets\Widgets\Quote() );
        $widgets_manager->register( new Spider_Elements_Assets\Widgets\Pricing_Table_Tabs() );
        $widgets_manager->register( new Spider_Elements_Assets\Widgets\Pricing_Table_Switcher() );
        $widgets_manager->register( new Spider_Elements_Assets\Widgets\List_item() );
        $widgets_manager->register( new Spider_Elements_Assets\Widgets\Info_box() );
        $widgets_manager->register( new Spider_Elements_Assets\Widgets\Cheat_sheet() );
        $widgets_manager->register( new Spider_Elements_Assets\Widgets\Call_to_action() );

    }


}

// Instantiate Spider_Elements.
new Spider_Elements();
