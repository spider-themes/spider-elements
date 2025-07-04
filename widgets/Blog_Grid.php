<?php
/**
 * Use namespace to avoid conflict
 */

namespace SPEL\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
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

	public static function get_taxonomies( $cate = 'post', $type = 0 ) {
		$post_cat = self::_get_terms( $cate );

		$tag   = isset( $post_cat[ $type ] ) && ! empty( $post_cat[ $type ] ) ? $post_cat[ $type ] : 'category';
		$terms = get_terms( array(
			'taxonomy'   => $tag,
			'orderby'    => 'name',
			'order'      => 'DESC',
			'hide_empty' => false,
			'number'     => 1500
		) );

		return $terms;
	}

	public function get_name() {
		return 'docy_blog_grid'; // ID of the widget (Don't change this name)
	}

	public function get_title() {
		return esc_html__( 'SE Blog Grid', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-post spel-icon';
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'slick', 'slick-theme', 'spel-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'slick', 'spel-el-widgets' ];
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
		$this->elementor_layout_setting();
		$this->elementor_post_setting();
		//style section
		$this->elementor_blog_style_section();

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
	public function elementor_layout_setting() {

		//============================= Filter Options =================================== //
		$this->start_controls_section(
			'blog_layout', [
				'label' => esc_html__( 'Layout', 'spider-elements' ),
			]
		);

		// Style
		$this->add_control(
			'style', [
				'label'   => esc_html__( 'Skin', 'spider-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'title' => esc_html__( 'Style 01', 'spider-elements' ),
						'icon'  => 'blog_1',
					],
					'2' => [
						'title' => esc_html__( 'Style 02', 'spider-elements' ),
						'icon'  => 'blog_2',
					],
					'3' => [
						'title' => esc_html__( 'Style 03', 'spider-elements' ),
						'icon'  => 'blog_3',
					],
					'4' => [
						'title' => esc_html__( 'Style 04', 'spider-elements' ),
						'icon'  => 'blog_4',
					],
					'5' => [
						'title' => esc_html__( 'Blog Carousel 05', 'spider-elements' ),
						'icon'  => 'blog_5',
					],
				],
				'toggle'  => false,
				'default' => '1',
			]
		);

		$this->add_control(
			'column_grid', [
				'label'     => esc_html__( 'Column', 'spider-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'6' => esc_html__( 'Two Column', 'spider-elements' ),
					'4' => esc_html__( 'Three Column', 'spider-elements' ),
					'3' => esc_html__( 'Four Column', 'spider-elements' ),
					'2' => esc_html__( 'Six Column', 'spider-elements' ),
				],
				'default'   => '4 ',
				'condition' => [
					'style'  => [ '1', '2', '3', '4', ],
					'style!' => [ '5' ]
				]
			]
		);

        $this->add_control(
            'pagination_switcher', [
                'label'     => esc_html__( 'Pagination', 'spider-elements' ),
                'type'      => Controls_Manager::SWITCHER,
                'label_on'  => esc_html__( 'Show', 'spider-elements' ),
                'label_off' => esc_html__( 'Hide', 'spider-elements' ),
                'return_value' => 'yes',
                'default'   => 'yes',
                'condition' => [
                    'style'  => ['1', '2', '3', '4', ],
                    'style!' => [ '5' ]
                ]
            ]
        );

		$this->end_controls_section(); //End Filter

		// arrow icon control section
		$this->start_controls_section(
			'arrow_icon_section', [
				'label'     => esc_html__( 'Arrow Icon', 'spider-elements' ),
				'condition' => [
					'style'  => [ '5' ],
					'style!' => [ '1', '2', '3', '4', ]
				]
			]
		);

		$this->add_control(
			'left_arrow_icon', [
				'label'       => esc_html__( 'Left Icon', 'spider-elements' ),
				'type'        => Controls_Manager::ICONS,
				'label_block' => true,
				'default'     => [
					'value'   => 'arrow_carrot-left',
					'library' => 'ElegantIcons',
				],
			]
		);

		$this->add_control(
			'right_arrow_icon', [
				'label'   => esc_html__( 'Right Icon', 'spider-elements' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'arrow_carrot-right',
					'library' => 'ElegantIcons',
				],
			]
		);

		$this->end_controls_section();

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

	public function elementor_post_setting() {

		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Query Settings', 'spider-elements' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'blog_queryby', [
				'label'   => esc_html__( 'Query by', 'spider-elements' ),
				'type'    => \Elementor\Controls_Manager::CHOOSE,
				'options' => apply_filters( 'blog_query_by', [
					'all'        => [
						'title' => esc_html__( 'All', 'spider-elements' ),
						'icon'  => 'fas fa-border-none',
					],
					'categories' => [
						'title' => esc_html__( 'By Categories', 'spider-elements' ),
						'icon'  => 'eicon-product-categories',
					],
					'posts'      => [
						'title' => esc_html__( 'By Posts', 'spider-elements' ),
						'icon'  => 'eicon-post-list',
					],
					'postype'    => [
						'title' => esc_html__( 'By Posttype', 'spider-elements' ),
						'icon'  => 'eicon-editor-list-ul',
					],

				] ),
				'default' => 'all',

			]
		);

		$this->add_control(
			'blog_bycategories',
			[
				'label'     => esc_html__( 'By Categories', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'blog_queryby' => [ 'categories' ]
				],
			]
		);

		$this->add_control(
			'blog_categories',
			[
				'label'     => esc_html__( 'Select Categories', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::SELECT2,
				'multiple'  => true,
				'options'   => self::get_category(),
				'default'   => [],
				'condition' => [
					'blog_queryby' => [ 'categories' ]
				],
			]
		);

		$this->add_control(
			'blog_byposts',
			[
				'label'     => esc_html__( 'By Posts', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'blog_queryby' => [ 'posts' ]
				],
			]
		);

		$this->add_control(
			'blog_post',
			[
				'label'     => esc_html__( 'Select Posts', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::SELECT2,
				'multiple'  => true,
				'options'   => self::get_posts(),
				'default'   => [],
				'condition' => [
					'blog_queryby' => [ 'posts' ]
				],
			]
		);

		$this->add_control(
			'blog_byposttype',
			[
				'label'     => esc_html__( 'By Posttype', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'condition' => [
					'blog_queryby' => [ 'postype' ]
				],
			]
		);

		$this->add_control(
			'blog_posttype',
			[
				'label'     => esc_html__( 'Select Postype', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::SELECT2,
				'multiple'  => true,
				'options'   => self::get_posttype(),
				'default'   => [],
				'condition' => [
					'blog_queryby' => [ 'postype' ]
				],
			]
		);

		$this->add_control(
			'blog_otherquery',
			[
				'label'     => esc_html__( 'Others Filter', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'blog_order_by',
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
			'blog_order',
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
			'blog_offset',
			[
				'label'   => esc_html__( 'Offset', 'spider-elements' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 15,
				'default' => 0,
			]
		);

		$this->add_control(
			'blog_limit',
			[
				'label'   => esc_html__( 'Limit Display', 'spider-elements' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 1,
				'max'     => 100,
				'default' => 5,
			]
		);
		$this->add_control(
			'content_limit',
			[
				'label'     => esc_html__( 'Content Limit Display', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
				'min'       => 1,
				'max'       => 100,
				'default'   => 11,
				'condition' => [
					'style' => [ '2' ]
				]
			]
		);

		$this->add_control(
			'title_length', [
				'label'   => esc_html__( 'Title Length', 'spider-elements' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 8
			]
		);

		$this->end_controls_section();
	}

	public static function get_category( $cate = 'post' ) {
		$post_cat = self::_get_terms( $cate );

		$taxonomy   = isset( $post_cat[0] ) && ! empty( $post_cat[0] ) ? $post_cat[0] : [ 'category' ];
		$query_args = [
			'taxonomy'   => $taxonomy,
			'orderby'    => 'name',
			'order'      => 'DESC',
			'hide_empty' => false,
			'number'     => 1500
		];
		$terms      = get_terms( $query_args );

		$options = [];
		$count   = count( (array) $terms );
		if ( $count > 0 ):
			foreach ( $terms as $term ) {
				if ( $term->parent == 0 ) {
					$options[ $term->term_id ] = $term->name;
					foreach ( $terms as $subcategory ) {
						if ( $subcategory->parent == $term->term_id ) {
							$options[ $subcategory->term_id ] = $subcategory->name;
						}
					}
				}
			}
		endif;

		return $options;
	}

	public static function _get_terms( $post = 'post' ) {
		$taxonomy_objects = get_object_taxonomies( $post );

		return $taxonomy_objects;
	}

	public static function get_posts() {
		$post_args = get_posts(
			array(
				'posts_per_page' => - 1,
				'post_status'    => 'publish',
			)
		);

		$posts      = get_posts( $post_args );
		$posts_list = [];
		if ( is_array( $posts ) ) {
			foreach ( $posts as $_key => $object ) {
				$posts_list[ $object->ID ] = $object->post_title;
			}
		}

		return $posts_list;
	}

	public static function get_posttype() {
		$post_types = get_post_types(
			array(
				'public' => true,
			),
			'objects'
		);

		$options = array();

		if ( is_array( $post_types ) ) {
			foreach ( $post_types as $post_type ) {
				$options[ $post_type->name ] = $post_type->label;
			}
		}

		return $options;
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
	public function elementor_blog_style_section() {
		$this->blog_general_style();
		$this->blog_image_style();
		$this->blog_content_style();
		$this->button_style();
		$this->meta_style();
		$this->icon_style();
	}

	public function blog_general_style() {
		$this->start_controls_section(
			'blog_general_styles',
			[
				'label' => esc_html__( 'Blog Item', 'spider-elements' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);


		$this->start_controls_tabs(
			'blog_style_tabs',
			[
				'condition' => [
					'style'  => [ '1', '2', '3', '4', ],
					'style!' => [ '5' ]
				]
			]
		);

		$this->start_controls_tab(
			'blog_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'spider-elements' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'background',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .blog-meta-two, 
								{{WRAPPER}} .blog-meta-one',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'blog_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'spider-elements' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'hover_background',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .blog-meta-two:hover, 
							   {{WRAPPER}} .blog-meta-one:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'blog_margin',
			[
				'label'      => esc_html__( 'Margin', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'separator'  => 'before',
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 100,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors'  => [
					'{{WRAPPER}} .blog-grid' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style'  => [ '1', '2', '3', '4', ],
					'style!' => [ '5' ]
				]
			]
		);

		$this->add_responsive_control(
			'blog_item_padding',
			[
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 100,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors'  => [
					'{{WRAPPER}} .blog-meta-two'                 => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .blog-meta-one'                 => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .card-style-six .blog-item-six' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'blog_item_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .blog-meta-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .blog-meta-one' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style'  => [ '1', '2', '3', '4', ],
					'style!' => [ '5' ]
				]
			]
		);

		$this->end_controls_section();
	}

//============ Start Image Style Control Section ================//
	public function blog_image_style() {
		$this->start_controls_section(
			'blog_image_tab',
			[
				'label'     => esc_html__( 'Image', 'spider-elements' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => [ '1', '2', '3', '4' ]
				]
			]
		);

		$this->add_responsive_control(
			'blog_img_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .blog-meta-two .post-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .blog-meta-one .post-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'blog_img_margin',
			[
				'label'       => esc_html__( 'Margin Bottom', 'spider-elements' ),
				'description' => esc_html__( 'Spacing between the image', 'spider-elements' ),
				'type'        => Controls_Manager::SLIDER,
				'size_units'  => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range'       => [
					'px' => [
						'max' => 250,
					],
					'em' => [
						'max' => 0,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .blog-meta-two .post-img' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
					'{{WRAPPER}} .blog-meta-one .post-img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'   => [
					'style'  => [ '1', '2', '3', '4' ],
					'style!' => [ '5' ]
				],
			]
		);

		$this->end_controls_section();
	}


    //============ Start Content Section Control============
	public function blog_content_style() {

		$this->start_controls_section(
			'blog_content_tab',
			[
				'label' => esc_html__( 'Contents', 'spider-elements' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs(
			'style_blog_title_tabs'
		);

		//=== blog Normal icon
		$this->start_controls_tab(
			'style_blog_title_normal',
			[
				'label' => esc_html__( 'Normal', 'spider-elements' ),
			]
		);

		$this->add_control(
			'blog_title_options', [
				'label' => esc_html__( 'Title', 'spider-elements' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'blog_content_title',
				'selector' => '{{WRAPPER}} .blog-meta-two .blog-title,
	                           {{WRAPPER}} .blog-meta-one .blog-title,
						       {{WRAPPER}} .blog-six-title',
			]
		);

		$this->add_control(
			'blog_title_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .blog-meta-two .blog-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-meta-one .blog-title' => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-six-title'            => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'blog_title_margin',
			[
				'label'      => esc_html__( 'Margin', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 100,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors'  => [
					'{{WRAPPER}} .blog-meta-two .blog-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .blog-meta-one .blog-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style'  => [ '1', '2', '3', '4', ],
					'style!' => [ '5' ]
				]
			]
		);

		$this->end_controls_tab(); //End Normal title

		//=== Hover icon====
		$this->start_controls_tab(
			'blog_hover_title', [
				'label' => esc_html__( 'Hover', 'spider-elements' ),
			]
		);

		$this->add_control(
			'blog_title_hover_heading',
			[
				'label' => esc_html__( 'Title', 'spider-elements' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'blog_title_hover_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}}  .blog-meta-two .blog-title:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}}  .blog-meta-one .blog-title:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}}  .blog-six-title:hover'            => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab(); // End title hover
		$this->end_controls_tabs(); // end normal and hover title tabs


//===============Blog Style 2, Description Style......................
		$this->add_control(
			'blog_description_options', [
				'label'     => esc_html__( 'Description', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style'  => [ '2' ],
					'style!' => [ '1', '3', '4', '5' ]
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'description_typography',
				'selector'  => '{{WRAPPER}} .blog-meta-one p',
				'condition' => [
					'style'  => [ '2' ],
					'style!' => [ '1', '3', '4', '5' ]
				],
			]

		);

		$this->add_control(
			'blog_description_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .blog-meta-one p' => 'color: {{VALUE}};',
				],
				'condition' => [
					'style'  => [ '2' ],
					'style!' => [ '1', '3', '4', '5' ]
				],
			]
		);

//		End      //

		$this->end_controls_section();
	}


    //===================Start Blog Grid Button Style Controls===============//
	public function button_style() {
		$this->start_controls_section(
			'blog_button_tab',
			[
				'label'     => esc_html__( 'Button', 'spider-elements' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => [ '1', '2', '4', ]
				]
			]
		);

		// ===== Button Style Tabs=====//
		$this->start_controls_tabs(
			'style_btn_tabs'
		);

		//==== Normal ====//
		$this->start_controls_tab(
			'blog_normal_btn', [
				'label' => esc_html__( 'Normal', 'spider-elements' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'content_typography',
				'selector' =>
					'{{WRAPPER}} .blog-meta-two .continue-btn, 
					{{WRAPPER}} .blog-meta-two .read-more-btn a,
					{{WRAPPER}} .blog-meta-one .continue-btn',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'btn_background',
				'types'     => [ 'classic', 'gradient' ],
				'exclude'   => [ 'image' ],
				'selector'  => '{{WRAPPER}} .blog-meta-two .continue-btn.btn-seven',
				'condition' => [
					'style' => '4'
				],
			]
		);

		$this->add_control(
			'blog_button_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .blog-meta-two .continue-btn'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-meta-two .read-more-btn a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-meta-one .continue-btn'    => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'blog_btn_padding',
			[
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => - 100,
						'max'  => 100,
						'step' => 5,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors'  => [
					'{{WRAPPER}} .blog-meta-two .continue-btn.btn-seven' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => '4'
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'      => 'button_border_color',
				'label'     => esc_html__( 'Border', 'spider-elements' ),
				'selector'  => '{{WRAPPER}} .blog-meta-two .continue-btn.btn-seven',
				'condition' => [
					'style' => '4'
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .blog-meta-two .continue-btn.btn-seven' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'style' => '4'
				],
			]
		);

		$this->end_controls_tab();

		//=== Button Hover ====//
		$this->start_controls_tab(
			'blog_hover_btn', [
				'label' => esc_html__( 'Hover', 'spider-elements' ),
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'btn_hover_background',
				'types'     => [ 'classic', 'gradient' ],
				'exclude'   => [ 'image' ],
				'selector'  => '{{WRAPPER}} .blog-meta-two .continue-btn.btn-seven:hover',
				'condition' => [
					'style' => '4'
				],
			]
		);

		$this->add_control(
			'blog_button_hover_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .blog-meta-two .continue-btn:hover'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-meta-two .read-more-btn a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-meta-one .continue-btn:hover'    => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-meta-two .continue-btn.btn-seven:hover' => 'border-color: {{VALUE}}',
				],
				'condition' => [
					'style' => '4'
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

    //====================	Start Meta Style Section ==================//
	public function meta_style() {
		$this->start_controls_section(
			'blog_meta_tab',
			[
				'label'     => esc_html__( 'Meta', 'spider-elements' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'style' => [ '1', '2', '3', '4', ]
				]
			]
		);

		$this->add_control(
			'date-heading',
			[
				'label'     => esc_html__( 'Date', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'style'  => [ '1', '2', '4', '5' ],
					'style!' => [ '3' ]
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'blog_meta_typography',
				'selector'  => '{{WRAPPER}} .blog-meta-two .date a,
								{{WRAPPER}} .blog-meta-one .date a',
				'condition' => [
					'style'  => [ '1', '2', '4' ],
					'style!' => [ '3', '5' ]
				],
			]
		);

		$this->add_control(
			'blog_meta_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .blog-meta-two .date a'                                                         => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-meta-one .date a'                                                         => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-item .blog-meta .author-info h5, .blog-item .blog-meta .author-info span, 
					.blog-item .blog-meta :is(.blog-category, .blog-category a, .blog-read)' => 'color: {{VALUE}} !important;',
				],
				'condition' => [
					'style'  => [ '1', '2', '4', '5' ],
					'style!' => [ '3' ]
				],
			]
		);


//============ Start meta category Style Controls =================//
		$this->add_control(
			'blog_category_options', [
				'label'     => esc_html__( 'Category', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style'  => [ '1', '3', '5' ],
					'style!' => [ '2', '4' ]
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'blog_category_typography',
				'selector' => '{{WRAPPER}} .blog-meta-one .tags,
								{{WRAPPER}} .blog-meta-two .post-img .tags,
								{{WRAPPER}} .blog-item .blog-meta .tags',
			]
		);

		$this->start_controls_tabs(
			'cat_tabs', [
				'condition' => [
					'style'  => [ '1', '3', '5' ],
					'style!' => [ '2', '4' ]
				],
			]
		);

		$this->start_controls_tab(
			'cat_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'spider-elements' ),
			]
		);

		$this->add_control(
			'blog_category_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .blog-meta-two .post-img .tags'                  => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-meta-one .tags'                            => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-item .blog-meta .tags, .blog-read::before' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'first_category_bg',
			[
				'label'     => esc_html__( 'Background', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-meta-two .post-img .tags' => 'background: {{VALUE}};',
				],
				'condition' => [
					'style'  => [ '1' ],
					'style!' => [ '2', '3', '4', '5' ]
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'cat_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'spider-elements' ),
			]
		);

		$this->add_control(
			'category_hover_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .blog-meta-one .tags:hover'           => 'color: {{VALUE}} !important;',
					'{{WRAPPER}} .blog-item .blog-meta .tags:hover'    => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-meta-two .post-img .tags:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'bg_hover_category',
			[
				'label'     => esc_html__( 'Background', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-meta-two .post-img .tags:hover' => 'background: {{VALUE}};',
				],
				'condition' => [
					'style'  => [ '1' ],
					'style!' => [ '2', '3', '4', '5' ]
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

//============ End meta category Style Controls =================//

		//============ Start meta Author Style Controls =================//
		$this->add_control(
			'blog_author_options', [
				'label'     => esc_html__( 'Author Name', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'style'  => [ '3', '5' ],
					'style!' => [ '1', '2', '4' ]
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'      => 'author_typography',
				'selector'  => '{{WRAPPER}} .blog-meta-one .author a,
							    {{WRAPPER}} .blog-item .blog-meta .author-info h5 a',
				'condition' => [
					'style'  => [ '3', '5' ],
					'style!' => [ '1', '2', '4' ]
				],
			]
		);


		$this->start_controls_tabs(
			'meta_style_tabs', [
				'condition' => [
					'style'  => [ '3', '5' ],
					'style!' => [ '1', '2', '4' ]
				],
			]
		);

		$this->start_controls_tab(
			'meta_style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'spider-elements' ),
			]
		);

		$this->add_control(
			'author_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .blog-meta-one .post-data, .blog-meta-one .author a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .blog-item .blog-meta .author-info h5 a'             => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'meta_style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'spider-elements' ),
			]
		);

		$this->add_control(
			'blog_author_hover_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .blog-meta-one .author a:hover'                => 'color: {{VALUE}};',
					'{{WRAPPER}} .blog-item .blog-meta .author-info h5 a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		//============ End meta Author Style Controls =================//

		$this->end_controls_section();
	}

    //====================	End Meta Style Section ==================//

	public function icon_style() {
		$this->start_controls_section(
			'blog_icon_tab',
			[
				'label'     => esc_html__( 'Icon', 'spider-elements' ),
				'tab'       => \Elementor\Controls_Manager::TAB_STYLE,
				'condition' => [
					'style'  => [ '5' ],
					'style!' => [ '1', '2', '3', '4', ]
				]
			]
		);

		// Blog icon Normal/hover/ State
		$this->start_controls_tabs(
			'style_blog_icon_tabs'
		);

		//=== blog Normal icon
		$this->start_controls_tab(
			'style_blog_icon_normal',
			[
				'label' => esc_html__( 'Normal', 'spider-elements' ),
			]
		);

		$this->add_control(
			'blog_icon_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slick-arrow' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'blog_icon_bg_color',
			[
				'label'     => esc_html__( 'Background', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slick-arrow' => 'background: {{VALUE}};',

				],
			]
		);

		$this->end_controls_tab(); //End Normal icon

		//=== Hover icon====
		$this->start_controls_tab(
			'blog_hover_icon', [
				'label' => esc_html__( 'Hover', 'spider-elements' ),
			]
		);

		$this->add_control(
			'icon_hover_color', [
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slick-arrow:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_hover_bg_color', [
				'label'     => esc_html__( 'Background', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slick-arrow:hover' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slick-arrow:hover' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab(); // End Active Tab Title
		$this->end_controls_tabs(); // End Accordion icon Normal/Active/ State

		$this->add_responsive_control(
			'blog_icon_size',
			[
				'label'      => esc_html__( 'Icon Size', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .slick-arrow ' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'before',
			]
		);

		$this->add_responsive_control(
			'icon-gap',
			[
				'label'       => esc_html__( 'Gap', 'spider-elements' ),
				'type'        => \Elementor\Controls_Manager::SLIDER,
				'description' => esc_html__( 'Set the gap between icon.', 'spider-elements' ),
				'range'       => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .blog-slider-arrows' => 'column-gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'blog_icon_border',
				'selector' => '{{WRAPPER}} .slick-arrow',
			]
		);

		$this->add_responsive_control(
			'blog_icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .slick-arrow' => 'border-radius: {{SIZE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'blog_icon_padding',
			[
				'label'      => esc_html__( 'Padding', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}


	protected function render(): void
    {
		$settings = $this->get_settings_for_display();
		extract( $settings ); // Array to variable conversation

        $paged = ( get_query_var('paged') ) ? get_query_var('paged') : ( get_query_var('page') ? get_query_var('page') : 1 );

	    // query part
	    $query = [
		    'post_status'         => 'publish',
		    'ignore_sticky_posts' => true,
		    'suppress_filters'    => false,
		    'paged'               => $paged,
	    ];

	    // Post type
	    if ( isset($settings['blog_queryby']) && $settings['blog_queryby'] === 'postype' ) {
		    $query['post_type'] = $settings['blog_posttype'] ?? ['post'];
	    } else {
		    $query['post_type'] = ['post'];
	    }

	    // Order
	    if ( !empty($settings['blog_order_by']) ) {
		    $query['orderby'] = $settings['blog_order_by'];
	    }
	    if ( !empty($settings['blog_order']) ) {
		    $query['order'] = $settings['blog_order'];
	    }
	    if ( !empty($settings['blog_limit']) ) {
		    $query['posts_per_page'] = (int) $settings['blog_limit'];
	    }

	    // Offset
	    if ( !empty($settings['blog_offset']) ) {
		    $query['offset'] = (int) $settings['blog_offset'];
	    }

	    // Categories filter
	    if ( isset($settings['blog_queryby']) && $settings['blog_queryby'] === 'categories' ) {
		    if ( !empty($settings['blog_categories']) && is_array($settings['blog_categories']) ) {
			    $query['tax_query'] = [
				    [
					    'taxonomy' => 'category',
					    'field'    => 'term_id',
					    'terms'    => $settings['blog_categories'],
				    ]
			    ];
		    }
	    }

	    // Specific post IDs
	    if ( isset($settings['blog_queryby']) && $settings['blog_queryby'] === 'posts' ) {
		    if ( !empty($settings['blog_post']) && is_array($settings['blog_post']) ) {
			    $query['post__in'] = $settings['blog_post'];
		    }
	    }

		$post_query = new \WP_Query( $query );

		//============ Template Part =============//
		include "templates/blog-grid/blog-{$settings['style']}.php";
	}

}