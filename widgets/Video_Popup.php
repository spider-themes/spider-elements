<?php
/**
 * Use namespace to avoid conflict
 */

namespace SPEL\Widgets;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Team
 * @package spider\Widgets
 * @since 1.0.0
 */
class Video_Popup extends Widget_Base {

	public function get_name() {
		return 'docy_video_popup'; // ID of the widget (Don't change this name)
	}

	public function get_title() {
		return esc_html__( 'Video Popup', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-play spel-icon';
	}

	public function get_keywords() {
		return [ 'spider', 'video', 'video-popup', ];
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'elegant-icon', 'fancybox', 'spel-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'spel-el-widgets', 'fancybox', 'slick' ];
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
	protected function register_controls() {
		$this->elementor_content_control();
		$this->video_style_control();
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

	public function elementor_content_control() {

		//==================== Select Preset Skin ====================//
		$this->start_controls_section(
			'video_popup_sec', [
				'label' => __( 'Preset Skin', 'spider-elements' ),
			]
		);

		$this->add_control(
			'style', [
				'label'   => esc_html__( 'Skin', 'spider-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'title' => esc_html__( 'Style 01', 'spider-elements' ),
						'icon'  => 'video-popup-1',
					],
					'2' => [
						'title' => esc_html__( 'Style 02', 'spider-elements' ),
						'icon'  => 'video-popup-2',
					],
				],
				'toggle'  => false,
				'default' => '1',
			]
		);

		$this->end_controls_section(); // End Preset Skin


		// ============================ Video Popup Content ===========================//
		$this->start_controls_section(
			'video_sec', [
				'label' => esc_html__( 'Video', 'spider-elements' ),
			]
		);

		$this->add_control(
			'video_url', [
				'label'       => esc_html__( 'Video URL', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => '#'
			]
		);

		$this->add_control(
			'video_icon', [
				'label'   => __( 'Icon', 'spider-elements' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-play',
					'library' => 'solid',
				],
			]
		);

		$this->end_controls_section(); // End Video Popup Content
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
	public function video_style_control() {

		//===================== Icon Style ============================//
		$this->start_controls_section(
			'style_icon', [
				'label'     => esc_html__( 'Icon', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => [ '1', '2' ]
				],
			]
		);


		$this->start_controls_tabs(
			'icon_style_tabs'
		);


		// Normal tabs
		$this->start_controls_tab(
			'icon_normal_tabs', [
				'label'     => __( 'Normal', 'spider-elements' ),
				'condition' => [
					'style' => [ '1', '2' ]
				],
			]
		);

		$this->add_control(
			'icon_font_color',
			[
				'label'     => __( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} .video2-icon' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => [ '1', '2' ]
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label'     => __( 'Background', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-icon' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .video2-icon' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'style' => [ '1', '2' ]
				],
			]
		);

		$this->end_controls_tab();

		// Hover tabs
		$this->start_controls_tab(
			'icon_hover_tabs', [
				'label'     => __( 'Hover', 'spider-elements' ),
				'condition' => [
					'style' => [ '1', '2' ]
				],
			]
		);

		$this->add_control(
			'icon_hover_font_color',
			[
				'label'     => __( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-icon:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} .video2-icon:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => [ '1', '2' ]
				],
			]
		);

		$this->add_control(
			'icon_hover_bg_color',
			[
				'label'     => __( 'Background', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-icon:hover' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .video2-icon:hover' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'style' => [ '1', '2' ]
				],
			]
		);

		$this->add_control(
			'icon_hover_border_color',
			[
				'label'     => __( 'Border Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-icon:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'style' => [ '1' ],
					'style!' => [ '2' ]
				]
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs(); // End Tabs

		$this->add_control(
			'icon_style_divider', [
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'icon_border',
				'label'    => __( 'Border', 'spider-elements' ),
				'selector' => '{{WRAPPER}} .video-icon',
				'condition' => [
					'style' => [ '1' ],
					'style!' => [ '2']
				]
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label'      => __( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .video-icon, .play-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'style' => [ '1' ],
					'style!' => [ '2']
				]
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'      => __( 'Size', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .video-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .video2-icon ' => 'font-size: {{SIZE}}{{UNIT}};',

				],
			]
		);

		$this->add_control(
			'popup_shadow',
			[
				'label'     => __( 'Popup Shadow', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video2-icon::after ' => 'background: {{VALUE}}',
				],
				'separator' => 'after',
				'condition' => [
					'style' => [ '2' ],
					'style!' => [ '1']
				]
			]
		);

		$this->add_responsive_control(
			'icon_bg_width', [
				'label'      => __( 'Video Popup Width', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => '90',
				],
                'selectors'  => [
                    '{{WRAPPER}} .video-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .video2-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .video2-icon::before' => 'width: calc({{SIZE}}{{UNIT}} + 30px); height: calc({{SIZE}}{{UNIT}} + 30px); top: -15px; left: -15px;',
                    '{{WRAPPER}} .video2-icon::after' => 'width: calc({{SIZE}}{{UNIT}} + 60px); height: calc({{SIZE}}{{UNIT}} + 60px); top: -30px; left: -30px;',
                ],
				'condition' => [
					'style' => [ '1', '2' ]
				],
			]
		);

		// Wave switcher
		$this->add_control(
			'enable_wave_regular', [
				'label'   => __( 'Enable Wave on Regular', 'spider-elements' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'style' => [ '1' ],
					'style!' => [ '2']
				]
			]
		);

		// Wave effect Hover switcher
		$this->add_control(
			'enable_wave_hover', [
				'label'   => __( 'Enable Wave on Hover', 'spider-elements' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'no',
				'condition' => [
					'style' => [ '1' ],
					'style!' => [ '2']
				]
			]
		);


		$this->end_controls_section();
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
	protected function render() {
		$settings = $this->get_settings_for_display();
		extract( $settings ); //extract all settings array to variables converted to name of a key

		//================= Template Parts =================//
		include "templates/video-popup/video-popup-{$settings['style']}.php";
	}
}
