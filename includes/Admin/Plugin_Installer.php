<?php

namespace SPEL\includes\Admin;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Class Plugin_Installer
 */
class Plugin_Installer
{
    private static $instance;
    private $installed_plugins = [];
    private $activated_plugins = [];

    /**
     * Get the single instance of the class
     *
     * @return Plugin_Installer Singleton instance of the class
     */
    public static function instance()
    {
        if (!static::$instance) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     * Constructor
     * Initializes the class and collects installed and activated plugins
     */
    public function __construct()
    {
        add_action('plugins_loaded', [$this, 'init']);
    }

    /**
     * Initializes the class
     */
    public function init()
    {
        $this->collect_installed_plugins();
        $this->collect_activated_plugins();

        // Debugging statements
        error_log('Installed Plugins: ' . print_r($this->installed_plugins, true));
        error_log('Activated Plugins: ' . print_r($this->activated_plugins, true));
    }

    /**
     * Collects the list of installed plugins
     */
    private function collect_installed_plugins()
    {
        if (!function_exists('get_plugins')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        $this->installed_plugins = array_keys(get_plugins());

        // Debugging statement
        error_log('Collecting Installed Plugins: ' . print_r($this->installed_plugins, true));
    }

    /**
     * Collects the list of activated plugins
     */
    private function collect_activated_plugins()
    {
        $this->activated_plugins = get_option('active_plugins', []);

        // Debugging statement
        error_log('Collecting Activated Plugins: ' . print_r($this->activated_plugins, true));
    }

    /**
     * Check if a plugin is installed
     *
     * @param string $name Plugin name
     *
     * @return bool True if the plugin is installed, false otherwise
     */
    public function check_installed_plugin(string $name): bool
    {
        return in_array($name, $this->installed_plugins);
    }

    /**
     * Check if a plugin is activated
     *
     * @param string $name Plugin name
     *
     * @return bool True if the plugin is activated, false otherwise
     */
    public function check_activated_plugin(string $name): bool
    {
        return in_array($name, $this->activated_plugins);
    }

    /**
     * Get the status information for a plugin
     *
     * @param string $name Plugin name
     *
     * @return array Plugin status information
     */
    public function get_status(string $name): array
    {
        $data = array(
            'url' => '',
            'activation_url' => '',
            'installation_url' => '',
            'title' => '',
            'status' => '',
        );

        if ($this->check_installed_plugin($name)) {
            if ($this->check_activated_plugin($name)) {
                $data['title'] = esc_html__('Activated', 'spider-elements');
                $data['status'] = 'activated';
            } else {
                $data['title'] = esc_html__('Activate Now', 'spider-elements');
                $data['status'] = 'installed';
                $data['activation_url'] = $this->activation_url($name);
            }
        } else {
            $data['title'] = esc_html__('Install Now', 'spider-elements');
            $data['status'] = 'not_installed';
            $data['installation_url'] = $this->installation_url($name);
            $data['activation_url'] = $this->activation_url($name);
        }

        // Debug output
        error_log("Plugin: $name");
        error_log(print_r($data, true));

        return $data;
    }

    /**
     * Get the activation URL for a plugin
     *
     * @param string $pluginName Plugin name
     *
     * @return string Activation URL
     */
    public function activation_url(string $pluginName): string
    {
        return wp_nonce_url(
            add_query_arg(
                array(
                    'action' => 'activate',
                    'plugin' => $pluginName,
                    'plugin_status' => 'all',
                    'paged' => '1&s',
                ),
                admin_url('plugins.php')
            ),
            'activate-plugin_' . $pluginName
        );
    }

    /**
     * Get the installation URL for a plugin
     *
     * @param string $pluginName Plugin name
     *
     * @return string Installation URL
     */
    public function installation_url(string $pluginName): string
    {
        $action = 'install-plugin';
        $pluginSlug = $this->get_plugin_slug($pluginName);

        return wp_nonce_url(
            add_query_arg(
                array(
                    'action' => $action,
                    'plugin' => $pluginSlug,
                ),
                admin_url('update.php')
            ),
            $action . '_' . $pluginSlug
        );
    }

    /**
     * Get the plugin slug from a plugin name
     *
     * @param string $name Plugin name
     *
     * @return string Plugin slug
     */
    public function get_plugin_slug(string $name): string
    {
        $split = explode('/', $name);

        return $split[0] ?? '';
    }
}