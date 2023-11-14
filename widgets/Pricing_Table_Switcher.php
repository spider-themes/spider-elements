<?php

namespace Spider_Elements\Widgets;

use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Image_hover
 */
class Pricing_Table_Switcher extends Widget_Base {
	public function get_name() {
		return 'pricing_table_switcher';
	}

	public function get_title() {
		return __( 'Pricing Table Switcher', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-price-table spe-icon';
	}

	public function get_keywords() {
		return [ 'spider', 'spider elements', 'pricing', 'table', 'switcher' ];
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'bootstrap', 'spe-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'bootstrap' ];
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
	 * Desc: Register content
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	public function elementor_content_control() {


		//===================== Select Preset ===========================//
		$this->start_controls_section(
			'style_sec', [
				'label' => esc_html__( 'Preset Skins', 'spider-elements' ),
			]
		);

//        $this->add_control(
//            'style', [
//                'label'   => esc_html__( 'Style', 'spider-elements' ),
//                'type'    => Controls_Manager::SELECT,
//                'options' => [
//                    '1' => esc_html__( '01: Button Switcher', 'spider-elements' ),
//                    '2' => esc_html__( '02: Tab Switcher', 'spider-elements' ),
//                    '3' => esc_html__( '03: Pricing Cloud', 'spider-elements' ),
//                    '4' => esc_html__( '04: Button Switcher', 'spider-elements' ),
//                    '5' => esc_html__( '05: Button Switcher', 'spider-elements' ),
//                    '6' => esc_html__( '06: Tab Switcher', 'spider-elements' ),
//                    '7' => esc_html__( '07: Button Switcher', 'spider-elements' ),
//                ],
//                'default' => '1',
//            ]
//        );

		$this->add_control(
			'style', [
				'label'   => esc_html__( 'Pricing Style', 'spider-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'icon'  => 'pricing_style1',
						'title' => esc_html__( '01 : Button Switcher', 'spider-elements' )
					],
					'2' => [
						'icon'  => 'pricing_style2',
						'title' => esc_html__( '02 : Tab Switcher', 'spider-elements' ),
					],
					'3' => [
						'icon'  => 'pricing_style3',
						'title' => esc_html__( '03 : Pricing Cloud', 'spider-elements' ),
					],
					'4' => [
						'icon'  => 'pricing_style4',
						'title' => esc_html__( '04 : Button Switcher', 'spider-elements' ),
					],
					'5' => [
						'icon'  => 'pricing_style5',
						'title' => esc_html__( '05 : Button Switcher', 'spider-elements' ),
					],
					'6' => [
						'icon'  => 'pricing_style6',
						'title' => esc_html__( '06 : Tab Switcher', 'spider-elements' ),
					],
					'7' => [
						'icon'  => 'pricing_style7',
						'title' => esc_html__( '07 : Button Switcher', 'spider-elements' ),
					],
				],
				'default' => '1',
			]
		);

		$this->end_controls_section(); //End Select Style


		//============================ Pricing Table Tab 01 ==================================//
		$this->start_controls_section(
			'pricing_table_tab1_sec', [
				'label'     => esc_html__( 'Tab 01', 'spider-elements' ),
				'condition' => [
					'style' => [ '1', '2', '3', '4', '5' ]
				]
			]
		);

		$this->add_control(
			'tab1_title', [
				'label'       => esc_html__( 'Title', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Monthly',
			]
		);

		//===== Table 01
		$tab_1 = new Repeater();
		$tab_1->add_control(
			'table_icon', [
				'label' => esc_html__( 'Icon', 'spider-elements' ),
				'type'  => Controls_Manager::MEDIA,
			]
		);

		$tab_1->add_control(
			'title', [
				'label'       => esc_html__( 'Title', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'STARTER', 'spider-elements' ),
				'label_block' => true,
			]
		);

		$tab_1->add_control(
			'subtitle', [
				'label' => esc_html__( 'Description', 'spider-elements' ),
				'type'  => Controls_Manager::TEXT,
			]
		);

		$tab_1->add_control(
			'price', [
				'label'       => esc_html__( 'Price', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '$18.99',
				'label_block' => true,
			]
		);

		$tab_1->add_control(
			'contents', [
				'label'       => esc_html__( 'Content', 'spider-elements' ),
				'type'        => Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

		$tab_1->add_control(
			'btn_label', [
				'label'       => esc_html__( 'Button label', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Buy Plan', 'spider-elements' ),
				'label_block' => true,
			]
		);

		$tab_1->add_control(
			'btn_url', [
				'label'   => esc_html__( 'Button URL', 'spider-elements' ),
				'type'    => Controls_Manager::URL,
				'default' => [
					'url' => '#'
				],
			]
		);

		$this->add_control(
			'pricing_table_1', [
				'label'         => esc_html__( 'Tab 01 List', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $tab_1->get_controls(),
				'title_field'   => '{{{ title }}}',
				'prevent_empty' => false,
				'condition'     => [
					'style' => '1'
				],
				'separator'     => 'before'
			]
		); //End Table Style 01


		//===== Table Style 02
		$tab_2 = new Repeater();
		$tab_2->add_control(
			'title', [
				'label'       => esc_html__( 'Title', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Free', 'spider-elements' ),
				'label_block' => true,
			]
		);

		$tab_2->add_control(
			'price', [
				'label'   => esc_html__( 'Price', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( '$18.99', 'spider-elements' ),
			]
		);

		$tab_2->add_control(
			'duration', [
				'label'   => esc_html__( 'Duration', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'm', 'spider-elements' ),
			]
		);

		$tab_2->add_control(
			'contents', [
				'label' => esc_html__( 'Contents', 'spider-elements' ),
				'type'  => Controls_Manager::WYSIWYG,
			]
		);

		$tab_2->add_control(
			'btn_label', [
				'label'       => esc_html__( 'Button label', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Buy Plan', 'spider-elements' ),
				'label_block' => true,
				'separator'   => 'before',
			]
		);

		$tab_2->add_control(
			'btn_url', [
				'label'   => esc_html__( 'Button URL', 'spider-elements' ),
				'type'    => Controls_Manager::URL,
				'default' => [
					'url' => '#'
				],
			]
		);

		$this->add_control(
			'pricing_table_3', [
				'label'         => esc_html__( 'Tab 02 List', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $tab_2->get_controls(),
				'title_field'   => '{{{ title }}}',
				'prevent_empty' => false,
				'condition'     => [
					'style' => '2'
				],
				'separator'     => 'before'
			]
		); //End Table Style 02


		//===== Table 03
		$tab_3 = new Repeater();
		$tab_3->add_control(
			'is_favorite', [
				'label'        => __( 'Is Favorite', 'spider-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'spider-elements' ),
				'label_off'    => __( 'Hide', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'after'
			]
		);

		$tab_3->add_control(
			'title', [
				'label'   => esc_html__( 'Title', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Included',
			]
		);

		$tab_3->add_control(
			'subtitle', [
				'label'   => esc_html__( 'Subtitle', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '10GB',
			]
		);

		$tab_3->add_control(
			'contents', [
				'label' => esc_html__( 'Content', 'spider-elements' ),
				'type'  => Controls_Manager::TEXTAREA,
			]
		);

		$tab_3->add_control(
			'price', [
				'label'   => esc_html__( 'Price', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$18.99',
			]
		);

		$tab_3->add_control(
			'btn_label', [
				'label'       => esc_html__( 'Button label', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Purchase',
				'label_block' => true,
			]
		);

		$tab_3->add_control(
			'btn_url', [
				'label'   => esc_html__( 'Button URL', 'spider-elements' ),
				'type'    => Controls_Manager::URL,
				'default' => [
					'url' => '#'
				],
			]
		);

		$this->add_control(
			'pricing_table_5', [
				'label'         => esc_html__( 'Tab 01 List', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $tab_3->get_controls(),
				'title_field'   => '{{{ title }}}',
				'prevent_empty' => false,
				'condition'     => [
					'style' => '3'
				],
			]
		); //End Table Style 03


		//===== Table 04
		$tab_4 = new Repeater();
		$tab_4->add_control(
			'title', [
				'label'   => esc_html__( 'Title 1', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'The Basics',
			]
		);

		$tab_4->add_control(
			'subtitle', [
				'label'   => esc_html__( 'Subtitle', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Free for 7 days then',
			]
		);

		$tab_4->add_control(
			'price', [
				'label'   => esc_html__( 'Price', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$18.99',
			]
		);

		$tab_4->add_control(
			'duration', [
				'label'   => esc_html__( 'Duration', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '/ Month',
			]
		);

		$tab_4->add_control(
			'contents', [
				'label' => esc_html__( 'Content', 'spider-elements' ),
				'type'  => Controls_Manager::WYSIWYG,
			]
		);

		$tab_4->add_control(
			'btn_label', [
				'label'       => esc_html__( 'Button label', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Start Free Trial',
				'label_block' => true,
			]
		);

		$tab_4->add_control(
			'btn_url', [
				'label'   => esc_html__( 'Button URL', 'spider-elements' ),
				'type'    => Controls_Manager::URL,
				'default' => [
					'url' => '#'
				],
			]
		);

		$this->add_control(
			'pricing_table_7', [
				'label'         => esc_html__( 'Tab 01 List', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $tab_4->get_controls(),
				'title_field'   => '{{{ title }}}',
				'prevent_empty' => false,
				'condition'     => [
					'style' => '4'
				],
			]
		); //End Table Style 04


		//===== Table 05
		$tab_5 = new Repeater();
		$tab_5->add_control(
			'title', [
				'label'   => esc_html__( 'Title', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Starter',
			]
		);

		$tab_5->add_control(
			'price', [
				'label'   => esc_html__( 'Price', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '15 USD',
			]
		);

		$tab_5->add_control(
			'duration', [
				'label'   => esc_html__( 'Duration', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '/ mo',
			]
		);

		$tab_5->add_control(
			'f_title', [
				'label'   => esc_html__( 'Features Title', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Includes:',
			]
		);

		$tab_5->add_control(
			'contents', [
				'label' => esc_html__( 'Content', 'spider-elements' ),
				'type'  => Controls_Manager::WYSIWYG,
			]
		);

		$tab_5->add_control(
			'btn_label', [
				'label'       => esc_html__( 'Button label', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Purchase',
				'label_block' => true,
			]
		);

		$tab_5->add_control(
			'btn_url', [
				'label'   => esc_html__( 'Button URL', 'spider-elements' ),
				'type'    => Controls_Manager::URL,
				'default' => [
					'url' => '#'
				],
			]
		);

		$this->add_control(
			'pricing_table_9', [
				'label'         => esc_html__( 'Tab 01 List', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $tab_5->get_controls(),
				'title_field'   => '{{{ title }}}',
				'prevent_empty' => false,
				'condition'     => [
					'style' => '5'
				],
			]
		); //End Table Style 05

		$this->end_controls_section(); //End Pricing Table Tabs


		//=========================== Pricing Table Tab 02 =============================//
		$this->start_controls_section(
			'pricing_table_tab2_sec', [
				'label'     => esc_html__( 'Tab 02', 'spider-elements' ),
				'condition' => [
					'style' => [ '1', '2', '3', '4', '5' ]
				],
			]
		);

		$this->add_control(
			'tab2_title', [
				'label'       => esc_html__( 'Title', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Yearly',
			]
		);

		//====== Table Style 01
		$this->add_control(
			'pricing_table_2', [
				'label'         => esc_html__( 'Tab 02 List', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $tab_1->get_controls(),
				'title_field'   => '{{{ title }}}',
				'prevent_empty' => false,
				'condition'     => [
					'style' => '1'
				],
			]
		);

		//====== Table Style 02
		$this->add_control(
			'pricing_table_4', [
				'label'         => esc_html__( 'Tab 02 List', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $tab_2->get_controls(),
				'title_field'   => '{{{ title }}}',
				'prevent_empty' => false,
				'condition'     => [
					'style' => '2'
				],
			]
		);

		//====== Table Style 03
		$this->add_control(
			'pricing_table_6', [
				'label'         => esc_html__( 'Tab 01 List', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $tab_3->get_controls(),
				'title_field'   => '{{{ title }}}',
				'prevent_empty' => false,
				'condition'     => [
					'style' => '3'
				],
			]
		);

		//======== Table Style 04
		$this->add_control(
			'pricing_table_8', [
				'label'         => esc_html__( 'Tab 01 List', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $tab_4->get_controls(),
				'title_field'   => '{{{ title }}}',
				'prevent_empty' => false,
				'condition'     => [
					'style' => '4'
				],
			]
		);


		//========== Table Style 05
		$this->add_control(
			'pricing_table_10', [
				'label'         => esc_html__( 'Tab 01 List', 'spider-elements' ),
				'type'          => Controls_Manager::REPEATER,
				'fields'        => $tab_5->get_controls(),
				'title_field'   => '{{{ title }}}',
				'prevent_empty' => false,
				'condition'     => [
					'style' => '5'
				],
			]
		);

		$this->end_controls_section(); //End Pricing Table Tab 02


		//========================== Table Style 06, 07 ============================//
		$this->start_controls_section(
			'pricing_table_sec', [
				'label'     => esc_html__( 'Pricing Table', 'spider-elements' ),
				'condition' => [
					'style' => [ '6', '7' ]
				]
			]
		);

		$this->start_controls_tabs(
			'pricing_table_tabs'
		);

		//==== Monthly Tabs
		$this->start_controls_tab(
			'monthly_tab', [
				'label' => esc_html__( 'Tab 01', 'spider-elements' ),
			]
		);

		$this->add_control(
			'tab1_title2', [
				'label'     => esc_html__( 'Tab Title 2', 'spider-elements' ),
				'type'      => Controls_Manager::TEXT,
				'default'   => 'Monthly',
				'separator' => 'after'
			]
		);

		$this->add_control(
			'tab1_old_price', [
				'label'   => esc_html__( 'Old Price', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '99.99',
			]
		);

		$this->add_control(
			'tab1_current_price', [
				'label'   => esc_html__( 'Current Price', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '79.49',
			]
		);

		$this->add_control(
			'tab1_discount_price', [
				'label'   => esc_html__( 'Discount Price', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$45.25% OFF',
			]
		);

		$this->add_control(
			'tab1_duration', [
				'label'   => esc_html__( 'Duration', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => ' /month',
			]
		);

		$this->add_control(
			'tab1_bottom_content', [
				'label'       => esc_html__( 'Contents', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'for the first month',
				'label_block' => true,
			]
		);

		$this->end_controls_tab();

		//==== Yearly Tabs
		$this->start_controls_tab(
			'yearly_tab', [
				'label' => esc_html__( 'Tab 02', 'spider-elements' ),
			]
		);

		$this->add_control(
			'tab2_title2', [
				'label'   => esc_html__( 'Tab Title', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Annual',
			]
		);

		$this->add_control(
			'tab2_old_price', [
				'label'   => esc_html__( 'Old Price', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '99.99',
			]
		);

		$this->add_control(
			'tab2_current_price', [
				'label'   => esc_html__( 'Current Price', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '79.49',
			]
		);

		$this->add_control(
			'tab2_discount_price', [
				'label'   => esc_html__( 'Discount Price', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$45.25% OFF',
			]
		);

		$this->add_control(
			'tab2_duration', [
				'label'   => esc_html__( 'Duration', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => ' /year',
			]
		);

		$this->add_control(
			'tab2_bottom_content', [
				'label'       => esc_html__( 'Contents', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'for the first year',
				'label_block' => true,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs(); //End Tabs

		$this->end_controls_section(); //End Table Style 06


		//========================== Column Grid ============================//
		$this->start_controls_section(
			'column_grid_sec', [
				'label'     => esc_html__( 'Column Grid', 'spider-elements' ),
				'condition' => [
					'style' => [ '1', '2', '3', '4', '5', '6' ]
				]
			]
		);

		$this->add_control(
			'column', [
				'label'   => esc_html__( 'Column', 'spider-elements' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'6' => esc_html__( 'Two', 'spider-elements' ),
					'4' => esc_html__( 'Three', 'spider-elements' ),
					'3' => esc_html__( 'Four', 'spider-elements' ),
				],
				'default' => '4',
			]
		);

		$this->add_responsive_control(
			'pricing_column_gap',
			[
				'label'      => esc_html__( 'Gap', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range'      => [
					'px' => [
						'max' => 100,
					],
					'em' => [
						'max' => 0,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .pricing-item-two-cotnainer' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); //End Column Grid

	}


	/**
	 * Name: elementor_style_control()
	 * Desc: Register style content
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	public function elementor_style_control() {


		//=============================== Start Switcher Title ===================================//
		$this->start_controls_section(
			'switcher_title_style', [
				'label'     => esc_html__( 'Switcher Title', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => [ '1', '3', '4', '5', '7' ]
				],
			]
		);


		// Start Title Normal/Active State
		$this->start_controls_tabs(
			'style_title_tabs'
		);

		// Normal Tab Title
		$this->start_controls_tab(
			'style_title_normal',
			[
				'label' => __( 'Normal', 'spider-elements' ),
			]
		);

		$this->add_control(
			'normal_title_text_color',
			[
				'label'     => __( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .spe_pricing_title' => 'color: {{VALUE}};',
				)
			]
		);

		$this->add_control(
			'normal_title_border',
			[
				'label'     => __( 'Border Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'style' => '4'
				],
				'selector'  => array(
					'{{WRAPPER}} .spe_pricing_title' => 'color: {{VALUE}}',
				)
			]
		);

		$this->end_controls_tab(); //End Normal Tab Title


		//=== Active Tab Title
		$this->start_controls_tab(
			'style_tab_title_active',
			[
				'label' => __( 'Active', 'spider-elements' ),
			]
		);

		$this->add_control(
			'active_title_text_color',
			[
				'label'     => __( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spe_pricing_title.active' => 'color: {{VALUE}};',
				]
			]
		);

		$this->add_control(
			'active_title_border',
			[
				'label'     => __( 'Border Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'style' => '4'
				],
				'selector'  => array(
					'{{WRAPPER}} .spe_pricing_title.active' => 'color: {{VALUE}}',
				)
			]
		);

		$this->end_controls_tabs(); // End Active Tab Title
		$this->end_controls_tab(); // End Title Normal/Active State

		$this->end_controls_section(); //End Switcher Title


		//=============================== Pricing  Content  ===================================//

		// star pricing content section
		$this->start_controls_section(
			'pricing_table_contents',
			[
				'label' => esc_html__( 'Pricing Table Style', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pricing_item_bg',
			[
				'label'     => esc_html__( 'Background Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .spe_pricing_item_wrapper' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'pricing_item_padding',
			[
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .spe_pricing_item_wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pricing_item_margin',
			[
				'label'      => esc_html__( 'Margin', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .spe_pricing_item_wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'pricing_item_border',
				'label'    => esc_html__( 'Border Type', 'spider-elements' ),
				'selector' => '{{WRAPPER}} .spe_pricing_item_wrapper',
			]
		);

		$this->add_control(
			'pricing_item_border_radius',
			[
				'label'     => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 4,
				],
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}}'                           => 'border-radius: {{SIZE}}px;',
					'{{WRAPPER}} .spe_pricing_item_wrapper' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'pricing_item_boxShadow',
				'selectors' => [
					'{{WRAPPER}} .spe_pricing_item_wrapper',
				],
			]
		);

		$this->end_controls_section();   //End pricing Content Section


		//  Start Header Style
		$this->start_controls_section(
			'pricing_table_contents_heading',
			[
				'label' => esc_html__( 'Header', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pricing_table_contents_heading_title',
			[
				'label' => esc_html__( 'Title Style', 'spider-elements' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'pricing_table_contents_heading_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .spe_pricing_item_header' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pricing_table_contents_heading_typo',
				'selector' => '{{WRAPPER}} .spe_pricing_item_header',
			]

		);

		$this->add_control(
			'pricing_item_contents_color',
			[
				'label'     => esc_html__( 'Content Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .spe_pricing_item_content' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pricing_item_contents_typo',
				'label'    => 'Content Typography',
				'selector' => '{{WRAPPER}} .spe_pricing_item_content',
			]

		);

		$this->end_controls_section();   // End  Header Style


		// Star Pricing Style
		$this->start_controls_section(
			'pricing_table_contents_price',
			[
				'label' => esc_html__( 'Pricing', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'pricing_table_contents_style',
			[
				'label' => esc_html__( 'Title Style', 'spider-elements' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'pricing_table_contents_price_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .spe_price' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pricing_table_contents_price_typo',
				'selector' => '{{WRAPPER}} .spe_price',
			]

		);

		$this->add_control(
			'pricing_table_contents_duration_color',
			[
				'label'     => esc_html__( 'Duration Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'style' => [ '2', '4' ]
				],
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .pricing-item-3 .price span, .app-pricing-item .item-price .time' => 'color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'pricing_table_contents_duration_typo',
				'label'     => 'Duration Typography',
				'selector'  => '{{WRAPPER}} .pricing-item-3 .price span, .app-pricing-item .item-price .time',
				'condition' => [
					'style' => [ '2', '4' ]
				],
			]

		);

		$this->end_controls_section();  //End Pricing style

		// Start Button Style

		$this->start_controls_section(
			'pricing_table_contents_btn_style',
			[
				'label' => esc_html__( 'Button', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'pricing_table_contents_btn_padding',
			[
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .spe_pricing_item_btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'pricing_table_contents_btn_margin',
			[
				'label'      => esc_html__( 'Margin', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .spe_pricing_item_btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pricing_table_contents_btn_typo',
				'selector' => '{{WRAPPER}} .spe_pricing_item_btn',
			]
		);


		$this->start_controls_tabs( 'pricing_table_contents_btn_tabs' );

		// Normal State Tab
		$this->start_controls_tab( 'pricing_table_contents_btn_tabs_normal', [ 'label' => esc_html__( 'Normal', 'spider-elements' ) ] );

		$this->add_control(
			'pricing_contents_btn_normal_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				// 'default'   => '#212529',
				'selectors' => [
					'{{WRAPPER}} .spe_pricing_item_btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pricing_contents_btn_normal_bg',
			[
				'label'     => esc_html__( 'Background Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spe_pricing_item_btn' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'pricing_contents_btn_border',
				'label'    => esc_html__( 'Border', 'spider-elements' ),
				'selector' => '{{WRAPPER}} .spe_pricing_item_btn',
			]
		);

		$this->add_control(
			'pricing_contents_btn_border_radius',
			[
				'label'     => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'max' => 50,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .spe_pricing_item_btn' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_tab();

		// Hover State Tab
		$this->start_controls_tab( 'pricing_contents_btn_hover', [ 'label' => esc_html__( 'Hover', 'spider-elements' ) ] );

		$this->add_control(
			'pricing_contents_btn_hover_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .spe_pricing_item_btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pricing_contents_btn_hover_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#eb5757',
				'selectors' => [
					'{{WRAPPER}} .spe_pricing_item_btn:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'pricing_contents_btn_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#eb5757',
				'selectors' => [
					'{{WRAPPER}} .spe_pricing_item_btn:hover' => 'border-color: {{VALUE}};',
				],
			]

		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'pricing_contents_btn_boxShadow',
				'selector'  => '{{WRAPPER}} .spe_pricing_item_btn',
				'separator' => 'before',
			]
		);

		$this->end_controls_section();   //End Button style


		//=============================== Shape Images ===================================//
		$this->start_controls_section(
			'shape_images', [
				'label'     => esc_html__( 'Shape Images', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => [ '1' ]
				]
			]
		);

		$this->add_control(
			'is_shape_image', [
				'label'        => esc_html__( 'Show Shape Image', 'spider-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'spider-elements' ),
				'label_off'    => esc_html__( 'Hide', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'shape1', [
				'label'     => esc_html__( 'Shape ', 'spider-elements' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => [
					'is_shape_image' => 'yes'
				]
			]
		);

		$this->add_control(
			'shape2', [
				'label'     => esc_html__( 'Shape 2', 'spider-elements' ),
				'type'      => Controls_Manager::MEDIA,
				'condition' => [
					'is_shape_image' => 'yes'
				]
			]
		);

		$this->end_controls_section(); //End Shape Images


	}


	/**
	 * Name: elementor_render()
	 * Desc: Render widget output on the frontend.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		extract( $settings ); // extract all settings array to variables converted to name of key

		$tables  = isset( $settings['pricing_table_1'] ) ? $settings['pricing_table_1'] : '';
		$tables2 = isset( $settings['pricing_table_2'] ) ? $settings['pricing_table_2'] : '';


		//Include template parts
		include "templates/pricing-table-switcher/table-switcher-{$settings['style']}.php";

	}

}