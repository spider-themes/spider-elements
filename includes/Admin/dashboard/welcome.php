<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use SPEL\includes\Admin\Module_Settings;

$php_version        = phpversion();
$memory_limit       = ini_get( 'memory_limit' );
$max_execution_time = ini_get( 'max_execution_time' );
$post_limit         = ini_get( 'post_max_size' );
$uploads            = wp_upload_dir();
$upload_path        = $uploads['basedir'];
$check_icon         = '<span class="valid"><i class="icon-check"></i></span>';
$close_icon         = '<span class="invalid"><i class="icon-close"></i></span>';
$environment        = spel_get_environment_info();

// Get widget and feature stats
$widget_settings = Module_Settings::get_widget_settings();
$widget_opt      = get_option( 'spe_widget_settings' );
$feature_opt     = get_option( 'spel_features_settings' );

// Count active widgets and features
$total_widgets  = isset( $widget_settings['spider_elements_widgets'] ) ? count( $widget_settings['spider_elements_widgets'] ) : 0;
$total_features = isset( $widget_settings['spider_elements_features'] ) ? count( $widget_settings['spider_elements_features'] ) : 0;

$active_widgets = 0;
if ( isset( $widget_settings['spider_elements_widgets'] ) ) {
	foreach ( $widget_settings['spider_elements_widgets'] as $widget ) {
		$widget_name = $widget['name'] ?? '';
		if ( ! isset( $widget_opt[ $widget_name ] ) || $widget_opt[ $widget_name ] === 'on' ) {
			if ( $widget['widget_type'] !== 'pro' || spel_is_premium() ) {
				++$active_widgets;
			}
		}
	}
}

$active_features = 0;
if ( isset( $widget_settings['spider_elements_features'] ) ) {
	foreach ( $widget_settings['spider_elements_features'] as $feature ) {
		$feature_name = $feature['name'] ?? '';
		if ( ! isset( $feature_opt[ $feature_name ] ) || $feature_opt[ $feature_name ] === 'on' ) {
			if ( $feature['feature_type'] !== 'pro' || spel_is_premium() ) {
				++$active_features;
			}
		}
	}
}

// Count pro widgets
$pro_widgets = 0;
if ( isset( $widget_settings['spider_elements_widgets'] ) ) {
	foreach ( $widget_settings['spider_elements_widgets'] as $widget ) {
		if ( $widget['widget_type'] === 'pro' ) {
			++$pro_widgets;
		}
	}
}

