<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<section class="testimonial_area_nine">
    <div class="testimonial_slider_box position-relative">
        <div class="testimonial-slider-inner swiper mt-minus">
            <div class="swiper-wrapper">
				<?php
				if ( ! empty( $testimonials3 ) ) {
					foreach ( $testimonials3 as $item ) {
						?>
                        <div class="swiper-slide">
                            <div class="testimonial testimonial-item">
                                <div class="author-image">
									<?php echo wp_get_attachment_image( absint($item[ 'author_image' ][ 'id' ]), 'full', '', [ 'class' => 'author-img' ] ) ?>
                                </div>
                                <div class="testimonial-content">
                                    <div class="quote-img-top">
                                        <img src="<?php echo esc_url(SPEL_IMG) . '/quote_img1.png' ?>"
                                             alt="<?php esc_attr_e( 'Quote Image One', 'spider-elements' ) ?>">
                                    </div>
									<?php
									echo ! empty( $item[ 'review_content' ] ) ? '<p class="se_review_content">' . esc_html( $item[ 'review_content' ] ) . '</p>' : '';
									?>
                                    <div class="author-info">
										<?php
										echo ! empty( $item[ 'name' ] ) ? '<h4 class="author-name se_name">' . esc_html( $item[ 'name' ] ) . '</h4>' : '';

										echo ! empty( $item[ 'designation' ] ) ? '<span class="author-position se_designation">' . esc_html( $item[ 'designation' ] ) . '</span>' : '';
										?>
                                    </div>
                                </div>
                                <div class="quote-img-bottom">
                                    <img src="<?php echo esc_url(SPEL_IMG) . '/quote_img2.png' ?>"
                                         alt="<?php esc_attr_e( 'Quote Image Two', 'spider-elements' ) ?>">
                                </div>
                            </div>
                        </div>
						<?php
					}
				}
				?>
            </div>
        </div>
        <div class="navigation">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section>