<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;



if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Class Timeline
 * @package spider\Widgets
 */
class Timeline extends Widget_Base {

   
    public function get_name() {
        return 'spe_timeline_widget';
    }

 
    public function get_title() {
        return 'Timeline';
    }

    public function get_icon() {
        return 'eicon-time-line spe-icon';
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

  	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
    public function get_style_depends() {
        return [ 'bootstrap', 'spe-main' ];
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

        //=======================Timeline Content====================// 
        $this->start_controls_section(
            'section_timeline',
            [
                'label' => __('Timeline', 'spider-elements'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'timestamp',
            [
                'label'         => __('Timestamp', 'spider-elements'),
                'type'          => Controls_Manager::TEXT,
                'default'       => __('11.05.2013', 'spider-elements'),
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'         => __('Title', 'spider-elements'),
                'type'          => Controls_Manager::TEXT,
                'default'       => __('Davidson College', 'spider-elements'),
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'location',
            [
                'label'         => __('Location', 'spider-elements'),
                'type'          => Controls_Manager::TEXT,
                'default'       => __('North Carolina', 'spider-elements'),
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'content',
            [
                'label'         => __('Content', 'spider-elements'),
                'type'          => Controls_Manager::WYSIWYG,
                'default'       => __('Vitae adipiscing turpis...', 'spider-elements'),
                'show_label'    => false,
            ]
        );


        $this->add_control(
            'timeline_items',
            [
                'label'     => __('Timeline Items', 'spider-elements'),
                'type'      => Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'default'   => [
                    [
                        'timestamp' => __('11.05.2013', 'spider-elements'),
                        'title'     => __('Davidson College', 'spider-elements'),
                        'location'  => __('North Carolina', 'spider-elements'),
                        'content'   => __('Vitae adipiscing turpis...', 'spider-elements'),
                    ],
                    // Add more default timeline items here...
                ],
                'title_field' => '{{{ timestamp }}}',
            ]
        );

        
        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'      => 'background',
				'types'     => [ 'classic', 'gradient', ],
				'selector'  => '{{WRAPPER}} .timeline-wrapper .timeline-panel p::after',
			]
		);

        $this->end_controls_section(); //End Timeline Content
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
    public function elementor_style_control() {

		//============================= Timeline Content Style =============================//
		$this->start_controls_section(
			'timeline_content_style', [
				'label' => esc_html__( 'Timeline Content', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        //=== Timeline Title
		$this->add_control(
			'timeline_title', [
				'label'		=> __( 'Title', 'spider-elements' ),
				'type' 		=> Controls_Manager::HEADING,
				'separator'	=> 'before',
			]
		);

		$this->add_control(
			'timeline', [
				'label' 	=> __( 'Text Color', 'spider-elements' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .timeline-wrapper .timeline-panel h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' 		=> 'timeline_title_typo',
				'selector'	=> '{{WRAPPER}} .timeline-wrapper .timeline-panel h3',
			]
		); //End TImeline Title


		//=== Timeline Location
		$this->add_control(
			'timeline_location', [
				'label' 	=> __( 'Location', 'spider-elements' ),
				'type' 		=> Controls_Manager::HEADING,
				'separator'	=> 'before',
			]
		);

		$this->add_control(
			'timeline_location_color', [
				'label' 	=> __( 'Text Color', 'spider-elements' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .timeline-wrapper .timeline-panel span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' 		=> 'timeline_location_typo',
				'selector'	=> '{{WRAPPER}} .timeline-wrapper .timeline-panel span',
			]
		); //End Timeline Location


		//=== Timeline Content
		$this->add_control(
			'timeline_content', [
				'label' 	=> __( 'Timeline Content', 'spider-elements' ),
				'type' 		=> Controls_Manager::HEADING,
				'separator'	=> 'before',
			]
		);

		$this->add_control(
			'timeline_content_color', [
				'label' 	=> __( 'Text Color', 'spider-elements' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .timeline-wrapper .timeline-panel p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' 		=> 'timeline_content_typo',
				'selector'	=> '{{WRAPPER}} .timeline-wrapper .timeline-panel p',
			]
		); //End Timeline content


		//=== Timeline Date Option
		$this->add_control(
			'timeline_date', [
				'label' 	=> __( 'Date', 'spider-elements' ),
				'type' 		=> Controls_Manager::HEADING,
				'separator'	=> 'before',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' 		=> 'timeline_date_bg_color',
				'types' 	=> [ 'classic', 'gradient' ],
				'exclude' 	=> [ 'image' ],
				'selector'	=> '{{WRAPPER}} .timeline-wrapper .timestamp'
			]
		);

		$this->add_control(
			'timeline_date_color', [
				'label' 	=> __( 'Text Color', 'spider-elements' ),
				'type' 		=> Controls_Manager::COLOR,
				'selectors'	=> [
					'{{WRAPPER}} .timeline-wrapper .timestamp' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' 		=> 'timeline_meta_typo',
				'selector'	=> '{{WRAPPER}} .timeline-wrapper .timestamp',
			]
		); //End Timeline Date Option


		$this->end_controls_section();

	} //End Timeline Content Style 



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

        echo '<div class="timeline-widget">';
        $is_inverted = false;
        foreach ($settings['timeline_items'] as $item) {
            $timestamp  = $item['timestamp'];
            $title      = $item['title'];
            $location   = $item['location'];
            $content    = $item['content'];

            echo '<div class="timeline-wrapper wow fadeInUp' . ($is_inverted ? ' timeline-inverted' : '') . '" data-wow-delay="0.1s">';
            echo '<div class="timestamp">' . $timestamp . '</div>';
            echo '<div class="timeline-panel">';
            echo '<h3>' . $title . '</h3>';
            echo '<span>' . $location . '</span>';
            echo '<p>' . $content . '</p>';
            echo '</div>';
            echo '</div>';

            $is_inverted = !$is_inverted;
        }
        echo '</div>';
        echo '</div>';
    }
}





























