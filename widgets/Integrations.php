<?php
/**
 * Use namespace to avoid conflict
 */

namespace SPEL\Widgets;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Team
 * @package spider\Widgets
 * @since 1.0.0
 */
class Integrations extends Widget_Base {

	public function get_name() {
		return 'docy_integrations'; // ID of the widget (Don't change this name)
	}

	public function get_title() {
		return esc_html__( 'Integrations', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-integration spel-icon';
	}

	public function get_keywords() {
		return [ 'spider', 'elements', 'logo', 'client logo', 'circle logo' ];
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'elegant-icon', 'spel-dark-mode', 'spel-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'spel-el-widgets' ];
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
		$this->integration_control();
		$this->integration_style_control();
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
				'label'   => esc_html__( 'Integration Style', 'spider-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'icon'  => 'integration1',
						'title' => esc_html__( '01 : Integration', 'spider-elements' )
					],
					'2' => [
						'icon'  => 'integration2',
						'title' => esc_html__( '02 : Integration', 'spider-elements' ),
					]
				],
				'default' => '1',
			]
		);

		$this->end_controls_section(); // End Select Style
	}

	public function integration_control() {

		//start content layout
		$this->start_controls_section(
			'integration_sec', [
				'label' => esc_html__( 'Integrations', 'spider-elements' ),
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'align_items', [
				'type' => \Elementor\Controls_Manager::HIDDEN,
			]
		);

		$repeater->add_control(
			'integration_image', [
				'label'   => esc_html__( 'Integration Image', 'spider-elements' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->add_control(
			'integration_item', [
				'label'         => esc_html__( 'Integration Item', 'spider-elements' ),
				'type'          => \Elementor\Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'title_field'   => '{{{ align_items }}}',
				'prevent_empty' => false,
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
	public function integration_style_control() {

		$this->start_controls_section(
			'integration_img_style', [
				'label' => esc_html__( 'Integration Image', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'integration_round_bg',
			[
				'label'     => esc_html__( 'Background Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .big-circle .brand-icon' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'integration_border',
				'label'    => esc_html__( 'Border', 'spider-elements' ),
				'selector' => '{{WRAPPER}} .big-circle .brand-icon,{{WRAPPER}} .big-circle',
			]
		);

		$this->add_control(
			'team_img_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],

				'selectors'  => [
					'{{WRAPPER}} .big-circle .brand-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
		//================= Template Parts =================//
		// Whitelist valid style values to prevent Local File Inclusion
		$allowed_styles = [ '1', '2' ];
		$style          = isset( $settings['style'] ) && in_array( $settings['style'], $allowed_styles, true ) ? $settings['style'] : '1';
		include __DIR__ . "/templates/integration/integration-{$style}.php";
	}


}
