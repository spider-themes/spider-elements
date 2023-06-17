<?php
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
        return __( 'Box Hover ()', 'spider-elements' );
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
            'section_alert',
            [
                'label' => __( 'Quote Texts', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'spider-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => 'Docy cares deeply
about journalism.'
            ]
        );

        $this->add_control(
            'quote',
            [
                'label' => __( 'Quote Text', 'spider-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'name',
            [
                'label' => __( 'Quote Author Name', 'spider-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'designation',
            [
                'label' => __( 'Quote Author Designation', 'spider-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

	    $this->add_control(
		    'btm_text',
		    [
			    'label' => __( 'Bottom Text', 'spider-elements' ),
			    'type' => Controls_Manager::TEXT,
			    'label_block' => true,
                'default' => 'OUR COMMITMENT'
		    ]
	    );

        $this->add_control(
            'quote_icon_left',
            [
                'label' => __( 'Quote Icon Top', 'spider-elements' ),
                'type' => Controls_Manager::MEDIA,
                'separator' => 'before',
                'default' => [
                    'url' => plugins_url('images/quote-top.png', __FILE__)
                ]
            ]
        );

        $this->add_control(
            'quote_icon_right',
            [
                'label' => __( 'Quote Icon Bottom', 'spider-elements' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => plugins_url('images/quote-bottom.png', __FILE__)
                ]
            ]
        );

        $this->end_controls_section();

	    /**
	     * Right Side Image
	     */
	    $this->start_controls_section(
		    'section_right_image_opt',
		    [
			    'label' => __( 'Right Side', 'spider-elements' ),
		    ]
	    );

	    $this->add_control(
		    'right_image',
		    [
			    'label' => __( 'Right Side Image', 'spider-elements' ),
			    'type' => Controls_Manager::MEDIA,
		    ]
	    );

	    $this->add_control(
		    'background',
		    [
			    'label' => __( 'Background Circle Color', 'spider-elements' ),
			    'type' => Controls_Manager::COLOR,
		    ]
	    );

	    $this->add_control(
		    'background2',
		    [
			    'label' => __( 'Background Circle Color 02', 'spider-elements' ),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .journalism-feature-image:before' => 'background-image: linear-gradient(45deg, {{background.VALUE}} 0%, {{VALUE}} 100%);',
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
                'label' => esc_html__( 'Text Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .journalism-content-wrapper .journalism-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'label' => esc_html__( 'Typography', 'spider-elements' ),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .journalism-content-wrapper .journalism-title',
            ]
        );

        $this->end_controls_section();


	    /**
	     * Styl Quote Text
	     */
        $this->start_controls_section(
            'section_quote_text_style',
            [
                'label' => __( 'Quote Text', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'quote_text_color',
            [
                'label' => __( 'Text Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .journalism-content-wrapper p' => 'color: {{VALUE}};',
                ],
            ]
        );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(), [
			    'name' => 'typography_quote_text',
			    'label' => esc_html__( 'Typography', 'spider-elements' ),
			    'scheme' => Typography::TYPOGRAPHY_1,
			    'selector' => '{{WRAPPER}} .journalism-content-wrapper p',
		    ]
	    );

        $this->end_controls_section();


	    /**
	     * Style Quote Author Name
	     */
        $this->start_controls_section(
            'section_quote_author_style',
            [
                'label' => __( 'Quote Author Name', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'quote_author_color',
            [
                'label' => __( 'Text Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .journalism-content-wrapper .journalism-info .name' => 'color: {{VALUE}};',
                ],
            ]
        );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(), [
			    'name' => 'typography_quote_author',
			    'label' => esc_html__( 'Typography', 'spider-elements' ),
			    'scheme' => Typography::TYPOGRAPHY_1,
			    'selector' => '{{WRAPPER}} .journalism-content-wrapper .journalism-info .name',
		    ]
	    );

        $this->end_controls_section();


	    /**
	     * Style Quote Author Name
	     */
        $this->start_controls_section(
            'quote_author_designation_style',
            [
                'label' => __( 'Quote Author Designation', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'quote_author_designation_color',
            [
                'label' => __( 'Text Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .journalism-content-wrapper .journalism-info .designation' => 'color: {{VALUE}};',
                ],
            ]
        );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(), [
			    'name' => 'typography_quote_author_designation',
			    'label' => esc_html__( 'Typography', 'spider-elements' ),
			    'scheme' => Typography::TYPOGRAPHY_1,
			    'selector' => '{{WRAPPER}} .journalism-content-wrapper .journalism-info .designation',
		    ]
	    );

        $this->end_controls_section();

	    /**
	     * Style Quote Author Name
	     */
        $this->start_controls_section(
            'btm_text_style',
            [
                'label' => __( 'Bottom Text', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'btm_text_color',
            [
                'label' => __( 'Text Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .light-header .title-light' => 'color: {{VALUE}};',
                ],
            ]
        );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(), [
			    'name' => 'typography_btm_text',
			    'label' => esc_html__( 'Typography', 'spider-elements' ),
			    'scheme' => Typography::TYPOGRAPHY_1,
			    'selector' => '{{WRAPPER}} .light-header .title-light',
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
        <section class="about-journalism">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 md-order">
                        <div class="journalism-content-wrapper">
                            <?php if ( !empty($settings['quote_icon_left']['url']) ) : ?>
                                <div class="quote wow fadeIn">
                                    <img src="<?php echo esc_url($settings['quote_icon_left']['url']) ?>" alt="<?php esc_attr_e('quote icon left', 'docy'); ?>">
                                </div>
                            <?php endif; ?>
                            <?php if ( !empty($settings['title']) ) : ?>
                                <h2 class="journalism-title wow fadeInUp" data-wow-delay="0.3s">
                                    <?php echo se_get_the_kses_post(nl2br($settings['title'])) ?>
                                </h2>
                            <?php endif; ?>
                            <?php if ( !empty($settings['quote']) ) : ?>
                                <p class="description wow fadeInUp" data-wow-delay="0.5s">
                                    <?php echo se_get_the_kses_post($settings['quote']) ?>
                                </p>
                            <?php endif; ?>

                            <div class="journalism-info wow fadeInUp" data-wow-delay="0.3s">
                                <?php if ( !empty($settings['name']) ) : ?>
                                    <h3 class="name"><?php echo wp_kses_post($settings['name']) ?></h3>
                                <?php endif; ?>
                                <?php if ( !empty($settings['designation']) ) : ?>
                                    <span class="designation"><?php echo se_get_the_kses_post($settings['designation']) ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if ( !empty($settings['quote_icon_right']['url']) ) : ?>
                                <div class="quote dmt-4 wow fadeIn" data-wow-delay="1s">
                                    <img src="<?php echo esc_url($settings['quote_icon_right']['url']) ?>" alt="quote">
                                </div>
                            <?php endif; ?>
                        </div>
                        <!-- /.journalism-content-wrapper -->
                    </div>
                    <!-- /.col-md-6 -->

                    <?php if ( !empty($settings['right_image']['id']) ) : ?>
                        <div class="col-lg-5">
                            <div class="se-journalism-feature-image wow fadeInRight" data-wow-delay="0.3s">
                                <?php echo wp_get_attachment_image($settings['right_image']['id'], 'full') ?>
                            </div>
                            <!-- /.journalism-feature-image -->
                        </div>
                    <?php endif; ?>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->

            <?php if ( !empty($settings['btm_text']) ) : ?>
                <div class="light-header">
                    <h2 class="title-light wow fadeInDown" data-wow-delay="0.4s">
                        <?php echo se_get_the_kses_post($settings['btm_text']) ?>
                    </h2>
                </div>
            <?php endif; ?>
        </section>
        <?php
    }
}
