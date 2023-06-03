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

        $this->add_control(
            'type',
            [
                'label' => esc_html__( 'Type', 'spider-elements' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'toggle' => esc_html__( 'Toggle', 'spider-elements'),
                    'accordion' => esc_html__( 'Accordion', 'spider-elements'),
                ],
                'default' => 'toggle',
            ]
        );

        $this->add_control(
            'collapse_state', [
                'label' => esc_html__( 'Expanded', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'spider-elements' ),
                'label_off' => esc_html__( 'No', 'spider-elements' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title Text', 'spider-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'subtitle',
            [
                'label' => esc_html__( 'Content Text', 'spider-elements' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        /**
         * Style Tab
         */
        $this->start_controls_section(
            'title_style_sec', [
                'label' => esc_html__( 'Style Title', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => esc_html__( 'Text Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .doc_banner_text h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color_title', [
                'label' => esc_html__( 'Background Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .doc_banner_text h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'label' => esc_html__( 'Typography', 'spider-elements' ),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .doc_banner_text h2',
            ]
        );

        $this->end_controls_section();

        /**
         * Content Styling
         */
        $this->start_controls_section(
            'style_subtitle_sec', [
                'label' => esc_html__( 'Style Content', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'color_subtitle', [
                'label' => esc_html__( 'Text Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .doc_banner_text p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color_subtitle', [
                'label' => esc_html__( 'Background Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .doc_banner_text p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'label' => esc_html__( 'Subtitle Typography', 'spider-elements' ),
                'name' => 'typography_subtitle',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .doc_banner_text p',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();
        if ( $settings['type'] == 'toggle' ) {
            include('includes/accordion/_toggle.php');
        }

        if ( $settings['type'] == 'accordion' ) {
            include('includes/accordion/_accordion.php');
        }
    }
}