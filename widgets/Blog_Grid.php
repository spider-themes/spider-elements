<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

use Elementor\Icons_Manager;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_shadow;



use WP_Query;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}



/**
 * Blog Grid
 *
 * Elementor widget for Blog Grid.
 *
 * @since 1.7.0
 */
class Blog_Grid extends Widget_Base {

    public function get_name() {
        return 'docy_blog_grid';
    }

    public function get_title() {
        return __( 'Blog Grid', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-post spe-icon';
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
    protected function register_controls()
    {
        $this-> elementor_layout_setting();
        $this-> elementor_post_setting();
        //style section
        $this-> elementor_blog_style_section();
        
    }

    /**
	 * Name: elementor_layout_setting()
	 * Desc: Register the Content Tab output on the Elementor editor.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
    public function elementor_layout_setting(){

        //============================= Filter Options =================================== //
        $this->start_controls_section(
            'blog_layout', [
                'label' => __('Layout', 'spider-elements'),
            ]
        );

        // Style
        $this->add_control(
			'style', [
				'label'   	=> esc_html__( 'Skin', 'spider-elements' ),
				'type'    	=> Controls_Manager::CHOOSE,
				'options'	=> [
					'1'	=> [
						'title' => __( 'Style 01', 'spider-elements' ),
						'icon'  => 'blog-grid1',
					],
					'2' => [
						'title' => __( 'Style 02', 'spider-elements' ),
						'icon'  => 'blog-grid2',
					],
                    '3' => [
						'title' => __( 'Style 03', 'spider-elements' ),
						'icon'  => 'blog-grid3',
					],
                    '4' => [
						'title' => __( 'Style 04', 'spider-elements' ),
						'icon'  => 'blog-grid4',
					],
				],
				'toggle'  => false,
				'default' => '1',
			]
		);

        $this->add_control(
            'column_grid', [
                'label' => __('Column', 'spider-elements'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '6'  => __( 'Two Column', 'spider-elements' ),
                    '4'  => __( 'Three Column', 'spider-elements' ),
                    '3'  => __( 'Four Column', 'spider-elements' ),
                    '2'  => __( 'Six Column', 'spider-elements' ),
                ],
                'default' => '6',
            ]
        );
        
        $this->end_controls_section(); //End Filter
    }

    /**
	 * Name: elementor_post_setting()
	 * Desc: Register the Content Tab output on the Elementor editor.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */

    public function elementor_post_setting(){

        $this->start_controls_section(
            'spe_post_settings_section',
            [
                'label' => esc_html__('Query Settings', 'spider-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'spe_post_blog_queryby', [
				'label'			 =>esc_html__( 'Query by', 'spider-elements' ),
				'type'			 => \Elementor\Controls_Manager::CHOOSE,
				'options'		 => apply_filters('spe_post_blog_query_by', [
					'all'		 => [
						'title'	 =>esc_html__( 'All', 'spider-elements' ),
						'icon'	 => 'fas fa-border-none',
					],
					'categories'		 => [
						'title'	 =>esc_html__( 'By Categories', 'spider-elements' ),
						'icon'	 => 'eicon-product-categories',
					],
					'posts'		 => [
						'title'	 =>esc_html__( 'By Posts', 'spider-elements' ),
						'icon'	 => 'eicon-post-list',
					],
                    'postype'		 => [
						'title'	 =>esc_html__( 'By Posttype', 'spider-elements' ),
						'icon'	 => 'eicon-editor-list-ul',
					],
					
				]),
				'default'		 => 'all',
               
			]
		);

        $this->add_control(
			'spe_post_blog_bycategories',
			[
				'label' => __( 'By Categories', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
                    'spe_post_blog_queryby' => [ 'categories' ]
				],
			]
		);
        $this->add_control(
			'spe_post_blog_categories',
			[
				'label' => __( 'Select Categories', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => self::get_category(),
				'default' => [],
				'condition' => [
                    'spe_post_blog_queryby' => [ 'categories' ]
				],
			]
		);

        $this->add_control(
			'spe_post_blog_byposts',
			[
				'label' => __( 'By Posts', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
                    'spe_post_blog_queryby' => [ 'posts' ]
				],
			]
		);
        $this->add_control(
			'spe_post_blog_post',
			[
				'label' => __( 'Select Posts', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => self::get_posts(),
				'default' => [],
				'condition' => [
                    'spe_post_blog_queryby' => [ 'posts' ]
				],
			]
		);

        $this->add_control(
			'spe_post_blog_byposttype',
			[
				'label' => __( 'By Posttype', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'condition' => [
                    'spe_post_blog_queryby' => [ 'postype' ]
				],
			]
		);
        $this->add_control(
			'spe_post_blog_posttype',
			[
				'label' => __( 'Select Postype', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => self::get_posttype(),
				'default' => [],
				'condition' => [
                    'spe_post_blog_queryby' => [ 'postype' ]
				],
			]
		);
		
		$this->add_control(
			'spe_post_blog_otherquery',
			[
				'label' => __( 'Others Filter', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'spe_post_blog_order_by',
			[
				'label'   => esc_html__( 'Order by', 'spider-elements' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'date'          => esc_html__( 'Date', 'spider-elements' ),
					'title'         => esc_html__( 'Title', 'spider-elements' ),
					'author'        => esc_html__( 'Author', 'spider-elements' ),
					'comment_count' => esc_html__( 'Comments', 'spider-elements' ),
				],
				'default' => 'date',
			]
		);
 
		$this->add_control(
			'spe_post_blog_order',
			[
				'label'   => esc_html__( 'Order', 'spider-elements' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => [
					'ASC'  => esc_html__( 'ASC', 'spider-elements' ),
					'DESC' => esc_html__( 'DESC', 'spider-elements' ),
				],
				'default' => 'DESC',
			]
		);

		$this->add_control(
			'spe_post_blog_offset',
			[
				'label'     => esc_html__( 'Offset', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 15,
				'default'   => 0,
			]
		);
 
		$this->add_control(
			'spe_post_blog_limit',
			[
				'label'     => esc_html__( 'Limit Display', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
				'default'   => 5,
			]
		);
        $this->add_control(
			'spe_post_content_limit',
			[
				'label'     => esc_html__( 'Content Limit Display', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
				'default'   => 11,
                'condition' => [
                    'style' => ['2']
                ]
			]
		);

        $this->end_controls_section();
    }


    /**
	 * Name: elementor_blog_style_section()
	 * Desc: Register the Content Tab output on the Elementor editor.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
    public function elementor_blog_style_section(){
        $this-> blog_general_style();
        $this-> blog_image_style();
        $this-> blog_content_style();
        $this-> button_style();
        $this-> meta_style();
    }

    public function blog_general_style(){
        $this->start_controls_section(
            'blog_general_styles',
            [
                'label' => __( 'Blog Item Style', 'spider-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'blog_grid_item_bg',
            [
                'label'     => esc_html__('Background Color', 'spider-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-meta-two' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'blog_grid_item_radius',
            [
                'label' => __( 'Border Radius', 'spider-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .blog-meta-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
			'blog_item_padding',
			[
				'label' => __( 'Padding', 'spider-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .blog-meta-two' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
            ]
		);
        $this-> end_controls_section();
    }

    public function blog_image_style(){
        $this->start_controls_section(
            'blog_image_tab',
            [
                'label' => __( 'Image Style', 'spider-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'blog_img_radius',
            [
                'label' => __( 'Border Radius', 'spider-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'separator' => 'after',
                'selectors' => [
                    '{{WRAPPER}} .blog-meta-two .post-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
			'blog_img_margin',
			[
				'label' => __( 'Margin Bottom', 'spider-elements' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
                'default' => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors' => [
					'{{WRAPPER}} .blog-meta-two .post-img,{{WRAPPER}} .blog-meta-two .post-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'style' => ['1','4']
                ],
			]
		);
       
        $this-> end_controls_section();
    }
    
    public function blog_content_style(){
        $this->start_controls_section(
            'blog_content_tab',
            [
                'label' => __( 'Content Style', 'spider-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'style_content_tabs'
        );

        /// Normal Color
        $this->start_controls_tab(
            'blog_normal_style', [
                'label' => __( 'Normal', 'spider-elements' ),
            ]
        );
       

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_content_title',
                'label' => __('Title Typography', 'spider-elements'),
                'selector' => '{{WRAPPER}} .blog-meta-two .blog-title',
            ]
        );
        $this->add_control(
            'blog_title_color',
            [
                'label' => esc_html__('Title Color', 'spider-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .blog-meta-two .blog-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
			'blog_title_spacing',
			[
				'label' => __( 'Title Spacing', 'spider-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'separator' => 'after',
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .blog-meta-two .blog-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this-> end_controls_tab();
        $this->start_controls_tab(
            'blog_hover_style', [
                'label' => __( 'Hover', 'spider-elements' ),
            ]
        );
       
        $this->add_control(
            'blog_title_hover_color',
            [
                'label' => esc_html__('Title Hover Color', 'spider-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}  .blog-meta-two .blog-title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this-> end_controls_tab();
        $this-> end_controls_tabs();
        $this-> end_controls_section();
    }

    public function button_style()
    {
        $this-> start_controls_section(
            'blog_button_tab',
            [
                'label' => __('Button Style', 'spider-elements'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        // ===== Button Style Tabs
        $this->start_controls_tabs(
            'style_btn_tabs'
        );

        /// Normal Color
        $this->start_controls_tab(
            'blog_normal_btn', [
                'label' => __( 'Normal', 'spider-elements' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_read_btn',
                'label' => __('Button Typography', 'spider-elements'),
                'selector' => '{{WRAPPER}} .blog-meta-two .continue-btn',
            ]
        );
        $this->add_control(
            'blog_button_color',
            [
                'label' => esc_html__('Button Color', 'spider-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .blog-meta-two .continue-btn' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
			'blog_btn_padding',
			[
				'label' => __( 'Button Padding', 'spider-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
				'range' => [
					'px' => [
						'min' => -100,
						'max' => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .blog-meta-two .continue-btn.btn-seven' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition' => [
                    'style' => ['4']
                ],
			]
		);
        $this->add_control(
			'blog_button_bg', [
				'label' => esc_html__( 'Background Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-meta-two .continue-btn.btn-seven' => 'background-color: {{VALUE}};',
				],
				'condition' => [
                    'style' => ['4']
                ],
			]
		);
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border_color',
                'label' => __( 'Border', 'spider-elements' ),
                'selector' => '{{WRAPPER}} .blog-meta-two .continue-btn.btn-seven',
                'condition' => [
                    'style' => ['4']
                ],
            ]
        );
        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'spider-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px'],
                'selectors' => [
                    '{{WRAPPER}} .blog-meta-two .continue-btn.btn-seven' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => ['4']
                ],
            ]
        );
        
        $this-> end_controls_tab();

        /// Hover Color
        $this->start_controls_tab(
            'blog_hover_btn', [
                'label' => __( 'Hover', 'spider-elements' ),
            ]
        );
        $this->add_control(
            'blog_button_hover_color',
            [
                'label' => esc_html__('Button Color', 'spider-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .blog-meta-two .continue-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
			'blog_button_hover_bg', [
				'label' => esc_html__( 'Background Color', 'spider-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-meta-two .continue-btn.btn-seven:hover' => 'background-color: {{VALUE}};',
				],
				'condition' => [
                    'style' => ['4']
                ],
			]
		);
        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-meta-two .continue-btn.btn-seven:hover' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'style' => ['4']
                ],
            ]
        );

        $this-> end_controls_tab();
        $this-> end_controls_tabs();
        $this-> end_controls_section();
    }

    public function meta_style(){
        $this->start_controls_section(
            'blog_meta_tab',
            [
                'label' => __( 'Meta Style', 'spider-elements' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_meta_typography',
                'label' => __('Button Typography', 'spider-elements'),
                'selector' => '{{WRAPPER}} .blog-meta-two .date a',
            ]
        );
        $this->add_control(
            'blog_meta_color',
            [
                'label' => esc_html__('Meta Color', 'spider-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .blog-meta-two .date a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'category_bg',
            [
                'label'     => esc_html__('Category_Background Color', 'spider-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-meta-two .post-img .tags' => 'background: {{VALUE}};',
                ],
                'separator' => 'after',
            ]
        );
        $this->add_control(
            'blog_category_color',
            [
                'label' => esc_html__('category Color', 'spider-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .blog-meta-two .post-img .tags' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this-> end_controls_section();
    }


    protected function render() {
        $settings = $this->get_settings_for_display();
        extract($settings); // Array to variable conversation
        // query part
        $query['post_status'] = 'publish';
		$query['suppress_filters'] = false;
		if($spe_post_blog_queryby == 'postype'){
			$query['post_type'] = isset($spe_post_blog_posttype) ? $spe_post_blog_posttype : ['post'];
		}else{
			$query['post_type'] = ['post'];
		}
		
		$query['orderby'] = $spe_post_blog_order_by;
		if( !empty($spe_post_blog_order) ){
			$query['order'] = $spe_post_blog_order;
		}
		if( !empty($spe_post_blog_limit) ){
			$query['posts_per_page'] = (int) $spe_post_blog_limit;
		}
		if( !empty($spe_post_blog_offset) ){
			$query['offset'] = (int) $spe_post_blog_offset;
		}

		if($spe_post_blog_queryby == 'categories'){
			if( is_array($spe_post_blog_categories) && sizeof($spe_post_blog_categories) > 0){
				$cate_query = [
					[
						'taxonomy' => 'category',
						'field'    => 'term_id',
						'terms'    => $spe_post_blog_categories, 
					],			
					'relation' => 'AND',
				];
				$query['tax_query'] = $cate_query;
			}
		}

		if($spe_post_blog_queryby == 'posts'){
			if( is_array($spe_post_blog_post) && sizeof($spe_post_blog_post) > 0){
				$query['post__in'] = $spe_post_blog_post;
			}
		}

		$post_query = new \WP_Query( $query );

        include "templates/blog-grid/blog-{$settings['style']}.php";
    }

    public static function get_posts(){
        $post_args = get_posts(
            array(
                'posts_per_page' => -1,
                'post_status' => 'publish',
            )
        );
        $_posts = get_posts($post_args);
        $posts_list = [];
        foreach ($_posts as $_key => $object) {
            $posts_list[$object->ID] = $object->post_title;
        }
        return $posts_list;
    }

    public static function get_category( $cate = 'post' ){
        $post_cat = self::_get_terms($cate);
        
        $taxonomy	 = isset($post_cat[0]) && !empty($post_cat[0]) ? $post_cat[0] : ['category'];
        $query_args = [
            'taxonomy'      => $taxonomy,
            'orderby'       => 'name', 
            'order'         => 'DESC',
            'hide_empty'    => false,
            'number'        => 1500
        ];
        $terms = get_terms( $query_args );

        $options = [];
        $count = count( (array) $terms);
        if($count > 0):
            foreach ($terms as $term) {
                if( $term->parent == 0 ) {
                    $options[$term->term_id] = $term->name;
                    foreach( $terms as $subcategory ) {
                        if($subcategory->parent == $term->term_id) {
                            $options[$subcategory->term_id] = $subcategory->name;
                        }
                    }
                }
            }
        endif;      
        return $options;
    }
    
    public static function get_taxonomies( $cate = 'post', $type = 0){
        $post_cat = self::_get_terms($cate);
        
        $tag	 = isset($post_cat[$type]) && !empty($post_cat[$type]) ? $post_cat[$type] : 'category';
        $terms = get_terms( array(
            'taxonomy' => $tag, 
            'orderby'       => 'name', 
            'order'         => 'DESC',
            'hide_empty'    => false,
            'number'        => 1500
        ) );
      
        return $terms;
    }

    public static function  _get_terms( $post = 'post'){
        $taxonomy_objects = get_object_taxonomies( $post );
     return $taxonomy_objects;
    }

    public static function get_posttype(){
        $post_types = get_post_types(
            array(
                'public' => true,
            ),
            'objects'
        );

        $options = array();

        foreach ($post_types as $post_type) {
            $options[$post_type->name] = $post_type->label;
        }

        return $options;
    }

}