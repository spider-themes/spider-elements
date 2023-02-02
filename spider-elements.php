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
		add_action( 'plugins_loaded', array( $this, 'init' ) );
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
	public function init() {

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

		// Register Widget Scripts
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_elementor_editor_styles' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_widget_styles' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_core_styles' ] );

		// Editor Styles
		add_action( 'enqueue_block_editor_assets', [ $this, 'gutenberg_editor_scripts' ] );

		add_action( 'admin_enqueue_scripts', [ $this, 'register_admin_styles'] );

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'plugin.php' );
	}

	/**
	 * Add new Elementor Categories
	 *
	 * Register new widget categories for Docy Core widgets.
	 *
	 * @since 1.0.0
	 * @since 1.7.1 The method moved to this class.
	 *
	 * @access public
	 */
	public function add_elementor_category() {
		\Elementor\Plugin::instance()->elements_manager->add_category( 'spider-elements', [
			'title' => __( 'Spider Elements', 'spider-element' ),
		], 1 );
	}

	/**
	 * Register Widget Styles
	 *
	 * Register custom styles required to run Docy Core.
	 *
	 * @access public
	 */
	public function enqueue_widget_styles() {
		wp_register_style( 'ionicons', 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', '', '2.0.1' );
		wp_register_style( 'prism', plugins_url( 'assets/vendors/prism/prism.min.css', __FILE__ ) );
		wp_register_style( 'nice-select', plugins_url( 'assets/vendors/niceselectpicker/nice-select.css', __FILE__ ) );
		wp_register_style( 'simple-line-icon', plugins_url( 'assets/vendors/simple-line-icon/simple-line-icons.css', __FILE__ ) );
		wp_register_style( 'animated', plugins_url( 'assets/vendors/slick/animated.css', __FILE__ ) );
		wp_register_style( 'slick', plugins_url( 'assets/vendors/slick/slick.css', __FILE__ ) );
		wp_register_style( 'slick-theme', plugins_url( 'assets/vendors/slick/slick-theme.css', __FILE__ ) );
		wp_register_style( 'elegant-icon', plugins_url( 'assets/vendors/elegant-icon/style.css', __FILE__ ) );
		wp_register_style( 'video-js', plugins_url( 'assets/vendors/video/videojs.min.css', __FILE__ ) );
		wp_register_style( 'video-js-theaterMode', plugins_url( 'assets/vendors/video/videojs.theaterMode.css', __FILE__ ) );
	}
	
	/**
	 * Register scripts & styles
	 *
	 * @access public
	 */
	public function enqueue_core_styles(){
		wp_enqueue_style( 'sp-core-style', plugins_url( 'assets/css/style.css', __FILE__ ) );
		wp_enqueue_script( 'sp-core-script', plugins_url( 'assets/js/scripts.js', __FILE__ ), array( 'jquery' ), false, true );
	}

	/**
	 * Register Widget Scripts
	 *
	 * Register custom scripts required to run Docy Core.
	 *
	 * @access public
	 */
	public function register_widget_scripts() {
		wp_register_script( 'ajax-chimp', plugins_url( 'assets/js/ajax-chimp.js', __FILE__ ), 'jquery', '1.0', true );
		wp_register_script( 'prism', plugins_url( 'assets/vendors/prism/prism.js', __FILE__ ), array( 'jquery' ), '1.17.1', true );
		wp_register_script( 'tooltipster', plugins_url( 'assets/vendors/tooltipster/js/tooltipster.bundle.min.js', __FILE__ ), array( 'jquery' ), '4.2.8', true );
		wp_register_script( 'parallaxie', plugins_url( 'assets/js/parallaxie.js', __FILE__ ), array( 'jquery' ), '0.5', true );
		wp_register_script( 'nice-select', plugins_url( 'assets/vendors/niceselectpicker/jquery.nice-select.min.js', __FILE__ ), 'jquery', '1.0', true );
		wp_register_script( 'floatThead', plugins_url( 'assets/js/jquery.floatThead.min.js', __FILE__ ), array( 'jquery' ), '2.1.4', true );
		wp_register_script( 'counterup', plugins_url( 'assets/vendors/counterup/jquery.counterup.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
		wp_register_script( 'waypoints', plugins_url( 'assets/vendors/counterup/jquery.waypoints.min.js', __FILE__ ), array( 'jquery' ), '4.0.1', true );
		wp_register_script( 'tweenmax', plugins_url( 'assets/js/TweenMax.min.js', __FILE__ ), array( 'jquery' ), '2.0.0', true );
		wp_register_script( 'wavify', plugins_url( 'assets/js/jquery.wavify.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
		wp_register_script( 'chart', plugins_url( 'assets/js/Chart.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
		wp_register_script( 'slick', plugins_url( 'assets/vendors/slick/slick.min.js', __FILE__ ), array( 'jquery' ), '1.9.0', true );
		wp_register_script( 'wow', plugins_url( 'assets/vendors/wow/wow.min.js', __FILE__ ), array( 'jquery' ), '1.9.0', true );
		wp_register_script( 'artplayer', plugins_url( 'assets/vendors/video/artplayer.js', __FILE__ ), array( 'jquery' ), '3.5.26', true );
		wp_register_script( 'mcustomscrollbar', plugins_url( 'assets/vendors/mcustomscrollbar/jquery.mCustomScrollbar.concat.min.js', __FILE__ ), array( 'jquery' ), '3.1.13', true );
		wp_register_script( 'parallax-scroll', plugins_url( 'assets/js/jquery.parallax-scroll.js', __FILE__ ), array( 'jquery' ), '3.1.13', true );
		wp_register_script( 'video-js', plugins_url( 'assets/vendors/video/video.min.js', __FILE__ ), array( 'jquery' ), '7.6.0', true );
		wp_register_script( 'video-js-nuevo', plugins_url( 'assets/vendors/video/nuevo.min.js', __FILE__ ), array( 'jquery' ), '7.6.0', true );
	}

	public function enqueue_elementor_editor_styles() {
		wp_enqueue_style( 'docy-elementor-editor', plugins_url( 'assets/css/elementor-editor.css', __FILE__ ) );
	}

	public function enqueue_scripts() {
		wp_deregister_style( 'elementor-animations' );
		wp_deregister_style( 'e-animations' );
		if ( is_post_type_archive( 'topic' ) ) {
			wp_deregister_style( 'bbp-default' );
		}
		//wp_deregister_script('wedocs-anchorjs');
	}

	public function register_admin_styles() {
		wp_enqueue_style( 'docy-gutenberg-editor', plugins_url( 'assets/css/gutenberg-editor.css', __FILE__ ) );
		//wp_enqueue_style( 'docy_core_admin', plugins_url( 'assets/css/spider-elements-admin.css', __FILE__ ) );
	}

	public function gutenberg_editor_scripts() {
		wp_enqueue_style( 'docy-gutenberg-editor', plugins_url( 'assets/css/gutenberg-editor.css', __FILE__ ) );
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
}

// Instantiate Elementor_Hello_World.
new Spider_Elements();
