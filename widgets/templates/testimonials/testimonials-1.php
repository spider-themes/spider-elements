<section class="doc_testimonial_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="doc_testimonial_slider">
                    <?php
                    if ( $testimonials ) {
                        foreach ( $testimonials as $testimonial ) {
                            ?>
                            <div class="item elementor-repeater-item-<?php echo $testimonial['_id']; ?>">
                                <?php echo !empty($testimonial['content']) ? '<h3>'.se_get_the_kses_post($testimonial['content']).'</h3>' : ''; ?>
                                <div class="name">
                                    <?php
                                    echo !empty($testimonial['name']) ? '<h5>'.se_get_the_kses_post($testimonial['name']).'</h5>' : '';
                                    echo !empty($testimonial['designation']) ? '<span>'.se_get_the_kses_post($testimonial['designation']).'</span>' : '';
                                    ?>
                                </div>
                                <?php if ( !empty($testimonial['signature']['id']) ) : ?>
                                    <a href="#" class="sign">
                                        <?php echo wp_get_attachment_image( $testimonial['signature']['id'], 'full' ) ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="doc_img_slider">
                    <?php
                    if ( $testimonials )  {
                        foreach ( $testimonials as $testimonial ) {
                            ?>
                            <div class="item elementor-repeater-item-<?php echo $testimonial['_id']; ?>">
                                <?php
                                if ( !empty($testimonial['shape']['id']) ) :
                                    echo wp_get_attachment_image( $testimonial['shape']['id'], 'full', '', array( 'class' => 'dot' ) );
                                endif;

                                echo '<div class="round one"></div>';
                                echo '<div class="round two"></div>';

                                if ( !empty($testimonial['author_image']['id']) ) :
                                    echo wp_get_attachment_image( $testimonial['author_image']['id'], 'full' );
                                endif;
                                ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    ;(function($){
        "use strict";
        $(document).ready(function () {
            $(".doc_testimonial_slider").slick({
                autoplay: true,
                slidesToShow: 1,
                slidesToScroll: 1,
                <?php if ( is_rtl() ) : ?>
                rtl:true,
	            <?php endif; ?>
                autoplaySpeed: 2000,
                speed: 2000,
                dots: true,
                arrows: false,
                asNavFor: ".doc_img_slider",
            });
            $(".doc_img_slider").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
	            <?php if ( is_rtl() ) : ?>
                rtl:true,
	            <?php endif; ?>
                asNavFor: ".doc_testimonial_slider",
                arrows: false,
                fade: true,
                focusOnSelect: true,
            });
        });
    })(jQuery)
</script>