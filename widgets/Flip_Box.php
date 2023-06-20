<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

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
class Flip_Box extends Widget_Base {

	public function get_name() {
		return 'docy_flip_box';
	}

	public function get_title() {
		return esc_html__( 'Flip Box', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-tabs se-icon';
	}

	public function get_keywords() {
		return [ 'spider', 'flip', 'box', 'flip box' ];
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'bootstrap', 'elegant-icon', 'se-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'bootstrap', 'se-el-widgets' ];
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

		// ============================ Select Style  ===========================//
		$this->start_controls_section(
			'select_style', [
				'label' => __( 'Preset Skins', 'spider-elements' ),
			]
		);

		$this->add_control(
			'style', [
				'label' => __('Style', 'spider-elements'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'vertical' => __('Vertical', 'spider-elements'),
					'horizontal' => __('Horizontal', 'spider-elements'),
				],
				'default' => 'vertical',
			]
		);

        $this->end_controls_section(); // End Select Style


		// ============================ Font face Content ===========================//
        $this->start_controls_section(
			'section_font', [
				'label' => __( 'Font Part', 'spider-elements' ),
			]
		);
        $this->add_control(
            'font_box_title',
            [
                'label' => __( 'Font Title', 'spider-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Docy cares deeply.'
            ]
        );
        $this->add_control(
            'font_box_image',
            [
                'label' => __( 'Image', 'spider-elements' ),
                'type' => Controls_Manager::MEDIA,
                'separator' => 'before',
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
            ]
        );
        $this->end_controls_section();

        // ============================ Back face Content ===========================//
        $this->start_controls_section(
			'section_back', [
				'label' => __( 'Back Part', 'spider-elements' ),
			]
		);
        $this->add_control(
            'back_box_title',
            [
                'label' => __( 'Back Title', 'spider-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Spider Flipbox build for elementor.'
            ]
        );
        $this->add_control(
            'back_box_content',
            [
                'label' => __( 'Back Description', 'spider-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Spider Flipbox build for elementor.'
            ]
        );
        $this->add_control(
            'back_box_image',
            [
                'label' => __( 'Back Image', 'spider-elements' ),
                'type' => Controls_Manager::MEDIA,
                'separator' => 'before',
                'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
            ]
        );
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
			\Elementor\Group_Control_Background::get_type(), [
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
			\Elementor\Group_Control_Typography::get_type(), [
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
				'type' => \Elementor\Controls_Manager::DIVIDER,
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
			\Elementor\Group_Control_Background::get_type(), [
				'name' => 'back_box_background',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .spe_flip_box_inner .back_face',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
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
			\Elementor\Group_Control_Typography::get_type(), [
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
	 * Package: @banca
	 * Author: spider-themes
	 */
	protected function render() {
        $settings = $this->get_settings_for_display();
        extract( $settings ); //extract all settings array to variables converted to name of key

        //================= Template Parts =================//
        include "templates/flip-box/flip-box-1.php";
    }
}
