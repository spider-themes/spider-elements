<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


/**
 * Class Skill_Showcase
 * @package spider\Widgets
 */
class Skill_Showcase extends Widget_Base {

    public function get_name() {
        return 'spe_skill_showcase_widget'; 
    }

    public function get_title() {
        return __( 'Skill Showcase', 'spider-elements' ); 
    }

    public function get_icon() {
        return ' eicon-woo-settings spe-icon'; 
    }

    public function get_categories() {
        return [ 'spider-elements' ]; 
    }

    /**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'bootstrap',  'spe-main' ];
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
    public function elementor_content_control() {
      
        //=================== Skill Showcase Text ===================//
        $this->start_controls_section(
            'section_skills',
            [
                'label' => __('Skills', 'spider-elements'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'name',
            [
                'label'         => __('Skill Name', 'spider-elements'),
                'type'          => Controls_Manager::TEXT,
                'default'       => __('Skill Name', 'spider-elements'),
                'label_block'   => true,
            ]
        );

        $repeater->add_control(
            'size',
            [
                'label'     => __('Size', 'spider-elements'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'default'   => __('Default', 'spider-elements'),
                    'small'     => __('Small', 'spider-elements'),
                    'big'       => __('Big', 'spider-elements'),
                ],
                'default'   => 'default',
            ]
        );

        $this->add_control(
            'skills_list',
            [
                'label'     => __('Skills List', 'spider-elements'),
                'type'      => Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'default'   => [
                    [
                        'name' => __('Html', 'spider-elements'),
                        'size' => 'default',
                    ],
                    [
                        'name' => __('Css', 'spider-elements'),
                        'size' => 'default',
                    ],
                    [
                        'name' => __('Java', 'spider-elements'),
                        'size' => 'default',
                    ],
                    [
                        'name' => __('JavaScript', 'spider-elements'),
                        'size' => 'big',
                    ],
                    [
                        'name' => __('Schema', 'spider-elements'),
                        'size' => 'small',
                    ],
                    [
                        'name' => __('Python', 'spider-elements'),
                        'size' => 'small',
                    ],
                    [
                        'name' => __('Kotlin', 'spider-elements'),
                        'size' => 'default',
                    ],
                    [
                        'name' => __('SQL', 'spider-elements'),
                        'size' => 'Default',
                    ],
                    [
                        'name' => __('Perl', 'spider-elements'),
                        'size' => 'small',
                    ],
                    [
                        'name' => __('PHP', 'spider-elements'),
                        'size' => 'default',
                    ],
                    [
                        'name' => __('Scala', 'spider-elements'),
                        'size' => 'default',
                    ],
                    [
                        'name' => __('.NET', 'spider-elements'),
                        'size' => 'big',
                    ],
                    [
                        'name' => __('Swift', 'spider-elements'),
                        'size' => 'default',
                    ],
                    [
                        'name' => __('Angular', 'spider-elements'),
                        'size' => 'small',
                    ],
                    [
                        'name' => __('MATLAB', 'spider-elements'),
                        'size' => 'small',
                    ],
                    [
                        'name' => __('C++', 'spider-elements'),
                        'size' => 'default',
                    ],
                    [
                        'name' => __('Golang', 'spider-elements'),
                        'size' => 'big',
                    ],
                    [
                        'name' => __('TypeScript', 'spider-elements'),
                        'size' => 'default',
                    ],
                    [
                        'name' => __('Ruby', 'spider-elements'),
                        'size' => 'default',
                    ],
                    [
                        'name' => __('Rust', 'spider-elements'),
                        'size' => 'default',
                    ],
                    // Add more default skills here...
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();
    } //End Skill Showcase Text


    
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

		//============================= Skill Showcase Style =============================//
		$this->start_controls_section(
			'skill_showcase_text', [
				'label' => esc_html__( 'Skill Showcase', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'skill_text_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .skill-showcase span' => 'color: {{VALUE}};',
				],
			]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name'     => 'showcase_text_typography',
				'selector' => '{{WRAPPER}} .skill-showcase span',
			]
		);

		$this->end_controls_section();

	} //End Skill Showcase style
 


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

    if (empty($settings['skills_list'])) {
        return;
    }

    echo '<div class="col-lg-5 offset-lg-2 col-md-6 text-end wow fadeInRight">';
    echo '<div class="skill-showcase">';
    foreach ($settings['skills_list'] as $skill) {
        if ($skill['size'] === 'default') {
            echo '<span>' . $skill['name'] . '</span>';
        } elseif ($skill['size'] === 'small') {
            echo '<span class="small">' . $skill['name'] . '</span>';
        } elseif ($skill['size'] === 'big') {
            echo '<span class="big">' . $skill['name'] . '</span>';
        }
    }
    echo '</div>';
    echo '</div>';
    }
  
}











