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
class Box_hover extends Widget_Base {

    public function get_name() {
        return 'docy_box_hover';
    }

    public function get_title() {
        return __( 'Box Hover', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-blockquote';
    }

    public function get_keywords() {
        return [ 'box', 'hover' ];
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

    protected function register_controls() {

	    /**
	     * Quote Texts
	     */
        $this->start_controls_section(
            'section_text',
            [
                'label' => __( 'Box Hover Text', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'box_title',
            [
                'label' => __( 'Title', 'spider-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Docy cares deeply.'
            ]
        );

        $this->add_control(
            'box_description',
            [
                'label' => __( 'Description Text', 'spider-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Nostra adipiscing sequi nisi hic venenatis pede.'
            ]
        );

        $this->add_control(
            'box_image',
            [
                'label' => __( 'Image', 'spider-elements' ),
                'type' => Controls_Manager::MEDIA,
                'separator' => 'before',
                'default' => [
                    'url' => plugins_url('images/docs-3.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();

        /**
         * Box Style Title
         */
        $this->start_controls_section(
            'box_style',
            [
                'label' => __( 'Box Style', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'box_bg_color', [
				'label' => esc_html__('Background Color', 'spider-elements'),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .sp_box_hover' => 'background: {{VALUE}};',
				],
			]
		);
        $this->add_responsive_control(
			'box_padding', [
				'label' => esc_html__( 'Padding', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .sp_box_hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name'     => 'box_border',
                'selector' => '{{WRAPPER}} .sp_box_hover',
            ]
        );

        $this->add_responsive_control(
            'box_border_radius',
            [
                'label' => __('Border Radius', 'spider-elements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .sp_box_hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        /**
         * Style Title
         */
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __( 'Style Title', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color_title', [
                'label' => esc_html__( 'Title Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .box_hover_content h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'label' => esc_html__( 'Typography', 'spider-elements' ),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .box_hover_content h3',
            ]
        );

        $this->end_controls_section();


	    /**
	     * Styl Quote Text
	     */
        $this->start_controls_section(
            'box_des_text_style',
            [
                'label' => __( 'Box Text', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'box_des_text_color',
            [
                'label' => __( 'Box Text Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .box_hover_content p' => 'color: {{VALUE}};',
                ],
            ]
        );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(), [
			    'name' => 'typography_quote_text',
			    'label' => esc_html__( 'Typography', 'spider-elements' ),
			    'scheme' => Typography::TYPOGRAPHY_1,
			    'selector' => '{{WRAPPER}} .box_hover_content p',
		    ]
	    );

        $this->end_controls_section();

    }

    /**
     * Render alert widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     */
    protected function render() {
        $settings = $this->get_settings();
        ?>
        <a href="#" class="sp_box_hover">

            <?php if ( !empty($settings['box_image']['url']) ) : ?>
                <div class="box_img wow fadeIn">
                    <img src="<?php echo esc_url($settings['box_image']['url']) ?>" alt="<?php esc_attr_e('box image', 'docy'); ?>">
                </div>
            <?php endif; ?>             
            <div class="box_hover_content">
                <div class="text_top">
                    <?php if ( !empty($settings['box_title']) ) : ?>
                        <h3>
                            <?php echo se_get_the_kses_post(nl2br($settings['box_title'])) ?>
                        </h3>
                    <?php endif; ?>
                </div>
                <div class="text_two">
                    <?php if ( !empty($settings['box_description']) ) : ?>
                        <p class="description wow fadeInUp" data-wow-delay="0.5s">
                            <?php echo se_get_the_kses_post($settings['box_description']) ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </a>
        <?php
    }
}
