<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<div id="go_premium" class="spel-tab-box">
    <div class="dashboard_banner premium_banner">
        <h2><?php esc_html_e('Get Spider Elements Addons Pro', 'spider-elements'); ?></h2>
        <p><?php esc_html_e('Purchase the premium version of spider Elements Addons to get additional and exclusive features.', 'spider-elements'); ?>
        </p>
        <a href="#" class="banner_btn">
            <?php esc_html_e('CLICK here to get Spider Elementor Addons PRO!', 'spider-elements'); ?>
        </a>
        <img class="rocket_img" src="<?php echo esc_url(SPEL_IMG . '/dashboard/rocket.png') ?>"
            alt="<?php esc_attr_e('Go Premium Banner', 'spider-elements'); ?>">
    </div>

    <div class="ezd-grid ezd-grid-cols-12">
        <div class="ezd-lg-col-6">
            <div class="pr_promo_box ezd-text-center">
                <div class="promo_video">
                    <img src="<?php echo esc_url(SPEL_IMG . '/dashboard/video1.jpg') ?>" alt="">
                    <a href="https://www.youtube.com/embed/njSyHmcEdkw" class="popup_youtube"><i
                            class="icon-video-play"></i></a>
                </div>
                <h2>Protected Content</h2>
                <p>Restrict important data by setting up user permission or giving password to certain area.</p>
                <a href="#" class="demo_btn">View Demo
                    <img src="<?php echo esc_url(SPEL_IMG . '/dashboard/arrow.svg') ?>" alt=""></a>
            </div>
        </div>
        <div class="ezd-lg-col-6">
            <div class="pr_promo_box ezd-text-center">
                <div class="promo_video">
                    <img src="<?php echo esc_url(SPEL_IMG . '/dashboard/video2.jpg') ?>" alt="">
                    <a href="https://www.youtube.com/embed/njSyHmcEdkw" class="popup_youtube"><i
                            class="icon-video-play"></i></a>
                </div>
                <h2>Protected Content</h2>
                <p>Restrict important data by setting up user permission or giving password to certain area.</p>
                <a href="#" class="demo_btn">View Demo <img src="<?php echo esc_url(SPEL_IMG . '/dashboard/arrow.svg') ?>" alt=""></a>
            </div>
        </div>
    </div>

    <div class="filter_content mt-25 ezd-d-flex">
        <div class="ezd-colum-space-4 free">
            <div class="element_box element_switch">
                <span class="badge">Pro</span>
                <div class="element_content">
                    <i class="icon-hotspot"></i>
                    <label for="elementor-video">Video Playlist</label>
                </div>
                <div class="element_right">
                    <div class="link">
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-demo.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-video.svg') ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="widget_checkbox" id="elementor-video">
                        <span class="widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 free">
            <div class="element_box element_switch">
                <span class="badge">Pro</span>
                <div class="element_content">
                    <i class="icon-hotspot"></i>
                    <label for="elementor-video-two">Video Playlist</label>
                </div>
                <div class="element_right">
                    <div class="link">
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-demo.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-video.svg') ?>" alt=""></a>
                    </div>
                    <label class="pro_popup">
                        <input type="checkbox" class="widget_checkbox" id="elementor-video-two" disabled>
                        <span class="widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 free">
            <div class="element_box element_switch">
                <span class="badge">Pro</span>
                <div class="element_content">
                    <i class="icon-hotspot"></i>
                    <label for="elementor-video-three">Video Playlist</label>
                </div>
                <div class="element_right">
                    <div class="link">
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-demo.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-video.svg') ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="widget_checkbox" id="elementor-video-three">
                        <span class="widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 free">
            <div class="element_box element_switch">
                <span class="badge">Pro</span>
                <div class="element_content">
                    <i class="icon-hotspot"></i>
                    <label for="elementor-hotspot">Image Hotspot</label>
                </div>
                <div class="element_right">
                    <div class="link">
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-demo.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-video.svg') ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="widget_checkbox" id="elementor-hotspot">
                        <span class="widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 pro">
            <div class="element_box element_switch">
                <span class="badge">Pro</span>
                <div class="element_content">
                    <i class="icon-accordion"></i>
                    <label for="elementor-accordion">Accordion</label>
                </div>
                <div class="element_right">
                    <div class="link">
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-demo.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-video.svg') ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="widget_checkbox" id="elementor-accordion">
                        <span class="widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 pro">
            <div class="element_box element_switch">
                <span class="badge">Pro</span>
                <div class="element_content">
                    <i class="icon-accordion-article"></i>
                    <label for="elementor-accordion-article">Accordion Article</label>
                </div>
                <div class="element_right">
                    <div class="link">
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-demo.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-video.svg') ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="widget_checkbox" id="elementor-accordion-article">
                        <span class="widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 free">
            <div class="element_box element_switch">
                <span class="badge">Pro</span>
                <div class="element_content">
                    <i class="icon-hotspot"></i>
                    <label for="elementor-video">Video Playlist</label>
                </div>
                <div class="element_right">
                    <div class="link">
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-demo.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-video.svg') ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="widget_checkbox" id="elementor-video">
                        <span class="widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 free">
            <div class="element_box element_switch">
                <span class="badge">Pro</span>
                <div class="element_content">
                    <i class="icon-hotspot"></i>
                    <label for="elementor-video-two">Video Playlist</label>
                </div>
                <div class="element_right">
                    <div class="link">
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-demo.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-video.svg') ?>" alt=""></a>
                    </div>
                    <label class="pro_popup">
                        <input type="checkbox" class="widget_checkbox" id="elementor-video-two" disabled>
                        <span class="widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 free">
            <div class="element_box element_switch">
                <span class="badge">Pro</span>
                <div class="element_content">
                    <i class="icon-hotspot"></i>
                    <label for="elementor-video-three">Video Playlist</label>
                </div>
                <div class="element_right">
                    <div class="link">
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-demo.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/dashboard/icon-video.svg') ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="widget_checkbox" id="elementor-video-three">
                        <span class="widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="qa_inner ezd-d-flex">
        <img src="<?php echo esc_url(SPEL_IMG . '/dashboard/qa.png') ?>"
            alt="<?php esc_attr_e('Automatic Updates', 'spider-elements'); ?>">
        <div class="content">
            <h2><?php esc_html_e('Automatic Updates & Priority Support', 'spider-elements'); ?></h2>
            <p><?php esc_html_e('Get access to automatic updates & keep your website up-to-date with constantly developing features.
                Having any trouble? Don\'t worry as you can reach out to our expert Support team any time through live
                chat or support tickets.', 'spider-elements'); ?></p>
        </div>
    </div>
    <div class="ezd-text-center mt-25">
        <a href="#" class="dashboard_btn"><?php esc_html_e('Upgrade To PRO', 'spider-elements'); ?></a>
    </div>
</div>