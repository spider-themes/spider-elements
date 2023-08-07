<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Controls_Manager;



if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Class Timeline
 * @package spider\Widgets
 */
class Marquee_Slides extends Widget_Base {

   
    public function get_name() {
        return 'spe_marquee_slides';
    }

    public function get_title() {
        return 'Marquee Slides';
    }

    public function get_icon() {
        return ' eicon-slider-push spe-icon';
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

  	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
    public function get_style_depends() {
        return [ 'bootstrap', 'spe-main', 'slick' ];
    }

    /**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
    public function get_script_depends() {
        return [ 'slick', 'spe-el-widgets'];
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
    protected function elementor_content_control() {

        //========================= preset Style ======================//
		$this->start_controls_section(
			'select_marquee_style', [
				'label' => esc_html__( 'Preset Skins', 'spider-elements' ),
			]
		);

        $this->add_control(
			'style', [
				'label'		=> esc_html__( 'Marquee Slides', 'spider-elements' ),
				'type' 		=> Controls_Manager::CHOOSE,
				'options'	=> [
					'1' => [
						'icon' 	=> 'marquee1',
						'title'	=> esc_html__( '01 : Marquee Slides', 'spider-elements')
					],
					'2' => [
						'icon' 	=> 'marquee2',
						'title'	=> esc_html__( '02 : Marquee Slides', 'spider-elements'),
					],
				],
				'default' => '1',
			]
		);

		$this->end_controls_section(); // End Preset style


        //===================== Marquee slides item =======================//
        $this->start_controls_section(
            'marquee_images',
            [
                'label' => __( 'Images', 'spider-elements' ),
            ]
        );

        $this->add_control(
			'right_slides',
			[
				'label' => esc_html__( 'Right Slides', 'spider-elements'),
				'type' => Controls_Manager::GALLERY,
				'show_label' => true,
			]
		);

        $this->add_control(
			'left_slides',
			[
				'label' => esc_html__( 'Left Slide', 'spider-elements'),
				'type' => Controls_Manager::GALLERY,
				'show_label' => true,
			]
		);
        
        $this->end_controls_section(); //End Marquee Slides Item 
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
        //======================== Template Parts ==========================//
		include "templates/marquee/marquee-{$settings['style']}.php";
    }
}





























