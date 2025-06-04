<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="feedback-section-seven">
    <div class="feedback-slider-one testimonial-slider-<?php echo esc_attr( $testimonial_id ); ?>" data-rtl="<?php echo esc_attr(spel_rtl()) ?>">
		<?php if ( ! empty( $testimonials6 ) ) {
			foreach ( $testimonials6 as $item ) {
				$rating_data    = $this->get_rating( $item[ 'author_rating' ] );
				$textual_rating = $rating_data[ 0 ] . '/' . $rating_data[ 1 ];
				?>
                <div class="item elementor-repeater-item-<?php echo esc_attr( $item[ '_id' ] ); ?>">
                    <div class="feedback-block-one feedback-block-three">
                        <img class="quote-icon" src="<?php echo SPEL_IMG ?>/quote-icon.svg" alt="<?php esc_attr_e( 'quote icon', 'spider-elements') ?>">
						<?php
						if ( $settings['star_style'] === 'star_fontawesome' ) {
							if ( $settings['unmarked_star_style'] === 'outline' ) {
								$icon = 'fa fa-star-o'; // Font Awesome outline star (class only)
							} else {
								$icon = 'fa fa-star'; // Font Awesome solid star (class only)
							}
						} elseif ( $settings['star_style'] === 'star_unicode' ) {
							if ( $settings['unmarked_star_style'] === 'outline' ) {
								$icon = '&#9734;'; // Unicode outline star
							} else {
								$icon = '&#9733;'; // Unicode solid star
							}
						}

						$this->add_render_attribute( 'icon_wrapper', [
							'class'     => 'jobus-review-rating',
							'title'     => $textual_rating,
							'itemscope' => '',
							'itemprop'  => 'reviewRating',
						] );

						$schema_rating = '<span itemprop="ratingValue" class="elementor-screen-only">' . $textual_rating . '</span>';
						$stars_element = '<div ' . $this->get_render_attribute_string( 'icon_wrapper' ) . '>' . $this->render_stars( $icon, $item[ 'author_rating' ] ) . ' ' . $schema_rating . '</div>';
						?>
                        <div class="review">
							<?php if ( ! \Elementor\Utils::is_empty( $item[ 'author_rating_title' ] ) ) : ?>
                                <div class="text-md fw-500"><?php echo esc_html( $item[ 'author_rating_title' ] ); ?></div>
							<?php endif; ?>

							<?php if ( $testimonial_ratting_icon == 'yes' ) : ?>
								<?php echo wp_kses_post($stars_element) ?>
							<?php endif; ?>
                        </div>
						<?php
						if ( ! empty( $item[ 'review_content' ] ) ) { ?>
                            <h3><?php echo esc_html( $item[ 'review_content' ] ) ?></h3>
							<?php
						}
						if ( ! empty( $item[ 'author_name' ] ) ) { ?>
                            <div class="block-footer ezd-d-flex ezd-align-items-center ezd-justify-content-between pt-35 lg-pt-10">
                                <div class="ezd-d-flex ezd-align-items-center">
                                    <div class="name">
										<?php echo esc_html( $item[ 'author_name' ] ); ?>
                                        <span><?php echo esc_html( $item[ 'author_position' ] ); ?></span>
                                    </div>
                                </div>
								<?php spel_dynamic_image( $item[ 'author_image' ], 'full', [ 'class' => 'author-img ezd-rounded-circle' ] ) ?>
                            </div>
							<?php
						}
						?>
                    </div>
                </div>
				<?php
			}
		}
		?>
    </div>
    <ul class="slider-arrows slick-arrow-one ezd-d-flex justify-content-center">
        <li class="prev_f">
		    <?php \Elementor\Icons_Manager::render_icon( $settings['prev_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </li>
        <li class="next_f">
		    <?php \Elementor\Icons_Manager::render_icon( $settings['next_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </li>
    </ul>
</div>
