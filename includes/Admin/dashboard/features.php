<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

use SPEL\includes\Admin\Module_Settings;

$features = Module_Settings::get_widget_settings();

// Global switcher
$opt             = get_option( 'spel_features_settings' );
$global_switcher = $opt['features_global_switcher'] ?? '';
$is_checked      = ! empty ( $global_switcher == 'on' ) ? ' checked' : '';
$checked         = ! isset ( $opt['features_global_switcher'] ) ? ' checked' : $is_checked;

// Get the current theme
$theme = wp_get_theme();
$theme = in_array( $theme->get( 'Name' ), [ 'jobi', 'Jobi', 'jobi-child', 'Jobi Child' ] );
?>
<div id="features" class="tab-box">

    <div class="elements_tab_menu">
        <div class="tab_contents">
            <div class="icon">
                <i class="icon-feature_two"></i>
            </div>
            <div class="content">
                <h3><?php esc_html_e( 'Features', 'spider-elements' ); ?></h3>
            </div>
        </div>

        <div class="menu_right_content">
            <div class="plugin_active_switcher">
                <label class="toggler" id="features_disabled"><?php esc_html_e( 'Disable All', 'spider-elements' ); ?></label>
                <div class="toggle">
                    <input type="checkbox" data-id="widget-list" id="features_switcher" name="features_global_switcher" class="check features_global_switcher">
                    <label class="b switch" for="features_switcher"></label>
                </div>
                <label class="toggler" id="features_enabled"><?php esc_html_e( 'Enabled All', 'spider-elements' ); ?></label>
            </div>
            <button type="submit" name="features-submit" id="features-submit" class="dashboard_btn save_btn">
				<?php esc_html_e( 'Save Changes', 'spider-elements' ); ?>
            </button>
        </div>

    </div>

    <div class="elements_tab" id="elements_filter">
        <div class="filter_data active" data-filter="*">
            <i class="icon-star"></i>
			<?php esc_html_e( 'All', 'spider-elements' ); ?>
        </div>
        <div class="filter_data" data-filter=".free">
            <i class="icon-gift"></i>
			<?php esc_html_e( 'Free', 'spider-elements' ); ?>
        </div>
        <div class="filter_data" data-filter=".pro">
            <i class="icon-premium"></i>
			<?php esc_html_e( 'Pro', 'spider-elements' ); ?>
        </div>
    </div>

    <div class="filter_content ezd-d-flex" id="features_gallery">
		<?php
		if ( isset( $features['spider_elements_features'] ) && is_array( $features['spider_elements_features'] ) ) {
			foreach ( $features['spider_elements_features'] as $item ) {

				$feature_type = $item['feature_type'] ?? '';
				$feature_name = $item['name'] ?? '';

				// Default class and attributes for widgets
				$is_pro_feature         = $feature_type === 'pro' ? ' pro_popup' : '';
				$is_pro_feature_enabled = $feature_type === 'pro' ? ' disabled' : '';

				// Unlock specific features for Jobi theme users
				if ( in_array( $item['name'], [ 'spel_badge', 'spel_heading_highlighted' ] ) && $theme || spel_is_premium() ) {
					$is_pro_feature         = ''; // Remove pro_popup class
					$is_pro_feature_enabled = ''; // Enable widget
				}

				// By default, only free features are checked
				$opt_input = $opt[ $feature_name ] ?? '';
				if ( $feature_type === 'pro' && ! spel_is_premium() && ! ( in_array( $item['name'], [ 'spel_badge', 'spel_heading_highlighted' ] ) && $theme ) ) {
					// Pro feature: unchecked by default
					$checked = ! isset( $opt[ $feature_name ] ) ? '' : ( ! empty( $opt_input == 'on' ) ? ' checked' : '' );
				} else {
					// Free feature or unlocked pro: checked by default
					$is_checked = ! empty( $opt_input == 'on' ) ? ' checked' : '';
					$checked    = ! isset( $opt[ $feature_name ] ) ? ' checked' : $is_checked;
				}
				?>
                <div class="ezd-colum-space-4 <?php echo esc_attr( $item['feature_type'] ) ?>">
                    <div class="element_box element_switch badge">
                        <div class="element_content">
							<?php
							if ( ! empty( $item['icon'] ) ) { ?>
                                <i class="<?php echo esc_attr( $item['icon'] ) ?>"></i>
								<?php
							}
							if ( ! empty( $item['label'] ) ) { ?>
                                <label for="elementor-video"><?php echo esc_html( $item['label'] ) ?></label>
								<?php
							}
							?>
                        </div>
                        <div class="element_right">
							<?php
							if ( ! empty( $item['label'] ) ) {
								?>
                                <div class="link">

									<?php
									if ( ! empty( $item['demo_url'] ) ) {
										?>
                                        <a href="<?php echo esc_url( $item['demo_url'] ) ?>" class="tooltip-top" data-tooltip="<?php echo esc_attr( sprintf( __( 'View %s Feature Demo', 'spider-elements' ), $item['label'] ) ); ?>" target="_blank">
                                            <img src="<?php echo esc_url( SPEL_IMG . '/dashboard/icon-demo.svg' ) ?>" alt="<?php esc_attr_e( 'Widget Demo', 'spider-elements' ); ?>">
                                        </a>
										<?php
									}
									if ( ! empty( $item['demo_url'] ) ) {
										?>
                                        <a href="<?php echo esc_url( $item['video_url'] ) ?>" class="tooltip-top" data-tooltip="<?php echo esc_attr( sprintf( __( 'View %s Video Tutorial', 'spider-elements' ), $item['label'] ) ); ?>"
                                           target="_blank">
                                            <img src="<?php echo esc_url( SPEL_IMG . '/dashboard/icon-video.svg' ) ?>" alt="<?php esc_attr_e( 'Video Tutorial', 'spider-elements' ); ?>">
                                        </a>
										<?php
									}

									?>
                                </div>
								<?php
							}
							?>
                            <label for="<?php echo esc_attr( $item['name'] ) ?>" class="switch_label<?php echo esc_attr( $is_pro_feature ) ?>">
                                <input type="checkbox" class="widget_checkbox widget-list" name="<?php echo esc_attr( $item['name'] ) ?>" id="<?php echo esc_attr( $item['name'] ) ?>" <?php echo esc_attr( $checked . $is_pro_feature_enabled ); ?>>
                                <span class="widget_switcher"></span>
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