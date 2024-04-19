<?php
/**
 * Use namespace to avoid conflict
 */

namespace SPEL\Widgets;

use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Alerts_box
 * @package spider\Widgets
 * @since 1.0.0
 */
class Alerts_Box extends Widget_Base {

	public function get_name() {
		return 'docly_alerts_box'; // ID of the widget (Don't change this name)
	}

	public function get_title() {
		return esc_html__( 'Alerts Box', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-alert spel-icon';
	}

	public function get_keywords() {
		return [
			'spider',
			'spider elements',
			'alert',
			'notice',
			'message',
			'warning',
			'info',
			'success',
			'danger',
			'note',
			'note with icon',
			'explanation',
			'dual box notice',
			'block notice'
		];
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'spel-main' ];
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


		//====================== Alert/Note ======================//
		$this->start_controls_section(
			'section_alert', [
				'label' => esc_html__( 'Alert/Note', 'spider-elements' ),
			]
		);

		$this->add_control(
			'display_type', [
				'label'   => esc_html__( 'Display Type', 'spider-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'alert',
				'options' => [
					'alert'          => esc_html__( 'Alert Box', 'spider-elements' ),
					'note'           => esc_html__( 'Note', 'spider-elements' ),
					'note-with-icon' => esc_html__( 'Note With Icon', 'spider-elements' ),
					'explanation'    => esc_html__( 'Explanation', 'spider-elements' ),
					'dual-box'       => esc_html__( 'Dual Box Notice', 'spider-elements' ),
					'block-notice'   => esc_html__( 'Block Notice', 'spider-elements' ),
				],
			]
		);

		$this->add_control(
			'alert_type', [
				'label'          => esc_html__( 'Type', 'spider-elements' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => 'message',
				'options'        => [
					'message' => esc_html__( 'Message', 'spider-elements' ),
					'warning' => esc_html__( 'Warning', 'spider-elements' ),
					'info'    => esc_html__( 'Info', 'spider-elements' ),
					'success' => esc_html__( 'Success', 'spider-elements' ),
					'danger'  => esc_html__( 'Danger', 'spider-elements' ),
				],
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'alert_title', [
				'label'       => esc_html__( 'Title', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Notice Message! Your message here'
			]
		);

		$this->add_control(
			'alert_description', [
				'label'       => esc_html__( 'Description', 'spider-elements' ),
				'type'        => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);

		$this->add_control(
			'show_dismiss', [
				'label'     => esc_html__( 'Dismiss Button', 'spider-elements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'show',
				'options'   => [
					'show' => esc_html__( 'Show', 'spider-elements' ),
					'hide' => esc_html__( 'Hide', 'spider-elements' ),
				],
				'condition' => [
					'display_type' => [ 'alert' ]
				]
			]
		);

		$this->add_control(
			'icon', [
				'label'     => esc_html__( 'Icon', 'spider-elements' ),
				'type'      => Controls_Manager::ICONS,
				'condition' => [
					'display_type!' => [ 'explanation' ]
				]
			]
		);

		$this->end_controls_section(); // End Alert/Note

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

		//====================== Style Title ======================//
		$this->start_controls_section(
			'style_title', [
				'label' => esc_html__( 'Title', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'typography_title',
				'selector' => '
					{{WRAPPER}} .__title, 
					{{WRAPPER}} .message_alert .title, 
					{{WRAPPER}} .block-notice-wrapper .title,  
					{{WRAPPER}} .nic-content-wrap .note-box h5, 
					{{WRAPPER}} .explanation::after, {{WRAPPER}} .notice h5
				',
			]
		);

		$this->add_control(
			'color_title', [
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .__title'                       => 'color: {{VALUE}};',
					'{{WRAPPER}} .explanation::after'            => 'color: {{VALUE}};',
					'{{WRAPPER}} .block-notice-wrapper .title'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .notice h5'                     => 'color: {{VALUE}};',
					'{{WRAPPER}} .nic-content-wrap .note-box h5' => 'color: {{VALUE}};',
					'{{WRAPPER}} .message_alert .title'          => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'title_background',
				'types'     => [ 'classic', 'gradient' ],
				'exclude'   => [ 'image' ],
				'selector'  => '{{WRAPPER}} .explanation::after',
				'condition' => [
					'display_type'  => [ 'explanation' ],
					'display_type!' => [ 'alert', 'note', 'note-with-icon', 'dual-box', 'block-notice' ]
				]
			]
		);

		$this->end_controls_section(); //End Style Title


		//============================Start Description  Style section =========================//
		$this->start_controls_section(
			'section_type', [
				'label' => esc_html__( 'Alert Description', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'typography_content',
				'selector' => '					
					{{WRAPPER}} .message_alert p,
					{{WRAPPER}} .notice p,
					{{WRAPPER}} .explanation p,
					{{WRAPPER}} .dual-box-wrapper .dual-box-content p, 
					{{WRAPPER}} .nic-content-wrap .note-box p,
					{{WRAPPER}} .block-notice-wrapper .block-notice-body p
					',
			]
		);

		$this->add_control(
			'color_content', [
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .notice p'                                  => 'color: {{VALUE}};',
					'{{WRAPPER}} .explanation p'                             => 'color: {{VALUE}};',
					'{{WRAPPER}} .dual-box-wrapper .dual-box-content p'      => 'color: {{VALUE}};',
					'{{WRAPPER}} .nic-content-wrap .note-box p'              => 'color: {{VALUE}};',
					'{{WRAPPER}} .message_alert p'                           => 'color: {{VALUE}};',
					'{{WRAPPER}} .block-notice-wrapper .block-notice-body p' => 'color: {{VALUE}};',

				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'background',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '
							{{WRAPPER}} .notice,
							{{WRAPPER}} .nic-alert .nic-content-wrap .note-box,
							{{WRAPPER}} .explanation,
							{{WRAPPER}} .message_alert,
							{{WRAPPER}} .block-notice-wrapper, .block-notice-content-wrapper,
							{{WRAPPER}} .dual-box-wrapper
							',
			]
		);

		$this->add_control(
			'border_color', [
				'label'     => esc_html__( 'Border Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .message_alert'                                                                                      => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .explanation::before'                                                                                => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .notice-box'                                                                                         => 'border-color: {{VALUE}};',
//					'{{WRAPPER}} .dual-box-wrapper'              => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .nic-alert .nic-content-wrap .note-box'                                                              => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .block-notice-wrapper.block-notice-message:before, .block-notice-wrapper.block-notice-message:after' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'display_type'  => [ 'explanation', 'alert', 'note', 'note-with-icon', 'block-notice' ],
					'display_type!' => [ 'dual-box' ]
				]
			]
		);

		$this->add_control(
			'border2_color', [
				'label'     => esc_html__( 'Border Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dual-box-wrapper, .dual-box-wrapper .dual-box-content.top-left' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'display_type'  => [ 'dual-box' ],
					'display_type!' => [ 'explanation', 'alert', 'note', 'note-with-icon', 'block-notice' ]
				]
			]
		);

		$this->add_control(
			'border_left-width', [
				'label'     => esc_html__( 'Left Border Width', 'spider-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .notice' => 'border-left-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'display_type' => [ 'note' ]
				]
			]
		);

		$this->add_responsive_control(
			'padding', [
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .message_alert'                              => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .media.notice'                               => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .explanation'                                => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .note-box'                                   => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .dual-box-wrapper .dual-box-content .notice' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .se_box_padding'                             => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dual-layer-alignment', [
				'label'     => esc_html__( 'Layer Alignment', 'spider-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'top-left'     => [
						'title' => esc_html__( 'Top Left', 'spider-elements' ),
						'icon'  => 'fa fa-align-left',
					],
					'top-right'    => [
						'title' => esc_html__( 'Top Right', 'spider-elements' ),
						'icon'  => 'fa fa-align-right',
					],
					'bottom-left'  => [
						'title' => esc_html__( 'Bottom Left', 'spider-elements' ),
						'icon'  => 'fa fa-align-left',
					],
					'bottom-right' => [
						'title' => esc_html__( 'Bottom Right', 'spider-elements' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => 'top-left',
				'toggle'    => true,
				'condition' => [
					'display_type' => [ 'dual-box' ]
				]
			]
		);

		$this->end_controls_section(); // End Style Alert


		//======================== Style Icon ========================//
		$this->start_controls_section(
			'section_icon', [
				'label'     => esc_html__( 'Icon', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type'  => [ 'alert', 'note', 'note-with-icon', 'dual-box', 'block-notice' ],
					'display_type!' => [ 'explanation' ]
				]
			]
		);

		$this->add_control(
			'icons_size', [
				'label'     => esc_html__( 'Size', 'spider-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .fa-bell-slash:before'                         => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dual-box-wrapper .dual-box-content .notice i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'display_type'  => [ 'alert', 'note', 'note-with-icon', 'dual-box', 'block-notice' ],
					'display_type!' => [ 'explanation' ]
				]
			]
		);

		$this->add_control(
			'icon_color', [
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .info-tab .icon-wrapper i'                     => 'color: {{VALUE}};',
					'{{WRAPPER}} .fa-bell-slash:before'                         => 'color: {{VALUE}};',
					'{{WRAPPER}} .dual-box-wrapper .dual-box-content .notice i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'display_type'  => [ 'alert', 'note', 'note-with-icon', 'dual-box', 'block-notice' ],
					'display_type!' => [ 'explanation' ]
				]
			]
		);

		$this->add_control(
			'closeicon_heading', [
				'label'     => esc_html__( 'Close Icon' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'display_type'  => [ 'alert' ],
					'display_type!' => [ 'note', 'note-with-icon', 'explanation', 'dual-box', 'block-notice' ]
				]
			]
		);

		$this->add_control(
			'close_icon_size', [
				'label'     => esc_html__( 'Size', 'spider-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .icon_close:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'display_type'  => [ 'alert' ],
					'display_type!' => [ 'note', 'note-with-icon', 'explanation', 'dual-box', 'block-notice' ]
				]
			]
		);

		$this->add_control(
			'close_icon_color', [
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .icon_close:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'display_type'  => [ 'alert' ],
					'display_type!' => [ 'note', 'note-with-icon', 'explanation', 'dual-box', 'block-notice' ]
				]
			]
		);

		$this->add_control(
			'icon_background',
			[
				'label'     => esc_html__( 'Background Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nic-alert .nic-content-wrap .note-icon' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .block-notice-icon:after'                => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'display_type'  => [ 'note-with-icon', 'block-notice' ],
					'display_type!' => [ 'alert', 'note', 'explanation', 'dual-box' ]
				]
			]
		);

		$this->add_control(
			'icon_after_color',
			[
				'label'     => esc_html__( 'Ribbon Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nic-alert .note-icon .icon-wrapper::after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'display_type'  => [ 'note-with-icon' ],
					'display_type!' => [ 'alert', 'note', 'explanation', 'dual-box', 'block-notice' ]
				]
			]
		);

		$this->end_controls_section(); // End Style Icon

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
		extract( $settings ); // extract all settings array to variables converted to name of key


		//================= Template Parts =================//
		include "templates/alerts-box/alert-box-1.php";

	}
}