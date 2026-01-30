<?php
namespace Elementor;
namespace SPEL\includes\Admin\extension;

use Elementor\Controls_Manager;
use Elementor\Core\Files\CSS\Post;
use Elementor\Element_Base;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Register Advance Features Control Tab
 * Container & Section Features
 */
class Features_Badge {

    public function __construct ()
    {

        // Section Elements Fields
        add_action('elementor/element/section/section_advanced/after_section_end', [ $this, 'register_section_controls' ]);
        add_action('elementor/element/column/section_advanced/after_section_end', [ $this, 'register_section_controls' ]);
        add_action('elementor/element/container/section_layout/after_section_end', [ $this, 'register_section_controls' ]);

        // Add the 'before_render' action hook to the widget
        add_action('elementor/editor/before_render', [ $this, 'callback_render_display_content' ], 10, 1);
        add_action('elementor/frontend/before_render', [ $this, 'callback_render_display_content' ], 10, 1);

        //Frontend Before View
        add_action('elementor/frontend/container/before_render', [ $this, 'frontend_render_before' ]);
        add_action('elementor/frontend/column/before_render', [ $this, 'frontend_render_before' ]);
        add_action('elementor/frontend/section/before_render', [ $this, 'frontend_render_before' ]);

        //Frontend After View
        add_action('elementor/frontend/container/after_render', [ $this, 'frontend_render_after' ]);
        add_action('elementor/frontend/column/after_render', [ $this, 'frontend_render_after' ]);
        add_action('elementor/frontend/section/after_render', [ $this, 'frontend_render_after' ]);

        //Editor View
        add_action('elementor/section/print_template', [ $this, 'render_display_on_editor' ], 10, 2);
        add_action('elementor/column/print_template', [ $this, 'render_display_on_editor' ], 10, 2);
        add_action('elementor/container/print_template', [ $this, 'render_display_on_editor' ], 10, 2);

        // Add custom CSS rules to a post's CSS file.
        add_action('elementor/element/parse_css', [ $this, 'add_custom_rules_to_css_file' ], 10, 2);

    }


    /**
     * Section Controls
     */
    public function register_section_controls (Element_Base $element): void
    {

        //=============== Start Features Box ===============//
        $element->start_controls_section(
            'spel_features_badge_sec', [
                'label' => esc_html__('Feature Badge', 'spider-elements'),
                'tab' => Controls_Manager::TAB_LAYOUT,
            ]
        );

        //Badge Label Settings
        $element->add_control(
            'spe_fb_badge_enable', [
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label' => esc_html__('Enable Badge',  'spider-elements'),
                'frontend_available' => true,
                'label_on' => esc_html__('Yes',  'spider-elements'),
                'label_off' => esc_html__('No',  'spider-elements'),
                'return_value' => 'yes',
                'default' => 'no',
                'separator' => 'before',
            ]
        );

        $element->add_control(
            'spe_fb_badge_text',
            [
                'label' => esc_html__('Badge Label',  'spider-elements'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'spe_fb_badge_enable' => 'yes',
                ],
            ]
        );

        // Badge Text Color Settings
        $element->add_control(
            'spe_fb_badge_color',
            [
                'label' => esc_html__('Text Color',  'spider-elements'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'spe_fb_badge_enable' => 'yes',
                ],
                'separator' => 'before',
            ]
        );

        // Badge Background Color Settings
        $element->add_control(
            'spe_fb_badge_bg_color',
            [
                'label' => esc_html__('Background Color',  'spider-elements'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'spe_fb_badge_enable' => 'yes',
                ],
            ]
        );

        // Badge Text Typography Settings
        $element->add_responsive_control(
            'spe_fb_badge_position_top', [
                'label' => esc_html__('Position Top',  'spider-elements'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
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
                    'size' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .wrapper_badge_text .badge_text' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'spe_fb_badge_enable' => 'yes',
                ],
            ]
        );

        $element->end_controls_section(); // End Section

    }


    /**
     * Render Display Content.
     *
     * @param Element_Base $element
     *
     * @return void
     */
    public function callback_render_display_content( Element_Base $element ): void {

        $feature_icon = $element->get_settings_for_display( 'spe_fb_icon' );

        // It's render elementor wrapper div - Icon
        if ( $feature_icon && ! empty( $feature_icon['value'] ) ) {

            //It's render elementor wrapper div
            $element->add_render_attribute(
                '_wrapper', [
                    'class' => 'spe-features-box-enable',
                    'data-spe-element-icon' => $feature_icon['value'],
                ]
            );

        }

    }


