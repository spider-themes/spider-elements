<?php
/**
 * Use namespace to avoid conflict
 */

namespace Spider_Elements\Widgets;

use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Alerts_box
 */
class Buttons extends Widget_Base {

	public function get_name() {
		return 'spe_buttons'; // ID of the widget (Don't change this name)
	}

	public function get_title() {
		return esc_html__( 'Button', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-button spel-icon';
	}

	public function get_categories() {
		return [ 'spider-elements' ];
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
		//============================= Filter Options =================================== //
		$this->start_controls_section(
			'buttons_layout', [
				'label' => esc_html__( 'Layout', 'spider-elements' ),
			]
		);

		// Style
		$this->add_control(
			'style', [
				'label'       => esc_html__( 'Style', 'spider-elements' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'options'     => [
					'1' => esc_html__( '01: Scroll Button', 'spider-elements' )
				],
				'default'     => '1',
			]
		);

		$this->add_control(
			'section_id',
			[
				'label'       => esc_html__( 'Section ID', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Type your section ID here', 'spider-elements' ),
			]
		);

		$this->end_controls_section(); //End Filter

	}


	/**
	 * Name: elementor_style_control()
	 * Desc: Register the Style Tab output on the Elementor editor.
	 * Params: no params
	 * Return: @void
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	public function elementor_style_control() {

	}


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
		extract( $settings ); // extract all settings array to variables converted to name of key

		//================= Template Parts =================//
		include "templates/buttons/button-{$settings['style']}.php";

	}
}