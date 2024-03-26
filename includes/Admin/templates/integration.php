<?php
if ( ! defined( 'ABSPATH' ) ) {
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
        <p><?php _e('We are excited to announce that we have added new Widgets, Template Kits, and other Elementor<br> features to
            enhance your website building experience. Stay tuned for the weekly updates!', 'spider-elements'); ?></p>
    </div>
    <div class="ezd-grid ezd-grid-cols-12">
        <?php
        if (isset($integrations) && is_array($integrations)) {
            foreach ( $integrations as $plugin ) {
                $plugin_status = \SPEL\includes\classes\Plugin_Installer::instance();
                $plugin_item = $plugin_status->get_status($plugin[ 'basename' ]);
                ?>
                <div class="ezd-lg-col-4">
                    <div class="spe_element_box spe_integration_item ezd-text-center">
                        <img src="<?php echo esc_url($plugin[ 'logo' ]) ?>"
                             alt="<?php echo esc_attr($plugin[ 'title' ]) ?>">
                        <h3><?php echo esc_html($plugin[ 'title' ]) ?></h3>
                        <p><?php echo esc_html($plugin[ 'desc' ]) ?></p>
                        <a data-plugin_status="<?php echo esc_attr($plugin_item[ 'status' ]); ?>"
                           data-activation_url="<?php echo esc_url($plugin_item[ 'activation_url' ]); ?>"
                           href="<?php echo esc_url($plugin_item[ 'installation_url' ]); ?>"
                           class="spe_dashboard_btn <?php echo $plugin_item[ 'status' ] == 'activated' ? 'active_btn' : ''; ?>">
                            <?php echo esc_html($plugin_item[ 'title' ]); ?>
                        </a>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>