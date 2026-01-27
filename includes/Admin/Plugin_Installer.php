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
    private $activated_plugins = [];
    private $initialized = false;

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
        // If this class is instantiated after `plugins_loaded` has already fired,
        // the hook would never run and status checks would always report
        // "not_installed". So we initialize immediately when possible.
        if ( \did_action( 'plugins_loaded' ) ) {
            $this->init();
        } else {
            \add_action( 'plugins_loaded', [ $this, 'init' ] );
        }
    }

    /**
     * Initializes the class
     */
    public function init(): void
    {
        $this->collect_activated_plugins();

        $this->initialized = true;
    }

    /**
     * Collects the list of activated plugins
     */
    private function collect_activated_plugins(): void
    {
        $this->activated_plugins = \get_option( 'active_plugins', [] );
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
        if ( $this->check_activated_plugin( $name ) ) {
            return true;
        }

        // Security: Prevent path traversal
        if ( 0 !== validate_file( $name ) ) {
            return false;
        }

        // Sentinel Fix: Use file check instead of heavy get_plugins() scan
        return file_exists( WP_PLUGIN_DIR . '/' . $name );
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
        return in_array( $name, $this->activated_plugins, true );
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
        if ( ! $this->initialized ) {
            $this->init();
        }

        $data = [
            'url' => '',
            'activation_url' => '',
            'installation_url' => '',
            'title' => '',
            'status' => '',
        ];

        if ($this->check_installed_plugin($name)) {
            if ($this->check_activated_plugin($name)) {
                $data['title'] = \esc_html__( 'Activated', 'spider-elements' );
                $data['status'] = 'activated';
            } else {
                $data['title'] = \esc_html__( 'Activate', 'spider-elements' );
                $data['status'] = 'inactive';
                $data['activation_url'] = $this->activation_url($name);
            }
        } else {
            $data['title'] = \esc_html__( 'Install Now', 'spider-elements' );
            $data['status'] = 'not_installed';
            $data['installation_url'] = $this->installation_url($name);
            $data['activation_url'] = $this->activation_url($name);
        }

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
        return \wp_nonce_url(
            \add_query_arg(
                [
                    'action' => 'activate',
                    'plugin' => $pluginName,
                    'plugin_status' => 'all',
                    'paged' => '1&s',
                ],
                \admin_url( 'plugins.php' )
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

        return \wp_nonce_url(
            \add_query_arg(
                [
                    'action' => $action,
                    'plugin' => $pluginSlug,
                ],
                \admin_url( 'update.php' )
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
