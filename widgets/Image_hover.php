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
        return 'docy_Image_hover';
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

    protected function register_controls() {
        //===================== Select Preset ===========================//
        $this->start_controls_section(
            'style_sec', [
                'label' => esc_html__( 'Preset Skins', 'landpagy-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label'   => esc_html__( 'Style', 'spider-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    '1' => [
                        'title' => __( 'Hover With Image', 'spider-elements' ),
                        'icon' => 'himage1',
                    ],
                    '2' => [
                        'title' => __( 'Hover With Image', 'spider-elements' ),
                        'icon' => 'himage2',
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
        $this->elementor_style_control();
    }

    public function elementor_style_control() {

        //============================ Tab Style ============================//
		$this->start_controls_section(
			'style_img_hover_sec', [
				'label' => __( 'Image Box', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'style_img_hover_bg', [
				'label' => __( 'Image Overlay Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .sp_image_hover' => 'background: {{VALUE}};',
                ),
			]
		); 

    	$this->end_controls_tab(); // End Active Tab 
        $this->end_controls_section();

        $this->start_controls_section(
			'style_img_hover_content', [
				'label' => __( 'Hover Content Style', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		); 
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name' => 'hover_title_typo',
                'label' => esc_html__( 'Title Typography', 'spider-elements' ),
				'selector' => '{{WRAPPER}} .sp_image_hover figcaption h3',
			]
		);
        $this->add_control(
            'hover_title_color',
            [
                'label' => __( 'Title Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sp_image_hover figcaption h3' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .sp_image_hover figcaption h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'unit' => 'px', // The selected CSS Unit. 'px', '%', 'em',
                ],
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name' => 'hover_caption_typo',
                'label' => esc_html__( 'Content Typography', 'spider-elements' ),
				'selector' => '{{WRAPPER}} .sp_image_hover figcaption p',
			]
		);
        $this->add_control(
            'hover_caption_color',
            [
                'label' => __( 'Content Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sp_image_hover figcaption p' => 'color: {{VALUE}};',
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
        $settings = $this->get_settings();
        $image_id = $settings['hover_image']['id'];
        function se_el_image( $image_id ) {
            $img_attachment = get_post( $image_id );
                return array(
                    'alt' => get_post_meta( $img_attachment->ID, '_wp_attachment_image_alt', true ),
                    'caption' => $img_attachment->post_excerpt,
                    'href' => get_permalink( $img_attachment->ID ),
                    'src' => $img_attachment->guid,
                    'title' => $img_attachment->post_title
                );
            }
            
            $img_attachment_meta = se_el_image($image_id);
        ?>
            
        <?php
        //================= Template Parts =================//
        include "templates/image-hover/image-hover-{$settings['style']}.php";
    }
}
