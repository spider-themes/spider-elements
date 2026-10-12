<?php
/**
 * Use namespace to avoid conflict
 */

namespace SPEL\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Dual-button
 * @package spider\Widgets
 */
class Icon_Box extends Widget_Base {

	public function get_name() {
		return 'spel_icon_box'; // ID of the widget (Don't change this name)
	}

	public function get_title() {
		return esc_html__( 'Icon Box', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-icon-box spel-icon';
	}

	public function get_keywords() {
		return [
			'spider',
			'spider elements',
			'icon',
			'box',
			'icon-box',
			'icon box',
			'card',
			'img box',
			'image box',
			'svg'
		];
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'spel-main', 'elegant-icon' ];
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
	public function elementor_content_control() { //start icon box settings

		//==================== Select Preset Skin ====================//
		$this->start_controls_section(
			'counter_preset', [
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
						'icon'  => 'icon_box_1',
					],
					'2' => [
						'title' => esc_html__( 'Style 02', 'spider-elements' ),
						'icon'  => 'icon_box_2',
					],
				],
				'toggle'  => false,
				'default' => '1',
			]
		);

		$this->end_controls_section(); // End Preset Skin


		//========================== Contents ========================//
		$this->start_controls_section(
			'icon_box_content', [
				'label' => esc_html__( 'Contents', 'spider-elements' ),
			]
		);

