<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$integrations = [
	[
		'slug'     => 'bbp-core',
		'basename' => 'bbp-core/bbp-core.php',
		'logo'     => SPEL_IMG . '/dashboard/bbp-core.png',
		'title'    => esc_html__( 'BBP Core', 'spider-elements' ),
		'desc'     => esc_html__( 'Expand bbPress powered forums with useful features like - private reply, solved topics ...', 'spider-elements' ),
	],
	[
		'slug'     => 'eazydocs',
		'basename' => 'eazydocs/eazydocs.php',
		'logo'     => SPEL_IMG . '/dashboard/eazydocs-logo.png',
		'title'    => esc_html__( 'EazyDocs', 'spider-elements' ),
		'desc'     => esc_html__( 'A powerful & beautiful documentation, knowledge base builder plugin.', 'spider-elements' ),
	],
	[
		'slug'     => 'changeloger',
		'basename' => 'changeloger/changeloger.php',
		'logo'     => SPEL_IMG . '/dashboard/changeloger.png',
		'title'    => esc_html__( 'Changeloger', 'spider-elements' ),
		'desc'     => esc_html__( 'Auto-convert plain text changelogs into engaging visuals for WordPress.', 'spider-elements' ),
	],
    [
        'slug'     => 'advanced-accordion-block',
        'basename' => 'advanced-accordion-block/advanced-accordion-block.php',
        'logo'     => SPEL_IMG . '/dashboard/accordion.png',
        'title'    => esc_html__( 'Advanced Accordion Block', 'spider-elements' ),
        'desc'     => esc_html__( 'A custom Gutenberg Block that allows to showcase the content in accordion mode. It also helps to build FAQ sections easily.',
            'spider-elements' ),
    ],
];
?>

<div id="integration" class="tab-box">
    <div class="dashboard_banner integration_banner">
        <h2><?php esc_html_e( 'Integration Our other plugins', 'spider-elements' ); ?></h2>
        <p><?php _e( 'We are excited to announce that we have added new Widgets, Template Kits, and other Elementor<br> features to enhance your website building experience. Stay tuned for the weekly updates!',
				'spider-elements' ); ?></p>
    </div>
    <div class="ezd-grid ezd-grid-cols-12">
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
				?>
                <div class="ezd-lg-col-4">
                    <div class="element_box integration_item ezd-text-center">
                        <img src="<?php echo esc_url( $plugin['logo'] ); ?>" alt="<?php echo esc_attr( $plugin['title'] ); ?>">
                        <h3><?php echo esc_html( $plugin['title'] ); ?></h3>
                        <p><?php echo esc_html( $plugin['desc'] ); ?></p>

						<?php
						echo sprintf(
							'<a data-plugin_status="%1$s" data-activation_url="%2$s" href="%3$s" class="dashboard_btn %4$s">%5$s</a>',
							esc_attr( $plugin_status ),
							esc_url( $plugin_activation_url ),
							esc_url( $plugin_status === 'not_installed' ? $plugin_installation_url : $plugin_activation_url ),
							esc_attr( $plugin_status_label ),
							esc_html( $plugin_status_title )
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