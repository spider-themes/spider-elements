<?php
/**
 * Admin notice
 */
add_action( 'admin_notices', function () {

    if( ! current_user_can('install_plugins')) {
        return;
    }

    if ( is_plugin_active('pro-elements/pro-elements.php') ) :
        ?>
        <div class="notice notice-warning eaz-notice">
            <p>
                <?php echo se_get_the_kses_post( '<strong>Important notice:</strong> <br> PRO Elements plugin is obsolete. All its features were transferred into the Docy Core plugin.' ); ?> <br>
                <?php esc_html_e( 'You must need to remove the PRO Elements plugin to avoid conflicts.', 'docy-core' ); ?>
            </p>
            <p>
                <a href="?deactivate=pro-elements" class="button-primary button-large">
                    <?php esc_html_e( 'Deactivate Pro Elements', 'docy-core' ); ?>
                </a>
            </p>
        </div>
    <?php
    endif;
});

/**
 * Deactivate Other Knowledge-base plugins
 */
if ( isset($_GET['deactivate']) && !empty($_GET['deactivate']) ) {

    $plugin = sanitize_text_field( $_GET['deactivate'] );
    add_action( 'admin_init', "se_core_deactivate_other_plugin" );
    function se_core_deactivate_other_plugin() {
        $plugin = ! empty ( $_GET['deactivate'] ) ? sanitize_text_field( $_GET['deactivate'] ) : '';
        deactivate_plugins("$plugin/$plugin.php");

        $url = admin_url('plugins.php');
        wp_safe_redirect( $url );
    }
}
