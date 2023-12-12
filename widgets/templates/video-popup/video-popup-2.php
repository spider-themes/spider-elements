<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="play-button2 play-button-white">
    <a href="<?php echo esc_url( $settings['video_url'] ) ?>" data-fancybox>
		<?php \Elementor\Icons_Manager::render_icon( $settings['video_icon'] ); ?>
    </a>
</div>