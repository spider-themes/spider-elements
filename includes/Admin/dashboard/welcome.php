<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

$php_version        = phpversion();
$memory_limit       = ini_get( 'memory_limit' );
$max_execution_time = ini_get( 'max_execution_time' );
$post_limit         = ini_get( 'post_max_size' );
$uploads            = wp_upload_dir();
$upload_path        = $uploads['basedir'];
$check_icon         = '<span class="valid"><i class="icon-check"></i></span>';
$close_icon         = '<span class="invalid"><i class="icon-close"></i></span>';
$environment        = spel_get_environment_info();
?>
<div id="welcome" class="tab-box active">

    <div class="dashboard_banner text-center">
        <img src="<?php echo esc_url( SPEL_IMG . '/dashboard/logo.png' ) ?>" alt="<?php esc_attr_e( 'Dashboard Banner', 'spider-elements' ); ?>">
    </div>

    <div class="ezd-grid ezd-grid-cols-12">
        <div class="ezd-lg-col-12">
            <div class="support_item">
                <h2 class="dashboard_title"><?php esc_html_e( 'System Requirement', 'spider-elements' ); ?></h2>
                <div class="ezd-grid ezd-grid-cols-12">

                    <ul class="list-unstyled requirement_list ezd-lg-col-6">
                        <li>
                            <strong><?php esc_html_e( 'PHP Version:', 'spider-elements' ); ?></strong>
							<?php
							if ( version_compare( $php_version, '7.4', '<' ) ) {
								echo '<span title="' . esc_attr__( 'Minimum: 7.4 Recommended', 'spider-elements' ) . '">'
								     . $close_icon . esc_html__( 'Currently:', 'spider-elements' ) . ' ' . esc_html( $php_version ) . '</span>';
							} else {
								echo '<span>' . $check_icon . esc_html__( 'Currently:', 'spider-elements' ) . ' ' . esc_html( $php_version ) . '</span>';
							}
							?>
                        </li>
                        <li>
                            <strong><?php esc_html_e( 'Memory Limit:', 'spider-elements' ); ?></strong>
							<?php
							if ( intval( $memory_limit ) < 512 ) {
								echo '<span title="' . esc_attr__( 'Minimum 512M Recommended', 'spider-elements' ) . '">'
								     . $close_icon . esc_html__( 'Currently:', 'spider-elements' ) . ' ' . esc_html( $memory_limit ) . '</span>';
							} else {
								echo '<span>' . $check_icon . esc_html__( 'Currently:', 'spider-elements' ) . ' ' . esc_html( $memory_limit ) . '</span>';
							}
							?>
                        </li>
                        <li>
                            <strong><?php esc_html_e( 'Uploads Folder Writable:', 'spider-elements' ); ?></strong>
							<?php
							if ( ! is_writable( $upload_path ) ) {
								echo $close_icon;
							} else {
								echo $check_icon;
							}
							?>
                        </li>
                        <li>
                            <strong><?php esc_html_e( 'GZip Enabled:', 'spider-elements' ); ?></strong>
							<?php
							if ( $environment['gzip_enabled'] ) {
								echo $check_icon;
							} else {
								echo $close_icon;
							}
							?>
                        </li>
                    </ul>

                    <ul class="list-unstyled requirement_list ezd-lg-col-6">
                        <li>
                            <strong><?php esc_html_e( 'Max Execution Time:', 'spider-elements' ); ?></strong>
							<?php
							if ( intval( $max_execution_time ) < 90 ) {
								echo '<span title="' . esc_attr__( 'Minimum 90 Recommended', 'spider-elements' ) . '">'
								     . $close_icon . esc_html__( 'Currently:', 'spider-elements' ) . ' ' . esc_html( $max_execution_time ) . '</span>';
							} else {
								echo '<span>' . $check_icon . esc_html__( 'Currently:', 'spider-elements' ) . ' ' . esc_html( $max_execution_time ) . '</span>';
							}
							?>
                        </li>
                        <li>
                            <strong><?php esc_html_e( 'Max Post Limit:', 'spider-elements' ); ?></strong>
							<?php
							if ( intval( $post_limit ) < 32 ) {
								echo '<span title="' . esc_attr__( 'Minimum 32M Recommended', 'spider-elements' ) . '">'
								     . $close_icon . esc_html__( 'Currently:', 'spider-elements' ) . ' ' . esc_html( $post_limit ) . '</span>';
							} else {
								echo '<span>' . $check_icon . esc_html__( 'Currently:', 'spider-elements' ) . ' ' . esc_html( $post_limit ) . '</span>';
							}
							?>
                        </li>
                        <li>
                            <strong><?php esc_html_e( 'Multisite:', 'spider-elements' ); ?></strong>
							<?php
							if ( $environment['wp_multisite'] ) {
								echo '<span>' . $check_icon . esc_html__( 'Multisite', 'spider-elements' ) . '</span>';
							} else {
								echo '<span>' . $close_icon . esc_html__( 'No Multisite', 'spider-elements' ) . '</span>';
							}
							?>
                        </li>
                        <li>
                            <strong><?php esc_html_e( 'Debug Mode:', 'spider-elements' ); ?></strong>
							<?php
							if ( $environment['wp_debug_mode'] ) {
								echo '<span>' . $check_icon . esc_html__( 'Currently Turned On', 'spider-elements' ) . '</span>';
							} else {
								echo '<span>' . $close_icon . esc_html__( 'Currently Turned Off', 'spider-elements' ) . '</span>';
							}
							?>
                        </li>
                    </ul>

                </div>

                <div class="note">
                    <p>
						<?php
						printf(
                            /* translators: %1$s and %2$s are opening and closing strong HTML tags. */
							esc_html__(
								'Note: If you have multiple addons like %1$s Spider Elements %2$s, you may need more resources. Ensure you allocate more memory for other addons as well.', 'spider-elements'
							),
							'<strong>',
							'</strong>'
						);
						?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="ezd-grid ezd-grid-cols-12">
        <div class="ezd-lg-col-6">
            <div class="support_item">
                <span class="icon icon-documentation"></span>
                <h2 class="dashboard_title"><?php esc_html_e( 'Documentation', 'spider-elements' ); ?></h2>
                <p><?php esc_html_e( 'Get detailed and guided instruction to level up your website with the necessary set up.', 'spider-elements' ); ?></p>
                <a href="https://helpdesk.spider-themes.net/docs/spider-elements" class="dashboard_btn" target="_blank">
					<?php esc_html_e( 'Read Documentation', 'spider-elements' ); ?>
                </a>
            </div>
        </div>
        <div class="ezd-lg-col-6">
            <div class="support_item">
                <span class="icon icon-help"></span>
                <h2 class="dashboard_title"><?php esc_html_e( 'Need Help', 'spider-elements' ); ?></h2>
                <p><?php esc_html_e( 'If you are stuck at anything while using our product, reach out to us immediately', 'spider-elements' ); ?>
                </p>
                <a href="https://wordpress.org/support/plugin/spider-elements/" class="dashboard_btn" target="_blank">
					<?php esc_html_e( 'Support Ticket', 'spider-elements' ); ?>
                </a>
            </div>
        </div>
    </div>


    <div class="ezd-grid ezd-grid-cols-12">

        <div class="ezd-lg-col-6">
            <div class="support_item">
                <span class="icon icon-love"></span>
                <h2 class="dashboard_title"><?php esc_html_e( 'Show Your Love', 'spider-elements' ); ?></h2>
                <p><?php echo esc_html__( 'Leave your feedback to help us out if you liked our product and customer service.', 'spider-elements' ); ?></p>
                <a href="https://wordpress.org/support/plugin/spider-elements/reviews/#new-post" class="dashboard_btn" target="_blank">
					<?php esc_html_e( 'Leave a Review', 'spider-elements' ); ?>
                </a>
            </div>
        </div>
        <div class="ezd-lg-col-6">
            <div class="support_item">
                <span class="icon icon-debug"></span>
                <h2 class="dashboard_title"> <?php esc_html_e( 'Facing an issues?', 'spider-elements' ); ?> </h2>
                <p> <?php echo esc_html__( "Think you've spotted a bug? Please let us know! Your feedback helps us make improvements.", "spider-elements" ); ?> </p>
                <a href="https://github.com/spider-themes/spider-elements/issues/new" class="dashboard_btn" target="_blank">
					<?php esc_html_e( 'Get Help Now', 'spider-elements' ); ?>
                </a>
            </div>
        </div>
    </div>

</div>