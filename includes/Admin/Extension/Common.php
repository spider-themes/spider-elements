<?php
namespace Elementor;
namespace SPEL\includes\Admin\Extension;

use Elementor\Controls_Manager;
use Elementor\Element_Base;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Common {

	public function __construct() {

		// Elementor Heading Widget Support
		add_action( 'elementor/element/heading/section_title_style/after_section_end', [ $this, 'register_heading_widget_controls' ] );

        add_action( 'elementor/editor/before_render', [ $this, 'render_display_content' ], 99 );
        add_action( 'elementor/frontend/before_render', [ $this, 'render_display_content' ], 99 );
	}

    /*
     * Heading Widgets.
     */
	public function register_heading_widget_controls( Element_Base $element) {


		//=============== Start Highlighted Text ===============//
		$element->start_controls_section(
			'spel_highlighted_text_style', [
				'label' => esc_html__( 'Highlighted Text', 'spider-elements-pro' ) . SPEL_TEXT_BADGE,
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$element->add_control(
			'spe_highlighted_text_enable', [
				'type'               => \Elementor\Controls_Manager::SWITCHER,
				'label'              => esc_html__( 'Enable Highlighted', 'spider-elements-pro' ),
				'frontend_available' => true,
				'label_on'           => esc_html__( 'Enable', 'spider-elements-pro' ),
				'label_off'          => esc_html__( 'Disable', 'spider-elements-pro' ),
				'description'        => esc_html__( 'Highlighted text must be written in <span></span> tag. Example : Welcome to <span>Highlighted</span>', 'spider-elements-pro' ),
				'return_value'       => 'yes',
				'default'            => 'no',
			]
		);

		$element->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name' => 'spe_highlighted_text_typo',
				'selector' => '{{WRAPPER}} .elementor-heading-title span',
				'condition' => [
					'spe_highlighted_text_enable' => 'yes',
				],
			]
		);

		$element->add_control(
			'spe_highlighted_text_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements-pro' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-heading-title span' => 'color: {{VALUE}}',
				],
				'condition' => [
					'spe_highlighted_text_enable' => 'yes',
				],
			]
		);

		//Background
        $element->add_control(
            'spe_highlighted_text_bg_select', [
                'label' => esc_html__( 'Background Style', 'spider-elements-pro' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'none' => esc_html__( 'None', 'spider-elements-pro' ),
                    'bg'  => esc_html__( 'Background', 'spider-elements-pro' ),
                ],
                'default' => 'none',
                'separator' => 'before',
            ]
        );


        $element->add_group_control(
			\Elementor\Group_Control_Background::get_type(), [
				'name' => 'spe_highlighted_text_bg_color',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .elementor-heading-title span::after',
				'condition' => [
					'spe_highlighted_text_bg_select' => 'bg',
				],
			]
		);

		$element->add_responsive_control(
			'spe_highlighted_text_bg_width', [
				'label' => esc_html__( 'Width', 'spider-elements-pro' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-heading-title span::after' => 'width: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'spe_highlighted_text_bg_select' => 'bg',
                ],
			]
		);


        $element->add_responsive_control(
            'spe_highlighted_text_bg_height', [
                'label' => esc_html__( 'Height', 'spider-elements-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title span::after' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'spe_highlighted_text_bg_select' => 'bg',
                ],
            ]
        );

        $element->add_responsive_control(
            'spe_highlighted_text_bg_bottom', [
                'label' => esc_html__( 'Bottom', 'spider-elements-pro' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title span::after' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'spe_highlighted_text_bg_select' => 'bg',
                ],
            ]
        );


		$element->end_controls_section(); // End Section

	}

    /**
     * @param Element_Base $element
     * @return void
     * Render display content
     */
    public function render_display_content( Element_Base $element ) {

        $align_class = $element->get_settings_for_display( 'spe_highlighted_text_bg_select' );

        // It's render add class for background
        if ( ! empty( $align_class == 'bg' ) ) {

            //It's render elementor wrapper div
            $element->add_render_attribute(
                '_wrapper', [
                    'class'    => 'spe-highlighted-text-bg',
                ]
            );

        }
    }


}