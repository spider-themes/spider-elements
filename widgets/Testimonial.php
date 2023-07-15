<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Testimonial
 * @package spider\Widgets
 */
class Testimonial extends Widget_Base {

    public function get_name() {
        return 'docy_testimonial';
    }

    public function get_title() {
        return __( 'Testimonial', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel se-icon';
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
    public function get_style_depends() {
        return [ 'se-el-editor', 'bootstrap', 'slick', 'slick-theme', 'se-main' ];
    }

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
    public function get_script_depends() {
        return [ 'slick', 'se-el-widgets' ];
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

		//========================= Select Style ======================//
		$this->start_controls_section(
			'select_style', [
				'label' => esc_html__( 'Preset Skins', 'spider-elements' ),
			]
		);

		$this->add_control(
			'style', [
				'label' => esc_html__( 'Testimonials', 'spider-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'icon' => 'testimonial1',
						'title' => esc_html__( '01 : Carousel Testimonials', 'spider-elements')
					],
					'2' => [
						'icon' => 'testimonial2',
						'title' => esc_html__( '02 : Carousel Testimonials', 'spider-elements'),
					]
				],
				'default' => '1',
			]
		);

		$this->end_controls_section(); // End Style


		//============================ Testimonials =========================//
		$this->start_controls_section(
			'sec_testimonials', [
				'label' => __( 'Testimonials', 'spider-elements' ),
			]
		);

		//=== Testimonials 01
		$testimonial = new Repeater();
		$testimonial->add_control(
			'author_image', [
				'label' => __( 'Author Image', 'spider-elements' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$testimonial->add_control(
			'name', [
				'label' => __( 'Name', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Mark Tony' , 'spider-elements' ),
			]
		);

		$testimonial->add_control(
			'designation', [
				'label' => __( 'Designation', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Software Developer' , 'spider-elements' ),
			]
		);

		$testimonial->add_control(
			'review_content', [
				'label' => __( 'Review Content', 'spider-elements' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);

		$testimonial->add_control(
			'signature', [
				'label' => __( 'Signature', 'spider-elements' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'testimonials', [
				'label' => __( 'Testimonials', 'spider-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $testimonial->get_controls(),
				'title_field' => '{{{ name }}}',
				'prevent_empty' => false,
				'default' => [
					[
						'name' => esc_html__( 'Mark Tony', 'textdomain' ),
						'designation' => esc_html__( 'Software Developer', 'textdomain' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'textdomain' ),
					],
					[
						'name' => esc_html__( 'Mark Tony', 'textdomain' ),
						'designation' => esc_html__( 'App Developer', 'textdomain' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'textdomain' ),
					],
					[
						'name' => esc_html__( 'Mark Tony', 'textdomain' ),
						'designation' => esc_html__( 'UI/UX Designer', 'textdomain' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'textdomain' ),
					],
				],
				'condition' => [
					'style' => '1'
				]
			]
		); // End Testimonials 01


		//=== Testimonials 02
		$testimonial2 = new Repeater();
		$testimonial2->add_control(
			'author_image', [
				'label' => __( 'Author Image', 'spider-elements' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$testimonial2->add_control(
			'name', [
				'label' => __( 'Name', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Mark Tony' , 'spider-elements' ),
			]
		);

		$testimonial2->add_control(
			'designation', [
				'label' => __( 'Designation', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Software Developer' , 'spider-elements' ),
			]
		);

		$testimonial2->add_control(
			'review_content', [
				'label' => __( 'Testimonial Text', 'spider-elements' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'testimonials2', [
				'label' => __( 'Testimonials', 'spider-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $testimonial2->get_controls(),
				'title_field' => '{{{ name }}}',
				'prevent_empty' => false,
				'default' => [
					[
						'name' => esc_html__( 'Mark Tony', 'textdomain' ),
						'designation' => esc_html__( 'Software Developer', 'textdomain' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'textdomain' ),
					],
					[
						'name' => esc_html__( 'Mark Tony', 'textdomain' ),
						'designation' => esc_html__( 'App Developer', 'textdomain' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'textdomain' ),
					],
					[
						'name' => esc_html__( 'Mark Tony', 'textdomain' ),
						'designation' => esc_html__( 'UI/UX Designer', 'textdomain' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'textdomain' ),
					],
				],
				'condition' => [
					'style' => '2'
				]
			]
		); //End Testimonials 02

		$this->add_control(
			'shape', [
				'label' => __( 'Shape', 'spider-elements' ),
				'type' => Controls_Manager::MEDIA,
				'separator' => 'before',
				'condition' => [
					'style' => '1'
				],
			]
		);

		$this->end_controls_section(); // End Testimonials

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


		//========================= Contents =========================//
		$this->start_controls_section(
			'style_content_sec', [
				'label' => __( 'Contents', 'spider-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//=== Author Name
		$this->add_control(
			'author_name_options', [
				'label' => __( 'Author Name Options', 'spider-elements' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'author_name_color', [
				'label' => __( 'Text Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .se_name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'author_name_typo',
				'selector' => '{{WRAPPER}} .se_name',
			]
		); //End Author Name


		//=== Designation
		$this->add_control(
			'designation_options', [
				'label' => __( 'Designation Options', 'spider-elements' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'designation_color', [
				'label' => __( 'Text Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .se_designation' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'designation_typo',
				'selector' => '{{WRAPPER}} .se_designation',
			]
		); //End Designation


		//=== Review Content
		$this->add_control(
			'review_content_options', [
				'label' => __( 'Review Content Options', 'spider-elements' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'review_content_color', [
				'label' => __( 'Text Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .se_review_content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'review_content_typo',
				'selector' => '{{WRAPPER}} .se_review_content',
			]
		); //End Author Designation


		$this->end_controls_section(); // End Contents

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

		//======================== Template Parts ==========================//
		include "templates/testimonials/testimonial-{$settings['style']}.php";

    }
}