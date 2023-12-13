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
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'elementor_editor_scripts' ] );

		// Register Admin Panel Scripts
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );

	}

	/**
	 * Register Widget Styles
	 *
	 * Register custom styles required to run Spider Elements.
	 */
	public function elementor_editor_scripts() {
		wp_enqueue_style( 'spel-el-editor', SPEL_CSS . '/elementor-editor.css');
	}


	/**
	 * Register Admin Panel Scripts
	 *
	 * Register custom scripts required to run Spider Elements.
	 */
	public function admin_scripts() {

		// Register Admin Panel Styles
		wp_enqueue_style( 'spel-admin', SPEL_CSS . '/admin.css');

	}


}

new Assets();