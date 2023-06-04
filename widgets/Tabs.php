<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Tabs
 * @package spider\Widgets
 * @since 1.0.0
 */
class Tabs extends Widget_Base {

	public function get_name() {
		return 'docy_tabs';
	}

	public function get_title() {
		return esc_html__( 'Spider Tabs', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-tabs';
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


	/**
	 * Name: elementor_content_control()
	 * Desc: Register the Content Tab output on the Elementor editor.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	public function elementor_content_control() {

		// ============================ Select Style  ===========================//
		$this->start_controls_section(
			'select_style', [
				'label' => __( 'Preset Tab', 'spider-elements' ),
			]
		);

		$this->add_control(
			'style', [
				'label' => __('Tab', 'spider-elements'),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'1' => __('Classic Default', 'spider-elements'),
					'2' => __('Sticky Tab', 'spider-elements'),
				],
				'default' => '1',
			]
		);

        $this->end_controls_section(); // End select_style


		// ============================ Tabs ===========================//
		$this->start_controls_section(
			'sec_tabs', [
				'label' => __( 'Tabs', 'spider-elements' ),
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'icon', [
				'label' => esc_html__('Icon', 'spider-elements'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fa-lightbulb',
					'library' => 'fa-regular',
				],

			]
		);

		$repeater->add_control(
			'tab_title', [
				'label' => __( 'Tab Title', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => __( 'Tab Title', 'spider-elements' ),
				'placeholder' => __( 'Tab Title', 'spider-elements' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tabs_content_type', [
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
			'primary_templates', [
				'label' => __('Choose Template', 'spider-elements'),
				'type' => Controls_Manager::SELECT,
				'options' => se_get_el_templates(),
				'condition' => [
					'tabs_content_type' => 'template',
				],
			]
		);

		$repeater->add_control(
			'tab_content', [
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
			'tabs', [
				'label' => __( 'Add Items', 'spider-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ tab_title }}}',
				'default' => [
					[
						'tab_title' => esc_html__( 'Tab Title #1', 'textdomain' ),
						'tab_content' => esc_html__( 'Nostra adipiscing sequi nisi hic venenatis pede aliquid eget aperiam commodi gravida?', 'textdomain' ),
					],
					[
						'tab_title' => esc_html__( 'Tab Title #2', 'textdomain' ),
						'tab_content' => esc_html__( 'Nostra adipiscing sequi nisi hic venenatis pede aliquid eget aperiam commodi gravida?', 'textdomain' ),
					],
					[
						'tab_title' => esc_html__( 'Tab Title #3', 'textdomain' ),
						'tab_content' => esc_html__( 'Nostra adipiscing sequi nisi hic venenatis pede aliquid eget aperiam commodi gravida?', 'textdomain' ),
					],
				],
			]
		);

		$this->end_controls_section(); // End Tabs

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


        //============================ Tab Style ============================//
		$this->start_controls_section(
			'style_tabs_sec', [
				'label' => __( 'Tabs', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(), [
				'name' => 'tab_typo',
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
        $tabs = $this->get_settings_for_display( 'tabs' );
        $id_int = substr( $this->get_id_int(), 0, 3 );


        //================= Template Parts =================//
        include "templates/tabs/tab-{$settings['style']}.php";
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
