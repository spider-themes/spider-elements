<?php
wp_enqueue_script('artplayer');
wp_enqueue_script('mcustomscrollbar');
?>
<section class="video_list_area p_125 video-playlist">
    <div class="container">
        <div class="row justify-content-sm-between">
            <div class="col-lg-7">
                <div class="tab-content video_tabs" id="myTabContent2">
                    <?php
                    $i = 0;
                    while ( $videos->have_posts() ) : $videos->the_post();
                        $active = ($i == 0) ? 'show active' : '';
                        //echo '<pre>'.print_r($video, 1).'</pre>';
                        ?>
                        <div class="tab-pane fade <?php echo esc_attr($active) ?>" id="video<?php the_ID(); ?>" role="tabpanel" aria-labelledby="video<?php the_ID(); ?>-tab">
                            <div class="artplayer-app<?php the_ID(); ?>"></div>
                        </div>
                        <?php
                        ++$i;
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="video_list">
                    <?php
                    $title_tag = !empty($settings['title_tag']) ? $settings['title_tag'] : 'h3';
                    echo !empty($settings['title']) ? sprintf('<%1$s class="title" data-animation="wow fadeInUp" data-wow-delay="0.2s"> %2$s </%1$s>', $title_tag, nl2br($settings['title'])) : '';
                    ?>
                    <div class="video_list_inner scroll">
                        <div class="accordion" id="accordionExample">
                            <?php
                            foreach ( $cats as $index => $cat ) :
                                $cat_videos_i = 0;
                                $cat_slug     = $cat->slug ?? '';
                                $cat_name     = $cat->name ?? '';
                                $cat_videos = new \WP_Query( array (
                                    'post_type' => 'video',
                                    'posts_per_page' => -1,
                                    'tax_query' => array (
                                        array(
                                            'taxonomy' => 'video_cat',
                                            'field'    => 'slug',
                                            'terms'    =>  $cat_slug,
                                        ),
                                    ),
                                ));

                                $cat_videos_count = $cat_videos_i < 10 ? '0'.$cat_videos->post_count : $cat_videos->post_count;

                                $tab_count = (int)$index + 1;
                                $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', '', $index );
                                $cat_coll = $tab_count == 1 ? '' : 'collapsed';
                                $this->add_render_attribute( $tab_content_setting_key, [
                                    'class' => [ 'btn btn-link btn-block text-left', $cat_coll ],
                                    'data-bs-toggle' => 'collapse',
                                    'data-bs-target' => '#'. $cat_slug,
                                    'aria-expanded' => $index == 0 ? 'true' : 'false',
                                    'aria-controls' =>  $cat_slug,
                                    'type' => 'button'
                                ]);
                                ?>
                                <div class="card">
                                    <div class="card-header" id="<?php echo esc_attr($cat_slug.'-tab') ?>">
                                        <button <?php echo $this->get_render_attribute_string($tab_content_setting_key); ?>>
                                            <span class="title"> <?php echo $cat_name; ?> </span>
                                            <span class="count">(<?php echo $cat_videos_count; ?>)</span>
                                            <span class="plus-minus">
                                                <i class="icon_plus"></i>
                                                <i class="icon_minus-06"></i>
                                            </span>
                                        </button>
                                    </div>

                                    <div id="<?php echo  $cat_slug; ?>" class="collapse <?php echo $index == 0 ? 'show' : '' ?>" aria-labelledby="<?php echo $cat_slug.'-tab'; ?>" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <?php
                                                while ( $cat_videos->have_posts() ) : $cat_videos->the_post();
                                                    $active = $cat_videos_i == 0 && $index == 0 ? ' active' : '';
                                                    ?>
                                                    <li class="nav-item" role="presentation">
                                                        <a class="nav-link<?php echo $active; ?>" id="video<?php the_ID(); ?>-tab" data-bs-toggle="tab" href="#video<?php the_ID(); ?>" role="tab" aria-controls="video<?php the_ID(); ?>" aria-selected="true">
                                                            <div class="media d-flex">
                                                                <?php if ( has_post_thumbnail(get_the_ID()) ) : ?>
                                                                    <div class="d-flex">
                                                                        <div class="video_tab_img">
                                                                            <?php the_post_thumbnail('docy_60x40'); ?>
                                                                        </div>
                                                                    </div>
                                                                <?php endif; ?>
                                                                <div class="media-body">
                                                                    <h4><?php the_title() ?></h4>
                                                                    <div class="list">
                                                                        <div><ion-icon name="person-outline"></ion-icon> <?php the_author_meta('display_name'); ?> </div>
                                                                        <div><ion-icon name="calendar-clear-outline"></ion-icon> <?php the_time(get_option('date_format')); ?> </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <?php
                                                    ++$cat_videos_i;
                                                endwhile;
                                                wp_reset_postdata();
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    (function ($) {
        "use strict";
        $(document).ready(function () {
            const list = [
                <?php
                while ( $videos->have_posts() ) : $videos->the_post();
                    $video = function_exists('get_field') ? get_field('video') : '';
                    ?>
                    {
                        className: ".artplayer-app<?php the_ID(); ?>",
                        url: "<?php echo esc_js($video['url'])  ?>",
                        title: "<?php the_title() ?>",
                        poster: "<?php the_post_thumbnail_url(); ?>",
                    },
                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            ];

            list.forEach(function (e) {
                var art = new Artplayer({
                    container: e.className,
                    url: e.url,
                    title: e.title,
                    poster: e.poster,
                    volume: 0.5,
                    muted: false,
                    autoplay: false,
                    pip: true,
                    autoSize: true,
                    autoMini: false,
                    screenshot: true,
                    setting: true,
                    loop: true,
                    flip: true,
                    rotate: true,
                    playbackRate: true,
                    aspectRatio: false,
                    fullscreen: true,
                    fullscreenWeb: true,
                    subtitleOffset: true,
                    miniProgressBar: true,
                    localVideo: true,
                    localSubtitle: true,
                    networkMonitor: false,
                    mutex: true,
                    light: true,
                    backdrop: true,
                    isLive: false,
                    theme: "#10b3d6",
                    lang: navigator.language.toLowerCase(),
                    // moreVideoAttr: {
                    //   crossOrigin: "anonymous",
                    // },
                    contextmenu: [
                        {
                            html: "Custom menu",
                            click: function (contextmenu) {
                                console.info("You clicked on the custom menu");
                                contextmenu.show = false;
                            },
                        },
                    ],
                    controls: [
                        {
                            position: "right",
                            html: "Control",
                            index: 10,
                            click: function () {
                                console.info("You clicked on the custom control");
                            },
                        },
                    ],
                    icons: {
                        loading: '<img src="<?php echo plugins_url('images/ploading.gif', __FILE__) ?>">',
                        state: '<ion-icon name="play"></ion-icon>',
                    },
                });
            });

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