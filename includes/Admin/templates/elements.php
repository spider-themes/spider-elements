<?php

use Spider_Elements_Assets\includes\Admin\Module_Settings;

$elements = Module_Settings::get_widget_settings();
?>
<div id="elements" class="spe-tab-box">
    <div class="spe_elements_tab_menu">
        <div class="spe_tab_content">
            <div class="icon">
                <i class="icon-element"></i>
            </div>
            <div class="content">
                <h3><?php esc_html_e( 'Elements', 'spider-elements' ); ?></h3>
            </div>
        </div>
        <div class="menu_right_content">
            <div class="plugin_active_switcher">
                <label class="toggler" id="disable"><?php esc_html_e( 'Disable All', 'spider-elements' ); ?></label>
                <div class="toggle">
                    <input type="checkbox" data-id="spe-widget-list" id="switcher"
                           class="check spe_element_global_switcher">
                    <label class="b switch" for="switcher"></label>
                </div>
                <label class="toggler" id="enabled"><?php esc_html_e( 'Enabled All', 'spider-elements' ); ?></label>
            </div>
            <button type="submit" name="elements-submit" class="spe_dashboard_btn save_btn">
				<?php esc_html_e( 'Save Changes', 'spider-elements' ); ?>
            </button>
        </div>
    </div>

    <div class="spe_elements_tab" id="elements_filter">
        <div class="spe_fiter_data active" data-filter="*">
            <i class="icon-star"></i><?php esc_html_e( 'All', 'spider-elements' ); ?>
        </div>
        <div class="spe_fiter_data" data-filter=".free">
            <i class="icon-gift"></i><?php esc_html_e( 'Free', 'spider-elements' ); ?>
        </div>
        <div class="spe_fiter_data" data-filter=".pro">
            <i class="icon-pro-badge"></i><?php esc_html_e( 'Pro', 'spider-elements' ); ?>
        </div>
    </div>

    <div class="spe_filter_content ezd-d-flex" id="elements_gallery">
		<?php
		if ( is_array( $elements ) ) {
			foreach ( $elements as $item ) {
				$widget_type   = $item[ 'widget_type' ] ?? '';
				$is_pro_widget = $widget_type === 'pro' ? ' class=pro_popup' : '';
                $is_pro_widget_enabled = $widget_type === 'pro' ? ' disabled' : '';

				$elements_opt = get_option( 'spe_widget_settings' );
				$opt_name     = $item[ 'name' ] ?? '';

				$checked = '';
				if ( isset( $elements_opt[ $opt_name ] ) && $elements_opt[ $opt_name ] == 'on' ) {
					$checked = ' checked="on"';
				}
				?>
                <div class="ezd-colum-space-4 <?php echo esc_attr( $item[ 'widget_type' ] ) ?>">
                    <div class="spe_element_box spe_element_switch badge">
                        <div class="spe_element_content">
							<?php
							if ( ! empty( $item[ 'icon' ] ) ) { ?>
                                <i class="<?php echo esc_attr( $item[ 'icon' ] ) ?>"></i>
								<?php
							}
							if ( ! empty( $item[ 'label' ] ) ) { ?>
                                <label for="<?php echo esc_attr( $item[ 'name' ] ) ?>"><?php echo esc_html( $item[ 'label' ] ) ?></label>
								<?php
							}
							?>
                        </div>
                        <div class="spe_element_right">
							<?php
							if ( ! empty( $item[ 'label' ] ) ) {
								?>
                                <div class="spe_link">
                                    <a href="<?php echo esc_url( $item[ 'demo_url' ] ) ?>" class="tooltip-top"
                                       data-tooltip="<?php printf( esc_attr__( 'View %s Widget Demo',
										   'spider-elements' ), $item[ 'label' ] ) ?>" target="_blank">
                                        <img src="<?php echo SPE_IMG . '/icon1.svg' ?>"
                                             alt="<?php esc_attr_e( 'Widget Demo', 'spider-elements' ); ?>">
                                    </a>
                                    <a href="<?php echo esc_url( $item[ 'video_url' ] ) ?>" class="tooltip-top"
                                       data-tooltip="<?php printf( esc_attr__( 'View %s Video Tutorial',
										   'spider-elements' ), $item[ 'label' ] ) ?>" target="_blank">
                                        <img src="<?php echo SPE_IMG . '/icon2.svg' ?>"
                                             alt="<?php esc_attr_e( 'Video Tutorial', 'spider-elements' ); ?>">
                                    </a>
                                </div>
								<?php
							}
							?>
                            <label<?php echo esc_attr( $is_pro_widget ) ?> class="spe-switch">

                                <input type="checkbox" class="spe_widget_checkbox spe-widget-list"
                                       name="<?php echo esc_attr( $item[ 'name' ] ) ?>"
                                       id="<?php echo esc_attr( $item[ 'name' ] ) ?>" <?php echo esc_attr( $checked . $is_pro_widget_enabled ); ?>>
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

<div id="elements_popup1" class="elements_pro_popup">
    <div class="message_content ezd-text-center">
        <div class="close-pro">
            <img class="pro-close" src="<?php echo SPE_IMG . '/dashboard-img/modal-close.png' ?>"
                 alt="<?php esc_attr_e( 'Popup Close', 'spider-elements' ); ?>">
        </div>
        <div class="pro-icon">
            <img class="pro-image" src="<?php echo SPE_IMG . '/dashboard-img/dimond.png' ?>"
                 alt="<?php esc_attr_e( 'Popup Pro Diamond', 'spider-elements' ); ?>">
        </div>
        <div class="pro-content">
            <h3><?php esc_html_e( 'Go Pro', 'spider-elements' ); ?></h3>
            <p><?php esc_html_e( 'Upgrade to Pro Version for Unlock more features!', 'spider-elements' ); ?></p>
            <a href="#" class="spe_dashboard_btn" target="_blank">
				<?php esc_html_e( 'Confirm', 'spider-elements' ); ?>
            </a>
        </div>
    </div>
</div>