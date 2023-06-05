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

        //wp_register_style( 'slick-theme', SE_VEND . '/slick/slick-theme.css' );
        //wp_register_style( 'slick', SE_VEND . '/slick/slick.css' );
        wp_register_style( 'elegant-icon', SE_VEND . '/elegant-icon/style.css' );

    }

    /**
     * Register Widget Scripts
     *
     * Register custom scripts required to run Spider Elements.
     *
     * @access public
     */
    function register_sp_widget_scripts() {

        wp_register_script( 'parallaxie', SE_VEND . '/parallax/parallaxie.js', array( 'jquery' ), '0.5', true );
        wp_register_script( 'parallax-scroll', SE_VEND . '/parallax/jquery.parallax-scroll.js', array( 'jquery' ), SE_VERSION, true );
        //wp_register_script( 'slick', SE_VEND . '/slick/slick.min.js', array( 'jquery' ), SE_VERSION, true );
        wp_register_script( 'wow', SE_VEND . '/wow/wow.min.js', array( 'jquery' ), '1.1.3', true );
        wp_register_script( 'artplayer', SE_VEND . '/video/artplayer.js', array( 'jquery' ), '3.5.26', true );
        wp_register_script( 'video-js', SE_VEND . '/video/video.min.js', array( 'jquery' ), '7.6.0', true );
        wp_register_script( 'video-js-nuevo', SE_VEND . '/video/nuevo.min.js', array( 'jquery' ), '7.6.0', true );

        wp_register_script( 'ajax-chimp', SE_JS . 'ajax-chimp.js', 'jquery', SE_VERSION, true );

    }


    /**
     * Register Widget Styles
     *
     * Register custom styles required to run Spider Elements.
     *
     * @access public
     */
    function enqueue_elementor_scripts() {

        wp_enqueue_script( 'spider-elements-widgets', SE_JS . '/spider-elements-widgets.js', [ 'jquery', 'elementor-frontend'], SE_VERSION, true );

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
        //wp_enqueue_style( 'bootstrap', SE_VEND . '/bootstrap/bootstrap.min.css' );

        wp_enqueue_style( 'elegant-icon', SE_VEND . '/elegant-icon/style.css' );
        wp_enqueue_style( 'spider-elements-common', SE_CSS . '/common.css' );
        wp_enqueue_style( 'spider-elements-main', SE_CSS . '/main.css' );


        /**
         * Enqueue Script's
         */
        //wp_enqueue_script( 'bootstrap', SE_VEND . '/bootstrap/bootstrap.min.js', array( 'jquery' ), '5.1.3', true );
        wp_enqueue_script( 'spider-elements-script', SE_JS . '/scripts.js', array( 'jquery' ), false, true );

    }


}

new Assets();