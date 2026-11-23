<?php
/**
 * Anonymous usage reporting for Spider Elements.
 *
 * Counts active widgets and features. Never stores page designs, elementor template contents,
 * or personal user data.
 *
 * @package SpiderElements
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$spel_telemetry_sdk = __DIR__ . '/class-spider-telemetry.php';
if ( file_exists( $spel_telemetry_sdk ) ) {
	require_once $spel_telemetry_sdk;
}

/**
 * Whether Freemius usage sharing is on for Spider Elements.
 *
 * The opt-in click is the decision. Email confirmation only finishes the
 * Freemius account, so a pending activation still counts.
 *
 * @return bool
 */
function spel_fs_usage_allowed() {
	if ( ! function_exists( 'spel_fs' ) ) {
		return false;
	}
	$fs = spel_fs();
	if ( method_exists( $fs, 'is_tracking_allowed' ) && $fs->is_tracking_allowed() ) {
		return true;
	}
	return method_exists( $fs, 'is_pending_activation' ) && $fs->is_pending_activation();
}

/**
 * Whether usage sharing is enabled.
 *
 * A missing choice stays off. Freemius tracking counts only when the site
 * has not opted out.
 *
 * @return bool
 */
function spel_share_usage_enabled() {
	if ( get_option( 'spiderthemes_telemetry_spider-elements_optout', false ) ) {
		return false;
	}
	if ( get_option( 'spiderthemes_telemetry_spider-elements_optin', false ) ) {
		return true;
	}
	return spel_fs_usage_allowed();
}

/**
 * AJAX handler for toggling anonymous telemetry consent in dashboard.
 *
 * @return void
 */
function spel_telemetry_toggle_ajax() {
	check_ajax_referer( 'spel_telemetry_toggle', 'nonce' );

	if ( ! current_user_can( 'manage_options' ) ) {
		wp_send_json_error( array( 'message' => __( 'Unauthorized', 'spider-elements' ) ) );
	}

	$enabled = ! empty( $_POST['enabled'] ) && in_array( $_POST['enabled'], array( 1, '1', true, 'true' ), true );

	if ( ! class_exists( 'SpiderThemes\\Telemetry' ) ) {
		wp_send_json_error( array( 'message' => __( 'Telemetry SDK not loaded', 'spider-elements' ) ) );
	}

	if ( $enabled ) {
		delete_option( 'spiderthemes_telemetry_spider-elements_optout' );
		\SpiderThemes\Telemetry::grant_consent( 'spider-elements', 'user' );
		wp_send_json_success( array( 'message' => __( 'Anonymous usage sharing enabled. Thank you!', 'spider-elements' ) ) );
	} else {
		\SpiderThemes\Telemetry::revoke_consent( 'spider-elements' );
		wp_send_json_success( array( 'message' => __( 'Anonymous usage sharing disabled.', 'spider-elements' ) ) );
	}
}
add_action( 'wp_ajax_spel_telemetry_toggle', 'spel_telemetry_toggle_ajax' );

add_action( 'init', 'spel_boot_telemetry', 1 );

/**
 * Register the telemetry client after translations are available.
 *
 * @return void
 */
function spel_boot_telemetry() {
	if ( ! class_exists( 'SpiderThemes\\Telemetry' ) ) {
		return;
	}

	\SpiderThemes\Telemetry::init(
		array(
			'plugin_slug'              => 'spider-elements',
			'plugin_name'              => 'Spider Elements',
			'plugin_version'           => defined( 'SPEL_VERSION' ) ? SPEL_VERSION : '1.9.1',
			'plugin_file'              => defined( 'SPEL_FILE' ) ? SPEL_FILE : dirname( __DIR__ ) . '/spider-elements.php',
			'optin_title'              => __( 'Help us improve Spider Elements', 'spider-elements' ),
			'optin_message'            => __( 'Help make Spider Elements better by sharing anonymous widget and feature usage counts. No sensitive data or design content is ever collected.', 'spider-elements' ),
			'consent_callback'         => 'spel_fs_usage_allowed',
			'consent_follows_callback' => true,
			'custom_metrics'           => 'spel_telemetry_metrics',
		)
	);
}

/**
 * Metrics payload reported on activation and weekly heartbeats.
 *
 * Counts only. Never includes design contents, user inputs, or personal data.
 *
 * @return array<string, int|string>
 */
