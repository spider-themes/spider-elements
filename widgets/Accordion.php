<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Class Accordion
 * @package spider\Widgets
 */
class Accordion extends Widget_Base {

    public function get_name() {
        return 'docy_accordion';
    }

    public function get_title() {
        return esc_html__( 'Spider Accordion', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_keywords() {
        return [ 'toggle' ];
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }


	/**
	 * Name: register_controls()
	 * Desc: Register controls for these widgets
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	protected function register_controls() {
		$this->elementor_content_control();
		$this->elementor_style_control();
	}

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'collapse_state', [
                'label' => esc_html__( 'Expanded', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'spider-elements' ),
                'label_off' => esc_html__( 'No', 'spider-elements' ),
                'return_value' => 'yes',
                'default' => 'se_accordion_title',
            ]
        );


        $repeater->add_control(
            'se_accordion_title', [
                'label' => __( 'Accordion Title', 'spider-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Accordion Title', 'spider-elements' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
                'selector' => '{{WRAPPER}} .#',
            ]
        );

        $repeater->add_control(
            'content_type',
            [
                'label'     => esc_html__( 'Content Type', 'spider-elements' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'content'        => esc_html__( 'Content', 'spider-elements'),
                    'el_template'   => esc_html__( 'Template', 'spider-elements'),
                ],
                'default' => 'content',
                'label_block' => true
                ]

        );

        $repeater->add_control(
            'normal_content', [
                'label' => __( 'Content Text', 'spider-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default' => __( 'Accordion Content', 'spider-elements' ),
                'condition' => [
                    'content_type' => 'content'
                ]

            ]

        );

        $repeater->add_control(
            'el_content', [
                'label'         => __( 'Select Template', 'spider-elements' ),
                'type'          => Controls_Manager::SELECT,
                'options'       => se_elementor_templates(),
                'label_block'   => true,
                'default'       => __( 'Accordion Content', 'spider-elements' ),
                'condition'     => [
                    'content_type' => 'el_template'
                ]
            ]
        );
        $repeater->add_control(
            'tab_content',
            [
                'label' => esc_html__( 'Content', 'spider-elements' ),
                'type' => Controls_Manager::WYSIWYG,
                'default' => esc_html__( 'Accordion Content', 'spider-elements' ),
                'show_label' => false,
            ]
        );

        $this->add_control(
            'se_accordion',
            [
                'label'     => 'Accordion Items',
                'type'      => Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'default'   => [
                    [
                        'se_accordion_title'    => esc_html__( 'Accordion #1', 'spider-elements' ),
                        'tab_content'           => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'spider-elements' ),
                    ],
                    [
                        'se_accordion_title'    => esc_html__( 'Accordion #2', 'spider-elements' ),
                        'tab_content'           => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'spider-elements' ),
                    ],
                ],
                'title_field' => '{{{ se_accordion_title }}}',
            ]
        );

        $this->add_control(
            'plus-icon',
            [
                'label' => __( 'Icon', 'spider-elements' ),
                'type' => Controls_Manager::ICONS,
                'label_block'   => true,
                'default' => [
                    'value' => 'fas fa-plus',
                    'library' => 'solid',
                ]
            ]
        );

        $this->add_control(
            'minus-icon',
            [
                'label' => __( 'Active Icon', 'spider-elements' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-minus',
                    'library' => 'solid',
                ]
            ]
        );

        $this->add_control(
            'se-toggle', [
                'label' => esc_html__( 'Toggle', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'spider-elements' ),
                'label_off' => esc_html__( 'No', 'spider-elements' ),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'title_tag', [
                'label' => __( 'Title Tag', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h6',
                'options' => se_el_title_tags(),
            ]
        );


		$this->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Content Text', 'spider-elements' ),
				'type' => Controls_Manager::WYSIWYG,
				'label_block' => true,
			]
		);

		$this->end_controls_section();
	}


	/**
	 * Name: elementor_style_control()
	 * Desc: Register the Style Tab output on the Elementor editor.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	public function elementor_style_control() {
		/**
		 * Style Tab
		 */
		$this->start_controls_section(
			'title_style_sec', [
				'label' => esc_html__( 'Style Title', 'spider-elements' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'color_title', [
				'label' => esc_html__( 'Text Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .doc_banner_text h2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bg_color_title', [
				'label' => esc_html__( 'Background Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .doc_banner_text h2' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'typography_title',
				'label' => esc_html__( 'Typography', 'spider-elements' ),
				'selector' => '{{WRAPPER}} .doc_banner_text h2',
			]
		);

		$this->end_controls_section();

		/**
		 * Content Styling
		 */
		$this->start_controls_section(
			'style_subtitle_sec', [
				'label' => esc_html__( 'Style Content', 'spider-elements' ),
				'tab' => Controls_Manager::TAB_STYLE
			]
		);

		$this->add_control(
			'color_subtitle', [
				'label' => esc_html__( 'Text Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .doc_banner_text p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bg_color_subtitle', [
				'label' => esc_html__( 'Background Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .doc_banner_text p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'label' => esc_html__( 'Subtitle Typography', 'spider-elements' ),
				'name' => 'typography_subtitle',
				'scheme' => Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .doc_banner_text p',
			]
		);

		$this->end_controls_section();
	}


	/**
	 * Name: elementor_render()
	 * Desc: Render the widget output on the frontend.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @banca
	 * Author: spider-themes
	 */
    protected function render() {
        $settings = $this->get_settings();
        if ( $settings['type'] == 'toggle' ) {
            include('includes/accordion/_toggle.php');
        }

        if ( $settings['type'] == 'accordion' ) {
            include('includes/accordion/_accordion.php');
        }
    }
}