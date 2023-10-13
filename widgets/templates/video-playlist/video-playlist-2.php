<?php
$is_preloader = '1';
if ( did_action( 'elementor/loaded' ) ) {
	if ( \Elementor\Plugin::$instance->preview->is_preview_mode() ) {
		$is_preloader = '';
	}
}

if ( $is_preloader == '1' ) {
	?>
    <div id="video_loader">
        <div id="loader"></div>
    </div>
	<?php
}

?>
<div class="video_slider_area video-playlist">
    <div class="gallery-top">
		<?php
		$i          = 0;
		$all_videos = $settings[ 'tabs' ] ?? '';
		$i          = '0';
		$active     = '';
		foreach ( $all_videos as $videos ) {
			$child_videos = $videos[ 'videos' ] ?? '';

			foreach ( $child_videos as $child_video ) {
				$video_url = $child_videos[ 'video_upload' ] ?? '';
				?>
                <div class="item">
                    <div class="row video2_wrapper">
                        <div class="col-lg-7 player_wrapper">
                            <video id="player_<?php echo esc_attr( $child_video[ 'video_upload' ][ 'id' ] ); ?>"
                                   class="video-js vjs-fluid vjs-default-skin" controls preload playsinline
                                   poster="<?php echo esc_attr( $child_video[ 'thumbnail' ][ 'url' ] ); ?>">
                                <source src="<?php echo esc_url( $child_video[ 'video_upload' ][ 'url' ], ); ?>"
                                        type="video/mp4">
                            </video>
                        </div>
                        <div class="col-lg-5">
                            <div class="slide_text">
                                <a href="#">
                                    <h4> <?php echo esc_html( $child_video[ 'title2' ] ); ?> </h4>
                                </a>
								<?php echo wpautop( $child_video[ 'video_caption' ] ); ?>
                                <div class="video_user">
                                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>">
                                        <ion-icon
                                                name="person-outline"></ion-icon> <?php the_author_meta( 'display_name' ); ?>
                                    </a>
                                    <a href="<?php spe_day_link(); ?>">
                                        <ion-icon name="calendar-clear-outline"></ion-icon>
										<?php the_time( get_option( 'date_format' ) ); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<?php
			}
		}
		?>
    </div>

    <div class="gallery_main_area">
        <div class="gallery-thumbs p-0">
			<?php
			if ( is_array( $all_videos ) ) {
				foreach ( $all_videos as $videos ) {
					$child_videos = $videos[ 'videos' ] ?? '';

					foreach ( $child_videos as $child_video ) {
						$img_id = attachment_url_to_postid( $child_video[ 'thumbnail' ][ 'url' ] );
						?>
                        <div class="item">
                            <div class="gallery_inner_thumb">
								<?php
								if ( ! empty ( $get_img ) ) :
									wp_get_attachment_image( $img_id, 'spe_270x152' );
								else : ?>
                                    <img src="<?php echo esc_url( $child_video[ 'thumbnail' ][ 'url' ] ); ?>"
                                         alt="<?php esc_attr_e( 'Video Poster Image', 'spider-elements' ); ?>"/>
								<?php
								endif;
								?>
                                <div class="caption_text">
                                    <div class="play-icon">
                                        <ion-icon name="play"></ion-icon>
                                    </div>
                                    <h4> <?php echo esc_html( $child_video[ 'title2' ] ); ?></h4>
                                </div>
                            </div>
                        </div>
						<?php
					}
				}
			}
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
                    responsive: [{
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
					<?php
					foreach( $all_videos as $videos ) :
					$child_videos = $videos[ 'videos' ] ?? '';
					foreach( $child_videos as $child_video ) : ?> videojs(
                        "player_<?php echo esc_js( $child_video[ 'video_upload' ][ 'id' ] ); ?>"),
					<?php endforeach;
					endforeach;
					?>
                );
            }

            Video_slide_player();
        })
    })(jQuery);
</script>