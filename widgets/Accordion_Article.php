<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Accordion_Article
 * @package spider\Widgets
 * @since 1.0.0
 */
class Accordion_Article extends Widget_Base {

    public function get_name() {
        return 'accordion_article';
    }

    public function get_title() {
        return esc_html__( 'Accordion Articles', 'spider-elements' );
    }


    public function get_icon() {
        return 'eicon-accordion se-icon';
    }

    public function get_keywords() {
        return [ 'spider', 'accordion', 'article', 'post', 'category' ];
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'bootstrap', 'se-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'bootstrap', ];
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

		/** ============ Title Section ============ **/
		$this->start_controls_section(
			'style_sec', [
				'label' => esc_html__( 'Article Accordion', 'spider-elements' ),
			]
		);

		$this->add_control(
			'cat_name', [
				'label' => esc_html__( 'Select category (Blog Post)', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => se_cat_ids(),
				'default' => '',
			]
		);

		$this->add_control(
			'show_count', [
				'label' => esc_html__('Show Posts Count', 'banca-core'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 3
			]
		);

		$this->add_control(
			'order', [
				'label' => esc_html__('Order', 'banca-core'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'ASC' => 'ASC',
					'DESC' => 'DESC'
				],
				'default' => 'ASC'
			]
		);

		$this->add_control(
			'orderby', [
				'label' => esc_html__( 'Order By', 'landpagy-core' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'none' => 'None',
					'ID' => 'ID',
					'author' => 'Author',
					'title' => 'Title',
					'name' => 'Name (by post slug)',
					'date' => 'Date',
					'rand' => 'Random',
				],
				'default' => 'none'
			]
		);

		$this->add_control(
			'title_length', [
				'label' => esc_html__('Title Length', 'banca-core'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => -1,
			]
		);

		$this->add_control(
			'excerpt_length', [
				'label' => esc_html__('Excerpt Word Length', 'banca-core'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 15,
			]
		);

		$this->add_control(
			'exclude', [
				'label' => esc_html__( 'Exclude', 'banca-core' ),
				'description' => esc_html__( 'Enter the post IDs to hide/exclude. Input the multiple ID with comma separated', 'banca-core' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'collapse_state', [
				'label' => esc_html__( 'Expanded', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'spider-elements' ),
				'label_off' => esc_html__( 'No', 'spider-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
				'separator' => 'before',
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
		

		//========================= Title =========================//
		$this->start_controls_section(
			'style_title_sec', [
				'label' => __( 'Title', 'spider-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		// Tab Title Normal/Active State
		$this->start_controls_tabs(
			'style_tab_title'
		);

		//=== Normal Tab Title
		$this->start_controls_tab(
			'style_title_normal', [
				'label' => __( 'Normal', 'spider-elements' ),
			]
		);

		$this->add_control(
			'title_normal_text_color', [
				'label' => __( 'Text Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .se_tab_title' => 'color: {{VALUE}}',
				)
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),[
				'name' => 'title_normal_bg_color',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .se_tab_title',
			]
		);

		$this->add_control(
			'title_normal_icon_color', [
				'label' => __( 'Icon Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .se_tab_title i' => 'color: {{VALUE}};',
				),
			]
		);

		$this->end_controls_tab(); // End normal Tab Title

		//=== Active Tab Title
		$this->start_controls_tab(
			'style_title_active', [
				'label' => __( 'Active', 'spider-elements' ),
			]
		);

		$this->add_control(
			'title_active_text_color', [
				'label' => __( 'Text Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .se_tab_title.active' => 'color: {{VALUE}};',
				)
			]
		);

		$this->add_control(
			'title_active_border_color',
			[
				'label' => esc_html__( 'Border Color', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .se_tab_title' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),[
				'name' => 'title_active_bg_color',
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .se_tab_title:active',
			]
		);

		$this->add_control(
			'title_active_icon_color', [
				'label' => __( 'Icon Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .se_tab_title.active i' => 'color: {{VALUE}};',
				),
			]
		);
	
		$this->end_controls_tab(); // End Active Tab Title

		$this->end_controls_tabs(); //End Normal/Active State Tab Title

		$this->add_control(
			'tab_title_divider', [
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'tab_title_typo',
				'selector' => '{{WRAPPER}} .se_tab_title',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(), [
				'name' => 'tab_border',
				'label' => esc_html__( 'Border', 'spider-elements' ),
				'selector' => '{{WRAPPER}} .se_tab_title',
			]
		); 

		//Icon size
		$this->add_control(
			'accordion_normal_icon_size', [
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
					'{{WRAPPER}} .se_tab_title i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);



		$this->end_controls_section(); // End Tab Title  


		//========================= Contents =========================//
		$this->start_controls_section(
			'style_content_sec', [
				'label' => __( 'Contents', 'spider-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		//=== Post Title
		$this->add_control(
			'post_text_options', [
				'label' => __( 'Post Title', 'spider-elements' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'post_title_color', [
				'label' => __( 'Text Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .se_accordion_item a h4' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'post_title_typo',
				'selector' => '{{WRAPPER}} .se_name',
			]
		); //End Post Title

		//=== Post Content
		$this->add_control(
			'post_content_options', [
				'label' => __( 'Post Content', 'spider-elements' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'post_content_color', [
				'label' => __( 'Text Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .multi-collapse .toggle_body P' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'post_content_typo',
				'selector' => '{{WRAPPER}} .multi-collapse .toggle_body P',
			]
		); //End Post content

		//=== Post Meta Option
		$this->add_control(
			'post_meta_options', [
				'label' => __( 'Post Meta', 'spider-elements' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'post_meta_color', [
				'label' => __( 'Text Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .se_accordion_item .post-meta li' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'post_meta_typo',
				'selector' => '{{WRAPPER}} .se_accordion_item .post-meta li',
			]
		); //End Post Meta Option

			//  Box item Design option
			$this->add_control(
				'post_design_options', [
					'label' => __( 'Box Item Design Options', 'spider-elements' ),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			
			$this->add_responsive_control(
				'post_content-mar',[
					'label' => __( 'Margin', 'spider-elements' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'separator'	=> 'before',
					'selectors' => [
						'{{WRAPPER}} .se_accordion_item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
	
			$this->add_responsive_control(
				'post_content-pad',[
					'label' => __( 'Padding', 'spider-elements' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'selectors' => [
						'{{WRAPPER}} .se_accordion_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
	
			$this->add_group_control(  
				\Elementor\Group_Control_Background::get_type(),
				[
					'name' => 'content_background',
					'types' => [ 'classic', 'gradient', 'video' ],
					'selector' => '{{WRAPPER}} .se_accordion_item',
				]
			);
		
			$this->add_group_control(
				\Elementor\Group_Control_Border::get_type(), [
					'name' => 'border',
					'label' => esc_html__( 'Border', 'spider-elements' ),
					'separator'	=> 'before',
					'selector' => '{{WRAPPER}} .se_accordion_item',
				]
			); 
	
		//End box item design option


		//  Box Design option
		$this->add_control(
			'box_design_options', [
				'label' => __( 'Box Design Options', 'spider-elements' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'box_content-mar',[
				'label' => __( 'Margin', 'spider-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'separator'	=> 'before',
				'selectors' => [
					'{{WRAPPER}} .multi-collapse .toggle_body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'box_content-pad',[
				'label' => __( 'Padding', 'spider-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .multi-collapse .toggle_body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(), [
				'name' => 'box_border',
				'label' => esc_html__( 'Border', 'spider-elements' ),
				'separator'	=> 'before',
				'selector' => '{{WRAPPER}} .multi-collapse .toggle_body',
			]
		); 

		$this->add_group_control(  
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'box_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .multi-collapse .toggle_body',
				
			]
		);
		//  end box design option

		$this->end_controls_section(); // End Contents
	
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
        $settings = $this->get_settings_for_display();
		extract($settings); //extract all settings array to variables converted to name of key

	    $taxonomy = get_terms( array(
		    'taxonomy' => 'category',
		    'hide_empty' => true,
		    'include'   => $settings['cat_name']
	    ) );

	    $is_collapsed = $settings['collapse_state'] == 'yes' ? 'true' : 'false';
	    $collapse_class = $settings['collapse_state'] == 'yes' ? '' : 'collapsed';
	    $is_show = $settings['collapse_state'] == 'yes' ? 'show' : '';


		//======================== Templates Parts ========================//
	    include "templates/accordion-article/accordion-article.php";

    }
}