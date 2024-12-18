<?php
/**
 * Use namespace to avoid conflict
 */

namespace SPEL\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Team
 *
 * @package spider\Widgets
 * @since   1.0.0
 */
class Team_Carousel extends Widget_Base {

	public function get_name() {
		return 'docy_team_carousel'; // ID of the widget (Don't change this name)
	}

	public function get_title() {
		return esc_html__( 'Team Carousel', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-nested-carousel spel-icon';
	}

	public function get_keywords() {
		return [ 'spider', 'spider elements', 'team', 'team', 'team widget' ];
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'elegant-icon', 'slick', 'slick-theme', 'spel-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'slick', 'spel-el-widgets' ];
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
		$this->team_slider_control();
		$this->team_style_control();
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
			'select_style',
			[
				'label' => esc_html__( 'Preset Skins', 'spider-elements' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Team Style', 'spider-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'icon'  => 'team1',
						'title' => esc_html__( '01 : Team Carousel', 'spider-elements' )
					],
					'2' => [
						'icon'  => 'team2',
						'title' => esc_html__( '02 : Team Carousel', 'spider-elements' ),
					]
				],
				'default' => '1',
			]
		);


		$this->end_controls_section(); // End Select Style
	}

	public function team_slider_control() {
		//start content layout
		$this->start_controls_section(
			'section_title_control',
			[
				'label' => esc_html__( 'Content', 'spider-elements' ),
			]
		);

		//================= Team Slider Item =================//
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'team_slider_image', [
				'label'   => esc_html__( 'Slider Image', 'spider-elements' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'team_name', [
				'label'       => esc_html__( 'Name', 'spider-elements' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Enter Name', 'spider-elements' ),
				'default'     => esc_html__( 'John Deo', 'spider-elements' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'team_link',
			[
				'label'       => esc_html__( 'Link', 'spider-elements' ),
				'type'        => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'spider-elements' ),
				'options'     => [ 'url', 'is_external', 'nofollow' ],
				'default'     => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'team_job_position', [
				'label'       => esc_html__( 'Content Text', 'spider-elements' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__( 'Enter text', 'spider-elements' ),
				'default'     => esc_html__( 'Envato Customer', 'spider-elements' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'team_slider_item',
			[
				'label'         => esc_html__( 'Team Item', 'spider-elements' ),
				'type'          => \Elementor\Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'prevent_empty' => false,
				'default'       => [
					[
						'team_name'         => esc_html__( 'Elizabeth Foster', 'spider-elements' ),
						'team_job_position' => esc_html__( 'UI/UX Designer', 'spider-elements' ),
					],
					[
						'team_name'         => esc_html__( 'Julie Ake', 'spider-elements' ),
						'team_job_position' => esc_html__( 'Product Designer', 'spider-elements' ),
					],
					[
						'team_name'         => esc_html__( 'Elizabeth Foster', 'spider-elements' ),
						'team_job_position' => esc_html__( 'UI/UX Designer', 'spider-elements' ),
					],
					[
						'team_name'         => esc_html__( 'Juan Marko', 'spider-elements' ),
						'team_job_position' => esc_html__( 'Java Developer', 'spider-elements' ),
					],

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
	public function team_style_control() {

		$this->start_controls_section(
			'team_img_style', [
				'label'     => esc_html__( 'Team Image', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => [ '1' ]
				]
			]
		);

		$this->add_responsive_control(
			'team_img_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .card-style-three .img-meta img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();


		//========================= Contents =========================//
		$this->start_controls_section(
			'team_style_content', [
				'label' => esc_html__( 'Team Contents', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'name_heading', [
				'label' => esc_html__( 'Name', 'spider-elements' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->start_controls_tabs(
			'style_team_title_tabs'
		);

		//=== Normal icon
		$this->start_controls_tab(
			'style_normal',
			[
				'label' => esc_html__( 'Normal', 'spider-elements' ),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'team_name_typo',
				'selector' => '{{WRAPPER}} .card-style-three .name,{{WRAPPER}} .card-style-eight .name',
			]
		); //End Author Name
		$this->add_control(
			'team_name_color', [
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-style-three .name,{{WRAPPER}} .card-style-eight .name' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab(); //End Normal icon

		//=== Active icon
		$this->start_controls_tab(
			'team_title_hover', [
				'label' => esc_html__( 'Hover', 'spider-elements' ),
			]
		);

		$this->add_control(
			'team_name_hover_color', [
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-style-three .name:hover,{{WRAPPER}} .card-style-eight .name:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab(); // End Active Tab Title
		$this->end_controls_tabs(); // End Accordion icon Normal/Active/ State

		$this->add_control(
			'designation_heading', [
				'label'     => esc_html__( 'Designation', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'team_position_typo',
				'selector' => '{{WRAPPER}} .card-style-three .post,{{WRAPPER}} .card-style-eight .post',
			]
		); //End Author Name
		$this->add_control(
			'team_position_color', [
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-style-three .post,{{WRAPPER}} .card-style-eight .post' => 'color: {{VALUE}};',
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
		extract( $settings ); //extract all settings array to variables converted to name of key
		$team_id = $this->get_id();
		//================= Template Parts =================//
		include "templates/team/team-{$settings['style']}.php";
	}


}