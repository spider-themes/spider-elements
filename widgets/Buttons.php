<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

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
 * @package spider\Widgets
 * @since 1.0.0
 */
class Buttons extends Widget_Base {

    public function get_name() {
        return 'se_buttons';
    }

    public function get_title() {
        return __( 'Buttons', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-button';
    }

    public function get_keywords() {
        return [ '' ];
    }

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
    public function get_style_depends() {
        return [ '' ];
    }

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ '' ];
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
        //============================= Filter Options =================================== //
        $this->start_controls_section(
            'buttons_layout', [
                'label' => __('Layout', 'spider-elements'),
            ]
        );

        // Style
        $this->add_control(
            'style', [
                'label'   => esc_html__( 'Style', 'spider-elements' ),
                'type'    => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => [
                    '1' => esc_html__( '01: Scroll Button', 'spider-elements' )
                ],
                'default' => '1',
            ]
        );

        $this->add_control(
			'se_section_id',
			[
				'label' => esc_html__( 'Section ID', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '#', 'spider-elements' ),
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
	 * Since: @1.0.0
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
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
    protected function render() {

        $settings = $this->get_settings_for_display();
        extract($settings); // extract all settings array to variables converted to name of key


        //================= Template Parts =================//
        include "templates/buttons/button-{$settings['style']}.php";

    }
}