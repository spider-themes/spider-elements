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
	public function elementor_style_control() {}

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