<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="feedback-section-two">
    <div class="feedback-slider-two testimonial-slider-<?php echo esc_attr( $testimonial_id ); ?>">
		<?php if ( ! empty( $testimonials6 ) ):
		foreach ( $testimonials6

		as $item ) :
		$rating_data    = $this->get_rating( $item['author_rating'] );
		$textual_rating = $rating_data[0] . '/' . $rating_data[1];
		?>
        <div class="item elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
            <div class="feedback-block-one feedback-block-two">
                <?php
						if ( 'star_fontawesome' === $settings[ 'star_style' ] ) {
							if ( 'outline' === $settings[ 'unmarked_star_style' ] ) {
								$icon = '&#xE933;';
							}
						} elseif ( 'star_unicode' === $settings[ 'star_style' ] ) {
							$icon = '&#9733;';

                    <?php if ( $testimonial_ratting_icon == 'yes' ) : ?>
				<?php echo $stars_element ?>
				<?php endif; ?>
            </div>
			<?php
			if ( ! empty( $item['review_content'] ) ) { ?>
            <h3><?php echo esc_html( $item['review_content'] ) ?>
            </h3>
			<?php
			}
			if ( ! empty( $item['author_name'] ) ) { ?>
            <div class="block-footer ezd-d-flex ezd-align-items-center ezd-justify-content-between pt-35 lg-pt-20">
                <div class="ezd-d-flex ezd-align-items-center">
					<?php echo wp_get_attachment_image( $item['author_image']['id'], ' author-img ezd-rounded-circle' ) ?>
                    <div class="ezd-ms-3">
                        <div class="name fw-500"><?php echo esc_html( $item['author_name'] ); ?></div>
                        <span class="opacity-50"><?php echo esc_html( $item['author_position'] ); ?></span>
                    </div>
					<?php
					if ( ! empty( $item['review_content'] ) ) { ?>
                        <h3><?php echo esc_html( $item['review_content'] ) ?>
                        </h3>
						<?php
					}
					if ( ! empty( $item['author_name'] ) ) { ?>
                        <div
                                class="block-footer ezd-d-flex ezd-align-items-center ezd-justify-content-between pt-35 lg-pt-20">
                            <div class="ezd-d-flex ezd-align-items-center">
								<?php echo wp_get_attachment_image( $item['author_image']['id'], 'full', '',
									[ 'class' => 'author-img ezd-rounded-circle' ] ) ?>
                                <div class="ezd-ms-3">
                                    <div class="name fw-500"><?php echo esc_html( $item['author_name'] ); ?></div>
                                    <span class="opacity-50"><?php echo esc_html( $item['author_position'] ); ?></span>
                                </div>
                            </div>
							<?php echo wp_get_attachment_image( $item['company_image']['id'], 'full', '',
								[ 'class' => 'quote-icon' ] ) ?>
                        </div>
						<?php
					}
					?>
                </div>
            </div>
            <?php
			endforeach;
		endif;
		?>
        </div>
    </div>