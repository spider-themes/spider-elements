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

	public function get_style_depends() {
		return [ 'bootstrap', 'se-main' ];
	}

	public function get_script_depends() {
		return [ 'bootstrap', ];
	}

    public function get_keywords() {
        return [ 'spider', 'accordion', 'article', 'post', 'category' ];
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

		/** ============ Title Section ============ **/
		$this->start_controls_section(
			'style_sec', [
				'label' => esc_html__( 'Article Accordion', 'spider-elements' ),
			]
		);

		$this->add_control(
			'cat_name', [
				'label' => esc_html__( 'Select category', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => se_cat_ids(),
				'default' => '',
			]
		);
		$this->add_control(
			'collapse_state', [
				'label' => esc_html__( 'Expanded', 'spider-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'spider-elements' ),
				'label_off' => esc_html__( 'No', 'spider-elements' ),
				'return_value' => 'yes',
				'default' => '',
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


		//======================== Templates Parts ========================//
	    include "templates/accordion-article/accordion-article.php";

    }
}