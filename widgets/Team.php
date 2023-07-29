<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Class Team
 * @package spider\Widgets
 * @since 1.0.0
 */
class Team extends Widget_Base
{

	public function get_name()
	{
		return 'docy_team';
	}

	public function get_title()
	{
		return esc_html__('Team', 'spider-elements');
	}

	public function get_icon()
	{
		return 'eicon-tabs se-icon';
	}

	public function get_keywords()
	{
		return [ 'spider', 'spider elements', 'team', 'team', 'team widget' ];
	}

	public function get_categories()
	{
		return ['spider-elements'];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends()
	{
		return ['bootstrap', 'elegant-icon','slick', 'slick-theme', 'spe-main'];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends()
	{
		return ['bootstrap', 'spe-el-widgets', 'slick'];
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
	protected function register_controls()
	{
        $this->elementor_content_control();
		$this->team_slider_control();
		// $this->elementor_style_control();
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
				'label' => __('Preset Skins', 'spider-elements'),
			]
		);

		$this->add_control(
			'style',
			[
				'label' 	=> __('Style', 'spider-elements'),
				'type' 		=> Controls_Manager::SELECT,
				'options'	=> [
					'1' 	=> __('Team Style One', 'spider-elements'),
					'2' 	=> __('Team Style Two', 'spider-elements'),
				],
				'default' 	=> '1',
			]
		);

		$this->end_controls_section(); // End Select Style
    }
    public function team_slider_control(){
        //start content layout
        $this->start_controls_section(
            'section_title_control',
            [
                'label' => __('Content', 'spider-elements'),
            ]
        );
        $repeater = new \Elementor\Repeater();
        $repeater-> add_control(
            'team_slider_image', [
                'label' => __('Slider Image', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater-> add_control(
            'team_name', [
                'label' => __('Name', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter Name', 'spider-elements'),
                'default' => __('John Deo', 'spider-elements'),
                'label_block' => true,
            ]
        );
        $repeater-> add_control(
            'team_job_position', [
                'label' => __('Content Text', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => __('Enter text', 'spider-elements'),
                'default' => __('Envato Customer', 'spider-elements'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'team_slider_item',
            [
                'label' => __( 'Team Item', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'prevent_empty' => false,
                'default' => [
                    [
                        'team_slider_image' => __("", "spider-elements"),
                        'team_name' => __('Elizabeth Foster', 'spider-elements'),
                        'team_job_position' => __('UI/UX Designer', 'spider-elements'),
                    ],
                    [
                        'team_slider_image' => __("", "spider-elements"),
                        'team_name' => __('Julie Ake', 'spider-elements'),
                        'team_job_position' => __('Product Designer', 'spider-elements'),
                    ],
                    [
                        'team_slider_image' => __("", "spider-elements"),
                        'team_name' => __('Elizabeth Foster', 'spider-elements'),
                        'team_job_position' => __('UI/UX Designer', 'spider-elements'),
                    ],
                    [
                        'team_slider_image' => __("", "spider-elements"),
                        'team_name' => __('Juan Marko', 'spider-elements'),
                        'team_job_position' => __('Java Developer', 'spider-elements'),
                    ],

                ],
            ]
        );
        $this-> end_controls_section();
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
		extract($settings); //extract all settings array to variables converted to name of key
        $team_id = $this->get_id();
		//================= Template Parts =================//
		include "templates/team/team-{$settings['style']}.php";
	}


}
