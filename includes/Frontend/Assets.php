<?php
namespace SPEL\includes\Frontend;

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Assets Class
 */
class Assets
{
	public function __construct()
	{
        // Register Widget Style's
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'register_widget_styles']);

        // Register Widget Script's
        add_action('elementor/editor/after_enqueue_scripts', [$this, 'register_widget_scripts']);
        add_action('elementor/frontend/after_register_scripts', [$this, 'register_widget_scripts']);

        // Register Elementor Preview Editor Script's
        add_action('elementor/editor/after_enqueue_scripts', [$this, 'register_editor_scripts']);
        add_action('elementor/frontend/after_enqueue_scripts', [$this, 'register_editor_scripts']);


        // Register Elementor Preview Editor Style's
        add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'elementor_editor_scripts' ] );
	}


	/**
	 * Register Widget Scripts
	 *
	 * Register custom style required to run Spider Elements.
	 *
	 * @access public
	 */
	function register_widget_styles(): void
    {
        $elements_opt   = get_option( 'spel_features_settings' );

        if ( isset($elements_opt['spel_smooth_animation']) && $elements_opt[ 'spel_smooth_animation' ] == 'on' ) {

            // Define all the handlers in one string, separated by commas
            $handlers = [
                'e-animations',
                'e-animation-fadeIn',
                'e-animation-fadeInUp',
                'e-animation-fadeInRight',
                'e-animation-fadeInDown',
                'e-animation-fadeInLeft',
                'e-animation-zoomIn',
            ];

            // Deregister all styles for the handlers
            foreach ($handlers as $handler) {
                wp_deregister_style($handler);
            }

            // Enqueue all handlers pointing to the same file
            foreach ($handlers as $handler) {
                wp_enqueue_style($handler, SPEL_VEND . '/animation/animate.css', [], SPEL_VERSION );
            }

        }

        wp_register_style('ionicons', SPEL_VEND . '/ionicons/ionicons.min.css', [], '2.0.1');
		wp_register_style('slick-theme', SPEL_VEND . '/slick/slick-theme.css', [], SPEL_VERSION);
        wp_register_style('slick', SPEL_VEND . '/slick/slick.css', [], SPEL_VERSION);
        wp_register_style('swiper', SPEL_VEND . '/swiper/swiper-bundle.min.css', [], '7.2.0');
		wp_register_style('video-js', SPEL_VEND . '/video/videojs.min.css', [], SPEL_VERSION);
		wp_register_style('video-js-theaterMode', SPEL_VEND . '/video/videojs.theaterMode.css', [], SPEL_VERSION);
		wp_register_style('elegant-icon', SPEL_VEND . '/elegant-icon/style.css', [], SPEL_VERSION);
		wp_register_style('fancybox', SPEL_VEND . '/fancybox/css/jquery.fancybox.min.css', [], SPEL_VERSION);
		wp_register_style('spel-main', SPEL_CSS . '/main.css', [], SPEL_VERSION);

		if ( is_rtl() ) {
			wp_enqueue_style( 'spel-rtl', SPEL_CSS . '/rtl.css' );
		}

        wp_enqueue_style('spel-extension', SPEL_CSS . '/extension.css');

	}

	/**
	 * Register Widget Scripts
	 *
	 * Register custom scripts required to run Spider Elements.
	 *
	 * @access public
	 */
	function register_widget_scripts()
	{

		wp_register_script('ionicons', 'https://unpkg.com/ionicons@latest/dist/ionicons.js', '', SPEL_VERSION, true);
		wp_register_script('slick', SPEL_VEND . '/slick/slick.min.js', array('jquery'), SPEL_VERSION, true);
		wp_register_script('swiper', SPEL_VEND . '/swiper/swiper-bundle.min.js', array('jquery'), SPEL_VERSION, true);
		wp_register_script('text-type', SPEL_VEND . '/text-type/text-type.js', array('jquery'), SPEL_VERSION, true);
		wp_register_script('counterup', SPEL_VEND . '/counterup/jquery.counterup.min.js', array('jquery'), SPEL_VERSION, true);
		wp_register_script('waypoint', SPEL_VEND . '/waypoint/jquery.waypoints.min.js', array('jquery'), SPEL_VERSION, true);
		wp_register_script('wow', SPEL_VEND . '/wow/wow.min.js', array('jquery'), '1.1.3', true);
		wp_register_script('artplayer', SPEL_VEND . '/video/artplayer.js', array('jquery'), '3.5.26', true);
		wp_register_script('video-js-nuevo', SPEL_VEND . '/video/nuevo.min.js', array('jquery'), '7.6.0', true);
		wp_register_script('video-js', SPEL_VEND . '/video/video.min.js', array('jquery'), '7.6.0', true);
		wp_register_script('scroll-parallax', SPEL_VEND . '/scroll-parallax/jquery.parallax-scroll.js', array('jquery'), SPEL_VERSION, true);
		wp_register_script('fancybox', SPEL_VEND . '/fancybox/js/jquery.fancybox.min.js', array('jquery'), '3.5.7', true);
		wp_register_script('ajax-chimp', SPEL_JS . '/ajax-chimp.js', 'jquery', SPEL_VERSION, true);
        wp_register_script('charming', SPEL_VEND  . '/diagonal/charming.min.js', array('jquery'), SPEL_VERSION, true);
        wp_register_script('tweenmax', SPEL_VEND  . '/diagonal/TweenMax.min.js', array('jquery'), '1.18.0', true);
        wp_register_script('beforeafter', SPEL_VEND  . '/before/beforeafter.jquery-1.0.0.min.js', array('jquery'), '1.0.0', true);
        wp_register_script('spel-script', SPEL_JS . '/scripts.js', array('jquery'), SPEL_VERSION, true);
    }


	/**
	 * Register Widget Styles
	 *
	 * Register custom styles required to run Spider Elements.
	 *
	 * @access public
	 */
	function register_editor_scripts(): void
    {
		wp_register_script('spel-el-widgets', SPEL_JS . '/elementor-widgets.js', [
			'jquery',
			'elementor-frontend'
		], SPEL_VERSION, true);
	}


    /**
     * Register Widget Styles
     *
     * Register custom styles required to run Spider Elements.
     *
     * @access public
     */
    public function elementor_editor_scripts(): void
    {
        wp_enqueue_style( 'spel-elementor-editor', SPEL_CSS . '/elementor-editor.css', [],  SPEL_VERSION );
    }


}