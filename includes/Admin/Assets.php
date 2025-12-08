<?php
namespace SPEL\includes\Admin;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class Assets
 * @package Spider Elements
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

        // List of all Spider Elements admin pages
        $spider_elements_pages = [
            'spider_elements_settings',
            'spider_elements_elements',
            'spider_elements_features',
            'spider_elements_integration',
        ];

        if ( isset( $_GET['page'] ) && in_array( $_GET['page'], $spider_elements_pages, true ) ) {

            // Register Admin Panel Style's
            wp_enqueue_style( 'spel-icomoon', SPEL_VEND . '/icomoon/style.css', [], SPEL_VERSION );
            wp_enqueue_style( 'spel-fancybox', SPEL_VEND . '/fancybox/fancybox.min.css', [], SPEL_VERSION );
            
            if ( is_rtl() ) {
                wp_enqueue_style( 'spel-admin-rtl', SPEL_CSS . '/admin-rtl.css', [], SPEL_VERSION);
            }


            wp_enqueue_style( 'spel-admin', SPEL_CSS . '/admin.css', [], SPEL_VERSION);


            // Register Admin Panel Script's
            wp_enqueue_script( 'spel-isotope', SPEL_VEND . '/isotope/isotope.min.js', ['jquery'], '2.2.2', ['strategy' => 'defer'] );
            wp_enqueue_script( 'spel-imageloaded', SPEL_VEND . '/imageloaded/imageloaded.min.js', ['jquery'], '4.1.0', ['strategy' => 'defer'] );
            wp_enqueue_script( 'spel-fancybox', SPEL_VEND . '/fancybox/fancybox.min.js', ['jquery'], '3.5.7', ['strategy' => 'defer'] );
            wp_enqueue_script( 'spel-admin', SPEL_JS . '/admin.js', ['jquery'], SPEL_VERSION, ['strategy' => 'defer'] );
        }

	}

}