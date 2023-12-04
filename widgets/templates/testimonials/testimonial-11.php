<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="testimonial-area">
    <div class="ezd-container">
        <div class="ezd-position-relative">
            <div class="testimonial-slider">
				<?php
				if ( ! empty( $testimonials11 ) ) {
					foreach ( $testimonials11 as $item ) {
                        ?>
                        <div class="single-slide">
                            <div class="ezd-grid ezd-grid-cols-12 testimonial-widget">
                                <div class="ezd-lg-col-6">
                                    <span><?php esc_html_e('REVIEWS', 'spider-elements'); ?></span>
									<?php
									echo ! empty( $item[ 'review_content' ] ) ? '<p class="review-text se_review_content">' . esc_html( $item[ 'review_content' ] ) . '</p>' : '';
									?>
                                    <div class="author-info">
										<?php
										echo ! empty( $item[ 'author_name' ] ) ? '<h5 class="se_name">' . esc_html( $item[ 'author_name' ] ) . '</h5>' : '';
										echo ! empty( $item[ 'author_position' ] ) ? '<p class="se_designation">' . esc_html( $item[ 'author_position' ] ) . '</p>' : '';
										?>
                                    </div>
                                </div>
                                <div class="ezd-lg-col-6">
									<?php echo wp_get_attachment_image( $item[ 'author_image' ][ 'id' ], 'full', '', [ 'class' => 'author-img' ] ) ?>
                                </div>
                            </div>
                        </div>
					    <?php
					}
                }
				?>
            </div>
            <div class="custom_slider_nav ">
                <div class="slide_info">
                    <div class="current_slide me-2"></div>/<div class="total_slide ms-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>