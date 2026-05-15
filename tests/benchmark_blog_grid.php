<?php
// Mock WordPress environment for Blog_Grid::get_posts benchmark

namespace Elementor {
    class Widget_Base {
        public function get_settings_for_display() { return []; }
        public function get_name() { return ''; }
        public function get_title() { return ''; }
        public function get_icon() { return ''; }
        public function get_categories() { return []; }
        public function get_style_depends() { return []; }
        public function get_script_depends() { return []; }
        protected function register_controls() {}
    }

    class Controls_Manager {
        const CHOOSE = 'choose';
        const SELECT = 'select';
        const SWITCHER = 'switcher';
        const ICONS = 'icons';
        const HEADING = 'heading';
        const SELECT2 = 'select2';
        const NUMBER = 'number';
        const COLOR = 'color';
        const DIMENSIONS = 'dimensions';
        const SLIDER = 'slider';
        const TAB_CONTENT = 'content';
        const TAB_STYLE = 'style';
        const TAB_ADVANCED = 'advanced';
    }

    class Group_Control_Typography {
        public static function get_type() { return 'typography'; }
    }

    class Group_Control_Background {
        public static function get_type() { return 'background'; }
    }

    class Group_Control_Border {
        public static function get_type() { return 'border'; }
    }
}

namespace {
    define( 'ABSPATH', __DIR__ . '/../' );

    // Mock WP functions
    function esc_html__( $text, $domain = 'default' ) {
        return $text;
    }

    function generate_dummy_posts( $count ) {
        $posts = [];
        for ( $i = 0; $i < $count; $i++ ) {
            $post = new stdClass();
            $post->ID = $i;
            $post->post_title = "Post Title $i";
            $posts[] = $post;
        }
        return $posts;
    }

    function get_posts( $args = [] ) {
        // Simulate DB query cost and behavior

        // Check if args is an indexed array of objects (the bug scenario)
        // WP's get_posts/WP_Query would see numeric keys and ignore them, falling back to defaults.
        // It's tricky to detect if it's strictly numeric array of objects vs assoc array.
        // But Blog_Grid passes an array of objects.
        if ( is_array( $args ) && ! empty( $args ) && isset( $args[0] ) && is_object( $args[0] ) ) {
            // Return default posts (e.g. 5)
            // But verify we are not leaking memory here (simulating query cost isn't strictly necessary for logic check but is for perf benchmark)
            return generate_dummy_posts( 5 );
        }

        $limit = 5; // Default WP limit
        if ( isset( $args['posts_per_page'] ) ) {
            if ( $args['posts_per_page'] == -1 ) {
                $limit = 5000; // Simulate HEAVY query
            } else {
                $limit = (int) $args['posts_per_page'];
            }
        }

        return generate_dummy_posts( $limit );
    }

    // Include the file under test
    require_once __DIR__ . '/../widgets/Blog_Grid.php';

    // Benchmark
    echo "Benchmarking Blog_Grid::get_posts()...\n";

    $start_mem = memory_get_usage();
    $start_time = microtime( true );

    $posts = \SPEL\Widgets\Blog_Grid::get_posts();

    $end_time = microtime( true );
    $end_mem = memory_get_peak_usage();

    $duration = $end_time - $start_time;
    $memory_increase = $end_mem - $start_mem;

    echo "Execution Time: " . number_format( $duration, 5 ) . " seconds\n";
    echo "Peak Memory Usage Increase: " . number_format( $memory_increase / 1024 / 1024, 2 ) . " MB\n";
    echo "Result Count: " . count( $posts ) . "\n";
}
