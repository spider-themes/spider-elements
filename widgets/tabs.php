<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Docy Tabs
 * @since 1.0.0
 */
class Tabs extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'spider_elements_tabs';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Spider Tabs', 'spider-elements' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-tabs';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'spider-elements' ];
	}

    public function get_style_depends() {
        return [ 'se-main-style' ];
    }
    
    public function get_script_depends() {
        return [ 'sp-core-script' ];
    }

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
        // ------------------------------ Feature list ------------------------------
        $this->start_controls_section(
            'section_tabs',
            [
                'label' => __( 'Spider Tabs', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => __('Preset Tab Style', 'spider-elements'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => __('Classic Default', 'spider-elements'),
                    '2' => __('Sticky Tab', 'spider-elements'),
                ],
                'default' => '1',
            ]
        );

        $repeater = new Repeater();

		$repeater->add_control(
            'icon',
            [
                'label' => esc_html__('Icon', 'essential-addons-for-elementor-lite'),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $repeater->add_control(
            'tab_title',
            [
                'label' => __( 'Tab Title', 'spider-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Tab Title', 'spider-elements' ),
                'placeholder' => __( 'Tab Title', 'spider-elements' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tabs_content_type',
            [
                'label' => __('Content Type', 'spider-elements'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'content' => __('Content', 'spider-elements'),
                    'template' => __('Saved Templates', 'spider-elements'),
                ],
                'default' => 'content',
            ]
        );

		$repeater->add_control(
            'primary_templates',
            [
                'label' => __('Choose Template', 'spider-elements'),
                'type' => Controls_Manager::SELECT,
                // 'options' => docy_get_el_templates(),
                'condition' => [
                    'tabs_content_type' => 'template',
                ],
            ]
        );

        $repeater->add_control(
            'tab_content',
            [
                'label' => __( 'Content', 'spider-elements' ),
                'default' => __( 'Tab Content', 'spider-elements' ),
                'placeholder' => __( 'Tab Content', 'spider-elements' ),
                'type' => Controls_Manager::WYSIWYG,
                'show_label' => false,
                'condition' => [
                    'tabs_content_type' => 'content',
                ],
            ]
        );

        $repeater->end_controls_tab();

		$this->add_control(
            'tabs',
            [
                'label' => __( 'Tabs Items', 'spider-elements' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',
            ]
        );

		$this->end_controls_section();

        //--------------------- Section Color-----------------------------------//
        $this->start_controls_section(
            'style_tabs_sec',
            [
                'label' => __( 'Tabs Style', 'spider-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tab-typo',
                'label' => __( 'Typography', 'spider-elements' ),
                'scheme' => \Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .tab_shortcode .nav-tabs .nav-item .nav-link, {{WRAPPER}} .header_tab_items .nav.nav-tabs li a',
            ]
        );

		$this->add_control(
            'icon-size',
            [
                'label' => esc_html__( 'Icon Size', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .header_tab_items .nav.nav-tabs li a i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'tab-pad',[
                'label' => __( 'Padding', 'spider-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tab_shortcode .nav-tabs .nav-item .nav-link, {{WRAPPER}} .header_tab_items .nav.nav-tabs li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs(
        'style_tabs'
        );

        /// Normal  Style
        $this->start_controls_tab(
            'style_normal',
            [
                'label' => __( 'Normal', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'normal_title_font_color', [
                'label' => __( 'Title Font Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .tab-item-title, {{WRAPPER}} .header_tab_items .nav.nav-tabs li a' => 'color: {{VALUE}}',
                )
            ]
        );

		$this->add_control(
            'normal_bg_color', [
                'label' => __( 'Background Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .tab-item-title, {{WRAPPER}} .header_tab_items' => 'background: {{VALUE}};',
                )
            ]
        );

		$this->end_controls_tab();

        /// ----------------------------- Active Style--------------------------//
        $this->start_controls_tab(
            'style_active_btn',
            [
                'label' => __( 'Active', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'active_title_font_color', [
                'label' => __( 'Title Font Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .tab-item-title.active, {{WRAPPER}} .header_tab_items .nav.nav-tabs li a.active' => 'color: {{VALUE}};',
                )
            ]
        );

        $this->add_control(
            'active_bg_color', [
                'label' => __( 'Border Top Color', 'spider-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .tab-item-title::before' => 'background: {{VALUE}};',
                ),
                'condition' => [
                    'style' => ['1']
                ]
            ]
        );

        $this->end_controls_tab();

		$this->end_controls_section();

        //------------------------------------ Tab Border Radius -------------------------------------------//
        $this->start_controls_section(
            'sec_style', [
                'label' => __( 'Content', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => esc_html__( 'Border', 'spider-elements' ),
                'selector' => '{{WRAPPER}} .tab_shortcode .tab-content, {{WRAPPER}} .tab_shortcode .nav-tabs .nav-item .nav-link',
            ]
        );

        $this->add_responsive_control(
            'content-pad',[
                'label' => __( 'Padding', 'spider-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tab_shortcode .tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
        $settings = $this->get_settings();
        $tabs = $this->get_settings_for_display( 'tabs' );
        $id_int = substr( $this->get_id_int(), 0, 3 );
        include( SPIDER_ELEMENTS_PATH . '/widgets/inc/tabs/tabs-'. $settings['style'] .'.php' );
    }

	/**
	 * Render the widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<div class="title">
			{{{ settings.title }}}
		</div>
		<?php
	}
}
