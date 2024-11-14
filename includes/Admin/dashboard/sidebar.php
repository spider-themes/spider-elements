<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>

<div class="sticky_sidebar">

    <ul class="tab-menu tab_left_content">

        <li>
            <a href="#dashboard" class="tab-menu-link" data-content="dashboard">
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
            <a href="#elements" class="tab-menu-link" data-content="elements">
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
            <a href="#features" class="tab-menu-link" data-content="features">
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
            <a href="#integration" class="tab-menu-link" data-content="integration">
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