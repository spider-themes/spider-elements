<?php
/**
 * Use namespace to avoid conflict
 */

namespace Spider_Elements\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Team
 * @package spider\Widgets
 * @since 1.0.0
 */
class Counter extends Widget_Base {

	public function get_name() {
		return 'spe_counter'; // ID of the widget (Don't change this name)
	}

	public function get_title() {
		return esc_html__( 'Counter', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-counter spe-icon';
	}

	public function get_keywords() {
		return [ 'spider', 'Counter', 'Progress bar', ];
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'spe-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'spe-el-widgets', 'counter','waypoint' ];
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
		$this->counter_style_control();
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
			'counter_preset', [
				'label' => __( 'Preset Skin', 'spider-elements' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Counter Style', 'spider-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'icon'  => 'counter1',
						'title' => esc_html__( '01 : Counter', 'spider-elements' )
					],
					'2' => [
						'icon'  => 'counter2',
						'title' => esc_html__( '02 : Counter', 'spider-elements' )
					],
				],
				'default' => '1',
			]
		);

		$this->end_controls_section(); // End Preset Skin

		//=================== SecCountertion  ===================//
		$this->start_controls_section(
			'sec_counter', [
				'label' => esc_html__( 'Counter', 'spider-elements' ),
			]
		);

		$this->add_control(
			'counter_value', [
				'label'   => esc_html__( 'Value', 'spider-elements' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 85,
				'min'     => 0,
				'max'     => 100,
			]
		);

		// Control for Counter Text
		$this->add_control(
			'counter_text', [
				'label'   => esc_html__( 'Title', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'User research', 'spider-elements' ),
			]
		);


		$this->end_controls_section();

	}


	/**
	 * Name: counter_style_control()
	 * Desc: Register the Style Tab output on the Elementor editor.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	public function counter_style_control() {

		//===================== Counter Content Style ============================//
		$this->start_controls_section(
			'style_counter', [
				'label' => esc_html__( 'Counter', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'style_bg',
			[
				'label'     => esc_html__( 'Background Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skill_item_two .radial-progress' => 'background: {{VALUE}};',
				],
				'condition' => [
					'style' => [ '2' ]
				]
			]
		);
		$this->add_control(
			'style_radius',
			[
				'label'      => __( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .skill_item_two .radial-progress' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'style' => [ '2' ]
				]
			]
		);

		$this->add_responsive_control(
			'counter_circle_size',
			[
				'label'      => __( 'Size', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 50,
						'max'  => 500,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 100,
				],
				'selectors'  => [
					'{{WRAPPER}} .skill_item  svg.radial-progress' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
				],
				'separator'  => 'after',
			]
		);

		$this->add_control(
			'fill_color',
			[
				'label'     => esc_html__( 'Fill Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#5d5b62',
				'selectors' => [
					'{{WRAPPER}} svg.radial-progress circle.incomplete' => 'stroke: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'stroke_color',
			[
				'label'     => esc_html__( 'Stroke Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ef4953',
				'selectors' => [
					'{{WRAPPER}} .radial-progress .complete' => 'stroke: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'counter_circle_stroke_width',
			[
				'label'      => __( 'Stroke Width', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 6,
				],
				'selectors'  => [
					'{{WRAPPER}} svg.radial-progress circle' => 'stroke-width: {{SIZE}}{{UNIT}}',
				],
				'separator'  => 'before',
			]
		);

		$this->end_controls_section();


		// Control for percent color
		$this->start_controls_section(
			'percent', [
				'label' => esc_html__( 'Percent', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'percent_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} svg.radial-progress text' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'percent_typo',
				'selector' => '{{WRAPPER}} svg.radial-progress text'
			]
		);

		$this->end_controls_section();

		// Control for text color
		$this->start_controls_section(
			'counter_title', [
				'label' => esc_html__( 'Title', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'counter_text_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skill_item h6' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'counter_text_typo',
				'selector' => '{{WRAPPER}} .skill_item h6'
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
		extract( $settings ); //extract all settings array to variables converted to name of key

		//================= Template Parts =================//
		include "templates/counter/counter-{$settings['style']}.php";
	}
}