<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Accordion
 * @package spider\Widgets
 */
class Accordion extends Widget_Base {

    public function get_name() {
        return 'docy_accordion';
    }

    public function get_title() {
        return esc_html__( 'Spider Accordion', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_keywords() {
        return [ 'toggle' ];
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

    protected function register_controls() {

        /** ============ Title Section ============ **/
        $this->start_controls_section(
            'style_sec',
            [
                'label' => esc_html__( 'Accordion', 'spider-elements' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'collapse_state', [
                'label' => esc_html__( 'Expanded', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'spider-elements' ),
                'label_off' => esc_html__( 'No', 'spider-elements' ),
                'return_value' => 'yes',
                'default' => 'se_accordion_title',
            ]
        );


        $repeater->add_control(
            'se_accordion_title', [
                'label' => __( 'Accordion Title', 'spider-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Accordion Title', 'spider-elements' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'selector' => '{{WRAPPER}} .#',
            ]
        );

        $repeater->add_control(
            'content_type',
            [
                'label'     => esc_html__( 'Content Type', 'spider-elements' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'content'        => esc_html__( 'Content', 'spider-elements'),
                    'el_template'   => esc_html__( 'Template', 'spider-elements'),
                ],
                'default' => 'content',
                'label_block' => true
                ]

        );

        $repeater->add_control(
            'normal_content', [
                'label' => __( 'Content Text', 'spider-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __( 'Accordion Content', 'spider-elements' ),
                'condition' => [
                    'content_type' => 'content'
                ]

            ]

        );

        $repeater->add_control(
            'el_content', [
                'label'         => __( 'Select Template', 'spider-elements' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => se_elementor_templates(),
                'label_block'   => true,
                'default'       => __( 'Accordion Content', 'spider-elements' ),
                'condition'     => [
                    'content_type' => 'el_template'
                ]
            ]
        );
        $repeater->add_control(
            'tab_content',
            [
                'label' => esc_html__( 'Content', 'spider-elements' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Accordion Content', 'spider-elements' ),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'se_accordion',
            [
                'label'     => 'Accordion Items',
                'type'      => Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'default'   => [
                    [
                        'se_accordion_title'    => esc_html__( 'Accordion #1', 'spider-elements' ),
                        'tab_content'           => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'spider-elements' ),
                    ],
                    [
                        'se_accordion_title'    => esc_html__( 'Accordion #2', 'spider-elements' ),
                        'tab_content'           => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'spider-elements' ),
                    ],
                ],
                'title_field' => '{{{ se_accordion_title }}}',
            ]
        );

        $this->add_control(
            'plus-icon',
            [
                'label' => __( 'Icon', 'spider-elements' ),
                'type' => Controls_Manager::ICONS,
                'label_block'   => true,
                'default' => [
                    'value' => 'fas fa-plus',
                    'library' => 'solid',
                ]
            ]
        );

        $this->add_control(
            'minus-icon',
            [
                'label' => __( 'Active Icon', 'spider-elements' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-minus',
                    'library' => 'solid',
                ]
            ]
        );

        $this->add_control(
            'se-toggle', [
                'label' => esc_html__( 'Toggle', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'spider-elements' ),
                'label_off' => esc_html__( 'No', 'spider-elements' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'title_tag', [
                'label' => __( 'Title Tag', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h6',
                'options' => se_el_title_tags(),
            ]
        );


        $this->end_controls_section();

        /**
         * Style Tab
         */

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Accordion', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label' => esc_html__( 'Border Width', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em' ],
                'range' => [
                    'px' => [
                        'max' => 20,
                    ],
                    'em' => [
                        'max' => 2,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .doc_accordion.card' => 'border-width: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => esc_html__( 'Border Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .doc_accordion.card' => 'border-color: {{VALUE}};background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_title',
            [
                'label' => esc_html__( 'Title', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_background',
            [
                'label' => esc_html__( 'Background', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .doc_accordion .card-header button.collapsed' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .doc_accordion .card-header button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .doc_accordion .card-header button.collapsed, {{WRAPPER}} .elementor-accordion-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
                ],
                'global' => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'tab_active_color',
            [
                'label' => esc_html__( 'Active Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .doc_accordion .card-header button, {{WRAPPER}} .elementor-active .elementor-accordion-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-active .elementor-accordion-icon svg' => 'fill: {{VALUE}};',
                ],
                'global' => [
                    'default' => Global_Colors::COLOR_ACCENT,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .doc_accordion .card-header button.collapsed',
                'selector' => '{{WRAPPER}} .doc_accordion .card-header button',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'text_stroke',
                'selector' => '{{WRAPPER}} .doc_accordion .card-header button.collapsed',
                'selector' => '{{WRAPPER}} .doc_accordion .card-header button',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_shadow',
                'selector' => '{{WRAPPER}} .doc_accordion .card-header button.collapsed',
                'selector' => '{{WRAPPER}} .doc_accordion .card-header button',
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => esc_html__( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .doc_accordion .card-header button.collapsed' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .doc_accordion .card-header button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_icon',
            [
                'label' => esc_html__( 'Icon', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'icon_align',
            [
                'label' => esc_html__( 'Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Start', 'elementor' ),
                        'icon' => 'eicon-h-align-left'
                    ],
                    'right' => [
                        'title' => esc_html__( 'End', 'elementor' ),
                        'icon' => 'eicon-h-align-right'
                    ],
                ],
                'default' => is_rtl() ? 'left' : 'right',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .doc_accordion .card-header button.collapsed .expanded-icon' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->add_control(
            'icon_active_color', [
                'label' => esc_html__( 'Active Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .doc_accordion .card-header button .collapsed-icon, .doc_accordion .card-header button .expanded-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_space',
            [
                'label' => esc_html__( 'Spacing', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .doc_accordion .card-header button .expanded-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .doc_accordion .card-header button .collapsed-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .doc_accordion .card-header button.icon-align-left .expanded-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .doc_accordion .card-header button.icon-align-left .collapsed-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_content',
            [
                'label' => esc_html__( 'Content', 'elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_background_color',
            [
                'label' => esc_html__( 'Background', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container .toggle_body' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container .toggle_body' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .elementor-widget-container .toggle_body',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'content_shadow',
                'selector' => '{{WRAPPER}} .elementor-widget-container .toggle_body',
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Padding', 'elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container .toggle_body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        include('inc/accordion/_accordion.php');
    }
}