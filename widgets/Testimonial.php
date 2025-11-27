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
 *
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
		return [ 'slick', 'slick-theme', 'swiper', 'spel-dark-mode', 'spel-main' ];
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
		$this->elementor_style_icon();
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
						'icon'  => 'testimonial6',
						'title' => esc_html__( '03 : Carousel Testimonials', 'spider-elements' ),
					],
					'4'  => [
						'icon'  => 'testimonial7',
						'title' => esc_html__( '04 : Carousel Testimonials', 'spider-elements' ),
					],
					'5'  => [
						'icon'  => 'testimonial8',
						'title' => esc_html__( '05 : Carousel Testimonials', 'spider-elements' ),
					],
					'6'  => [
						'icon'  => 'testimonial9',
						'title' => esc_html__( '06 : Carousel Testimonials', 'spider-elements' ),
					],
					'7' => [
						'icon'  => 'testimonial10',
						'title' => esc_html__( '07 : Carousel Testimonials', 'spider-elements' ),
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
			'content', [
				'label' => esc_html__( 'Review Content', 'spider-elements' ),
				'type'  => Controls_Manager::WYSIWYG,
			]
		);

		$testimonial->add_control(
			'signature', [
				'label'   => esc_html__( 'Signature', 'spider-elements' ),
				'type'    => Controls_Manager::MEDIA,
                //'description' => __( '<strong>Note: </strong>This field is applicable for Preset 01', 'spider-elements' ),
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
						'content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”',
							'spider-elements' ),
					],
					[
						'name'           => esc_html__( 'St-rued David', 'spider-elements' ),
						'designation'    => esc_html__( 'App Developer', 'spider-elements' ),
						'content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”',
							'spider-elements' ),
					],
					[
						'name'           => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation'    => esc_html__( 'UI/UX Designer', 'spider-elements' ),
						'content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”',
							'spider-elements' ),
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
			'content', [
				'label' => esc_html__( 'Review Content', 'spider-elements' ),
				'type'  => Controls_Manager::WYSIWYG,
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
						'content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”',
							'spider-elements' ),
					],
					[
						'name'           => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation'    => esc_html__( 'App Developer', 'spider-elements' ),
						'content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”',
							'spider-elements' ),
					],
					[
						'name'           => esc_html__( 'Mark Tony', 'spider-elements' ),
						'designation'    => esc_html__( 'UI/UX Designer', 'spider-elements' ),
						'content' => esc_html__( 'Hendrerit laoreet incidunt molestie eum placeat, neque ridiculus? Maecenas incididunt aperiam tempora cumque quos?”',
							'spider-elements' ),
					],
				],
				'condition'     => [
					'style' => '2'
				]
			]
		); //End Testimonials 02

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
				'description'=> esc_html__('This will only work for Style 7', 'spider-elements'),
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
					'style' => [ '3', '4', '6' ]
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
						'review_content'  => esc_html__( '“Very easy to set-up. I had no experience with hosting before signing up with Jobi but they have made everything seem simple.”',
							'spider-elements' ),
					],
					[
						'author_name'     => esc_html__( 'Karina', 'spider-elements' ),
						'author_position' => esc_html__( 'Lead Designer', 'spider-elements' ),
						'review_content'  => esc_html__( '“Very easy to set-up. I had no experience with hosting before signing up with Jobi but they have made everything seem simple.”',
							'spider-elements' ),
					],
					[
						'author_name'     => esc_html__( 'Karina', 'spider-elements' ),
						'author_position' => esc_html__( 'Lead Designer', 'spider-elements' ),
						'review_content'  => esc_html__( '“Very easy to set-up. I had no experience with hosting before signing up with Jobi but they have made everything seem simple.”',
							'spider-elements' ),
					],
				],
				'condition'     => [
					'style' => [ '5' ]
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
						'review_content'  => esc_html__( '“Very easy to set-up. I had no experience with hosting before signing up with Jobi but they have made everything seem simple.”',
							'spider-elements' ),
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
					'style' => '7'
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
						'review_content'  => esc_html__( '“Very easy to set-up. I had no experience with hosting before signing up with Jobi but they have made everything seem simple.”',
							'spider-elements' ),
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
					'style' => '7'
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
					'style' => [ '3', '4', '6' ]
				],
			],

		);

		$this->add_control(
			'testimonial_ratting_icon',
			[
				'label'        => esc_html__( 'Show Rating', 'spider-elements' ),
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
					'style' => [ '3', '4', '6', '7' ]
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
					'style' => '6'
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
					'{{WRAPPER}} .feedback-block-one'                => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-item'                  => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .feedback-section-four .bg-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
				'selector' => '{{WRAPPER}} .feedback-block-one:hover,
					           {{WRAPPER}} .feedback-section-four .bg-wrapper:hover',
			]
		);

		$this->add_control(
			'relative_hover_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feedback-section-four:hover .bg-wrapper p' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => '7'
				]
			]
		);

		$this->add_control(
			'author_hover_color',
			[
				'label'     => esc_html__( 'Name Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feedback-section-four:hover .bg-wrapper .name' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => '7'
				]
			]
		);

		$this->add_control(
			'testimonial_item_hover_border', [
				'label'     => esc_html__( 'Border Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feedback-block-one:hover'                => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .feedback-section-four .bg-wrapper:hover' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab(); // End testimonial hover  Tab

		$this->end_controls_tabs(); // End Accordion icon Normal/Active/ State
		$this->end_controls_section(); // End Contents Style


		//========================= Arrow Icons =======================//
		$this->start_controls_section(
			'arrow_icons_sec', [
				'label'     => esc_html__( 'Arrow Icon', 'spider-elements' ),
				'condition' => [
					'style' => [ '3', '4', '5', '7' ]
				]
			]
		);

		$this->add_control(
			'prev_arrow_icon', [
				'label'   => esc_html__( 'Prev Icon', 'spider-elements' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'arrow_carrot-left',
					'library' => 'ElegantIcons'
				],
			]
		);

		$this->add_control(
			'next_arrow_icon', [
				'label'   => esc_html__( 'Next Icon', 'spider-elements' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'arrow_carrot-right',
					'library' => 'ElegantIcons'
				],
			]
		);

		$this->end_controls_section(); //End Arrow Icons

	}


	public function elementor_style_control() {
		//========================= Contents =========================//
		$this->start_controls_section(
			'style_content_sec', [
				'label' => esc_html__( 'Contents', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

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
				'selector' => '{{WRAPPER}} .se_review_content p,
                                {{WRAPPER}} .se_review_content,
								{{WRAPPER}} .feedback-block-one h3,
								{{WRAPPER}} #feedBack_carousel .carousel-inner p,
								{{WRAPPER}} .spel_review_content,
								{{WRAPPER}} .feedback-section-four .bg-wrapper p',
			]
		);

		$this->add_control(
			'review_content_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .se_review_content p'                   => 'color: {{VALUE}};',
					'{{WRAPPER}} .se_review_content'                   => 'color: {{VALUE}};',
					'{{WRAPPER}} .feedback-block-one h3'               => 'color: {{VALUE}};',
					'{{WRAPPER}} #feedBack_carousel .carousel-inner p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .feedback-section-four .bg-wrapper p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .spel_review_content'                 => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .feedback-block-two h3'                        => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .feedback-block-one h3'                        => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .feedback-block-three h3'                      => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .testimonial-slider-inner .testimonial-item p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => [ '3', '4', '6' ]
				]
			]
		);//End Review Content

		//=== Designation
		$this->add_control(
			'designation_options', [
				'label'     => esc_html__( 'Designation', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style' => [ '1', '2', '6', ]
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'      => 'designation_typo',
				'selector'  => '{{WRAPPER}} .se_designation,
								{{WRAPPER}} .feedback-block-two .block-footer span',
				'condition' => [
					'style' => [ '1', '2','6', '11' ]
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
				],
				'condition' => [
					'style' => [ '1', '2', '6', ]
				]
			]
		);
		//End Designation

		$this->end_controls_section();

		//========================= Contents =========================//
		$this->start_controls_section(
			'style_rating_sec', [
				'label'     => esc_html__( 'Rating', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => [ '3', '4', '6' ]
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
					'style' => [ '3', '4', '6' ]
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
					'style' => [ '3', '4', '6' ]
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
					'style'  => [ '3' ],
					'style!' => [ '4', '6' ]
				]
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'review_border',
				'label'     => esc_html__( 'Top Border', 'spider-elements' ),
				'selector'  => '{{WRAPPER}} .feedback-block-one .review',
				'condition' => [
					'style'  => [ '3' ],
					'style!' => [ '4', '6' ]
				]
			]
		);

		$this->add_control(
			'rating_star_color', [
				'label'     => esc_html__( 'Star Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .feedback-block-one .star-rating i::before'  => 'color: {{VALUE}};',
					'{{WRAPPER}} .feedback-block-three .star-rating i:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style' => [ '3', '4', '6' ]
				]
			]
		);

		$this->end_controls_section();

	}

//	start testimonial style 3, 6, 7 icon section======//
	public function elementor_style_icon() {
		//========================= Contents =========================//
		$this->start_controls_section(
			'testimonial_arrow_style_section', [
				'label'     => esc_html__( 'Arrow Icon', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => [ '3', '4' ]
				]
			]
		);

		$this->add_responsive_control(
			'arrow_icon_size',
			[
				'label'      => esc_html__( 'Size', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min' => 6,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial_area_nine .navigation .swiper-button-prev:after' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .testimonial_area_nine .navigation .swiper-button-next:after' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .feedback_section_one .slick-arrow-one li i' => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .feedback-section-seven .slick-arrow-one li i' => 'font-size: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'arrow_icon_gaps',
			[
				'label'       => esc_html__( 'Gap', 'spider-elements' ),
				'type'        => \Elementor\Controls_Manager::SLIDER,
				'description' => esc_html__( 'Set the gap between icon.', 'spider-elements' ),
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .feedback-section-seven .slick-arrow-one' => 'column-gap: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .feedback_section_one .slick-arrow-one' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'style' => [ '3', '4' ]
				]
			]
		);

		//testimonial arrow icon normal/hover style tabs
		$this->start_controls_tabs(
			'testimonial_arrow_icon_style_tabs'
		);

		$this->start_controls_tab(
			'arrow_icon_normal_style',
			[
				'label' => esc_html__( 'Normal', 'spider-elements' ),
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial_area_nine .navigation .swiper-button-prev:after, .testimonial_area_nine .navigation .swiper-button-next:after' => 'color: {{VALUE}}',
					'{{WRAPPER}} .feedback_section_one .slick-arrow-one li i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .feedback-section-seven .slick-arrow-one li i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label'     => esc_html__( 'Background', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial_area_nine .navigation .swiper-button-prev' => 'background: {{VALUE}}',
					'{{WRAPPER}} .testimonial_area_nine .navigation .swiper-button-next' => 'background: {{VALUE}}',
					'{{WRAPPER}} .feedback_section_one .slick-arrow-one li' => 'background: {{VALUE}}',
					'{{WRAPPER}} .feedback-section-seven .slick-arrow-one li' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab(); //end normal tab

		//testimonial arrow icon hover style
		$this->start_controls_tab(
			'arrow_icon_hover_style',
			[
				'label' => esc_html__( 'Hover', 'spider-elements' ),
			]
		);

		$this->add_control(
			'icon_hover_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial_area_nine .navigation .swiper-button-prev:hover:after, .testimonial_area_nine .navigation .swiper-button-next:hover:after' => 'color: {{VALUE}}',
					'{{WRAPPER}} .feedback_section_one .slick-arrow-one li:hover i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .feedback-section-seven .slick-arrow-one li:hover i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'icon_bg_hover_color',
			[
				'label'     => esc_html__( 'Background', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial_area_nine .navigation .swiper-button-prev:hover' => 'background: {{VALUE}}',
					'{{WRAPPER}} .feedback-section-seven .slick-arrow-one li:hover ' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab(); // end arrow icon hover style
		$this->end_controls_tabs(); //  end icon normal and hover tabs style
		$this->end_controls_section(); //end rrow icon section
	}
//  end testimonial style 3, 6, 7 icon style tab============//


	/**
	 * Print the actual stars and calculate their filling.
	 *
	 * Rating type is float to allow stars-count to be a fraction.
	 * Floored-rating type is int, to represent the rounded-down stars count.
	 * In the `for` loop, the index type is float to allow comparing with the rating value.
	 *
	 * @since  2.3.0
	 * @access protected
	 */
	protected function render_stars( $icon, $dat = 0 ) {
		$rating_data    = $this->get_rating( $dat );
		$rating         = (float) $rating_data[0];
		$floored_rating = floor( $rating );
		$stars_html     = '';

		// Detect if icon is an HTML tag or just a class name
		$is_html_icon = strpos( $icon, '<' ) !== false;

		for ( $stars = 1.0; $stars <= $rating_data[1]; $stars ++ ) {
			$star_class = '';
			if ( $stars <= $floored_rating ) {
				$star_class = 'elementor-star-full';
			} elseif ( $floored_rating + 1 === $stars && $rating !== $floored_rating ) {
				$star_class = 'elementor-star-' . ( $rating - $floored_rating ) * 10;
			} else {
				$star_class = 'elementor-star-empty';
			}

			// If the icon is HTML, output it directly
			if ( $is_html_icon ) {
				$stars_html .= '<i class="' . $star_class . '">' . $icon . '</i>';
			} else {
				// If icon is a class name, use it as a class
				if ( strpos( $icon, '&#' ) === 0 ) {
					// Unicode icon, output as content
					$stars_html .= '<i class="' . $star_class . '">' . html_entity_decode( $icon ) . '</i>';
				} else {
					$stars_html .= '<i class="' . $star_class . ' ' . esc_attr( $icon ) . '"></i>';
				}
			}
		}

		return $stars_html;
	}

	/**
	 * @since  2.3.0
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

