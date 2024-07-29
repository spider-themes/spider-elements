<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div id="elements_popup1" class="elements_pro_popup">
    <div class="message_content ezd-text-center">
        <div class="close-pro">
            <img class="pro-close" src="<?php echo esc_url(SPEL_IMG . '/dashboard-img/modal-close.png') ?>"
                 alt="<?php esc_attr_e('Popup Close', 'spider-elements'); ?>">
        </div>
        <div class="pro-icon">
            <img class="pro-image" src="<?php echo esc_url(SPEL_IMG . '/dashboard-img/dimond.png') ?>"
                 alt="<?php esc_attr_e('Popup Pro Diamond', 'spider-elements'); ?>">
        </div>
        <div class="pro-content">
            <h3><?php esc_html_e('Go Pro', 'spider-elements'); ?></h3>
            <p><?php esc_html_e('Upgrade to Pro Version for Unlock more features!', 'spider-elements'); ?></p>
            <a href="#" class="spe_dashboard_btn" target="_blank">
                <?php esc_html_e('Upgrade Now', 'spider-elements'); ?>
            </a>
        </div>
    </div>
</div>
