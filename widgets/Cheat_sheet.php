<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements_Assets\Widgets;

use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Class Alerts_box
 * @package spider\Widgets
 * @since 1.0.0
 */
class Cheat_sheet extends Widget_Base {

    public function get_name() {
        return 'docly_cheatsheet';
    }

    public function get_title() {
        return esc_html__( 'Cheat Sheet', 'spider-elements' );
    }

    public function get_icon() {
        return 'eicon-apps se-icon';
    }

    public function get_keywords() {
        return [ 'spider', 'spider elements', 'toggle' ];
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'bootstrap', 'se-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'bootstrap', ];
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

		//======================== Cheat Sheet Section =========================//
		$this->start_controls_section(
			'cheat_sheet_sec', [
				'label' => esc_html__( 'Cheat Sheet', 'spider-elements' ),
			]
		);

		$this->add_control(
			'cheat_sheet_title', [
				'label' => esc_html__( 'Title', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
                'default' => esc_html__( 'Auxiliary', 'spider-elements' ),
			]
		);

		$repeater = new Repeater();
		$repeater->add_control(
			'cs_number', [
				'label' => __( 'Serial Number', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => '#1',
			]
		);

		$repeater->add_control(
			'cs_title', [
				'label' => __( 'Top Text', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'be', 'spider-elements' ),
			]
		);

		$repeater->add_control(
			'cs_content', [
				'label' => __( 'Content', 'spider-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( 'Sein', 'spider-elements' ),
			]
		);

		$this->add_control(
			'cheat_sheet_contents', [
				'label' => __( 'Cheat Sheet List', 'spider-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{{ cs_title }}}',
				'default' => [
					[
						'cs_number' => esc_html__( '#1', 'spider-elements' ),
						'cs_title' => esc_html__( 'be', 'spider-elements' ),
						'cs_content' => esc_html__( 'sein', 'spider-elements' ),
					],
					[
						'cs_number' => esc_html__( '#2', 'spider-elements' ),
						'cs_title' => esc_html__( 'have', 'spider-elements' ),
						'cs_content' => esc_html__( 'haben', 'spider-elements' ),
					],
					[
						'cs_number' => esc_html__( '#3', 'spider-elements' ),
						'cs_title' => esc_html__( 'become', 'spider-elements' ),
						'cs_content' => esc_html__( 'werden', 'spider-elements' ),
					],
					[
						'cs_number' => esc_html__( '#4', 'spider-elements' ),
						'cs_title' => esc_html__( 'can', 'spider-elements' ),
						'cs_content' => esc_html__( 'konnen', 'spider-elements' ),
					],
				],
				'prevent_empty' => false
			]
		);

		$this->add_control(
			'collapse_state', [
				'label' => esc_html__( 'Extended Collapse', 'spider-elements' ),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'spider-elements' ),
				'label_off' => esc_html__( 'No', 'spider-elements' ),
				'return_value' => 'yes',
				'default' => 'yes',
                'separator' => 'before'
			]
		);

		$this->end_controls_section(); // End Cheat Sheet Section

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

		//======================== Style Title =========================//
		$this->start_controls_section(
			'cheat_sheet_title_style', [
				'label' => esc_html__('Title', 'spider-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'cheat_sheet_title_color', [
				'label' => esc_html__('Text Color', 'spider-elements'),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .cheatsheet_accordian .card .card-header button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'cheat_sheet_title_typo',
				'selector' => '{{WRAPPER}} .cheatsheet_accordian .card .card-header button',
			]
		);

		$this->end_controls_section(); // End Style Title


		//================================ Cheat Sheet Item ================================//
		$this->start_controls_section(
			'style_cs_item', [
				'label' => esc_html__('Cheat Sheet Item', 'spider-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        //=== Number Options
		$this->add_control(
			'cs_num_options', [
				'label' => esc_html__('Number Options', 'spider-elements'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'cs_item_num_color', [
				'label' => esc_html__('Text Color', 'spider-elements'),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .cheatsheet_item .cheatsheet_num' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'cs_item_num_typo',
				'selector' => '{{WRAPPER}} .cheatsheet_item .cheatsheet_num',
			]
		); // End Number Options


		//=== Top Text Options
		$this->add_control(
			'cs_top_text_options', [
				'label' => esc_html__('Top Text Options', 'spider-elements'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'cs_item_top_color', [
				'label' => esc_html__('Text Color', 'spider-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cheatsheet_item p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'cs_item_top_typo',
				'selector' => '{{WRAPPER}} .cheatsheet_item p',
			]
		); // End Top Text Options


        //=== Bottom Text Options
		$this->add_control(
			'cs_bottom_text_options', [
				'label' => esc_html__('Bottom Text Options', 'spider-elements'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'cs_item_bottom_color', [
				'label' => esc_html__('Text Color', 'spider-elements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cheatsheet_item h5' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(), [
				'name' => 'cs_item_bottom_typo',
				'selector' => '{{WRAPPER}} .cheatsheet_item h5',
			]
		); // End Bottom Text Options

		$this->end_controls_section(); // End Cheat Sheet Item


		//========================= Item Box Background ==========================//
		$this->start_controls_section(
			'sec_bg_style', [
				'label' => esc_html__('Background Box Item', 'spider-elements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_box_margin', [
				'label' => esc_html__( 'Margin', 'spider-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .cheatsheet_item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_box_padding', [
				'label' => esc_html__( 'Padding', 'spider-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .cheatsheet_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'item_box_bg_color', [
				'label' => esc_html__('Background Color', 'spider-elements'),
				'type' => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .cheatsheet_item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section(); // End Item Box Background

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
        extract( $settings); // extract all settings array to variables converted to name of key
        $id = $this->get_ID();
        $cheat_sheet_title = !empty( $settings['cheat_sheet_title'] ) ? $settings['cheat_sheet_title'] : '';
        $is_collapsed = $settings['collapse_state'] == 'yes' ? 'true' : 'false';
        $is_collapsed_class = $settings['collapse_state'] == 'yes' ? '' : 'collapsed';
        $is_show = $settings['collapse_state'] == 'yes' ? 'show' : '';

        ?>
        <div class="cheatsheet_info">
            <div class="accordion cheatsheet_accordian">

                <div id="cheat-<?php echo esc_attr($id) ?>" class="card">
                    <div class="card-header" id="headingAtlas-<?php echo esc_attr($id) ?>">
                        <?php if ( $cheat_sheet_title ) : ?>
                            <h2 class="mb-0">
                                <button class="btn btn-link <?php echo esc_attr($is_collapsed_class) ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAtlas-<?php echo esc_attr($id) ?>" aria-expanded="<?php echo esc_attr($is_collapsed) ?>" aria-controls="collapseAtlas-<?php echo esc_attr($id) ?>">
                                    <?php echo esc_html( $cheat_sheet_title ) ?>
                                    <span class="pluse">[+]</span><span class="minus">[-]</span>
                                </button>
                            </h2>
                        <?php endif ?>
                    </div>
                    <div id="collapseAtlas-<?php echo esc_attr($id) ?>" class="collapse <?php echo esc_attr($is_show) ?>" aria-labelledby="headingAtlas-<?php echo esc_attr($id) ?>">
                        <div class="row">
                            <?php
                            if ( is_array($cheat_sheet_contents) ) {
                                foreach ( $cheat_sheet_contents as $item ) {
                                    ?>
                                    <div class="col-lg-3">
                                        <div class="cheatsheet_item shadow-sm">
                                            <?php
                                            if ( !empty( $item['cs_number'] ) ) {
                                                echo '<div class="cheatsheet_num">'.esc_html($item['cs_number']).'</div>';
                                            }
                                            if ( !empty( $item['cs_title'] ) ) {
                                                echo '<p>'.esc_html($item['cs_title']).'</p>';
                                            }
                                            if ( !empty( $item['cs_content'] ) ) {
                                                echo '<h5>'.esc_html($item['cs_content']).'</h5>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php
    }
}