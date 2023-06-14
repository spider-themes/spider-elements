<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if (!defined('ABSPATH')) {
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
        return [ 'toggle' ];
    }

    public function get_categories() {
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

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'collapse_state', [
				'label' => esc_html__( 'Expanded', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'spider-elements' ),
				'label_off' => esc_html__( 'No', 'spider-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
				'separator' => 'after',
			]
		);

		$repeater->add_control(
			'title', [
				'label' => __( 'Title', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Accordion Title', 'spider-elements' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'content_type', [
				'label'     => esc_html__( 'Content Type', 'spider-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'content'        => esc_html__( 'Content', 'spider-elements'),
					'el_template'   => esc_html__( 'Template', 'spider-elements'),
				],
				'default' => 'content',
			]
		);

		$repeater->add_control(
			'normal_content', [
				'label' => __( 'Content Text', 'spider-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => __( 'Accordion Content', 'spider-elements' ),
				'condition' => [
					'content_type' => 'content'
				]
			]

		);

		$repeater->add_control(
			'el_content', [
				'label'         => __( 'Select Template', 'spider-elements' ),
				'type'          => Controls_Manager::SELECT,
				'options'       => se_get_el_templates(),
				'label_block'   => true,
				'default'       => __( 'Accordion Content', 'spider-elements' ),
				'condition'     => [
					'content_type' => 'el_template'
				]
			]
		);

		$repeater->add_control(
			'tab_content', [
				'label' => esc_html__( 'Content', 'spider-elements' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'Accordion Content', 'spider-elements' ),
			]
		);

		$this->add_control(
			'accordions', [
				'label'     => 'Accordion Items',
				'type'      => Controls_Manager::REPEATER,
				'fields'    => $repeater->get_controls(),
				'default'   => [
					[
						'title'    => esc_html__( 'Accordion #1', 'spider-elements' ),
						'tab_content'           => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'spider-elements' ),
					],
					[
						'title'    => esc_html__( 'Accordion #2', 'spider-elements' ),
						'tab_content'           => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'spider-elements' ),
					],
				],
				'title_field' => '{{{ se_accordion_title }}}',
			]
		);

		$this->add_control(
			'plus-icon', [
				'label' => __( 'Icon', 'spider-elements' ),
				'type' => Controls_Manager::ICONS,
				'label_block'   => true,
				'default' => [
					'value' => 'fas fa-plus',
					'library' => 'solid',
				]
			]
		);

		$this->add_control(
			'minus-icon', [
				'label' => __( 'Active Icon', 'spider-elements' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-minus',
					'library' => 'solid',
				]
			]
		);

		$this->add_control(
			'is_toggle', [
				'label' => esc_html__( 'Toggle', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'spider-elements' ),
				'label_off' => esc_html__( 'No', 'spider-elements' ),
				'return_value' => 'yes',
				'default' => '',
			]
		);

		$this->add_control(
			'title_tag', [
				'label' => __( 'Title Tag', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::SELECT,
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
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'border_width', [
				'label' => esc_html__( 'Border Width', 'spider-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range' => [
					'px' => [
						'max' => 20,
					],
					'em' => [
						'max' => 2,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .doc_accordion.card' => 'border-width: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => esc_html__( 'Border Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .doc_accordion.card' => 'border-color: {{VALUE}};background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style_title',
			[
				'label' => esc_html__( 'Title', 'spider-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_background',
			[
				'label' => esc_html__( 'Background', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .doc_accordion .card-header button.collapsed' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .doc_accordion .card-header button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .doc_accordion .card-header button.collapsed, {{WRAPPER}} .elementor-accordion-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_active_color',
			[
				'label' => esc_html__( 'Active Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .doc_accordion .card-header button, {{WRAPPER}} .elementor-active .elementor-accordion-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .elementor-active .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .doc_accordion .card-header button.collapsed, {{WRAPPER}} .doc_accordion .card-header button',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(), [
				'name' => 'text_stroke',
				'selector' => '{{WRAPPER}} .doc_accordion .card-header button.collapsed, {{WRAPPER}} .doc_accordion .card-header button',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_shadow',
				'selector' => '{{WRAPPER}} .doc_accordion .card-header button.collapsed, {{WRAPPER}} .doc_accordion .card-header button',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Padding', 'spider-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .doc_accordion .card-header button.collapsed' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .doc_accordion .card-header button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style_icon',
			[
				'label' => esc_html__( 'Icon', 'spider-elements' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label' => esc_html__( 'Alignment', 'spider-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Start', 'spider-elements' ),
						'icon' => 'eicon-h-align-left'
					],
					'right' => [
						'title' => esc_html__( 'End', 'spider-elements' ),
						'icon' => 'eicon-h-align-right'
					],
				],
				'default' => is_rtl() ? 'left' : 'right',
				'toggle' => false,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .doc_accordion .card-header button.collapsed .expanded-icon' => 'color: {{VALUE}};',

				],
			]
		);

		$this->add_control(
			'icon_active_color', [
				'label' => esc_html__( 'Active Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .doc_accordion .card-header button .collapsed-icon, .doc_accordion .card-header button .expanded-icon' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_space',
			[
				'label' => esc_html__( 'Spacing', 'spider-elements' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .doc_accordion .card-header button .expanded-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .doc_accordion .card-header button .collapsed-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .doc_accordion .card-header button.icon-align-left .expanded-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .doc_accordion .card-header button.icon-align-left .collapsed-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_toggle_style_content',
			[
				'label' => esc_html__( 'Content', 'spider-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'content_background_color',
			[
				'label' => esc_html__( 'Background', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container .toggle_body' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'content_color',
			[
				'label' => esc_html__( 'Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container .toggle_body' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'content_typography',
				'selector' => '{{WRAPPER}} .elementor-widget-container .toggle_body',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'content_shadow',
				'selector' => '{{WRAPPER}} .elementor-widget-container .toggle_body',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => esc_html__( 'Padding', 'spider-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
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
	 * Package: @banca
	 * Author: spider-themes
	 */
    protected function render() {
        $settings = $this->get_settings_for_display();
		extract($settings); // extract all settings array to variables converted to name of key

	    include "templates/accordion/accordion.php";

    }
}