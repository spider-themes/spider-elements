<?php
namespace SPEL\includes\Admin;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Assets
 * @package SPEL\Admin
 */
class Assets {

	/**
	 * Assets constructor.
	 */
	public function __construct() {

		add_action( 'plugins_loaded', [$this, 'register_scripts'] );

        add_action('fonts_url', [$this, 'fonts_url']);

	}

    public function fonts_url(): string
    {

        $fonts_url = '';
        $fonts     = array();
        $subsets   = '';

        /* Body font */
        if ( 'off' !== 'on' ) {
            $fonts[] = "Inter:400,500,600,700";
        }
        if ( 'off' !== 'on' ) {
            $fonts[] = "Roboto:400,500,600";
        }

        $is_ssl = is_ssl() ? 'https' : 'http';

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), "$is_ssl://fonts.googleapis.com/css" );
        }

        return $fonts_url;

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
	 *
	 * @access public
	 */
	public function elementor_editor_scripts() {

        wp_enqueue_style( 'spel-elementor-editor', SPEL_CSS . '/spel-elementor-editor.css', [],  SPEL_VERSION );

        if ( spel_is_premium() ) {
            wp_enqueue_style( 'spel-pro-elementor-editor', SPEL_CSS . '/spel-pro-elementor-editor.css', [],  SPEL_VERSION );
        }

	}


	/**
	 * Register Admin Panel Scripts
	 *
	 * Register custom scripts required to run Spider Elements.
	 *
	 * @access public
	 */
	public function admin_scripts() {

		// Register Admin Panel Styles
		wp_enqueue_style( 'spel-fonts', self::fonts_url(), [], SPEL_VERSION );
		wp_enqueue_style( 'icomoon', SPEL_VEND . '/icomoon/style.css', [], SPEL_VERSION );
		wp_enqueue_style( 'spel-circle', SPEL_VEND . '/circle-progressbar/circularprogress.css', [], SPEL_VERSION );
		wp_enqueue_style( 'spel-fancy', SPEL_VEND . '/fancybox/css/jquery.fancybox.min.css', [], SPEL_VERSION );
		wp_enqueue_style( 'spel-admin', SPEL_CSS . '/admin.css', [], SPEL_VERSION);


		// Register Admin Panel Scripts
		wp_enqueue_script( 'spel-waypoint', SPEL_VEND . '/circle-progressbar/jquery.waypoints.min.js', ['jquery'], SPEL_VERSION, true );
		wp_enqueue_script( 'spel-counterup', SPEL_VEND . '/circle-progressbar/jquery.counterup.min.js', ['jquery'], SPEL_VERSION, true );
		wp_enqueue_script( 'spel-imageloaded', SPEL_VEND . '/imagesloaded/imagesloaded.pkgd.min.js', ['jquery'], SPEL_VERSION, true );
		wp_enqueue_script( 'spel-isotope', SPEL_VEND . '/isotope/isotope.min.js', ['jquery'], SPEL_VERSION, true );
		wp_enqueue_script( 'spel-fancy', SPEL_VEND . '/fancybox/js/jquery.fancybox.min.js', ['jquery'], SPEL_VERSION, true );
		wp_enqueue_script( 'spel-circle', SPEL_VEND . '/circle-progressbar/circle-progress.js', ['jquery'], SPEL_VERSION, true );
		wp_enqueue_script( 'spel-admin', SPEL_JS . '/admin.js', ['jquery'], SPEL_VERSION, true );
	}


}

new Assets();