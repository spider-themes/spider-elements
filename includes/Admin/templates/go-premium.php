<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<div id="go_premium" class="spel-tab-box">
    <div class="spe_dashboard_banner premium_banner">
        <h2><?php esc_html_e('Get Spider Elements Addons Pro', 'spider-elements'); ?></h2>
        <p><?php esc_html_e('Purchase the premium version of spider Elements Addons to get additional and exclusive features.', 'spider-elements'); ?>
        </p>
        <a href="#" class="spe_banner_btn">
            <?php esc_html_e('CLICK here to get Spider Elementor Addons PRO!', 'spider-elements'); ?>
        </a>
        <img class="rocket_img" src="<?php echo esc_url(SPEL_IMG . '/dashboard-img/rocket.png') ?>"
            alt="<?php esc_attr_e('Go Premium Banner', 'spider-elements'); ?>">
    </div>

    <div class="ezd-grid ezd-grid-cols-12">
        <div class="ezd-lg-col-6">
            <div class="spe_pr_promo_box ezd-text-center">
                <div class="spe_promo_video">
                    <img src="<?php echo esc_url(SPEL_IMG . '/dashboard-img/video1.jpg') ?>" alt="">
                    <a href="https://www.youtube.com/embed/njSyHmcEdkw" class="spe_popup_youtube"><i
                            class="icon-video-play"></i></a>
                </div>
                <h2>Protected Content</h2>
                <p>Restrict important data by setting up user permission or giving password to certain area.</p>
                <a href="#" class="spe_demo_btn">View Demo
                    <img src="<?php echo esc_url(SPEL_IMG . '/dashboard-img/arrow.svg') ?>" alt=""></a>
            </div>
        </div>
        <div class="ezd-lg-col-6">
            <div class="spe_pr_promo_box ezd-text-center">
                <div class="spe_promo_video">
                    <img src="<?php echo esc_url(SPEL_IMG . '/dashboard-img/video2.jpg') ?>" alt="">
                    <a href="https://www.youtube.com/embed/njSyHmcEdkw" class="spe_popup_youtube"><i
                            class="icon-video-play"></i></a>
                </div>
                <h2>Protected Content</h2>
                <p>Restrict important data by setting up user permission or giving password to certain area.</p>
                <a href="#" class="spe_demo_btn">View Demo <img src="<?php echo esc_url(SPEL_IMG . '/dashboard-img/arrow.svg') ?>"
                        alt=""></a>
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
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon1.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon2.svg') ?>" alt=""></a>
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
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon1.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon2.svg') ?>" alt=""></a>
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
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon1.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon2.svg') ?>" alt=""></a>
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
                    <label for="spe-elementor-hotspot">Image Hotspot</label>
                </div>
                <div class="element_right">
                    <div class="link">
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon1.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon2.svg') ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="widget_checkbox" id="spe-elementor-hotspot">
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
                    <label for="spe-elementor-accordion">Accordion</label>
                </div>
                <div class="element_right">
                    <div class="link">
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon1.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon2.svg') ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="widget_checkbox" id="spe-elementor-accordion">
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
                    <label for="spe-elementor-accordion-article">Accordion Article</label>
                </div>
                <div class="element_right">
                    <div class="link">
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon1.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon2.svg') ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="widget_checkbox" id="spe-elementor-accordion-article">
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
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon1.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon2.svg') ?>" alt=""></a>
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
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon1.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon2.svg') ?>" alt=""></a>
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
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon1.svg') ?>" alt=""></a>
                        <a href="#"><img src="<?php echo esc_url(SPEL_IMG . '/icon2.svg') ?>" alt=""></a>
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
        <img src="<?php echo esc_url(SPEL_IMG . '/dashboard-img/qa.png') ?>"
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