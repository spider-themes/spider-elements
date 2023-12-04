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
                    <div class="swiper-slide">
                        <div class="testimonial testimonial-item">
							<?php
							echo ! empty( $item['company_name'] ) ? '<span class="category se_category">' . esc_html( $item['company_name'] ) . '</span>' : '';

							echo ! empty( $item['review_content'] ) ? '<h3 class="testimonial-title se_review_content">' . esc_html( $item['review_content'] ) . '</h3>' : '';

							echo ! empty( $item['title'] ) ? '<span class="testimonial-subtitle se_title">' . esc_html( $item['title'] ) . '</span>' : '';
							?>
                            <div class="author-name">
								<?php echo wp_get_attachment_image( $item['author_image']['id'], 'full', '', [ 'class' => 'author-img', ] ) ?>
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
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</section>

