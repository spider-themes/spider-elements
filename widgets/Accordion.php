<?php
/**
 * Use namespace to avoid conflict
 */

namespace SPEL\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Accordion
 * @package spider\Widgets
 */
class Accordion extends Widget_Base {

	public function get_name(): string
    {
		return 'spel_accordion'; // ID of the widget (Don't change this name)
	}

	public function get_title(): string
    {
		return esc_html__( 'Accordion', 'spider-elements' );
	}

	public function get_icon(): string
    {
		return 'eicon-accordion spel-icon';
	}

	public function get_keywords(): array
    {
		return [ 'spider', 'spider elements', 'toggle', 'accordion', 'collapse', 'faq', 'tabs', 'tab', ];
	}

	public function get_categories(): array
    {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends(): array
    {
		return [ 'spel-main', 'elegant-icon' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends(): array
    {
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
				'label'       => esc_html__( 'Title', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Accordion Title', 'spider-elements' ),
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
				'label'       => esc_html__( 'Content Text', 'spider-elements' ),
				'type'        => Controls_Manager::WYSIWYG,
				'label_block' => true,
				'default'     => esc_html__( 'Accordion Content', 'spider-elements' ),
				'condition'   => [
					'content_type' => 'content'
				]
			]

		);

		$repeater->add_control(
			'el_content', [
				'label'       => esc_html__( 'Select Template', 'spider-elements' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => spel_get_el_templates(),
				'label_block' => true,
				'default'     => esc_html__( 'Accordion Content', 'spider-elements' ),
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
				'label'       => esc_html__( 'Icon', 'spider-elements' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => [
					'value'   => 'icon_plus',
					'library' => 'solid',
				],
				'separator'   => 'before'
			]
		);

		$this->add_control(
			'minus-icon', [
				'label'   => esc_html__( 'Active Icon', 'spider-elements' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'icon_minus-06',
					'library' => 'solid',
				]
			]
		);

		$this->add_control(
			'icon_align',
			[
				'label'   => esc_html__( 'Icon Alignment', 'spider-elements' ),
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

		$this->add_responsive_control(
			'icon_space',
			[
				'label'      => esc_html__( 'Icon Spacing', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default'    => [
					'size' => 30,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .card .card-header button .expanded-icon'                  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .card .card-header button .collapsed-icon'                 => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .card .card-header button.icon-align-left .expanded-icon'  => 'margin-left: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .card .card-header button.icon-align-left .collapsed-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'is_toggle', [
				'label'        => esc_html__( 'Toggle', 'spider-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'separator'    => 'before',
				'label_on'     => esc_html__( 'Yes', 'spider-elements' ),
				'label_off'    => esc_html__( 'No', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$this->add_control(
			'faq_schema',
			[
				'label'     => esc_html__( 'FAQ Schema', 'spider-elements' ),
				'type'      => Controls_Manager::SWITCHER,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'title_tag', [
				'label'     => esc_html__( 'Title Tag', 'spider-elements' ),
				'type'      => Controls_Manager::SELECT,
				'separator' => 'before',
				'default'   => 'h6',
				'options'   => spel_get_title_tags(),
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
	public function elementor_style_control(): void
    {

		//============================= Accordion Settings Style =============================//
		$this->start_controls_section(
			'sec_title_style', [
				'label' => esc_html__( 'Accordion', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(), [
				'name'     => 'accordion_border',
				'selector' => '{{WRAPPER}} .spel-accordion .card',
			]
		);

		$this->add_responsive_control(
			'acc_item_border_radius', [
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .spel-accordion .card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'is_border_bottom', [
				'label'        => esc_html__( 'Border Bottom', 'spider-elements' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'spider-elements' ),
				'label_off'    => esc_html__( 'No', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'accordion_box_shadow',
				'selector' => '{{WRAPPER}} .spel-accordion .card',
			]
		);

		$this->add_responsive_control(
			'accordion_bottom_spacing', [
				'label'       => esc_html__( 'Spacing', 'spider-elements' ),
				'description' => esc_html__( 'Spacing between the accordions', 'spider-elements' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range'       => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'max' => 0,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .spel-accordion .card' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->end_controls_section();


        //=============Accordion Title Style Section===============
		$this->start_controls_section(
			'section_toggle_style_title',
			[
				'label' => esc_html__( 'Title', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .card .card-header button.collapsed, {{WRAPPER}} .card .card-header button',
			]
		);

		$this->add_control(
			'title_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .accordion_inner button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'tab_active_color', [
				'label'     => esc_html__( 'Active Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel-accordion .collapsed .accordion_btn_link' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(), [
				'name'     => 'accordion_title_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .card-header button.collapsed, {{WRAPPER}} .card-header button',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(), [
				'name'     => 'text_stroke',
				'selector' => '{{WRAPPER}} .card .card-header button.collapsed, {{WRAPPER}} .card .card-header button',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'title_shadow',
				'selector' => '{{WRAPPER}} .card .card-header button.collapsed, {{WRAPPER}} .card .card-header button',
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .card .card-header button.collapsed' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .card .card-header button'           => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); //End Accordion title

        //================= Content Style ===================
		$this->start_controls_section(
			'section_toggle_style_content',
			[
				'label' => esc_html__( 'Content', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .spel-accordion .card .card-body p',
			]
		);

		$this->add_control(
			'content_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-widget-container .card-body' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(), [
				'name'     => 'accordion_content_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .elementor-widget-container .card-body ',
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'content_shadow',
				'selector' => '{{WRAPPER}} .elementor-widget-container .card-body',
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-widget-container .card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		//end accordion content style section//


		//		============Accordion Icon Style Section==============
		$this->start_controls_section(
			'section_toggle_style_icon',
			[
				'label' => esc_html__( 'Icon', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE
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
					'{{WRAPPER}} .expanded-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .collapsed-icon' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

	    // Accordion icon Normal/Active/ State
	    $this->start_controls_tabs(
		    'style_accordion_icon_tabs'
	    );

	    //=== Normal icon
	    $this->start_controls_tab(
		    'style_accordion_icon_normal', [
			    'label' => esc_html__( 'Normal', 'spider-elements' ),
		    ]
	    );

	    $this->add_control(
		    'acc_icon_color',
		    [
			    'label'     => esc_html__( 'Color', 'spider-elements' ),
			    'type'      => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .card-header button .expanded-icon' => 'color: {{VALUE}};',

			    ],
		    ]
	    );

	    $this->add_control(
		    'acc_icon_bg_color',
		    [
			    'label'     => esc_html__( 'Background', 'spider-elements' ),
			    'type'      => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .card .card-header button .expanded-icon' => 'background: {{VALUE}};',

			    ],
		    ]
	    );

	    $this->end_controls_tab(); //End Normal icon


	    //=== Active icon====
	    $this->start_controls_tab(
		    'acc_icon_active', [
			    'label' => esc_html__( 'Active', 'spider-elements' ),
		    ]
	    );

	    $this->add_control(
		    'icon_active_color', [
			    'label'     => esc_html__( 'Color', 'spider-elements' ),
			    'type'      => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .card-header button .collapsed-icon' => 'color: {{VALUE}};',
			    ],
		    ]
	    );

	    $this->add_control(
		    'icon_active_bg_color', [
			    'label'     => esc_html__( 'Background', 'spider-elements' ),
			    'type'      => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .card .card-header button .collapsed-icon' => 'background: {{VALUE}};',
			    ],
		    ]
	    );


	    $this->end_controls_tab(); // End Active Tab Title
	    $this->end_controls_tabs(); // End Accordion icon Normal/Active/ State

	    $this->add_responsive_control(
		    'acc_padding', [
			    'label'      => esc_html__( 'Padding', 'spider-elements' ),
			    'type'       => Controls_Manager::DIMENSIONS,
			    'size_units' => [ 'px', '%', 'em' ],
				'separator'  => 'before',
			    'selectors'  => [
				    '{{WRAPPER}} .expanded-icon'  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				    '{{WRAPPER}} .collapsed-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			    ],
		    ]
	    );

		$this->add_responsive_control(
			'acc_border_radius', [
				'label'      => esc_html__( 'Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
                'selectors'  => [
                    '{{WRAPPER}} .expanded-icon'  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .collapsed-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
			]
		);

		$this->end_controls_section();
		//end accordion icon style section//

	}
	//	==================End accordion all style controls===============

	/**
	 * Name: elementor_render()
	 * Desc: Render the widget output on the frontend.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	protected function render(): void {

		$settings = $this->get_settings_for_display();

		$title_tag        = Utils::validate_html_tag( $settings['title_tag'] ?? 'h6' );
		$accordions       = $settings['accordions'] ?? [];
		$icon_align       = $settings['icon_align'] ?? 'right';
		$icon_align_class = ( 'left' === $icon_align ) ? ' icon-align-left' : '';

		$is_toggle           = $settings['is_toggle'] ?? '';
		$toggle_id           = ( 'yes' === $is_toggle ) ? 'id=accordionExample-' . $this->get_id() : '';
		$toggle_bs_parent_id = ( 'yes' === $is_toggle ) ? 'data-bs-parent=#accordionExample-' . $this->get_id() : '';

		//======================== Template Parts ========================//
		include 'templates/accordion/accordion.php';
	}
}