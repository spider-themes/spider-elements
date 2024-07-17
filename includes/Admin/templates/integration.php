<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$integrations = [
    [
        'slug' => 'advanced-accordion-block',
        'basename' => 'advanced-accordion-block/advanced-accordion-block.php',
        'logo' => SPEL_IMG . '/dashboard-img/accordion.png',
        'title' => __('Advanced Accordion Gutenberg Block', 'spider-elements'),
        'desc' => __('Advanced Accordion Block is a custom Gutenberg Block that allows to showcase the content in accordion mode. It also helps to build FAQ sections easily.', 'spider-elements'),
    ],
    [
        'slug' => 'bbp-core',
        'basename' => 'bbp-core/bbp-core.php',
        'logo' => SPEL_IMG . '/dashboard-img/bbp-core.png',
        'title' => __('BBP Core', 'spider-elements'),
        'desc' => __('Expand bbPress powered forums with useful features like - private reply, solved topics ...', 'spider-elements'),
    ],
    [
        'slug' => 'eazydocs',
        'basename' => 'eazydocs/eazydocs.php',
        'logo' => SPEL_IMG . '/dashboard-img/eazydocs-logo.png',
        'title' => __('EazyDocs', 'spider-elements'),
        'desc' => __('A powerful & beautiful documentation, knowledge base builder plugin.', 'spider-elements'),
    ],
    [
        'slug' => 'spotlight-search',
        'basename' => 'spotlight-search/spotlight-search.php',
        'logo' => SPEL_IMG . '/dashboard-img/spotlight-search.png',
        'title' => __('Spotlight Search', 'spider-elements'),
        'desc' => __('Easily embed beautiful Instagram feeds on your WordPress site.', 'spider-elements'),
    ],
];
?>

<div id="integration" class="spe-tab-box">
    <div class="spe_dashboard_banner integration_banner">
        <h2><?php esc_html_e('Integration Our other plugins', 'spider-elements'); ?></h2>
        <p><?php _e('We are excited to announce that we have added new Widgets, Template Kits, and other Elementor<br> features to enhance your website building experience. Stay tuned for the weekly updates!', 'spider-elements'); ?></p>
    </div>
    <div class="ezd-grid ezd-grid-cols-12">
        <?php
        if (isset($integrations) && is_array($integrations)) {
            foreach ($integrations as $plugin) {
                $plugin_status = SPEL\includes\Admin\Plugin_Installer::instance();
                $plugin_data = $plugin_status->get_status($plugin['basename']);

                $plugin_status = $plugin_data['status'] ?? '';
                $plugin_activation_url = $plugin_data['activation_url'] ?? '';
                $plugin_installation_url = $plugin_data['installation_url'] ?? '';
                $plugin_status_label = isset($plugin_data['status']) ? ($plugin_data['status'] == 'activated' ? 'activated' : '') : '';
                $plugin_status_title = $plugin_data['title'] ?? esc_html__('Activate', 'spider-elements');
                ?>
                <div class="ezd-lg-col-4">
                    <div class="spe_element_box spe_integration_item ezd-text-center">
                        <img src="<?php echo esc_url($plugin['logo']); ?>" alt="<?php echo esc_attr($plugin['title']); ?>">
                        <h3><?php echo esc_html($plugin['title']); ?></h3>
                        <p><?php echo esc_html($plugin['desc']); ?></p>

                        <?php
                        echo sprintf(
                            '<a data-plugin_status="%1$s" data-activation_url="%2$s" href="%3$s" class="spe_dashboard_btn %4$s">%5$s</a>',
                            esc_attr($plugin_status),
                            esc_url($plugin_activation_url),
                            esc_url($plugin_status === 'not_installed' ? $plugin_installation_url : $plugin_activation_url),
                            esc_attr($plugin_status_label),
                            esc_html($plugin_status_title)
                        );
                        ?>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.spe_dashboard_btn').on('click', function(e) {
            e.preventDefault();
            var $this = $(this);
            var href = $this.attr('href');
            var status = $this.data('plugin_status');

            if (status === 'not_installed') {
                // Install plugin
                $.get(href, function() {
                    // After installation, activate plugin
                    $.get($this.data('activation_url'), function() {
                        // Update button status
                        $this.attr('href', '#');
                        $this.html('Activated');
                        $this.removeClass().addClass('spe_dashboard_btn active_btn');
                        $this.data('plugin_status', 'activated');
                        // Refresh the page to reflect the changes
                        location.reload();
                    });
                });
            } else if (status === 'installed') {
                // Activate plugin
                $.get(href, function() {
                    // Update button status
                    $this.attr('href', '#');
                    $this.html('Activated');
                    $this.removeClass().addClass('spe_dashboard_btn active_btn');
                    $this.data('plugin_status', 'activated');
                    // Refresh the page to reflect the changes
                    location.reload();
                });
            }
        });
    });
</script>