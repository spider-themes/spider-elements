<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<div class="feedback-section-two">
    <div class="feedback-slider-two testimonial-slider-<?php echo esc_attr($testimonial_id); ?>">
        <?php
        if (!empty($testimonials6)) {
            foreach ( $testimonials6 as $item ) {
                $rating_data = $this->get_rating($item[ 'author_rating' ]);
                $textual_rating = $rating_data[ 0 ] . '/' . $rating_data[ 1 ];
                ?>
                <div class="item elementor-repeater-item-<?php echo esc_attr($item[ '_id' ]); ?>">
                    <div class="feedback-block-one feedback-block-two">
                        <?php
                        if ('star_fontawesome' === $settings[ 'star_style' ]) {
                            if ('outline' === $settings[ 'unmarked_star_style' ]) {
                                $icon = '&#xE933;';
                            }
                        } elseif ('star_unicode' === $settings[ 'star_style' ]) {
                            $icon = '&#9733;';
                            if ('outline' === $settings[ 'unmarked_star_style' ]) {
                                $icon = '&#9734;';
                            }
                        }

                        $this->add_render_attribute('icon_wrapper', [
                            'class' => 'star-rating',
                            'title' => $textual_rating,
                            'itemscope' => '',
                            'itemprop' => 'reviewRating',
                        ]);

                        $schema_rating = '<span itemprop="ratingValue" class="elementor-screen-only">' . $textual_rating . '</span>';
                        $stars_element = '<div ' . esc_attr($this->get_render_attribute_string('icon_wrapper')) . '>' . $this->render_stars($icon, $item[ 'author_rating' ]) . ' ' . $schema_rating . '</div>';
                        ?>
                        <div class="review">
                            <?php if (!\Elementor\Utils::is_empty($item[ 'author_rating_title' ])) : ?>
                                <div class="text-md fw-500"><?php echo esc_html($item[ 'author_rating_title' ]); ?></div>
                            <?php endif; ?>

                            <?php if ($testimonial_ratting_icon == 'yes') : ?>
                                <?php echo wp_kses_post($stars_element) ?>
                            <?php endif; ?>
                        </div>
                        <?php
                        if (!empty($item[ 'review_content' ])) { ?>
                            <h3><?php echo esc_html($item[ 'review_content' ]) ?>
                            </h3>
                            <?php
                        }
                        if (!empty($item[ 'author_name' ])) { ?>
                            <div class="block-footer ezd-d-flex ezd-align-items-center ezd-justify-content-between pt-35 lg-pt-20">
                                <div class="ezd-d-flex ezd-align-items-center">
                                    <?php
                                    if (!empty($item[ 'author_image' ][ 'id' ])) {
                                        spel_dynamic_image($item[ 'author_image' ], 'full', [ 'class' => 'author-img ezd-rounded-circle' ]);
                                    }
                                    if (!empty($item[ 'author_name' ])) {
                                        ?>
                                        <div class="ezd-ms-3">
                                            <div class="name fw-500"><?php echo esc_html($item[ 'author_name' ]); ?></div>
                                            <span class="opacity-50"><?php echo esc_html($item[ 'author_position' ]); ?></span>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <?php
                                if (!empty($item[ 'company_image' ][ 'id' ])) {
                                    spel_dynamic_image($item[ 'company_image' ], 'full', [ 'class' => 'quote-icon' ]);
                                }
                                ?>
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
</div>