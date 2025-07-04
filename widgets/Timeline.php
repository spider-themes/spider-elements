<?php
/**
 * Use namespace to avoid conflict
 */

namespace SPEL\Widgets;

use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Class Timeline
 * @package spider\Widgets
 */
class Timeline extends Widget_Base {

	public function get_name(): string
    {
		return 'spe_timeline_widget'; // ID of the widget (Don't change this name)
	}


	public function get_title(): string
    {
		return esc_html__( 'SE Timeline', 'spider-elements' );
	}

	public function get_icon(): string
    {
		return 'eicon-time-line spel-icon';
	}

	public function get_categories(): array
    {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends(): array
    {
		return [ 'spel-main' ];
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
				'label' => esc_html__( 'Timeline', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'timestamp',
			[
				'label'       => esc_html__( 'Timestamp', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( '11.05.2013', 'spider-elements' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Davidson College', 'spider-elements' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'location',
			[
				'label'       => esc_html__( 'Location', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'North Carolina', 'spider-elements' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'content',
			[
				'label'      => esc_html__( 'Content', 'spider-elements' ),
				'type'       => Controls_Manager::WYSIWYG,
				'default'    => esc_html__( 'Vitae adipiscing turpis...', 'spider-elements' ),
				'show_label' => false,
			]
		);


		$this->add_control(
			'timeline_items',
			[
				'label'       => esc_html__( 'Timeline Items', 'spider-elements' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'timestamp' => esc_html__( '11.05.2013', 'spider-elements' ),
						'title'     => esc_html__( 'Davidson College', 'spider-elements' ),
						'location'  => esc_html__( 'North Carolina', 'spider-elements' ),
						'content'   => esc_html__( 'Vitae adipiscing turpis...', 'spider-elements' ),
					],
					// Add more default timeline items here...
				],
				'title_field' => '{{{ title }}}',
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'background',
				'types'    => [ 'classic', 'gradient', ],
				'separator'=> 'before',
				'selector' => '{{WRAPPER}} .timeline-wrapper .timeline-panel p::after',
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
				'label'     => esc_html__( 'Title', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'timeline', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .timeline-panel h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'timeline_title_typo',
				'selector' => '{{WRAPPER}} .timeline-wrapper .timeline-panel h3',
			]
		); //End TImeline Title


		//=== Timeline Location
		$this->add_control(
			'timeline_location', [
				'label'     => esc_html__( 'Location', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'timeline_location_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .timeline-panel span' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'timeline_location_typo',
				'selector' => '{{WRAPPER}} .timeline-wrapper .timeline-panel span',
			]
		); //End Timeline Location


		//=== Timeline Content
		$this->add_control(
			'timeline_content', [
				'label'     => esc_html__( 'Timeline Content', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'timeline_content_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .timeline-panel p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'timeline_content_typo',
				'selector' => '{{WRAPPER}} .timeline-wrapper .timeline-panel p',
			]
		); //End Timeline content


		//=== Timeline Date Option
		$this->add_control(
			'timeline_date', [
				'label'     => esc_html__( 'Date', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name'     => 'timeline_date_bg_color',
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .timeline-wrapper .timestamp'
			]
		);

		$this->add_control(
			'timeline_date_color', [
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .timeline-wrapper .timestamp' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'timeline_meta_typo',
				'selector' => '{{WRAPPER}} .timeline-wrapper .timestamp',
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

        if ( !empty( $settings['timeline_items'] ) ) {
            echo '<div class="timeline-widget">';
            $is_inverted = false;
            foreach ( $settings[ 'timeline_items' ] as $item ) {
                $timestamp = !empty($item[ 'timestamp' ]) ? $item[ 'timestamp' ] : '';
                $title = !empty($item[ 'title' ]) ? $item[ 'title' ] : '';
                $location = !empty($item[ 'location' ]) ? $item[ 'location' ] : '';
                $content = !empty($item[ 'content' ]) ? $item[ 'content' ] : '';
                echo '<div class="timeline-wrapper wow fadeInUp' . ($is_inverted ? ' timeline-inverted' : '') . '" data-wow-delay="0.1s">';
                echo '<div class="timestamp">' . esc_html($timestamp) . '</div>';
                echo '<div class="timeline-panel">';
                echo '<h3>' . esc_html($title) . '</h3>';
                echo '<span>' . esc_html($location) . '</span>';
                echo spel_kses_post(wpautop($content));
                echo '</div>';
                echo '</div>';
                $is_inverted = !$is_inverted;
            }
            echo '</div>';
            echo '</div>';
        }
	}
}