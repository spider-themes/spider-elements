<?php
$enable_wave_regular    = $settings['enable_wave_regular'] == 'yes' ? 'wave' : '';
$enable_wave_hover      = $settings['enable_wave_hover'] == 'yes' ? 'hover_wave' : '';
?>

<div class="<?php echo ($enable_wave_regular . ' ' . $enable_wave_hover ) ?>">
    <a href="<?php echo esc_url($settings['video_url']); ?>" class="fancybox video-icon tran3s ezd-text-center"
        data-fancybox>
        <?php \Elementor\Icons_Manager::render_icon($settings['video_icon'], ['aria-hidden' => 'true']); ?>
    </a>
</div>