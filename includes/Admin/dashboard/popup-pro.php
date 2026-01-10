<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>
<div id="elements_popup1" class="elements_pro_popup">
    <div class="message_content ezd-text-center">
        <div class="close-pro">
            <img class="pro-close" src="<?php echo esc_url( SPEL_IMG . '/dashboard/modal-close.png' ) ?>"
                 alt="<?php esc_attr_e( 'Close Popup', 'spider-elements' ); ?>">
        </div>
        <div class="pro-icon">
            <img class="pro-image" src="<?php echo esc_url( SPEL_IMG . '/dashboard/dimond.png' ) ?>"
                 alt="<?php esc_attr_e( 'Pro Feature', 'spider-elements' ); ?>">
        </div>
        <div class="pro-content">
            <h3><?php esc_html_e( 'Unlock Pro Features', 'spider-elements' ); ?></h3>
            <p><?php esc_html_e( 'Upgrade to Spider Elements Pro to unlock all premium widgets and features for building amazing websites!', 'spider-elements' ); ?></p>
            <ul class="pro-benefits" style="text-align: left; margin: 20px 0; padding-left: 24px;">
                <li style="margin-bottom: 8px; font-size: 14px; color: var(--spel-text-secondary);">
                    <i class="icon-check" style="color: var(--spel-success); margin-right: 8px;"></i>
					<?php esc_html_e( 'All Premium Widgets', 'spider-elements' ); ?>
                </li>
                <li style="margin-bottom: 8px; font-size: 14px; color: var(--spel-text-secondary);">
                    <i class="icon-check" style="color: var(--spel-success); margin-right: 8px;"></i>
					<?php esc_html_e( 'Premium Extensions', 'spider-elements' ); ?>
                </li>
                <li style="margin-bottom: 8px; font-size: 14px; color: var(--spel-text-secondary);">
                    <i class="icon-check" style="color: var(--spel-success); margin-right: 8px;"></i>
					<?php esc_html_e( 'Priority Support', 'spider-elements' ); ?>
                </li>
                <li style="margin-bottom: 8px; font-size: 14px; color: var(--spel-text-secondary);">
                    <i class="icon-check" style="color: var(--spel-success); margin-right: 8px;"></i>
					<?php esc_html_e( 'Regular Updates', 'spider-elements' ); ?>
                </li>
            </ul>
            <a href="admin.php?page=spider_elements_settings-pricing" class="dashboard_btn">
                <i class="icon-premium"></i>
				<?php esc_html_e( 'Upgrade to Pro', 'spider-elements' ); ?>
            </a>
        </div>
    </div>
</div>