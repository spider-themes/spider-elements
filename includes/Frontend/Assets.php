<?php
namespace Spider_Elements_Assets\includes\Frontend;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Assets Class
 */
class Assets {

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'register_scripts' ] );
	}

	public function register_scripts() {

		// Register Widget Style's
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'se_register_widget_styles' ] );

		// Register Widget Script's
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'se_register_widget_scripts' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'se_register_widget_scripts' ] );

		// Register Elementor Preview Editor Script's
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'se_register_editor_scripts' ] );
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'se_register_editor_scripts' ] );

	}


	/**
	 * Register Widget Scripts
	 *
	 * Register custom style required to run Spider Elements.
	 *
	 * @access public
	 */
	function se_register_widget_styles() {

		wp_register_style( 'ionicons', 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css' );
		wp_register_style( 'bootstrap', SE_VEND . '/bootstrap/bootstrap.min.css' );
		wp_register_style( 'slick-theme', SE_VEND . '/slick/slick-theme.css' );
		wp_register_style( 'swiper-theme', SE_VEND . '/swiper/swiper-bundle.min.css' );
		wp_register_style( 'slick', SE_VEND . '/slick/slick.css' );
		wp_register_style( 'video-js', SE_VEND . '/video/videojs.min.css' );
		wp_register_style( 'video-js-theaterMode', SE_VEND . '/video/videojs.theaterMode.css' );
		wp_register_style( 'elegant-icon', SE_VEND . '/elegant-icon/style.css' );
		wp_register_style( 'spe-main', SE_CSS . '/main.css' );

	}

	/**
	 * Register Widget Scripts
	 *
	 * Register custom scripts required to run Spider Elements.
	 *
	 * @access public
	 */
	function se_register_widget_scripts() {

		wp_register_script( 'ionicons', 'https://unpkg.com/ionicons@5.4.0/dist/ionicons.js', '', '5.4.0', true );
		wp_register_script( 'bootstrap', SE_VEND . '/bootstrap/bootstrap.min.js', array( 'jquery' ), '5.1.3', true );
		wp_register_script( 'slick', SE_VEND . '/slick/slick.min.js', array( 'jquery' ), SE_VERSION, true );
		wp_register_script( 'swiper', SE_VEND . '/swiper/swiper-bundle.min.js', array( 'jquery' ), SE_VERSION, true );
		wp_register_script( 'wow', SE_VEND . '/wow/wow.min.js', array( 'jquery' ), '1.1.3', true );
		wp_register_script( 'artplayer', SE_VEND . '/video/artplayer.js', array( 'jquery' ), '3.5.26', true );
		wp_register_script( 'video-js-nuevo', SE_VEND . '/video/nuevo.min.js', array( 'jquery' ), '7.6.0', true );
		wp_register_script( 'video-js', SE_VEND . '/video/video.min.js', array( 'jquery' ), '7.6.0', true );
		wp_register_script( 'scroll-parallax', SE_VEND . '/scroll-parallax/jquery.parallax-scroll.js', array( 'jquery' ), SE_VERSION, true );

		wp_register_script( 'ajax-chimp', SE_JS . 'ajax-chimp.js', 'jquery', SE_VERSION, true );
		wp_register_script( 'se-script', SE_JS . '/scripts.js', array( 'jquery' ), false, true );

	}


	/**
	 * Register Widget Styles
	 *
	 * Register custom styles required to run Spider Elements.
	 *
	 * @access public
	 */
	function se_register_editor_scripts() {
		wp_register_script( 'spe-el-widgets', SE_JS . '/elementor-widgets.js', [
			'jquery',
			'elementor-frontend'
		], SE_VERSION, true );
	}


}

new Assets();