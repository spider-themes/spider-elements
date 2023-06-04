<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Use namespace to avoid conflict
 */
namespace spiderElements\Admin;

/**
 * Class Assets
 * @package spiderElements\Admin
 */
class Assets
{

	/**
	 * Assets constructor.
	 */
	public function __construct()
	{
		$current_url         = !empty($_GET["page"]) ? admin_url("admin.php?page=" . sanitize_text_field($_GET["page"])) : '';
		$target_url          = admin_url('/admin.php?page=eazydocs');
		$target_one_page_url = admin_url('/admin.php?page=eazydocs-onepage');
		$target_analytics_page_url = admin_url('/admin.php?page=ezd-analytics');

		if ($current_url == $target_url) {
			add_action('admin_enqueue_scripts', [$this, 'eazydocs_dashboard_scripts']);
		} elseif ($current_url == $target_one_page_url) {
			add_action('admin_enqueue_scripts', [$this, 'eazydocs_dashboard_scripts']);
		} elseif ($current_url == $target_analytics_page_url ) {
			add_action('admin_enqueue_scripts', [$this, 'eazydocs_dashboard_scripts']);
		}

		add_action('admin_enqueue_scripts', [$this, 'eazydocs_global_scripts']);
	}

	/**
	 * Register scripts and styles
	 **/
	public function eazydocs_dashboard_scripts() {

	}

	/**
	 * Enqueue global scripts
	 * and styles by EazyDocs pages on WordPress dashboard
	 */
	public function eazydocs_global_scripts() {

	}
}
