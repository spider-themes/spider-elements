<?php
namespace SPEL\includes\Admin;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Module_Settings {

    public static function get_widget_settings(): array
    {

        return [

            // All Widget List
            'spider_elements_widgets' => [
                [
                    'name'         => 'spel_accordion', // widget name
                    'className'    => 'Accordion', // widget class name
                    'label'        => esc_html__('Accordion', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/accordion/',
                    'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/content-elements/accordion/',
                    'icon'         => 'eicon-accordion',
                ],
                [
                    'name'         => 'spel_dynamic_faq',
                    'className'    => 'Dynamic_Faq',
                    'label'        => esc_html__('Dynamic FAQ', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => '#',
                    'docs_url'     => '#',
                    'icon'         => 'eicon-help',
                ],
                [
                    'name'         => 'docy_testimonial',
                    'className'    => 'Testimonial', // widget class name
                    'label'        => esc_html__('Testimonials', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/testimonials/',
                    'icon'         => 'eicon-testimonial-carousel',
                ],
                [
                    'name'         => 'docly_list_item',
                    'className'    => 'List_Item', // widget class name
                    'label'        => esc_html__('List Items', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/list-item/',
                    'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/content-elements/list-item/',
                    'icon'         => 'eicon-bullet-list',
                ],
                [
                    'name'         => 'docy_team_carousel',
                    'className'    => 'Team_Carousel', // widget class name
                    'label'        => esc_html__('Team Carousel', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/team-carousel/',
                    'icon'         => 'eicon-nested-carousel',
                ],
                [
                    'name'         => 'docy_integrations',
                    'className'    => 'Integrations', // widget class name
                    'label'        => esc_html__('Integrations', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/integration/',
                    'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/content-elements/integration/',
                    'icon'         => 'eicon-integration',
                ],
                [
                    'name'         => 'docy_video_popup',
                    'className'    => 'Video_Popup', // widget class name
                    'label'        => esc_html__('Video Popup', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/video-popup/',
                    'icon'         => 'eicon-play',
                ],
                [
                    'name'         => 'docy_blog_grid',
                    'className'    => 'Blog_Grid', // widget class name
                    'label'        => esc_html__('Blog Grid', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/blog-grid/',
                    'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/content-elements/blog-grid/',
                    'icon'         => 'eicon-post',
                ],
                [
                    'name'         => 'spe_timeline_widget',
                    'className'    => 'Timeline', // widget class name
                    'label'        => esc_html__('Timeline', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/timeline/',
                    'icon'         => 'eicon-time-line',
                ],
                [
                    'name'         => 'spe_counter',
                    'className'    => 'Counter', // widget class name
                    'label'        => esc_html__('Counter', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/counter/',
                    'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/content-elements/counter/',
                    'icon'         => 'eicon-counter',
                ],
                [
                    'name'         => 'spel_icon_box',
                    'className'    => 'Icon_box', // widget class name
                    'label'        => esc_html__('Icon Box', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'on',
                    'widget_type'  => 'free',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/icon-box/',
                    'icon'         => 'eicon-icon-box',
                ],

                //All Pro Widget Listed
	            [
		            'name'         => 'docly_cheatsheet',
		            'className'    => 'Cheat_sheet', // widget class name
		            'label'        => esc_html__('Cheat Sheet', 'spider-elements'),
		            'type'         => 'checkbox',
		            'default'      => 'off',
		            'widget_type'  => 'pro',
		            'demo_url'     => 'https://spider-elements.spiderthemes.net/cheatsheet/',
		            'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/content-elements/cheatsheet/',
		            'icon'         => 'eicon-apps',
	            ],
	            [
		            'name'         => 'spel_videos_playlist',
		            'className'    => 'Video_Playlist', // widget class name
		            'label'        => esc_html__('Video Playlist', 'spider-elements'),
		            'type'         => 'checkbox',
		            'default'      => 'off',
		            'widget_type'  => 'pro',
		            'demo_url'     => 'https://spider-elements.spiderthemes.net/video-playlist/',
		            'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/content-elements/video-playlist/',
		            'icon'         => 'eicon-video-playlist',
	            ],
	            [
		            'name'         => 'docy_tabs',
		            'className'    => 'Tabs',
		            'label'        => esc_html__('Tabs', 'spider-elements'),
		            'type'         => 'checkbox',
		            'default'      => 'off',
		            'widget_type'  => 'pro',
		            'demo_url'     => 'https://spider-elements.spiderthemes.net/tabs/',
		            'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/content-elements/tabs/',
		            'icon'         => 'eicon-tabs',
	            ],
	            [
		            'name'         => 'docly_alerts_box',
		            'className'    => 'Alerts_Box', // widget class name
		            'label'        => esc_html__('Alerts Box', 'spider-elements'),
		            'type'         => 'checkbox',
		            'default'      => 'off',
		            'widget_type'  => 'pro',
		            'demo_url'     => 'https://spider-elements.spiderthemes.net/notice-message/',
		            'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/content-elements/notice-message/',
		            'icon'         => 'eicon-alert',
	            ],
                [
                    'name'         => 'spel_accordion_article',
                    'className'    => 'Accordion_Article', // widget class name
                    'label'        => esc_html__('Accordion Articles', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/accordion-articles/',
                    'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/pro-elements/accordion-articles/',
                    'icon'         => 'eicon-accordion',
                ],
                [
                    'name'         => 'docy_box_hover',
                    'className'    => 'Box_Hover', // widget class name
                    'label'        => esc_html__('Box Hover', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/box-hover/',
                    'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/pro-elements/box-hover/',
                    'icon'         => 'eicon-image-box',
                ],
                [
                    'name'         => 'spe_feature_box',
                    'className'    => 'Feature_Box', // widget class name
                    'label'        => esc_html__('Feature Box', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/feature-box/',
                    'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/pro-elements/feature-box/',
                    'icon'         => 'eicon-info-box',
                ],
                [
                    'name'         => 'docy_flip_box',
                    'className'    => 'Flip_Box', // widget class name
                    'label'        => esc_html__('Flip Box', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/flipbox/',
                    'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/pro-elements/flip-box/',
                    'icon'         => 'eicon-flip-box',
                ],
                [
                    'name'         => 'docly_hotspot',
                    'className'    => 'Hotspot', // widget class name
                    'label'        => esc_html__('Hotspot', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/hotspot/',
                    'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/pro-elements/hotspot/',
                    'icon'         => 'eicon-image-hotspot',
                ],
                [
                    'name'         => 'docy_image_hover',
                    'className'    => 'Image_hover', // widget class name
                    'label'        => esc_html__('Image Hover', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/image-hover/',
                    'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/pro-elements/image-hover/',
                    'icon'         => 'eicon-image-rollover',
                ],
                [
                    'name'         => 'docy_image_slides',
                    'className'    => 'Image_Slides', // widget class name
                    'label'        => esc_html__('Image Slides', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/image-slider/',
                    'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/pro-elements/image-slides/',
                    'icon'         => 'eicon-slides',
                ],
                [
                    'name'         => 'spel_marquee_slider',
                    'className'    => 'Marquee_Slider', // widget class name
                    'label'        => esc_html__('Marquee Slides', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/marquee-slider/',
                    'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/pro-elements/marquee-slides/',
                    'icon'         => 'eicon-slider-push',
                ],
                [
                    'name'         => 'spe_skill_showcase_widget',
                    'className'    => 'Skill_Showcase', // widget class name
                    'label'        => esc_html__('Skill Showcase', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/skill-showcase/',
                    'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/content-elements/skill-showcase/',
                    'icon'         => 'eicon-slideshow',
                ],
                [
                    'name'         => 'spel_stacked_image',
                    'className'    => 'Stacked_Image', // widget class name
                    'label'        => esc_html__('Stacked Image', 'spider-elements'),
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'widget_type'  => 'pro',
                    'demo_url'     => 'https://spider-elements.spiderthemes.net/stack-image/',
                    'docs_url'     => 'https://helpdesk.spiderthemes.net/docs/spider-elements/pro-elements/stack-image/',
                    'icon'         => 'eicon-featured-image',
                ],
            ],

            // All Feature List
            'spider_elements_features' => [
                [
                    'name'         => 'spel_feature_box', // widget name
                    'label'        => esc_html__('Feature Box', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'feature_type' => 'pro',
                    'demo_url'     => '',
                    'icon'         => 'eicon-info-box',
                ],
                [
                    'name'         => 'spel_reveal_animation', // widget name
                    'label'        => esc_html__('Reveal Animation', 'spider-elements'), // widget label
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'feature_type' => 'pro',
                    'demo_url'     => '',
                    'icon'         => 'icon-revel-animation',
                ],
                [
                    'name'         => 'spel_badge', // feature name
                    'label'        => esc_html__('Feature Badge', 'spider-elements'), // feature label
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'feature_type' => 'pro',
                    'demo_url'     => '',
                    'icon'         => 'icon-badge',
                ],
                [
                    'name'         => 'spel_heading_highlighted', // feature name
                    'label'        => esc_html__('Heading Highlighted', 'spider-elements'), // feature label
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'feature_type' => 'pro',
                    'demo_url'     => '',
                    'icon'         => 'eicon-t-letter',
                ],
                [
                    'name'         => 'spel_smooth_animation', // feature name
                    'label'        => esc_html__('Smooth Animation', 'spider-elements'), // feature label
                    'type'         => 'checkbox',
                    'default'      => 'off',
                    'feature_type' => 'pro',
                    'demo_url'     => '',
                    'icon'         => 'icon-smooth-animation',
                ]
            ]
        ];
    }
}