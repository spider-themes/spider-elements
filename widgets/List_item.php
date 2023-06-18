<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Class Chart
 * @package spider\Widgets
 */

class List_item extends Widget_Base {
    public function get_name() {
        return 'docly_list_item';
    }

    public function get_title() {
        return __( 'spider List Item', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-bullet-list se-icon';
    }

    public function get_keywords() {
        return [ 'icon list', 'icon', 'list' ];
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
		return [ '', ];
	}


    protected function register_controls() {
        $this->start_controls_section(
            'section_icon',
            [
                'label' => __( 'Icon List', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => __( 'Order Type', 'spider-elements' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'unordered_list'  => __( 'Unordered List', 'spider-elements' ),
                    'order_list' => __( 'Ordered List', 'spider-elements' ),
                ],
                'default' => 'unordered_list',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'text', [
                'label' => __( 'Title', 'spider-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => __( 'List Item', 'spider-elements' ),
                'default' => __( 'List Item', 'spider-elements' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'ul_icon_list',
            [
                'label' => 'Icon List',
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ text }}}',
                'prevent_empty' => false,
            ]
        );

        $this->end_controls_section();


        /**
         * Tab Style
         */
        //--------------------------------- List Style --------------------------------- //
        $this->start_controls_section(
            'section_icon_list',
            [
                'label' => __( 'List', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'space_between',
            [
                'label' => __( 'Space Between', 'spider-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
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
            'icon_align',
            [
                'label' => __( 'Alignment', 'spider-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'spider-elements' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'spider-elements' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'spider-elements' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'elementor%s-align-',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .steps-panel .ordered-list li' => 'color: {{VALUE}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'text_color_hover',
            [
                'label' => __( 'Hover', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .steps-panel .ordered-list li:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'text_indent',
            [
                'label' => __( 'Text Indent', 'spider-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
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
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Typography', 'spider-elements' ),
                'selector' => '{{WRAPPER}} .steps-panel .ordered-list li',
            ]
        );

        $this->end_controls_section();


        // ------------------------------------ Icon Style  --------------------------------------------//
        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => __( 'Icon', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .steps-panel .ordered-list li::before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label' => __( 'Background', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .steps-panel .ordered-list li::before' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', 'spider-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
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
            'icon_bg_size',
            [
                'label' => __( 'Background Size', 'spider-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
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
            'icon_line_height',
            [
                'label' => __( 'Line Height', 'spider-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .steps-panel .ordered-list li::before' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        /**
         * Box shadow
         */
        $this->start_controls_section(
            'sec_bg_style',
            [
                'label' => __( 'Section Style', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sec_margin', [
                'label' => __( 'Padding', 'spider-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .steps-panel' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'sec_box_shadow',
                'selector' => '{{WRAPPER}} .steps-panel',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( 'Border', 'spider-elements' ),
                'selector' => '{{WRAPPER}} .steps-panel',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'spider-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .steps-panel' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render alert widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings();
        if ( $settings['style'] == 'unordered_list' ) {
            ?>
            <div class="steps-panel">
                <ul class="ordered-list">
                    <?php
                    if ( $settings['ul_icon_list'] ) {
                        foreach ( $settings['ul_icon_list'] as $item ) {
                            if ( !empty( $item['text'] ) ) { ?>
                                <li class="elementor-repeater-item-<?php echo $item['_id']; ?>">
                                    <?php echo $item['text']; ?>
                                </li>
                                <?php
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
            <?php
        }
        elseif ( $settings['style'] == 'order_list' ) {
            ?>
            <div class="steps-panel">
                <ol class="ordered-list">
                    <?php
                    if ( $settings['ul_icon_list'] ) {
                        foreach ( $settings['ul_icon_list'] as $item ) {
                            if ( !empty( $item['text'] ) ) { ?>
                                <li class="elementor-repeater-item-<?php echo $item['_id']; ?>">
                                    <?php echo $item['text'] ?>
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
