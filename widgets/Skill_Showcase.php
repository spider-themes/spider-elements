<?php
/**
 * Use namespace to avoid conflict
 */

namespace Spider_Elements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Class Skill_Showcase
 * @package spider\Widgets
 */
class Skill_Showcase extends Widget_Base {

	public function get_name() {
		return 'spe_skill_showcase_widget'; // ID of the widget (Don't change this name)
	}

	public function get_title() {
		return esc_html__( 'Skill Showcase', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-woo-settings spe-icon';
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'spe-main' ];
	}

	/**
	 * Name: register_controls()
	 * Desc: Register controls for these widgets
	 * Params: no params
	 * Return: @void
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
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	public function elementor_content_control() {

		//=================== Skill Showcase Text ===================//
		$this->start_controls_section(
			'section_skills',
			[
				'label' => esc_html__( 'Skills', 'spider-elements' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'name',
			[
				'label'       => esc_html__( 'Skill Name', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Skill Name', 'spider-elements' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'size',
			[
				'label'   => esc_html__( 'Size', 'spider-elements' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'default' => esc_html__( 'Default', 'spider-elements' ),
					'small'   => esc_html__( 'Small', 'spider-elements' ),
					'big'     => esc_html__( 'Big', 'spider-elements' ),
				],
				'default' => 'default',
			]
		);

		$this->add_control(
			'skills_list',
			[
				'label'       => esc_html__( 'Skills List', 'spider-elements' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'name' => esc_html__( 'Html', 'spider-elements' ),
						'size' => 'default',
					],
					[
						'name' => esc_html__( 'Css', 'spider-elements' ),
						'size' => 'default',
					],
					[
						'name' => esc_html__( 'Java', 'spider-elements' ),
						'size' => 'default',
					]
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();
	} //End Skill Showcase Text


	/**
	 * Name: elementor_style_control()
	 * Desc: Register the Style Tab output on the Elementor editor.
	 * Params: no params
	 * Return: @void
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	public function elementor_style_control() {

		//============================= Skill Showcase Style =============================//
		$this->start_controls_section(
			'skill_showcase_text', [
				'label' => esc_html__( 'Skill Showcase', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'skill_text_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skill-showcase span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'showcase_text_typography',
				'selector' => '{{WRAPPER}} .skill-showcase span',
			]
		);

		$this->end_controls_section();

	} //End Skill Showcase style


	/**
	 * Name: elementor_render()
	 * Desc: Render the widget output on the frontend.
	 * Params: no params
	 * Return: @void
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( !empty( $settings['skills_list'] ) ) {
            echo '<div class="col-lg-5 offset-lg-2 col-md-6 text-end wow fadeInRight">';
            echo '<div class="skill-showcase">';
            foreach ( $settings['skills_list'] as $skill ) {
                if ( $skill['size'] === 'default' ) {
                    echo '<span>' . esc_html( $skill['name'] ) . '</span>';
                } elseif ( $skill['size'] === 'small' ) {
                    echo '<span class="small">' . esc_html( $skill['name'] ) . '</span>';
                } elseif ( $skill['size'] === 'big' ) {
                    echo '<span class="big">' . esc_html( $skill['name'] ) . '</span>';
                }
            }
            echo '</div>';
            echo '</div>';
		}
	}

}