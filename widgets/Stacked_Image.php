<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Group_Control_Image_Size;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Stack image Widgets
 */

 class Stacked_Image extends Widget_Base {

    public function get_name() {
        return 'stacked_image';
    }

    public function get_title() {
        return __( 'Stacked Image', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-image-hotspot';
    }

    public function get_keywords() {
        return [ 'spider', 'stacked_image', 'stacked image'];
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

    // define register controls
    protected function register_controls()
    {
        // layout
        $this-> stackimage_content_control();
        $this-> stack_image_style();

         /**
         * Tab: Style
         */
        
    }
    public function stackimage_content_control()
    {
        $this->start_controls_section(
            'stack_images',
            [
                'label' => __('Stack Image', 'spider-elements'),
            ]
        );
        $this->add_control(
            'stack_image',
            [
                'type' => Controls_Manager::GALLERY,
				'dynamic' => [
					'active' => true,
				],
            ]
        );

        $this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
				'exclude' => [ 'custom' ],
				'separator' => 'none',
			]
		);

        // $this->add_control(
        //     'stack_image_list',
        //     [
        //         'show_label' => false,
        //         'type' => \Elementor\Controls_Manager::REPEATER,
        //         'fields' => $repeater->get_controls(),
        //         'default' => [
        //             [
        //                 'stack_image' => \Elementor\Utils::get_placeholder_image_src(),
        //             ],
        //         ]
        //     ]
        // );

        $this->end_controls_section();
    }

    public function stack_image_style()
    {
        $this->start_controls_section(
            'section_image_style',
            [
                'label' => __( 'Image Style', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'stack_image_alignment',
			[
				'label' => __( 'Image Alignment', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'spider-elements' ),
						'icon' => 'fa fa-align-left',
					],
					'top' => [
						'title' => __( 'Center', 'spider-elements' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'spider-elements' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => 'left',
				'toggle' => true,
			]
		);

        $this->add_responsive_control(
            'stack_image_width',
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
                    '{{WRAPPER}} .stack_image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'stack_image_height',
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
                    '{{WRAPPER}} .stack_image' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'stack_image_padding',
            [
                'label' => __('Padding', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .stack_image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'dl_hotspot_image_border',
                'selector' => '{{WRAPPER}} .stack_image',
            ]
        );

        $this->add_responsive_control(
            'stack_image_border_radius',
            [
                'label' => __('Border Radius', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .stack_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => '_dl_pro_testimonials_box_shadow',
                'label' => __('Box Shadow', 'droit-addons-pro'),
                'selector' => '{{WRAPPER}} .stack_image',
            ]
        );
        $this->end_controls_section();

    }



    protected function render() {
		$settings = $this->get_settings_for_display();
        extract($settings);
        ?>
            <figure class="stack_image <?php echo "img-position-" .$stack_image_alignment ?>">
                <?php foreach ( $settings['stack_image'] as $image ) {?>
                    <?php echo '<img src="' . esc_attr( $image['url'] ) . '">'; ?>  
                <?php } ?>
            </figure>
        <?php
	}
}