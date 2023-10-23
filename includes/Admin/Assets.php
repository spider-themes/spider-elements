<?php
namespace Spider_Elements_Assets\includes\Admin;

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
		wp_enqueue_style( 'spe-admin', SPE_CSS . '/admin.css');

		// Register Admin Panel Scripts
		wp_enqueue_script( 'spe-admin', SPE_JS . '/admin.js', ['jquery'], SPE_VERSION, true );
	}


}

new Assets();