    /**
     * Renders content before a section, column, or container in the frontend.
     *
     * @param Element_Base $section The section, column, or container element.
     */
    public function frontend_render_before( Element_Base $section ): void {

        if ( 'container' === $section->get_name() || 'column' === $section->get_name() || 'section' === $section->get_name() ) {
            $settings = $section->get_settings_for_display();

            if ( isset( $settings['spe_fb_badge_enable'] ) && 'yes' === $settings['spe_fb_badge_enable'] ) {
                $badge_text = ! empty( $settings['spe_fb_badge_text'] ) ? $settings['spe_fb_badge_text'] : '';
                ?>
                <div class="wrapper_badge_text position-relative">
                <span class="badge_text">
                    <span class="badge-element before"></span>
                    <?php echo esc_html( $badge_text ); ?>
                    <span class="badge-element after"></span>
                </span>
                <?php
            }
        }

    }


    /**
     * Renders content after a section, column, or container in the frontend.
     *
     * @param Element_Base $section The section, column, or container element.
     */
    public function frontend_render_after( Element_Base $section ): void {

        if ( 'container' === $section->get_name() || 'column' === $section->get_name() || 'section' === $section->get_name() ) {
            $settings = $section->get_settings_for_display();

            if ( isset( $settings['spe_fb_badge_enable'] ) && 'yes' === $settings['spe_fb_badge_enable'] ) {
                ?>
                </div>
                <?php
            }
        }
    }

    /**
     * Inject Image Editor
     *
     * @param $template
     * @return string
     */
    public function render_display_on_editor ($template): string
    {

        ob_start();
        $old_template = $template;
        ?>
        <# if ( settings.spe_fb_badge_enable==='yes' ) { #>
        <# let badge_text=settings.spe_fb_badge_text; let badge_text_color=settings.spe_fb_badge_color ?
        settings.spe_fb_badge_color : '#ffffff' ; let badge_bg_color=settings.spe_fb_badge_bg_color ?
        settings.spe_fb_badge_bg_color : '#31795A' ; let span_style='color: ' + badge_text_color + ';' ; let
        span_style_before='background: ' + badge_bg_color + ';' ; let span_style_after='background: ' + badge_bg_color
        + ';' ; #>

        <div class="wrapper_badge_text">
            <span class="badge_text" style="{{span_style}}">
                <span class="badge-element before" style="{{span_style_before}}"></span>
                {{badge_text}}
                <span class="badge-element after" style="{{span_style_after}}"></span>
            </span>
        </div>
        <# } #>
        <?php
        $content = ob_get_contents();
        ob_end_clean();
        return $content . $old_template;

    }

    /**
     * Add custom CSS rules to a post's CSS file.
     *
     * @param Post $post_css_file The post's CSS file.
     * @param Element_Base $element The Elementor element.
     *
     * @return void
     */
    public function add_custom_rules_to_css_file( Post $post_css_file, Element_Base $element ): void {

        // Get the display settings for the element.
        $settings = $element->get_settings_for_display();

        // Check if the badge is enabled
        if ( isset( $settings['spe_fb_badge_enable'] ) && 'yes' === $settings['spe_fb_badge_enable'] ) {

            // Add the custom CSS rules to the post's CSS file.
            $text_color = ! empty( $settings['spe_fb_badge_color'] ) ? $settings['spe_fb_badge_color'] : '';
            $position_top = ! empty( $settings['spe_fb_badge_position_top'] ) ? $settings['spe_fb_badge_position_top']['size'] . $settings['spe_fb_badge_position_top']['unit'] : '';

            $post_css_file->get_stylesheet()->add_rules(
                '.wrapper_badge_text .badge_text',
                [
                    'color' => $text_color,
                    'top'   => $position_top,
                ],
            );

            if ( ! empty( $settings['spe_fb_badge_bg_color'] ) ) {
                $post_css_file->get_stylesheet()->add_rules(
                    '.wrapper_badge_text .badge_text .badge-element',
                    [
                        'background' => $settings['spe_fb_badge_bg_color'] . ' !important',
                    ],
                );
            }

        }

    }

}