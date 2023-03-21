<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Repeater;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Video_playlist
 * @package DocyCore\Widgets
 */
class Video_playlist extends Widget_Base {
    public function get_name() {
        return 'spider_videos_playlist';
    }

    public function get_title() {
        return esc_html__( 'Video Playlist', 'docy-core' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_style_depends() {
        return [ 'ionicons' ];
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'doc_design_sec', [
                'label' => __( 'Preset Skin', 'docy-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label' => esc_html__( 'Skin', 'docy-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => __( 'Tab', 'coro-core' ),
                        'icon' => 'video-playlist',
                    ],
                    '2' => [
                        'title' => __( 'Slide', 'coro-core' ),
                        'icon' => 'video-playlist2',
                    ],
                ],
                'toggle' => false,
                'default' => '1',
            ]
        );

        $this->end_controls_section();


        // Title
        $this->start_controls_section(
            'title_opt_sec', [
                'label' => __( 'Title', 'docy-core' ),
                'condition' => [
                    'style' => ['1']
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title text', 'rave-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => docy_el_title_tags(),
                'default' => 'h3',
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => __( 'Text Color', 'rave-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .title'
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'style_sec',
            [
                'label' => esc_html__('Style Section', 'rogan-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Section padding', 'docy-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .video-playlist' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );

        $this->add_control(
            'sec_bg_color', [
                'label' => esc_html__('Background Color', 'rogan-core'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-playlist' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        $videos = new \WP_Query(array(
            'post_type' => 'video',
            'posts_per_page' => !empty($settings['ppp']) ? $settings['ppp'] : -1,
        ));

        $cats = get_terms( array (
            'taxonomy' => 'video_cat',
            'hide_empty' => true
        ));

        include( "inc/video-playlist/video-playlist-{$settings['style']}.php" );
    }
}