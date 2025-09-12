<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( $settings['display_type'] == 'alert' ) : ?>
    <div class="spel_alert_box alert media ezd-d-flex message_alert alert-<?php echo esc_attr( $settings['alert_type'] ) ?> fade show"
         role="alert" data-id="<?php echo esc_attr( $this->get_id() ) ?>">
		<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
        <div class="media-body">
			<?php if ( ! empty( $settings['alert_title'] ) ) : ?>
                <h5 class="title"> <?php echo esc_html( $settings['alert_title'] ) ?></h5>
			<?php endif; ?>

            <?php echo ! empty( $settings['alert_description'] ) ? wp_kses_post( $this->parse_text_editor( $settings['alert_description'] ) ) : ''; ?>

			<?php if ( 'show' === $settings['show_dismiss'] ) : ?>
                <button type="button" class="close" data-dismiss="alert"
                        data-id="<?php echo esc_attr( $this->get_id() ) ?>">
                    <i class="icon_close"></i>
                </button>
			<?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<?php if ( $settings['display_type'] == 'note' ) : ?>
    <blockquote class="spel_alert_box media ezd-d-flex notice-box notice-<?php echo esc_attr( $settings['alert_type'] ) ?>">
		<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
        <div class="media-body">
			<?php if ( ! empty( $settings['alert_title'] ) ) : ?>
                <h5 class="title"><?php echo esc_html( $settings['alert_title'] ) ?></h5>
			<?php endif; ?>
			<?php echo wp_kses_post( $this->parse_text_editor( $settings['alert_description'] ) ); ?>
        </div>
    </blockquote>
<?php endif; ?>

<?php if ( $settings['display_type'] == 'dual-box' ) : ?>
    <div class="spel_alert_box dual-box-wrapper notice-<?php echo esc_attr( $settings['alert_type'] . ' ' . $settings['dual-layer-alignment'] ) ?>">
        <div class="dual-box-content <?php echo esc_attr( $settings['dual-layer-alignment'] ) ?>">
            <div class="ezd-d-flex notice">
				<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <div class="media-body">
					<?php if ( ! empty( $settings['alert_title'] ) ) : ?>
                        <h5 class="title __title"><?php echo esc_html( $settings['alert_title'] ) ?></h5>
					<?php endif; ?>
                    <div class="__content">
						<?php echo wp_kses_post( $this->parse_text_editor( $settings['alert_description'] ) ) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ( $settings['display_type'] == 'block-notice' ) : ?>
    <div class="spel_alert_box block-notice-wrapper se_box_padding block-notice-content-wrapper block-notice-<?php echo esc_attr( $settings['alert_type'] ) ?>">
        <div class="block-notice-icon">
			<?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </div>
        <div class="block-notice-body">
			<?php if ( ! empty( $settings['alert_title'] ) ) : ?>
                <h5 class="title"><?php echo esc_html( $settings['alert_title'] ) ?></h5>
			<?php endif; ?>
			<?php echo wp_kses_post( $this->parse_text_editor( $settings['alert_description'] ) ) ?>
        </div>
    </div>
<?php endif; ?>

<?php if ( $settings['display_type'] == 'note-with-icon' ) : ?>
    <div class="spel_alert_box note-with-icon nic-alert nic-alert-<?php echo esc_attr( $settings['alert_type'] ) ?>">
        <div class="nic-content-wrap">
			<?php if ( ! empty( $settings['icon']['value'] ) ) : ?>
                <div class="info-tab note-icon" title="Important Notes">
                    <div class="icon-wrapper">
						<?php \Elementor\Icons_Manager::render_icon( $settings['icon'],
							[ 'aria-hidden' => 'true' ] ); ?>
                    </div>
                </div>
			<?php endif; ?>
            <div class="note-box se_box_padding">
				<?php if ( ! empty( $settings['alert_title'] ) ) : ?>
                    <h5 class="title"> <?php echo esc_html( $settings['alert_title'] ) ?></h5>
				<?php endif; ?>
				<?php echo wp_kses_post( $this->parse_text_editor( $settings['alert_description'] ) ) ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php if ( $settings['display_type'] == 'explanation' ) : ?>
    <div class="spel_alert_box explanation expn-left">
		<?php echo wp_kses_post( $this->parse_text_editor( $settings['alert_description'] ) ) ?>
    </div>
	<?php if ( ! empty( $settings['alert_title'] ) ) : ?>
        <style>
            .explanation::after {
                font-family: "Roboto", sans-serif;
                content: "<?php echo esc_attr($settings['alert_title']) ?>";
                text-transform: uppercase;
                font-weight: 700;
                top: -19px;
                left: 1rem;
                padding: 0 0.5rem;
                font-size: 0.6rem;
                position: absolute;
                z-index: 1;
                color: #000;
                background: #fff;
            }
        </style>
	<?php endif; ?>
<?php endif; ?>