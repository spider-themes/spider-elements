<?php

namespace Spider_Elements\includes\classes;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Class Plugin_Installer
 */
class Plugin_Installer
{

    private static $instance;
    private $installedPlugins = array();
    private $activatedPlugins = array();

    /**
     * Get the single instance of the class
     *
     * @return Plugin_Installer Singleton instance of the class
     */
    public static function instance ()
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
    public function __construct ()
    {
        add_action('plugins_loaded', [ $this, 'init' ]);
    }

    /**
     * Initializes the class
     */
    public function init ()
    {
        $this->collect_installed_plugins();
        $this->collect_activated_plugins();
    }

    /**
     * Collects the list of installed plugins
     */
    private function collect_installed_plugins ()
    {

        if (!function_exists('get_plugins')) {
            foreach ( get_plugins() as $key => $plugin ) {
                array_push($this->installedPlugins, $key);
            }
        }
    }

    /**
     * Collects the list of activated plugins
     */
    private function collect_activated_plugins ()
    {
        foreach ( apply_filters('active_plugins', get_option('active_plugins')) as $plugin ) {
            array_push($this->activatedPlugins, $plugin);
        }
    }

    /**
     * Get the status information for a plugin
     *
     * @param string $name Plugin name
     *
     * @return array Plugin status information
     */
    public function get_status ($name)
    {
        $data = array(
            'url' => '',
            'activation_url' => '',
            'installation_url' => '',
        );

        if ($this->check_installed_plugin($name)) {
            if ($this->check_activated_plugin($name)) {
                $data[ 'title' ] = __('Activated', 'elementskit-lite');
                $data[ 'status' ] = 'activated';
            } else {
                $data[ 'title' ] = __('Activate Now', 'elementskit-lite');
                $data[ 'status' ] = 'installed';
                $data[ 'activation_url' ] = $this->activation_url($name);
            }
        } else {
            $data[ 'title' ] = __('Install Now', 'elementskit-lite');
            $data[ 'status' ] = 'not_installed';
            $data[ 'installation_url' ] = $this->installation_url($name);
            $data[ 'activation_url' ] = $this->activation_url($name);
        }

        return $data;
    }

    /**
     * Check if a plugin is installed
     *
     * @param string $name Plugin name
     *
     * @return bool True if the plugin is installed, false otherwise
     */
    public function check_installed_plugin ($name)
    {
        return in_array($name, $this->installedPlugins);
    }

    /**
     * Check if a plugin is activated
     *
     * @param string $name Plugin name
     *
     * @return bool True if the plugin is activated, false otherwise
     */
    public function check_activated_plugin ($name)
    {
        return in_array($name, $this->activatedPlugins);
    }

    /**
     * Get the activation URL for a plugin
     *
     * @param string $pluginName Plugin name
     *
     * @return string Activation URL
     */
    public function activation_url ($pluginName)
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
    public function installation_url ($pluginName)
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
     * @return string|null Plugin slug
     */
    public function get_plugin_slug ($name)
    {
        $split = explode('/', $name);

        return isset($split[ 0 ]) ? $split[ 0 ] : null;
    }

}