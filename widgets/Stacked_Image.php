<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Stack image Widgets
 */

 class Stacked_Image extends Widget_Base {

    public function get_name() {
        return 'stacked_image';
    }

    public function get_title() {
        return __( 'Stacked Image', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-image-hotspot se-icon';
    }

    public function get_keywords() {
        return [ 'spider', 'stacked_image', 'stacked image'];
    }

    // Get Control ID
    protected function get_control_id( $control_id ) {
        return $control_id;
    }
    
    public function get_categories() {
        return [ 'spider-elements' ];
    }

    // define register controls
    protected function register_controls()
    {
        // layout
        $this-> stackimage_content_control();
        // $this-> stack_image_control();
        $this-> stack_image_style();

         /**
         * Tab: Style
         */
        
    }
    public function stackimage_content_control()
    {

        //===================== Select Preset ===========================//
        $this->start_controls_section(
            'style_sec', [
                'label' => esc_html__( 'Preset Skins', 'landpagy-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label'   => esc_html__( 'Style', 'spider-elements' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__( 'Style 01', 'spider-elements' ),
                    '2' => esc_html__( 'Style 02', 'spider-elements' ),
                    '3' => esc_html__( 'Style 03', 'spider-elements' ),
                    '4' => esc_html__( 'Style 04', 'spider-elements' ),
                ],
                'default' => '1',
            ]
        );

        $this->end_controls_section(); //End Select Style

        $this->start_controls_section(
            'stack_images',
            [
                'label' => __('Stack Image Gallery', 'spider-elements'),
            ]
        );
        $this->add_control(
            'stack_image',
            [
                'type' => Controls_Manager::GALLERY,
				'dynamic' => [
					'active' => true,
				],
            ]
        );

        $this->end_controls_section();
    }

    public function stack_image_style()
    {
        $this->start_controls_section(
            'section_image_style',
            [
                'label' => __( 'Image Style', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'stack_image_alignment',
			[
				'label' => __( 'Image Alignment', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'spider-elements' ),
						'icon' => 'fa fa-align-left',
					],
					'top' => [
						'title' => __( 'Center', 'spider-elements' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'spider-elements' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
			]
		);

        $this->add_responsive_control(
            'stack_image_width',
            [
                'label' => __('Width', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'desktop_default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stack_image' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .imgstack .stack_img' => 'width: {{SIZE}}{{UNIT}};',
                    
                ],
            ]
        );
        $this->add_responsive_control(
            'stack_image_height',
            [
                'label' => __('Height', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .stack_image' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .imgstack .stack_img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'stack_image_padding',
            [
                'label' => __('Padding', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .stack_image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'dl_hotspot_image_border',
                'selector' => '{{WRAPPER}} .stack_image',
            ]
        );

        $this->add_responsive_control(
            'stack_image_border_radius',
            [
                'label' => __('Border Radius', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .stack_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .imgstack .stack_img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_pro_testimonials_box_shadow',
                'label' => __('Box Shadow', 'droit-addons-pro'),
                'selectors' => [
                    '{{WRAPPER}} .stack_image',
                    '{{WRAPPER}} .imgstack .stack_img',
                ],
            ]
        );
        $this->end_controls_section();

    }



    protected function render() {
		$settings = $this->get_settings_for_display();
        extract($settings); //extract all settings array to variables converted to name of key

        //Include template parts
	    include "templates/stack-image/stack-image-{$settings['style']}.php";
	}
}