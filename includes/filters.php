<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_image_size( 'spe_270x152', 270, 152, true ); // Video Playlist Thumb
add_image_size( 'spe_120x70', 120, 70, true ); // Fullscreen slider Thumb 01

/**
 * Constants for widgets badge
 */
if ( ! defined( 'SPEL_TEXT_BADGE' ) ) {
    define('SPEL_TEXT_BADGE',
        '<span class="spe-text-badge-control">' . esc_html__( 'SPIDER', 'spider-elements' ) . '</span>'
    );
}

if ( ! defined( 'SPEL_PRO_BADGE' ) ) {
    define('SPEL_PRO_BADGE',
        '<span class="spel-pro-badge-control">' . esc_html__( 'PRO', 'spider-elements' ) . '</span>'
    );
}


add_action( 'admin_init', function () {

    // Retrieve the field values from the form
    if ( isset( $_POST['elements-submit'] ) ) {

        // Free Widgets
        $free_widgets = [
            'docy_tabs',
            'docy_videos_playlist',
            'docly_alerts_box',
            'spel_accordion',
            'docy_testimonial',
            'landpagy_pricing_table_tabs',
            'landpagy_pricing_table_switcher',
            'docly_list_item',
            'docly_cheatsheet',
            'docy_team_carousel',
            'docy_integrations',
            'spe_after_before_widget',
            'docy_video_popup',
            'docy_blog_grid',
            'spe_timeline_widget',
            'spe_buttons',
            'spe_animated_heading',
            'spe_counter',
            'spe_instagram',
            'spel_icon_box'
        ];


        // Pro Widgets
        $pro_widgets = [
            'spel_accordion_article',
            'docy_box_hover',
            'spel_business_hours',
            'spe_feature_box',
            'docy_flip_box',
            'docly_hotspot',
            'docy_image_hover',
            'docy_image_slides',
            'spel_marquee_slider',
            'spe_skill_showcase_widget',
            'spel_stacked_image'
        ];

        // Collect Free Widgets Values
        $data = [];
        foreach ($free_widgets as $widget) {
            $data[$widget] = isset($_POST[$widget]) ? sanitize_text_field($_POST[$widget]) : '';
        }


        // Collect Pro Widgets Values
        foreach ($pro_widgets as $widget) {
            $data[$widget] = isset($_POST[$widget]) ? sanitize_text_field($_POST[$widget]) : '';
        }

        // Global Switcher
        $data['spe_global_switcher'] = isset($_POST['spe_global_switcher']) ? sanitize_text_field($_POST['spe_global_switcher']) : '';

        // Save the data in the options table using update_option
        update_option('spe_widget_settings', $data);

        // If the user is not on a pro plan, reset pro widgets
        if (!spel_is_premium()) {
            foreach ($pro_widgets as $widget) {
                $data[$widget] = 'off';
            }
            update_option('spe_widget_settings', $data);
        }

    }

} );


// Dashboard Features Setting Save Data
add_action( 'admin_init', function () {

    if ( isset( $_POST['features-submit'] ) ) {

        // Pro Widgets
        $pro_features = [
            'spel_badge',
            'spel_reveal_animation',
            'spel_smooth_animation',
        ];


        $data = [];

        // Collect Pro Features Values
        foreach ($pro_features as $feature) {
            $data[$feature] = isset($_POST[$feature]) ? sanitize_text_field($_POST[$feature]) : '';
        }

        // Global Switcher
        $data['spel_features_global_switcher'] = isset($_POST['spel_features_global_switcher']) ? sanitize_text_field($_POST['spel_features_global_switcher']) : '';

        // Save the data in the options table using update_option
        update_option( 'spel_features_settings', $data );


        // If the user is not on a pro plan, reset pro widgets
        if (!spel_is_premium()) {
            foreach ($pro_features as $feature) {
                $data[$feature] = 'off';
            }
            update_option('spel_features_settings', $data);
        }

    }

} );