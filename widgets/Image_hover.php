<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Class Quote
 * @package spider\Widgets
 */
class Image_hover extends Widget_Base {

    public function get_name() {
        return 'docy_image_hover';
    }

    public function get_title() {
        return __( 'Image Hover', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-image-rollover se-icon';
    }

    public function get_keywords() {
        return [ 'image', 'hover', 'hover-content' ];
    }

    public function get_categories() {
		return [ 'spider-elements' ];
	}

    /**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'bootstrap', 'elegant-icon', 'se-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'bootstrap', 'se-el-widgets' ];
	}

    protected function register_controls() {
		$this->elementor_content_control();
		$this->elementor_style_control();
	}

    protected function elementor_content_control() {
        //===================== Select Preset ===========================//
        $this->start_controls_section(
            'style_sec', [
                'label' => esc_html__( 'Preset Skins', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'style', [
                'label'   => esc_html__( 'Style', 'spider-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => __( 'Hover Image with content', 'spider-elements' ),
                        'icon' => 'himage1',
                    ],
                    '2' => [
                        'title' => __( 'Hover Image with content', 'spider-elements' ),
                        'icon' => 'himage2',
                    ],
                    '3' => [
                        'title' => __( 'Hover Image with content', 'spider-elements' ),
                        'icon' => 'himage3',
                    ],
                    '4' => [
                        'title' => __( 'Hover Image', 'spider-elements' ),
                        'icon' => 'himage4',
                    ],
                ],
                'default' => '1',
            ]
        );

        $this->end_controls_section(); //End Select Style

	    $this->start_controls_section(
			'section_image',
			[
				'label' => esc_html__( 'Image', 'elementor' ),
			]
		);

		$this->add_control(
			'hover_image',
			[
				'label' => esc_html__( 'Choose Image', 'elementor' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => plugins_url('images/docs-3.png', __FILE__)
				],
			]
		);
		
        $this->end_controls_section();
    }

    public function elementor_style_control() {

        //============================ Tab Style ============================//
		$this->start_controls_section(
			'style_img_hover_sec', [
				'label' => __( 'Image Box', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['1','2','3']
                ]
			]
		);

		$this->add_control(
			'style_img_hover_bg', [
				'label' => __( 'Image Overlay Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .sp_image_hover,{{WRAPPER}} .hover-fold,{{WRAPPER}} .hover-fold .back' => 'background: {{VALUE}};',
                ),
			]
		); 

    	$this->end_controls_tab(); // End Active Tab 
        $this->end_controls_section();

        $this->start_controls_section(
			'style_img_hover_content', [
				'label' => __( 'Hover Content Style', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => ['1','2','3']
                ]
			]
		); 
        $this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'hover_title_typo',
                'label' => esc_html__( 'Title Typography', 'spider-elements' ),
				'selector' => '{{WRAPPER}} .sp_image_hover figcaption h3,{{WRAPPER}} .hover-fold .text h3',
			]
		);
        $this->add_control(
            'hover_title_color',
            [
                'label' => __( 'Title Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sp_image_hover figcaption h3,{{WRAPPER}} .hover-fold .text h3' => 'color: {{VALUE}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->add_responsive_control(
            'hover_title_margin', [
                'label' => __( 'Margin', 'spider-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .sp_image_hover figcaption h3,{{WRAPPER}} .hover-fold .text h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'hover_caption_typo',
                'label' => esc_html__( 'Content Typography', 'spider-elements' ),
				'selector' => '{{WRAPPER}} .sp_image_hover figcaption p,{{WRAPPER}} .hover-fold .text p',
			]
		);
        $this->add_control(
            'hover_caption_color',
            [
                'label' => __( 'Content Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sp_image_hover figcaption p,{{WRAPPER}} .hover-fold .text p' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
			'style_hover_box', [
				'label' => __( 'Box Background', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .sp_image_hover figcaption:before' => 'background: {{VALUE}};',
                ),
			]
		); 

    	$this->end_controls_tab(); // End Active Tab 

	    $this->end_controls_section(); // End Tab Style
    }
    /**
     * Render alert widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     */
    protected function render() {
	    $settings = $this->get_settings_for_display();
	    extract($settings); // extract all settings array to variables converted to name of key

        $image_id = !empty($settings['hover_image']['id']) ? $settings['hover_image']['id'] : '';

		$img_attachment_meta = se_el_image_caption($image_id);

        //================= Template Parts =================//
        include "templates/image-hover/image-hover-{$settings['style']}.php";
    }
}
