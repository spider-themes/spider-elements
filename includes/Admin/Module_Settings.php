<?php

namespace Spider_Elements_Assets\includes\Admin;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Module_Settings {

	public static function get_widget_settings() {

		$settings_fields = [
			'spider_elements_widgets' => [
				[
					'name'         => 'docy_accordion', // widget name
					'className'    => 'Accordion', // widget class name
					'label'        => esc_html__('Accordion dfd', 'spider-elements'), // widget label
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '',
					'video_url'    => '',
					'icon'         => 'eicon-accordion',
				],
				[
					'name'         => 'docly_alerts_box',
					'className'    => '', // widget class name
					'label'        => esc_html__('Alerts Box', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
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
					'widget_type'  => 'pro',
					'is_pro'       => true,
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'spe_after_before_widget',
					'className'    => 'Before_After', // widget class name
					'label'        => esc_html__('Before After', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'docy_blog_grid',
					'className'    => 'Blog_Grid', // widget class name
					'label'        => esc_html__('Blog Grid', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'spe_buttons',
					'className'    => '', // widget class name
					'label'        => esc_html__('Buttons', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'docly_cheatsheet',
					'className'    => 'Buttons', // widget class name
					'label'        => esc_html__('Cheat Sheet', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'spe_counter',
					'className'    => 'Counter', // widget class name
					'label'        => esc_html__('Counter', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'spe_instagram',
					'className'    => 'Instagram', // widget class name
					'label'        => esc_html__('Instagram', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'docy_integrations',
					'className'    => 'Integrations', // widget class name
					'label'        => esc_html__('Integrations', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'docly_list_item',
					'className'    => 'List_Item', // widget class name
					'label'        => esc_html__('List Items', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'spe_marquee_slides',
					'className'    => 'Marquee_Slides', // widget class name
					'label'        => esc_html__('Marquee Slides', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'landpagy_pricing_table_switcher',
					'className'    => 'Pricing_Table_Switcher', // widget class name
					'label'        => esc_html__('Pricing Table Switcher', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'landpagy_pricing_table_tabs',
					'className'    => 'Pricing_Table_Tabs', // widget class name
					'label'        => esc_html__('Pricing Table Tabs', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'spe_skill_showcase_widget',
					'className'    => 'Skill_Showcase', // widget class name
					'label'        => esc_html__('Skill Showcase', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'docy_tabs',
					'className'    => 'Tabs',
					'label'        => esc_html__('Tabs', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'docy_team_carousel',
					'className'    => 'Team_Carousel', // widget class name
					'label'        => esc_html__('Team Carousel', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'docy_testimonial',
					'className'    => 'Testimonial', // widget class name
					'label'        => esc_html__('Testimonials', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'spe_timeline_widget',
					'className'    => 'Timeline', // widget class name
					'label'        => esc_html__('Timeline', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'docy_videos_playlist',
					'className'    => 'Video_Playlist', // widget class name
					'label'        => esc_html__('Video Playlist', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'docy_video_popup',
					'className'    => 'Video_Popup', // widget class name
					'label'        => esc_html__('Video Popup', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
			],

		];

		return $settings_fields['spider_elements_widgets'];

	}

}