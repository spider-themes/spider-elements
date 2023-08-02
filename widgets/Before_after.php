<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


/**
 * Class Before_after
 * @package spider\Widgets
 */
class Before_After extends Widget_Base {

    public function get_name() {
        return 'spe_after_before_widget';
    }

    public function get_title() {
        return __( 'Before_After', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-thumbnails-half se-icon';
    }

    public function get_keywords() {
        return [ 'after', 'before' ];
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

    /**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'bootstrap', 'elegant-icon', 'spe-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'bootstrap', 'spe-el-widgets', 'beforeafter' ];
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
    protected function elementor_content_control() {

        //=================Before-After Images=====================//
        $this->start_controls_section(
            'before_after_images',
            [
                'label' => __('Images', 'spider-elements'),
            ]
        );

        $this->add_control(
            'before_image',
            [
                'label' => __( 'Before Image', 'spider-elements' ),
                'type'  => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'after_image',
            [
                'label' => __( 'After Image', 'spider-elements' ),
                'type'  => Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();

    }   //End Before-After Images



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
        <section class="before-after-banner">
        <div class="beforeAfter">
        <div>
            <img src="<?php echo $settings['before_image']['url']; ?>" alt="before image" />
            <div class="indicator before">Before</div>
        </div>
        <div>
            <img src="<?php echo $settings['after_image']['url']; ?>" alt="after image" />
            <div class="indicator after">After</div>
        </div>

        </div>
    </section>
    <?php
    }
    
}
