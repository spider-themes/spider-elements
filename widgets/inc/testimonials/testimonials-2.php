<?php
wp_enqueue_script('parallaxie');
$bg_image = !empty($settings['background']['url']) ? "data-background='{$settings['background']['url']};'" : '';
?>
<section class="doc_feedback_area parallaxie sec_pad" <?php echo $bg_image; ?>>
    <div class="overlay_bg"></div>
    <div class="container">
        <div class="doc_feedback_info">
            <div class="doc_feedback_slider">
                <?php
                foreach ( $settings['testimonials2'] as $testimonial ) :
                    ?>
                    <div class="item elementor-repeater-item-<?php echo $testimonial['_id']; ?>">
                        <?php if ( !empty($testimonial['author_image']['id']) ) : ?>
                            <div class="author_img">
                                <?php echo wp_get_attachment_image( $testimonial['author_image']['id'], 'full' ) ?>
                            </div>
                        <?php endif; ?>
                        <?php echo wpautop($testimonial['content']) ?>
                        <h5> <?php echo esc_html($testimonial['name']); ?> </h5>
                        <?php echo !empty($testimonial['designation']) ? '<h6>'.esc_html($testimonial['designation']).'</h6>' : ''; ?>
                    </div>
                <?php
                endforeach;
                ?>
            </div>
            <div class="slider_nav">
                <div class="prev">
                    <span class="arrow"></span>
                </div>
                <div class="next">
                    <span class="arrow"></span>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    ;(function ($) {
        "use strict";
        $(document).ready(function() {
            $('.doc_feedback_slider').slick({
                autoplay: true,
                <?php if ( is_rtl() ) : ?>
                rtl: true,
                <?php endif; ?>
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplaySpeed: 2000,
                speed: 1000,
                dots: false,
                arrows: true,
                prevArrow: '.prev',
                nextArrow: '.next',
            });
            $('.parallaxie').parallaxie({
                speed: 0.5,
            });
        })
    })(jQuery)
</script>