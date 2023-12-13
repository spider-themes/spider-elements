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
 * @package spider\Widgets
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
				'default'     => esc_html__('Notice Message! Your message here', 'spider-elements'),
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
				'label' => esc_html__( 'Icon', 'spider-elements' ),
				'type'  => Controls_Manager::ICONS,
			]
		);

		$this->end_controls_section(); // End Alert/Note

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
					{{WRAPPER}} .block-notice-wrapper .title,  
					{{WRAPPER}} .nic-content-wrap .note-box h5, 
					{{WRAPPER}} .explanation::after, {{WRAPPER}} .notice h5
				',
			]
		);

		$this->add_control(
			'color_title', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .__title'                       => 'color: {{VALUE}};',
					'{{WRAPPER}} .explanation::after'            => 'color: {{VALUE}};',
					'{{WRAPPER}} .notice h5'                     => 'color: {{VALUE}};',
					'{{WRAPPER}} .nic-content-wrap .note-box h5' => 'color: {{VALUE}};',
					'{{WRAPPER}} .message_alert h5' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bg_color_title', [
				'label'     => esc_html__( 'Background Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .explanation::after' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'display_type' => [ 'explanation' ]
				]
			]
		);

		$this->end_controls_section(); //End Style Title


		//============================ Style Alert =========================//
		$this->start_controls_section(
			'section_type', [
				'label' => esc_html__( 'Alert Description', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'color_content', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .__content'                    => 'color: {{VALUE}};',
					'{{WRAPPER}} .__content p'                  => 'color: {{VALUE}};',
					'{{WRAPPER}} .explanation p'                => 'color: {{VALUE}};',
					'{{WRAPPER}} .notice p'                     => 'color: {{VALUE}};',
					'{{WRAPPER}} .nic-content-wrap .note-box p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .message_alert p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'typography_content',
				'selector' => '
					{{WRAPPER}} .__content,
					{{WRAPPER}} .__content p,
					{{WRAPPER}} .explanation p,
					{{WRAPPER}} .notice p, 
					{{WRAPPER}} .nic-content-wrap .note-box p
				'
			]
		);

		$this->add_control(
			'background', [
				'label'     => esc_html__( 'Background Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .message_alert'                                           => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .notice:not(.dual-box-wrapper .dual-box-content .notice)' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .nic-alert .nic-content-wrap .note-box'                   => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .dual-box-wrapper'                                        => 'background-color: {{VALUE}};',

				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'background2', [
				'label'     => esc_html__( 'Background Color 02', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .explanation' => 'background: linear-gradient(90deg, {{background.VALUE}}, {{VALUE}});',
				],
				'condition' => [
					'display_type' => [ 'explanation' ]
				]
			]
		);

		$this->add_control(
			'border_color', [
				'label'     => esc_html__( 'Border Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .message_alert'                                    => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .explanation::before'                              => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .notice'                                           => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .note-with-icon .nic-content-wrap'                 => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .dual-box-wrapper'                                 => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .dual-box-wrapper.notice-danger .dual-box-content' => 'border-color: {{VALUE}};',
				],
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
					'display_type' => [ 'note-with-icon' ]
				]
			]
		);

		$this->add_control(
			'icon_color', [
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .info-tab .icon-wrapper i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bgcolor',
			[
				'label'     => esc_html__( 'Background Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nic-alert .nic-content-wrap .note-icon' => 'background-color: {{VALUE}};',
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
				]
			]
		);

		$this->end_controls_section(); // End Style Icon


		//======================== Style Dual Box Icon ========================//
		$this->start_controls_section(
			'dual_box_icon', [
				'label'     => esc_html__( 'Icon', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'display_type' => [ 'dual-box' ]
				]
			]
		);

		$this->add_control(
			'dual_box_icon_color', [
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dual-box-wrapper .dual-box-content .notice i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dual_box_icon_size', [
				'label'     => esc_html__( 'Size', 'spider-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .dual-box-wrapper .dual-box-content .notice i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // End Style Dual Box Icon

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
		include "templates/alerts-box/alert-box-1.php";

	}
}