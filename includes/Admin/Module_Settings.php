<?php

namespace Spider_Elements_Assets\includes\Admin;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Module_Settings {

	public static function get_widget_settings($callable) {

		$settings_fields = [
			'spider_elements_widgets' => [
				[
					'name'         => 'docy_accordion', // widget name
					'label'        => esc_html__('Accordion', 'spider-elements'), // widget label
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'free',
					'content_type' => 'custom',
					'demo_url'     => 'https://themeforest.net/author_dashboard',
					'video_url'    => 'https://www.youtube.com/watch?v=6wilewRV3xQ',
					'icon'         => 'eicon-accordion',
				],
				[
					'name'         => 'docly_alerts_box',
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
					'label'        => esc_html__('Animated Heading', 'spider-elements'),
					'type'         => 'checkbox',
					'default'      => 'on',
					'widget_type'  => 'pro',
					'content_type' => 'custom',
					'demo_url'     => '#',
					'video_url'    => '#',
				],
				[
					'name'         => 'spe_after_before_widget',
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

		$settings                    = [];
		$settings['settings_fields'] = $settings_fields;

		return $callable($settings);

	}

}