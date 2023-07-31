<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

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
        return __( 'Testimonials', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel se-icon';
    }

	public function get_keywords() {
		return [ 'spider', 'spider elements', 'testimonial' ];
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
    public function get_style_depends() {
        return [ 'bootstrap', 'slick', 'slick-theme', 'se-main', 'swiper-theme' ];
    }

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
    public function get_script_depends() {
        return [ 'slick', 'spe-el-widgets', 'swiper' ];
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
					],
					'3' => [
						'icon' => 'testimonial3',
						'title' => esc_html__( '03 : Carousel Testimonials', 'spider-elements'),
					],
					'4' => [
						'icon' => 'testimonial4',
						'title' => esc_html__( '04 : Carousel Testimonials', 'spider-elements'),
					],
					'5' => [
						'icon' => 'testimonial5',
						'title' => esc_html__( '05 : Carousel Testimonials', 'spider-elements'),
					],
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
						'name' => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation' => esc_html__( 'Software Developer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
					[
						'name' => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation' => esc_html__( 'App Developer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
					[
						'name' => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation' => esc_html__( 'UI/UX Designer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
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
						'name' => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation' => esc_html__( 'Software Developer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
					[
						'name' => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation' => esc_html__( 'App Developer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
					[
						'name' => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation' => esc_html__( 'UI/UX Designer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
				],
				'condition' => [
					'style' => '2'
				]
			]
		); //End Testimonials 02

		//=== Testimonials 03
		$testimonial3 = new Repeater();
		$testimonial3->add_control(
			'author_image', [
				'label' => __( 'Author Image', 'spider-elements' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$testimonial3->add_control(
			'name', [
				'label' => __( 'Name', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Mark Tony' , 'spider-elements' ),
			]
		);

		$testimonial3->add_control(
			'designation', [
				'label' => __( 'Designation', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Software Developer' , 'spider-elements' ),
			]
		);

		$testimonial3->add_control(
			'review_content', [
				'label' => __( 'Testimonial Text', 'spider-elements' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'testimonials3', [
				'label' => __( 'Testimonials', 'spider-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $testimonial3->get_controls(),
				'title_field' => '{{{ name }}}',
				'prevent_empty' => false,
				'default' => [
					[
						'name' => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation' => esc_html__( 'Software Developer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
					[
						'name' => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation' => esc_html__( 'App Developer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
					[
						'name' => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation' => esc_html__( 'UI/UX Designer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
				],
				'condition' => [
					'style' => '3'
				]
			]
		); //End Testimonials 03

		//=== Testimonials 04
		$testimonial4 = new Repeater();
		$testimonial4->add_control(
			'author_image', [
				'label' => __( 'Author Image', 'spider-elements' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$testimonial4->add_control(
			'name', [
				'label' => __( 'Name', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Mark Tony' , 'spider-elements' ),
			]
		);

		$testimonial4->add_control(
			'designation', [
				'label' => __( 'Designation', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Software Developer' , 'spider-elements' ),
			]
		);

		$testimonial4->add_control(
			'review_content', [
				'label' => __( 'Testimonial Text', 'spider-elements' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);

		$testimonial4->add_control(
			'c_logo', [
				'label' => __( 'Company Logo', 'spider-elements' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'testimonials4', [
				'label' => __( 'Testimonials', 'spider-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $testimonial4->get_controls(),
				'title_field' => '{{{ name }}}',
				'prevent_empty' => false,
				'default' => [
					[
						'name' => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation' => esc_html__( 'Software Developer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
					[
						'name' => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation' => esc_html__( 'App Developer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
					[
						'name' => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation' => esc_html__( 'UI/UX Designer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
				],
				'condition' => [
					'style' => '4'
				]
			]
		); //End Testimonials 04

		//=== Testimonials 05
		$testimonial5 = new Repeater();
		$testimonial5->add_control(
			'author_image', [
				'label' => __( 'Author Image', 'spider-elements' ),
				'type' => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$testimonial5->add_control(
			'company_name', [
				'label' => __( 'Company Name', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Karina' , 'spider-elements' ),
			]
		);

		$testimonial5->add_control(
			'review_content', [
				'label' => __( 'Testimonial Text', 'spider-elements' ),
				'type' => Controls_Manager::TEXTAREA,
			]
		);

		$testimonial5->add_control(
			'title', [
				'label' => __( 'Title', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Madelyn Press' , 'spider-elements' ),
			]
		);

		$testimonial5->add_control(
			'name', [
				'label' => __( 'Name', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Mark Tony' , 'spider-elements' ),
			]
		);

		$this->add_control(
			'testimonials5', [
				'label' => __( 'Testimonials', 'spider-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $testimonial5->get_controls(),
				'title_field' => '{{{ name }}}',
				'prevent_empty' => false,
				'default' => [
					[
						'name' => esc_html__( 'Mark Tony', 'spider-elements' ),
						'company_name' => esc_html__( 'Karina', 'spider-elements' ),
						'title' => esc_html__( 'Madelyn Press', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
				],
				'condition' => [
					'style' => '5'
				]
			]
		); //End Testimonials 05

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

		$this->add_control(
			'quote_icon',
			[
				'label' => esc_html__( 'Quote Icon', 'spider-elements' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'style' => '4'
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