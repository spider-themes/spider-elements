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
class Video_popup extends Widget_Base
{

	public function get_name()
	{
		return 'docy_video_popup';
	}

	public function get_title()
	{
		return esc_html__('Video Popup', 'spider-elements');
	}

	public function get_icon()
	{
		return 'eicon-play se-icon';
	}

	public function get_keywords()
	{
		return [ 'spider', 'spider elements', 'video', 'video-popup', 'video-popup widget' ];
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
		return ['bootstrap', 'elegant-icon', 'spe-main'];
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
        // $this->elementor_content_control();
		// $this->team_slider_control();
		// $this-> team_style_control();
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
				'label' 	=> __('Team Style', 'spider-elements'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'icon' => 'team1',
						'title' => esc_html__( '01 : Team Carousel', 'spider-elements')
					],
					'2' => [
						'icon' => 'team2',
						'title' => esc_html__( '02 : Team Carousel', 'spider-elements'),
					]
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
			'team_link',
			[
				'label' => esc_html__( 'Link', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::URL,
				'placeholder' => esc_html__( 'https://your-link.com', 'spider-elements' ),
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
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
	public function team_style_control() {

		$this->start_controls_section(
			'team_img_style', [
				'label' => __( 'Team Image', 'spider-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_responsive_control(
            'team_img_border_radius',
            [
                'label' 		=> __('Border Radius', 'spider-elements'),
                'type' 			=> Controls_Manager::DIMENSIONS,
                'size_units'	=> ['px', '%', 'em'],
                'selectors' 	=> [
                    '{{WRAPPER}} .card-style-three .img-meta img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this-> end_controls_section();
		//========================= Contents =========================//
		$this->start_controls_section(
			'team_style_content', [
				'label' => __( 'Team Contents', 'spider-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);


		$this->start_controls_tabs(
			'style_team_title_tabs'
		);

		//=== Normal icon
		$this->start_controls_tab(
			'style_normal',
			[
				'label' => __('Normal', 'spider-elements'),
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'team_name_typo',
				'selector' => '{{WRAPPER}} .card-style-three .name,{{WRAPPER}} .card-style-eight .name',
			]
		); //End Author Name
		$this->add_control(
			'team_name_color', [
				'label' => __( 'Name Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-style-three .name,{{WRAPPER}} .card-style-eight .name' => 'color: {{VALUE}};',
				],
				'separator' => 'after'
			]
		);

		$this->end_controls_tab(); //End Normal icon
		
		//=== Active icon
		$this->start_controls_tab(
			'team_title_hover', [
				'label' => __('Hover', 'spider-elements'),
			]
		);

		$this->add_control(
			'team_name_hover_color', [
				'label' => __( 'Name Hover Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-style-three .name:hover,{{WRAPPER}} .card-style-eight .name:hover' => 'color: {{VALUE}};',
				],
				'separator' => 'after'
			]
		);

		$this->end_controls_tab(); // End Active Tab Title
		$this->end_controls_tabs(); // End Accordion icon Normal/Active/ State

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'team_position_typo',
				'selector' => '{{WRAPPER}} .card-style-three .post,{{WRAPPER}} .card-style-eight .post',
			]
		); //End Author Name
		$this->add_control(
			'team_position_color', [
				'label' => __( 'Position Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-style-three .post,{{WRAPPER}} .card-style-eight .post' => 'color: {{VALUE}};',
				],
			]
		);
		

		$this-> end_controls_section();
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
		extract($settings); //extract all settings array to variables converted to name of key
		//================= Template Parts =================//
		
	}


}
