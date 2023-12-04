<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<div class="expert-section-one">
    <div class="expert-slider-one slider-<?php echo esc_attr($team_id); ?>">
        <?php
        if (!empty($team_slider_item) && is_array($team_slider_item)) {
            foreach ( $team_slider_item as $item ) { ?>
                <div class="item">
                    <div class="card-style-three ezd-text-center">
                        <?php
                        if ( ! empty( $item[ 'team_slider_image' ][ 'id' ] ) ) { ?>
                            <div class="img-meta mb-40 lg-mb-20">
                                <?php echo wp_get_attachment_image($item[ 'team_slider_image' ][ 'id' ], 'full', '', [ 'class' => 'm-auto' ]) ?>
                            </div>
                            <?php
                        }
                        if ( ! empty( $item[ 'team_name' ] ) ) {
                            ?>
                            <a <?php spe_the_button($item[ 'team_link' ]); ?> class="name text-md fw-500">
                                <?php echo esc_html($item[ 'team_name' ]); ?>
                            </a>
                            <?php
                        }
                        if ( ! empty( $item[ 'team_job_position' ] ) ) {
                            ?>
                            <div class="post"><?php echo esc_html($item[ 'team_job_position' ]); ?></div>
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
    <ul class="slider-arrows slick-arrow-one ezd-d-flex ezd-justify-content-center style-none sm-mt-30">
        <li class="prev_a slick-arrow"><i class="arrow_left"></i></li>
        <li class="next_a slick-arrow"><i class="arrow_right"></i></li>
    </ul>
</div>