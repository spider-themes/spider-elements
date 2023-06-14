<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Assets
 * @package spiderElements\Admin
 */
class Admin_Assets {

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
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'se_register_editor_styles' ] );

	}

	/**
	 * Register Widget Styles
	 *
	 * Register custom styles required to run Spider Elements.
	 *
	 * @access public
	 */
	function se_register_editor_styles() {
		wp_register_style( 'se-el-editor', SE_CSS . '/elementor-editor.css');
		wp_enqueue_style( 'se-el-editor', SE_CSS . '/elementor-editor.css' );
	}
}

new Admin_Assets();
