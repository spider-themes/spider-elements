<section class="video_list_area">
    <div class="row justify-content-sm-between">
        <div class="col-lg-7">
            <div class="video_player">
                <div class="tab-content video_tabs" id="<?php esc_attr( get_the_ID() ); ?>">
					<?php
					$all_videos = $settings[ 'tabs' ] ?? '';
					$i          = '0';
					$active     = '';
					foreach ( $all_videos as $video_item ) {
						$child_videos = $video_item[ 'videos' ] ?? '';
						foreach ( $child_videos as $child_video ) {
							?>
                            <div class="tab-pane fade pt-0 <?php echo esc_attr( $active ); ?>" id="video_<?php echo esc_attr( $i ++ ); ?>">
                                <div class="artplayer-app" data-src="<?php echo esc_url( $child_video[ 'video_upload' ][ 'url' ] ); ?>"></div>
                            </div>
							<?php
						}
					}
					?>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="video_list">
            <<?php echo $title_tag; ?> class="title" data-animation="wow fadeInUp" data-wow-delay="0.2s">
                <?php echo esc_html( $settings[ 'title' ] ); ?>
            </<?php echo $title_tag; ?>>
            <div class="video_list_inner scroll">
                <div class="accordion" id="accordionExample" data-bs-accordion="true">
					<?php
					$all_videos = $settings[ 'tabs' ] ?? '';
					$i          = '0';
					$count      = '0';
					$collapse   = '';
					foreach ( $all_videos as $video_item ) {
						$count ++;
						$child_videos = $video_item[ 'videos' ] ?? '';

						$total_item = count( $child_videos );
						$total_item = $total_item - 0;

						if ( $total_item < 10 ) {
							$total_item = '0' . $total_item;
						}

						$nav_collapse = 'collapsed';
						if ( $count == 1 ) {
							$nav_collapse = 'expand';
						}
						?>
                        <div class="card accordion-panel">
                            <div class="card" id="configuration<?php echo $count; ?>-tab">
                                <div class="card-header">
                                    <button class="text-left accordion-header <?php echo esc_attr( $nav_collapse ); ?>"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#configuration<?php echo esc_attr( $count ); ?>"
                                            aria-expanded="true"
                                            aria-controls="configuration<?php echo esc_attr( $count ) ?>" type="button">
                                        <span class="title"><?php echo esc_html( $video_item[ 'title' ] ); ?> </span>
                                        <span class="count">(<?php echo esc_html( $total_item ); ?>)</span>
                                        <span class="plus-minus">
                                            <svg fill="#000000" width="15px" height="15px" viewBox="0 0 24 24" id="plus" data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="icon line-color"><path id="primary" d="M5,12H19M12,5V19" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></path></svg>
                                            <svg fill="#000000" width="15px" height="15px" viewBox="0 0 24 24" id="minus" data-name="Line Color" xmlns="http://www.w3.org/2000/svg" class="icon line-color"><line id="primary" x1="19" y1="12" x2="5" y2="12" style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;"></line></svg>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <div id="configuration<?php echo esc_attr( $count ); ?>"
                                 class="accordion-content <?php echo $count == 1 ? 'collapse show' : '' ?> "
                                 aria-labelledby="configuration<?php echo $count; ?>-tab"
                                 data-bs-parent="#accordionExample">
                                <div class="card-body">
                                    <ul class="nav nav-tabs" role="tablist">
										<?php
										foreach ( $child_videos as $child_video ) {
											?>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link <?php echo $i == 0 ? 'active' : '' ?>" data-bs-toggle="tab" href="#video_<?php echo esc_attr( $i ++ ); ?>">
                                                    <div class="media d-flex">
                                                        <div class="d-flex">
                                                            <div class="video_tab_img">
                                                                <img loading="lazy" width="60" height="40" src="<?php echo $child_video[ 'thumbnail' ][ 'url' ] ?? ''; ?>" alt="video-thumbnails" />
                                                            </div>
                                                        </div>
                                                        <div class="media-body">
                                                            <h4><?php echo esc_html( $child_video[ 'title2' ] ); ?></h4>
                                                            <div class="list">
                                                                <div>
                                                                    <ion-icon name="person-outline" role="img" class="md hydrated" aria-label="person outline"></ion-icon>
																	<?php
																	$author = $child_video[ 'current_author' ] ?? '';
																	echo ucwords( $author );
																	?>
                                                                    <ion-icon name="calendar-clear-outline" role="img" class="md hydrated" aria-label="calendar clear outline"></ion-icon>
																	<?php
																	$video_date = $child_video[ 'current_date' ] ?? '';
																	echo human_time_diff( strtotime( $video_date ), current_time( 'timestamp' ) ) . __( ' ago', 'spider-elements' );
																	?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
											<?php
										}
										?>
                                    </ul>
                                </div>
                            </div>
                        </div>
						<?php
					}
					?>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    (function ($) {
        "use strict";
        $(document).ready(function () {
            $(document).on("click", function (e) {
                var el = e.target.nodeName,
                    parent = e.target.parentNode;
                if (
                    (el === "path" && videoControlClassCheck(parent.parentNode)) ||
                    (el === "svg" && videoControlClassCheck(parent))
                ) {
                    $(".video_list_area").toggleClass("theatermode");
                }
            });

            function videoControlClassCheck(parent) {
                return parent.className.indexOf("art-icon-fullscreenWeb") !== -1;
            }
        })
    })(jQuery);
</script>