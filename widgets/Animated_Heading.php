<?php

/**
 * Use namespace to avoid conflict
 */

namespace Spider_Elements\Widgets;

use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Alerts_box
 */
class Animated_Heading extends Widget_Base {

	public function get_name() {
		return 'spe_animated_heading'; // ID of the widget (Don't change this name)
	}

	public function get_title() {
		return esc_html__( 'Animated Heading', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-heading spel-icon';
	}

	public function get_keywords() {
		return [ 'Heading', 'Animated', 'Animated Heading' ];
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'text-type' ];
	}

	/**
	 * Name: register_controls()
	 * Desc: Register controls for these widgets
	 * Params: no params
	 * Return: @void
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
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	public function elementor_content_control() {
		//============================= Filter Options =================================== //
		$this->start_controls_section(
			'se_animated_headline_sec',
			[
				'label' => esc_html__( 'Title', 'spider-elements' ),
			]
		);

		$this->add_control(
			'headline_before_text', [
				'label'       => esc_html__( 'Before Title', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( "I’m a", 'spider-elements' ),
				'placeholder' => esc_html__( 'Type your section ID here', 'spider-elements' ),
			]
		);

		$this->end_controls_section(); //End Filter

		$this->start_controls_section(
			'se_clip_list', [
				'label' => esc_html__( 'Clip List', 'spider-elements' )

			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'title1',
			[
				'label' => esc_html__( 'First Text', 'spider-elements' ),
				'type'  => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'title2',
			[
				'label' => esc_html__( 'Second Text', 'spider-elements' ),
				'type'  => Controls_Manager::TEXT,
			]
		);


		$this->add_control(
			'cd_option_list',
			[
				'label'       => esc_html__( 'Slide List', 'spider-elements' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'title1' => esc_html__( 'Web', 'spider-elements' ),
						'title2' => esc_html__( 'Developer', 'spider-elements' ),
					],
					[
						'title1' => esc_html__( 'Web', 'spider-elements' ),
						'title2' => esc_html__( 'Professional Coder', 'spider-elements' ),
					],
					[
						'title1' => esc_html__( 'Web', 'spider-elements' ),
						'title2' => esc_html__( 'Developer', 'spider-elements' ),
					],

				],
				'title_field' => '{{{ title2 }}}',
			]
		);

		$this->end_controls_section(); //End Filter

	}


	/**
	 * Name: elementor_style_control()
	 * Desc: Register the Style Tab output on the Elementor editor.
	 * Params: no params
	 * Return: @void
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	public function elementor_style_control() {

		$this->start_controls_section(
			'style_animated_headline',
			[
				'label' => esc_html__( 'Animated Headline Style', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		//=== Before Title
		$this->add_control(
			'se_before_title',
			[
				'label'     => esc_html__( 'Before Title', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'se_b_t_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} h1.cd-headline' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'se_b_t_color_typo',
				'selector' => '{{WRAPPER}} h1.cd-headline',
			]
		); //End Author Name

		//=== First Text Title
		$this->add_control(
			'se_f_t_title',
			[
				'label'     => esc_html__( 'First Text', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'se_f_t_title_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .single-headline span b' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'se_f_t_title_typo',
				'selector' => '{{WRAPPER}} .single-headline span b',
			]
		);

		//=== Second Text Title
		$this->add_control(
			'se_s_t_title',
			[
				'label'     => esc_html__( 'Second Text', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'se_s_t_title_color',
			[
				'label'     => esc_html__( 'Text Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} span.is-visible' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'se_s_t_title_typo',
				'selector' => '{{WRAPPER}} span.is-visible',
			]
		); //End Author Name

		$this->end_controls_tab();
	}

	/**
	 * Name: elementor_render()
	 * Desc: Render the widget output on the frontend.
	 * Params: no params
	 * Return: @void
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		extract( $settings ); // extract all settings array to variables converted to name of key
		?>
        <h1 class="cd-headline clip home-headline">
			<?php echo esc_html( $settings['headline_before_text'] ) ?>
            <small class="cd-words-wrapper single-headline">
				<?php
				$i = "";
				if ( ! empty( $cd_option_list ) ) {
					foreach ( $cd_option_list as $item ) {
						$vihi = $i == 1 ? 'visible' : 'hidden';
						$i ++;
						$slide_title1 = ! empty( $item['title1'] ) ? $item['title1'] : '';
						$slide_title2 = ! empty( $item['title2'] ) ? $item['title2'] : '';
						?>
                        <span class="is-<?php echo esc_attr( $vihi ); ?>">
                            <?php
                            if ( $slide_title1 ) { ?>
                                <b><?php echo esc_attr( $slide_title1 ); ?></b>
                                <?php
                            }
                            if ( $slide_title2 ) {
                                echo esc_attr( $slide_title2 );
                            }
                            ?>
                        </span>
                        <?php
					}
				}
				?>
            </small>
        </h1>
		<?php
	}
}