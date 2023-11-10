<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="feedback-section-four">
    <div class="ezd-grid ezd-grid-cols-12">
        <div class="ezd-xl-col-5 ezd-lg-col-6 ezd-ms-auto ezd-order-lg-last">

        </div>
        <div class="ezd-xl-col-7 cezd-lg-col-6 ezd-order-lg-first">
            <div class="bg-wrapper position-relative me-xxl-4 md-mt-40 md-mb-40">
                <div class="icon ezd-d-flex ezd-align-items-center ezd-justify-content-center ezd-rounded-circle">
                    <?php echo wp_get_attachment_image( $settings[ 'quote_img' ][ 'id' ], 'full', '',
						[ 'class' => 'lazy-img' ] ) ?>
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
                    class="list-unstyled slider-arrows ezd-d-flex ezd-justify-content-between ezd-justify-content-lg-center style-none">
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
                <?php echo wp_get_attachment_image( $item[ 'author_image' ][ 'id' ], 'full', '',
							[ 'class' => 'lazy-img' ] ) ?>
            </div>
            <?php endforeach; endif; ?>
        </div>
    </div>
</div>