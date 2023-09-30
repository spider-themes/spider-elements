<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Class Team
 * @package spider\Widgets
 * @since 1.0.0
 */
class Counter extends Widget_Base
{

	public function get_name()
	{
		return 'spe_counter';
	}

	public function get_title()
	{
		return esc_html__('Counter', 'spider-elements');
	}

	public function get_icon()
	{
		return 'eicon-counter spe-icon';
	}

	public function get_keywords()
	{
		return [ 'spider', 'Counter', 'Progress bar', ];
	}

	public function get_categories()
	{
		return ['spider-elements'];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends()
	{
		return ['bootstrap', 'elegant-icon', 'spe-main'];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends()
	{
		return ['bootstrap', 'spe-el-widgets'];
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
	protected function register_controls()
	{
        $this->elementor_content_control();
		$this-> video_style_control();
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
			'spe_counter', [
				'label'	=> __( 'Preset Skin', 'spider-elements' ),
			]
		);

     
		$this->add_control(
			'style', [
				'label'   	=> esc_html__( 'Skin', 'spider-elements' ),
				'type'    	=> Controls_Manager::CHOOSE,
				'options'	=> [
					'1'	=> [
						'title' => __( 'Regular', 'spider-elements' ),
						'icon'  => 'Counter',
					],
					'2' => [
						'title' => __( 'Pro', 'spider-elements' ),
						'icon'  => 'Counter_pro',
					],
				],
				'toggle'  => false,
				'default' => '1',
			]
		);

		$this->end_controls_section(); // End Preset Skin


		// ============================ Counter Content ===========================//
		 $this->start_controls_section(
            'counter_sec', [
                'label' => esc_html__( 'Content', 'spider-elements' ),
            ]
        );


        $this->add_control(
            'counter_title',
            [
                'label' => __('Title', 'spider-elements'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => __('Progress Bar', 'spider-elements'),
                'separator' => 'before',
                'ai' => [
					'active' => false,
				],
            ]
        );

        $this->add_control(
            'counter_title_html_tag',
            [
                'label' => __('Title HTML Tag', 'spider-elements'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => __('H1', 'spider-elements'),
                    'h2' => __('H2', 'spider-elements'),
                    'h3' => __('H3', 'spider-elements'),
                    'h4' => __('H4', 'spider-elements'),
                    'h5' => __('H5', 'spider-elements'),
                    'h6' => __('H6', 'spider-elements'),
                    'div' => __('div', 'spider-elements'),
                    'span' => __('span', 'spider-elements'),
                    'p' => __('p', 'spider-elements'),
                ],
                'default' => 'div',
                'separator' => 'after',
            ]
        );

   

        $this->add_control(
            'counter_value',
            [
                'label' => __('Counter Value', 'spider-elements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 50,
                ],
                // 'condition' => [
                //     'counter_value_type' => 'static',
                // ],
            ]
        );

        $this->add_control(
            'counter_show_count',
            [
                'label' => esc_html__('Display Count', 'spider-elements'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'counter_animation_duration',
            [
                'label' => __('Animation Duration', 'spider-elements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1000,
                        'max' => 10000,
                        'step' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 1500,
                ],
                'separator' => 'before',
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

		//===================== Counter Style ============================//
        
        $this->start_controls_section(
            'counter_section_style_general_circle',
            [
                'label' => __('General', 'spider-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
                // 'condition' => [
                //     'counter_layout' => $circle_general_condition,
                // ],
            ]
        );

        $this->add_control(
            'counter_circle_alignment',
            [
                'label' => __('Alignment', 'spider-elements'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'spider-elements'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'spider-elements'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'spider-elements'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
            ]
        );

        $this->add_control(
            'counter_circle_size',
            [
                'label' => __('Size', 'spider-elements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eael-progressbar-circle' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eael-progressbar-half-circle' => 'width: {{SIZE}}{{UNIT}}; height: calc({{SIZE}} / 2 * 1{{UNIT}});',
                    '{{WRAPPER}} .eael-progressbar-half-circle-after' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .eael-progressbar-circle-shadow' => 'width: calc({{SIZE}}{{UNIT}} + 20px); height: calc({{SIZE}}{{UNIT}} + 20px);',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'counter_circle_bg_color',
            [
                'label' => __('Background Color', 'spider-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .eael-progressbar-circle-inner' => 'background-color: {{VALUE}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'counter_circle_stroke_width',
            [
                'label' => __('Stroke Width', 'spider-elements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 12,
                ],
                'selectors' => [
                    '{{WRAPPER}} .eael-progressbar-circle-inner' => 'border-width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .eael-progressbar-circle-half' => 'border-width: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'counter_circle_stroke_color',
            [
                'label' => __('Stroke Color', 'spider-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#eee',
                'selectors' => [
                    '{{WRAPPER}} .eael-progressbar-circle-inner' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        if (apply_filters('eael/pro_enabled', false)) {
            $circle_fill_color_condition = [
                '{{WRAPPER}} .eael-progressbar-circle-half' => 'border-color: {{VALUE}}',
                '{{WRAPPER}} .eael-progressbar-circle-fill .eael-progressbar-circle-half' => 'background-color: {{VALUE}}',
                '{{WRAPPER}} .eael-progressbar-half-circle-fill .eael-progressbar-circle-half' => 'background-color: {{VALUE}}',
            ];
        } else {
            $circle_fill_color_condition = [
                '{{WRAPPER}} .eael-progressbar-circle-half' => 'border-color: {{VALUE}}',
            ];
        }

        $this->add_control(
            'counter_circle_fill_color',
            [
                'label' => __('Fill Color', 'spider-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => $circle_fill_color_condition,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'counter_circle_box_shadow',
                'label' => __('Box Shadow', 'spider-elements'),
                'selector' => '{{WRAPPER}} .eael-progressbar-circle-shadow',
                // 'condition' => [
                //     'counter_layout' => 'circle',
                // ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        // Import progress bar style controlls
        do_action('add_counter_control', $this);

        /**
         * Style Tab: Typography
         */
        $this->start_controls_section(
            'counter_section_style_typography',
            [
                'label' => __('Typography', 'spider-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'counter_title_typography',
                'label' => __('Title', 'spider-elements'),
                'selector' => '{{WRAPPER}} .eael-progressbar-title',
            ]
        );

        $this->add_control(
            'counter_title_color',
            [
                'label' => __('Title Color', 'spider-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eael-progressbar-title' => 'color: {{VALUE}}',
                ],
                'separator' => 'after',
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'counter_count_typography',
                'label' => __('Counter', 'spider-elements'),
                'selector' => '{{WRAPPER}} .eael-progressbar-count-wrap',
            ]
        );

        $this->add_control(
            'counter_count_color',
            [
                'label' => __('Counter Color', 'spider-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eael-progressbar-count-wrap' => 'color: {{VALUE}}',
                ],
                'separator' => 'after',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'counter_after_typography',
                'label' => __('Prefix/Postfix', 'spider-elements'),
                'selector' => '{{WRAPPER}} .eael-progressbar-half-circle-after span',
                'condition' => [
                    'counter_layout' => 'half_circle',
                ],
            ]
        );

        $this->add_control(
            'counter_after_color',
            [
                'label' => __('Prefix/Postfix Color', 'spider-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .eael-progressbar-half-circle-after' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'counter_layout' => 'half_circle',
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
		extract($settings); //extract all settings array to variables converted to name of key
		//================= Template Parts =================//
        include "templates/counter/counter-{$settings['style']}.php";
	}
}
