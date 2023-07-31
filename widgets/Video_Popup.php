<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Class Team
 * @package spider\Widgets
 * @since 1.0.0
 */
class Video_Popup extends Widget_Base
{

	public function get_name()
	{
		return 'docy_video_popup';
	}

	public function get_title()
	{
		return esc_html__('Video Popup', 'spider-elements');
	}

	public function get_icon()
	{
		return 'eicon-play se-icon';
	}

	public function get_keywords()
	{
		return [ 'spider', 'spider elements', 'video', 'video-popup', 'video-popup widget' ];
	}

	public function get_categories()
	{
		return ['spider-elements'];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends()
	{
		return ['bootstrap', 'elegant-icon','fancybox-css', 'spe-main'];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends()
	{
		return ['bootstrap', 'spe-el-widgets', 'fancybox-js', 'slick'];
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
        $this->elementor_content_control();
		// $this->team_slider_control();
		$this-> video_style_control();
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

		// ============================ Select Style  ===========================//

		 $this->start_controls_section(
            'video_sec', [
                'label' => esc_html__( 'Video', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'video_url', [
                'label' => esc_html__( 'Video URL', 'spider-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '#'
            ]
        );
		$this->add_control(
            'video_icon', [
                'label' => __( 'Icon', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-play',
                    'library' => 'solid',
                ],
            ]
        );
		$this->end_controls_section(); // End Select Style
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
	public function video_style_control() {

		//===================== Icon Style ============================//
        $this->start_controls_section(
            'style_icon', [
                'label' => esc_html__( 'Icon', 'spider-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'icon_style_tabs' );

        // Normal tabs
        $this->start_controls_tab(
            'icon_normal_tabs', [
                'label' => __( 'Normal', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'icon_font_color',
            [
                'label' => __( 'Icon Color', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_bg_color',
            [
                'label' => __( 'Background Color', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-icon' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        // Hover tabs
        $this->start_controls_tab(
            'icon_hover_tabs', [
                'label' => __( 'Hover', 'spider-elements' ),
            ]
        );

        $this->add_control(
            'icon_hover_font_color',
            [
                'label' => __( 'Icon Color', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-icon:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_bg_color',
            [
                'label' => __( 'Background Color', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-icon:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_border_color',
            [
                'label' => __( 'Border Color', 'spider-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .video-icon:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs(); // End Tabs

        $this->add_control(
            'icon_style_divider', [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => __( 'Border', 'spider-elements' ),
                'selector' => '{{WRAPPER}} .video-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_border_radius',
            [
                'label' => __( 'Border Radius', 'builderarc-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .video-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => __( 'Size', 'builderarc-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
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
                    '{{WRAPPER}} .video-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_bg_width', [
                'label' => __( 'Background Width', 'builderarc-core' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
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
                    '{{WRAPPER}} .video-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
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
		extract($settings); //extract all settings array to variables converted to name of key
		//================= Template Parts =================//
		?>
			<a href="<?php echo $settings['video_url'] ?>" class="fancybox video-icon tran3s text-center" data-fancybox>
				<?php \Elementor\Icons_Manager::render_icon( $settings['video_icon'], [ 'aria-hidden' => 'true' ] ); ?>
			</a>
		<?php
	}
}
