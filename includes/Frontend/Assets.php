<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Assets Class
 */
class Assets {

    public function __construct() {
        add_action( 'init', [$this, 'register_scripts'] );
    }

    public function register_scripts () {

        // Register Widget Style's
        add_action( 'elementor/frontend/before_enqueue_styles', [ $this, 'elementor_register_widget_styles' ] );
        add_action( 'elementor/editor/before_enqueue_styles', [ $this, 'elementor_register_widget_styles' ] );

        // Register Widget Script's
        add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_sp_widget_scripts' ] );
        add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'register_sp_widget_scripts' ] );

        // Register Elementor Preview Editor Script's
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'enqueue_elementor_scripts' ]);
        add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'enqueue_elementor_scripts' ]);

        // Enqueue Scripts
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ] );

    }


    /**
     * Register Widget Scripts
     *
     * Register custom style required to run Spider Elements.
     *
     * @access public
     */
    function elementor_register_widget_styles() {

        /**
         * Register Style's
         */
        //wp_register_style( 'ionicons', 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', '', '2.0.1' );

        wp_register_style( 'prism', SPE_VEND . '/prism/prism.min.css');
        wp_register_style( 'nice-select', SPE_VEND . '/nice-select/nice-select.min.css' );
        wp_register_style( 'slick-theme', SPE_VEND . '/slick/slick-theme.css' );
        wp_register_style( 'slick', SPE_VEND . '/slick/slick.css' );
        wp_register_style( 'elegant-icon', SPE_VEND . '/elegant-icon/style.css' );

    }

    /**
     * Register Widget Scripts
     *
     * Register custom scripts required to run Spider Elements.
     *
     * @access public
     */
    function register_sp_widget_scripts() {

        wp_register_script( 'parallaxie', SPE_VEND . '/parallax/parallaxie.js', array( 'jquery' ), '0.5', true );
        wp_register_script( 'parallax-scroll', SPE_VEND . '/parallax/jquery.parallax-scroll.js', array( 'jquery' ), SPE_VERSION, true );
        wp_register_script( 'slick', SPE_VEND . '/slick/slick.min.js', array( 'jquery' ), SPE_VERSION, true );
        wp_register_script( 'wow', SPE_VEND . '/wow/wow.min.js', array( 'jquery' ), '1.1.3', true );
        wp_register_script( 'artplayer', SPE_VEND . '/video/artplayer.js', array( 'jquery' ), '3.5.26', true );
        wp_register_script( 'video-js', SPE_VEND . '/video/video.min.js', array( 'jquery' ), '7.6.0', true );
        wp_register_script( 'video-js-nuevo', SPE_VEND . '/video/nuevo.min.js', array( 'jquery' ), '7.6.0', true );

        wp_register_script( 'ajax-chimp', SPE_JS . 'ajax-chimp.js', 'jquery', SPE_VERSION, true );

    }


    /**
     * Register Widget Styles
     *
     * Register custom styles required to run Spider Elements.
     *
     * @access public
     */
    function enqueue_elementor_scripts() {

        wp_enqueue_script( 'spider-elements-widgets', SPE_JS . '/spider-elements-widgets.js', [ 'jquery', 'elementor-frontend'], SPE_VERSION, true );

    }


    /**
     * Register Widget Styles
     *
     * Register custom styles required to run Spider Elements.
     *
     * @access public
     */
    public function enqueue_scripts() {


        /**
         * Enqueue Style's
         */
        wp_enqueue_style( 'bootstrap', SPE_VEND . '/bootstrap/bootstrap.min.css' );

        wp_enqueue_style( 'spider-elements-common', SPE_CSS . 'common.css' );
        wp_enqueue_style( 'spider-elements-main', SPE_CSS . '/main.css' );


        /**
         * Enqueue Script's
         */
        wp_enqueue_script( 'bootstrap', SPE_VEND . '/bootstrap/bootstrap.min.js', array( 'jquery' ), '5.1.3', true );
        wp_enqueue_script( 'spider-elements-script', plugins_url( 'assets/js/scripts.js', __FILE__ ), array( 'jquery' ), false, true );

    }


}

new Assets();