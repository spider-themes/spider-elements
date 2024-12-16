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

        // Register Admin Panel Scripts
        add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );

	}


	/**
	 * Register Admin Panel Scripts
	 *
	 * Register custom scripts required to run Spider Elements.
	 *
	 * @access public
	 */
	public function admin_scripts(): void
    {

		// Register Admin Panel Style's
        wp_enqueue_style( 'spel-icomoon', SPEL_VEND . '/icomoon/style.css', [], SPEL_VERSION );
		wp_enqueue_style( 'spel-fancybox', SPEL_VEND . '/fancybox/fancybox.min.css', [], SPEL_VERSION );
		wp_enqueue_style( 'spel-admin', SPEL_CSS . '/admin.css', [], SPEL_VERSION);


		// Register Admin Panel Script's
        wp_enqueue_script( 'spel-circle-progress', SPEL_VEND . '/circle-progress/circle-progress.min.js', ['jquery'], '1.2.2', ['strategy' => 'defer'] );
        wp_enqueue_script( 'spel-counterup', SPEL_VEND . '/counterup/counterup.min.js', ['jquery'], '1.0', ['strategy' => 'defer'] );
        wp_enqueue_script( 'spel-waypoint', SPEL_VEND . '/counterup/waypoints.min.js', ['jquery'], '4.0.1', ['strategy' => 'defer'] );
        wp_enqueue_script( 'spel-imageloaded', SPEL_VEND . '/imageloaded/imageloaded.min.js', ['jquery'], '4.1.0', ['strategy' => 'defer'] );
        wp_enqueue_script( 'spel-isotope', SPEL_VEND . '/isotope/isotope.min.js', ['jquery'], '2.2.2', ['strategy' => 'defer'] );
        wp_enqueue_script( 'spel-fancybox', SPEL_VEND . '/fancybox/fancybox.min.js', ['jquery'], '3.5.7', ['strategy' => 'defer'] );
		wp_enqueue_script( 'spel-admin', SPEL_JS . '/admin.js', ['jquery'], SPEL_VERSION, ['strategy' => 'defer'] );
	}

}