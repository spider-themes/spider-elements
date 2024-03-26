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
                    'name'         => 'docy_accordion', // widget name
                    'className'    => 'Accordion', // widget class name
                    'label'        => esc_html__('Accordion', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-accordion',
                ],
                [
                    'name'         => 'docly_alerts_box',
                    'className'    => 'Alerts_Box', // widget class name
                    'label'        => esc_html__('Alerts Box', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-alert',
                ],
                [
                    'name'         => 'spe_animated_heading',
                    'className'    => 'Animated_Heading', // widget class name
                    'label'        => esc_html__('Animated Heading', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-heading',
                ],
                [
                    'name'         => 'spe_after_before_widget',
                    'className'    => 'Before_After', // widget class name
                    'label'        => esc_html__('Before After', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-thumbnails-half',
                ],
                [
                    'name'         => 'docy_blog_grid',
                    'className'    => 'Blog_Grid', // widget class name
                    'label'        => esc_html__('Blog Grid', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-post',
                ],
                [
                    'name'         => 'spe_buttons',
                    'className'    => 'Buttons', // widget class name
                    'label'        => esc_html__('Buttons', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-button',
                ],
                [
                    'name'         => 'docly_cheatsheet',
                    'className'    => 'Cheat_sheet', // widget class name
                    'label'        => esc_html__('Cheat Sheet', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-apps',
                ],
                [
                    'name'         => 'spe_counter',
                    'className'    => 'Counter', // widget class name
                    'label'        => esc_html__('Counter', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-counter',
                ],
                [
                    'name'         => 'spe_instagram',
                    'className'    => 'Instagram', // widget class name
                    'label'        => esc_html__('Instagram', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-instagram-post',
                ],
                [
                    'name'         => 'docy_integrations',
                    'className'    => 'Integrations', // widget class name
                    'label'        => esc_html__('Integrations', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-integration',
                ],
                [
                    'name'         => 'docly_list_item',
                    'className'    => 'List_Item', // widget class name
                    'label'        => esc_html__('List Items', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-bullet-list',
                ],
                [
                    'name'         => 'spe_marquee_slides',
                    'className'    => 'Marquee_Slides', // widget class name
                    'label'        => esc_html__('Marquee Slides', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-slider-push',
                ],
                [
                    'name'         => 'landpagy_pricing_table_switcher',
                    'className'    => 'Pricing_Table_Switcher', // widget class name
                    'label'        => esc_html__('Pricing Table Switcher', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-price-table',
                ],
                [
                    'name'         => 'landpagy_pricing_table_tabs',
                    'className'    => 'Pricing_Table_Tabs', // widget class name
                    'label'        => esc_html__('Pricing Table Tabs', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-price-table',
                ],
                [
                    'name'         => 'spe_skill_showcase_widget',
                    'className'    => 'Skill_Showcase', // widget class name
                    'label'        => esc_html__('Skill Showcase', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-woo-settings',
                ],
                [
                    'name'         => 'docy_tabs',
                    'className'    => 'Tabs',
                    'label'        => esc_html__('Tabs', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-tabs',
                ],
                [
                    'name'         => 'docy_team_carousel',
                    'className'    => 'Team_Carousel', // widget class name
                    'label'        => esc_html__('Team Carousel', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-nested-carousel',
                ],
                [
                    'name'         => 'docy_testimonial',
                    'className'    => 'Testimonial', // widget class name
                    'label'        => esc_html__('Testimonials', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-testimonial-carousel',
                ],
                [
                    'name'         => 'spe_timeline_widget',
                    'className'    => 'Timeline', // widget class name
                    'label'        => esc_html__('Timeline', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-time-line',
                ],
                [
                    'name'         => 'docy_videos_playlist',
                    'className'    => 'Video_Playlist', // widget class name
                    'label'        => esc_html__('Video Playlist', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-video-playlist',
                ],
                [
                    'name'         => 'docy_video_popup',
                    'className'    => 'Video_Popup', // widget class name
                    'label'        => esc_html__('Video Popup', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-play',
                ],


                /*[
                    'name'         => 'spe_animated_heading',
                    'className'    => 'Animated_Heading', // widget class name
                    'label'        => esc_html__('Animated Heading', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'pro',
                    'demo_url'     => '#',
                    'video_url'    => '#',
                    'icon'         => 'eicon-heading',
                ],*/

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
                /*[
                    'name'         => '', // widget name
                    'className'    => '', // widget class name
                    'label'        => esc_html__('Reveal Animation', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'pro',
                    'demo_url'     => '',
                    'video_url'    => '',
                    'icon'         => 'icon-revel-animation',
                ],*/
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
                /*[
                    'name'         => '', // widget name
                    'className'    => '', // widget class name
                    'label'        => esc_html__('Badge', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'pro',
                    'demo_url'     => '',
                    'video_url'    => '',
                    'icon'         => 'icon-badge',
                ],*/
                [
                    'name'         => 'spel_smooth_animation', // widget name
                    'className'    => '', // widget class name
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