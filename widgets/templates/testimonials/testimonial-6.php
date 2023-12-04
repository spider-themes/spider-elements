<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="feedback_section_one">
    <div class="feedback-slider-one testimonial-slider-<?php echo esc_attr( $testimonial_id ); ?>">
		<?php
        if ( ! empty( $testimonials6 ) ) {
			foreach ( $testimonials6 as $item ) {
				$rating_data    = $this->get_rating( $item[ 'author_rating' ] );
				$textual_rating = $rating_data[ 0 ] . '/' . $rating_data[ 1 ];
				?>
                <div class="item elementor-repeater-item-<?php echo esc_attr( $item[ '_id' ] ); ?>">
                    <div class="feedback-block-one">
						<?php
						if ( ! empty( $item[ 'company_image' ][ 'id' ] ) ) { ?>
                            <div class="logo">
								<?php echo wp_get_attachment_image( $item[ 'company_image' ][ 'id' ], 'full' ) ?>
                            </div>
							<?php
						}
						if ( ! empty( $item[ 'review_content' ] ) ) { ?>
                            <h3><?php echo esc_html( $item[ 'review_content' ] ) ?></h3>
							<?php
						}
						if ( ! empty( $item[ 'author_name' ] ) ) { ?>
                            <div class="name"><span class="fw-500"><?php echo esc_html( $item[ 'author_name' ] ); ?></span>
								<?php echo esc_html( $item[ 'author_position' ] ); ?></div>
							<?php
						}

						if ( 'star_fontawesome' === $settings[ 'star_style' ] ) {
							if ( 'outline' === $settings[ 'unmarked_star_style' ] ) {
								$icon = '&#xE933;';
							}
						} elseif ( 'star_unicode' === $settings[ 'star_style' ] ) {
							$icon = '&#9733;';

							if ( 'outline' === $settings[ 'unmarked_star_style' ] ) {
								$icon = '&#9734;';
							}
						}

						$this->add_render_attribute( 'icon_wrapper', [
							'class'     => 'star-rating',
							'title'     => $textual_rating,
							'itemscope' => '',
							'itemprop'  => 'reviewRating',
						] );

						$schema_rating = '<span itemprop="ratingValue" class="elementor-screen-only">' . $textual_rating . '</span>';
						$stars_element = '<div ' . $this->get_render_attribute_string( 'icon_wrapper' ) . '>' . $this->render_stars( $icon, $item[ 'author_rating' ] ) . ' ' . $schema_rating . '</div>';
						?>
                        <div class="review pt-40 md-pt-20 mt-40 md-mt-30 ezd-d-flex ezd-justify-content-between ezd-align-items-center">
							<?php
                            if ( ! \Elementor\Utils::is_empty( $item[ 'author_rating_title' ] ) ) { ?>
                                <div class="text-md fw-500"><?php echo esc_html( $item[ 'author_rating_title' ] ); ?></div>
							    <?php
                            }
                            if ( $testimonial_ratting_icon == 'yes' ) {
                                echo wp_kses_post($stars_element);
                            }
                            ?>
                        </div>
                    </div>
                </div>
				<?php
			}
		}
		?>
    </div>
    <ul class="slider-arrows slick-arrow-one d-flex justify-content-center">
        <li class="prev_f"><i class="arrow_left"></i></li>
        <li class="next_f"><i class="arrow_right"></i></li>
    </ul>
</div>