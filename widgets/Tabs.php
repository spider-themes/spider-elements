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
 * Class Tabs
 * @package spider\Widgets
 * @since 1.0.0
 */
class Tabs extends Widget_Base {

	public function get_name(): string
    {
		return 'docy_tabs'; // ID of the widget (Don't change this name)
	}

	public function get_title(): string
    {
		return esc_html__( 'Tabs', 'spider-elements' );
	}

	public function get_icon(): string
    {
		return 'eicon-tabs spel-icon';
	}

	public function get_keywords(): array
    {
		return [ 'spider', 'spider elements', 'tab', 'tabs', 'tab widget' ];
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
		return [ 'elegant-icon', 'spel-main' ];
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

		// ============================ Select Style  ===========================//
		$this->start_controls_section(
			'select_style',
			[
				'label' => esc_html__( 'Preset Skins', 'spider-elements' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Style', 'spider-elements' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'1' => esc_html__( 'Inline Tab', 'spider-elements' ),
					'2' => esc_html__( 'Full Width Tab', 'spider-elements' ),
				],
				'default' => '1',
			]
		);

		$this->end_controls_section(); // End Select Style


		// ============================ Tabs ===========================//
		$this->start_controls_section(
			'sec_tabs',
			[
				'label' => esc_html__( 'Tabs', 'spider-elements' ),
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'icon',
			[
				'label'   => esc_html__( 'Icon', 'spider-elements' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'far fa-lightbulb',
					'library' => 'fa-regular',
				],

			]
		);

		$repeater->add_control(
			'tab_title',
			[
				'label'       => esc_html__( 'Tab Title', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Tab Title', 'spider-elements' ),
				'placeholder' => esc_html__( 'Tab Title', 'spider-elements' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tabs_content_type',
			[
				'label'   => esc_html__( 'Content Type', 'spider-elements' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'content'  => esc_html__( 'Content', 'spider-elements' ),
					'template' => esc_html__( 'Saved Templates', 'spider-elements' ),
				],
				'default' => 'content',
			]
		);

		$repeater->add_control(
			'primary_templates',
			[
				'label'     => esc_html__( 'Choose Template', 'spider-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => spel_get_el_templates(),
				'condition' => [
					'tabs_content_type' => 'template',
				],
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label'       => esc_html__( 'Content', 'spider-elements' ),
				'default'     => esc_html__( 'Tab Content', 'spider-elements' ),
				'placeholder' => esc_html__( 'Tab Content', 'spider-elements' ),
				'type'        => Controls_Manager::WYSIWYG,
				'show_label'  => false,
				'condition'   => [
					'tabs_content_type' => 'content',
				],
			]
		);

		$repeater->end_controls_tab(); // End tab

		$this->add_control(
			'tabs',
			[
				'label'       => esc_html__( 'Add Items', 'spider-elements' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ tab_title }}}',
				'default'     => [
					[
						'tab_title'   => esc_html__( 'Tab Title #1', 'spider-elements' ),
						'tab_content' => esc_html__( 'Nostra adipiscing sequi nisi hic venenatis pede aliquid eget aperiam commodi gravida?', 'spider-elements' ),
					],
					[
						'tab_title'   => esc_html__( 'Tab Title #2', 'spider-elements' ),
						'tab_content' => esc_html__( 'Nostra adipiscing sequi nisi hic venenatis pede aliquid eget aperiam commodi gravida?', 'spider-elements' ),
					],
					[
						'tab_title'   => esc_html__( 'Tab Title #3', 'spider-elements' ),
						'tab_content' => esc_html__( 'Nostra adipiscing sequi nisi hic venenatis pede aliquid eget aperiam commodi gravida?', 'spider-elements' ),
					],
				],
			]
		);

		$this->add_control(
			'is_navigation_arrow',
			[
				'label'        => esc_html__( 'Navigation Arrow', 'spider-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__( 'Show/Hide navigation arrow button for content area', 'spider-elements' ),
				'label_on'     => esc_html__( 'Show', 'spider-elements' ),
				'label_off'    => esc_html__( 'Hide', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before'
			]
		);

		$this->add_control(
			'is_auto_numb', [
				'label'        => esc_html__( 'Auto Numbering', 'spider-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__( 'Show/Hide auto numbering for tab title', 'spider-elements' ),
				'label_on'     => esc_html__( 'Show', 'spider-elements' ),
				'label_off'    => esc_html__( 'Hide', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before'
			]
		);

		$this->add_control(
			'is_auto_play',
			[
				'label'        => esc_html__( 'Auto Play', 'spider-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__( 'Show/Hide auto play for tab', 'spider-elements' ),
				'label_on'     => esc_html__( 'Show', 'spider-elements' ),
				'label_off'    => esc_html__( 'Hide', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before'
			]
		);

		$this->add_control(
			'is_sticky_tab',
			[
				'label'        => esc_html__( 'Sticky Mode', 'spider-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'description'  => esc_html__( 'Show/Hide sticky mode for tab title', 'spider-elements' ),
				'label_on'     => esc_html__( 'Show', 'spider-elements' ),
				'label_off'    => esc_html__( 'Hide', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before'
			]
		);

		$this->add_control(
			'tab_alignment',
			[
				'label'     => esc_html__( 'Alignment', 'spider-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'spider-elements' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'     => [
						'title' => esc_html__( 'Center', 'spider-elements' ),
						'icon'  => ' eicon-h-align-center',
					],
					'flex-end'   => [
						'title' => esc_html__( 'Right', 'spider-elements' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'   => 'flex-start',
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .tab_shortcode .nav-tabs'    => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .header_tabs_area .nav-tabs' => 'justify-content: {{VALUE}};',
				],
				'separator' => 'before'
			]
		);

		$this->end_controls_section(); // End Tabs Section

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

		//============================ Tab Title Style ============================//
		$this->start_controls_section(
			'style_tabs_sec', [
				'label' => esc_html__( 'Tab Title', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'      => 'tab_item_typo',
				'selector'  => '{{WRAPPER}} .nav-tabs .nav-item .nav-link',
			]
		);

		$this->add_responsive_control(
			'icon_size', [
				'label'      => esc_html__( 'Icon Size', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
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
					'{{WRAPPER}} .nav-tabs .nav-item .nav-link i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'flex_column_gap', [
                'label' => esc_html__( 'Gap Between Tab', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .sticky_tab_item .nav-tabs' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(), [
				'name' => 'title_border',
				'selector' => '{{WRAPPER}} .nav-tabs .nav-item .nav-link',
			]
		);

		$this->add_responsive_control(
			'title_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .nav-tabs .nav-item .nav-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_pad', [
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .nav-tabs .nav-item .nav-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tab_title_hr', [
				'type' => Controls_Manager::DIVIDER,
			]
		);

		// Tab Title Normal/Active/hover State
		$this->start_controls_tabs(
			'style_tab_title_tabs'
		);

		//=== Normal Tab Title
		$this->start_controls_tab(
			'style_tab_title_normal',
			[
				'label' => esc_html__( 'Normal', 'spider-elements' ),
			]
		);

		$this->add_control(
			'normal_tab_title_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .nav-tabs .nav-item .nav-link' => 'color: {{VALUE}}',
				)
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'normal_tab_title_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .nav-tabs .nav-item .nav-link',
			]
		);

		$this->end_controls_tab(); //End Normal Tab Title

		//=== Hover Tab Title
		$this->start_controls_tab(
			'style_tab_title_hover', [
				'label' => esc_html__( 'Hover', 'spider-elements' ),
			]
		);

		$this->add_control(
			'hover_tab_title_text_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .nav-tabs .nav-item .nav-link:hover' => 'color: {{VALUE}};',
				)
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'hover_tab_title_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .nav-tabs .nav-item .nav-link:hover',
			]
		);

		$this->end_controls_tab(); //End Hover Tab Title

		//=== Active Tab Title
		$this->start_controls_tab(
			'style_tab_title_active', [
				'label' => esc_html__( 'Active', 'spider-elements' ),
			]
		);

		$this->add_control(
			'active_tab_title_text_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .nav-tabs .nav-item .nav-link.active' => 'color: {{VALUE}};',
				)
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(), [
				'name'     => 'active_tab_title_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .nav-tabs .nav-item .nav-link.active'
			]
		);

		$this->add_control(
			'active_tab_title_border_color', [
				'label'     => esc_html__( 'Top Border', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .nav-tabs .nav-item .nav-link:before' => 'background: {{VALUE}};',
				),
				'condition' => [
					'style' => [ '1' ]
				]
			]
		);

		$this->end_controls_tab(); // End Active Tab Title
        $this->end_controls_tabs();

		$this->end_controls_section(); // End Tab Title Style


		//============================ Style Auto Numbering ============================//
        $this->start_controls_section(
            'style_auto_num', [
                'label' => esc_html__( 'Tab Auto Number', 'spider-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'is_auto_numb' => 'yes'
                ]
            ]
        );

        $this->start_controls_tabs(
            'auto_num_style_tabs'
        );

        //===== Normal Tab
        $this->start_controls_tab(
            'style_tab_normal_auto_num', [
                'label' => esc_html__( 'Normal', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'normal_tab_title_auto_num_color', [
                'label' => esc_html__( 'Text Color', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav-tabs .nav-item .nav-link .numb' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'normal_tab_title_auto_num_bg_color', [
                'label' => esc_html__( 'Background Color', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav-tabs .nav-item .nav-link .numb' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab(); //End Normal Tab

        //===== Hover Tab
        $this->start_controls_tab(
            'style_tab_active_auto_num',
            [
                'label' => esc_html__( 'Active', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'active_tab_title_auto_num_color', [
                'label' => esc_html__( 'Text Color', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav-tabs .nav-item .nav-link.active .numb' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'active_tab_title_auto_num_bg_color', [
                'label' => esc_html__( 'Background Color', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .nav-tabs .nav-item .nav-link.active .numb' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab(); // End Hover Tab

        $this->end_controls_tabs(); // End Style Tabs

        $this->end_controls_section(); //End Auto Numbering


		//============================ Tab ProgressBar Style ============================//
		$this->start_controls_section(
			'style_tabs_progressbar',
			[
				'label' => esc_html__( 'Tab ProgressBar', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'is_auto_play' => 'yes',
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'progressbar_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' =>
					'{{WRAPPER}} .tab_auto_play .nav-item .nav-link .progress-bar,{{WRAPPER}} .tab_auto_play .nav-item .nav-link.active .tab_progress:before',

			]
		);
		$this->add_responsive_control(
			'progressbar_height', [
				'label'      => esc_html__( 'Progress Bar Hegiht', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 10,
					],
					'%'  => [
						'min' => 0,
						'max' => 10,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => '2',
				],
				'selectors'  => [
					'{{WRAPPER}} .tab_auto_play .nav-item .nav-link .progress-bar,{{WRAPPER}} .tab_auto_play .nav-item .nav-link .tab_progress' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		//=============================== Content Section ===============================//
		$this->start_controls_section(
			'style_content', [
				'label' => esc_html__( 'Contents', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'tabs_content_typo',
				'selector'  => '{{WRAPPER}} .tab-content .tab_style',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tabs_content_text_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .tab-content .tab_style' => 'color: {{VALUE}}',
				)
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(), [
				'name'     => 'content_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tab-content',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'tabs_border',
				'label'    => esc_html__( 'Border', 'spider-elements' ),
				'selector' => '{{WRAPPER}} .tab-content',
			]
		);

		$this->add_responsive_control(
			'content_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tab-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'content_padding', [
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // End Content Section


		//=============================== Style Navigation Arrow ===============================//
		$this->start_controls_section(
			'style_nav_arrow', [
				'label'     => esc_html__( 'Navigation Arrow', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'is_navigation_arrow' => 'yes',
				],
			]
		);

        $this->start_controls_tabs(
            'nav_arrow_style_tabs'
        );

        //===== Normal Tab
        $this->start_controls_tab(
            'style_tab_normal_nav_arrow', [
                'label' => esc_html__( 'Normal', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'normal_nav_arrow_color', [
                'label' => esc_html__( 'Color', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-content .tab_arrow_btn i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'normal_nav_arrow_bg_color', [
                'label' => esc_html__( 'Background Color', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-content .tab_arrow_btn' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab(); //End Normal Tab

        //===== Hover Tab
        $this->start_controls_tab(
            'style_tab_hover_nav_arrow',
            [
                'label' => esc_html__( 'Hover', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'hover_nav_arrow_color', [
                'label' => esc_html__( 'Color', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-content .tab_arrow_btn:hover i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'hover_nav_arrow_bg_color', [
                'label' => esc_html__( 'Background Color', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tab-content .tab_arrow_btn:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab(); // End Hover Tab

        $this->end_controls_tabs(); // End Style Tabs

		$this->end_controls_section(); // End Navigation Arrow

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

		$settings = $this->get_settings_for_display();
		extract( $settings ); //extract all settings array to variables converted to name of key

		$tabs   = $this->get_settings_for_display( 'tabs' );
		$id_int = substr( $this->get_id_int(), 0, 3 );

		$navigation_arrow_class = ! empty( $is_navigation_arrow == 'yes' ) ? ' process_tab_shortcode' : '';
		$sticky_tab_class       = ! empty( $is_sticky_tab == 'yes' ) ? ' sticky_tab' : '';
        $tab_auto_class         = !empty( $is_auto_play == 'yes' ) ? ' tab_auto_play' : '';
        $data_auto_play         = ! empty( $is_auto_play == 'yes' ) ? ' data-autoplay="yes"' : '';


		//================= Template Parts =================//
		include "templates/tabs/tab-{$settings['style']}.php";

	}


}