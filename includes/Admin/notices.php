<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<div class="notice updated spider-elements-elementor-notice spider-elements-elementor-install-elementor">
	<div class="spider-elements-elementor-notice-inner">
		<div class="spider-elements-elementor-notice-content">
			<h3><?php esc_html_e( 'Thanks for installing Spider Elements!', 'spider-elements' ); ?></h3>
            <p><?php echo wp_kses_post($message) ?></p>
		</div>

		<div class="spider-elements-elementor-install-now">
			<a class="button button-primary spider-elements-elementor-install-button" href="<?php echo esc_url( $button_link ); ?>">
                <i class="dashicons dashicons-download"></i>
                <?php echo wp_kses_post($button_text) ?>
            </a>
		</div>
	</div>
</div>