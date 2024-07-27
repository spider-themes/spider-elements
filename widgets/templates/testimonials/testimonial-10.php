<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<div class="feedback-section-four">
    <div class="d-flex">
        <div class="ezd-xl-col-5 ezd-lg-col-6 ezd-ms-auto ezd-order-lg-last">

        </div>
        <div class="col-xxl-7 col-lg-6 order-lg-first">
            <div class="bg-wrapper position-relative me-xxl-4 md-mt-40 md-mb-40">
                <div class="icon ezd-d-flex ezd-align-items-center ezd-justify-content-center ezd-rounded-circle">
                    <?php spel_dynamic_image($settings[ 'quote_img' ], 'full', [ 'class' => 'lazy-img' ]) ?>
                </div>
                <div class="feedback-slider-three-a" data-rtl="<?php echo esc_attr(spel_rtl()) ?>">
                    <?php
                    if (!empty($testimonials10)) {
                        foreach ( $testimonials10 as $item ) {
                            ?>
                            <div class="item">
                                <?php
                                if (!empty($item[ 'review_content' ])) { ?>
                                    <p><?php echo esc_html($item[ 'review_content' ]) ?></p>
                                    <?php
                                }
                                if (!empty($item[ 'author_name' ])) { ?>
                                    <div class="name text-md">
                                        <?php echo esc_html($item[ 'author_name' ]); ?>
                                        <span class="opacity-50"><?php echo esc_html($item[ 'author_position' ]); ?></span>
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
                <ul class="slider-arrows d-flex justify-content-between justify-content-lg-center style-none">
                    <li class="prev_d slick-arrow">
	                    <?php \Elementor\Icons_Manager::render_icon( $settings['prev_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </li>
                    <li class="next_d slick-arrow">
	                    <?php \Elementor\Icons_Manager::render_icon( $settings['next_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </li>
                </ul>
            </div>
            <!-- /.bg-wrapper -->
        </div>
    </div>
    <div class="slider-wrapper">
        <div class="feedback-slider-three-b" data-rtl="<?php echo esc_attr(spel_rtl()) ?>">
            <?php
            if (!empty($testimonials10)) {
                foreach ( $testimonials10 as $item ) {
                    if (!empty($item[ 'author_image' ][ 'id' ])) {
                        ?>
                        <div class="item">
                            <?php spel_dynamic_image($item[ 'author_image' ], 'full', [ 'class' => 'lazy-img' ]) ?>
                        </div>
                        <?php
                    }
                }
            }
            ?>
        </div>
    </div>
</div>