<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<section class="video_list_area">
    <div class="ezd-grid ezd-grid-cols-12 ezd-justify-content-sm-between">
        <div class="ezd-lg-col-7">
            <div class="video_player">
                <div class="tab-content video_tabs" id="<?php esc_attr(get_the_ID()); ?>">
                    <?php
                    $all_videos = $settings[ 'tabs' ] ?? '';
                    $i = '0';
                    $active = '';
                    foreach ( $all_videos as $video_item ) {
                        $child_videos = $video_item[ 'videos' ] ?? '';
                        foreach ( $child_videos as $child_video ) {
                            ?>
                            <div class="tab-pane ezd-tab-box pt-0 <?php echo esc_attr($active); ?>"
                                 id="video_<?php echo esc_attr($i++); ?>">
                                <div class="artplayer-app"
                                     data-src="<?php echo esc_url($child_video[ 'video_upload' ][ 'url' ]); ?>"></div>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="ezd-lg-col-5">
            <div class="video_list">
                <<?php echo esc_attr($title_tag); ?> class="title" data-animation="wow fadeInUp" data-wow-delay="0.2s">
                    <?php echo esc_html($settings[ 'title' ]); ?>
                </<?php echo esc_attr($title_tag); ?>>
                <div class="video_list_inner scroll">
                    <div class="accordion">
                        <?php
                        $all_videos = $settings[ 'tabs' ] ?? '';
                        $i = '0';
                        $count = '0';
                        $collapse = '';
                        foreach ($all_videos as $video_item) {
                            $count++;
                            $child_videos = $video_item[ 'videos' ] ?? '';
                            $total_item = count($child_videos);
                            $total_item = $total_item - 0;

                            if ($total_item < 10) {
                                $total_item = '0' . $total_item;
                            }

                            $nav_collapse = 'collapsed';
                            if ($count == 1) {
                                $nav_collapse = 'expand';
                            }
                            ?>
                            <div class="card accordion-panel spe_accordion_inner">
                                <div class="card spe-accordion" id="configuration<?php echo esc_attr($count); ?>-tab">
                                    <div class="card-header">
                                        <button class="text-left accordion-header <?php echo esc_attr($nav_collapse); ?>">
                                            <span class="title"><?php echo esc_html($video_item[ 'title' ]); ?> </span>
                                            <span class="count">(<?php echo esc_html($total_item); ?>)</span>
                                            <span class="plus-minus">
                                                    <svg fill="#000000" width="15px" height="15px" viewBox="0 0 24 24" id="plus"
                                                         data-name="Line Color" xmlns="http://www.w3.org/2000/svg"
                                                         class="icon line-color">
                                                        <path id="primary" d="M5,12H19M12,5V19"
                                                              style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                        </path>
                                                    </svg>
                                                    <svg fill="#000000" width="15px" height="15px" viewBox="0 0 24 24"
                                                         id="minus" data-name="Line Color" xmlns="http://www.w3.org/2000/svg"
                                                         class="icon line-color">
                                                        <line id="primary" x1="19" y1="12" x2="5" y2="12"
                                                              style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                        </line>
                                                    </svg>
                                                </span>
                                        </button>
                                    </div>
                                </div>
                                <div id="configuration<?php echo esc_attr($count); ?>" class="accordion-content collapse">
                                    <div class="card-body">
                                        <ul class="nav nav-tabs ezd-tab-menu">
                                            <?php
                                            if (!empty($child_videos)) {
                                                foreach ( $child_videos as $child_video ) {
                                                    $is_active = $i == 0 ? ' active' : '';
                                                    ?>
                                                    <li class="nav-item">
                                                        <a class="nav-link<?php esc_attr($is_active); ?>"
                                                           href="#video_<?php echo esc_attr($i++); ?>">
                                                            <div class="media ezd-d-flex">
                                                                <?php if (!empty($child_video[ 'thumbnail' ][ 'url' ])) : ?>
                                                                    <div class="ezd-d-flex">
                                                                        <div class="video_tab_img">
                                                                            <img loading="lazy" width="60" height="40"
                                                                                 src="<?php echo esc_url($child_video[ 'thumbnail' ][ 'url' ]) ?>"
                                                                                 alt="video-thumbnails"/>
                                                                        </div>
                                                                    </div>
                                                                <?php endif ?>
                                                                <div class="media-body">
                                                                    <h4><?php echo esc_html($child_video[ 'title2' ]); ?></h4>
                                                                    <div class="list">
                                                                        <div>
                                                                            <div>
                                                                                <ion-icon name="person-outline" role="img"
                                                                                          class="md hydrated"
                                                                                          aria-label="person outline">
                                                                                </ion-icon>
                                                                                <?php
                                                                                $author = $child_video[ 'current_author' ] ?? '';
                                                                                echo ucwords($author);
                                                                                ?>
                                                                            </div>
                                                                            <div>
                                                                                <ion-icon name="calendar-clear-outline"
                                                                                          role="img"
                                                                                          class="md hydrated"
                                                                                          aria-label="calendar clear outline"></ion-icon>
                                                                                <?php
                                                                                $video_date = $child_video[ 'current_date' ] ?? '';
                                                                                echo human_time_diff(strtotime($video_date),
                                                                                        current_time('timestamp')) . __(' ago',
                                                                                        'spider-elements');
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
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
    </div>
</section>

<script>
    ;(function ($) {
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

        let videoAccordion = $(".spe_accordion_inner > .spe-accordion");
        videoAccordion.on("click", function () {
            var $this = $(this);
            var $parent = $this.parent();
            var $collapse = $parent.find("> .collapse").first();

            $collapse.slideToggle(300);
            $parent.siblings().find("> .collapse").hide(300);

            if ($parent.hasClass("spe-collapsed")) {
                $parent.removeClass("spe-collapsed");
            } else {
                videoAccordion.parent().removeClass("spe-collapsed");
                $parent.addClass("spe-collapsed");
            }
            return false;
        });
        // custom tab js
        $(".ezd-tab-menu li a").on("click", function (e) {
            e.preventDefault();

            // Remove active class from all tabs within the same menu
            $(this).closest(".ezd-tab-menu").find("li a").removeClass("active");

            // Add active class to the clicked tab
            $(this).addClass("active");

            var target = $(this).attr("href");

            $("" + target)
                .addClass("active")
                .siblings(".ezd-tab-box")
                .removeClass("active");

            return false;
        });

        document.addEventListener("DOMContentLoaded", function () {
            let video = $("#video_0");
            setTimeout(function () {
                $(".video_slider_area").addClass("loaded").css("height", "auto");
            }, 3000);

            video.addClass("show").addClass("active");
            let containers = document.getElementsByClassName("artplayer-app");
            if (containers.length > 0) {
                for (var i = 0; i < containers.length; i++) {
                    new Artplayer({
                        container: containers[i],
                        url: containers[i].getAttribute("data-src"),
                        title: "Your Name",
                        pip: true,
                        screenshot: true,
                        flip: true,
                        fullscreen: true,
                        fullscreenWeb: true,
                        height: "500px",
                    });
                }
            }
        });
    })(jQuery);
</script>