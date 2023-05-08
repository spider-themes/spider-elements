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
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_core_styles' ] );
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'se_elementor_enqueue_scripts' ] );

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'plugin.php' );
	}
	

	/**
	 * Register scripts & styles
	 *
	 * @access public
	 */
	public function enqueue_core_styles(){
		wp_enqueue_style( 'se-main-style', plugins_url( 'assets/css/main.css', __FILE__ ) );
		// wp_enqueue_style( 'se-core-common-style', plugins_url( 'assets/css/common.css', __FILE__ ) );
		wp_enqueue_style( 'se-bootstrap', plugins_url( 'assets/vendors/Bootstrap/bootstrap.min.css', __FILE__ ) ); 
		//JS
		wp_enqueue_script( 'se-core-script', plugins_url( 'assets/js/scripts.js', __FILE__ ), array( 'jquery' ), false, true );
		wp_enqueue_script( 'bootstrap', plugins_url( 'assets/vendors/bootstrap/bootstrap.bundle.min.js', __FILE__ ), array( 'jquery' ), '5.1.3', true );
		// wp localize scripts
		wp_localize_script( 'se-core-script', 'se_ajax', array(
			'ajax_url' 	=> admin_url( 'admin-ajax.php' ),
			'nonce' 	=> wp_create_nonce( 'se_ajax_nonce' )
		) );
		
	}
	public function se_elementor_enqueue_scripts() {
		wp_enqueue_script( 'se-elementor', plugins_url( 'assets/js/se-elementor.js', __FILE__ ), array( 'jquery' ), false, true );
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

// Instantiate Spider_Elements.
new Spider_Elements();
