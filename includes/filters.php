<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

add_image_size( 'spe_270x152', 270, 152, true ); // Video Playlist Thumb
add_image_size( 'spe_120x70', 120, 70, true ); // Fullscreen slider Thumb 01


add_action( 'admin_init', function () {

    // Retrieve the field values from the form
    if ( isset( $_POST['elements-submit'] ) ) {

        // All Free Widgets
        $docy_tabs                       = isset( $_POST['docy_tabs'] ) ? sanitize_text_field( $_POST['docy_tabs'] ) : '';
        $docy_videos_playlist            = isset( $_POST['docy_videos_playlist'] ) ? sanitize_text_field( $_POST['docy_videos_playlist'] ) : '';
        $docly_alerts_box                = isset( $_POST['docly_alerts_box'] ) ? sanitize_text_field( $_POST['docly_alerts_box'] ) : '';
        $spel_accordion                  = isset( $_POST['spel_accordion'] ) ? sanitize_text_field( $_POST['spel_accordion'] ) : '';
        $docy_testimonial                = isset( $_POST['docy_testimonial'] ) ? sanitize_text_field( $_POST['docy_testimonial'] ) : '';
        $landpagy_pricing_table_tabs     = isset( $_POST['landpagy_pricing_table_tabs'] ) ? sanitize_text_field( $_POST['landpagy_pricing_table_tabs'] ) : '';
        $landpagy_pricing_table_switcher = isset( $_POST['landpagy_pricing_table_switcher'] ) ? sanitize_text_field( $_POST['landpagy_pricing_table_switcher'] ) : '';
        $docly_list_item                 = isset( $_POST['docly_list_item'] ) ? sanitize_text_field( $_POST['docly_list_item'] ) : '';
        $docly_cheatsheet                = isset( $_POST['docly_cheatsheet'] ) ? sanitize_text_field( $_POST['docly_cheatsheet'] ) : '';
        $docy_team_carousel              = isset( $_POST['docy_team_carousel'] ) ? sanitize_text_field( $_POST['docy_team_carousel'] ) : '';
        $docy_integrations               = isset( $_POST['docy_integrations'] ) ? sanitize_text_field( $_POST['docy_integrations'] ) : '';
        $after_before_widget             = isset( $_POST['spe_after_before_widget'] ) ? sanitize_text_field( $_POST['spe_after_before_widget'] ) : '';
        $docy_video_popup                = isset( $_POST['docy_video_popup'] ) ? sanitize_text_field( $_POST['docy_video_popup'] ) : '';
        $docy_blog_grid                  = isset( $_POST['docy_blog_grid'] ) ? sanitize_text_field( $_POST['docy_blog_grid'] ) : '';
        $spe_timeline_widget             = isset( $_POST['spe_timeline_widget'] ) ? sanitize_text_field( $_POST['spe_timeline_widget'] ) : '';
        $spe_buttons                     = isset( $_POST['spe_buttons'] ) ? sanitize_text_field( $_POST['spe_buttons'] ) : '';
        $spe_animated_heading            = isset( $_POST['spe_animated_heading'] ) ? sanitize_text_field( $_POST['spe_animated_heading'] ) : '';
        $spe_counter                     = isset( $_POST['spe_counter'] ) ? sanitize_text_field( $_POST['spe_counter'] ) : '';
        $spe_instagram                   = isset( $_POST['spe_instagram'] ) ? sanitize_text_field( $_POST['spe_instagram'] ) : '';
        $spel_icon_box                   = isset( $_POST['spel_icon_box'] ) ? sanitize_text_field( $_POST['spel_icon_box'] ) : '';


        // All Pro Widgets
        $spel_accordion_article          = isset( $_POST['spel_accordion_article'] ) ? sanitize_text_field( $_POST['spel_accordion_article'] ) : '';
        $docy_box_hover                  = isset( $_POST['docy_box_hover'] ) ? sanitize_text_field( $_POST['docy_box_hover'] ) : '';
        $spel_business_hours             = isset( $_POST['spel_business_hours'] ) ? sanitize_text_field( $_POST['spel_business_hours'] ) : '';
        $spe_feature_box                 = isset( $_POST['spe_feature_box'] ) ? sanitize_text_field( $_POST['spe_feature_box'] ) : '';
        $docy_flip_box                   = isset( $_POST['docy_flip_box'] ) ? sanitize_text_field( $_POST['docy_flip_box'] ) : '';
        $docly_hotspot                   = isset( $_POST['docly_hotspot'] ) ? sanitize_text_field( $_POST['docly_hotspot'] ) : '';
        $docy_image_hover                = isset( $_POST['docy_image_hover'] ) ? sanitize_text_field( $_POST['docy_image_hover'] ) : '';
        $docy_image_slides               = isset( $_POST['docy_image_slides'] ) ? sanitize_text_field( $_POST['docy_image_slides'] ) : '';
        $spel_marquee_slider             = isset( $_POST['spel_marquee_slider'] ) ? sanitize_text_field( $_POST['spel_marquee_slider'] ) : '';
        $spe_skill_showcase_widget       = isset( $_POST['spe_skill_showcase_widget'] ) ? sanitize_text_field( $_POST['spe_skill_showcase_widget'] ) : '';
        $spel_stacked_image              = isset( $_POST['spel_stacked_image'] ) ? sanitize_text_field( $_POST['spel_stacked_image'] ) : '';


        //Global Switcher
        $spe_global_switcher 		   	 = isset( $_POST['spe_global_switcher'] ) ? sanitize_text_field( $_POST['spe_global_switcher'] ) : '';

        // Create an array to store the field values
        $data = array(

            // All Free Widgets
            'docy_tabs'                       => $docy_tabs,
            'docy_videos_playlist'            => $docy_videos_playlist,
            'docly_alerts_box'                => $docly_alerts_box,
            'spel_accordion'                  => $spel_accordion,
            'docy_testimonial'                => $docy_testimonial,
            'landpagy_pricing_table_tabs'     => $landpagy_pricing_table_tabs,
            'landpagy_pricing_table_switcher' => $landpagy_pricing_table_switcher,
            'docly_list_item'                 => $docly_list_item,
            'docly_cheatsheet'                => $docly_cheatsheet,
            'docy_team_carousel'              => $docy_team_carousel,
            'docy_integrations'               => $docy_integrations,
            'spe_after_before_widget'         => $after_before_widget,
            'docy_video_popup'                => $docy_video_popup,
            'docy_blog_grid'                  => $docy_blog_grid,
            'spe_timeline_widget'             => $spe_timeline_widget,
            'spe_buttons'                     => $spe_buttons,
            'spe_animated_heading'            => $spe_animated_heading,
            'spe_counter'                     => $spe_counter,
            'spe_instagram'                   => $spe_instagram,
            'spel_icon_box'                   => $spel_icon_box,

            // All Pro Widgets
            'spel_accordion_article'          => $spel_accordion_article,
            'docy_box_hover'                  => $docy_box_hover,
            'spel_business_hours'             => $spel_business_hours,
            'spe_feature_box'                 => $spe_feature_box,
            'docy_flip_box'                   => $docy_flip_box,
            'docly_hotspot'                   => $docly_hotspot,
            'docy_image_hover'                => $docy_image_hover,
            'docy_image_slides'               => $docy_image_slides,
            'spel_marquee_slider'             => $spel_marquee_slider,
            'spe_skill_showcase_widget'       => $spe_skill_showcase_widget,
            'spel_stacked_image'              => $spel_stacked_image,


            //Global Switcher
            'spe_global_switcher'             => $spe_global_switcher,
        );

        // Save the data in the options table using update_option
        update_option( 'spe_widget_settings', $data );

    }

} );


// Dashboard Features Setting Save Data
add_action( 'admin_init', function () {

    if ( isset( $_POST['features-submit'] ) ) {

        // Retrieve the field values from the form
        $spel_smooth_animation     = isset( $_POST['spel_smooth_animation'] ) ? sanitize_text_field( $_POST['spel_smooth_animation'] ) : '';
        $spel_badge                = isset( $_POST['spel_badge'] ) ? sanitize_text_field( $_POST['spel_badge'] ) : '';
        $spel_reveal_animation     = isset( $_POST['spel_reveal_animation'] ) ? sanitize_text_field( $_POST['spel_reveal_animation'] ) : '';

        // Create an array to store the field values
        $data = array(
            'spel_smooth_animation'       => $spel_smooth_animation,
            'spel_badge'                  => $spel_badge,
            'spel_reveal_animation'       => $spel_reveal_animation,
        );

        // Save the data in the options table using update_option
        update_option( 'spel_features_settings', $data );

    }

} );