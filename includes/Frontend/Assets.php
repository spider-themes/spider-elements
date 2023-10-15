<?php
namespace Spider_Elements\includes\Frontend;

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
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'register_widget_styles' ] );

		// Register Widget Script's
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'register_widget_scripts' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_widget_scripts' ] );

		// Register Elementor Preview Editor Script's
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'register_editor_scripts' ] );
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'register_editor_scripts' ] );

	}


	/**
	 * Register Widget Scripts
	 *
	 * Register custom style required to run Spider Elements.
	 *
	 * @access public
	 */
	function register_widget_styles() {

		wp_register_style( 'ionicons', 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css' );
		wp_register_style( 'bootstrap', SPE_VEND . '/bootstrap/bootstrap.min.css' );
		wp_register_style( 'slick-theme', SPE_VEND . '/slick/slick-theme.css' );
		wp_register_style( 'swiper-theme', SPE_VEND . '/swiper/swiper-bundle.min.css' );
		wp_register_style( 'slick', SPE_VEND . '/slick/slick.css' );
		wp_register_style( 'video-js', SPE_VEND . '/video/videojs.min.css' );
		wp_register_style( 'video-js-theaterMode', SPE_VEND . '/video/videojs.theaterMode.css' );
		wp_register_style( 'elegant-icon', SPE_VEND . '/elegant-icon/style.css' );
		wp_register_style( 'fancybox-css', SPE_VEND . '/fancybox/css/jquery.fancybox.min.css' );
		wp_register_style( 'spe-main', SPE_CSS . '/main.css' );

	}

	/**
	 * Register Widget Scripts
	 *
	 * Register custom scripts required to run Spider Elements.
	 *
	 * @access public
	 */
	function register_widget_scripts() {

		wp_register_script( 'ionicons', 'https://unpkg.com/ionicons@5.4.0/dist/ionicons.js', '', '5.4.0', true );
		wp_register_script( 'bootstrap', SPE_VEND . '/bootstrap/bootstrap.min.js', array( 'jquery' ), '5.1.3', true );
		wp_register_script( 'slick', SPE_VEND . '/slick/slick.min.js', array( 'jquery' ), SPE_VERSION, true );
		wp_register_script( 'swiper', SPE_VEND . '/swiper/swiper-bundle.min.js', array( 'jquery' ), SPE_VERSION, true );
		wp_register_script( 'text-type', SPE_VEND . '/text-type/text-type.js', array( 'jquery' ), SPE_VERSION, true );
		wp_register_script( 'wow', SPE_VEND . '/wow/wow.min.js', array( 'jquery' ), '1.1.3', true );
		wp_register_script( 'artplayer', SPE_VEND . '/video/artplayer.js', array( 'jquery' ), '3.5.26', true );
		wp_register_script( 'video-js-nuevo', SPE_VEND . '/video/nuevo.min.js', array( 'jquery' ), '7.6.0', true );
		wp_register_script( 'video-js', SPE_VEND . '/video/video.min.js', array( 'jquery' ), '7.6.0', true );
		wp_register_script( 'scroll-parallax', SPE_VEND . '/scroll-parallax/jquery.parallax-scroll.js', array( 'jquery' ), SPE_VERSION, true );
		wp_register_script( 'fancybox-js', SPE_VEND . '/fancybox/js/jquery.fancybox.min.js', array( 'jquery' ), '3.5.7', true );
		wp_register_script( 'ajax-chimp', SPE_JS . '/ajax-chimp.js', 'jquery', SPE_VERSION, true );
		wp_register_script( 'spe-script', SPE_JS . '/scripts.js', array( 'jquery' ), false, true );

		wp_register_script( 'charming', SPE_VEND  . '/diagonal/charming.min.js', array( 'jquery' ), SPE_VERSION, true );
		wp_register_script( 'tweenmax', SPE_VEND  . '/diagonal/TweenMax.min.js', array( 'jquery' ), '1.18.0', true );

		wp_register_script( 'beforeafter', SPE_VEND  . '/before/beforeafter.jquery-1.0.0.min.js', array( 'jquery' ), '1.0.0', true );
	}


	/**
	 * Register Widget Styles
	 *
	 * Register custom styles required to run Spider Elements.
	 *
	 * @access public
	 */
	function register_editor_scripts() {
		wp_register_script( 'spe-el-widgets', SPE_JS . '/elementor-widgets.js', [
			'jquery',
			'elementor-frontend'
		], SPE_VERSION, true );
	}


}

new Assets();