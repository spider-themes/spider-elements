<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

use Spider_Elements\includes\Admin\Module_Settings;
$elements = Module_Settings::get_widget_settings();


echo '<pre>';
print_r($elements['spider_elements_features']);
echo '</pre>';
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
                    <input type="checkbox" id="f_switcher" class="check">
                    <label class="b switch" for="f_switcher"></label>
                </div>
                <label class="toggler" id="enabled"><?php esc_html_e('Enabled All', 'spider-elements'); ?></label>
            </div>
            <button type="submit" class="spe_dashboard_btn">
                <?php esc_html_e('Save Changes', 'spider-elements'); ?>
            </button>
        </div>
    </div>


    <div class="spe_elements_tab" id="features_filter">
        <div class="spe_fiter_data active" data-filter="*">
            <i class="icon-star"></i>All
        </div>
        <div class="spe_fiter_data" data-filter=".f_free">
            <i class="icon-gift"></i>Free
        </div>
        <div class="spe_fiter_data" data-filter=".f_pro">
            <i class="icon-pro-badge"></i>Pro
        </div>
    </div>

    <div class="spe_filter_content ezd-d-flex" id="features_gallery">
        <div class="ezd-colum-space-4 f_free">
            <div class="spe_element_box spe_element_switch">
                <div class="spe_element_content">
                    <i class="icon-cloud"></i>
                    <label for="spe-elementor-video">Template cloud</label>
                </div>
                <div class="spe_element_right">
                    <div class="spe_link">
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon1.svg; ?>" alt=""></a>
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon2.svg; ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="spe_widget_checkbox" id="spe-elementor-video" checked>
                        <span class="spe_widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 f_free">
            <div class="spe_element_box spe_element_switch">
                <span class="badge">Pro</span>
                <div class="spe_element_content">
                    <i class="icon-mega-menu"></i>
                    <label for="spe-elementor-menu">Mega Menu</label>
                </div>
                <div class="spe_element_right">
                    <div class="spe_link">
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon1.svg; ?>" alt=""></a>
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon2.svg; ?>" alt=""></a>
                    </div>
                    <label class="pro_popup">
                        <input type="checkbox" class="spe_widget_checkbox" id="spe-elementor-menu" disabled>
                        <span class="spe_widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 f_free">
            <div class="spe_element_box spe_element_switch">
                <div class="spe_element_content">
                    <i class="icon-image-shadow"></i>
                    <label for="spe-elementor-video-three">Image Shadow</label>
                </div>
                <div class="spe_element_right">
                    <div class="spe_link">
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon1.svg; ?>" alt=""></a>
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon2.svg; ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="spe_widget_checkbox" id="spe-elementor-video-three" checked>
                        <span class="spe_widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 f_free">
            <div class="spe_element_box spe_element_switch">
                <div class="spe_element_content">
                    <i class="icon-hotspot"></i>
                    <label for="spe-elementor-scroll">Scroll trigger </label>
                </div>
                <div class="spe_element_right">
                    <div class="spe_link">
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon1.svg; ?>" alt=""></a>
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon2.svg; ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="spe_widget_checkbox" id="spe-elementor-scroll" checked>
                        <span class="spe_widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 f_pro">
            <div class="spe_element_box spe_element_switch">
                <div class="spe_element_content">
                    <i class="icon-effect"></i>
                    <label for="spe-elementor-hover">Tilt Effect on Hover</label>
                </div>
                <div class="spe_element_right">
                    <div class="spe_link">
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon1.svg; ?>" alt=""></a>
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon2.svg; ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="spe_widget_checkbox" id="spe-elementor-hover">
                        <span class="spe_widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 f_pro">
            <div class="spe_element_box spe_element_switch">
                <div class="spe_element_content">
                    <i class="icon-revel-animation"></i>
                    <label for="spe-elementor-reveal">Reveal Animation</label>
                </div>
                <div class="spe_element_right">
                    <div class="spe_link">
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon1.svg; ?>" alt=""></a>
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon2.svg; ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="spe_widget_checkbox" id="spe-elementor-reveal">
                        <span class="spe_widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>

        <div class="ezd-colum-space-4 free">
            <div class="spe_element_box spe_element_switch">
                <div class="spe_element_content">
                    <i class="icon-price"></i>
                    <label for="spe-elementor-table">Pricing Table</label>
                </div>
                <div class="spe_element_right">
                    <div class="spe_link">
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon1.svg; ?>" alt=""></a>
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon2.svg; ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="spe_widget_checkbox" id="spe-elementor-table">
                        <span class="spe_widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 f_pro">
            <div class="spe_element_box spe_element_switch">
                <div class="spe_element_content">
                    <i class="icon-tooltip"></i>
                    <label for="spe-elementor-tooltip">Tooltip / Element </label>
                </div>
                <div class="spe_element_right">
                    <div class="spe_link">
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon1.svg; ?>" alt=""></a>
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon2.svg; ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="spe_widget_checkbox" id="spe-elementor-tooltip">
                        <span class="spe_widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 f_pro">
            <div class="spe_element_box spe_element_switch">
                <div class="spe_element_content">
                    <i class="icon-badge"></i>
                    <label for="spe-elementor-badge">Badge</label>
                </div>
                <div class="spe_element_right">
                    <div class="spe_link">
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon1.svg; ?>" alt=""></a>
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon2.svg; ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="spe_widget_checkbox" id="spe-elementor-badge">
                        <span class="spe_widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 f_pro">
            <div class="spe_element_box spe_element_switch">
                <div class="spe_element_content">
                    <i class="icon-smooth-animation"></i>
                    <label for="spe-elementor-smooth">Smooth Animation</label>
                </div>
                <div class="spe_element_right">
                    <div class="spe_link">
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon1.svg; ?>" alt=""></a>
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon2.svg; ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="spe_widget_checkbox" id="spe-elementor-smooth" checked>
                        <span class="spe_widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="ezd-colum-space-4 f_pro">
            <div class="spe_element_box spe_element_switch">
                <div class="spe_element_content">
                    <i class="icon-gallery"></i>
                    <label for="spe-elementor-gradient">Create gradient color from image</label>
                </div>
                <div class="spe_element_right">
                    <div class="spe_link">
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon1.svg; ?>" alt=""></a>
                        <a href="#"><img src="<?php echo SPE_IMG ?>/icon2.svg; ?>" alt=""></a>
                    </div>
                    <label>
                        <input type="checkbox" class="spe_widget_checkbox" id="spe-elementor-gradient">
                        <span class="spe_widget_switcher"></span>
                    </label>
                </div>
            </div>
        </div>
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