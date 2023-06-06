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
 * Class Accordion
 * @package spider\Widgets
 */
class Accordion_article extends Widget_Base {

    public function get_name() {
        return 'accordion_article';
    }

    public function get_title() {
        return esc_html__( 'Accordion Articles', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_keywords() {
        return [ 'accordion', 'article' ];
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

    protected function register_controls() {

        /** ============ Title Section ============ **/
        $this->start_controls_section(
            'style_sec',
            [
                'label' => esc_html__( 'Article Accordion', 'spider-elements' ),
            ]
        );
        
        $this->add_control(
			'cat_name',
			[
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

    protected function render() {

        $settings = $this->get_settings();

		//======================== Templates Parts ========================//
	    include "templates/accordion-article/accordion-article.php";

    }
}