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
        $theme = wp_get_theme();
        $features_opt   = get_option( 'spel_features_settings' );
        $is_premium_or_theme = spel_is_premium() || in_array($theme->get('Name'), ['jobi', 'Jobi', 'jobi-child', 'Jobi Child']);

        if ( isset($features_opt['spel_smooth_animation']) && $features_opt[ 'spel_smooth_animation' ] == 'on' ) {

            // Define all the handlers in one string, separated by commas
            $handlers = [
                'e-animations',
                'e-animation-fadeIn',
                'e-animation-fadeInUp',
                'e-animation-fadeInRight',
                'e-animation-fadeInDown',
                'e-animation-fadeInLeft',
                'e-animation-zoomIn',
                'e-animation-zoomInUp',
                'e-animation-zoomInRight',
                'e-animation-zoomInDown',
                'e-animation-zoomInLeft',
                'e-animation-grow',
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

        if ( $is_premium_or_theme ) {
            if ( isset($features_opt['spel_heading_highlighted']) && $features_opt[ 'spel_heading_highlighted' ] == 'on' ) {
                wp_enqueue_style('spel-extension');
            }
            if ( isset($features_opt['spel_badge']) && $features_opt[ 'spel_badge' ] == 'on' ) {
                wp_enqueue_style('spel-extension');
            }
        }

        wp_register_style('spel-extension', SPEL_CSS . '/extension.css', [], SPEL_VERSION);
        wp_register_style('font-awesome', SPEL_VEND . '/font-awesome/css/all.css', [], '6.4.0');
		wp_register_style('slick-theme', SPEL_VEND . '/slick/slick-theme.css', [], SPEL_VERSION);
        wp_register_style('slick', SPEL_VEND . '/slick/slick.css', [], SPEL_VERSION);
        wp_register_style('swiper', SPEL_VEND . '/swiper/swiper.min.css', [], '7.2.0');
		wp_register_style( 'videojs', SPEL_VEND . '/video/videojs.min.css', [], SPEL_VERSION);
		wp_register_style('video-theaterMode', SPEL_VEND . '/video/videojs.theaterMode.css', [], SPEL_VERSION);
		wp_register_style('elegant-icon', SPEL_VEND . '/elegant-icon/style.css', [], SPEL_VERSION);
		wp_register_style('fancybox', SPEL_VEND . '/fancybox/fancybox.min.css', [], SPEL_VERSION);

		if ( is_rtl() ) {
            wp_register_style( 'spel-main', SPEL_CSS . '/rtl.css', [], SPEL_VERSION );
		} else {
            wp_register_style('spel-main', SPEL_CSS . '/main.css', [], SPEL_VERSION);
        }

	}

	/**
	 * Register Widget Scripts
	 *
	 * Register custom scripts required to run Spider Elements.
	 *
	 * @access public
	 */
	function register_widget_scripts(): void
    {

        wp_register_script('slick', SPEL_VEND . '/slick/slick.min.js', ['jquery'], SPEL_VERSION, ['strategy' => 'defer'] );
		wp_register_script('swiper', SPEL_VEND . '/swiper/swiper.min.js', ['jquery'], '7.2.0', ['strategy' => 'defer'] );
		wp_register_script('text-type', SPEL_VEND . '/text-type/text-type.js', ['jquery'], SPEL_VERSION, ['strategy' => 'defer'] );
		wp_register_script('counterup', SPEL_VEND . '/counterup/counterup.min.js', ['jquery'], '1.0', ['strategy' => 'defer'] );
		wp_register_script('waypoint', SPEL_VEND . '/counterup/waypoints.min.js', ['jquery'], '4.0.1', ['strategy' => 'defer'] );
		wp_register_script('wow', SPEL_VEND . '/wow/wow.min.js', ['jquery'], '1.1.3', ['strategy' => 'defer'] );
		wp_register_script('artplayer', SPEL_VEND . '/video/artplayer.js', ['jquery'], '3.5.26', ['strategy' => 'defer'] );
		wp_register_script('video-nuevo', SPEL_VEND . '/video/nuevo.min.js', ['jquery'], '7.6.0', ['strategy' => 'defer'] );
		wp_register_script('video', SPEL_VEND . '/video/video.min.js', ['jquery'], '7.6.0', ['strategy' => 'defer'] );
		wp_register_script('scroll-parallax', SPEL_VEND . '/scroll-parallax/parallax-scroll.js', ['jquery'], SPEL_VERSION, ['strategy' => 'defer'] );
		wp_register_script('fancybox', SPEL_VEND . '/fancybox/fancybox.min.js', ['jquery'], '3.5.7', ['strategy' => 'defer'] );
        wp_register_script('before-after', SPEL_VEND  . '/before-after/before-after.min.js', ['jquery'], '1.0.0', ['strategy' => 'defer'] );

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
		wp_register_script('spel-el-widgets', SPEL_JS . '/elementor-widgets.js', ['jquery', 'elementor-frontend'], SPEL_VERSION, ['strategy' => 'defer'] );
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

