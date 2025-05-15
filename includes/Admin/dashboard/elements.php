<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

use SPEL\includes\Admin\Module_Settings;

$elements = Module_Settings::get_widget_settings();

// Global switcher
$element_opt       = get_option( 'spe_widget_settings' );
$checked_global    = ( ! isset( $element_opt['element_global_switcher'] ) || $element_opt['element_global_switcher'] === 'on' ) ? ' checked' : '';
$docy_widget_list  = [ 'docly_cheatsheet', 'spel_videos_playlist', 'docy_tabs', 'docly_alerts_box' ];
?>
<div id="elements" class="tab-box">
    <div class="elements_tab_menu">
        <div class="tab_contents">
            <div class="icon">
                <i class="icon-element"></i>
            </div>
            <div class="content">
                <h3><?php esc_html_e( 'Elements', 'spider-elements' ); ?></h3>
            </div>
        </div>
        <div class="menu_right_content">
            <div class="plugin_active_switcher">
                <label class="toggler" id="element_disabled"><?php esc_html_e( 'Disable All', 'spider-elements' ); ?></label>
                <div class="toggle">
                    <input type="checkbox" data-id="widget-list" id="element_switcher" name="element_global_switcher"
                           class="check element_global_switcher" <?php echo esc_attr( $checked_global ) ?>>
                    <label class="b switch" for="element_switcher"></label>
                </div>
                <label class="toggler" id="element_enabled"><?php esc_html_e( 'Enabled All', 'spider-elements' ); ?></label>
            </div>
            <button type="submit" name="elements-submit" id="elements-submit" class="dashboard_btn save_btn">
				<?php esc_html_e( 'Save Changes', 'spider-elements' ); ?>
            </button>
        </div>
    </div>

    <div class="elements_tab" id="elements_filter">
        <div class="filter_data active" data-filter="*">
            <i class="icon-star"></i><?php esc_html_e( 'All', 'spider-elements' ); ?>
        </div>
        <div class="filter_data" data-filter=".free">
            <i class="icon-gift"></i><?php esc_html_e( 'Free', 'spider-elements' ); ?>
        </div>
        <div class="filter_data" data-filter=".pro">
            <i class="icon-premium"></i><?php esc_html_e( 'Pro', 'spider-elements' ); ?>
        </div>
    </div>

    <div class="filter_content ezd-d-flex" id="elements_list">
		<?php
		if ( is_array( $elements['spider_elements_widgets'] ) ) {
			foreach ( $elements['spider_elements_widgets'] as $item ) {

				$widget_type = $item['widget_type'] ?? '';
				$widget_name = $item['name'] ?? '';

				$is_pro              = $widget_type === 'pro';
				$is_locked           = $is_pro && !spel_is_premium() && ! ( spel_unlock_docy_theme() && in_array( $widget_name, $docy_widget_list, true ) );
				$is_pro_widget_class = $is_locked ? ' pro_popup' : '';
				$is_pro_widget_attr  = $is_locked ? ' disabled' : '';

				// By default, all the switcher is checked
				$widget_checked    = (! isset( $element_opt[ $widget_name ] ) || $element_opt[ $widget_name ] === 'on' ) ? ' checked' : '';
				?>
                <div class="ezd-colum-space-4 <?php echo esc_attr( $item['widget_type'] ) ?>">
                    <div class="element_box element_switch badge">
                        <div class="element_content">
							<?php
							if ( ! empty( $item['icon'] ) ) { ?>
                                <i class="<?php echo esc_attr( $item['icon'] ) ?>"></i>
								<?php
							}
							if ( ! empty( $item['label'] ) ) { ?>
                                <label for="<?php echo esc_attr( $item['name'] ) ?>"><?php echo esc_html( $item['label'] ) ?></label>
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
                                        <a href="<?php echo esc_url( $item['demo_url'] ) ?>" class="tooltip-top"
                                           data-tooltip="<?php echo sprintf( esc_attr__( 'View %s Widget Demo', 'spider-elements' ), $item['label'] ) ?>"
                                           target="_blank">
                                            <img src="<?php echo esc_url( SPEL_IMG . '/dashboard/icon-demo.svg' ) ?>"
                                                 alt="<?php esc_attr_e( 'Widget Demo', 'spider-elements' ); ?>">
                                        </a>
										<?php
									}
									if ( ! empty( $item['video_url'] ) ) {
										?>
                                        <a href="<?php echo esc_url( $item['video_url'] ) ?>" class="tooltip-top"
                                           data-tooltip="<?php echo sprintf( esc_attr__( 'View %s Video Tutorial', 'spider-elements' ), $item['label'] ) ?>"
                                           target="_blank">
                                            <img src="<?php echo esc_url( SPEL_IMG . '/dashboard/icon-video.svg' ) ?>"
                                                 alt="<?php esc_attr_e( 'Video Tutorial', 'spider-elements' ); ?>">
                                        </a>
										<?php
									}
									if ( ! empty( $item['docs_url'] ) ) {
										?>
                                        <a href="<?php echo esc_url( $item['docs_url'] ) ?>" class="tooltip-top"
                                           data-tooltip="<?php echo sprintf( esc_attr__( 'View %s Documentation', 'spider-elements' ), $item['label'] ) ?>"
                                           target="_blank">
                                            <img src="<?php echo esc_url( SPEL_IMG . '/dashboard/icon-document.svg' ) ?>"
                                                 alt="<?php esc_attr_e( 'Documentation', 'spider-elements' ); ?>">
                                        </a>
										<?php
									}
									?>
                                </div>
								<?php
							}
							?>
                            <label for="<?php echo esc_attr( $item['name'] ) ?>" class="switch_label<?php echo esc_attr( $is_pro_widget_class ) ?>">
                                <input type="checkbox" class="widget_checkbox widget-list" name="<?php echo esc_attr( $item['name'] ) ?>"
                                       id="<?php echo esc_attr( $item['name'] ) ?>" <?php echo esc_attr( $widget_checked . $is_pro_widget_attr ); ?>>
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