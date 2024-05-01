<?php

namespace SPEL\Widgets;

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
		return 'docy_testimonial'; // ID of the widget (Don't change this name)
	}

	public function get_title() {
		return esc_html__( 'Testimonials', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-testimonial-carousel spel-icon';
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
		return [ 'slick', 'slick-theme', 'swiper', 'spel-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'slick', 'swiper', 'wow', 'spel-el-widgets' ];
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
		$this->elementor_rating_controls();
		$this->elementor_general_style();
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
				'label'   => esc_html__( 'Testimonials', 'spider-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'1'  => [
						'icon'  => 'testimonial1',
						'title' => esc_html__( '01 : Carousel Testimonials', 'spider-elements' )
					],
					'2'  => [
						'icon'  => 'testimonial2',
						'title' => esc_html__( '02 : Carousel Testimonials', 'spider-elements' ),
					],
					'3'  => [
						'icon'  => 'testimonial3',
						'title' => esc_html__( '03 : Carousel Testimonials', 'spider-elements' ),
					],
					'4'  => [
						'icon'  => 'testimonial4',
						'title' => esc_html__( '04 : Carousel Testimonials', 'spider-elements' ),
					],
					'5'  => [
						'icon'  => 'testimonial5',
						'title' => esc_html__( '05 : Carousel Testimonials', 'spider-elements' ),
					],
					'6'  => [
						'icon'  => 'testimonial6',
						'title' => esc_html__( '06 : Carousel Testimonials', 'spider-elements' ),
					],
					'7'  => [
						'icon'  => 'testimonial7',
						'title' => esc_html__( '07 : Carousel Testimonials', 'spider-elements' ),
					],
					'8'  => [
						'icon'  => 'testimonial8',
						'title' => esc_html__( '08 : Carousel Testimonials', 'spider-elements' ),
					],
					'9'  => [
						'icon'  => 'testimonial9',
						'title' => esc_html__( '09 : Carousel Testimonials', 'spider-elements' ),
					],
					'10' => [
						'icon'  => 'testimonial10',
						'title' => esc_html__( '10 : Carousel Testimonials', 'spider-elements' ),
					],
					'11' => [
						'icon'  => 'testimonial11',
						'title' => esc_html__( '11 : Carousel Testimonials', 'spider-elements' ),
					],
				],
				'default' => '1',
			]
		);

		$this->end_controls_section(); // End Style


		//============================ Testimonials =========================//
		$this->start_controls_section(
			'sec_testimonials', [
				'label' => esc_html__( 'Testimonials', 'spider-elements' ),
			]
		);

		//=== Testimonials 01
		$testimonial = new Repeater();
		$testimonial->add_control(
			'author_image', [
				'label'   => esc_html__( 'Author Image', 'spider-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$testimonial->add_control(
			'name', [
				'label'   => esc_html__( 'Name', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Mark Tony', 'spider-elements' ),
			]
		);

		$testimonial->add_control(
			'designation', [
				'label'   => esc_html__( 'Designation', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Software Developer', 'spider-elements' ),
			]
		);

		$testimonial->add_control(
			'review_content', [
				'label' => esc_html__( 'Review Content', 'spider-elements' ),
				'type'  => Controls_Manager::TEXTAREA,
			]
		);

		$testimonial->add_control(
			'signature', [
				'label'   => esc_html__( 'Signature', 'spider-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'testimonials', [
				'label'         => esc_html__( 'Testimonials', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $testimonial->get_controls(),
				'title_field'   => '{{{ name }}}',
				'prevent_empty' => false,
				'default'       => [
					[
						'name'           => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation'    => esc_html__( 'Software Developer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
					[
						'name'           => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation'    => esc_html__( 'App Developer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
					[
						'name'           => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation'    => esc_html__( 'UI/UX Designer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
				],
				'condition'     => [
					'style' => '1'
				]
			]
		); // End Testimonials 01


		//=== Testimonials 02
		$testimonial2 = new Repeater();
		$testimonial2->add_control(
			'author_image', [
				'label'   => esc_html__( 'Author Image', 'spider-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$testimonial2->add_control(
			'name', [
				'label'   => esc_html__( 'Name', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Mark Tony', 'spider-elements' ),
			]
		);

		$testimonial2->add_control(
			'designation', [
				'label'   => esc_html__( 'Designation', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Software Developer', 'spider-elements' ),
			]
		);

		$testimonial2->add_control(
			'review_content', [
				'label' => esc_html__( 'Testimonial Text', 'spider-elements' ),
				'type'  => Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'testimonials2', [
				'label'         => esc_html__( 'Testimonials', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $testimonial2->get_controls(),
				'title_field'   => '{{{ name }}}',
				'prevent_empty' => false,
				'default'       => [
					[
						'name'           => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation'    => esc_html__( 'Software Developer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
					[
						'name'           => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation'    => esc_html__( 'App Developer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
					[
						'name'           => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation'    => esc_html__( 'UI/UX Designer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
				],
				'condition'     => [
					'style' => '2'
				]
			]
		); //End Testimonials 02

		//=== Testimonials 03
		$testimonial3 = new Repeater();
		$testimonial3->add_control(
			'author_image', [
				'label'   => esc_html__( 'Author Image', 'spider-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$testimonial3->add_control(
			'name', [
				'label'   => esc_html__( 'Name', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Mark Tony', 'spider-elements' ),
			]
		);

		$testimonial3->add_control(
			'designation', [
				'label'   => esc_html__( 'Designation', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Software Developer', 'spider-elements' ),
			]
		);

		$testimonial3->add_control(
			'review_content', [
				'label' => esc_html__( 'Testimonial Text', 'spider-elements' ),
				'type'  => Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'testimonials3', [
				'label'         => esc_html__( 'Testimonials', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $testimonial3->get_controls(),
				'title_field'   => '{{{ name }}}',
				'prevent_empty' => false,
				'default'       => [
					[
						'name'           => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation'    => esc_html__( 'Software Developer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
					[
						'name'           => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation'    => esc_html__( 'App Developer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
					[
						'name'           => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation'    => esc_html__( 'UI/UX Designer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
				],
				'condition'     => [
					'style' => '3'
				]
			]
		);

		//End Testimonials 03

		//=== Testimonials 04
		$testimonial4 = new Repeater();
		$testimonial4->add_control(
			'author_image', [
				'label'   => esc_html__( 'Author Image', 'spider-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$testimonial4->add_control(
			'name', [
				'label'   => esc_html__( 'Name', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Mark Tony', 'spider-elements' ),
			]
		);

		$testimonial4->add_control(
			'designation', [
				'label'   => esc_html__( 'Designation', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Software Developer', 'spider-elements' ),
			]
		);

		$testimonial4->add_control(
			'review_content', [
				'label' => esc_html__( 'Testimonial Text', 'spider-elements' ),
				'type'  => Controls_Manager::TEXTAREA,
			]
		);

		$testimonial4->add_control(
			'c_logo', [
				'label'   => esc_html__( 'Company Logo', 'spider-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'testimonials4', [
				'label'         => esc_html__( 'Testimonials', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $testimonial4->get_controls(),
				'title_field'   => '{{{ name }}}',
				'prevent_empty' => false,
				'default'       => [
					[
						'name'           => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation'    => esc_html__( 'Software Developer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
					[
						'name'           => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation'    => esc_html__( 'App Developer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
					[
						'name'           => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation'    => esc_html__( 'UI/UX Designer', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
				],
				'condition'     => [
					'style' => '4'
				]
			]
		); //End Testimonials 04

		//=== Testimonials 05
		$testimonial5 = new Repeater();
		$testimonial5->add_control(
			'author_image', [
				'label'   => esc_html__( 'Author Image', 'spider-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$testimonial5->add_control(
			'company_name', [
				'label'   => esc_html__( 'Company Name', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Karina', 'spider-elements' ),
			]
		);

		$testimonial5->add_control(
			'review_content', [
				'label' => esc_html__( 'Testimonial Text', 'spider-elements' ),
				'type'  => Controls_Manager::TEXTAREA,
			]
		);

		$testimonial5->add_control(
			'title', [
				'label'   => esc_html__( 'Title', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Madelyn Press', 'spider-elements' ),
			]
		);

		$testimonial5->add_control(
			'name', [
				'label'   => esc_html__( 'Name', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Mark Tony', 'spider-elements' ),
			]
		);

		$this->add_control(
			'testimonials5', [
				'label'         => esc_html__( 'Testimonials', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $testimonial5->get_controls(),
				'title_field'   => '{{{ name }}}',
				'prevent_empty' => false,
				'default'       => [
					[
						'name'           => esc_html__( 'Mark Tony', 'spider-elements' ),
						'company_name'   => esc_html__( 'Karina', 'spider-elements' ),
						'title'          => esc_html__( 'Madelyn Press', 'spider-elements' ),
						'review_content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”', 'spider-elements' ),
					],
				],
				'condition'     => [
					'style' => '5'
				]
			]
		); //End Testimonials 05

		//=== Testimonials 06
		$testimonial6 = new Repeater();
		$testimonial6->add_control(
			'author_rating',
			[
				'label'   => esc_html__( 'Rating', 'spider-elements' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 10,
				'step'    => 0.1,
				'default' => 5,
				'dynamic' => [
					'active' => true,
				],
			]
		);
		$testimonial6->add_control(
			'author_rating_title',
			[
				'label'     => esc_html__( 'Title', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::TEXT,
				'separator' => 'before',
				'default'   => esc_html__( '4.8 Awesome', 'spider-elements' ),
			]
		);
		$testimonial6->add_control(
			'company_image', [
				'label'   => esc_html__( 'Company Image', 'spider-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$testimonial6->add_control(
			'review_content', [
				'label' => esc_html__( 'Testimonial Text', 'spider-elements' ),
				'type'  => Controls_Manager::TEXTAREA,
			]
		);
		$testimonial6->add_control(
			'author_name', [
				'label'   => esc_html__( 'Author Name', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Karina', 'spider-elements' ),
			]
		);
		$testimonial6->add_control(
			'author_position', [
				'label'   => esc_html__( 'Author Position', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Lead Designer', 'spider-elements' ),
			]
		);
		$testimonial6->add_control(
			'author_image', [
				'label'   => esc_html__( 'Author Image', 'spider-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'testimonials6', [
				'label'         => esc_html__( 'Testimonials', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $testimonial6->get_controls(),
				'title_field'   => '{{{ name }}}',
				'prevent_empty' => false,
				'default'       => [
					[
						'author_name'     => esc_html__( 'Karina', 'spider-elements' ),
						'author_position' => esc_html__( 'Lead Designer', 'spider-elements' ),
						'review_content'  => esc_html__( '“Seattle opera simplifies Performance planning with deski eSignature.”', 'spider-elements' ),
					],
					[
						'author_name'     => esc_html__( 'Karina', 'spider-elements' ),
						'author_position' => esc_html__( 'Lead Designer', 'spider-elements' ),
						'review_content'  => esc_html__( '“Seattle opera simplifies Performance planning with deski eSignature.”', 'spider-elements' ),
					],
					[
						'author_name'     => esc_html__( 'Karina', 'spider-elements' ),
						'author_position' => esc_html__( 'Lead Designer', 'spider-elements' ),
						'review_content'  => esc_html__( '“Seattle opera simplifies Performance planning with deski eSignature.”', 'spider-elements' ),
					],
				],
				'condition'     => [
					'style' => [ '6', '7', '9' ]
				]
			]
		); //End Testimonials 06

		//=== Testimonials 08
		$testimonial8 = new Repeater();
		$testimonial8->add_control(
			'review_content', [
				'label' => esc_html__( 'Contents', 'spider-elements' ),
				'type'  => Controls_Manager::WYSIWYG,
			]
		);

		$testimonial8->add_control(
			'author_name', [
				'label'   => esc_html__( 'Author Name', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Karina', 'spider-elements' ),
			]
		);
		$testimonial8->add_control(
			'author_position', [
				'label'   => esc_html__( 'Author Position', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Lead Designer', 'spider-elements' ),
			]
		);
		$testimonial8->add_control(
			'author_image', [
				'label'   => esc_html__( 'Author Image', 'spider-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'testimonials8', [
				'label'         => esc_html__( 'Testimonials', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $testimonial8->get_controls(),
				'title_field'   => '{{{ name }}}',
				'prevent_empty' => false,
				'default'       => [
					[
						'author_name'     => esc_html__( 'Karina', 'spider-elements' ),
						'author_position' => esc_html__( 'Italy', 'spider-elements' ),
						'review_content'  => esc_html__( '“Very easy to set-up. I had no experience with hosting before signing up with Jobi but they have made everything seem simple.”', 'spider-elements' ),
					],
					[
						'author_name'     => esc_html__( 'Karina', 'spider-elements' ),
						'author_position' => esc_html__( 'Lead Designer', 'spider-elements' ),
						'review_content'  => esc_html__( '“Seattle opera simplifies Performance planning with deski eSignature.”', 'spider-elements' ),
					],
					[
						'author_name'     => esc_html__( 'Karina', 'spider-elements' ),
						'author_position' => esc_html__( 'Lead Designer', 'spider-elements' ),
						'review_content'  => esc_html__( '“Seattle opera simplifies Performance planning with deski eSignature.”', 'spider-elements' ),
					],
				],
				'condition'     => [
					'style' => [ '8' ]
				]
			]
		); //End Testimonials 08

		//=== Testimonials 10
		$testimonial10 = new Repeater();
		$testimonial10->add_control(
			'review_content', [
				'label' => esc_html__( 'Testimonial Text', 'spider-elements' ),
				'type'  => Controls_Manager::TEXTAREA,
			]
		);
		$testimonial10->add_control(
			'author_name', [
				'label'   => esc_html__( 'Author Name', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Karina', 'spider-elements' ),
			]
		);
		$testimonial10->add_control(
			'author_position', [
				'label'   => esc_html__( 'Author Position', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Lead Designer', 'spider-elements' ),
			]
		);
		$testimonial10->add_control(
			'author_image', [
				'label'   => esc_html__( 'Author Image', 'spider-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'testimonials10', [
				'label'         => esc_html__( 'Testimonials', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $testimonial10->get_controls(),
				'title_field'   => '{{{ name }}}',
				'prevent_empty' => false,
				'default'       => [
					[
						'author_name'     => esc_html__( 'Karina', 'spider-elements' ),
						'author_position' => esc_html__( 'Italy', 'spider-elements' ),
						'review_content'  => esc_html__( '“Very easy to set-up. I had no experience with hosting before signing up with Jobi but they have made everything seem simple.”', 'spider-elements' ),
					],
					[
						'author_name'     => esc_html__( 'Karina', 'spider-elements' ),
						'author_position' => esc_html__( 'Lead Designer', 'spider-elements' ),
						'review_content'  => esc_html__( '“Seattle opera simplifies Performance planning with deski eSignature.”', 'spider-elements' ),
					],
					[
						'author_name'     => esc_html__( 'Karina', 'spider-elements' ),
						'author_position' => esc_html__( 'Lead Designer', 'spider-elements' ),
						'review_content'  => esc_html__( '“Seattle opera simplifies Performance planning with deski eSignature.”', 'spider-elements' ),
					],
				],
				'condition'     => [
					'style' => '10'
				]
			]
		); //End Testimonials 10

		//=== Testimonials 11
		$testimonial11 = new Repeater();
		$testimonial11->add_control(
			'review_content', [
				'label' => esc_html__( 'Testimonial Text', 'spider-elements' ),
				'type'  => Controls_Manager::TEXTAREA,
			]
		);
		$testimonial11->add_control(
			'author_name', [
				'label'   => esc_html__( 'Author Name', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Karina', 'spider-elements' ),
			]
		);
		$testimonial11->add_control(
			'author_position', [
				'label'   => esc_html__( 'Author Position', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Lead Designer', 'spider-elements' ),
			]
		);
		$testimonial11->add_control(
			'author_image', [
				'label'   => esc_html__( 'Author Image', 'spider-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'testimonials11', [
				'label'         => esc_html__( 'Testimonials', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $testimonial11->get_controls(),
				'title_field'   => '{{{ name }}}',
				'prevent_empty' => false,
				'default'       => [
					[
						'author_name'     => esc_html__( 'Karina', 'spider-elements' ),
						'author_position' => esc_html__( 'Italy', 'spider-elements' ),
						'review_content'  => esc_html__( '“Very easy to set-up. I had no experience with hosting before signing up with Jobi but they have made everything seem simple.”', 'spider-elements' ),
					],
					[
						'author_name'     => esc_html__( 'Karina', 'spider-elements' ),
						'author_position' => esc_html__( 'Lead Designer', 'spider-elements' ),
						'review_content'  => esc_html__( '“Seattle opera simplifies Performance planning with deski eSignature.”', 'spider-elements' ),
					],
					[
						'author_name'     => esc_html__( 'Karina', 'spider-elements' ),
						'author_position' => esc_html__( 'Lead Designer', 'spider-elements' ),
						'review_content'  => esc_html__( '“Seattle opera simplifies Performance planning with deski eSignature.”', 'spider-elements' ),
					],
				],
				'condition'     => [
					'style' => '11'
				]
			]
		); //End Testimonials 11


		$this->add_control(
			'shape', [
				'label'     => esc_html__( 'Shape', 'spider-elements' ),
				'type'      => Controls_Manager::MEDIA,
				'separator' => 'before',
				'condition' => [
					'style' => '1'
				],
			]
		);
		$this->add_control(
			'quote_img', [
				'label'     => esc_html__( 'Quote Image', 'spider-elements' ),
				'type'      => Controls_Manager::MEDIA,
				'separator' => 'before',
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'style' => '10'
				],
			]
		);

		$this->add_control(
			'quote_icon',
			[
				'label'     => esc_html__( 'Quote Icon', 'spider-elements' ),
				'type'      => Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'style' => '4'
				],
			]
		);

		$this->end_controls_section(); // End Testimonials

	}

	// Testimonial Repeater
	protected function elementor_rating_controls() {
		$this->start_controls_section(
			'section_rating',
			[
				'label'     => esc_html__( 'Rating', 'spider-elements' ),
				'condition' => [
					'style' => [ '6', '7', '9' ]
				],
			],

		);

		$this->add_control(
			'testimonial_ratting_icon',
			[
				'label'        => esc_html__( 'Show Title', 'spider-elements' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'spider-elements' ),
				'label_off'    => esc_html__( 'Hide', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);


		$this->add_control(
			'rating_scale',
			[
				'label'     => esc_html__( 'Rating Scale', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::SELECT,
				'options'   => [
					'5'  => '0-5',
					'10' => '0-10',
				],
				'default'   => '5',
				'condition' => [
					'testimonial_ratting_icon' => [ 'yes' ],
				],
			]
		);

		$this->add_control(
			'star_style',
			[
				'label'        => esc_html__( 'Icon', 'spider-elements' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'options'      => [
					'star_fontawesome' => 'Font Awesome',
					'star_unicode'     => 'Unicode',
				],
				'default'      => 'star_fontawesome',
				'render_type'  => 'template',
				'prefix_class' => 'elementor--star-style-',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'unmarked_star_style',
			[
				'label'   => esc_html__( 'Unmarked Style', 'spider-elements' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'solid'   => [
						'title' => esc_html__( 'Solid', 'spider-elements' ),
						'icon'  => 'eicon-star',
					],
					'outline' => [
						'title' => esc_html__( 'Outline', 'spider-elements' ),
						'icon'  => 'eicon-star-o',
					],
				],
				'default' => 'solid',
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

	public function elementor_general_style() {
		$this->start_controls_section(
			'style_item_tabs', [
				'label'     => esc_html__( 'Testimonial Item', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => [ '6', '7', '9' ]
				]
			]
		);

		$this->start_controls_tabs(
			'style_testimonial_item_tabs'
		);

		//=== Normal testimonial
		$this->start_controls_tab(
			'style_normal',
			[
				'label' => esc_html__( 'Normal', 'spider-elements' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'testimonial_item_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .feedback-block-one,
							   {{WRAPPER}} .testimonial-item,
							   {{WRAPPER}} .feedback-section-four .bg-wrapper ',
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'background',
				'types'     => [ 'classic', 'gradient', 'video' ],
				'selector'  => '{{WRAPPER}} .testimonial-item,
								{{WRAPPER}} .feedback-section-four .bg-wrapper',
				'condition' => [
					'style'  => [ '5', '10' ],
					'style!' => [ '9' ]
				]
			]
		);

		$this->add_responsive_control(
			'testimonial_item_pad',
			[
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .feedback-block-one' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-item'   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'testimonial_item_mar',
			[
				'label'      => esc_html__( 'Margin', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .feedback-slider-two .item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => '9'
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'item_border',
				'label'    => esc_html__( 'Border', 'spider-elements' ),
				'selector' => '{{WRAPPER}} .feedback-block-one,
							   {{WRAPPER}} .testimonial-item,
							   {{WRAPPER}} .feedback-section-four .bg-wrapper 
				               ',
			]
		);

		$this->add_responsive_control(
			'item_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .feedback-block-one'                => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-item'                  => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .feedback-section-four .bg-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab(); //End Normal  Testimonial


		//=== Hover Testimonial
		$this->start_controls_tab(
			'testimonial_item_hover', [
				'label' => esc_html__( 'Hover', 'spider-elements' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'item_hover_background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .feedback-block-one:hover',
			]
		);

		$this->add_control(
			'testimonial_item_hover_border', [
				'label'     => esc_html__( 'Border Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feedback-block-one:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab(); // End testimonial hover  Tab

		$this->end_controls_tabs(); // End Accordion icon Normal/Active/ State
		$this->end_controls_section(); // End Contents Style
	}


	public function elementor_style_control() {
		//========================= Contents =========================//
		$this->start_controls_section(
			'style_content_sec', [
				'label' => esc_html__( 'Contents', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//=== Title Style
		$this->add_control(
			'title_style', [
				'label'     => esc_html__( 'Title', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style'  => [ '5' ],
					'style!' => [ '1', '2', '3', ]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'      => 'title_typo',
				'selector'  => '{{WRAPPER}} .se_title',
				'condition' => [
					'style'  => [ '5' ],
					'style!' => [ '1', '2', '3', ]
				]
			]
		);

		$this->add_control(
			'title_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .se_title' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style'  => [ '5' ],
					'style!' => [ '1', '2', '3', ]
				]
			]
		);

		//End Title Style

		//=== Author Name
		$this->add_control(
			'author_name_options', [
				'label'     => esc_html__( 'Author Name', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'author_name_typo',
				'selector' => '{{WRAPPER}} .se_name,
								{{WRAPPER}} .feedback-block-one .name,
								{{WRAPPER}} #feedBack_carousel .name,
								{{WRAPPER}} .feedback-section-four .bg-wrapper .name',
			]
		);

		$this->add_control(
			'author_name_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .se_name'                                  => 'color: {{VALUE}};',
					'{{WRAPPER}}  .feedback-block-one .name'                => 'color: {{VALUE}};',
					'{{WRAPPER}}  #feedBack_carousel .name'                 => 'color: {{VALUE}};',
					'{{WRAPPER}}  .feedback-section-four .bg-wrapper .name' => 'color: {{VALUE}};',
				],
			]
		);
		//End Author Name

		//=== Review Content
		$this->add_control(
			'review_content_options', [
				'label'     => esc_html__( 'Review Content', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'review_text_typo',
				'selector' => '{{WRAPPER}} .se_review_content,
								{{WRAPPER}} .feedback-block-one h3,
								{{WRAPPER}} #feedBack_carousel .carousel-inner p,
								{{WRAPPER}} .feedback-section-four .bg-wrapper p',
			]
		);

		$this->add_control(
			'review_content_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .se_review_content'                   => 'color: {{VALUE}};',
					'{{WRAPPER}} .feedback-block-one h3'               => 'color: {{VALUE}};',
					'{{WRAPPER}} #feedBack_carousel .carousel-inner p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .feedback-section-four .bg-wrapper p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'Content_margin',
			[
				'label'      => esc_html__( 'Margin', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .feedback-block-two h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .feedback-block-one h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .feedback-block-three h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => [ '6', '7', '9' ]
				]
			]
		);

		$this->add_control(
			'border_color', [
				'label'     => esc_html__( 'Border Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-slider-inner .testimonial-item' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'style'  => [ '3' ],
					'style!' => [ '1', '2', '4', '5', '6', '7', '8', '9' ]
				]
			]
		);

		//End Review Content

		//=== Category Style
		$this->add_control(
			'category_options', [
				'label'     => esc_html__( 'Category', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => '5'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'      => 'category_typo',
				'selector'  => '{{WRAPPER}} .se_category',
				'condition' => [
					'style' => '5'
				]
			]
		);

		$this->add_control(
			'category_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .se_category' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => '5'
				]
			]
		);//End Category Style


		//=== Designation
		$this->add_control(
			'designation_options', [
				'label'     => esc_html__( 'Designation', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => [ '1', '2', '3', '4', '9', '11' ]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'      => 'designation_typo',
				'selector'  => '{{WRAPPER}} .se_designation,
								{{WRAPPER}} .feedback-block-two .block-footer span,
								{{WRAPPER}} .testimonial-area .author-info p',
				'condition' => [
					'style' => [ '1', '2', '3', '4', '9', '11' ]
				]
			]
		);

		$this->add_control(
			'designation_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .se_designation'                        => 'color: {{VALUE}};',
					'{{WRAPPER}} .feedback-block-two .block-footer span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .testimonial-area .author-info p' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => [ '1', '2', '3', '4', '9', '11' ]
				]
			]
		);

		//End Designation

//		// Item BG color style 5
//		$this->add_control(
//			'item_bg_color', [
//				'label'     => esc_html__( 'Item Background Color', 'spider-elements' ),
//				'type'      => Controls_Manager::HEADING,
//				'separator' => 'before',
//				'condition' => [
//					'style' => [ '5', '10' ]
//				]
//			]
//		);
//
//		$this->add_responsive_control(
//			'feedback-section-four-item-pad',
//			[
//				'label'      => esc_html__( 'Padding', 'spider-elements' ),
//				'type'       => Controls_Manager::DIMENSIONS,
//				'size_units' => [ 'px', '%', 'em' ],
//				'selectors'  => [
//					'{{WRAPPER}} .feedback-section-four .bg-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
//				],
//				'condition'  => [
//					'style' => [ '5', '10' ]
//				]
//			]
//		);

		$this->end_controls_section();

		//========================= Contents =========================//
		$this->start_controls_section(
			'style_rating_sec', [
				'label'     => esc_html__( 'Rating', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => [ '6', '7', '9' ]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'      => 'rating_title_typo',
				'selector'  => '{{WRAPPER}} .feedback-block-one .review .text-md,
							   {{WRAPPER}} .feedback-block-two .review .text-md,
							   {{WRAPPER}} .feedback-block-three .review .text-md',
				'condition' => [
					'style' => [ '6', '7', '9' ]
				]
			]
		);

		$this->add_control(
			'rating_title_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feedback-block-one .review .text-md'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .feedback-block-two .review .text-md'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .feedback-block-three .review .text-md' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => [ '6', '7', '9' ]
				]
			]
		);

		$this->add_responsive_control(
			'rating_pad',
			[
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .feedback-block-one .review' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style'  => [ '6' ],
					'style!' => [ '7', '9' ]
				]
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'review_border',
				'label'     => esc_html__( 'Border', 'spider-elements' ),
				'selector'  => '{{WRAPPER}} .feedback-block-one .review',
				'condition' => [
					'style'  => [ '6' ],
					'style!' => [ '7', '9' ]
				]
			]
		);

		$this->add_control(
			'rating_star_color', [
				'label'     => esc_html__( 'Star Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feedback-block-one .star-rating i::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .feedback-block-three .star-rating i:before'   => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => [ '6', '7', '9' ]
				]
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Print the actual stars and calculate their filling.
	 *
	 * Rating type is float to allow stars-count to be a fraction.
	 * Floored-rating type is int, to represent the rounded-down stars count.
	 * In the `for` loop, the index type is float to allow comparing with the rating value.
	 *
	 * @since 2.3.0
	 * @access protected
	 */
	protected function render_stars( $icon, $dat = 0 ) {
		$rating_data    = $this->get_rating( $dat );
		$rating         = (float) $rating_data[0];
		$floored_rating = floor( $rating );
		$stars_html     = '';

		for ( $stars = 1.0; $stars <= $rating_data[1]; $stars ++ ) {
			if ( $stars <= $floored_rating ) {
				$stars_html .= '<i class="elementor-star-full">' . $icon . '</i>';
			} elseif ( $floored_rating + 1 === $stars && $rating !== $floored_rating ) {
				$stars_html .= '<i class="elementor-star-' . ( $rating - $floored_rating ) * 10 . '">' . $icon . '</i>';
			} else {
				$stars_html .= '<i class="elementor-star-empty">' . $icon . '</i>';
			}
		}

		return $stars_html;
	}

	/**
	 * @since 2.3.0
	 * @access protected
	 */
	protected function get_rating( $ratting ) {
		$settings     = $this->get_settings_for_display();
		$rating_scale = (int) $settings['rating_scale'];
		$rating       = (float) $ratting > $rating_scale ? $rating_scale : $ratting;

		return [ $rating, $rating_scale ];
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
		$icon = '&#xE934;';

		$testimonial_id = $this->get_id();

		//======================== Template Parts ==========================//
		include "templates/testimonials/testimonial-{$settings['style']}.php";

	}
}