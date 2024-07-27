<?php
namespace SPEL\includes\Admin;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Module_Settings {

    public static function get_widget_settings() {

        $settings_fields = [

            // All Widget List
            'spider_elements_widgets' => [
                [
                    'name'         => 'docy_tabs',
                    'className'    => 'Tabs',
                    'label'        => esc_html__('Tabs', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/tabs/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-tabs',
                ],
                [
                    'name'         => 'docy_videos_playlist',
                    'className'    => 'Video_Playlist', // widget class name
                    'label'        => esc_html__('Video Playlist', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/video-playlist/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-video-playlist',
                ],
                [
                    'name'         => 'docly_alerts_box',
                    'className'    => 'Alerts_Box', // widget class name
                    'label'        => esc_html__('Alerts Box', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/notice-message/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-alert',
                ],
                [
                    'name'         => 'spel_accordion', // widget name
                    'className'    => 'Accordion', // widget class name
                    'label'        => esc_html__('Accordion', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/accordion/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-accordion',
                ],
                [
                    'name'         => 'docy_testimonial',
                    'className'    => 'Testimonial', // widget class name
                    'label'        => esc_html__('Testimonials', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/testimonials/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-testimonial-carousel',
                ],
                // [
                //     'name'         => 'landpagy_pricing_table_tabs',
                //     'className'    => 'Pricing_Table_Tabs', // widget class name
                //     'label'        => esc_html__('Pricing Table Tabs', 'spider-elements'),
                //     'type'         => 'checkbox',
                //     'default'      => 'on',
                //     'widget_type'  => 'free',
                //     'demo_url'     => '#',
                //     'video_url'    => '#',
                //     'icon'         => 'eicon-price-table',
                // ],
                // [
                //     'name'         => 'landpagy_pricing_table_switcher',
                //     'className'    => 'Pricing_Table_Switcher', // widget class name
                //     'label'        => esc_html__('Pricing Table Switcher', 'spider-elements'),
                //     'type'         => 'checkbox',
                //     'default'      => 'on',
                //     'widget_type'  => 'free',
                //     'demo_url'     => '#',
                //     'video_url'    => '#',
                //     'icon'         => 'eicon-price-table',
                // ],
                [
                    'name'         => 'docly_list_item',
                    'className'    => 'List_Item', // widget class name
                    'label'        => esc_html__('List Items', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/list-item/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-bullet-list',
                ],
                [
                    'name'         => 'docly_cheatsheet',
                    'className'    => 'Cheat_sheet', // widget class name
                    'label'        => esc_html__('Cheat Sheet', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/cheatsheet/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-apps',
                ],
                [
                    'name'         => 'docy_team_carousel',
                    'className'    => 'Team_Carousel', // widget class name
                    'label'        => esc_html__('Team Carousel', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/team-carousel/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-nested-carousel',
                ],
                [
                    'name'         => 'docy_integrations',
                    'className'    => 'Integrations', // widget class name
                    'label'        => esc_html__('Integrations', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/integration/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-integration',
                ],
                [
                    'name'         => 'spe_after_before_widget',
                    'className'    => 'Before_After', // widget class name
                    'label'        => esc_html__('Before After', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/before-after/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-thumbnails-half',
                ],
                [
                    'name'         => 'docy_video_popup',
                    'className'    => 'Video_Popup', // widget class name
                    'label'        => esc_html__('Video Popup', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/video-popup/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-play',
                ],
                [
                    'name'         => 'docy_blog_grid',
                    'className'    => 'Blog_Grid', // widget class name
                    'label'        => esc_html__('Blog Grid', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/blog-grid/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-post',
                ],
                [
                    'name'         => 'spe_timeline_widget',
                    'className'    => 'Timeline', // widget class name
                    'label'        => esc_html__('Timeline', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/timeline/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-time-line',
                ],
                // [
                //     'name'         => 'spe_buttons',
                //     'className'    => 'Buttons', // widget class name
                //     'label'        => esc_html__('Buttons', 'spider-elements'),
                //     'type'         => 'checkbox',
                //     'default'      => 'on',
                //     'widget_type'  => 'free',
                //     'demo_url'     => '#',
                //     'video_url'    => '#',
                //     'icon'         => 'eicon-button',
                // ],
                // [
                //     'name'         => 'spe_animated_heading',
                //     'className'    => 'Animated_Heading', // widget class name
                //     'label'        => esc_html__('Animated Heading', 'spider-elements'),
                //     'type'         => 'checkbox',
                //     'default'      => 'on',
                //     'widget_type'  => 'free',
                //     'demo_url'     => '#',
                //     'video_url'    => '#',
                //     'icon'         => 'eicon-heading',
                // ],
                [
                    'name'         => 'spe_counter',
                    'className'    => 'Counter', // widget class name
                    'label'        => esc_html__('Counter', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/counter/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-counter',
                ],
                // [
                //     'name'         => 'spe_instagram',
                //     'className'    => 'Instagram', // widget class name
                //     'label'        => esc_html__('Instagram', 'spider-elements'),
                //     'type'         => 'checkbox',
                //     'default'      => 'on',
                //     'widget_type'  => 'free',
                //     'demo_url'     => '#',
                //     'video_url'    => '#',
                //     'icon'         => 'eicon-instagram-post',
                // ],
                [
                    'name'         => 'spel_icon_box',
                    'className'    => 'Icon_box', // widget class name
                    'label'        => esc_html__('Icon Box', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/icon-box/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-icon-box',
                ],


                //All Pro Widget Listed
                [
                    'name'         => 'spel_accordion_article',
                    'className'    => 'Accordion_Article', // widget class name
                    'label'        => esc_html__('Accordion Articles', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/accordion-articles/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-accordion',
                ],
                [
                    'name'         => 'docy_box_hover',
                    'className'    => 'Box_Hover', // widget class name
                    'label'        => esc_html__('Box Hover', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/box-hover/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-image-box',
                ],
                // [
                //     'name'         => 'spel_business_hours',
                //     'className'    => 'Business_Hours', // widget class name
                //     'label'        => esc_html__('Business Hours', 'spider-elements'),
                //     'type'         => 'checkbox',
                //     'default'      => 'off',
                //     'widget_type'  => 'pro',
                //     'demo_url'     => '#',
                //     'video_url'    => '#',
                //     'icon'         => 'eicon-clock-o',
                // ],
                [
                    'name'         => 'spe_feature_box',
                    'className'    => 'Feature_Box', // widget class name
                    'label'        => esc_html__('Feature Box', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/feature-box/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-info-box',
                ],
                [
                    'name'         => 'docy_flip_box',
                    'className'    => 'Flip_Box', // widget class name
                    'label'        => esc_html__('Flip Box', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/flipbox/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-flip-box',
                ],
                [
                    'name'         => 'docly_hotspot',
                    'className'    => 'Hotspot', // widget class name
                    'label'        => esc_html__('Hotspot', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/hotspot/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-image-hotspot',
                ],
                [
                    'name'         => 'docy_image_hover',
                    'className'    => 'Image_hover', // widget class name
                    'label'        => esc_html__('Image Hover', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/image-hover/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-image-rollover',
                ],
                [
                    'name'         => 'docy_image_slides',
                    'className'    => 'Image_Slides', // widget class name
                    'label'        => esc_html__('Image Slides', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/image-slider/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-slides',
                ],
                [
                    'name'         => 'spel_marquee_slider',
                    'className'    => 'Marquee_Slider', // widget class name
                    'label'        => esc_html__('Marquee Slides', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/marquee-slider/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-slider-push',
                ],
                [
                    'name'         => 'spe_skill_showcase_widget',
                    'className'    => 'Skill_Showcase', // widget class name
                    'label'        => esc_html__('Skill Showcase', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/skill-showcase/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-slideshow',
                ],
                [
                    'name'         => 'spel_stacked_image',
                    'className'    => 'Stacked_Image', // widget class name
                    'label'        => esc_html__('Stacked Image', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-themes.net/spider-elements/stack-image/',
                    'video_url'    => '#',
                    'icon'         => 'eicon-featured-image',
                ],


            ],

            // All Feature List
            'spider_elements_features' => [
                /*[
                    'name'         => '', // widget name
                    'className'    => '', // widget class name
                    'label'        => esc_html__('Template cloud', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'pro',
                    'demo_url'     => '',
                    'video_url'    => '',
                    'icon'         => 'icon-cloud',
                ],*/
                /*[
                    'name'         => '', // widget name
                    'className'    => '', // widget class name
                    'label'        => esc_html__('Mega Menu', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'pro',
                    'demo_url'     => '',
                    'video_url'    => '',
                    'icon'         => 'icon-mega-menu',
                ],*/
                /*[
                    'name'         => '', // widget name
                    'className'    => '', // widget class name
                    'label'        => esc_html__('Image Shadow', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'pro',
                    'demo_url'     => '',
                    'video_url'    => '',
                    'icon'         => 'icon-image-shadow',
                ],*/
                /*[
                    'name'         => '', // widget name
                    'className'    => '', // widget class name
                    'label'        => esc_html__('Scroll Trigger', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'pro',
                    'demo_url'     => '',
                    'video_url'    => '',
                    'icon'         => 'icon-hotspot',
                ],*/
                /*[
                    'name'         => '', // widget name
                    'className'    => '', // widget class name
                    'label'        => esc_html__('Tilt Effect on Hover', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'pro',
                    'demo_url'     => '',
                    'video_url'    => '',
                    'icon'         => 'icon-effect',
                ],*/
                [
                    'name'         => 'spel_reveal_animation', // widget name
                    'className'    => '', // widget class name
                    'label'        => esc_html__('Reveal Animation', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '',
                    'video_url'    => '',
                    'icon'         => 'icon-revel-animation',
                ],
                /*[
                    'name'         => '', // widget name
                    'className'    => '', // widget class name
                    'label'        => esc_html__('Tooltip / Element', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'pro',
                    'demo_url'     => '',
                    'video_url'    => '',
                    'icon'         => 'icon-tooltip',
                ],*/
                [
                    'name'         => 'spel_badge', // widget name
                    'label'        => esc_html__('Badge', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '',
                    'video_url'    => '',
                    'icon'         => 'icon-badge',
                ],
                [
                    'name'         => 'spel_smooth_animation', // widget name
                    'label'        => esc_html__('Smooth Animation', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '',
                    'video_url'    => '',
                    'icon'         => 'icon-smooth-animation',
                ],
                /*[
                    'name'         => '', // widget name
                    'className'    => '', // widget class name
                    'label'        => esc_html__('Gradient Color from Image', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'pro',
                    'demo_url'     => '',
                    'video_url'    => '',
                    'icon'         => 'icon-gallery',
                ],*/
            ]
        ];

        return $settings_fields;

    }

}