$free_widgets = $total_widgets - $pro_widgets;
?>
<div id="welcome" class="tab-box active">

	<!-- Enhanced Dashboard Banner -->
	<div class="dashboard_banner">
		<div class="banner_content">
			<span class="version_badge">
				<i class="icon-star"></i>
				<?php echo esc_html( sprintf( __( 'Version %s', 'spider-elements' ), SPEL_VERSION ) ); ?>
			</span>
			<h2><?php esc_html_e( 'Welcome to Spider Elements', 'spider-elements' ); ?></h2>
			<p><?php esc_html_e( 'The ultimate Elementor addon bundle packed with powerful widgets and features to create stunning websites effortlessly.', 'spider-elements' ); ?></p>
		</div>
		<img src="<?php echo esc_url( SPEL_IMG . '/dashboard/logo.png' ); ?>" alt="<?php esc_attr_e( 'Spider Elements Logo', 'spider-elements' ); ?>">
	</div>

	<!-- Quick Stats Section -->
	<div class="quick_stats">
		<div class="stat_card stat_elements">
			<div class="stat_header">
				<span class="stat_icon">
					<i class="icon-element"></i>
				</span>
				<span class="stat_trend trend_info">
					<i class="icon-star"></i> <?php esc_html_e( 'Widgets', 'spider-elements' ); ?>
				</span>
			</div>
			<div class="stat_value"><?php echo esc_html( $total_widgets ); ?></div>
			<div class="stat_label"><?php esc_html_e( 'Total Widgets Available', 'spider-elements' ); ?></div>
		</div>

		<div class="stat_card stat_active">
			<div class="stat_header">
				<span class="stat_icon">
					<i class="icon-check"></i>
				</span>
				<span class="stat_trend trend_up">
					<i class="icon-star"></i> <?php esc_html_e( 'Active', 'spider-elements' ); ?>
				</span>
			</div>
			<div class="stat_value"><?php echo esc_html( $active_widgets ); ?></div>
			<div class="stat_label"><?php esc_html_e( 'Active Widgets', 'spider-elements' ); ?></div>
		</div>

		<div class="stat_card stat_features">
			<div class="stat_header">
				<span class="stat_icon">
					<i class="icon-feature_two"></i>
				</span>
				<span class="stat_trend trend_info">
					<i class="icon-star"></i> <?php esc_html_e( 'Features', 'spider-elements' ); ?>
				</span>
			</div>
			<div class="stat_value"><?php echo esc_html( $total_features ); ?></div>
			<div class="stat_label"><?php esc_html_e( 'Total Features', 'spider-elements' ); ?></div>
		</div>

		<div class="stat_card stat_pro">
			<div class="stat_header">
				<span class="stat_icon">
					<i class="icon-premium"></i>
				</span>
				<span class="stat_trend trend_info">
					<i class="icon-diamond"></i> <?php esc_html_e( 'Pro', 'spider-elements' ); ?>
				</span>
			</div>
			<div class="stat_value"><?php echo esc_html( $pro_widgets ); ?></div>
			<div class="stat_label"><?php esc_html_e( 'Pro Widgets', 'spider-elements' ); ?></div>
		</div>
	</div>

	<!-- System Requirement Section -->
	<div class="ezd-grid ezd-grid-cols-12">
		<div class="ezd-lg-col-12">
			<div class="support_item">
				<div class="section_header has_flex">
					<h2 class="dashboard_title"><?php esc_html_e( 'System Requirements', 'spider-elements' ); ?></h2>
					<span class="requirement_status badge_success">
						<i class="icon-check"></i>
						<?php esc_html_e( 'All Good', 'spider-elements' ); ?>
					</span>
				</div>
				<div class="ezd-grid ezd-grid-cols-12">

					<ul class="list-unstyled requirement_list ezd-lg-col-6">
						<li>
							<strong><?php esc_html_e( 'PHP Version:', 'spider-elements' ); ?></strong>
							<?php
							if ( version_compare( $php_version, '7.4', '<' ) ) {
								echo '<span title="' . esc_attr__( 'Minimum: 7.4 Recommended', 'spider-elements' ) . '">'
									. wp_kses_post( $close_icon ) . esc_html__( 'Currently:', 'spider-elements' ) . ' ' . esc_html( $php_version ) . '</span>';
							} else {
								echo '<span>' . wp_kses_post( $check_icon ) . esc_html__( 'Currently:', 'spider-elements' ) . ' ' . esc_html( $php_version ) . '</span>';
							}
							?>
						</li>
						<li>
							<strong><?php esc_html_e( 'Memory Limit:', 'spider-elements' ); ?></strong>
							<?php
							if ( intval( $memory_limit ) < 512 ) {
								echo '<span title="' . esc_attr__( 'Minimum 512M Recommended', 'spider-elements' ) . '">'
									. wp_kses_post( $close_icon ) . esc_html__( 'Currently:', 'spider-elements' ) . ' ' . esc_html( $memory_limit ) . '</span>';
							} else {
								echo '<span>' . wp_kses_post( $check_icon ) . esc_html__( 'Currently:', 'spider-elements' ) . ' ' . esc_html( $memory_limit ) . '</span>';
							}
							?>
						</li>
						<li>
							<strong><?php esc_html_e( 'Uploads Folder Writable:', 'spider-elements' ); ?></strong>
							<?php
							if ( ! is_writable( $upload_path ) ) {
								echo wp_kses_post( $close_icon );
							} else {
								echo wp_kses_post( $check_icon );
							}
							?>
						</li>
						<li>
							<strong><?php esc_html_e( 'GZip Enabled:', 'spider-elements' ); ?></strong>
							<?php
							if ( $environment['gzip_enabled'] ) {
								echo wp_kses_post( $check_icon );
							} else {
								echo wp_kses_post( $close_icon );
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
									. wp_kses_post( $close_icon ) . esc_html__( 'Currently:', 'spider-elements' ) . ' ' . esc_html( $max_execution_time ) . '</span>';
							} else {
								echo '<span>' . wp_kses_post( $check_icon ) . esc_html__( 'Currently:', 'spider-elements' ) . ' ' . esc_html( $max_execution_time ) . '</span>';
							}
							?>
						</li>
						<li>
							<strong><?php esc_html_e( 'Max Post Limit:', 'spider-elements' ); ?></strong>
							<?php
							if ( intval( $post_limit ) < 32 ) {
								echo '<span title="' . esc_attr__( 'Minimum 32M Recommended', 'spider-elements' ) . '">'
									. wp_kses_post( $close_icon ) . esc_html__( 'Currently:', 'spider-elements' ) . ' ' . esc_html( $post_limit ) . '</span>';
							} else {
								echo '<span>' . wp_kses_post( $check_icon ) . esc_html__( 'Currently:', 'spider-elements' ) . ' ' . esc_html( $post_limit ) . '</span>';
							}
							?>
						</li>
						<li>
							<strong><?php esc_html_e( 'Multisite:', 'spider-elements' ); ?></strong>
							<?php
							if ( $environment['wp_multisite'] ) {
								echo '<span>' . wp_kses_post( $check_icon ) . esc_html__( 'Multisite', 'spider-elements' ) . '</span>';
							} else {
								echo '<span>' . wp_kses_post( $close_icon ) . esc_html__( 'No Multisite', 'spider-elements' ) . '</span>';
							}
							?>
						</li>
						<li>
							<strong><?php esc_html_e( 'Debug Mode:', 'spider-elements' ); ?></strong>
							<?php
							if ( $environment['wp_debug_mode'] ) {
								echo '<span>' . wp_kses_post( $check_icon ) . esc_html__( 'Currently Turned On', 'spider-elements' ) . '</span>';
							} else {
								echo '<span>' . wp_kses_post( $close_icon ) . esc_html__( 'Currently Turned Off', 'spider-elements' ) . '</span>';
							}
							?>
						</li>
					</ul>
				</div>

				<div class="note">
					<i class="dashicons dashicons-info-outline"></i>
					<p>
						<?php
						printf(
							/* translators: %1$s and %2$s are opening and closing strong HTML tags. */
							esc_html__(
								'Note: If you have multiple addons like %1$s Spider Elements %2$s, you may need more resources. Ensure you allocate more memory for other addons as well.',
								'spider-elements'
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

	<!-- Quick Links Section -->
	<div class="ezd-grid ezd-grid-cols-12 quick_links_grid">
		<div class="ezd-lg-col-6">
			<div class="support_item">
				<span class="icon icon-documentation"></span>
				<h2 class="dashboard_title"><?php esc_html_e( 'Documentation', 'spider-elements' ); ?></h2>
				<p><?php esc_html_e( 'Get detailed and guided instruction to level up your website with the necessary set up.', 'spider-elements' ); ?></p>
				<a href="https://helpdesk.spider-themes.net/docs/spider-elements" class="dashboard_btn" target="_blank">
					<i class="icon-document"></i>
					<?php esc_html_e( 'Read Documentation', 'spider-elements' ); ?>
				</a>
			</div>
		</div>
		<div class="ezd-lg-col-6">
			<div class="support_item">
				<span class="icon icon-help"></span>
				<h2 class="dashboard_title"><?php esc_html_e( 'Need Help?', 'spider-elements' ); ?></h2>
				<p><?php esc_html_e( 'If you are stuck at anything while using our product, reach out to us immediately!', 'spider-elements' ); ?></p>
				<a href="https://wordpress.org/support/plugin/spider-elements/" class="dashboard_btn" target="_blank">
					<i class="icon-bubble"></i>
					<?php esc_html_e( 'Get Priority Support', 'spider-elements' ); ?>
				</a>
			</div>
		</div>
		<div class="ezd-lg-col-6">
			<div class="support_item">
				<span class="icon icon-love"></span>
				<h2 class="dashboard_title"><?php esc_html_e( 'Love Spider Elements?', 'spider-elements' ); ?></h2>
				<p><?php echo esc_html__( 'Leave your feedback to help us out if you liked our product and customer service.', 'spider-elements' ); ?></p>
				<a href="https://wordpress.org/support/plugin/spider-elements/reviews/#new-post" class="dashboard_btn" target="_blank">
					<i class="icon-star"></i>
					<?php esc_html_e( 'Leave a Review', 'spider-elements' ); ?>
				</a>
			</div>
		</div>
		<div class="ezd-lg-col-6">
			<div class="support_item">
				<span class="icon icon-debug"></span>
				<h2 class="dashboard_title"> <?php esc_html_e( 'Found a Bug?', 'spider-elements' ); ?> </h2>
				<p> <?php echo esc_html__( "Think you've spotted a bug? Please let us know! Your feedback helps us make improvements.", 'spider-elements' ); ?> </p>
				<a href="https://github.com/spider-themes/spider-elements/issues/new" class="dashboard_btn" target="_blank">
					<i class="icon-github"></i>
					<?php esc_html_e( 'Report on GitHub', 'spider-elements' ); ?>
				</a>
			</div>
		</div>
	</div>

</div>