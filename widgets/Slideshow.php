<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Stack image Widgets
 */

 class Diagonal_slideshow extends Widget_Base {

    public function get_name() {
        return 'diagonal_slideshow';
    }

    public function get_title() {
        return __( 'Diagonal Slideshow', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-slideshow se-icon';
    }

    public function get_keywords() {
        return [ 'spider', 'diagonal_slideshow', 'slideshow'];
    }
    
    public function get_categories() {
        return [ 'spider-elements' ];
    }

    /**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'bootstrap', 'diagonal' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'bootstrap', 'charming', 'diagonal', 'tweenmax' ];
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


        //================== Slideshow ========================//
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'spider-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
    
        $slide = new Repeater();
    
        $slide->add_control(
            'image_url',
            [
                'label'     => __( 'Slide Image URL', 'spider-elements' ),
                'type'      => Controls_Manager::MEDIA,
                'default'   => [
                    'url' => '', // Default image URL if no image is selected
                ],
            ]
        );
    
        $slide->add_control(
            'side_text',
            [
                'label'     => __( 'Side Text', 'spider-elements' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Memories & Thoughts', 'spider-elements' ),
            ]
        );
    
        $slide->add_control(
            'slide_number',
            [
                'label'     => __( 'Slide Number', 'spider-elements' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 1,
            ]
        );
    
        $slide->add_control(
            'slide_title',
            [
                'label'     => __( 'Slide Title', 'spider-elements' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Automation', 'spider-elements' ),
            ]
        );
    
        $slide->add_control(
            'slide_subtitle',
            [
                'label'     => __( 'Slide Subtitle', 'spider-elements' ),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'A tree needs to be your friend if you\'re going to paint him', 'spider-elements' ),
            ]
        );
    
        $this->add_control(
            'slides',
            [
                'label'     => __( 'Add Slide', 'spider-elements' ),
                'type'      => Controls_Manager::REPEATER,
                'fields'    => $slide->get_controls(),
                'default'   => [],
            ]
        );
    
        $this->end_controls_section(); //End slideshow
    }
    



    /**
	 * Name: elementor_render()
	 * Desc: Render the widget output on the frontend.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <div class="body_wrapper diagonal-slideshow">
            <svg class="hidden">
                <symbol id="icon-arrow" viewBox="0 0 24 24">
                    <title>arrow</title>
                    <polygon points="6.3,12.8 20.9,12.8 20.9,11.2 6.3,11.2 10.2,7.2 9,6 3.1,12 9,18 10.2,16.8 " />
                </symbol>
                <symbol id="icon-drop" viewBox="0 0 24 24">
                    <title>drop</title>
                    <path
                        d="M12,21c-3.6,0-6.6-3-6.6-6.6C5.4,11,10.8,4,11.4,3.2C11.6,3.1,11.8,3,12,3s0.4,0.1,0.6,0.3c0.6,0.8,6.1,7.8,6.1,11.2C18.6,18.1,15.6,21,12,21zM12,4.8c-1.8,2.4-5.2,7.4-5.2,9.6c0,2.9,2.3,5.2,5.2,5.2s5.2-2.3,5.2-5.2C17.2,12.2,13.8,7.3,12,4.8z" />
                    <path
                        d="M12,18.2c-0.4,0-0.7-0.3-0.7-0.7s0.3-0.7,0.7-0.7c1.3,0,2.4-1.1,2.4-2.4c0-0.4,0.3-0.7,0.7-0.7c0.4,0,0.7,0.3,0.7,0.7C15.8,16.5,14.1,18.2,12,18.2z" />
                </symbol>
                <symbol id="icon-longarrow" viewBox="0 0 54 24">
                    <title>longarrow</title>
                    <path
                        d="M.42 11.158L12.38.256c.333-.27.696-.322 1.09-.155.395.166.593.467.593.903v6.977h38.87c.29 0 .53.093.716.28.187.187.28.426.28.716v5.98c0 .29-.093.53-.28.716a.971.971 0 0 1-.716.28h-38.87v6.977c0 .416-.199.717-.592.903-.395.167-.759.104-1.09-.186L.42 12.62a1.018 1.018 0 0 1 0-1.462z" />
                </symbol>
                <symbol id="icon-navarrow" viewBox="0 0 408 408">
                    <title>navarrow</title>
                    <polygon fill="#fff" fill-rule="nonzero"
                        points="204 0 168.3 35.7 311.1 178.5 0 178.5 0 229.5 311.1 229.5 168.3 372.3 204 408 408 204">
                    </polygon>
                </symbol>
            </svg>


            <div class="slideshow ">
                <div class="slideshow__deco"></div>
                <?php
                if (!empty($settings['slides'])) {
                    foreach ($settings['slides'] as $item) {
                        ?>
                        <div class="slide">
                            <div class="slide__img-wrap">
                                <div class="slide__img" style="background-image: url(<?php echo esc_url($item['image_url']['url']) ?>);"></div>
                            </div>
                            <div class="slide__side">Memories &amp; Thoughts</div>
                            <div class="slide__title-wrap">
                                <span class="slide__number">1</span>
                                <h3 class="slide__title">Automation</h3>
                                <h4 class="slide__subtitle">A tree needs to be your friend if you're going to paint him</h4>
                            </div>
                        </div>
                        
                        <?php
                    }
                }
                ?>

                <button class="nav nav--prev">
                    <svg class="icon icon--navarrow-prev">
                        <use xlink:href="#icon-navarrow"></use>
                    </svg>
                </button>
                <button class="nav nav--next">
                    <svg class="icon icon--navarrow-next">
                        <use xlink:href="#icon-navarrow"></use>
                    </svg>
                </button>
            </div>


        <div class="content">
            <button class="content__close">
                <svg class="icon icon--longarrow">
                    <use xlink:href="#icon-longarrow"></use>
                </svg>
            </button>
        </div>

        </div>


        <?php
         
    }
    
}

?>