function spel_telemetry_metrics() {
	$widget_opt  = get_option( 'spe_widget_settings', array() );
	$feature_opt = get_option( 'spel_features_settings', array() );
	$is_pro      = function_exists( 'spel_is_premium' ) && spel_is_premium() ? 1 : 0;

	// Ensure Module_Settings is available even in cron or non-admin contexts
	if ( ! class_exists( 'SPEL\\includes\\Admin\\Module_Settings' ) ) {
		$module_settings_file = __DIR__ . '/Admin/Module_Settings.php';
		if ( file_exists( $module_settings_file ) ) {
			require_once $module_settings_file;
		}
	}

	// Count active widgets
	$active_widgets = 0;
	if ( class_exists( 'SPEL\\includes\\Admin\\Module_Settings' ) ) {
		$settings = \SPEL\includes\Admin\Module_Settings::get_widget_settings();
		if ( ! empty( $settings['spider_elements_widgets'] ) ) {
			foreach ( $settings['spider_elements_widgets'] as $widget ) {
				$name = $widget['name'] ?? '';
				if ( ! isset( $widget_opt[ $name ] ) || 'on' === $widget_opt[ $name ] ) {
					if ( 'pro' !== ( $widget['widget_type'] ?? '' ) || $is_pro ) {
						++$active_widgets;
					}
				}
			}
		}
	}

	// Count active features
	$active_features = 0;
	if ( class_exists( 'SPEL\\includes\\Admin\\Module_Settings' ) ) {
		$settings = \SPEL\includes\Admin\Module_Settings::get_widget_settings();
		if ( ! empty( $settings['spider_elements_features'] ) ) {
			foreach ( $settings['spider_elements_features'] as $feature ) {
				$name = $feature['name'] ?? '';
				if ( ! isset( $feature_opt[ $name ] ) || 'on' === $feature_opt[ $name ] ) {
					if ( 'pro' !== ( $feature['feature_type'] ?? '' ) || $is_pro ) {
						++$active_features;
					}
				}
			}
		}
	}

	// Count elementor library templates if post type exists
	$templates_count = 0;
	if ( post_type_exists( 'elementor_library' ) ) {
		$counts          = wp_count_posts( 'elementor_library' );
		$templates_count = isset( $counts->publish ) ? (int) $counts->publish : 0;
	}

	// Individual widget states helper (default is 'on' for free unless explicitly 'off')
	$is_widget_on = function( $key ) use ( $widget_opt ) {
		return ( ! isset( $widget_opt[ $key ] ) || 'on' === $widget_opt[ $key ] ) ? 1 : 0;
	};

	// Pro widgets (default is off unless on and pro is active)
	$is_pro_widget_on = function( $key ) use ( $widget_opt, $is_pro ) {
		if ( ! $is_pro ) {
			return 0;
		}
		return ( isset( $widget_opt[ $key ] ) && 'on' === $widget_opt[ $key ] ) ? 1 : 0;
	};

	// Features states helper
	$is_feature_on = function( $key ) use ( $feature_opt ) {
		return ( isset( $feature_opt[ $key ] ) && 'on' === $feature_opt[ $key ] ) ? 1 : 0;
	};

	$theme      = wp_get_theme();
	$theme_name = $theme ? $theme->get( 'Name' ) : '';

	return array(
		'is_pro'                      => $is_pro,
		'active_widgets'              => $active_widgets,
		'active_features'             => $active_features,
		'templates_count'             => $templates_count,
		'widget_accordion'            => $is_widget_on( 'spel_accordion' ),
		'widget_testimonial'          => $is_widget_on( 'docy_testimonial' ),
		'widget_list_item'            => $is_widget_on( 'docly_list_item' ),
		'widget_team_carousel'        => $is_widget_on( 'docy_team_carousel' ),
		'widget_integrations'         => $is_widget_on( 'docy_integrations' ),
		'widget_video_popup'          => $is_widget_on( 'docy_video_popup' ),
		'widget_blog_grid'            => $is_widget_on( 'docy_blog_grid' ),
		'widget_timeline'             => $is_widget_on( 'spe_timeline_widget' ),
		'widget_counter'              => $is_widget_on( 'spe_counter' ),
		'widget_icon_box'             => $is_widget_on( 'spel_icon_box' ),
		'widget_tabs'                 => $is_widget_on( 'docy_tabs' ),
		'widget_alerts_box'           => $is_widget_on( 'docly_alerts_box' ),
		'widget_dynamic_faq'          => $is_pro_widget_on( 'spel_dynamic_faq' ),
		'feature_smooth_animation'    => $is_feature_on( 'spel_smooth_animation' ),
		'feature_reveal_animation'    => $is_feature_on( 'spel_reveal_animation' ),
		'feature_badge'               => $is_feature_on( 'spel_badge' ),
		'feature_heading_highlighted' => $is_feature_on( 'spel_heading_highlighted' ),
		'theme_is_docy'               => function_exists( 'spel_unlock_docy_theme' ) && spel_unlock_docy_theme() ? 1 : 0,
		'theme_is_jobi'               => in_array( $theme_name, array( 'jobi', 'Jobi', 'jobi-child', 'Jobi Child' ), true ) ? 1 : 0,
	);
}

/**
 * Record a single upgraded_to_pro event the first time Spider Elements Pro is active.
 *
 * @return void
 */
function spel_track_pro_upgrade() {
	if ( ! function_exists( 'spel_is_premium' ) || ! spel_is_premium() ) {
		return;
	}
	if ( get_option( 'spel_telemetry_tracked_pro_upgrade' ) ) {
		return;
	}
	if ( ! class_exists( 'SpiderThemes\\Telemetry' ) ) {
		return;
	}

	\SpiderThemes\Telemetry::track_event( 'spider-elements', 'upgraded_to_pro' );
	update_option( 'spel_telemetry_tracked_pro_upgrade', time(), false );
}
add_action( 'admin_init', 'spel_track_pro_upgrade' );
