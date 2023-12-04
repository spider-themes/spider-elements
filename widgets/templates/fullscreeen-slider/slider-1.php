<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<section class="banner-area-2 banner-area-6" id="home">
    <div class="swiper banner-main">
        <div class="swiper-wrapper">
            <?php
            if (!empty($sliders)) {
                foreach ( $sliders as $item ) {
                    ?>
                    <div class="swiper-slide" style="background-image: url('<?php echo esc_url($item[ 'bg_img' ][ 'url' ]) ?>')">
                        <div class="banner-content text-center">
                            <?php
                            if (!empty($item[ 'title' ])) { ?>
                                <h1><?php echo wp_kses_post($item[ 'title' ]) ?></h1>
                                <?php
                            }
                            if (!empty($item[ 'subtitle' ])) { ?>
                                <p class="mt-75"><?php echo esc_html($item[ 'subtitle' ]) ?></p>
                                <?php
                            }
                            if (!empty($item[ 'title' ])) {
                                ?>
                                <a <?php spe_the_button($item[ 'btn_url' ]) ?>
                                        class="theme-btn theme-btn-outline-white mt-30">
                                    <?php echo esc_html($item[ 'btn_label' ]) ?>
                                </a>
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
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
    <div class="banner-thumbnails ezd-d-none ezd-d-md-block">
        <div class="swiper banner-thumbs">
            <div class="swiper-wrapper">
                <?php
                if (!empty($sliders)) {
                    foreach ( $sliders as $item ) {
                        ?>
                        <div class="swiper-slide">
                            <div class="banner-thumb-img">
                                <?php echo wp_get_attachment_image($item[ 'bg_img' ][ 'id' ], 'spe_120x70'); ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>