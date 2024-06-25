<?php
namespace SPEL\includes\classes;

use SPEL\includes\Admin\Admin_Settings;

class Theme_Builder {

    public string $dir;

    public string $url;

    /**
     * Theme_Builder constructor.
     * Initializes the class, sets directory and URL, and registers actions and filters.
     */
    public function __construct() {

        // Get the Current directory path
        $this->dir = dirname( __FILE__ );

        // Get the current URL
        $this->url = plugin_dir_url( __FILE__ );

        // Register custom post type
        $this->cpt();

        // Add admin menu
        add_action('admin_menu', [$this, 'theme_builder_menu'], 99);

        // Set default page template for new posts
        add_action('add_meta_boxes', [$this, 'default_page_template'], 10, 2);

        // Customize admin columns
        add_filter('manage_spel_template_posts_columns', [$this, 'set_columns']);
        add_action('manage_spel_template_posts_custom_column', [$this, 'set_column_content'], 10, 2);
        add_action('admin_init', [$this, 'add_author_support_to_column']);

        // Add modal popup view
        add_action('admin_footer', [$this, 'modal_popup_view']);


        // Enqueue scripts
        add_action( 'admin_enqueue_scripts',[$this, 'enqueue_scripts'] );

        // Register AJAX actions
        add_action('wp_ajax_spel_create_template_post', [$this, 'ajax_create_template_post']);
        add_action('wp_ajax_nopriv_spel_create_template_post', [$this, 'ajax_create_template_post']);

        add_action('wp_ajax_spel_edit_template_post', [$this, 'ajax_edit_template_post']);
        add_action('wp_ajax_nopriv_spel_edit_template_post', [$this, 'ajax_edit_template_post']);

    }

    /**
     * Registers the custom post type 'spel_template'.
     */
    public function cpt(): void
    {
        $labels = array(
            'name'               => esc_html__( 'Templates', 'spider-elements' ),
            'singular_name'      => esc_html__( 'Template', 'spider-elements' ),
            'menu_name'          => esc_html__( 'Theme Builder', 'spider-elements' ),
            'name_admin_bar'     => esc_html__( 'Theme Builder', 'spider-elements' ),
            'add_new'            => esc_html__( 'Add New', 'spider-elements' ),
            'add_new_item'       => esc_html__( 'Add New Template', 'spider-elements' ),
            'new_item'           => esc_html__( 'New Template', 'spider-elements' ),
            'edit_item'          => esc_html__( 'Edit Template', 'spider-elements' ),
            'view_item'          => esc_html__( 'View Template', 'spider-elements' ),
            'all_items'          => esc_html__( 'All Templates', 'spider-elements' ),
            'search_items'       => esc_html__( 'Search Templates', 'spider-elements' ),
            'parent_item_colon'  => esc_html__( 'Parent Templates:', 'spider-elements' ),
            'not_found'          => esc_html__( 'No Templates found.', 'spider-elements' ),
            'not_found_in_trash' => esc_html__( 'No Templates found in Trash.', 'spider-elements' ),
        );

        $args = array(
            'labels'              => $labels,
            'public'              => true,
            'rewrite'             => false,
            'show_ui'             => true,
            'show_in_menu'        => false,
            'show_in_nav_menus'   => false,
            'exclude_from_search' => true,
            'capability_type'     => 'page',
            'hierarchical'        => false,
            'supports'            => array( 'title', 'elementor' ),
            'can_export'          => true,
            'has_archive'         => true,
        );

        register_post_type( 'spel_template', $args );
    }

    /**
     * Adds the theme builder menu to the admin menu.
     */
    public function theme_builder_menu(): void
    {
        add_submenu_page(
            Admin_Settings::PAGE_ID, // Parent slug
            esc_html__('Theme Builder', 'spider-elements'), // Page title
            esc_html__('Theme Builder', 'spider-elements'), // Menu title
            'manage_options', // Capability
            'edit.php?post_type=spel_template', // Slug
            false // Function
        );
    }

    /**
     * Sets the default page template for new posts of type 'elementor_canvas'.
     *
     * @param string $post_type The post type.
     * @param WP_Post $post The post object.
     */
    public function default_page_template($post_type, $post): void
    {
        if ($post_type == 'spel_template' && $post->post_status == 'auto-draft') {
            $default_template = 'elementor_canvas';
            update_post_meta($post->ID, '_wp_page_template', $default_template);
        }
    }


