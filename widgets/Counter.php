<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

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
class Counter extends Widget_Base
{

	public function get_name()
	{
		return 'spe_counter';
	}

	public function get_title()
	{
		return esc_html__('Counter', 'spider-elements');
	}

	public function get_icon()
	{
		return 'eicon-counter spe-icon';
	}

	public function get_keywords()
	{
		return [ 'spider', 'Counter', 'Progress bar', ];
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
		return ['bootstrap', 'spe-main'];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends()
	{
		return ['bootstrap', 'spe-el-widgets'];
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
		$this-> counter_style_control();
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
      //==================== Select Preset Skin ====================//
		$this->start_controls_section(
			'counter_preset', [
				'label' => __( 'Preset Skin', 'spider-elements' ),
			]
		);

        $this->add_control(
			'style',
			[
				'label'     => esc_html__( 'Counter Style', 'spider-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'1' => esc_html__( 'Style 01', 'spider-elements' ),
					'2' => esc_html__( 'Style 02', 'spider-elements' ),
				],
				'default'   => '1',
			]
		);

		$this->end_controls_section(); // End Preset Skin

		//=================== Section Accordion ===================//
		$this->start_controls_section(
			'sec_counter', [
				'label' => esc_html__( 'Counter', 'spider-elements' ),
			]
		);

        $repeater = new Repeater();
        $repeater->add_control(
            'counter_value',
            [
                'label'     => esc_html__('Counter Value', 'spider-elements'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 85, 
                'min'       => 0,
                'max'       => 100,
            ]
        );

        // Control for Counter Text
        $repeater->add_control(
            'counter_text',
            [
                'label'     => esc_html__('Counter Text', 'spider-elements'),
                'type'      => Controls_Manager::TEXT,
                'default'   => esc_html__('User research', 'spider-elements'), // Set a default text
            ]
        );

        $this->add_control(
            'counters',
            [
                'label'     => esc_html__('Counters', 'spider-elements'),
                'type'      => Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'default'   => [
                    [
                        'counter_value' => 85,
                        'counter_text' => 'User research',
                    ],
                ],
            ]
        );

        $this->add_control(
            'flex_display',
            [
                'label'     => esc_html__('Display', 'spider-elements'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'flex',
                'options'   => [
                    'flex'          => esc_html__('Flex', 'spider-elements'),
                    'inline-flex'   => esc_html__('Inline Flex', 'spider-elements'),
                ],
            ]
        );
        
        $this->add_control(
            'flex_direction',
            [
                'label'     => esc_html__('Flex Direction', 'spider-elements'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'row',
                'options'   => [
                    'row'               => esc_html__('Row', 'spider-elements'),
                    'row-reverse'       => esc_html__('Row Reverse', 'spider-elements'),
                    'column'            => esc_html__('Column', 'spider-elements'),
                    'column-reverse'    => esc_html__('Column Reverse', 'spider-elements'),
                ],
            ]
        );
        
        $this->add_control(
            'flex_justify_content',
            [
                'label'     => esc_html__('Justify Content', 'spider-elements'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'flex-start',
                'options'   => [
                    'flex-start'    => esc_html__('Flex Start', 'spider-elements'),
                    'flex-end'      => esc_html__('Flex End', 'spider-elements'),
                    'center'        => esc_html__('Center', 'spider-elements'),
                    'space-between' => esc_html__('Space Between', 'spider-elements'),
                    'space-around'  => esc_html__('Space Around', 'spider-elements'),
                ],
            ]
        );
        
        $this->add_control(
            'flex_align_items',
            [
                'label'     => esc_html__('Align Items', 'spider-elements'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'center',
                'options'   => [
                    'flex-start'    => esc_html__('Flex Start', 'spider-elements'),
                    'flex-end'      => esc_html__('Flex End', 'spider-elements'),
                    'center'        => esc_html__('Center', 'spider-elements'),
                    'baseline'      => esc_html__('Baseline', 'spider-elements'),
                    'stretch'       => esc_html__('Stretch', 'spider-elements'),
                ],
            ]
        );

        $this->add_control(
            'flex_gap',
            [
                'label'         => esc_html__('Gap', 'spider-elements'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px', '%', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                    '%' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                    'em' => [
                        'min'   => 0,
                        'max'   => 10,
                        'step'  => 0.1,
                    ],
                    'rem' => [
                        'min'   => 0,
                        'max'   => 10,
                        'step'  => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10, 
                ],
            ]
        );

	    $this->end_controls_section(); 

	}

    
	/**
	 * Name: counter_style_control()
	 * Desc: Register the Style Tab output on the Elementor editor.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	public function counter_style_control() {

		//===================== Counter Content Style ============================//
        $this->start_controls_section(
            'style_counter', [
                'label' => esc_html__( 'Counter', 'spider-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'counter_circle_size',
            [
                'label'         => __('Size', 'spider-elements'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px'],
                'range' => [
                    'px' => [
                        'min'   => 50,
                        'max'   => 500,
                        'step'  => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 100,
                ],
                'selectors' => [
                    '{{WRAPPER}} svg.radial-progress' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ],
                'separator' => 'after',
            ]
        );

        // Control for percent color
		$this->add_control(
			'percent_color',
			[
				'label'     => esc_html__( 'Percent Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} svg.radial-progress text' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'percent_typography',
				'selector' => '{{WRAPPER}} svg.radial-progress text'
			]
		);

        $this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);

        // Control for text color
		$this->add_control(
			'counter_text_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skill_item h6' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'counter_text_typography',
				'selector' => '{{WRAPPER}} .skill_item h6'
			]
		);

        $this->add_control(
			'hr_text',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
        
        // Control for Fill Color
        $this->add_control(
            'fill_color',
            [
                'label'     => esc_html__('Fill Color', 'spider-elements'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#5d5b62',
                'selectors' => [
                    '{{WRAPPER}} svg.radial-progress circle.incomplete' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        // Control for Stroke Color
        $this->add_control(
            'stroke_color',
            [
                'label'     => esc_html__('Stroke Color', 'spider-elements'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ef4953',
                'selectors' => [
                    '{{WRAPPER}} .radial-progress .complete' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'counter_circle_stroke_width',
            [
                'label'         => __('Stroke Width', 'spider-elements'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px'],
                'range' => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'default' => [
                    'unit'  => 'px',
                    'size'  => 6,
                ],
                'selectors' => [
                    '{{WRAPPER}} svg.radial-progress circle' => 'stroke-width: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'before',
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
        include "templates/counter/counter-{$settings['style']}.php";
	}    
}


?>
<script type=text/javascript>
document.addEventListener("DOMContentLoaded", function () {
  "use strict";

  // Remove svg.radial-progress .complete inline styling
  var radialProgressElements = document.querySelectorAll("svg.radial-progress");
  radialProgressElements.forEach(function (element) {
    var completeCircle = element.querySelector("circle.complete");
    if (completeCircle) {
      completeCircle.removeAttribute("style");
    }
  });

  window.addEventListener("scroll", function () {
    radialProgressElements.forEach(function (element) {
      // If svg.radial-progress is approximately 25% vertically into the window when scrolling from the top or the bottom
      var rect = element.getBoundingClientRect();
      var windowHeight = window.innerHeight || document.documentElement.clientHeight;
      if (
        rect.top <= windowHeight * 0.75 &&
        rect.bottom >= windowHeight * 0.25
      ) {
        // Get percentage of progress
        var percent = parseInt(element.getAttribute("data-percentage"));

        // Get radius of the svg's circle.complete
        var completeCircle = element.querySelector("circle.complete");
        if (completeCircle) {
          var radius = parseInt(completeCircle.getAttribute("r"));

          // Get circumference (2πr)
          var circumference = 2 * Math.PI * radius;

          // Get stroke-dashoffset value based on the percentage of the circumference
          var strokeDashOffset = circumference - (percent * circumference) / 100;

          // Transition progress for 1.25 seconds
          completeCircle.style.transition = "stroke-dashoffset 1.25s";
          completeCircle.style.strokeDashoffset = strokeDashOffset;
        }
      }
    });
  });

  // Trigger scroll event to initialize animations
  window.dispatchEvent(new Event("scroll"));
});
</script>


