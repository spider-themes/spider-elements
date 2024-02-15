<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<section class="testimonial-area-4">
    <div class="testimonial position-relative wow fadeInUp" data-wow-delay="0.2s">
        <div class="swiper testimonial-slide-4">
            <div class="swiper-wrapper">
                <?php
                if (!empty($testimonials4)) {
                    foreach ( $testimonials4 as $item ) {
                        ?>
                        <div class="swiper-slide">
                            <div class="ezd-grid ezd-grid-cols-12 align-items-center">
                                <div class="ezd-md-col-5">
                                    <div class="testimonial-slider-img">
                                        <?php spel_dynamic_image($item[ 'author_image' ]) ?>
                                    </div>
                                </div>
                                <div class="ezd-md-col-7">
                                    <div class="testimonial-content">
                                        <?php
                                        \Elementor\Icons_Manager::render_icon($settings[ 'quote_icon' ]); ?>
                                        <div class="section-title section-tag">
                                            <?php echo !empty($item[ 'review_content' ]) ? '<p class="se_review_content">' . esc_html($item[ 'review_content' ]) . '</p>' : ''; ?>
                                        </div>
                                        <hr>
                                        <div class="testimonial-author-info">
                                            <div class="author">
                                                <?php
                                                echo !empty($item[ 'name' ]) ? '<h5 class="testimonial-title se_name">' . esc_html($item[ 'name' ]) . '</h5>' : '';
                                                echo !empty($item[ 'designation' ]) ? '<span class="testimonial-subtitle se_designation">' . esc_html($item[ 'designation' ]) . '</span>' : '';
                                                ?>
                                            </div>
                                            <div class="company-logo">
                                                <?php spel_dynamic_image($item['c_logo']); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
</section>