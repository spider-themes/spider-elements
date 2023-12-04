<?php
/**
 * Use namespace to avoid conflict
 */

namespace Spider_Elements\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


/**
 * Class Before_after
 * @package spider\Widgets
 */
class Before_After extends Widget_Base {

	public function get_name() {
		return 'spe_after_before_widget'; // ID of the widget (Don't change this name)
	}

	public function get_title() {
		return __( 'Before After', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-thumbnails-half spe-icon';
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
		return [ 'elegant-icon', 'spe-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'beforeafter', 'spe-el-widgets' ];
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
	protected function elementor_content_control() {

		//================= Before-After Images=====================//
		$this->start_controls_section(
			'before_after_images',
			[
				'label' => __( 'Images', 'spider-elements' ),
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

		$this->add_control(
			'before_text',
			[
				'label'   => esc_html__( 'Before Button Text', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'Before', 'spider-elements' ),
			]
		);

		$this->add_control(
			'after_text',
			[
				'label'   => esc_html__( 'After Button Text', 'spider-elements' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'After', 'spider-elements' ),
			]
		);

		$this->end_controls_section();

	}   //End Before-After Images


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

		//===================== beforeAfter Text style ==========================//
		$this->start_controls_section(
			'sec_before_after_style',
			[
				'label' => __( 'Button Style', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'beforeAfter_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .before-after-banner .indicator' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'before_after_text_typography',
				'selector' => '{{WRAPPER}} .before-after-banner .indicator',
			]
		);

		$this->add_control(
			'beforeAfter_text_bg_color',
			[
				'label'     => esc_html__( 'Button Background Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .before-after-banner .indicator' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section(); // end beforeAfter Text style

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
        <section class="before-after-banner">
            <div class="beforeAfter">
                <?php
                if ( ! empty( $settings['before_image']['id'] ) ) {
                    ?>
                    <div>
                        <?php echo wp_get_attachment_image( $settings['before_image']['id'], 'full' ) ?>
                        <div class="indicator before"><?php echo esc_html( $settings['before_text'] ); ?></div>
                    </div>
                    <?php
                }
                if ( ! empty( $settings['after_image']['id'] ) ) {
                    ?>
                    <div>
                        <?php echo wp_get_attachment_image( $settings['after_image']['id'], 'full' ) ?>
                        <div class="indicator after"><?php echo esc_html( $settings['after_text'] ); ?></div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </section>
		<?php
	}

}
