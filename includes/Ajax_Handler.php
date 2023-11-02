<?php

namespace Spider_Elements_Assets\includes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}// Exit if accessed directly

class Ajax_Handler {

	public function __construct() {

		$this->init_ajax_hooks();

	}


	public function init_ajax_hooks() {

		//Admin Settings
		if ( is_admin() ) {

			add_action( 'wp_ajax_save_settings_with_ajax', [ $this, 'save_settings' ] );

		}

	}



	public function save_settings() {

		echo 'Hello World!';

	}

}

new Ajax_Handler();