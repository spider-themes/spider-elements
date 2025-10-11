<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_image_size( 'spel_270x152', 270, 152, true ); // Video Playlist Thumb

/**
 * Constants for the widget badge
 */
add_action( 'after_setup_theme', function () {

	if ( ! defined( 'SPEL_TEXT_BADGE' ) ) {
		define( 'SPEL_TEXT_BADGE',
			'<span class="spe-text-badge-control">' . esc_html__( 'SPIDER', 'spider-elements' ) . '</span>'
		);
	}

	if ( ! defined( 'SPEL_PRO_BADGE' ) ) {
		define( 'SPEL_PRO_BADGE',
			'<span class="spel-pro-badge-control">' . esc_html__( 'PRO', 'spider-elements' ) . '</span>'
		);
	}

}, 20 );


add_action( 'admin_init', function () {

	// Retrieve the field values from the form
	if ( isset( $_POST['elements-submit'] ) ) {

		if ( ! wp_verify_nonce( $_POST['spel_elements_nonce'], 'spel_elements_nonce' ) ) {
			return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Free Widgets
		$free_widgets = [
			'spel_accordion',
			'docy_testimonial',
			'docly_list_item',
			'docy_team_carousel',
			'docy_integrations',
			'docy_video_popup',
			'docy_blog_grid',
			'spe_timeline_widget',
			'spe_counter',
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

		// Docy Widgets
		$docy_widgets = [
			'docly_cheatsheet',
			'spel_videos_playlist',
			'docy_tabs',
			'docly_alerts_box',
		];

		// Collect Free Widgets Values
		$data = [];
		foreach ( $free_widgets as $widget ) {
			$data[ $widget ] = isset( $_POST[ $widget ] ) ? sanitize_text_field( $_POST[ $widget ] ) : '';
		}

		// Collect Pro Widgets Values
		foreach ( $pro_widgets as $widget ) {
			$data[ $widget ] = isset( $_POST[ $widget ] ) ? sanitize_text_field( $_POST[ $widget ] ) : '';
		}

		// Collect Docy Widgets Values
		foreach ( $docy_widgets as $widget ) {
			$data[ $widget ] = isset( $_POST[ $widget ] ) ? sanitize_text_field( $_POST[ $widget ] ) : '';
		}

		// Global Switcher
		$data['element_global_switcher'] = isset( $_POST['element_global_switcher'] ) ? sanitize_text_field( $_POST['element_global_switcher'] ) : '';

		// Save the data in the option table using update_option
		update_option( 'spe_widget_settings', $data );

		// If the user is not on a pro plan, reset pro-widgets
		if ( ! spel_is_premium() ) {
			foreach ( $pro_widgets as $widget ) {
				$data[ $widget ] = 'off';
			}
			update_option( 'spe_widget_settings', $data );
		}

		// If the user is not on a pro-plan or Docy theme, reset pro-widgets
		$is_premium_or_theme = spel_unlock_docy_theme();
		if ( ! $is_premium_or_theme ) {
			foreach ( $docy_widgets as $widget ) {
				$data[ $widget ] = 'off';
			}
			update_option( 'spe_widget_settings', $data );
		}
	}

} );


// Dashboard Features Setting Save Data
add_action( 'admin_init', function () {

	if ( isset( $_POST['features-submit'] ) ) {

		if ( ! wp_verify_nonce( $_POST['spel_features_nonce'], 'spel_features_nonce' ) ) {
			return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Pro Widgets
		$pro_features = [
			'spel_badge',
			'spel_reveal_animation',
			'spel_heading_highlighted',
			'spel_feature_box',
			'spel_smooth_animation',
		];

		$data = get_option( 'spel_features_settings', [] );

		// Collect Pro Features Values
		foreach ( $pro_features as $feature ) {
			$data[ $feature ] = isset( $_POST[ $feature ] ) ? sanitize_text_field( $_POST[ $feature ] ) : '';
		}

		// Global Switcher
		$data['features_global_switcher'] = isset( $_POST['features_global_switcher'] ) ? sanitize_text_field( $_POST['features_global_switcher'] ) : '';

		// Save the data in the option table using update_option
		update_option( 'spel_features_settings', $data );

		// If the user is not on a pro-plan or Jobi theme, reset pro-widgets
		$theme               = wp_get_theme();
		$is_premium_or_theme = spel_is_premium() || in_array( $theme->get( 'Name' ), [ 'jobi', 'Jobi', 'jobi-child', 'Jobi Child' ] );
		if ( ! $is_premium_or_theme ) {
			foreach ( $pro_features as $feature ) {
				$data[ $feature ] = 'off';
			}
			update_option( 'spel_features_settings', $data );
		}
	}

} );