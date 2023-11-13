<?php
/**
 * Use namespace to avoid conflict
 */

namespace Spider_Elements\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Team
 * @package spider\Widgets
 * @since 1.0.0
 */
class Fullscreen_Slider extends Widget_Base {

	public function get_name() {
		return 'spe_fullscreen_slider';
	}

	public function get_title() {
		return esc_html__( 'Fullscreen Slider', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-counter spe-icon';
	}

	public function get_keywords() {
		return [ 'spider', 'Counter', 'Progress bar', ];
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'bootstrap', 'spe-main', 'swiper-theme', 'swiper' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'bootstrap', 'spe-el-widgets' ];
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
		$this->counter_style_control();
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
		//==================== Select Preset Skin ====================//
		$this->start_controls_section(
			'counter_preset', [
				'label' => __( 'Preset Skin', 'spider-elements' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Style', 'spider-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'icon'  => 'counter1',
						'title' => esc_html__( '01 : Fullscreen Slider', 'spider-elements' )
					],
				],
				'default' => '1',
			]
		);

		$this->end_controls_section(); // End Preset Skin

		//=================== SecCountertion  ===================//
		$this->start_controls_section(
			'sec_sliders', [
				'label' => esc_html__( 'Sliders', 'spider-elements' ),
			]
		);

		$slider = new \Elementor\Repeater();
		$slider->add_control(
			'title', [
				'label'       => esc_html__( 'Title', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'Capturing Beauty <br /><span class="text-stroke">Photo</span>',
				'label_block' => true,
			]
		);

		$slider->add_control(
			'subtitle', [
				'label'       => esc_html__( 'Subtitle', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$slider->add_control(
			'btn_label', [
				'label'   => esc_html__( 'Button Label', 'textdomain' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'View More', 'spider-elements' ),
			]
		);

		$slider->add_control(
			'btn_url', [
				'label'   => esc_html__( 'Button Label', 'textdomain' ),
				'type'    => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '#'
				]
			]
		);

		$slider->add_control(
			'bg_img', [
				'label' => esc_html__( 'Background Image', 'textdomain' ),
				'type'  => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'sliders', [
				'label'         => esc_html__( 'Add Slides', 'textdomain' ),
				'type'          => \Elementor\Controls_Manager::REPEATER,
				'fields'        => $slider->get_controls(),
				'title_field'   => '{{{ title }}}',
				'prevent_empty' => false
			]
		);


		$this->end_controls_section();

	}


	/**
	 * Name: counter_style_control()
	 * Desc: Register the Style Tab output on the Elementor editor.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	public function counter_style_control() {

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
		include "templates/fullscreeen-slider/slider-1.php";
	}
}