<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$enable_wave_regular = $settings['enable_wave_regular'] == 'yes' ? 'wave' : '';
$enable_wave_hover   = $settings['enable_wave_hover'] == 'yes' ? 'hover_wave' : '';
?>

<div class="<?php echo esc_attr( $enable_wave_regular . ' ' . $enable_wave_hover ) ?>">
    <a href="<?php echo esc_url( $settings['video_url'] ); ?>" class="fancybox video-icon tran3s ezd-text-center" data-fancybox>
		<?php \Elementor\Icons_Manager::render_icon( $settings['video_icon'] ); ?>
    </a>
</div>