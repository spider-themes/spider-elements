<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Color;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * Text Typing Effect
 *
 * Elementor widget for text typing effect.
 *
 * @since 1.7.0
 */
class Cheat_sheet extends Widget_Base {

    public function get_name() {
        return 'spider_cheatsheet';
    }

    public function get_title() {
        return esc_html__( 'Cheat Sheet', 'docy-core' );
    }

    public function get_icon() {
        return 'eicon-apps';
    }

    public function get_keywords() {
        return [ 'toggle' ];
    }

    public function get_categories() {
        return [ 'spider-elements' ];
    }

    protected function register_controls() {

        /** ============ Title Section ============ **/
        $this->start_controls_section(
            'cheat_sheet_sec',
            [
                'label' => esc_html__( 'Cheat Sheet', 'docy-core' ),
            ]
        );

        $this->add_control(
            'cheat_sheet_title',
            [
                'label' => esc_html__( 'Title', 'docy-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'cs_number', [
                'label' => __( 'Serial Number', 'docy-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '#1',
            ]
        );

        $repeater->add_control(
            'cs_title', [
                'label' => __( 'Top Text', 'docy-core' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'be',
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'cs_content', [
                'label' => __( 'Content', 'docy-core' ),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
            ]
        );

        $this->add_control(
            'cheat_sheet_contents',
            [
                'label' => __( 'Cheat Sheet List', 'docy-core' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ cs_title }}}',
                'prevent_empty' => false
            ]
        );

        $this->add_control(
            'collapse_state', [
                'label' => esc_html__( 'Extended Collapse', 'docy-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'docy-core' ),
                'label_off' => esc_html__( 'No', 'docy-core' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();


        /**
         *
         * Style Tab
         *
         **/

        //--------------------------------------------------- Title Color ---------------------------------------//
        $this->start_controls_section(
            'cheat_sheet_title_style',
            [
                'label' => esc_html__('Title', 'rogan-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'cheat_sheet_title_color', [
                'label' => esc_html__('Text Color', 'rogan-core'),
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
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .cheatsheet_accordian .card .card-header button',
            ]
        );

        $this->end_controls_section(); // End Title


        //----------------------------------------------- Item Color ---------------------------------------//
        $this->start_controls_section(
            'cheat_sheet_item_style',
            [
                'label' => esc_html__('Cheat Sheet Item', 'rogan-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'cheat_sheet_item_number_color', [
                'label' => esc_html__('Number Color', 'rogan-core'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .cheatsheet_item .cheatsheet_num' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'cheat_sheet_item_number_typo',
                'scheme' => Typography::TYPOGRAPHY_1,
                'label' => esc_html__('Number Typography', 'rogan-core'),
                'selector' => '{{WRAPPER}} .cheatsheet_item .cheatsheet_num',
            ]
        );

        $this->add_control(
            'cheat_sheet_item_top_color', [
                'label' => esc_html__('Top Text Color', 'rogan-core'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .cheatsheet_item p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'cheat_sheet_item_top_typo',
                'scheme' => Typography::TYPOGRAPHY_1,
                'label' => esc_html__('Top Text Typography', 'rogan-core'),
                'selector' => '{{WRAPPER}} .cheatsheet_item p',
            ]
        );

        $this->add_control(
            'cheat_sheet_item_bottom_color', [
                'label' => esc_html__('Bottom Text Color', 'rogan-core'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .cheatsheet_item h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(), [
                'name' => 'cheat_sheet_item_bottom_typo',
                'scheme' => Typography::TYPOGRAPHY_1,
                'label' => esc_html__('Bottom Text Typography', 'rogan-core'),
                'selector' => '{{WRAPPER}} .cheatsheet_item h4',
            ]
        );

        $this->end_controls_section();


        //----------------------------------------------- Background Color ---------------------------------------//
        $this->start_controls_section(
            'sec_bg_style',
            [
                'label' => esc_html__('Background', 'rogan-core'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sec_bg_color', [
                'label' => esc_html__('Background Color', 'rogan-core'),
                'type' => Controls_Manager::COLOR,
                'separator' => 'before',
                'selectors' => [
                    '{{WRAPPER}} .cheatsheet_item .cheatsheet_num' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();
        $id = $this->get_ID();
        $cheat_sheet_title = !empty( $settings['cheat_sheet_title'] ) ? $settings['cheat_sheet_title'] : '';
        $cheat_sheet_contents = is_array( $settings['cheat_sheet_contents'] ) ? $settings['cheat_sheet_contents'] : '';
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
                            if ( $cheat_sheet_contents ) {
                                foreach ( $cheat_sheet_contents as $item ) {
                                    ?>
                                    <div class="col-lg-3">
                                        <div class="cheatsheet_item shadow-sm">
                                            <?php
                                            if ( !empty( $item['cs_number'] ) ) {
                                                echo '<div class="cheatsheet_num">'.esc_html($item['cs_number']).'</div>';
                                            }

                                            if ( !empty( $item['cs_title'] ) ) {
                                                echo wp_kses_post(wpautop($item['cs_title']));
                                            }

                                            if ( !empty( $item['cs_content'] ) ) {
                                                echo '<h5>'.wp_kses_post($item['cs_content']).'</h5>';
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