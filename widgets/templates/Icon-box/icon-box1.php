<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
} ?>

<div class="spel_icon_box">
    <a <?php spel_button_link($settings['box_link']); ?> class="box_bg_shape">
        <?php if ( ! empty( $settings['i_box_icon'] ) ) { ?>
            <div class="box_icon">
                <span class="box_main_icon">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['i_box_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                </span>
            </div>
        <?php } ?>

        <div class="icon_box_content">
            <?php if ( ! empty( $settings['title'] ) ) { ?>
                <<?php echo esc_html( $box_title_tag ); ?> class="box_title">
                <?php echo esc_html( $settings['title'] ); ?>
                </<?php echo esc_html( $box_title_tag ); ?>>
            <?php } ?>

            <?php if ( ! empty( $settings['description'] ) ) { ?>
                <p class="icon_box_description">
                    <?php echo esc_html( $settings['description'] ); ?>
                </p>
            <?php } ?>

            <?php if ( ! empty( $settings['btn_text'] ) ) { ?>
                <div class="icon_box_button">
                    <span class="box_button"><?php echo esc_html( $settings['btn_text'] ); ?></span>
                    <?php if ( ! empty( $settings['btn_icon'] ) ) { ?>
                        <?php \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php } ?>
                </div>
            <?php } ?>
        </div>
    </a>
</div>