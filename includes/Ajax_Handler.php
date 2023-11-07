<?php

namespace Spider_Elements_Assets\includes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}// Exit if accessed directly

class Ajax_Handler {


	/**
	 * Ajax_Handler constructor.
	 */
	public function __construct() {

		$this->init_ajax_hooks();

	}


	/**
	 * Init ajax hooks
	 */
	public function init_ajax_hooks() {

		//Admin Settings
		if ( is_admin() ) {

			add_action( 'wp_ajax_save_settings_with_ajax', [ $this, 'save_settings' ] );

		}

	}



	public function save_settings() {

		if ( isset( $_POST['data'] ) ) {

			$data = $_POST['data'];

			$settings = get_option( 'spider_elements_save_settings' );

			$settings['spider_elements_save_settings'] = $data;

			update_option( 'spider_elements_save_settings', $settings );

			wp_send_json_success( $settings );

		}

		wp_send_json_error();

	}

}

new Ajax_Handler();