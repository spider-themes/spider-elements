<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$integrations = [
	[
		'slug'     => 'bbp-core',
		'basename' => 'bbp-core/bbp-core.php',
		'logo'     => SPEL_IMG . '/dashboard/bbp-core-logo.svg',
		'title'    => esc_html__( 'Forumax', 'spider-elements' ),
		'desc'     => esc_html__( 'A complete, self-contained platform for building support forums, or discussion communities.', 'spider-elements' ),
		'category' => 'community',
	],
	[
		'slug'     => 'eazydocs',
		'basename' => 'eazydocs/eazydocs.php',
		'logo'     => SPEL_IMG . '/dashboard/eazydocs-logo.png',
		'title'    => esc_html__( 'EazyDocs', 'spider-elements' ),
		'desc'     => esc_html__( 'A powerful & beautiful documentation, knowledge base builder plugin.', 'spider-elements' ),
		'category' => 'documentation',
	],
	[
		'slug'     => 'changeloger',
		'basename' => 'changeloger/changeloger.php',
		'logo'     => SPEL_IMG . '/dashboard/changeloger-logo-black.svg',
		'title'    => esc_html__( 'Changeloger', 'spider-elements' ),
		'desc'     => esc_html__( 'Auto-convert plain text changelogs into engaging visuals for WordPress.', 'spider-elements' ),
		'category' => 'utility',
	],
	[
		'slug'     => 'advanced-accordion-block',
		'basename' => 'advanced-accordion-block/advanced-accordion-block.php',
		'logo'     => SPEL_IMG . '/dashboard/AAGB-logo.svg',
		'title'    => esc_html__( 'Advanced Accordion Block', 'spider-elements' ),
		'desc'     => esc_html__( '#1 WordPress plugin for creating professional FAQ sections, expandable content accordions.', 'spider-elements' ),
		'category' => 'gutenberg',
	],
	[
		'slug'     => 'antimanual',
		'basename' => 'antimanual/antimanual.php',
		'logo'     => SPEL_IMG . '/dashboard/antimanual-logo.png',
		'title'    => esc_html__( 'Antimanual', 'spider-elements' ),
		'desc'     => esc_html__( 'The ultimate AI powerhouse for your website. Do automatically with AI instead of manually.', 'spider-elements' ),
		'category' => 'ai',
	],
	[
		'slug'     => 'jobus',
		'basename' => 'jobus/jobus.php',
		'logo'     => SPEL_IMG . '/dashboard/jobus-logo.png',
		'title'    => esc_html__( 'Jobus', 'spider-elements' ),
		'desc'     => esc_html__( 'A modern and powerful plugin designed to transform your website into a fully functional Job portal.', 'spider-elements' ),
		'category' => 'community',
	],
];
?>

<div id="integration" class="tab-box">
    <div class="dashboard_banner integration_banner">
        <div class="banner_content">
            <span class="version_badge">
                <i class="icon-star"></i>
                <?php esc_html_e( 'Recommended Plugins', 'spider-elements' ); ?>
            </span>
            <h2><?php esc_html_e( 'Elevate Your WordPress Website to the Next Level!', 'spider-elements' ); ?></h2>
            <p><?php esc_html_e( 'Explore our versatile range of plugins tailored to meet every need for WordPress, Gutenberg, Elementor, and WooCommerce. Discover solutions that empower your site with enhanced functionality and seamless performance.', 'spider-elements' ); ?></p>
        </div>
    </div>

    <div class="ezd-grid ezd-grid-cols-12" style="margin-top: 24px;">
		<?php
		if ( isset( $integrations ) && is_array( $integrations ) ) {
			foreach ( $integrations as $plugin ) {
				$plugin_status = SPEL\includes\Admin\Plugin_Installer::instance();
				$plugin_data   = $plugin_status->get_status( $plugin['basename'] );

				$plugin_status           = $plugin_data['status'] ?? '';
				$plugin_activation_url   = $plugin_data['activation_url'] ?? '';
				$plugin_installation_url = $plugin_data['installation_url'] ?? '';
				$plugin_status_label     = isset( $plugin_data['status'] ) ? ( $plugin_data['status'] == 'activated' ? 'activated' : '' ) : '';
				$plugin_status_title     = $plugin_data['title'] ?? esc_html__( 'Activate', 'spider-elements' );

				// Determine button icon based on status
				$button_icon = 'icon-download';
				if ( 'activated' === $plugin_status ) {
					$button_icon = 'icon-check';
				} elseif ( 'inactive' === $plugin_status ) {
					$button_icon = 'icon-power';
				}
				?>
                <div class="ezd-lg-col-4">
                    <div class="element_box integration_item ezd-text-center">
                        <img src="<?php echo esc_url( $plugin['logo'] ); ?>" alt="<?php echo esc_attr( $plugin['title'] ); ?>">
                        <h3><?php echo esc_html( $plugin['title'] ); ?></h3>
                        <p><?php echo esc_html( $plugin['desc'] ); ?></p>

						<?php 
                        if ( $plugin['slug'] === 'bbp-core' ) {
							$wp_org_link = 'https://wordpress.org/plugins/forumax/';
						} elseif($plugin['slug'] === 'advanced-accordion-block') {
							$wp_org_link = 'https://wordpress.org/plugins/advanced-accordion-block/';
						} else {
							$wp_org_link = 'https://wordpress.org/plugins/' . $plugin['slug'] . '/';
						}

                        printf(
                            '<div class="action_buttons">
                                <a data-plugin_status="%1$s" data-activation_url="%2$s" href="%3$s" class="dashboard_btn %4$s"><i class="%5$s"></i>%6$s</a>
                                <a href="%7$s" class="dashboard_btn learn_more_btn" target="_blank"><i class="fab fa-wordpress-simple"></i> %8$s</a>
                            </div>',
                            esc_attr( $plugin_status ),
                            esc_url( $plugin_activation_url ),
                            esc_url( 'not_installed' === $plugin_status ? $plugin_installation_url : $plugin_activation_url ),
                            esc_attr( $plugin_status_label ),
                            esc_attr( $button_icon ),
                            esc_html( $plugin_status_title ),
                            esc_url( $wp_org_link ),
                            esc_html__( 'Learn More', 'spider-elements' )
                        );
                        ?>
                    </div>
                </div>
				<?php
			}
		}
		?>
    </div>
</div>