<?php
/**
 * Use namespace to avoid conflict
 */
namespace SPEL\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Video_playlist
 *
 * @package spider\Widgets
 * @since   1.0.0
 */
class Video_Playlist extends Widget_Base {

	public function get_name(): string
    {
		return 'spel_videos_playlist'; // ID of the widget (Don't change this name)
	}

	public function get_title(): string
    {
		return esc_html__( 'SE Video Playlist', 'spider-elements' );
	}

	public function get_icon(): string
    {
		return 'eicon-video-playlist spel-icon';
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends(): array
    {
		return [ 'font-awesome', 'slick', 'slick-theme', 'elegant-icon', 'videojs', 'video-theaterMode', 'spel-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends(): array
    {
		return [ 'slick', 'video-js', 'artplayer', 'video-nuevo', 'spel-el-widgets' ];
	}

	public function get_keywords(): array
    {
		return [ 'spider', 'spider elements', 'video', 'playlist', 'Video playlist', 'Video list' ];
	}

	public function get_categories(): array
    {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: register_controls()
	 * Desc: Register controls for these widgets
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	protected function register_controls(): void
    {
		$this->elementor_content_control();
		$this->elementor_style_control();
	}

	/**
	 * Name: elementor_content_control()
	 * Desc: Register the Content Tab output on the Elementor editor.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	public function elementor_content_control(): void
    {


		//==================== Select Preset Skin ====================//
		$this->start_controls_section(
			'spe_video_preset', [
				'label' => esc_html__( 'Preset Skin', 'spider-elements' ),
			]
		);

		$this->add_control(
			'style', [
				'label'   => esc_html__( 'Skin', 'spider-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'title' => esc_html__( 'Tab', 'spider-elements' ),
						'icon'  => 'video_playlist_1',
					],
					'2' => [
						'title' => esc_html__( 'Slide', 'spider-elements' ),
						'icon'  => 'video_playlist_2',
					],
				],
				'toggle'  => false,
				'default' => '1',
			]
		);

		$this->end_controls_section(); // End Preset Skin


		//======================= Title Section =======================//
		$this->start_controls_section(
			'title_opt_sec', [
				'label'     => esc_html__( 'Title', 'spider-elements' ),
				'condition' => [
					'style' => [ '1' ]
				]
			]
		);

		$this->add_control(
			'playlist_title', [
				'label'     => esc_html__( 'Text', 'spider-elements' ),
				'type'      => Controls_Manager::TEXTAREA,
				'separator' => 'before'
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'playlist_title_typo',
				'selector' => '{{WRAPPER}} .play_list_title'
			]
		);

		$this->add_control(
			'playlist_title_color', [
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .play_list_title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_tag', [
				'label'     => esc_html__( 'Title Tag', 'spider-elements' ),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'default'   => 'h3',
				'options'   => spel_get_title_tags(),
			]
		);

		$this->end_controls_section(); // End Title Section


		//======================= Video Playlist Section =======================//
		$this->start_controls_section(
			'section_playlist', [
				'label' => esc_html__( 'Playlist', 'spider-elements' ),
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'title', [
				'label'       => esc_html__( 'Heading', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'dynamic'     => [
					'active' => true,
				],
				'placeholder' => esc_html__( 'Tab title text here', 'spider-elements' ),
				'label_block' => true,
			]
		);

		$repeater2 = new repeater();
		$repeater2->add_control(
			'title2', [
				'label'       => esc_html__( 'Title', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater2->add_control(
			'video_upload', [
				'label'      => esc_html__( 'Upload Video', 'spider-elements' ),
				'type'       => Controls_Manager::MEDIA,
				'media_type' => 'video',
			]
		);

		$repeater2->add_control(
			'thumbnail', [
				'label'   => esc_html__( 'Thumbnail', 'spider-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				]
			]
		);

		$repeater2->add_control(
			'video_caption', [
				'label'       => esc_html__( 'Description', 'spider-elements' ),
				'type'        => Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Type your caption here', 'spider-elements' ),
				'description' => esc_html__( '<strong>Note: </strong>This field is applicable for Preset Two', 'spider-elements' ),
			]
		);

		$repeater2->add_control(
			'current_author', [
				'label'   => esc_html__( 'Author', 'spider-elements' ),
				'type'    => Controls_Manager::HIDDEN,
				// current login user-name //
				'default' => get_current_user_id() ? get_userdata( get_current_user_id() )->display_name : ''
			]
		);

		// CURRENT DATE control
		$repeater2->add_control(
			'current_date', [
				'label'   => esc_html__( 'Current Date', 'spider-elements' ),
				'type'    => Controls_Manager::HIDDEN,
				// DEFAULT CURRENT DATE with time zone
				'default' => date( get_option( 'date_format' ) . get_option( 'time_format' ), current_time( 'timestamp', 0 ) )
			]
		);

		$repeater->add_control(
			'videos', [
				'label'              => esc_html__( 'Playlist Items', 'spider-elements' ),
				'type'               => Controls_Manager::REPEATER,
				'fields'             => $repeater2->get_controls(),
				'default'            => [
					[
						'title2' => esc_html__( 'Add Video', 'spider-elements' ),
					]
				],
				'frontend_available' => true,
				'title_field'        => '{{{ title2 }}}'
			]
		);

		$this->add_control(
			'tabs', [
				'label'              => esc_html__( 'Playlist Items', 'spider-elements' ),
				'type'               => Controls_Manager::REPEATER,
				'fields'             => $repeater->get_controls(),
				'default'            => [
					[
						'title' => esc_html__( 'Insert Video', 'spider-elements' ),
					]
				],
				'frontend_available' => true,
				'title_field'        => '{{{ title }}}',
				'prevent_empty'      => true,
//				'condition' => [
//					'style' => [ '1' ]
//				]
			]
		);

		$this->end_controls_section(); // end of playlist section

	}


	/**
	 * Name: elementor_style_control()
	 * Desc: Register the Style Tab output on the Elementor editor.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	public function elementor_style_control() {

		// Style Section
		$this->start_controls_section(
			'style_sec',
			[
				'label' => esc_html__( 'Playlist Section', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .video_list_area,
							   {{WRAPPER}} .video_slider_area',
			]
		);

		$this->add_responsive_control(
			'sec_padding', [
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .video_list_area'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .video_slider_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'    => [
					'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
				],
			]
		);

		$this->add_control(
			'laaout_headin',
			[
				'label'     => esc_html__( 'Layout', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => [ '1' ]
				]
			]
		);

		$this->add_responsive_control(
			'layout_height',
			[
				'label'      => esc_html__( 'Height', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vh', 'vw' ],
				'range'      => [
					'px' => [
						'min' => 200,
						'max' => 1200,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .spel_video_list' => 'height: {{SIZE}}{{UNIT}};',
				],
				'condition'  => [
					'style' => [ '1' ]
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_top_bar',
			[
				'label'     => esc_html__( 'Video List', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => [ '1' ]
				]
			]
		);

		$this->add_control(
			'heading_playlist_name',
			[
				'label' => esc_html__( 'Title', 'spider-elements' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'playlist_name_typography',
				'selector' => '{{WRAPPER}} .list_title',
			]
		);

		$this->start_controls_tabs(
			'video_list_tabs'
		);

		$this->start_controls_tab(
			'list_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'spider-elements' ),
			]
		);

		$this->add_control(
			'playlist_name_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .list_title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'playlist_name_bg',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .video_list .video_list_inner .accordion .accordion-panel',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'list_hover_tab',
			[
				'label' => esc_html__( 'Active', 'spider-elements' ),
			]
		);

		$this->add_control(
			'active_name_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .video_list .video_list_inner .accordion .spe-collapsed .spe-accordion .card-header .list_title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'active_count_color',
			[
				'label'     => esc_html__( 'Count Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .video_list .video_list_inner .accordion .spe-collapsed .spe-accordion .card-header button .list_count' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'activer_icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video_list .video_list_inner .accordion .spe-collapsed .spe-accordion .card-header button .plus-minus svg path' => 'stroke: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'active_name_bg',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .video_list .video_list_inner .accordion .spe-collapsed',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'playlist_name_padding',
			[
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator'  => 'before',
				'selectors'  => [
					'{{WRAPPER}} .video_list .video_list_inner .accordion .accordion-panel .spe-accordion .card-header button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_videos_amount',
			[
				'label'     => esc_html__( 'Video Count', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'videos_amount_typography',
				'selector' => '{{WRAPPER}} .video_list .video_list_inner .accordion .accordion-panel .spe-accordion .card-header button .list_count',
			]
		);

		$this->add_control(
			'count_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .list_count' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'icon_heading',
			[
				'label'     => esc_html__( 'Icon', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'playlist_icon_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video_list .video_list_inner .accordion .accordion-panel .spe-accordion .card-header button .plus-minus #plus path' => 'stroke: {{VALUE}} !important',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => esc_html__( 'Size', 'spider-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'min' => 6,
					'max' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .video_list .video_list_inner .accordion .accordion-panel .spe-accordion .card-header button .plus-minus #plus' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}} !important',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_videos',
			[
				'label'     => esc_html__( 'Videos', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => [ '1' ]
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'playlist_content_bg',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .video_list .video_list_inner .accordion .accordion-content .card-body',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'separator'  => 'after',
				'selectors'  => [
					'{{WRAPPER}} .video_list .video_list_inner .accordion .accordion-content .card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_tab_normal',
			[
				'label'     => esc_html__( 'Title', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'normal_typography',
				'selector' => '{{WRAPPER}} .video_list .video_list_inner .card .card-body .nav li a .media .media-body  .body_title',
			]
		);

		$this->add_control(
			'normal_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'after',
				'selectors' => [
					'{{WRAPPER}} .video_list .video_list_inner .card .card-body .nav li a .media .media-body .body_title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .e-tab-title .e-tab-title-text a'                                                        => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'heading_duration_normal',
			[
				'label'     => esc_html__( 'Meta', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'normal_duration_typography',
				'selector' => '{{WRAPPER}} .video_list .video_list_inner .card .card-body .nav li a .media .media-body .list .videos_meta',
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .videos_meta' => 'color: {{VALUE}} !important;',
				],
			]
		);


		$this->end_controls_section();

		// Style 2 controls
		$this->start_controls_section(
			'style2_videos_slider',
			[
				'label'     => esc_html__( 'Video', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => [ '2' ]
				]
			]
		);

		$this->add_control(
			'slider_heading',
			[
				'label' => esc_html__( 'Title', 'spider-elements' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .slide_text a .video_title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slide_text a .video_title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => esc_html__( 'Hover Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slide_text a .video_title:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'description_heading',
			[
				'label'     => esc_html__( 'Description', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'selector' => '{{WRAPPER}} .slide_text p',
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slide_text p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'desc_margin',
			[
				'label'      => esc_html__( 'Margin', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .slide_text p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'meta_heading',
			[
				'label'     => esc_html__( 'Meta', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'selector' => '{{WRAPPER}} .slide_text .video_user a',
			]
		);

		$this->add_control(
			'meta2_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slide_text .video_user a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'meta_hover_color',
			[
				'label'     => esc_html__( 'Hover Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slide_text .video_user a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style2_slider',
			[
				'label'     => esc_html__( 'Slider', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => [ '2' ]
				]
			]
		);

		$this->add_control(
			'slider2_heading',
			[
				'label' => esc_html__( 'Thumbnail Title', 'spider-elements' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'thumbnail_title_typography',
				'selector' => '{{WRAPPER}} .gallery_main_area .gallery-thumbs .item .caption_text .thumbnail_title',
			]
		);

		$this->add_control(
			'thumbnail_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gallery_main_area .gallery-thumbs .item .caption_text .thumbnail_title' => 'color: {{VALUE}};',
				],
			]
		);

	}


	/**
	 * Name: elementor_render()
	 * Desc: Render the widget output on the frontend.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	protected function render(): void
    {

        $settings = $this->get_settings();
		extract( $settings ); //extract all settings array to variables converted to name of a key

		// Render the widget output on the frontend.
		include "templates/video-playlist/video-playlist-{$settings['style']}.php";

	}
}
