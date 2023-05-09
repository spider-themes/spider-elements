<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Group_Control_Border;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Testimonial_carousel
 * @package spider\Widgets
 */
class Testimonial extends \Elementor\Widget_Base {

    public function get_name() {
        return 'docy_testimonial';
    }

    public function get_title() {
        return __( 'Testimonial (spider)', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

    public function get_style_depends() {
        return [ 'slick', 'slick-theme' ];
    }

    public function get_script_depends() {
        return [ 'slick', 'wow' ];
    }

    protected function register_controls() {


        //-------------------------------- Select Style ------------------------------------- //
        $this->start_controls_section(
            'style_sec',
            [
                'label' => esc_html__( 'Preset Skins', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Testimonials', 'spider-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'icon' => 'testimonial1',
                        'title' => esc_html__( '01 : Carousel Testimonials', 'spider-elements')
                    ],
                    '2' => [
                        'icon' => 'testimonial2',
                        'title' => esc_html__( '02 : Carousel Testimonials', 'spider-elements'),
                    ]
                ],
                'default' => '1',
            ]
        );

        $this->end_controls_section(); // End Style


        // ------------------------------ Testimonials 01 ------------------------------ //
        $this->start_controls_section(
            'testimonials_sec', [
                'label' => __( 'Testimonials', 'spider-elements' ),
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'name', [
                'label' => __( 'Name', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Mark Tony' , 'spider-elements' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'designation', [
                'label' => __( 'Designation', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Software Developer' , 'spider-elements' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'content', [
                'label' => __( 'Testimonial Text', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'author_image', [
                'label' => __( 'Author Image', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'signature', [
                'label' => __( 'Signature', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $repeater->add_control(
            'shape', [
                'label' => __( 'Shape', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'testimonials',
            [
                'label' => __( 'Testimonials', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section(); // End Testimonials 01


        // ------------------------------ Testimonials 02 ------------------------------ //
        $this->start_controls_section(
            'testimonials2_sec', [
                'label' => __( 'Testimonials', 'spider-elements' ),
                'condition' => [
                    'style' => '2'
                ]
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'name', [
                'label' => __( 'Name', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Mark Tony' , 'spider-elements' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'designation', [
                'label' => __( 'Designation', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Software Developer' , 'spider-elements' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'content', [
                'label' => __( 'Testimonial Text', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $repeater->add_control(
            'author_image', [
                'label' => __( 'Author Image', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'testimonials2',
            [
                'label' => __( 'Testimonials', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section(); // End Testimonials 02


        /**
         * Style Content
         */
        $this->start_controls_section(
            'style_content_sec', [
                'label' => __( 'Style Content', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color', [
                'label' => __( 'Feedback Text Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .doc_feedback_slider .item p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_contents',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .doc_feedback_slider .item h5,
                ',
            ]
        );

        $this->add_control(
            'author_color', [
                'label' => __( 'Author Name Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .doc_feedback_slider .item h5' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_author',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .doc_feedback_slider .item h5,
                ',
            ]
        );

        $this->add_control(
            'designation_color', [
                'label' => __( 'Author Name Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .doc_feedback_slider .item h6' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_designation',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '
                    {{WRAPPER}} .doc_feedback_slider .item h6,
                ',
            ]
        );

        $this->end_controls_section();


        // ------------------------------------- Style Section ---------------------------//
        $this->start_controls_section(
            'style_section', [
                'label' => __( 'Style Section', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

	    $this->add_group_control(
		    \Elementor\Group_Control_Background::get_type(),
		    [
			    'name' => 'background',
			    'label' => __( 'Background', 'spider-elements' ),
			    'types' => [ 'classic', 'gradient', 'video' ],
			    'selector' => '{{WRAPPER}} .doc_feedback_area',
		    ]
	    );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'spider-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .doc_feedback_area, .doc_testimonial_area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $testimonials = !empty( $settings['testimonials'] ) ? $settings['testimonials'] : '';

        // Include Part
        include("inc/testimonials/testimonials-{$settings['style']}.php");
    }
}