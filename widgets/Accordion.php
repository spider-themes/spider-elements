<?php
/**
 * Use namespace to avoid conflict
 */

namespace Spider_Elements_Assets\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Accordion
 * @package spider\Widgets
 */
class Accordion extends Widget_Base {

	public function get_name() {
		return 'docy_accordion';
	}

	public function get_title() {
		return esc_html__( 'Accordion', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-accordion se-icon';
	}

	public function get_keywords() {
		return [ 'spider', 'spider elements', 'toggle', 'accordion', 'collapse', 'faq', 'tabs', 'tab', ];
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'bootstrap', 'spe-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'bootstrap' ];
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
	public function elementor_content_control() {


		//=================== Section Accordion ===================//
		$this->start_controls_section(
			'sec_accordion', [
				'label' => esc_html__( 'Accordion', 'spider-elements' ),
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'collapse_state', [
				'label'        => esc_html__( 'Expanded', 'spider-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'spider-elements' ),
				'label_off'    => esc_html__( 'No', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'after',
			]
		);

		$repeater->add_control(
			'title', [
				'label'       => __( 'Title', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Accordion Title', 'spider-elements' ),
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'content_type', [
				'label'   => esc_html__( 'Content Type', 'spider-elements' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'content'     => esc_html__( 'Contents', 'spider-elements' ),
					'el_template' => esc_html__( 'Saved Template', 'spider-elements' ),
				],
				'default' => 'content',
			]
		);

		$repeater->add_control(
			'normal_content', [
				'label'       => __( 'Content Text', 'spider-elements' ),
				'type'        => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default'     => __( 'Accordion Content', 'spider-elements' ),
				'condition'   => [
					'content_type' => 'content'
				]
			]

		);

		$repeater->add_control(
			'el_content', [
				'label'       => __( 'Select Template', 'spider-elements' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => se_get_el_templates(),
				'label_block' => true,
				'default'     => __( 'Accordion Content', 'spider-elements' ),
				'condition'   => [
					'content_type' => 'el_template'
				]
			]
		);

		$this->add_control(
			'accordions', [
				'label'       => 'Accordion Items',
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'title'       => esc_html__( 'Accordion #1', 'spider-elements' ),
						'tab_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'spider-elements' ),
					],
					[
						'title'       => esc_html__( 'Accordion #2', 'spider-elements' ),
						'tab_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'spider-elements' ),
					],
					[
						'title'       => esc_html__( 'Accordion #3', 'spider-elements' ),
						'tab_content' => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
							'spider-elements' ),
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'plus-icon', [
				'label'       => __( 'Icon', 'spider-elements' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => [
					'value'   => 'fas fa-plus',
					'library' => 'solid',
				],
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'minus-icon', [
				'label'   => __( 'Active Icon', 'spider-elements' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-minus',
					'library' => 'solid',
				]
			]
		);

		$this->add_control(
			'is_toggle', [
				'label'        => esc_html__( 'Toggle', 'spider-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'spider-elements' ),
				'label_off'    => esc_html__( 'No', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'title_tag', [
				'label'   => __( 'Title Tag', 'spider-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h6',
				'options' => se_el_title_tags(),
			]
		);

		$this->end_controls_section(); // End Accordion Settings

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

		//============================= Accordion =============================//
		$this->start_controls_section(
			'section_title_style', [
				'label' => esc_html__( 'Accordion', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'tabs_border',
				'label'    => esc_html__( 'Border', 'spider-elements' ),
				'selector' => '{{WRAPPER}} .accordion .doc_accordion .accordion_main_aria, {{WRAPPER}} .accordion .doc_accordion .accordion_main_aria',
			]
		);

		$this->add_responsive_control(
			'accordion_bottom_margin',
			[
				'label'      => esc_html__( 'Bottom Margin', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range'      => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'max' => 0,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .accordion .doc_accordion' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style_title',
			[
				'label' => esc_html__( 'Title', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_background',
			[
				'label'     => esc_html__( 'Background', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .doc_accordion .card-header button.collapsed' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .doc_accordion .card-header button'           => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .doc_accordion .card-header button.collapsed, {{WRAPPER}} .elementor-accordion-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion-icon svg'                                                        => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_active_color',
			[
				'label'     => esc_html__( 'Active Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .doc_accordion .card-header button, {{WRAPPER}} .elementor-active .elementor-accordion-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-active .elementor-accordion-icon svg'                                              => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .doc_accordion .card-header button.collapsed, {{WRAPPER}} .doc_accordion .card-header button',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(), [
				'name'     => 'text_stroke',
				'selector' => '{{WRAPPER}} .doc_accordion .card-header button.collapsed, {{WRAPPER}} .doc_accordion .card-header button',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_shadow',
				'selector' => '{{WRAPPER}} .doc_accordion .card-header button.collapsed, {{WRAPPER}} .doc_accordion .card-header button',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .doc_accordion .card-header button.collapsed' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .doc_accordion .card-header button'           => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style_icon',
			[
				'label' => esc_html__( 'Icon', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label'   => esc_html__( 'Alignment', 'spider-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'  => [
						'title' => esc_html__( 'Start', 'spider-elements' ),
						'icon'  => 'eicon-h-align-left'
					],
					'right' => [
						'title' => esc_html__( 'End', 'spider-elements' ),
						'icon'  => 'eicon-h-align-right'
					],
				],
				'default' => is_rtl() ? 'left' : 'right',
				'toggle'  => false,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .doc_accordion .card-header button.collapsed .expanded-icon' => 'color: {{VALUE}};',

				],
			]
		);

		$this->add_control(
			'icon_active_color', [
				'label'     => esc_html__( 'Active Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .doc_accordion .card-header button .collapsed-icon, .doc_accordion .card-header button .expanded-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label'     => esc_html__( 'Spacing', 'spider-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .doc_accordion .card-header button .expanded-icon'                  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .doc_accordion .card-header button .collapsed-icon'                 => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .doc_accordion .card-header button.icon-align-left .expanded-icon'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .doc_accordion .card-header button.icon-align-left .collapsed-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style_content',
			[
				'label' => esc_html__( 'Content', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_background_color',
			[
				'label'     => esc_html__( 'Background', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container .toggle_body' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container .toggle_body' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .elementor-widget-container .toggle_body',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'content_shadow',
				'selector' => '{{WRAPPER}} .elementor-widget-container .toggle_body',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-widget-container .toggle_body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
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
		extract( $settings );

		$title_tag        = ! empty ( $settings[ 'title_tag' ] ) ? $settings[ 'title_tag' ] : 'h6';
		$accordions       = ! empty ( $settings[ 'accordions' ] ) ? $settings[ 'accordions' ] : '';
		$icon_align       = ! empty ( $settings[ 'icon_align' ] ) ? $settings[ 'icon_align' ] : 'right';
		$icon_align_class = ! empty ( $icon_align == 'left' ) ? ' icon-align-left' : '';

		$is_toggle           = ! empty ( $settings[ 'is_toggle' ] ) ? $settings[ 'is_toggle' ] : '';
		$toggle_id           = ! empty( $is_toggle == 'yes' ) ? 'id=accordionExample-' . $this->get_id() : '';
		$toggle_bs_parent_id = ! empty( $is_toggle == 'yes' ) ? 'data-bs-parent=#accordionExample-' . $this->get_id() : '';

		//======================== Template Parts ========================//
		include "templates/accordion/accordion.php";

	}
}