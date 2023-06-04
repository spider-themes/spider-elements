<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Hotspot Widgets
 */

 class Hotspot extends Widget_Base {

    public function get_name() {
        return 'hotspot';
    }

    public function get_title() {
        return __( 'Hotspot', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-image-hotspot';
    }

    public function get_keywords() {
        return [ 'spider', 'hotspot', 'hot spot'];
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

    // define register controls
    protected function register_controls()
    {
        // layout
        $this-> hotspot_content_control();
        $this-> hotspot_styles_control();

         /**
         * Tab: Style
         */
        
    }

    public function hotspot_content_control()
    {
        $this-> hotspot_image_control();
        $this-> hotspot_spot_control();
    }

    public function hotspot_styles_control()
    {
        $this-> hotspot_images_style();
        // $this-> hotspot_spot_style();
    }

    public function hotspot_images_style()
    {
        $this->start_controls_section(
            'section_image_style',
            [
                'label' => __( 'Image Style', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'dl_hotspot_image_width',
            [
                'label' => __('Width', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'desktop_default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} figure.hotspots__figure' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dl_hotspot_image_height',
            [
                'label' => __('Height', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} figure.hotspots__figure' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dl_hotspot_image_padding',
            [
                'label' => __('Padding', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} figure.hotspots__figure img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'dl_hotspot_image_border',
                'selector' => '{{WRAPPER}} .hotspots__figure img',
            ]
        );

        $this->add_responsive_control(
            'dl_hotspot_image_border_radius',
            [
                'label' => __('Border Radius', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .hotspots__figure img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

    }

    public function hotspot_image_control()
    {
        $this->start_controls_section(
            'hotspot_image',
            [
                'label' => __('Image', 'spider-elements'),
            ]
        );

        $this->add_control(
            'hotspot_image_src',
            [
                'show_label' => false,
                'type'       => \Elementor\Controls_Manager::MEDIA,
                'dynamic'    => [
                    'active' => true
                ],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'    => 'hotspot_thumbnail',
                'label'   => __('Image Size', 'spider-elements'),
                'default' => 'large',
            ]
        );

        $this->end_controls_section();
    }

    public function hotspot_spot_control()
    {
        $this->start_controls_section(
            'hotspot_spot',
            [
                'label' => __('Spots', 'spider-elements'),
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->start_controls_tabs('dl_spot_tabs');

        $repeater->start_controls_tab(
            'hotspot_tab_spot',
            [
                'label' => __('Spot', 'spider-elements')
            ]
        );

        $repeater->add_control(
            'hotspot_image',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true
                ],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_responsive_control(
            'hotspot_position_x',
            [
                'label' => __('X Position', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'separator' => 'before',
                'size_units' => ['%'],
                'desktop_default' => [
                    'size' => 50,
                    'unit' => '%'
                ],
                'tablet_default' => [
                    'unit' => '%'
                ],
                'mobile_default' => [
                    'unit' => '%'
                ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => .1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'render_type' => 'ui',
                'frontend_available' => true,
            ]
        );

        $repeater->add_responsive_control(
            'hotspot_position_y',
            [
                'label' => __('Y Position', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'desktop_default' => [
                    'size' => 45,
                    'unit' => '%'
                ],
                'tablet_default' => [
                    'unit' => '%'
                ],
                'mobile_default' => [
                    'unit' => '%'
                ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => .1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'render_type' => 'ui',
                'frontend_available' => true,
            ]
        );
        $repeater-> add_responsive_control(
            'hotspot_magnific_width',
            [
                'label' => __('Magnific Width', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%'],
                'desktop_default' => [
                    'size' => 5,
                ],
                'tablet_default' => [
                    'unit' => '%'
                ],
                'mobile_default' => [
                    'unit' => '%'
                ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => .1
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}}.hotspot.active' => 'transform: scale({{SIZE}});',
                ],
                'render_type' => 'ui',
                'frontend_available' => true,
            ]
        );

        $repeater->end_controls_tab();

       

        $repeater->end_controls_tabs();

        $this->add_control(
            'hotspot_spots',
            [
                'show_label' => false,
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'type' => '',
                        'icon' => [
                            'library' => 'solid',
                            'value' => 'fas fa-plus',
                        ],
                        'x_pos' => [
                            'size' => 47,
                            'unit' => '%'
                        ],
                        'y_pos' => [
                            'size' => 43,
                            'unit' => '%'
                        ],
                    ]
                ]
            ]
        );

        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        extract($settings);
    ?>
        <div class="hotspots">
            <figure class="hotspots__figure">
                <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'hotspot_image_src'); ?>
            </figure>
            <ul class="list-unstyled hotspot_list">
                <?php if(!empty($settings['hotspot_spots'])):
                    $i = 0;
                    foreach ($settings['hotspot_spots'] as $index => $value) :
                        $i++;
					    $active = $i == 1 ? 'active' : '';
                    ?>
                    <li class="hotspot <?php echo $active ?> elementor-repeater-item-<?php echo $value['_id']; ?>">
                        <?php echo wp_get_attachment_image($value['hotspot_image']['id']); ?>
                    </li>
                <?php endforeach; endif; ?>
            </ul>
        </div>
    <?php

    }
}