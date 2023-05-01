<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Alert widget.
 */
class Alerts_box extends Widget_Base {
    public function get_name() {
        return 'spider_alerts_box';
    }

    public function get_title() {
        return __( 'Spider Alert', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-alert';
    }

    public function get_keywords() {
        return [ 'alert', 'notice', 'message' ];
    }

    public function get_style_depends() {
        return [ 'elegant-icon' ];
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_alert',
            [
                'label' => __( 'Alert/Note', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'display_type',
            [
                'label' => __( 'Display Type', 'spider-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'alert',
                'options' => [
                    'alert' => __( 'Alert Box', 'spider-elements' ),
                    'note' => __( 'Note', 'spider-elements' ),
                    'note-with-icon' => __( 'Note With Icon', 'spider-elements' ),
                    'explanation' => __( 'Explanation', 'spider-elements' ),
                    'dual-box' => __( 'Dual Box Notice', 'spider-elements' ),
                    'block-notice' => __( 'Block Notice', 'spider-elements' ),
                ],
            ]
        );

        $this->add_control(
            'alert_type',
            [
                'label' => __( 'Type', 'spider-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'message',
                'options' => [
                    'message' => __( 'Message', 'spider-elements' ),
                    'warning' => __( 'Warning', 'spider-elements' ),
                    'info' => __( 'Info', 'spider-elements' ),
                    'success' => __( 'Success', 'spider-elements' ),
                    'danger' => __( 'Danger', 'spider-elements' ),
                ],
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'alert_title',
            [
                'label' => __( 'Title', 'spider-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Notice Message! Your message here'
            ]
        );

        $this->add_control(
            'alert_description',
            [
                'label' => __( 'Description', 'spider-elements' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'show_dismiss',
            [
                'label' => __( 'Dismiss Button', 'spider-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'show',
                'options' => [
                    'show' => __( 'Show', 'spider-elements' ),
                    'hide' => __( 'Hide', 'spider-elements' ),
                ],
                'condition' => [
                    'display_type' => ['alert']
                ]
            ]
        );

        $this->add_control(
            'icon',
            [
                'label' => __( 'Font-Awesome', 'spider-elements' ),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $this->end_controls_section();

        /**
         * Tab: Style
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
                    '{{WRAPPER}} .elementor-widget-docy_alerts_box .title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .explanation::after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .notice h5' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .nic-content-wrap .note-box h5' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color_title', [
                'label' => esc_html__( 'Background Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .explanation::after' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'display_type' => ['explanation']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'typography_title',
                'label' => esc_html__( 'Typography', 'spider-elements' ),
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .elementor-widget-docy_alerts_box .title, {{WRAPPER}} .block-notice-wrapper .title,  {{WRAPPER}}  .nic-content-wrap .note-box h5, {{WRAPPER}} .explanation::after, {{WRAPPER}} .notice h5',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_type',
            [
                'label' => __( 'Alert', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __( 'Text Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-docy_alerts_box p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .explanation p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .notice p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .nic-content-wrap .note-box p' => 'color: {{VALUE}};',
                ],
            ]
        );

	    $this->add_group_control(
		    Group_Control_Typography::get_type(), [
			    'name' => 'typography_content',
			    'label' => esc_html__( 'Typography', 'spider-elements' ),
			    'scheme' => Typography::TYPOGRAPHY_1,
			    'selector' => '{{WRAPPER}} .elementor-widget-docy_alerts_box p,{{WRAPPER}} .explanation p,{{WRAPPER}} .notice p, {{WRAPPER}} .nic-content-wrap .note-box p'
		    ]
	    );

        $this->add_control(
            'background',
            [
                'label' => __( 'Background Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .message_alert' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .notice:not(.dual-box-wrapper .dual-box-content .notice)' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .nic-alert .nic-content-wrap .note-box' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .dual-box-wrapper' => 'background-color: {{VALUE}};',

                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'background2',
            [
                'label' => __( 'Background Color 02', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .explanation' => 'background: linear-gradient(90deg, {{background.VALUE}}, {{VALUE}});',
                ],
                'condition' => [
                    'display_type' => ['explanation']
                ]
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label' => __( 'Border Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .message_alert' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .explanation::before' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .notice' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .note-with-icon .nic-content-wrap' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .dual-box-wrapper' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .dual-box-wrapper.notice-danger .dual-box-content' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_left-width',
            [
                'label' => __( 'Left Border Width', 'spider-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .notice' => 'border-left-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'display_type' => [ 'note' ]
                ]
            ]
        );

        $this->add_responsive_control(
            'padding',
            [
                'label' => __( 'Padding', 'spider-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .message_alert' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .media.notice' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .explanation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .note-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .dual-box-wrapper .dual-box-content .notice' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .block-notice-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

	    $this->add_control(
		    'dual-layer-alignment',
		    [
			    'label' => __( 'Layer Alignment', 'spider-elements' ),
			    'type' => \Elementor\Controls_Manager::CHOOSE,
			    'options' => [
				    'top-left' => [
					    'title' => __( 'Top Left', 'spider-elements' ),
					    'icon' => 'fa fa-align-left',
				    ],
				    'top-right' => [
					    'title' => __( 'Top Right', 'spider-elements' ),
					    'icon' => 'fa fa-align-right',
				    ],
				    'bottom-left' => [
					    'title' => __( 'Bottom Left', 'spider-elements' ),
					    'icon' => 'fa fa-align-left',
				    ],
				    'bottom-right' => [
					    'title' => __( 'Bottom Right', 'spider-elements' ),
					    'icon' => 'fa fa-align-right',
				    ],
			    ],
			    'default' => 'top-left',
			    'toggle' => true,
			    'condition' => [
				    'display_type' => [ 'dual-box' ]
			    ]
		    ]
	    );

        $this->end_controls_section();

	    $this->start_controls_section(
		    'section_icon',
		    [
			    'label' => __( 'Icon', 'spider-elements' ),
			    'tab' => Controls_Manager::TAB_STYLE,
			    'condition' => [
				    'display_type' => ['note-with-icon']
			    ]
		    ]
	    );

	    $this->add_control(
		    'icon_color',
		    [
			    'label' => __( 'Color', 'spider-elements' ),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .info-tab .icon-wrapper i' => 'color: {{VALUE}};',
			    ],
		    ]
	    );
	    $this->add_control(
		    'icon_bgcolor',
		    [
			    'label' => __( 'Background Color', 'spider-elements' ),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .nic-alert .nic-content-wrap .note-icon' => 'background-color: {{VALUE}};',
			    ]
		    ]
	    );
	    $this->add_control(
		    'icon_after_color',
		    [
			    'label' => __( 'Ribbon Color', 'spider-elements' ),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .nic-alert .note-icon .icon-wrapper::after' => 'background-color: {{VALUE}};',
			    ]
		    ]
	    );
        $this->end_controls_section();

	    $this->start_controls_section(
		    'dual_box_icon',
		    [
			    'label' => __( 'Icon', 'spider-elements' ),
			    'tab' => Controls_Manager::TAB_STYLE,
			    'condition' => [
				    'display_type' => ['dual-box']
			    ]
		    ]
	    );

	    $this->add_control(
		    'dual_box_icon_color',
		    [
			    'label' => __( 'Color', 'spider-elements' ),
			    'type' => Controls_Manager::COLOR,
			    'selectors' => [
				    '{{WRAPPER}} .dual-box-wrapper .dual-box-content .notice i' => 'color: {{VALUE}};',
			    ],
		    ]
	    );

	    $this->add_control(
		    'dual_box_icon_size',
		    [
			    'label' => __( 'Size', 'spider-elements' ),
			    'type' => Controls_Manager::SLIDER,
			    'range' => [
				    'px' => [
					    'min' => 0,
					    'max' => 100,
				    ],
			    ],
			    'selectors' => [
				    '{{WRAPPER}} .dual-box-wrapper .dual-box-content .notice i' => 'font-size: {{SIZE}}{{UNIT}};',
			    ],
		    ]
	    );

        $this->end_controls_section();

    }

    /**
     * Render alert widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings();
        ?>
        <?php if ( $settings['display_type'] == 'alert' ) : ?>
            <div class="alert media d-flex message_alert alert-<?php echo esc_attr($settings['alert_type']) ?> fade show" role="alert">
                <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <div class="media-body">
                    <?php if ( !empty($settings['alert_title']) ) : ?>
                        <h5 class="title"> <?php echo $settings['alert_title'] ?></h5>
                    <?php endif; ?>
                    <?php echo !empty($settings['alert_description']) ? $this->parse_text_editor($settings['alert_description']) : ''; ?>
                    <?php if ( 'show' === $settings['show_dismiss'] ) : ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icon_close"></i>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( $settings['display_type'] == 'note' ) : ?>
            <blockquote class="media d-flex notice notice-<?php echo esc_attr($settings['alert_type']) ?>">
                <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <div class="media-body">
                    <?php if ( !empty($settings['alert_title']) ) : ?>
                        <h5 class="title"> <?php echo $settings['alert_title'] ?></h5>
                    <?php endif; ?>
                    <?php echo $this->parse_text_editor(wpautop($settings['alert_description'])) ?>
                </div>
            </blockquote>
        <?php endif; ?>

        <?php if ( $settings['display_type'] == 'dual-box' ) : ?>
            <div class="dual-box-wrapper notice-<?php echo esc_attr($settings['alert_type'] .' '. $settings['dual-layer-alignment']) ?>">
                <div class="dual-box-content <?php echo esc_attr($settings['dual-layer-alignment']) ?>">

                    <div class="d-flex notice">
		                <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        <div class="media-body">
			                <?php if ( !empty($settings['alert_title']) ) : ?>
                                <h5 class="title"> <?php echo $settings['alert_title'] ?></h5>
			                <?php endif; ?>
			                <?php echo $this->parse_text_editor(wpautop($settings['alert_description'])) ?>
                        </div>
                    </div>

                </div>
            </div>
        <?php endif; ?>

        <?php if ( $settings['display_type'] == 'block-notice' ) : ?>
            <div class="block-notice-wrapper block-notice-<?php echo esc_attr($settings['alert_type']) ?>">
                <div class="block-notice-content-wrapper">
                    <div class="block-notice-icon">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </div>
                    <div class="block-notice-body">
                        <?php if ( !empty($settings['alert_title']) ) : ?>
                            <h5 class="title"> <?php echo $settings['alert_title'] ?></h5>
                        <?php endif; ?>
                        <?php echo $this->parse_text_editor(wpautop($settings['alert_description'])) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( $settings['display_type'] == 'note-with-icon' ) : ?>
            <div class="note-with-icon nic-alert nic-alert-<?php echo esc_attr($settings['alert_type']) ?>">
                <div class="nic-content-wrap">
                    <?php if( !empty($settings['icon']['value']) ) : ?>
                    <div class="info-tab note-icon" title="Important Notes">
                        <div class="icon-wrapper">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="note-box">
	                    <?php if ( !empty($settings['alert_title']) ) : ?>
                            <h5 class="title"> <?php echo $settings['alert_title'] ?></h5>
	                    <?php endif; ?>
	                    <?php echo $this->parse_text_editor(wpautop($settings['alert_description'])) ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <?php if ( $settings['display_type'] == 'explanation' ) : ?>
            <div class="explanation expn-left">
                <?php echo $this->parse_text_editor(wpautop($settings['alert_description'])) ?>
            </div>
            <?php if ( !empty($settings['alert_title']) ) : ?>
                <style>
                    .explanation::after {
                        font-family: "Roboto", sans-serif;
                        content: "<?php echo $settings['alert_title'] ?>";
                        text-transform: uppercase;
                        font-weight: 700;
                        top: -19px;
                        left: 1rem;
                        padding: 0 0.5rem;
                        font-size: 0.6rem;
                        position: absolute;
                        z-index: 1;
                        color: #000;
                        background: #fff;
                    }
            </style>
            <?php endif; ?>
        <?php endif; ?>

        <?php
    }
}