		$this->add_control(
			'i_box_icon',
			[
				'label'     => esc_html__( 'Icon', 'spider-elements' ),
				'type'      => Controls_Manager::ICONS,
				'separator' => 'before',
				'default'   => [
					'value'   => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);
		

		$this->add_control(
			'pro_box_icon',
			[
				'label'       => esc_html__( 'Pro Feature Icon', 'spider-elements' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => [
					'value'   => 'fas fa-crown',
					'library' => 'fa-solid',
				],
				'condition'   => [
					'style'  => [ '2' ],
					'style!' => [ '1' ]
				],
			]
		);

		$this->add_control(
			'title', [
				'label'       => esc_html__( 'Title', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '50+ New Feature', 'spider-elements' ),
				'placeholder' => esc_html__( 'Enter your title', 'spider-elements' ),
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'description', [
				'label'       => esc_html__( 'Description', 'spider-elements' ),
				'type'        => Controls_Manager::TEXTAREA,
				'dynamic'     => [
					'active' => true,
				],
				'default'     => esc_html__( 'Equipped with 70+ beautiful, vastly customizable addons.', 'spider-elements' ),
				'placeholder' => esc_html__( 'Enter your description', 'spider-elements' ),
				'rows'        => 5,
				'condition'   => [
					'style'  => [ '1' ],
					'style!' => [ '2' ]
				],
			]
		);

		$this->add_control(
			'box2_link', [
				'label'       => esc_html__( 'Link', 'spider-elements' ),
				'type'        => Controls_Manager::URL,
				'options'     => [ 'url', 'is_external', 'spider-elements' ],
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
				'condition'   => [
					'style'  => [ '2' ],
					'style!' => [ '1' ]
				],
			]
		);

		$this->add_control(
			'box_title_tag', [
				'label'     => esc_html__( 'Title Tag', 'spider-elements' ),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'default'   => 'h5',
				'options'   => spel_get_title_tags(),
			]
		);

		$this->end_controls_section(); // End icon box Settings

		$this->start_controls_section(
			'icon_box_btn', [
				'label'     => esc_html__( 'Button', 'spider-elements' ),
				'condition' => [
					'style'  => [ '1' ],
					'style!' => [ '2' ]
				],
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__( 'Text', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Click here', 'spider-elements' ),
				'placeholder' => esc_html__( 'Enter button text', 'spider-elements' ),
				'description' => esc_html__( '"Write your icon box button text"', 'spider-elements' ),
				'separator'   => 'before',
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'box_link', [
				'label'       => esc_html__( 'Link', 'spider-elements' ),
				'type'        => Controls_Manager::URL,
				'options'     => [ 'url', 'is_external', 'spider-elements' ],
				'label_block' => true,
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'btn_icon',
			[
				'label'       => esc_html__( 'Icon', 'spider-elements' ),
				'type'        => Controls_Manager::ICONS,
				'skin'        => 'inline',
				'label_block' => false,
				'default'     => [
					'value'   => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
			]
		);

		$this->end_controls_section(); // End icon box button Settings

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
	//==================Start Icon Box all style controls===============//
	public function elementor_style_control() {

		//start Box style control section-------------------------//
		$this->start_controls_section(
			'sec_title_style', [
				'label' => esc_html__( 'Box', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_responsive_control(
			'box_text_align',
			[
				'label'     => esc_html__( 'Text Alignment', 'spider-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'    => [
						'title' => esc_html__( 'Left', 'spider-elements' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'  => [
						'title' => esc_html__( 'Center', 'spider-elements' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'   => [
						'title' => esc_html__( 'Right', 'spider-elements' ),
						'icon'  => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'spider-elements' ),
						'icon'  => 'eicon-text-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon_box_content' => 'text-align: {{VALUE}};',
					'{{WRAPPER}} .icon_box_two'     => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'box-border',
				'selector' => '{{WRAPPER}} .spel_icon_box,
							   {{WRAPPER}} .icon_box_two',
			]
		);

		$this->add_responsive_control(
			'box_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .spel_icon_box'     => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .icon_box_two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_padding',
			[
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .box_bg_shape'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .box2_bg_shape' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator'  => 'after',
			]
		);

		//star icon box normal/hover style tabs------------//
		$this->start_controls_tabs(
			'box_style_tabs'
		);
		//start icon box normal style tab-------------//
		$this->start_controls_tab(
			'box_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'spider-elements' ),

			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'background',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .spel_icon_box,
							   {{WRAPPER}} .icon_box_two',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(), [
				'name'     => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .spel_icon_box,
							   {{WRAPPER}} .icon_box_two',
			]
		);


		$this->end_controls_tab();
		//end icon box normal style tab-------------//

		//start icon box hover style tab-------------//
		$this->start_controls_tab(
			'box_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'spider-elements' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'box_hover_background',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .spel_icon_box:hover,
							   {{WRAPPER}} .icon_box_two:hover',
			]
		);

		$this->add_control(
			'text_hover_color',
			[
				'label'     => esc_html__( 'Title Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel_icon_box:hover .box_title'         => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon_box_two:hover .box_two_title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'desc_hover_color',
			[
				'label'     => esc_html__( 'Description Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel_icon_box:hover .icon_box_description' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style'  => [ '1' ],
					'style!' => [ '2' ]
				],
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label'     => esc_html__( 'Icon Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel_icon_box:hover .box_main_icon'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon_box_two:hover .box_main_icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_bghover_color',
			[
				'label'     => esc_html__( 'Icon Background', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon_box_two:hover .box_main_icon' => 'background: {{VALUE}}',
				],
				'condition' => [
					'style'  => [ '2' ],
					'style!' => [ '1' ]
				],
			]
		);

		$this->add_control(
			'btn_hover_color',
			[
				'label'     => esc_html__( 'Button hover', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel_icon_box:hover .box_button'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .spel_icon_box:hover .icon_box_button i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style'  => [ '1' ],
					'style!' => [ '2' ]
				],
			]
		);

		$this->add_control(
			'border_hover_color',
			[
				'label'     => esc_html__( 'Border Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel_icon_box:hover'     => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .icon_box_two:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(), [
				'name'     => 'icon_box_hover_shadow',
				'selector' => '{{WRAPPER}} .spel_icon_box:hover,
		                       {{WRAPPER}} .icon_box_two:hover',
			]
		);

		$this->end_controls_tab();
		//end icon box hover style tab-------------//
		$this->end_controls_tabs();
		//star icon box normal/hover style tabs------------//
		$this->end_controls_section();
		//end Box style control section------------------------------//


		//start icon box contents section-----------------------------//
		$this->start_controls_section(
			'box_contents',
			[
				'label' => esc_html__( 'Contents', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//start icon box title style controls-------------//
		$this->add_control(
			'title_heading',
			[
				'label' => esc_html__( 'Title', 'spider-elements' ),
				'type'  => Controls_Manager::HEADING
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'box_content_typo',
				'selector' => '{{WRAPPER}} .box_title,
							   {{WRAPPER}} .box_two_title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .box_title'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .box_two_title' => 'color: {{VALUE}}',
				],
			]
		);
		//end icon box title style controls------------------//

		//start icon box description style controls----------------//
		$this->add_control(
			'desc_heading',
			[
				'label'     => esc_html__( 'Description', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style'  => [ '1' ],
					'style!' => [ '2' ]
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'box_description_typo',
				'selector'  => '{{WRAPPER}} .icon_box_description',
				'condition' => [
					'style'  => [ '1' ],
					'style!' => [ '2' ]
				],
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon_box_description' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style'  => [ '1' ],
					'style!' => [ '2' ]
				],
			]
		);

		$this->add_responsive_control(
			'box_desc_margin',
			[
				'label'      => esc_html__( 'Margin', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 100,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors'  => [
					'{{WRAPPER}} .icon_box_description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style'  => [ '1' ],
					'style!' => [ '2' ]
				],
			]
		);

		$this->add_control(
			'box_btn_hrading',
			[
				'label'     => esc_html__( 'Button', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style'  => [ '1' ],
					'style!' => [ '2' ]
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'box_btn_typo',
				'selector'  => '{{WRAPPER}} .box_button,
							   {{WRAPPER}} .icon_box_button i',
				'condition' => [
					'style'  => [ '1' ],
					'style!' => [ '2' ]
				],
			]
		);

		$this->add_control(
			'box_btn_color',
			[
				'label'     => esc_html__( 'Button Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .box_button'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .icon_box_button i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'style'  => [ '1' ],
					'style!' => [ '2' ]
				],
			]
		);

		$this->end_controls_section();
		//end icon box content style controls-------------------//


		//start Icon style section----------------------//
		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Icon', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'icon_vertical_alignment',
			[
				'label'     => esc_html__( 'Vertical Alignment', 'spider-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => esc_html__( 'Top', 'spider-elements' ),
						'icon'  => 'eicon-v-align-top',
					],
					'center'     => [
						'title' => esc_html__( 'Middle', 'spider-elements' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'flex-end'   => [
						'title' => esc_html__( 'Bottom', 'spider-elements' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default'   => 'flex-start',
				'selectors' => [
					'{{WRAPPER}} .box_icon' => 'display: flex; align-items: {{VALUE}};',
				],
				'condition' => [
					'style'  => [ '1' ],
					'style!' => [ '2' ]
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .box_main_icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label'     => esc_html__( 'Background', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .box_main_icon' => 'background: {{VALUE}}',
				],
				'condition' => [
					'style'  => [ '2' ],
					'style!' => [ '1' ]
				],
			]
		);


		$this->add_responsive_control(
			'icon_size',
			[
				'label' => esc_html__( 'Size', 'spider-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .box_main_icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .box_main_icon i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'box_icon_space',
			[
				'label'      => esc_html__( 'Spacing', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'default'    => [
					'size' => 20,
				],
				'range'      => [
					'px'  => [
						'max' => 200,
					],
					'em'  => [
						'max' => 10,
					],
					'rem' => [
						'max' => 10,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .box_main_icon' => 'margin-right: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .box_two_title' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'box_icon_padding',
			[
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 100,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors'  => [
					'{{WRAPPER}} .box_main_icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style'  => [ '2' ],
					'style!' => [ '1' ]
				],
			]
		);

		$this->add_responsive_control(
			'box_icon_radius', [
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .box_main_icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style'  => [ '2' ],
					'style!' => [ '1' ]
				],
			]
		);

		$this->add_control(
			'icon_box_svg_color_option',
			[
				'label'     => esc_html__( 'svg Color', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs(
			'icon_box_svg_style_tabs'
		);

		//start svg normal----
		$this->start_controls_tab(
			'svg_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'spider-elements' ),
			]
		);

		$this->add_control(
			'svg_color',
			[
				'label'     => esc_html__( 'Stroke Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .box_main_icon svg path' => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'svg_fill_color',
			[
				'label'     => esc_html__( 'Fill Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .box_main_icon svg path' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab(); //end svg normal-----//

		//start svg Hover ------
		$this->start_controls_tab(
			'svg_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'spider-elements' ),
			]
		);

		$this->add_control(
			'svg_hover_color',
			[
				'label'     => esc_html__( 'Stroke Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel_icon_box:hover .box_bg_shape .box_icon .box_main_icon svg path' => 'stroke: {{VALUE}}',
					'{{WRAPPER}} .icon_box_two:hover .box2_bg_shape .box_main_icon svg path'      => 'stroke: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'svg_fill_hover_color',
			[
				'label'     => esc_html__( 'Fill Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel_icon_box:hover .box_bg_shape .box_icon .box_main_icon svg path' => 'fill: {{VALUE}}',
					'{{WRAPPER}} .icon_box_two:hover .box2_bg_shape .box_main_icon svg path'      => 'fill: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab(); //end svg hover//------

		$this->end_controls_tabs(); //end normal/hover tabs/////-----

		$this->end_controls_section();
		//end icon box Icon and svg style section------------------------//


		//start icon box background style section------------//
		$this->start_controls_section(
			'icon_box_bg_section',
			[
				'label' => esc_html__( 'Background Shape', 'spider-elements' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'iconbox_bg_style_tabs'
		);

		//===start BG normal===//
		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'spider-elements' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'box_normal_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .box_bg_shape,
							   {{WRAPPER}} .box2_bg_shape',
			]
		);

		$this->end_controls_tab(); //end BG normal-----//

		//====start BG Hover =====//
		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'spider-elements' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'hover_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .box_bg_shape:hover,
							   {{WRAPPER}} .box2_bg_shape:hover',
			]
		);

		$this->end_controls_tab(); //end BG hover//------

		$this->end_controls_tabs(); //end normal/hover tabs/////-----

		$this->end_controls_section(); //end background control style section---------////

	} //	==================End icon box all section snd style controls===============//


	protected function render() {
		$settings = $this->get_settings_for_display();

		$box_title_tag = Utils::validate_html_tag( $settings['box_title_tag'] ?? 'h6' );

		//================= Template Parts =================//
		// Whitelist valid style values to prevent Local File Inclusion
		$allowed_styles = [ '1', '2' ];
		$style = isset( $settings['style'] ) && in_array( $settings['style'], $allowed_styles, true ) ? $settings['style'] : '1';
		include __DIR__ . "/templates/Icon-box/icon-box{$style}.php";
	}
}