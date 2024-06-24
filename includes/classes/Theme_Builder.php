<?php
namespace SPEL\includes\classes;

use SPEL\includes\Admin\Admin_Settings;

class Theme_Builder {

    public string $dir;

    public string $url;

    public function __construct() {

        // Get the Current directory path
        $this->dir = dirname( __FILE__ );

        // Get the current URL
        $this->url = plugin_dir_url( __FILE__ );

        $this->cpt();
        add_action('admin_menu', [$this, 'theme_builder_menu'], 99);
        add_action('add_meta_boxes', [$this, 'default_page_template'], 10, 2);

        // Admin column
        add_filter('manage_spel_template_posts_columns', [$this, 'set_columns']);
        add_action('manage_spel_template_posts_custom_column', [$this, 'set_column_content'], 10, 2);

        //After Footer
        add_action('admin_footer', [$this, 'modal_popup_view']);
    }

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

    public function default_page_template($post_type, $post): void
    {
        if ($post_type == 'spel_template' && $post->post_status == 'auto-draft') {
            $default_template = 'elementor_canvas';
            update_post_meta($post->ID, '_wp_page_template', $default_template);
        }
    }


    public function set_columns($columns)
    {
        $date = $columns['date'] ?? '';
        $author = $columns['author'] ?? '';

        unset($columns['date']);
        unset($columns['author']);

        $columns['type'] = esc_html__('Type', 'spider-elements');
        $columns['condition'] = esc_html__('Conditions', 'spider-elements');

        if (!empty($date)) {
            $columns['date'] = $date;
        }

        if (!empty($author)) {
            $columns['author'] = $author;
        }

        return $columns;
    }

    public function set_column_content($column, $post_id)
    {
        switch ($column) {
            case 'type':
                $type = get_post_meta($post_id, '_template_type', true);
                echo esc_html($type);
                break;

            case 'condition':
                $conditions = get_post_meta($post_id, '_template_conditions', true);
                echo esc_html($conditions);
                break;

            case 'actions':
                echo '<button class="column-edit-button btn btn-secondary" data-post-id="' . esc_attr($post_id) . '">Edit</button>';
                break;
        }
    }


    public function modal_popup_view(): void
    {
        $screen = get_current_screen();
        if ( $screen->id == 'edit-spel_template' ) {
            include_once $this->dir . '/theme-builder/modal-editor.php';
        }
    }



}