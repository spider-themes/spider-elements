<section class="support_area c2a_sec">
    <div class="container">
        <?php if ( !empty($settings['bg_img']['url']) ) : ?>
            <img class="shap" data-parallax='{"x": 200}' src="<?php echo $settings['bg_img']['url'] ?>" alt="<?php echo esc_attr($settings['title']) ?>">
        <?php endif; ?>
        <div class="d-flex justify-content-between">
            <div class="left">
                <?php echo !empty($settings['title']) ? sprintf( '<%1$s class="title" data-animation="wow fadeInUp" data-wow-delay="0.2s"> %2$s </%1$s>', $title_tag, nl2br($settings['title']) ) : ''; ?>
                <?php echo wp_kses_post(wpautop($settings['content'])) ?>
                <?php if ( !empty($settings['btn_label']) ) : ?>
                    <a class="icon_btn2 wow fadeInUp c2abtn" data-wow-delay="0.6s" <?php echo se_el_btn($settings['btn_url']) ?>>
                        <?php
                        echo esc_html($settings['btn_label']);

			 \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] );


                        ?>


                    </a>
                <?php endif; ?>
            </div>
            <div class="right">
                <?php spider_el_image($settings['featured_image'], 'call to action background shape'); ?>
            </div>
        </div>
    </div>
</section>