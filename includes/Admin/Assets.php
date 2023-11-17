<?php
namespace Spider_Elements\includes\Admin;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Assets
 * @package spiderElements\Admin
 */
class Assets {

	/**
	 * Assets constructor.
	 */
	public function __construct() {

		add_action( 'plugins_loaded', [$this, 'register_scripts'] );

	}

	/**
	 * Register scripts and styles
	 **/
	public function register_scripts() {

		// Register Elementor Preview Editor Style's
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'spe_elementor_editor_scripts' ] );

		// Register Admin Panel Scripts
		add_action( 'admin_enqueue_scripts', [ $this, 'spe_admin_scripts' ] );

	}

	/**
	 * Register Widget Styles
	 *
	 * Register custom styles required to run Spider Elements.
	 *
	 * @access public
	 */
	public function spe_elementor_editor_scripts() {
		wp_enqueue_style( 'spe-el-editor', SPE_CSS . '/elementor-editor.css');
	}


	/**
	 * Register Admin Panel Scripts
	 *
	 * Register custom scripts required to run Spider Elements.
	 *
	 * @access public
	 */
	public function spe_admin_scripts() {

		// Register Admin Panel Styles
		wp_enqueue_style( 'icomoon', SPE_VEND . '/icomoon/style.css' );
		wp_enqueue_style( 'spe-circle', SPE_VEND . '/circle-progressbar/circularprogress.css' );
		wp_enqueue_style( 'spe-fancy', SPE_VEND . '/fancybox/css/jquery.fancybox.min.css' );
		wp_enqueue_style( 'spe-admin', SPE_CSS . '/admin.css');

		// Register Admin Panel Scripts
		wp_enqueue_script( 'spe-waypoint', SPE_VEND . '/circle-progressbar/jquery.waypoints.min.js', ['jquery'], SPE_VERSION, true );
		wp_enqueue_script( 'spe-counterup', SPE_VEND . '/circle-progressbar/jquery.counterup.min.js', ['jquery'], SPE_VERSION, true );
		wp_enqueue_script( 'spe-imageloaded', SPE_VEND . '/imagesloaded/imagesloaded.pkgd.min.js', ['jquery'], SPE_VERSION, true );
		wp_enqueue_script( 'spe-isotope', SPE_VEND . '/isotope/isotope.min.js', ['jquery'], SPE_VERSION, true );
		wp_enqueue_script( 'spe-fancy', SPE_VEND . '/fancybox/js/jquery.fancybox.min.js', ['jquery'], SPE_VERSION, true );
		wp_enqueue_script( 'spe-circle', SPE_VEND . '/circle-progressbar/circle-progress.js', ['jquery'], SPE_VERSION, true );
		wp_enqueue_script( 'spe-admin', SPE_JS . '/admin.js', ['jquery'], SPE_VERSION, true );
	}


}

new Assets();