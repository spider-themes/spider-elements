<?php
if ( ! defined( 'ABSPATH' ) )  exit; // Exit if accessed directly

$php_version = phpversion();
$memory_limit = ini_get('memory_limit');
$max_execution_time = ini_get('max_execution_time');
$post_limit = ini_get('post_max_size');
$uploads = wp_upload_dir();
$upload_path = $uploads['basedir'];
$check_icon = '<span class="valid"><i class="icon-check"></i></span>';
$close_icon = '<span class="invalid"><i class="icon-close"></i></span>';
$environment = spel_get_environment_info();
?>
<div id="dashboard" class="spe-tab-box active">

    <div class="spe_dashboard_banner">
        <img src="<?php echo esc_url(SPEL_IMG . '/dashboard-img/spe-log.png') ?>"
            alt="<?php esc_attr_e('Dashboard Banner', 'spider-elements'); ?>">
    </div>

    <!--<div class="ezd-grid ezd-grid-cols-12">
        <div class="ezd-lg-col-3">
            <div class="spe_widget_progress_item ezd-text-center">
                <h3><?php /*esc_html_e('All Widgets', 'spider-elements'); */?></h3>
                <div class="circle_progress">
                    <svg class="radial-progress" data-percentage="85" viewBox="0 0 80 80">
                        <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                        <circle class="complete" cx="40" cy="40" r="35"></circle>
                    </svg>
                    <text class="percentage">85%</text>
                </div>
                <ul class="ezd-list-unstyled progress_info_list">
                    <li>Total : 250</li>
                    <li>Used : 155</li>
                    <li>Unused : 95</li>
                </ul>
            </div>
        </div>
        <div class="ezd-lg-col-3">
            <div class="spe_widget_progress_item ezd-text-center">
                <h3><?php /*esc_html_e('Core', 'spider-elements'); */?></h3>
                <div class="circle_progress">
                    <svg class="radial-progress" data-percentage="65" viewBox="0 0 80 80">
                        <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                        <circle class="complete" cx="40" cy="40" r="35"></circle>
                    </svg>
                    <text class="percentage">65%</text>
                </div>
                <ul class="ezd-list-unstyled progress_info_list">
                    <li>Total : 250</li>
                    <li>Used : 155</li>
                    <li>Unused : 95</li>
                </ul>
            </div>
        </div>
        <div class="ezd-lg-col-3">
            <div class="spe_widget_progress_item ezd-text-center">
                <h3>3rd Party</h3>
                <div class="circle_progress">
                    <svg class="radial-progress" data-percentage="62" viewBox="0 0 80 80">
                        <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                        <circle class="complete" cx="40" cy="40" r="35"></circle>

                    </svg>
                    <text class="percentage">62%</text>
                </div>
                <ul class="ezd-list-unstyled progress_info_list">
                    <li>Total : 250</li>
                    <li>Used : 155</li>
                    <li>Unused : 95</li>
                </ul>
            </div>
        </div>
        <div class="ezd-lg-col-3">
            <div class="spe_widget_progress_item ezd-text-center">
                <h3><?php /*esc_html_e('Active', 'spider-elements'); */?></h3>
                <div class="circle_progress">
                    <svg class="radial-progress" data-percentage="65" viewBox="0 0 80 80">
                        <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                        <circle class="complete" cx="40" cy="40" r="35"></circle>
                    </svg>
                    <text class="percentage">65%</text>
                </div>
                <ul class="ezd-list-unstyled progress_info_list">
                    <li>Total : 250</li>
                    <li>Used : 155</li>
                    <li>Unused : 95</li>
                </ul>
            </div>
        </div>
    </div>-->

    <div class="ezd-grid ezd-grid-cols-12">
        <div class="ezd-lg-col-6">
            <div class="spe_support_item">
                <span class="spe_icon icon-documentation"></span>
                <h2 class="spe_dashboard_title"><?php esc_html_e('Documentation', 'spider-elements'); ?></h2>
                <p><?php esc_html_e('Get detailed and guided instruction to level up your website with the necessary set up.', 'spider-elements'); ?></p>
                <a href="https://helpdesk.spider-themes.net/docs/spider-elements" class="spe_dashboard_btn" target="_blank">
                    <?php esc_html_e('Check Documentation', 'spider-elements'); ?>
                </a>
            </div>
        </div>
        <div class="ezd-lg-col-6">
            <div class="spe_support_item">
                <span class="spe_icon icon-help"></span>
                <h2 class="spe_dashboard_title"><?php esc_html_e('Need Help', 'spider-elements'); ?></h2>
                <p><?php esc_html_e('If you are stuck at anything while using our product, reach out to us immediately', 'spider-elements'); ?>
                </p>
                <a href="#" class="spe_dashboard_btn">
                    <?php esc_html_e('Support Ticket', 'spider-elements'); ?>
                </a>
            </div>
        </div>
    </div>

    <div class="ezd-grid ezd-grid-cols-12">
        <div class="ezd-lg-col-12">
            <div class="spe_support_item">
                <h2 class="spe_dashboard_title"><?php esc_html_e('System Requirement', 'spider-elements'); ?></h2>
                <div class="ezd-grid ezd-grid-cols-12">

                    <ul class="spe-list-unstyled spe_requirment_list ezd-lg-col-6">

                        <li>
                            <strong><?php esc_html_e('PHP Version:', 'spider-elements'); ?></strong>
                            <?php
                            if ( version_compare($php_version, '7.4', '<' ) ) {
                                echo '<span title="Minimum: 7.4 Recommended">'.$close_icon.'Currently ' . $php_version . '</span>';
                            } else {
                                echo '<span>'.$check_icon.'Currently ' . $php_version . '</span>';
                            }
                            ?>
                        </li>
                        <li><strong><?php esc_html_e('Memory Limit:', 'spider-elements'); ?></strong>
                            <?php
                            if ( intval($memory_limit) < 512  ) {
                                echo '<span title="Minimum 512M Recommended">'.$close_icon.'Currently ' . $memory_limit . '</span>';
                            } else {
                                echo '<span>'.$check_icon.'Currently ' . $memory_limit . '</span>';
                            }
                            ?>
                        </li>
                        <li><strong><?php esc_html_e('Uploads Folder Writable:', 'spider-elements'); ?></strong>
                            <?php
                            if (!is_writable($upload_path)) {
                                echo $close_icon;
                            } else {
                                echo $check_icon;
                            }
                            ?>
                        </li>
                        <li><strong><?php esc_html_e('GZip Enabled:', 'spider-elements'); ?></strong>
                            <?php
                            if ($environment[ 'gzip_enabled' ]) {
                                echo $check_icon;
                            } else {
                                echo $close_icon;
                            }
                            ?>
                        </li>
                    </ul>

                    <ul class="spe-list-unstyled spe_requirment_list ezd-lg-col-6">
                        <li>
                            <strong><?php esc_html_e('Max Execution Time:', 'spider-elements'); ?></strong>
                            <?php
                            if ( intval($max_execution_time) < 90 ) {
                                echo '<span title="Minimum 90 Recommended">'.$close_icon.'Currently ' . $max_execution_time . '</span>';
                            } else {
                                echo '<span>'.$check_icon.'Currently ' . $max_execution_time . '</span>';
                            }
                            ?>
                        </li>
                        <li><strong><?php esc_html_e('Max Post Limit:', 'spider-elements'); ?></strong>
                            <?php
                            if ( intval($post_limit) < 32 ) {
                                echo '<span title="Minimum 32M Recommended">'.$close_icon.'Currently ' . $post_limit . '</span>';
                            } else {
                                echo '<span>'.$check_icon .'Currently ' . $post_limit . '</span>';
                            }
                            ?>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Multisite:', 'spider-elements'); ?></strong>
                            <?php
                            if ( $environment['wp_multisite'] ) {
                                echo '<span>'.$check_icon.'Multisite</span>';
                            } else {
                                echo '<span>'.$close_icon.'No Multisite</span>';
                            }
                            ?>
                        </li>
                        <li>
                            <strong><?php esc_html_e('Debug Mode:', 'spider-elements'); ?></strong>
                            <?php
                            if ($environment[ 'wp_debug_mode' ]) {
                                echo '<span>'.$check_icon.'Currently Turned On</span>';
                            } else {
                                echo '<span>'.$close_icon.'Currently Turned Off</span>';
                            }
                            ?>
                        </li>
                    </ul>
                </div>

                <div class="note">
                    <p><?php _e('Note: If you have multiple addons like <strong>Spider Elements</strong> so you need some more requirement some cases
                        so make sure you added more memory for others addon too.', 'spider-elements'); ?></p>
                </div>

            </div>
        </div>
    </div>


    <div class="ezd-grid ezd-grid-cols-12">

        <div class="ezd-lg-col-6">
            <div class="spe_support_item">
                <span class="spe_icon icon-love"></span>
                <h2 class="spe_dashboard_title"><?php esc_html_e('Show Your Love', 'spider-elements'); ?></h2>
                <p><?php _e('Leave your feedback to help us out if you liked<br> our product and customer service.', 'spider-elements'); ?></p>
                <a href="https://wordpress.org/support/plugin/spider-elements/reviews/#new-post" class="spe_dashboard_btn">
                    <?php esc_html_e('Check Documentation', 'spider-elements'); ?>
                </a>
            </div>
        </div>
        <div class="ezd-lg-col-6">
            <div class="spe_support_item">
                <span class="spe_icon icon-debug"></span>
                <h2 class="spe_dashboard_title"><?php esc_html_e('Facing an issues?', 'spider-elements'); ?></h2>
                <p><?php _e('You think there is a bug in the product? Inform<br> us please!', 'spider-elements'); ?></p>
                <a href="#" class="spe_dashboard_btn">
                    <?php esc_html_e('Support Ticket', 'spider-elements'); ?>
                </a>
            </div>
        </div>
    </div>
</div>