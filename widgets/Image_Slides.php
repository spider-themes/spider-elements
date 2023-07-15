<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Flip Box
 * @package spider\Widgets
 * @since 1.0.0
 */
class Image_Slides extends Widget_Base {

	public function get_name() {
		return 'docy_image_slides';
	}

	public function get_title() {
		return esc_html__( 'Image Slides', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-tabs se-icon';
	}

	public function get_keywords() {
		return [ 'spider', 'image', 'slider', 'image slider' ];
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'bootstrap', 'elegant-icon', 'se-main', 'slick' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'bootstrap', 'se-el-widgets', 'slick' ];
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
		// $this->elementor_style_control();
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

		//===================== Select Preset ===========================//
        $this->start_controls_section(
            'style_sec', [
                'label' => esc_html__( 'Preset Skins', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'style', [
                'label'   => esc_html__( 'Style', 'spider-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => __( 'Hover Image with content', 'spider-elements' ),
                        'icon' => 'himage1',
                    ],
                    '2' => [
                        'title' => __( 'Hover Image with content', 'spider-elements' ),
                        'icon' => 'himage2',
                    ],
                ],
                'default' => '1',
            ]
        );

        $this->end_controls_section(); //End Select Style

		$this->start_controls_section(
            'spe_slider_images',
            [
                'label' => __('Image Slider Gallery', 'spider-elements'),
            ]
        );
        $this->add_control(
            'spe_slider_image',
            [
                'type' => Controls_Manager::GALLERY,
				'dynamic' => [
					'active' => true,
				],
            ]
        );
		// ============================ Select Style  ===========================//

		$this->end_controls_section();
		
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


        //============================ Tab Style ============================//
		$this->start_controls_section(
			'font_part_style', [
				'label' => __( 'Font Part Style', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_group_control(
			Group_Control_Background::get_type(), [
				'name' => 'font_box__background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .spe_flip_box_inner .font_face',
			]
		);
        
        $this->add_responsive_control(
			'font_box_padding',[
				'label' => __( 'Padding', 'spider-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .spe_flip_box_inner .font_face' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'font_title_typo',
				'selector' => '{{WRAPPER}} .spe_flip_box_inner .font_face h3',
				'separator' => 'before',
			]
		);
        $this->add_control(
            'font_title_color',
            [
                'label' => __( 'Title Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .spe_flip_box_inner .font_face h3' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
			'font_title_margin',[
				'label' => __( 'Title Margin', 'spider-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .spe_flip_box_inner .font_face h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tab_title_hr', [
				'type' => Controls_Manager::DIVIDER,
			]
		);

        $this->end_controls_section();

		//=============================== Content Section ===============================//
		$this->start_controls_section(
			'back_box_style', [
				'label' => __( 'Back Part Style', 'spider-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
			'back_box_pad',[
				'label' => __( 'Padding', 'spider-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .spe_flip_box_inner .back_face' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(), [
				'name' => 'back_box_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .spe_flip_box_inner .back_face',
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'back_title_typo',
				'selector' => '{{WRAPPER}} .spe_flip_box_inner .back_face h3',
				'separator' => 'before',
			]
		);
        $this->add_control(
            'back_title_color',
            [
                'label' => __( 'Title Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .spe_flip_box_inner .back_face h3' => 'color: {{VALUE}};',
                ],
            ]
        );
		$this->add_responsive_control(
			'back_title_margin',[
				'label' => __( 'Title Margin', 'spider-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .spe_flip_box_inner .back_face h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'separator' => 'after',
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'back_content_typo',
				'selector' => '{{WRAPPER}} .spe_flip_box_inner .back_face p',
				'separator' => 'before',
			]
		);
        $this->add_control(
            'back_content_color',
            [
                'label' => __( 'Text Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .spe_flip_box_inner .back_face p' => 'color: {{VALUE}};',
                ],
                'separator' => 'after',
            ]
        );

		$this->end_controls_section(); // End Content Section
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
        include "templates/image-slides/image-slides-{$settings['style']}.php";
    }
}
