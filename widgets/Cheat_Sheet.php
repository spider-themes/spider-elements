<?php
/**
 * Use namespace to avoid conflict
 */

namespace SPEL\Widgets;

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class Alerts_box
 *
 * @package spider\Widgets
 * @since   1.0.0
 */
class Cheat_Sheet extends Widget_Base {

	public function get_name() {
		return 'docly_cheatsheet'; // ID of the widget (Don't change this name)
	}

	public function get_title() {
		return esc_html__( 'Cheat Sheet', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-apps spel-icon';
	}

	public function get_keywords() {
		return [ 'spider', 'spider elements', 'toggle' ];
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'spel-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'spel-el-widgets' ];
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

		//==================== Select Preset Skin ====================//
		$this->start_controls_section(
			'sheet_counter_preset', [
				'label' => esc_html__( 'Preset Skin', 'spider-elements' ),
			]
		);

		$this->add_control(
			'style', [
				'label'   => esc_html__( 'Skin', 'spider-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'title' => esc_html__( 'Style 01', 'spider-elements' ),
						'icon'  => 'cheat_sheet_1',
					],
					'2' => [
						'title' => esc_html__( 'Style 02', 'spider-elements' ),
						'icon'  => 'cheat_sheet_2',
					],
					'3' => [
						'title' => esc_html__( 'Style 03', 'spider-elements' ),
						'icon'  => 'cheat_sheet_3',
					],
				],
				'toggle'  => false,
				'default' => '1',
			]
		);

		$this->end_controls_section(); // End Preset Skin

		//======================== Cheat Sheet Section =========================//
		$this->start_controls_section(
			'cheat_sheet_sec', [
				'label' => esc_html__( 'Cheat Sheet', 'spider-elements' ),
			]
		);

		$this->add_control(
			'enable_cheat_sheet_title', [
				'label'        => esc_html__( 'Show Accordion', 'spider-elements' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'spider-elements' ),
				'label_off'    => esc_html__( 'No', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'cheat_sheet_title', [
				'label'       => esc_html__( 'Title', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => esc_html__( 'Auxiliary', 'spider-elements' ),
				'condition'   => [
					'enable_cheat_sheet_title' => 'yes',
				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'cs_title', [
				'label' => esc_html__( 'Title', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'be', 'spider-elements' ),
			]
		);

		$repeater->add_control(
			'cs_content', [
				'label'   => esc_html__( 'Content', 'spider-elements' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Sein', 'spider-elements' ),
			]
		);

		$repeater->add_control(
			'image', [
				'label' => esc_html__( 'Image', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'media_types' => ['image', 'svg'],
				'description' => 'Applicable only for Style 3.',
			]
		);

		$repeater->add_control(
			'text_color', [
				'label'     => esc_html__( 'Title Color', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'description' => 'This will only work for Style 2 and 3',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .info-box-heading' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .cs-outline3 .cs3-title' => 'color: {{VALUE}}',
				],
				'separator' => 'before',
			]
		);

		$repeater->add_control(
			'number_color1', [
				'label'     => esc_html__( 'Number Color', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'description' => 'This will only work for Style 2 and 3',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .number-circle' => 'color: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .cs-outline3 .serial-number' => 'color: {{VALUE}}',
				],
			]
		);

		$repeater->add_control(
			'num_bg_color', [
				'label'     => esc_html__( 'Number Background', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'description' => 'This will only work for Style 2',
				'selectors' => [
					'{{WRAPPER}} {{CURRENT_ITEM}} .info-box-number' => 'background: {{VALUE}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .outline:before'  => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'cheat_sheet_contents', [
				'label'         => esc_html__( 'Cheat Sheet List', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'title_field'   => '{{{ cs_title }}}',
				'default'       => [
					[
						'cs_title'   => esc_html__( 'be', 'spider-elements' ),
						'cs_content' => esc_html__( 'sein', 'spider-elements' ),
					],
					[
						'cs_title'   => esc_html__( 'have', 'spider-elements' ),
						'cs_content' => esc_html__( 'haben', 'spider-elements' ),
					],
					[
						'cs_title'   => esc_html__( 'become', 'spider-elements' ),
						'cs_content' => esc_html__( 'werden', 'spider-elements' ),
					],
					[
						'cs_title'   => esc_html__( 'can', 'spider-elements' ),
						'cs_content' => esc_html__( 'konnen', 'spider-elements' ),
					],
				],
				'prevent_empty' => false
			]
		);

		$this->add_control(
			'column_grid', [
				'label'     => esc_html__( 'Column', 'spider-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'6' => esc_html__( 'Two Column', 'spider-elements' ),
					'4' => esc_html__( 'Three Column', 'spider-elements' ),
					'3' => esc_html__( 'Four Column', 'spider-elements' ),
					'2' => esc_html__( 'Six Column', 'spider-elements' ),
				],
				'default'   => '3',
				'condition' => [
					'style' => '1'
				],
			]
		);

		$this->add_control(
			'column_grid2', [
				'label'     => esc_html__( 'Column', 'spider-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'6' => esc_html__( 'Two Column', 'spider-elements' ),
					'4' => esc_html__( 'Three Column', 'spider-elements' ),
					'3' => esc_html__( 'Four Column', 'spider-elements' ),
					'2' => esc_html__( 'Six Column', 'spider-elements' ),
				],
				'default'   => '6',
				'condition' => [
					'style' => '2'
				],
			]
		);

		$this->add_control(
			'column_grid3', [
				'label'     => esc_html__( 'Column', 'spider-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'12' => esc_html__( 'One Column', 'spider-elements' ),
					'6' => esc_html__( 'Two Column', 'spider-elements' ),
					'4' => esc_html__( 'Three Column', 'spider-elements' ),
					'3' => esc_html__( 'Four Column', 'spider-elements' ),
					'2' => esc_html__( 'Six Column', 'spider-elements' ),
				],
				'default'   => '4',
				'condition' => [
					'style' => '3'
				],
			]
		);

		$this->add_control(
			'collapse_state', [
				'label'        => esc_html__( 'Extended Collapse', 'spider-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'spider-elements' ),
				'label_off'    => esc_html__( 'No', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes', // Default 'yes' so that it's ON by default
				'separator'    => 'before'
			]
		);

		$this->end_controls_section(); // End Cheat Sheet Section

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

		//========================= Item Box Background ==========================//
		$this->start_controls_section(
			'sec_bg_style', [
				'label' => esc_html__( 'Sheet Items', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'sheet_style_tabs'
		);

		$this->start_controls_tab(
			'sheet_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'spider-elements' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .cheat-info-box,
							   {{WRAPPER}} .cheatsheet_item,
							   {{WRAPPER}} .cs-items3',
			]
		);

		$this->add_group_control(
			Group_Control_Border::Get_type(), [
				'name'     => 'item_box_border',
				'selector' => '{{WRAPPER}} .cheatsheet_item,
							   {{WRAPPER}} .cheat-info-box,
							   {{WRAPPER}} .cs-items3',
			]
		);

		$this->add_responsive_control(
			'border-radius', [
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cheatsheet_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cheat-info-box'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cs-items3'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(), [
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .cheat-info-box,
							   {{WRAPPER}} .cheatsheet_item,
							   {{WRAPPER}} .cs-items3',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'sheet_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'spider-elements' ),
			]
		);

		$this->add_control(
			'title-hover-color',
			[
				'label'     => esc_html__( 'Title Color', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cheat-info-box:hover .info-box-heading' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cheatsheet_item:hover h5'               => 'color: {{VALUE}}',
					'{{WRAPPER}} .cs-items3:hover .cs3-title'               => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'desc-hover-color',
			[
				'label'     => esc_html__( 'Description Color', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cheat-info-box:hover .info-box-description' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cheatsheet_item:hover p'                    => 'color: {{VALUE}}',
					'{{WRAPPER}} .cs-items3:hover .cs-info-desc'                    => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'number-hover-color',
			[
				'label'     => esc_html__( 'Number color', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cheatsheet_item:hover .cheatsheet_num' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cs-items3:hover .serial-number' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => ['1', '3']
				]
			]
		);

		$this->add_control(
			'outline_hover_color',
			[
				'label'     => esc_html__( 'Outline Color', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cs-items3:hover .cs-outline3:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'border-color',
			[
				'label'     => esc_html__( 'Border Color', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cheat-info-box:hover'  => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .cheatsheet_item:hover' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .cs-items3:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'background-hover',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .cheat-info-box:hover,
		                       {{WRAPPER}} .cheatsheet_item:hover,
		                       {{WRAPPER}} .cs-items3:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(), [
				'name'     => 'box_hover_shadow',
				'selector' => '{{WRAPPER}} .cheat-info-box:hover,
							   {{WRAPPER}} .cheatsheet_item:hover,
							   {{WRAPPER}} .cs-items3:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'item_box_padding', [
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .cheatsheet_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cheat-info-box'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cs-items3'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'grid_item_gap',
			[
				'label'       => esc_html__( 'Grid Gap', 'spider-elements' ),
				'type'        => \Elementor\Controls_Manager::SLIDER,
				'description' => esc_html__( 'Set the gap between the items.', 'spider-elements' ),
				'separator'   => 'before',
				'range'       => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'     => [
					'size' => 20,
				],
				'selectors'   => [
					'{{WRAPPER}} .sheet_items_gap' => 'grid-gap: {{SIZE}}{{UNIT}} !important; display: grid;',
					'{{WRAPPER}} .cs-items3-gap' => 'grid-gap: {{SIZE}}{{UNIT}} !important; display: grid;',
				],
			]
		);

		$this->add_responsive_control(
			'number-text-gap',
			[
				'label'       => esc_html__( 'Number Gap', 'spider-elements' ),
				'type'        => \Elementor\Controls_Manager::SLIDER,
				'description' => esc_html__( 'Set the gap between the number and the text.', 'spider-elements' ),
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .cheat-info-box' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'style' => '2'
				]
			]
		);

		$this->end_controls_section(); // End Item Box Background

		//================================ Cheat Sheet Item ================================//
		$this->start_controls_section(
			'style_cs_item', [
				'label'     => esc_html__( 'Contents', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => '1'
				]
			]
		);

		$this->add_control(
			'title_options', [
				'label' => esc_html__( 'Title', 'spider-elements' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		//Title options//
		$this->add_control(
			'cheat_sheet_title_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cheatsheet_accordion .card .card-header button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'cheat_sheet_title_typo',
				'selector' => '{{WRAPPER}} .cheatsheet_accordion .card .card-header button',
			]
		);

		//=== Number Options
		$this->add_control(
			'cs_num_options', [
				'label'     => esc_html__( 'Number', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'cs_item_num_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cheatsheet_item .cheatsheet_num' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'cs_item_num_typo',
				'selector' => '{{WRAPPER}} .cheatsheet_item .cheatsheet_num',
			]
		); // End Number Options


		//=== Top Text Options
		$this->add_control(
			'cs_top_text_options', [
				'label'     => esc_html__( 'Top Text', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'cs_item_top_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cheatsheet_item p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'cs_item_top_typo',
				'selector' => '{{WRAPPER}} .cheatsheet_item p',
			]
		); // End Top Text Options


		//=== Bottom Text Options
		$this->add_control(
			'cs_bottom_text_options', [
				'label'     => esc_html__( 'Bottom Text', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'cs_item_bottom_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cheatsheet_item h5' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'cs_item_bottom_typo',
				'selector' => '{{WRAPPER}} .cheatsheet_item h5',
			]
		); // End Bottom Text Options

		$this->end_controls_section(); // End Cheat Sheet Item


		//======================== Cheat Sheet Item 2 =========================//
		$this->start_controls_section(
			'style_cs_item2', [
				'label'     => esc_html__( 'Contents', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => ['2', '3']
				]
			]
		);

		$this->add_control(
			'title_options2', [
				'label' => esc_html__( 'Accordion Title', 'spider-elements' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		//Title options//
		$this->add_control(
			'sheet_title_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cheatsheet_accordion .card .card-header button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'sheet_title_typo',
				'selector' => '{{WRAPPER}} .cheatsheet_accordion .card .card-header button',
			]
		);

		$this->add_control(
			'number_options', [
				'label'     => esc_html__( 'Number', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => ['3']
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'number_typography',
				'selector' => '{{WRAPPER}} .cs-outline3 .serial-number',
				'condition' => [
					'style' => '3'
				]
			]
		);

		$this->add_control(
			'number_color3',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cs-outline3 .serial-number' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style' => '3'
				]
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label'     => esc_html__( 'Title', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .info-box-heading,
							   {{WRAPPER}} .cs3-title',
			]
		);

		$this->add_control(
			'heading_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .info-box-heading' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cs3-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'gap_title_number',
			[
				'label'       => esc_html__( 'Gap', 'spider-elements' ),
				'type'        => \Elementor\Controls_Manager::SLIDER,
				'description' => esc_html__( 'Gap Between Title and Number.', 'spider-elements' ),
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .cs-outline3' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'style' => '3'
				]
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
				'selector' => '{{WRAPPER}} .info-box-description,
							   {{WRAPPER}} .cs-info-desc',
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .info-box-description' => 'color: {{VALUE}}',
					'{{WRAPPER}} .cs-info-desc' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'desc_margin',
			[
				'label'      => esc_html__( 'Margin', 'spider-elements' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .info-box-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .cs-info-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'img_heading',
			[
				'label'     => esc_html__( 'Image', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => '3'
				]
			]
		);

		$this->add_control(
			'img_radius',
			[
				'label'     => esc_html__( 'Image Radius', 'spider-elements' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cs-items3 .cs-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'style' => '3'
				]
			]
		);

		$this->end_controls_section(); // End Cheat Sheet Item 2


		//start number style
		$this->start_controls_section(
			'icon_style', [
				'label'     => esc_html__( 'Number', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => '2'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'number1_typography',
				'selector' => '{{WRAPPER}} .info-box-number .number-circle',
			]
		);

		$this->add_control(
			'number_color2',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .info-box-number .number-circle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'number_circle_bg_color',
			[
				'label'     => esc_html__( 'Circle Color', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .number-circle' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'info_box_number_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .info-box-number' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(), [
				'name'     => 'number_shadow',
				'label'    => esc_html__( 'Circle Shadow', 'spider-elements' ),
				'selector' => '{{WRAPPER}} .number-circle',
			]
		);

		$this->add_responsive_control(
			'number-gap',
			[
				'label'       => esc_html__( 'Gap', 'spider-elements' ),
				'type'        => \Elementor\Controls_Manager::SLIDER,
				'description' => esc_html__( 'Set the gap between the number and the text.', 'spider-elements' ),
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 200,
						'step' => 1,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .cheat-info-box' => 'gap: {{SIZE}}{{UNIT}};',
				],
				'separator'   => 'before',
			]
		);

		$this->end_controls_section();
		//end number style

		//outline style
		$this->start_controls_section(
			'outline_style', [
				'label'     => esc_html__( 'Outline', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => '3'
				]
			]
		);

		$this->add_control(
			'outline_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cs-items3 .cs-outline3:before' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'outline_width',
			[
				'label'       => esc_html__( 'Width', 'spider-elements' ),
				'type'        => \Elementor\Controls_Manager::SLIDER,
				'description' => esc_html__( 'Set the width of the outline.', 'spider-elements' ),
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .cs-items3 .cs-outline3:before' => 'width: {{SIZE}}{{UNIT}};',
				],
				'separator'   => 'before',
			]
		);

		$this->add_responsive_control(
			'outline_height',
			[
				'label'       => esc_html__( 'Height', 'spider-elements' ),
				'type'        => \Elementor\Controls_Manager::SLIDER,
				'description' => esc_html__( 'Set the height of the outline.', 'spider-elements' ),
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .cs-items3 .cs-outline3:before' => 'height: {{SIZE}}{{UNIT}};',
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
		extract( $settings ); // extract all settings array to variables converted to name of key

		//================= Template Parts =================//
		// Whitelist valid style values to prevent Local File Inclusion
		$allowed_styles = array( '1', '2', '3' );
		$style = isset( $settings['style'] ) && in_array( $settings['style'], $allowed_styles, true ) ? $settings['style'] : '1';
		include __DIR__ . "/templates/cheat-sheet/cheat-sheet-{$style}.php";
	}
}