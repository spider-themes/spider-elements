<?php
$enable_wave = $settings['enable_wave'] === 'yes';

?>
<div <?php echo ($enable_wave ? 'class="wave"' : ''); ?>>
    <a href="<?php echo esc_url($settings['video_url']); ?>" class="fancybox video-icon tran3s text-center" data-fancybox>
        <?php \Elementor\Icons_Manager::render_icon($settings['video_icon'], ['aria-hidden' => 'true']); ?>
    </a>
</div>