    /**
     * Modifies the columns displayed in the admin list table for 'spel_template'.
     *
     * @param array $columns The existing columns.
     * @return array The modified columns.
     */
    public function set_columns(array $columns): array
    {
        $date = $columns['date'] ?? '';
        $author = $columns['author'] ?? '';

        unset($columns['date']);
        unset($columns['author']);

        $columns['type'] = esc_html__('Type', 'spider-elements');
        $columns['condition'] = esc_html__('Conditions', 'spider-elements');
        $columns['status'] = esc_html__('Status', 'spider-elements');

        if (!empty($author)) {
            $columns['author'] = $author;
        }

        if (!empty($date)) {
            $columns['date'] = $date;
        }

        return $columns;
    }

    /**
     * Sets the content for custom columns in the admin list table for 'spel_template'.
     *
     * @param string $column The name of the column.
     * @param int $post_id The post ID.
     */
    public function set_column_content(string $column, int $post_id): void
    {
        switch ($column) {
            case 'type':
                $type = get_post_meta($post_id, 'spel_template_type', true);
                echo esc_html($type);
                break;

            case 'condition':
                $conditions = get_post_meta($post_id, 'spel_template_condition', true);
                echo esc_html($conditions);
                break;

            case 'status':
                $status = get_post_meta($post_id, 'spel_template_status', true);
                echo esc_html($status === 'yes' ? 'Active' : 'Inactive');
                break;
        }

    }

    /**
     * Adds author support to the 'spel_template' post type.
     */
    public function add_author_support_to_column(): void
    {
        add_post_type_support('spel_template', 'author');
    }


    /**
     * Includes the modal popup view template.
     */
    public function modal_popup_view(): void
    {
        $screen = get_current_screen();
        if ( $screen->id == 'edit-spel_template' ) {
            include_once $this->dir . '/theme-builder/modal-editor.php';
        }
    }


    /**
     * Enqueues scripts for the admin area.
     */
    public function enqueue_scripts(): void
    {
        $screen = get_current_screen();
        if ( $screen->id == 'edit-spel_template' ) {
            wp_enqueue_script('spel-tb-admin-script', $this->url . 'theme-builder/assets/js/admin-script.js', ['jquery'], SPEL_VERSION, true);

            wp_localize_script('spel-tb-admin-script', 'spel_template_object', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('spel_create_template_post_nonce')
            ));

        }
    }


    /**
     * Handles the AJAX request to create or update a template post.
     */
    public function ajax_create_template_post(): void
    {
        // Check the nonce for security
        if ( ! isset( $_POST['security'] ) || ! wp_verify_nonce( $_POST['security'], 'spel_create_template_post_nonce' ) ) {
            wp_send_json_error('Invalid nonce');
        }

        // Parse the form data
        parse_str($_POST['form_data'], $form_data);

        $post_id = intval($_POST['post_id']);
        $post_title = !empty($form_data['title']) ? sanitize_text_field($form_data['title']) : '';
        $post_type = !empty($form_data['spel_template_type']) ? sanitize_text_field($form_data['spel_template_type']) : '';
        $post_conditions = !empty($form_data['spel_template_condition']) ? sanitize_text_field($form_data['spel_template_condition']) : '';
        $post_status = !empty($form_data['spel_template_status']) ? sanitize_text_field($form_data['spel_template_status']) : '';


        // Prepare the post data
        $post_data = array(
            'post_title'  => $post_title,
            'post_type'   => 'spel_template',
            'post_status' => 'publish'
        );

        if ($post_id) {
            // Update existing post
            $post_data['ID'] = $post_id;
            wp_update_post($post_data);
        } else {
            // Create a new post
            $post_id = wp_insert_post($post_data);
        }

        if ($post_id) {

            // Update post meta
            update_post_meta($post_id, 'spel_template_type', $post_type);
            update_post_meta($post_id, 'spel_template_condition', $post_conditions);
            update_post_meta($post_id, 'spel_template_status', $post_status);

            wp_send_json_success(array('post_id' => $post_id));
        } else {
            wp_send_json_error();
        }
    }


    /**
     * Handles the AJAX request to fetch the details of a template post.
     */
    public function ajax_edit_template_post(): void
    {
        // Check the nonce for security
        if ( ! isset( $_POST['security'] ) || ! wp_verify_nonce( $_POST['security'], 'spel_create_template_post_nonce' ) ) {
            wp_send_json_error('Invalid nonce');
        }

        $post_id = intval($_POST['post_id']);

        if (!$post_id) {
            wp_send_json_error('Invalid post ID');
        }

        $post = get_post($post_id);

        if ($post && $post->post_type === 'spel_template') {
            wp_send_json_success(array(
                'post_title' => $post->post_title,
                'type' => get_post_meta($post_id, 'spel_template_type', true),
                'condition' => get_post_meta($post_id, 'spel_template_condition', true),
                'status' => get_post_meta($post_id, 'spel_template_status', true)
            ));
        } else {
            wp_send_json_error('Post not found or invalid post type');
        }

    }



}