<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * Class Call_to_action
 * @package SpiderElements\Widgets
 */
class Call_to_action extends Widget_Base {
    public function get_name() {
        return 'Docy_contact_banner';
    }

    public function get_title() {
        return esc_html__( 'Call to Action', 'docy-core' );
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

    public function get_script_depends() {
        return [ 'parallax-scroll' ];
    }

    protected function register_controls() {

        // ----------------------------------------  Section Style ------------------------------
        $this->start_controls_section(
            'sec_style',
            [
                'label' => esc_html__( 'Preset Skins', 'docy-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Select Style', 'docy-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => 'Classic',
                        'icon' => 'c2a',
                    ],
                ],
                'default' => '1'
            ]
        );

        $this->end_controls_section();

        //******************************* Title Section***************************************//
        $this->start_controls_section(
            'title_section',
            [
                'label' => esc_html__( 'Contents', 'docy-core' ),
            ]
        );

        $this->add_control(
            'title', [
                'label' => esc_html__( 'Title', 'docy-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => "Can't find an Answer?",
            ]
        );

        $this->add_control(
            'title_tag', [
                'label' => __( 'Title Tag', 'docy-core' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => se_el_title_tags(),
            ]
        );

        $this->add_control(
            'content', [
                'label' => esc_html__( 'Content', 'docy-core' ),
                'type' => Controls_Manager::WYSIWYG,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'featured_image', [
                'label' => esc_html__( 'Featured Image', 'docy-core' ),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();


        //******************************* Button Section***************************************//
        $this->start_controls_section(
            'button_sec',
            [
                'label' => esc_html__( 'Button', 'docy-core' ),
            ]
        );

        $this->add_control(
            'btn_label', [
                'label' => esc_html__( 'Button Label', 'docy-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Get Support'
            ]
        );

        $this->add_control(
            'btn_url', [
                'label' => esc_html__( 'Button URL', 'docy-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ]
            ]
        );

        //---------------------------- Normal and Hover ---------------------------//
        $this->start_controls_tabs(
            'style_tabs'
        );


        // Normal Color
        $this->start_controls_tab(
            'normal_btn_style',
            [
                'label' => __( 'Normal', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'normal_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .c2abtn' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .c2abtn' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();


        // Hover Color
        $this->start_controls_tab(
            'hover_btn_style',
            [
                'label' => __( 'Hover', 'saasland-core' ),
            ]
        );

        $this->add_control(
            'hover_text_color', [
                'label' => __( 'Text Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .c2abtn:hover' => 'color: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'hover_bg_color', [
                'label' => __( 'Background Color', 'saasland-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .c2abtn:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Style Tab
         */
        /****************************** Section Title Color **************************/
        $this->start_controls_section(
            'sec_title_style',
            [
                'label' => esc_html__( 'Title', 'docy-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Style One
        $this->add_control(
            'saas_title_color',
            [
                'label' => esc_html__( 'Text Color', 'docy-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography_saas_title',
                'label' => esc_html__( 'Typography', 'docy-core' ),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->end_controls_section();


        /**
         * Style Section
         */
        $this->start_controls_section(
            'sec_bg_style',
            [
                'label' => esc_html__( 'Style Section', 'docy-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__( 'Background Color', 'docy-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .c2a_sec' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_img',
            [
                'label' => esc_html__( 'Background Image', 'docy-core' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('inc/c2a/img/support-shap.png', __FILE__)
                ]
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __( 'Padding', 'docy-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .c2a_sec' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        $title_tag = !empty($settings['title_tag']) ? $settings['title_tag'] : 'h3';
        include( "inc/c2a/c2a-{$settings['style']}.php" );
    }
}