<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Before_After extends Widget_Base {

    public function get_name() {
        return 'spe_after_before_widget';
    }

    public function get_title() {
        return __( 'After-Before', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-image-box se-icon';
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
		return [ 'bootstrap', 'elegant-icon',  'diagonal' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'bootstrap', 'spe-el-widgets', 'beforeafter' ];
	}


    protected function _register_controls() {
        // Add your widget controls/fields here using $this->add_control() method.
        // For example, you can add an image control for "Before" and "After" images.
        $this->elementor_content_control();
    }
    



    protected function elementor_content_control() {

        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

	    /**
	     *Images
	     */
        $this->add_control(
            'before_image',
            [
                'label' => __( 'Before Image', 'your-text-domain' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'after_image',
            [
                'label' => __( 'After Image', 'your-text-domain' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->end_controls_section();

    }


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
