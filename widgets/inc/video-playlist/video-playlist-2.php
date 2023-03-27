<?php
wp_enqueue_style('slick');
wp_enqueue_style('slick-theme');
wp_enqueue_style('video-js');
wp_enqueue_style('video-js-theaterMode');

wp_enqueue_script('slick');
wp_enqueue_script('video-js');
wp_enqueue_script('video-js-nuevo');
?>

<div class="video_slider_area video-playlist">
<div class="gallery-top">
    <?php
    $i = 0;
    while ( $videos->have_posts() ) : $videos->the_post();
        $active = ($i == 0) ? 'show active' : '';
        $video = function_exists('get_field') ? get_field('video') : '';
        //echo '<pre>'.print_r($video, 1).'</pre>';
        ?>
        <div class="item">
            <div class="row video2_wrapper">
                <div class="col-lg-7 player_wrapper">
                    <video id="player_<?php the_ID(); ?>" class="video-js vjs-fluid vjs-default-skin"
                           controls preload playsinline
                           poster="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'docy_671x411') ?>">
                        <source src="<?php echo ! empty( $video['url'] ) ? esc_url($video['url']) : '';  ?>" type="video/mp4">
                    </video>
                </div>
                <div class="col-lg-5">
                    <div class="slide_text">
                        <a href="#">
                            <?php the_title('<h4>', '</h4>'); ?>
                        </a>
                        <?php the_excerpt(); ?>
                        <div class="video_user">
                            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>">
                                <ion-icon name="person-outline"></ion-icon> <?php the_author_meta('display_name'); ?>
                            </a>
                            <a href="<?php docycore_day_link(); ?>">
                                <ion-icon name="calendar-clear-outline"></ion-icon> <?php the_time(get_option('date_format')); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    endwhile;
    wp_reset_postdata();
    ?>
</div>

<div class="gallery_main_area">
        <div class="gallery-thumbs">
            <?php
            while ( $videos->have_posts() ) : $videos->the_post();
                ?>
                <div class="item">
                    <div class="gallery_inner_thumb">
                        <?php the_post_thumbnail('docy_270x152'); ?>
                        <div class="caption_text">
                            <div class="play-icon">
                                <ion-icon name="play"></ion-icon>
                            </div>
                            <?php the_title('<h4>', '</h4>') ?>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
        <div class="prev">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </div>
        <div class="next">
            <ion-icon name="chevron-forward-outline"></ion-icon>
        </div>
    </div>
</div>

<script>
    (function ($) {
        "use strict";
        $(document).ready(function () {
            $(".gallery-top")
                .slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    infinite: false,
                    asNavFor: ".gallery-thumbs",
                })
                .on("beforeChange", function (event, slick, currentSlide, nextSlide) {
                    $(".gallery-top .slick-current video").attr(
                        "src",
                        $(".gallery-top .slick-current video").attr("src")
                    );
                    $(".gallery-top .slick-current .video-js").removeClass("vjs-playing");
                });
            $(".gallery-thumbs")
                .slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    vertical: false,
                    asNavFor: ".gallery-top",
                    dots: false,
                    focusOnSelect: true,
                    arrows: true,
                    infinite: false,
                    swipeToSlide: true,
                    prevArrow: $(".prev"),
                    nextArrow: $(".next"),
                    responsive: [
                        {
                            breakpoint: 992,
                            settings: {
                                vertical: false,
                                slidesToShow: 3,
                            },
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                vertical: false,
                                slidesToShow: 3,
                            },
                        },
                        {
                            breakpoint: 650,
                            settings: {
                                vertical: false,
                                slidesToShow: 2,
                            },
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                vertical: false,
                                slidesToShow: 1,
                            },
                        },
                    ],
                })
                .on("beforeChange", function (event, slick, currentSlide, nextSlide) {
                    $(".gallery-thumbs .slick-current video").attr(
                        "src",
                        $(".gallery-thumbs .slick-current video").attr("src")
                    );
                    $(".gallery-thumbs .slick-current .video-js").removeClass(
                        "vjs-playing"
                    );
                });

            function Video_slide_player() {
                var myPlayers = Array(
                    <?php while ( $videos->have_posts() ) : $videos->the_post(); ?>
                    videojs("player_<?php echo esc_js(get_the_ID()); ?>"),
                    <?php endwhile; wp_reset_postdata(); ?>
                );
            }
            Video_slide_player();
        })
    })(jQuery);
</script>