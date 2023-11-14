<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="btn-circle" id="btn_wrapper">
    </a>
    <a href="<?php echo esc_url( $settings['video_url'] ) ?>" class="youtube_logo" data-fancybox>
		<?php \Elementor\Icons_Manager::render_icon( $settings['video_icon'], [ 'aria-hidden' => 'true' ] ); ?>
    </a>
    <div class="text">
        <p><?php esc_html_e( '.Know About MY Self. By A Quick Video', 'spider-elements' ); ?></p>
    </div>
</div>