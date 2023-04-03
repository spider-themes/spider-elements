<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
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
        return 'spider_list_item';
    }

    public function get_title() {
        return __( 'spider List Item', 'docy-core' );
    }

    public function get_icon() {
        return 'eicon-bullet-list';
    }

    public function get_keywords() {
        return [ 'icon list', 'icon', 'list' ];
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_icon',
            [
                'label' => __( 'Icon List', 'docy-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => __( 'Order Type', 'docy-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'unordered_list'  => __( 'Unordered List', 'docy-core' ),
                    'order_list' => __( 'Ordered List', 'docy-core' ),
                ],
                'default' => 'unordered_list',
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'text', [
                'label' => __( 'Title', 'docy-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'placeholder' => __( 'List Item', 'docy-core' ),
                'default' => __( 'List Item', 'docy-core' ),
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
                'label' => __( 'List', 'docy-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'space_between',
            [
                'label' => __( 'Space Between', 'docy-core' ),
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
                'label' => __( 'Alignment', 'docy-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'docy-core' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'docy-core' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'docy-core' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'elementor%s-align-',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'docy-core' ),
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
                'label' => __( 'Hover', 'docy-core' ),
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
                'label' => __( 'Text Indent', 'docy-core' ),
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
                'label' => __( 'Typography', 'docy-core' ),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .steps-panel .ordered-list li',
            ]
        );

        $this->end_controls_section();


        // ------------------------------------ Icon Style  --------------------------------------------//
        $this->start_controls_section(
            'section_icon_style',
            [
                'label' => __( 'Icon', 'docy-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Color', 'docy-core' ),
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
                'label' => __( 'Background', 'docy-core' ),
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
                'label' => __( 'Size', 'docy-core' ),
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
                'label' => __( 'Background Size', 'docy-core' ),
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
                'label' => __( 'Line Height', 'docy-core' ),
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
                'label' => __( 'Section Style', 'docy-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sec_margin', [
                'label' => __( 'Padding', 'docy-core' ),
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
                'label' => __( 'Border', 'docy-core' ),
                'selector' => '{{WRAPPER}} .steps-panel',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'docy-core' ),
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
