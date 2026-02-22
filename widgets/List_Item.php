<?php
/**
 * Use namespace to avoid conflict
 */

namespace SPEL\Widgets;

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
 *
 * @package spider\Widgets
 * @since   1.0.0
 */
class List_Item extends Widget_Base {
	public function get_name(): string {
		return 'docly_list_item'; // ID of the widget (Don't change this name)
	}

	public function get_title(): string {
		return esc_html__( 'List Items', 'spider-elements' );
	}

	public function get_icon(): string {
		return 'eicon-bullet-list spel-icon';
	}

	public function get_keywords(): array {
		return [ 'spider', 'spider elements', 'icon list', 'icon', 'list' ];
	}

	public function get_categories(): array {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends(): array {
		return [ 'elegant-icon', 'spel-main' ];
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
	protected function register_controls(): void {
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
	public function elementor_content_control(): void {

		//============================ Icon List ============================//
		$this->start_controls_section(
			'section_icon', [
				'label' => esc_html__( 'Icon List', 'spider-elements' ),
			]
		);

		$this->add_control(
			'style', [
				'label'   => esc_html__( 'List Order', 'spider-elements' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'unordered_list' => esc_html__( 'Unordered List', 'spider-elements' ),
					'order_list'     => esc_html__( 'Ordered List', 'spider-elements' ),
				],
				'default' => 'unordered_list',
			]
		);

		$this->add_control(
			'list_icon', [
				'label'     => esc_html__( 'Icon', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'style' => 'unordered_list', // Only show when "Unordered List" is selected
				],
			]
		);

		// Add control for an ordered list type
		$this->add_control(
			'order_type', [
				'label'     => esc_html__( 'Order Type', 'spider-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'numeric' => esc_html__( 'Numeric', 'spider-elements' ),
					'alpha'   => esc_html__( 'Alphabetic', 'spider-elements' ),
					'roman'   => esc_html__( 'Roman Numerals', 'spider-elements' ),
				],
				'default'   => 'numeric',
				'condition' => [
					'style' => 'order_list', // Only show when "Ordered List" is selected
				],
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'text', [
				'label'       => esc_html__( 'Title', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
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
				'default'       => [
					[ 'text' => esc_html__( 'List Item 1', 'spider-elements' ) ],
					[ 'text' => esc_html__( 'List Item 2', 'spider-elements' ) ],
					[ 'text' => esc_html__( 'List Item 3', 'spider-elements' ) ],
				],
			]
		);

		$this->end_controls_section(); // End Icon List

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
	public function elementor_style_control(): void {

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
					'{{WRAPPER}} .spel-steps-panel .item-list li' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'text_indent', [
				'label'     => esc_html__( 'Text Indent', 'spider-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .spel-steps-panel .item-list li' => is_rtl() ? 'padding-right: {{SIZE}}{{UNIT}};' : 'padding-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_align', [
				'label'     => esc_html__( 'Alignment', 'spider-elements' ),
				'type'      => Controls_Manager::CHOOSE,
				'separator' => 'after',
				'options'   => [
					'start'  => [
						'title' => esc_html__( 'Left', 'spider-elements' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'spider-elements' ),
						'icon'  => 'eicon-h-align-center',
					],
					'end'    => [
						'title' => esc_html__( 'Right', 'spider-elements' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .spel-steps-panel' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'content_typography',
				'selector' => '{{WRAPPER}} .spel-steps-panel .item-list li',
			]
		);

		$this->add_control(
			'text_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .spel-steps-panel .item-list li' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section(); // End List


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
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .item-list li .icon i'                       => 'color: {{VALUE}};',
					'{{WRAPPER}} .item-list li .icon svg'                     => 'fill: {{VALUE}};',
					'{{WRAPPER}} .spel-steps-panel .ordered li::before'       => 'color: {{VALUE}};',
					'{{WRAPPER}} .spel-steps-panel .ordered.alpha li::before' => 'color: {{VALUE}};',
					'{{WRAPPER}} .spel-steps-panel .ordered.roman li::before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg_color', [
				'label'     => esc_html__( 'Background', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .item-list li .icon'                   => 'background: {{VALUE}};',
					'{{WRAPPER}} .spel-steps-panel .ordered li::before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_divider_color', [
				'label'     => esc_html__( 'Divider Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .item-list::after' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_divider_position', [
				'label'     => esc_html__( 'Divider Position', 'spider-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .spel-steps-panel .item-list::after' => 'left: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .item-list li .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ordered li::before'   => 'font-size: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .item-list li .icon' => 'width:{{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .ordered li::before' => 'width:{{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .item-list li' => 'line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // End Style Icon


		//============================ Style Background ============================//
		$this->start_controls_section(
			'style_icon_box', [
				'label' => esc_html__( 'Box Container', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(), [
				'name'     => 'box_shadow',
				'selector' => '{{WRAPPER}} .spel-steps-panel',
			]
		);

		$this->add_responsive_control(
			'box_padding', [
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .spel-steps-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'default'    => [
					'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(), [
				'name'      => 'border',
				'label'     => esc_html__( 'Border', 'spider-elements' ),
				'selector'  => '{{WRAPPER}} .spel-steps-panel',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'border_radius', [
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .spel-steps-panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'box_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .spel-steps-panel',
			]
		);

		$this->end_controls_section(); // End Style Background

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
	protected function render(): void {

		$settings   = $this->get_settings_for_display();
		$icon_list  = $settings['ul_icon_list'] ?? '';
		$order_type = $settings['order_type'] ?? '';
		$style      = $settings['style'] ?? 'order_list';

		// Determine list class
		$list_class = '';
		if ( $style === 'order_list' ) {
			$list_class = match ( $order_type ) {
				'alpha' => ' alpha',
				'roman' => ' roman',
				default => '',
			};
		}

		if ( 'unordered_list' === $settings['style'] ) {
			?>
            <div class="spel-steps-panel">
                <ul class="item-list unordered">
					<?php
					if ( ! empty( $icon_list ) ) {
						foreach ( $icon_list as $item ) {
							if ( ! empty( $item['text'] ) ) { ?>
                                <li class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ); ?>">
									<?php
									if ( ! empty( $settings['list_icon']['value'] ) ) { ?>
                                        <span class="icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $settings['list_icon'] ); ?>
                                        </span>
										<?php
									}
									echo esc_html( $item['text'] );

									?>
                                </li>
								<?php
							}
						}
					}
					?>
                </ul>
            </div>
			<?php
		} elseif ( 'order_list' === $settings['style'] ) {
			?>
            <div class="spel-steps-panel">
                <ol class="item-list ordered<?php echo esc_attr( $list_class ); ?> ?>">
					<?php
					if ( ! empty( $icon_list ) ) {
						foreach ( $icon_list as $item ) {
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
