<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Class Image_hover
 * @package LandpagyCore\Widgets
 */
class Pricing_Table_Switcher extends Widget_Base {
    public function get_name() {
        return 'landpagy_pricing_table_switcher';
    }

    public function get_title() {
        return __( 'Pricing Table Switcher', 'landpagy-core' );
    }

    public function get_icon() {
        return 'eicon-price-table se-icon';
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
     * Package: @landpagy
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
     * Package: @landpagy
     * Author: spider-themes
     */
	public function elementor_content_control() {


        //===================== Select Preset ===========================//
        $this->start_controls_section(
            'style_sec', [
                'label' => esc_html__( 'Preset Skins', 'landpagy-core' ),
            ]
        );

        $this->add_control(
            'style', [
                'label'   => esc_html__( 'Style', 'landpagy-core' ),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__( '01: Button Switcher', 'landpagy-core' ),
                    '2' => esc_html__( '02: Tab Switcher', 'landpagy-core' ),
                    '3' => esc_html__( '03: Pricing Cloud', 'landpagy-core' ),
                    '4' => esc_html__( '04: Button Switcher', 'landpagy-core' ),
                    '5' => esc_html__( '05: Button Switcher', 'landpagy-core' ),
                    '6' => esc_html__( '06: Tab Switcher', 'landpagy-core' ),
                    '7' => esc_html__( '07: Button Switcher', 'landpagy-core' ),
                ],
                'default' => '1',
            ]
        );

        $this->end_controls_section(); //End Select Style


		//============================ Section Title ===========================//
		$this->start_controls_section(
			'sec_title', [
				'label' => esc_html__( 'Table Contents', 'landpagy-core' ),
                'condition' => [
                    'style' => [ '1', '4' ]
                ]
			]
		);

		$this->add_control(
			'title', [
				'label'       => esc_html__( 'Title', 'landpagy-core' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Choose Your Plan',
			]
		);

		$this->add_control(
			'subtitle', [
				'label'       => esc_html__( 'Subtitle', 'landpagy-core' ),
				'type'        => Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'highlighted_subtitle', [
				'label'       => esc_html__( 'Highlighted Subtitle', 'landpagy-core' ),
				'type'        => Controls_Manager::TEXT,
                'condition' => [
                    'style' => '4'
                ]
			]
		);

		$this->end_controls_section(); //End Section Title


		//============================ Pricing Table Tab 01 ==================================//
		$this->start_controls_section(
			'pricing_table_tab1_sec', [
				'label' => esc_html__( 'Tab 01', 'landpagy-core' ),
                'condition' => [
                    'style' => [ '1', '2', '3', '4', '5' ]
                ]
			]
		);

        $this->add_control(
            'tab1_title', [
                'label'       => esc_html__( 'Title', 'landpagy-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 'Monthly',
            ]
        );

		//===== Table 01
		$tab_1 = new \Elementor\Repeater();
		$tab_1->add_control(
			'table_icon', [
				'label'       => esc_html__( 'Icon', 'landpagy-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$tab_1->add_control(
			'title', [
				'label'       => esc_html__( 'Title', 'landpagy-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'STARTER', 'landpagy-core' ),
				'label_block' => true,
			]
		);

		$tab_1->add_control(
			'subtitle', [
				'label'       => esc_html__( 'Description', 'landpagy-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
			]
		);

		$tab_1->add_control(
			'price', [
				'label'       => esc_html__( 'Price', 'landpagy-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '$18.99',
				'label_block' => true,
			]
		);

		$tab_1->add_control(
			'contents', [
				'label'       => esc_html__( 'Content', 'landpagy-core' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
			]
		);

		$tab_1->add_control(
			'btn_label', [
				'label'       => esc_html__( 'Button label', 'landpagy-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'Buy Plan', 'landpagy-core' ),
				'label_block' => true,
			]
		);

		$tab_1->add_control(
			'btn_url', [
				'label'   => esc_html__( 'Button URL', 'landpagy-core' ),
				'type'    => \Elementor\Controls_Manager::URL,
				'default' => [
					'url' => '#'
				],
			]
		);

		$this->add_control(
			'pricing_table_1', [
				'label'       => esc_html__( 'Tab 01 List', 'landpagy-core' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $tab_1->get_controls(),
				'title_field' => '{{{ title }}}',
				'prevent_empty' => false,
                'condition' => [
                    'style' => '1'
                ],
                'separator' => 'before'
			]
		); //End Table Style 01


        //===== Table Style 02
        $tab_2 = new \Elementor\Repeater();
        $tab_2->add_control(
            'title', [
                'label'       => esc_html__( 'Title', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Free', 'landpagy-core' ),
                'label_block' => true,
            ]
        );

        $tab_2->add_control(
            'price', [
                'label'       => esc_html__( 'Price', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( '$18.99', 'landpagy-core' ),
            ]
        );

        $tab_2->add_control(
            'duration', [
                'label'       => esc_html__( 'Duration', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'm', 'landpagy-core' ),
            ]
        );

        $tab_2->add_control(
            'contents', [
                'label'   => esc_html__( 'Contents', 'landpagy-core' ),
                'type'    => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );

        $tab_2->add_control(
            'btn_label', [
                'label'       => esc_html__( 'Button label', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => esc_html__( 'Buy Plan', 'landpagy-core' ),
                'label_block' => true,
                'separator' => 'before',
            ]
        );

        $tab_2->add_control(
            'btn_url', [
                'label'   => esc_html__( 'Button URL', 'landpagy-core' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ],
            ]
        );

        $this->add_control(
            'pricing_table_3', [
                'label'       => esc_html__( 'Tab 02 List', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $tab_2->get_controls(),
                'title_field' => '{{{ title }}}',
                'prevent_empty' => false,
                'condition' => [
                    'style' => '2'
                ],
                'separator' => 'before'
            ]
        ); //End Table Style 02


        //===== Table 03
        $tab_3 = new \Elementor\Repeater();
        $tab_3->add_control(
            'is_favorite', [
                'label' => __( 'Is Favorite', 'landpagy-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Show', 'landpagy-core' ),
                'label_off' => __( 'Hide', 'landpagy-core' ),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'after'
            ]
        );

        $tab_3->add_control(
            'title', [
                'label'       => esc_html__( 'Title', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Included',
            ]
        );

        $tab_3->add_control(
            'subtitle', [
                'label'       => esc_html__( 'Subtitle', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '10GB',
            ]
        );

        $tab_3->add_control(
            'contents', [
                'label'       => esc_html__( 'Content', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXTAREA,
            ]
        );

        $tab_3->add_control(
            'price', [
                'label'       => esc_html__( 'Price', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     =>  '$18.99',
            ]
        );

        $tab_3->add_control(
            'btn_label', [
                'label'       => esc_html__( 'Button label', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Purchase',
                'label_block' => true,
            ]
        );

        $tab_3->add_control(
            'btn_url', [
                'label'   => esc_html__( 'Button URL', 'landpagy-core' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ],
            ]
        );

        $this->add_control(
            'pricing_table_5', [
                'label'       => esc_html__( 'Tab 01 List', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $tab_3->get_controls(),
                'title_field' => '{{{ title }}}',
                'prevent_empty' => false,
                'condition' => [
                    'style' => '3'
                ],
            ]
        ); //End Table Style 03


        //===== Table 04
        $tab_4 = new \Elementor\Repeater();
        $tab_4->add_control(
            'title', [
                'label'       => esc_html__( 'Title 1', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'The Basics',
            ]
        );

        $tab_4->add_control(
            'subtitle', [
                'label'       => esc_html__( 'Subtitle', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Free for 7 days then',
            ]
        );

        $tab_4->add_control(
            'price', [
                'label'       => esc_html__( 'Price', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     =>  '$18.99',
            ]
        );

        $tab_4->add_control( 
            'duration', [
                'label'       => esc_html__( 'Duration', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     =>  '/ Month',
            ]
        );

        $tab_4->add_control(
            'contents', [
                'label'       => esc_html__( 'Content', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );

        $tab_4->add_control(
            'btn_label', [
                'label'       => esc_html__( 'Button label', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Start Free Trial',
                'label_block' => true,
            ]
        );

        $tab_4->add_control(
            'btn_url', [
                'label'   => esc_html__( 'Button URL', 'landpagy-core' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ],
            ]
        );

        $this->add_control(
            'pricing_table_7', [
                'label'       => esc_html__( 'Tab 01 List', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $tab_4->get_controls(),
                'title_field' => '{{{ title }}}',
                'prevent_empty' => false,
                'condition' => [
                    'style' => '4'
                ],
            ]
        ); //End Table Style 04


        //===== Table 05
        $tab_5 = new \Elementor\Repeater();
        $tab_5->add_control(
            'title', [
                'label'       => esc_html__( 'Title', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Starter',
            ]
        );

        $tab_5->add_control(
            'price', [
                'label'       => esc_html__( 'Price', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     =>  '15 USD',
            ]
        );

        $tab_5->add_control(
            'duration', [
                'label'       => esc_html__( 'Duration', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     =>  '/ mo',
            ]
        );

        $tab_5->add_control(
            'f_title', [
                'label'       => esc_html__( 'Features Title', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     =>  'Includes:',
            ]
        );

        $tab_5->add_control(
            'contents', [
                'label'       => esc_html__( 'Content', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );

        $tab_5->add_control(
            'btn_label', [
                'label'       => esc_html__( 'Button label', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Purchase',
                'label_block' => true,
            ]
        );

        $tab_5->add_control(
            'btn_url', [
                'label'   => esc_html__( 'Button URL', 'landpagy-core' ),
                'type'    => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ],
            ]
        );

        $this->add_control(
            'pricing_table_9', [
                'label'       => esc_html__( 'Tab 01 List', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $tab_5->get_controls(),
                'title_field' => '{{{ title }}}',
                'prevent_empty' => false,
                'condition' => [
                    'style' => '5'
                ],
            ]
        ); //End Table Style 05

		$this->end_controls_section(); //End Pricing Table Tabs


        //=========================== Pricing Table Tab 02 =============================//
        $this->start_controls_section(
            'pricing_table_tab2_sec', [
                'label' => esc_html__( 'Tab 02', 'landpagy-core' ),
                'condition' => [
                    'style' => [ '1', '2', '3', '4', '5' ]
                ],
            ]
        );

        $this->add_control(
            'tab2_title', [
                'label'       => esc_html__( 'Title', 'landpagy-core' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 'Yearly',
            ]
        );

        //====== Table Style 01
        $this->add_control(
            'pricing_table_2', [
                'label'       => esc_html__( 'Tab 02 List', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $tab_1->get_controls(),
                'title_field' => '{{{ title }}}',
                'prevent_empty' => false,
                'condition' => [
                    'style' => '1'
                ],
            ]
        );

        //====== Table Style 02
        $this->add_control(
            'pricing_table_4', [
                'label'       => esc_html__( 'Tab 02 List', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $tab_2->get_controls(),
                'title_field' => '{{{ title }}}',
                'prevent_empty' => false,
                'condition' => [
                    'style' => '2'
                ],
            ]
        );

        //====== Table Style 03
        $this->add_control(
            'pricing_table_6', [
                'label'       => esc_html__( 'Tab 01 List', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $tab_3->get_controls(),
                'title_field' => '{{{ title }}}',
                'prevent_empty' => false,
                'condition' => [
                    'style' => '3'
                ],
            ]
        );

        //======== Table Style 04
        $this->add_control(
            'pricing_table_8', [
                'label'       => esc_html__( 'Tab 01 List', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $tab_4->get_controls(),
                'title_field' => '{{{ title }}}',
                'prevent_empty' => false,
                'condition' => [
                    'style' => '4'
                ],
            ]
        );


        //========== Table Style 05
        $this->add_control(
            'pricing_table_10', [
                'label'       => esc_html__( 'Tab 01 List', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::REPEATER,
                'fields'      => $tab_5->get_controls(),
                'title_field' => '{{{ title }}}',
                'prevent_empty' => false,
                'condition' => [
                    'style' => '5'
                ],
            ]
        );

        $this->end_controls_section(); //End Pricing Table Tab 02


		//========================== Table Style 06, 07 ============================//
		$this->start_controls_section(
			'pricing_table_sec', [
				'label' => esc_html__( 'Pricing Table', 'landpagy-core' ),
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
                'label' => esc_html__( 'Tab 01', 'plugin-name' ),
            ]
        );

        $this->add_control(
            'tab1_title2', [
                'label'       => esc_html__( 'Tab Title 2', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Monthly',
                'separator'   => 'after'
            ]
        );

        $this->add_control(
            'tab1_old_price', [
                'label'       => esc_html__( 'Old Price', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '99.99',
            ]
        );

        $this->add_control(
            'tab1_current_price', [
                'label'       => esc_html__( 'Current Price', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '79.49',
            ]
        );

        $this->add_control(
            'tab1_discount_price', [
                'label'       => esc_html__( 'Discount Price', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '$45.25% OFF',
            ]
        );

        $this->add_control(
            'tab1_duration', [
                'label'       => esc_html__( 'Duration', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => ' /month',
            ]
        );

        $this->add_control(
            'tab1_bottom_content', [
                'label'       => esc_html__( 'Contents', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'for the first month',
                'label_block' => true,
            ]
        );

        $this->end_controls_tab();

        //==== Yearly Tabs
        $this->start_controls_tab(
            'yearly_tab', [
                'label' => esc_html__( 'Tab 02', 'plugin-name' ),
            ]
        );

        $this->add_control(
            'tab2_title2', [
                'label'       => esc_html__( 'Tab Title', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => 'Annual',
            ]
        );

        $this->add_control(
            'tab2_old_price', [
                'label'       => esc_html__( 'Old Price', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '99.99',
            ]
        );

        $this->add_control(
            'tab2_current_price', [
                'label'       => esc_html__( 'Current Price', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '79.49',
            ]
        );

        $this->add_control(
            'tab2_discount_price', [
                'label'       => esc_html__( 'Discount Price', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => '$45.25% OFF',
            ]
        );

        $this->add_control(
            'tab2_duration', [
                'label'       => esc_html__( 'Duration', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => ' /year',
            ]
        );

        $this->add_control(
            'tab2_bottom_content', [
                'label'       => esc_html__( 'Contents', 'landpagy-core' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
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
				'label' => esc_html__( 'Column Grid', 'landpagy-core' ),
                'condition' => [
                    'style' => [ '1', '2', '3', '4', '5', '6' ]
                ]
			]
		);

		$this->add_control(
			'column', [
				'label'   => esc_html__( 'Column', 'landpagy-core' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'6' => esc_html__( 'Two', 'landpagy-core' ),
					'4' => esc_html__( 'Three', 'landpagy-core' ),
					'3' => esc_html__( 'Four', 'landpagy-core' ),
				],
				'default' => '4',
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
     * Package: @landpagy
     * Author: spider-themes
     */
	public function elementor_style_control () {


        //=============================== Table Contents ===================================//
        $this->start_controls_section(
            'table_content_style', [
                'label' => esc_html__( 'Table Contents', 'landpagy-core' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => '1'
                ]
            ]
        );

        // Title Options
        $this->add_control(
            'title_options', [
                'label' => esc_html__( 'Title Options', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'title_typo',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'title_color', [
                'label' => esc_html__( 'Text Color', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );


        // Sub - Title Options
        $this->add_control(
            'subtitle_options', [
                'label' => esc_html__( 'Subtitle Options', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(), [
                'name' => 'subtitle_typo',
                'selector' => '{{WRAPPER}} .subtitle',
            ]
        );

        $this->add_control(
            'subtitle_color', [
                'label' => esc_html__( 'Text Color', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .subtitle' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section(); //End Section Contents


		//=============================== Shape Images ===================================//
		$this->start_controls_section(
			'shape_images', [
				'label' => esc_html__( 'Shape Images', 'landpagy-core' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'style' => [ '1' ]
                ]
			]
		);

        $this->add_control(
            'is_shape_image', [
                'label' => esc_html__( 'Show Shape Image', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'your-plugin' ),
                'label_off' => esc_html__( 'Hide', 'your-plugin' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

		$this->add_control(
			'shape1', [
				'label'     => esc_html__( 'Shape ', 'landpagy-core' ),
				'type'      => Controls_Manager::MEDIA,
                'condition' => [
                    'is_shape_image' => 'yes'
                ]
			]
		);

		$this->add_control(
			'shape2', [
				'label'     => esc_html__( 'Shape 2', 'landpagy-core' ),
				'type'      => Controls_Manager::MEDIA,
                'condition' => [
                    'is_shape_image' => 'yes'
                ]
			]
		);

		$this->end_controls_section(); //End Shape Images


        //============================= Section Background ============================== //
        $this->start_controls_section(
            'sec_bg_style', [
                'label' => __( 'Section Background', 'landpagy-core' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'sec_margin', [
                'label' => __( 'Margin', 'landpagy-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .landpagy-table-switcher' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sec_padding', [
                'label' => __( 'Padding', 'landpagy-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .landpagy-table-switcher' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(), [
                'name' => 'sec_background',
                'label' => __( 'Background', 'landpagy-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .landpagy-table-switcher',
            ]
        );

        $this->end_controls_section(); //End Section Background

	}


    /**
     * Name: elementor_render()
     * Desc: Render widget output on the frontend.
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @landpagy
     * Author: spider-themes
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings); // extract all settings array to variables converted to name of key

	    $tables   = isset( $settings['pricing_table_1'] ) ? $settings['pricing_table_1'] : '';
	    $tables2  = isset( $settings['pricing_table_2'] ) ? $settings['pricing_table_2'] : '';


	    //Include template parts
	    include "templates/pricing-table-switcher/table-switcher-{$settings['style']}.php";

    }

}