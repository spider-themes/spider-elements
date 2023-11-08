<section class="testimonial-area-4">
    <div class="container">
        <div class="testimonial position-relative wow fadeInUp" data-wow-delay="0.2s">
            <div class="swiper testimonial-slide-4">
                <div class="swiper-wrapper">
                <?php
                if ( !empty($testimonials4)) :
                    foreach ($testimonials4 as $item) : ?>
                    <div class="swiper-slide">
                        <div class="row align-items-center">
                            <div class="col-md-5">
                                <div class="testimonial-slider-img">
	                                <?php echo wp_get_attachment_image( $item[ 'author_image' ][ 'id' ], 'full' ) ?>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="testimonial-content">
                                    <?php
                                    \Elementor\Icons_Manager::render_icon( $settings['quote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    <div class="section-title section-tag">
                                        <span class="tag-style p pt-15">&lt;p&gt;</span>
                                        <?php 
                                        echo !empty($item['review_content']) ? '<p class="se_review_content">' . esc_html($item['review_content']) . '</p>' : '';
                                        ?>
                                        <span class="tag-style p">&lt;/p&gt;</span>
                                    </div>
                                    <hr>
                                    <div class="testimonial-author-info">
                                        <div class="author">
                                            <?php 
                                            echo !empty($item['name']) ? '<h5 class="testimonial-title se_name">' . esc_html($item['name']) . '</h5>' : ''; 
                                            echo !empty($item['designation']) ? '<span class="testimonial-subtitle se_designation">' . esc_html($item['designation']) . '</span>' : '';
                                            ?>
                                        </div>
                                        <div class="company-logo">
                                            <?php 
                                            if (!empty($item['c_logo']['id'])) :
                                                echo wp_get_attachment_image($item['c_logo']['id'], 'full', '');
                                            endif;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                endforeach;
            endif;
            ?>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</section>


