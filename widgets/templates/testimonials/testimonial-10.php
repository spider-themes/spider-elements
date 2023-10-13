<div class="feedback-section-four">
    <div class="row">
        <div class="col-xl-5 col-lg-6 ms-auto order-lg-last">

        </div>
        <div class="col-xxl-7 col-lg-6 order-lg-first">
            <div class="bg-wrapper position-relative me-xxl-4 md-mt-40 md-mb-40">
                <div class="icon d-flex align-items-center justify-content-center rounded-circle">
                    <img src="<?php echo esc_url( $settings[ 'quote_img' ][ 'url' ] ); ?>" alt="" class="lazy-img">
                </div>
                <div class="feedback-slider-three-a">
					<?php if ( ! empty( $testimonials10 ) ):
						foreach ( $testimonials10 as $item ) : ?>
                            <div class="item">
								<?php if ( ! empty( $item[ 'review_content' ] ) ) { ?>
                                    <p><?php echo esc_html( $item[ 'review_content' ] ) ?>
                                    </p>
								<?php }
								if ( ! empty( $item[ 'author_name' ] ) ) { ?>
                                    <div class="name text-md text-white">
										<?php echo esc_html( $item[ 'author_name' ] ); ?><span
                                                class="opacity-50"><?php echo esc_html( $item[ 'author_position' ] ); ?></span>
                                    </div>
								<?php } ?>
                            </div>
						<?php endforeach; endif; ?>
                </div>
                <ul
                        class="list-unstyled slider-arrows d-flex justify-content-between justify-content-lg-center style-none">
                    <li class="prev_d slick-arrow"><i class="arrow_left"></i></li>
                    <li class="next_d slick-arrow"><i class="arrow_right"></i></li>
                </ul>
            </div>
            <!-- /.bg-wrapper -->
        </div>
    </div>
    <div class="slider-wrapper">
        <div class="feedback-slider-three-b">
			<?php if ( ! empty( $testimonials10 ) ):
				foreach ( $testimonials10 as $item ):?>
                    <div class="item">
                        <img src="<?php echo esc_url( $item[ 'author_image' ][ 'url' ] ); ?>" alt="" class="lazy-img">
                    </div>
				<?php endforeach; endif; ?>
        </div>
    </div>
</div>