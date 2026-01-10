<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

$current_page = isset( $_GET['page'] ) ? sanitize_text_field( $_GET['page'] ) : 'spider_elements_settings';
$tab_map = array(
    'spider_elements_settings'    => 'welcome',
    'spider_elements_elements'    => 'elements',
    'spider_elements_features'    => 'features',
    'spider_elements_integration' => 'integration',
);
$active_tab = $tab_map[ $current_page ] ?? 'welcome';
?>

<div class="sticky_sidebar">

    <ul class="tab-menu tab_left_content">

        <li>
            <a href="#welcome" class="tab-menu-link <?php echo $active_tab === 'welcome' ? 'active' : ''; ?>" data-content="welcome">
                <div class="tab_menu_contents">
                    <div class="icon">
                        <i class="icon-dashboard"></i>
                    </div>
                    <div class="content">
                        <h3><?php esc_html_e('Dashboard', 'spider-elements'); ?></h3>
                        <p><?php esc_html_e('Find all information', 'spider-elements'); ?></p>
                    </div>
                </div>
            </a>
        </li>

        <li>
            <a href="#elements" class="tab-menu-link <?php echo $active_tab === 'elements' ? 'active' : ''; ?>" data-content="elements">
                <div class="tab_menu_contents">
                    <div class="icon">
                        <i class="icon-element"></i>
                    </div>
                    <div class="content">
                        <h3><?php esc_html_e('Elements', 'spider-elements'); ?></h3>
                        <p><?php esc_html_e('Control All the Widgets', 'spider-elements'); ?></p>
                    </div>
                </div>
            </a>
        </li>

        <li>
            <a href="#features" class="tab-menu-link <?php echo $active_tab === 'features' ? 'active' : ''; ?>" data-content="features">
                <div class="tab_menu_contents">
                    <div class="icon">
                        <i class="icon-feature_two"></i>
                    </div>
                    <div class="content">
                        <h3><?php esc_html_e('Features', 'spider-elements'); ?></h3>
                        <p><?php esc_html_e('Control All Features', 'spider-elements'); ?></p>
                    </div>
                </div>
            </a>
        </li>

        <li>
            <a href="#integration" class="tab-menu-link <?php echo $active_tab === 'integration' ? 'active' : ''; ?>" data-content="integration">
                <div class="tab_menu_contents">
                    <div class="icon">
                        <i class="icon-setting"></i>
                    </div>
                    <div class="content">
                        <h3><?php esc_html_e('Power-up Website', 'spider-elements'); ?></h3>
                        <p><?php esc_html_e('Install Other Plugins', 'spider-elements'); ?></p>
                    </div>
                </div>
            </a>
        </li>

    </ul>
</div>