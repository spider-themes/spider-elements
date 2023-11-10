<div id="dashboard" class="spe-tab-box active">
    <div class="spe_dashboard_banner">
        <img src="<?php echo SPE_IMG . '/dashboard-img/spe-log.png' ?>" alt="<?php esc_attr_e('Dashboard Banner', 'spider-elements'); ?>">
    </div>
    <div class="ezd-grid ezd-grid-cols-12">
        <div class="ezd-lg-col-3">
            <div class="spe_widget_progress_item ezd-text-center">
                <h3><?php esc_html_e('All Widgets', 'spider-elements'); ?></h3>
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
                <h3><?php esc_html_e('Core', 'spider-elements'); ?></h3>
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
                <h3>Active</h3>
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
    </div>
    <div class="ezd-grid ezd-grid-cols-12">
        <div class="ezd-lg-col-6">
            <div class="spe_support_item">
                <span class="spe_icon icon-documentation"></span>
                <h2 class="spe_dashboard_title"><?php esc_html_e('Documentation', 'spider-elements'); ?></h2>
                <p><?php esc_html_e('Get detailed and guided instruction to level up your website with the necessary set up.', 'spider-elements'); ?></p>
                <a href="#" class="spe_dashboard_btn">
                    <?php esc_html_e('Check Documentation', 'spider-elements'); ?>
                </a>
            </div>
        </div>
        <div class="ezd-lg-col-6">
            <div class="spe_support_item">
                <span class="spe_icon icon-help"></span>
                <h2 class="spe_dashboard_title"><?php esc_html_e('Need Help', 'spider-elements'); ?></h2>
                <p><?php esc_html_e('If you are stuck at anything while using our product, reach out to us immediately', 'spider-elements'); ?></p>
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
                        <li><strong>Memory Limit</strong> <span><i class="icon-check"></i>Currently 8.1.9</span></li>
                        <li><strong>PHP Version</strong> <span><i class="icon-cross"></i>Currently 256M</span></li>
                        <li><strong>Folder writable</strong> <span><i class="icon-check"></i>Currently 8.1.1</span></li>
                        <li><strong>GZip Enabled:</strong> <span><i class="icon-check"></i>Currently 256M</span></li>
                    </ul>

                    <ul class="spe-list-unstyled spe_requirment_list ezd-lg-col-6">
                        <li><strong>Max execution time:</strong> <span><i class="icon-check"></i>Currently 1400</span>
                        </li>
                        <li><strong>Max post limit:</strong> <span><i class="icon-cross"></i>Currently 1000M</span></li>
                        <li><strong>Multisite:</strong> <span><i class="icon-check"></i>Currently 8.1.9</span></li>
                        <li><strong>Debug Mode:</strong> <span><i class="icon-check"></i>Currently 8.1.9</span></li>
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
                <span class="spe_icon icon-features"></span>
                <h2 class="spe_dashboard_title"><?php esc_html_e('Missing Features', 'spider-elements'); ?></h2>
                <p><?php _e('Send us a message if you believe the plugin is<br> lacking any features.', 'spider-elements'); ?></p>
                <a href="#" class="spe_dashboard_btn">
                    <?php esc_html_e('Request Features', 'spider-elements'); ?>
                </a>
            </div>
        </div>
        <div class="ezd-lg-col-6">
            <div class="spe_support_item dashboard_img">
                <img src="<?php echo SPE_IMG . '/dashboard-img/table_work.png' ?>" alt="work">
            </div>
        </div>
        <div class="ezd-lg-col-6">
            <div class="spe_support_item">
                <span class="spe_icon icon-love"></span>
                <h2 class="spe_dashboard_title"><?php esc_html_e('Show Your Love', 'spider-elements'); ?></h2>
                <p><?php _e('Leave your feedback to help us out if you liked<br> our product and customer service.', 'spider-elements'); ?></p>
                <a href="#" class="spe_dashboard_btn">
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