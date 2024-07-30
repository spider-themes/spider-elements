<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<section class="feedback-section-three ezd-position-relative">
    <div id="feedBack_carousel" class="carousel slide" data-bs-ride="carousel">

        <div class="feedback_slider">
            <div class="carousel-inner ezd-text-center">
				<?php
				if ( ! empty( $testimonials8 ) ) {
					foreach ( $testimonials8 as $index => $item ) {
						$active = $index == 1 ? ' active' : '';
						?>
                        <div class="carousel-item<?php echo esc_attr( $active ) ?>">
							<?php ?>
							<?php
							if ( ! empty( $item['review_content'] ) ) {
								echo spel_kses_post( wpautop( $item['review_content'] ) );
							}
							if ( ! empty( $item['author_name'] ) ) {
								?>
                                <div class="ezd-d-inline-block ezd-position-relative name fw-500 text-lg">
									<?php echo esc_html( $item['author_name'] ); ?>
                                    <span class="fw-normal opacity-50"><?php echo esc_html( $item['author_position'] ); ?></span>
                                </div>
								<?php
							}
							?>
                        </div>
						<?php
					}
				}
				?>
            </div>
        </div>


        <button class="carousel-control-prev carousel-btn" type="button" data-bs-target="#feedBack_carousel" data-bs-slide="prev">
			<?php \Elementor\Icons_Manager::render_icon( $settings['prev_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </button>
        <button class="carousel-control-next carousel-btn" type="button" data-bs-target="#feedBack_carousel" data-bs-slide="next">
			<?php \Elementor\Icons_Manager::render_icon( $settings['next_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
        </button>

        <div class="carousel-indicators">

			<?php
			if ( ! empty( $testimonials8 ) ) {
				foreach ( $testimonials8 as $index => $item ) {
					$active       = $index == 0 ? 'active' : '';
					$current_area = $index == 1 ? 'aria-current="true"' : '';
					?>
                    <button type="button" data-bs-target="#feedBack_carousel" data-bs-slide-to="<?php echo esc_attr( $index ) ?>"
                            class="<?php echo esc_attr( $active ) ?>" <?php echo $current_area ?> aria-label="Slide <?php echo esc_attr( $index ) ?>">
						<?php spel_dynamic_image( $item['author_image'], 'full', [ 'class' => 'lazy-img ezd-rounded-circle' ] ) ?>
                    </button>
					<?php
				}
			}
			?>
        </div>

    </div>
</section>