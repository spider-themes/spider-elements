<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<section class="testimonial-area testimonial-area-8">
    <div class="testimonial-slider-active swiper">
        <div class="swiper-wrapper">
			<?php
			if ( ! empty( $testimonials5 ) ) :
				foreach ( $testimonials5 as $item ) : ?>
                    <div class="swiper-slide slider-items">
                        <div class="testimonial testimonial-item">
							<?php
							echo ! empty( $item['company_name'] ) ? '<span class="category se_category">' . esc_html( $item['company_name'] ) . '</span>' : '';

							echo ! empty( $item['review_content'] ) ? '<h3 class="testimonial-title spel_review_content">' . esc_html( $item['review_content'] ) . '</h3>' : '';

							echo ! empty( $item['title'] ) ? '<span class="testimonial-subtitle se_title">' . esc_html( $item['title'] ) . '</span>' : '';
							?>
                            <div class="author-name">
								<?php spel_dynamic_image( $item['author_image'], 'full', [ 'class' => 'author-img', ] ) ?>
								<?php echo ! empty( $item['name'] ) ? '<span class="author-title se_name">' . esc_html( $item['name'] ) . '</span>' : ''; ?>
                            </div>
                        </div>
                    </div>
				<?php
				endforeach;
			endif;
			?>
        </div>
    </div>
    <div class="navigation">
        <div class="swiper-button-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-f95f3e58688f37f3"></div>
        <div class="swiper-button-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-f95f3e58688f37f3"></div>
    </div>
</section>

