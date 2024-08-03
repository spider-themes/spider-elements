<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

use SPEL\includes\Admin\Module_Settings;
$features = Module_Settings::get_widget_settings();


// Global switcher
$opt = get_option('spel_features_settings');
$global_switcher = $opt['spel_features_global_switcher'] ?? '';
$is_checked = !empty ($global_switcher == 'on') ? ' checked' : '';
$checked = !isset ($opt['spel_features_global_switcher']) ? ' checked' : $is_checked;

// Get the current theme
$theme = wp_get_theme();
$theme = in_array($theme->get('Name'), ['jobi', 'Jobi', 'jobi-child', 'Jobi Child']);

?>
<div id="features" class="spe-tab-box">
    <div class="spe_elements_tab_menu">
        <div class="spe_tab_content">
            <div class="icon">
                <i class="icon-feature_two"></i>
            </div>
            <div class="content">
                <h3><?php esc_html_e('Features', 'spider-elements'); ?></h3>
            </div>
        </div>

        <div class="menu_right_content">
            <div class="plugin_active_switcher">
                <label class="toggler" id="disable"><?php esc_html_e('Disable All', 'spider-elements'); ?></label>
                <div class="toggle">
                    <input type="checkbox" data-id="spe-widget-list" id="switcher" name="spel_features_global_switcher" class="check spel_features_global_switcher">
                    <label class="b switch" for="switcher"></label>
                </div>
                <label class="toggler" id="enabled"><?php esc_html_e('Enabled All', 'spider-elements'); ?></label>
            </div>
            <button type="submit" name="features-submit" id="features-submit" class="spe_dashboard_btn save_btn">
                <?php esc_html_e('Save Changes', 'spider-elements'); ?>
            </button>
        </div>


    </div>

    <div class="spe_elements_tab" id="elements_filter">
        <div class="spel_filter_data active" data-filter="*">
            <i class="icon-star"></i>
            <?php esc_html_e('All', 'spider-elements'); ?>
        </div>
        <div class="spel_filter_data" data-filter=".free">
            <i class="icon-gift"></i>
            <?php esc_html_e('Free', 'spider-elements'); ?>
        </div>
        <div class="spel_filter_data" data-filter=".pro">
            <i class="icon-pro-badge"></i>
            <?php esc_html_e('Pro', 'spider-elements'); ?>
        </div>
    </div>

    <div class="spe_filter_content ezd-d-flex" id="features_gallery">
        <?php
        if (isset($features[ 'spider_elements_features' ]) && is_array($features[ 'spider_elements_features' ])) {
            foreach ( $features[ 'spider_elements_features' ] as $item ) {

                $feature_type = $item[ 'feature_type' ] ?? '';
                $feature_name = $item['name'] ?? '';

                // Default class and attributes for widgets
                $is_pro_feature = $feature_type === 'pro' ? ' pro_popup' : '';
                $is_pro_feature_enabled = $feature_type === 'pro' ? ' disabled' : '';

                // Unlock specific features for Jobi theme users
                if (in_array($item['name'], ['spel_badge', 'spel_heading_highlighted']) && $theme || spel_is_premium() ) {
                    $is_pro_feature = ''; // Remove pro_popup class
                    $is_pro_feature_enabled = ''; // Enable widget
                }

                // By default, all the switcher is checked
                $opt_input      = $opt[ $feature_name ] ?? '';
                $is_checked     = ! empty ( $opt_input == 'on' ) ? ' checked' : '';
                $checked        = ! isset ( $opt[ $feature_name ] ) ? ' checked' : $is_checked;
                ?>
                <div class="ezd-colum-space-4 <?php echo esc_attr($item['feature_type']) ?>">
                    <div class="spe_element_box spe_element_switch badge">
                        <div class="spe_element_content">
                            <?php
                            if (!empty($item[ 'icon' ])) { ?>
                                <i class="<?php echo esc_attr($item[ 'icon' ]) ?>"></i>
                                <?php
                            }
                            if (!empty($item[ 'label' ])) { ?>
                                <label for="spe-elementor-video"><?php echo esc_html($item[ 'label' ]) ?></label>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="spe_element_right">
                            <?php
                            if (!empty($item[ 'label' ])) {
                                ?>
                                <div class="spe_link">
                                    <a href="<?php echo esc_url($item[ 'demo_url' ]) ?>" class="tooltip-top"
                                       data-tooltip="<?php printf(esc_attr__('View %s Feature Demo', 'spider-elements'), $item[ 'label' ]) ?>"
                                       target="_blank">
                                        <img src="<?php echo esc_url( SPEL_IMG . '/icon1.svg') ?>"
                                             alt="<?php esc_attr_e('Widget Demo', 'spider-elements'); ?>">
                                    </a>
                                    <a href="<?php echo esc_url($item[ 'video_url' ]) ?>" class="tooltip-top"
                                       data-tooltip="<?php printf(esc_attr__('View %s Video Tutorial', 'spider-elements'), $item[ 'label' ]) ?>"
                                       target="_blank">
                                        <img src="<?php echo esc_url( SPEL_IMG . '/icon2.svg') ?>"
                                             alt="<?php esc_attr_e('Video Tutorial', 'spider-elements'); ?>">
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                            <label for="<?php echo esc_attr($item['name']) ?>" class="spe-switch<?php echo esc_attr($is_pro_feature) ?>">
                                <input type="checkbox" class="spe_widget_checkbox spe-widget-list"
                                       name="<?php echo esc_attr($item[ 'name' ]) ?>"
                                       id="<?php echo esc_attr($item[ 'name' ]) ?>" <?php echo esc_attr($checked . $is_pro_feature_enabled); ?>>
                                <span class="spe_widget_switcher"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>