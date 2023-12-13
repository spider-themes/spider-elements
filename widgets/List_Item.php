<?php
/**
 * Use namespace to avoid conflict
 */

namespace Spider_Elements\Widgets;

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
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
class List_Item extends Widget_Base {
	public function get_name() {
		return 'docly_list_item'; // ID of the widget (Don't change this name)
	}

	public function get_title() {
		return esc_html__( 'List Items', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-bullet-list spel-icon';
	}

	public function get_keywords() {
		return [ 'spider', 'spider elements', 'icon list', 'icon', 'list' ];
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'elegant-icon', 'spel-main' ];
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


		//============================ Icon List ============================//
		$this->start_controls_section(
			'section_icon', [
				'label' => esc_html__( 'Icon List', 'spider-elements' ),
			]
		);

		$this->add_control(
			'style', [
				'label'   => esc_html__( 'Order Type', 'spider-elements' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'unordered_list' => esc_html__( 'Unordered List', 'spider-elements' ),
					'order_list'     => esc_html__( 'Ordered List', 'spider-elements' ),
				],
				'default' => 'unordered_list',
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'text', [
				'label'       => esc_html__( 'Title', 'spider-elements' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'placeholder' => esc_html__( 'List Item', 'spider-elements' ),
				'default'     => esc_html__( 'List Item', 'spider-elements' ),
				'dynamic'     => [
					'active' => true,
				],
			]
		);

		$this->add_control(
			'ul_icon_list', [
				'label'         => 'Icon List',
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $repeater->get_controls(),
				'title_field'   => '{{{ text }}}',
				'prevent_empty' => false,
			]
		);

		$this->end_controls_section(); // End Icon List

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


		//============================ List Item ============================//
		$this->start_controls_section(
			'section_icon_list', [
				'label' => esc_html__( 'List', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'space_between', [
				'label'     => esc_html__( 'Space Between', 'spider-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .steps-panel .ordered-list li:not(.steps-panel .ordered-list li:last-child)' => 'padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'icon_align', [
				'label'        => esc_html__( 'Alignment', 'spider-elements' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'left'   => [
						'title' => esc_html__( 'Left', 'spider-elements' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'spider-elements' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'spider-elements' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'elementor%s-align-',
			]
		);

		$this->add_control(
			'text_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .steps-panel .ordered-list li' => 'color: {{VALUE}};',
				],
				'separator' => 'before'
			]
		);

		$this->add_control(
			'text_color_hover', [
				'label'     => esc_html__( 'Hover', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .steps-panel .ordered-list li:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'text_indent', [
				'label'     => esc_html__( 'Text Indent', 'spider-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .steps-panel .ordered-list li' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .steps-panel .ordered-list li',
			]
		);

		$this->end_controls_section();


		//============================ Style Icon ============================//
		$this->start_controls_section(
			'style_icon', [
				'label' => esc_html__( 'Icon', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color', [
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .steps-panel .ordered-list li::before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg_color', [
				'label'     => esc_html__( 'Background', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .steps-panel .ordered-list li::before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size', [
				'label'     => esc_html__( 'Size', 'spider-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .steps-panel .ordered-list li::before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_bg_size', [
				'label'     => esc_html__( 'Background Size', 'spider-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .steps-panel .ordered-list li::before' => 'width:{{SIZE}}{{UNIT}} !important; height: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

		$this->add_responsive_control(
			'icon_line_height', [
				'label'     => esc_html__( 'Line Height', 'spider-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 6,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .steps-panel .ordered-list li::before' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // End Style Icon


		//============================ Style Background ============================//
		$this->start_controls_section(
			'sec_bg_style', [
				'label' => esc_html__( 'Background', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'sec_margin', [
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .steps-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'    => [
					'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(), [
				'name'     => 'sec_box_shadow',
				'selector' => '{{WRAPPER}} .steps-panel',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name'      => 'border',
				'label'     => esc_html__( 'Border', 'spider-elements' ),
				'selector'  => '{{WRAPPER}} .steps-panel',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius', [
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .steps-panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // End Style Background

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

		if ( $settings['style'] == 'unordered_list' ) {
			?>
            <div class="steps-panel">
                <ul class="ordered-list">
					<?php
					if ( ! empty( $ul_icon_list ) ) {
						foreach ( $ul_icon_list as $item ) {
							if ( ! empty( $item['text'] ) ) { ?>
                                <li class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
									<?php echo esc_html( $item['text'] ); ?>
                                </li>
								<?php
							}
						}
					}
					?>
                </ul>
            </div>
			<?php
		} elseif ( $settings['style'] == 'order_list' ) {
			?>
            <div class="steps-panel">
                <ol class="ordered-list">
					<?php
					if ( ! empty( $ul_icon_list ) ) {
						foreach ( $ul_icon_list as $item ) {
							if ( ! empty( $item['text'] ) ) { ?>
                                <li class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
									<?php echo esc_html( $item['text'] ) ?>
                                </li>
								<?php
							}
						}
					}
					?>
                </ol>
            </div>
			<?php
		}
	}
}
