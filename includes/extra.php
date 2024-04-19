<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_image_size( 'spe_270x152', 270, 152, true ); // Video Playlist Thumb
add_image_size( 'spe_120x70', 120, 70, true ); // Fullscreen slider Thumb 01

/**
 * Constants for widgets badge
 */
if ( ! defined( 'SPEL_TEXT_BADGE' ) ) {
	define('SPEL_TEXT_BADGE',
		'<span class="spe-text-badge-control">' . esc_html__( 'SPIDER', 'spider-elements' ) . '</span>'
	);
}


/**
 * @return bool
 * Elementor is edit mode
 */
function spider_elements_is_edit() {
	return \Elementor\Plugin::$instance->editor->is_edit_mode();
}

/**
 * @return bool
 * Elementor is preview mode
 */
function spider_elements_is_preview() {
	return \Elementor\Plugin::$instance->preview->is_preview_mode();
}


/**
 * Elementor Title tags
 */
if ( ! function_exists( 'spel_get_title_tags' ) ) {
    function spel_get_title_tags() {
        return [
            'h1'   => esc_html__( 'H1', 'spider-elements' ),
            'h2'   => esc_html__( 'H2', 'spider-elements' ),
            'h3'   => esc_html__( 'H3', 'spider-elements' ),
            'h4'   => esc_html__( 'H4', 'spider-elements' ),
            'h5'   => esc_html__( 'H5', 'spider-elements' ),
            'h6'   => esc_html__( 'H6', 'spider-elements' ),
            'div'  => esc_html__( 'Div', 'spider-elements' ),
            'span' => esc_html__( 'Span', 'spider-elements' ),
            'p'    => esc_html__( 'Paragraph', 'spider-elements' ),
        ];
    }
}


/**
 * Echo button link attributes.
 *
 * @param array $settings_key
 * @param bool  $is_echo
 */
if ( ! function_exists( 'spel_button_link' ) ) {
    function spel_button_link( $settings_key, $is_echo = true ) {
        if ( $is_echo ) {
            echo ! empty( $settings_key['url'] ) ? 'href="' . esc_url( $settings_key['url'] ) . '"' : '';
            echo $settings_key['is_external'] ? ' target="_blank"' : '';
            echo $settings_key['nofollow'] ? ' rel="nofollow"' : '';

            if ( ! empty( $settings_key['custom_attributes'] ) ) {
                $attrs = explode( ',', $settings_key['custom_attributes'] );

                if ( is_array( $attrs ) ) {
                    foreach ( $attrs as $data ) {
                        $data_attrs = explode( '|', $data );
                        echo ' ' . esc_attr( $data_attrs[0] ) . '="' . esc_attr( $data_attrs[1] ) . '"';
                    }
                }
            }
        }
    }
}

/**
 * Category IDs
 * @return array
 */
if ( ! function_exists( 'spel_cat_ids') ) {
    function spel_cat_ids() {

        $taxonomys = get_terms( array(
            'taxonomy'   => 'category',
            'hide_empty' => true,
        ) );
        $taxonomy  = [];
        if ( is_array( $taxonomys ) ) {
            foreach ( $taxonomys as $cat_id ) {
                $taxonomy[ $cat_id->term_id ] = $cat_id->name;
            }
        }

        return $taxonomy;

    }
}



/**
 * Day link to archive page
 **/
if ( ! function_exists( 'spel_day_link' ) ) {
    function spel_day_link() {
        $archive_year  = get_the_time( 'Y' );
        $archive_month = get_the_time( 'm' );
        $archive_day   = get_the_time( 'd' );
        echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) );
    }
}


/**
 * Get title excerpt length
 *
 * @param $settings
 * @param $settings_key
 * @param int $default
 *
 * @return string|void
 */
if ( ! function_exists( 'spel_get_title_length' ) ) {
    function spel_get_title_length( $settings, $settings_key, $default = 10 ) {

        $title_length = ! empty( $settings[ $settings_key ] ) ? $settings[ $settings_key ] : $default;
        $title        = get_the_title() ? wp_trim_words( get_the_title(), $title_length, '' ) : the_title();

        return $title;
    }
}




/**
 * Post's excerpt text
 *
 * @param $settings_key
 * @param bool $echo
 *
 * @return string
 **/
if ( ! function_exists( 'spel_get_excerpt_length' ) ) {
    function spel_get_excerpt_length( $settings, $settings_key, $default = 10 ) {

        $excerpt_length = ! empty( $settings[ $settings_key ] ) ? $settings[ $settings_key ] : $default;
        $excerpt        = get_the_excerpt() ? wp_trim_words(
            get_the_excerpt(),
            $excerpt_length,
            '...'
        ) : wp_trim_words( get_the_content(), $excerpt_length, '...' );

        return $excerpt;
    }
}


/**
 * Get the first category name
 *
 * @param string $term
 *
 * @return string
 */
if ( ! function_exists( 'spel_get_first_taxonomy' ) ) {
    function spel_get_first_taxonomy( $term = 'category' ) {
        $cats = get_the_terms( get_the_ID(), $term );
        $cat  = is_array( $cats ) ? $cats[0]->name : '';

        return esc_html( $cat );
    }
}


/**
 * Get the first category link
 *
 * @param string $term
 *
 * @return string
 */
if ( ! function_exists( 'spel_get_first_taxonomy_link' ) ) {
    function spel_get_first_taxonomy_link( $term = 'category' ) {

        $cats = get_the_terms( get_the_ID(), $term );
        $cat  = is_array( $cats ) ? get_category_link( $cats[0]->term_id ) : '';

        return esc_url( $cat );
    }
}


/**
 * Get categories array
 *
 * @param string $term
 *
 * @return array
 */
if ( ! function_exists( 'spel_get_categories' ) ) {
    function spel_get_categories( $term = 'category' ) {

        $cats = get_terms( array(
            'taxonomy'   => $term,
            'hide_empty' => true
        ) );

        $cat_array        = [];
        $cat_array['all'] = esc_html__( 'All', 'spider-elements' );

        if ( is_array( $cats ) ) {
            foreach ( $cats as $cat ) {
                $cat_array[ $cat->term_id ] = $cat->name;
            }
        }

        return $cat_array;
    }
}


/**
 * Get categories list
 *
 * @param string $term
 *
 * @return string
 */
if ( ! function_exists( 'spel_get_post_category_list' ) ) {
    function spel_get_post_category_list() {
        $categories = get_categories();

        if ( ! empty( $categories ) ) {
            echo '<span class="blog-category">';

            $category_names = array();

            if ( is_array( $categories ) ) {
                foreach ( $categories as $category ) {
                    $category_link    = get_category_link( $category->term_id );
                    $category_names[] = '<a href="' . esc_url( $category_link ) . '">' . esc_html( $category->name ) . '</a>';
                }
            }

            echo esc_html( implode( ', ', $category_names ) );

            echo '</span>';
        } else {
            echo esc_html__( 'No categories found.', 'spider-elements' );
        }
    }
}


/**
 * Get author name array
 *
 * @param string $term
 *
 * @return array
 */
if ( ! function_exists( 'spel_get_post_author_name' ) ) {
    function spel_get_post_author_name() {
        global $post;
        $byline = sprintf(
        /* translators: %s: post author. */
            esc_html_x( 'By: %s', 'post author', 'spider-elements' ),
            '<span class="author"><a class="url fn n" href="' . esc_url( get_author_posts_url( $post->post_author ) ) . '">' . esc_html( get_the_author_meta(
                'display_name',
                $post->post_author
            ) ) . '</a></span>'
        );

        echo wp_kses_post( $byline ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
}

/**
 * Get Default Image Elementor
 *
 * @param $settins_key
 * @param string $class
 * @param string $alt
 */
if ( ! function_exists( 'spel_el_image' ) ) {
    function spel_el_image( $settings_key = '', $alt = '', $class = '', $atts = [] ) {
        if ( ! empty( $settings_key['id'] ) ) {
            echo wp_get_attachment_image( $settings_key['id'], 'full', '', array( 'class' => $class ) );
        } elseif ( ! empty( $settings_key['url'] ) && empty( $settings_key['id'] ) ) {
            $class = ! empty( $class ) ? "class='$class'" : '';
            $attss = '';
            if ( ! empty( $atts ) ) {
                foreach ( $atts as $k => $att ) {
                    $attss .= "$k=" . "'$att'";
                }
            }
            echo "<img src='{$settings_key['url']}' $class alt='$alt' $attss>";
        }
    }
}


/**
 * Get Default Image Elementor
 *
 * @param $settins_key
 * @param string $class
 * @param string $alt
 */
if ( ! function_exists( 'spel_el_image_caption' ) ) {
    function spel_el_image_caption( $image_id = '' ) {
        $img_attachment = get_post( $image_id );

        return array(
            'alt'     => get_post_meta( $img_attachment->ID, '_wp_attachment_image_alt', true ),
            'caption' => $img_attachment->post_excerpt,
            'href'    => get_permalink( $img_attachment->ID ),
            'src'     => $img_attachment->guid,
            'title'   => $img_attachment->post_title
        );
    }
}


/**
 * @param string $content Text content to filter.
 *
 * @return string Filtered content containing only the allowed HTML.
 */
if ( ! function_exists( 'spel_kses_post' ) ) {
    function spel_kses_post( $content ) {
        $allowed_tag = array(
            'strong' => [],
            'br'     => [],
            'p'      => [
                'class' => [],
                'style' => [],
            ],
            'i'      => [
                'class' => [],
                'style' => [],
            ],
            'ul'     => [
                'class' => [],
                'style' => [],
            ],
            'li'     => [
                'class' => [],
                'style' => [],
            ],
            'span'   => [
                'class' => [],
                'style' => [],
            ],
            'a'      => [
                'href'  => [],
                'class' => [],
                'title' => []
            ],
            'div'    => [
                'class' => [],
                'style' => [],
            ],
            'h1'     => [
                'class' => [],
                'style' => []
            ],
            'h2'     => [
                'class' => [],
                'style' => []
            ],
            'h3'     => [
                'class' => [],
                'style' => []
            ],
            'h4'     => [
                'class' => [],
                'style' => []
            ],
            'h5'     => [
                'class' => [],
                'style' => []
            ],
            'h6'     => [
                'class' => [],
                'style' => []
            ],
            'img'    => [
                'class'  => [],
                'style'  => [],
                'height' => [],
                'width'  => [],
                'src'    => [],
                'srcset' => [],
                'alt'    => [],
            ],

        );

        return wp_kses( $content, $allowed_tag );
    }
}


/**
 * Tab data
 *
 * @param $getCats
 * @param $schedule_cats
 *
 * @return array
 */
if ( ! function_exists( 'spel_get_tab_data' ) ) {
    function spel_get_tab_data( $getCats, $schedule_cats ) {
        $tab_data = [];

        foreach ( $getCats as $val ) {
            $matching_data = [];

            foreach ( $schedule_cats as $data ) {
                if ( $data['tab_title'] == $val ) {
                    $matching_data[] = $data;
                }
            }

            $tab_data[ $val ] = $matching_data;
        }

        return $tab_data;
    }
}


/**
 * Get reading time
 *
 * @param string $term
 *
 * @return string
 */
if ( ! function_exists( 'spel_get_reading_time' ) ) {
    function spel_get_reading_time( $words_per_minute = 200 ) {
        $content      = get_post_field( 'post_content', get_the_ID() );
        $word_count   = str_word_count( wp_strip_all_tags( $content ) );
        $reading_time = ceil( $word_count / $words_per_minute );
        $timer        = _n( 'minute', 'minutes', $reading_time, 'spider-elements' );

        return sprintf( '%d %s', $reading_time, $timer );
    }
}

/**
 * Render Dynamic Image
 * @param $key
 * @param $class
 * @return void
 */
if ( ! function_exists( 'spel_dynamic_image' ) ) {
    function spel_dynamic_image( $key, $size = 'full', $atts = [] ) {
        $image = wp_get_attachment_image( $key['id'], $size, '', $atts );
        echo wp_kses( $image, [
            'img'    => [
                'class'  => [],
                'style'  => [],
                'height' => [],
                'width'  => [],
                'src'    => [],
                'srcset' => [],
                'alt'    => [],
            ],
        ]);
    }
}



/**
 * Retrieve a list of posts based on specified parameters.
 *
 * @param string $post_type The post-type to query.
 * @param int    $limit     The maximum number of posts to retrieve.
 * @param string $search    The search term for post-titles.
 *
 * @return array An associative array with post-IDs as keys and post-titles as values.
 */
if ( ! function_exists( 'spel_get_query_post_list' ) ) {
    function spel_get_query_post_list( $post_type = 'any', $limit = -1, $search = '' ) {
        $args = [
            'post_type' => $post_type,
            'post_status' => 'publish',
            'posts_per_page' => $limit,
            's' => $search, // Search term
        ];

        $query = new WP_Query( $args );

        $data = [];
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $data[ get_the_ID() ] = get_the_title();
            }
        }

        wp_reset_postdata(); // Reset post data after custom query

        return $data;
    }
}


/**
 * Get all elementor page templates
 *
 * @param null $type
 *
 * @return array
 */
if ( ! function_exists( 'spel_get_el_templates' ) ) {
    function spel_get_el_templates( $type = null ) {
        $options = [];

        if ( $type ) {
            $args              = [
                'post_type'      => 'elementor_library',
                'posts_per_page' => -1,
            ];
            $args['tax_query'] = [
                [
                    'taxonomy' => 'elementor_library_type',
                    'field'    => 'slug',
                    'terms'    => $type,
                ],
            ];

            $page_templates = get_posts( $args );

            if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ) {
                foreach ( $page_templates as $post ) {
                    $options[ $post->ID ] = $post->post_title;
                }
            }
        } else {
            $options = spel_get_query_post_list( 'elementor_library' );
        }

        return $options;
    }
}


add_action( 'admin_init', function () {

	if ( isset( $_POST['elements-submit'] ) ) {

		// Retrieve the field values from the form
		$accordion                       = isset( $_POST['docy_accordion'] ) ? sanitize_text_field( $_POST['docy_accordion'] ) : '';
		$alerts_box                      = isset( $_POST['docly_alerts_box'] ) ? sanitize_text_field( $_POST['docly_alerts_box'] ) : '';
		$animated_heading                = isset( $_POST['spe_animated_heading'] ) ? sanitize_text_field( $_POST['spe_animated_heading'] ) : '';
		$after_before_widget             = isset( $_POST['spe_after_before_widget'] ) ? sanitize_text_field( $_POST['spe_after_before_widget'] ) : '';
		$docy_blog_grid                  = isset( $_POST['docy_blog_grid'] ) ? sanitize_text_field( $_POST['docy_blog_grid'] ) : '';
		$spe_buttons                     = isset( $_POST['spe_buttons'] ) ? sanitize_text_field( $_POST['spe_buttons'] ) : '';
		$docly_cheatsheet                = isset( $_POST['docly_cheatsheet'] ) ? sanitize_text_field( $_POST['docly_cheatsheet'] ) : '';
		$spe_counter                     = isset( $_POST['spe_counter'] ) ? sanitize_text_field( $_POST['spe_counter'] ) : '';
		$spe_instagram                   = isset( $_POST['spe_instagram'] ) ? sanitize_text_field( $_POST['spe_instagram'] ) : '';
		$docy_integrations               = isset( $_POST['docy_integrations'] ) ? sanitize_text_field( $_POST['docy_integrations'] ) : '';
		$docly_list_item                 = isset( $_POST['docly_list_item'] ) ? sanitize_text_field( $_POST['docly_list_item'] ) : '';
		$spe_marquee_slides              = isset( $_POST['spe_marquee_slides'] ) ? sanitize_text_field( $_POST['spe_marquee_slides'] ) : '';
		$landpagy_pricing_table_switcher = isset( $_POST['landpagy_pricing_table_switcher'] ) ? sanitize_text_field( $_POST['landpagy_pricing_table_switcher'] ) : '';
		$landpagy_pricing_table_tabs     = isset( $_POST['landpagy_pricing_table_tabs'] ) ? sanitize_text_field( $_POST['landpagy_pricing_table_tabs'] ) : '';
		$spe_skill_showcase_widget       = isset( $_POST['spe_skill_showcase_widget'] ) ? sanitize_text_field( $_POST['spe_skill_showcase_widget'] ) : '';
		$docy_tabs                       = isset( $_POST['docy_tabs'] ) ? sanitize_text_field( $_POST['docy_tabs'] ) : '';
		$docy_team_carousel              = isset( $_POST['docy_team_carousel'] ) ? sanitize_text_field( $_POST['docy_team_carousel'] ) : '';
		$docy_testimonial                = isset( $_POST['docy_testimonial'] ) ? sanitize_text_field( $_POST['docy_testimonial'] ) : '';
		$spe_timeline_widget             = isset( $_POST['spe_timeline_widget'] ) ? sanitize_text_field( $_POST['spe_timeline_widget'] ) : '';
		$docy_videos_playlist            = isset( $_POST['docy_videos_playlist'] ) ? sanitize_text_field( $_POST['docy_videos_playlist'] ) : '';
		$docy_video_popup                = isset( $_POST['docy_video_popup'] ) ? sanitize_text_field( $_POST['docy_video_popup'] ) : '';
		$dual_button                     = isset( $_POST['spel_dual_button'] ) ? sanitize_text_field( $_POST['spel_dual_button'] ) : '';
		$icon_box                     = isset( $_POST['spel_icon_box'] ) ? sanitize_text_field( $_POST['spel_icon_box'] ) : '';
		$spe_global_switcher 		   	 = isset( $_POST['spe_global_switcher'] ) ? sanitize_text_field( $_POST['spe_global_switcher'] ) : '';

		// Create an array to store the field values
		$data = array(
			'docy_accordion'                  => $accordion,
			'docly_alerts_box'                => $alerts_box,
			'spe_animated_heading'            => $animated_heading,
			'spe_after_before_widget'         => $after_before_widget,
			'docy_blog_grid'                  => $docy_blog_grid,
			'spe_buttons'                     => $spe_buttons,
			'docly_cheatsheet'                => $docly_cheatsheet,
			'spe_counter'                     => $spe_counter,
			'spe_instagram'                   => $spe_instagram,
			'docy_integrations'               => $docy_integrations,
			'docly_list_item'                 => $docly_list_item,
			'spe_marquee_slides'              => $spe_marquee_slides,
			'landpagy_pricing_table_switcher' => $landpagy_pricing_table_switcher,
			'landpagy_pricing_table_tabs'     => $landpagy_pricing_table_tabs,
			'spe_skill_showcase_widget'       => $spe_skill_showcase_widget,
			'docy_tabs'                       => $docy_tabs,
			'docy_team_carousel'              => $docy_team_carousel,
			'docy_testimonial'                => $docy_testimonial,
			'spe_timeline_widget'             => $spe_timeline_widget,
			'docy_videos_playlist'            => $docy_videos_playlist,
			'docy_video_popup'                => $docy_video_popup,
			'spel_icon_box'                   => $icon_box,
			'spe_global_switcher'             => $spe_global_switcher,
		);

		// Save the data in the options table using update_option
		update_option( 'spe_widget_settings', $data );

	}

} );



// Dashboard Features Setting Save Data
add_action( 'admin_init', function () {

    if ( isset( $_POST['features-submit'] ) ) {

        // Retrieve the field values from the form
        $smooth_animation     = isset( $_POST['spel_smooth_animation'] ) ? sanitize_text_field( $_POST['spel_smooth_animation'] ) : '';
        $badge                = isset( $_POST['spel_badge'] ) ? sanitize_text_field( $_POST['spel_badge'] ) : '';
        $reveal_animation     = isset( $_POST['spel_reveal_animation'] ) ? sanitize_text_field( $_POST['spel_reveal_animation'] ) : '';

        // Create an array to store the field values
        $data = array(
            'spel_smooth_animation'       => $smooth_animation,
            'spel_badge'                  => $badge,
            'spel_reveal_animation'       => $reveal_animation,
        );

        // Save the data in the options table using update_option
        update_option( 'spel_features_settings', $data );

    }

} );


/**
 * Get information about the server environment.
 *
 * @return array Server environment information.
 */
if ( ! function_exists( 'spel_get_environment_info' ) ) {
    function spel_get_environment_info() {

        // Figure out cURL version, if installed.
        $curl_version = '';
        if ( function_exists( 'curl_version' ) ) {
            $curl_version = curl_version();
            $curl_version = $curl_version['version'] . ', ' . $curl_version['ssl_version'];
        }

        // WP memory limit.
        $wp_memory_limit = spel_readable_number(WP_MEMORY_LIMIT);
        if ( function_exists( 'memory_get_usage' ) ) {
            $wp_memory_limit = max( $wp_memory_limit, spel_readable_number( @ini_get( 'memory_limit' ) ) );
        }

        return array(
            'home_url'                  => get_option( 'home' ),
            'site_url'                  => get_option( 'siteurl' ),
            'version'                   => SPEL_VERSION,
            'wp_version'                => get_bloginfo( 'version' ),
            'wp_multisite'              => is_multisite(),
            'wp_memory_limit'           => $wp_memory_limit,
            'wp_debug_mode'             => ( defined( 'WP_DEBUG' ) && WP_DEBUG ),
            'wp_cron'                   => ! ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ),
            'language'                  => get_locale(),
            'external_object_cache'     => wp_using_ext_object_cache(),
            'server_info'               => isset( $_SERVER['SERVER_SOFTWARE'] ) ? wp_unslash( $_SERVER['SERVER_SOFTWARE'] ) : '',
            'php_version'               => phpversion(),
            'php_post_max_size'         => spel_readable_number( ini_get( 'post_max_size' ) ),
            'php_max_execution_time'    => ini_get( 'max_execution_time' ),
            'php_max_input_vars'        => ini_get( 'max_input_vars' ),
            'curl_version'              => $curl_version,
            'suhosin_installed'         => extension_loaded( 'suhosin' ),
            'max_upload_size'           => wp_max_upload_size(),
            'default_timezone'          => date_default_timezone_get(),
            'fsockopen_or_curl_enabled' => ( function_exists( 'fsockopen' ) || function_exists( 'curl_init' ) ),
            'soapclient_enabled'        => class_exists( 'SoapClient' ),
            'domdocument_enabled'       => class_exists( 'DOMDocument' ),
            'gzip_enabled'              => is_callable( 'gzopen' ),
            'mbstring_enabled'          => extension_loaded( 'mbstring' ),
        );

    }
}


/**
 * Convert a human-readable file size into bytes.
 *
 * @param string $size The size string (e.g., "1M", "2G", "500K").
 * @return int The equivalent size in bytes.
 */
if ( ! function_exists( 'spel_readable_number' ) ) {
    function spel_readable_number($size)
    {

        // Get the last character of the size string
        $suffix = substr($size, -1);

        // Remove the last character from the size string
        $value = substr($size, 0, -1);

        // Convert suffix to lowercase for case-insensitive comparison
        $suffix = strtolower($suffix);

        $multipliers = [
            'p' => 1024,
            't' => 1024,
            'g' => 1024,
            'm' => 1024,
            'k' => 1024,
        ];

        // Check if the suffix is a valid multiplier
        if (array_key_exists($suffix, $multipliers)) {
            $value *= $multipliers[$suffix];
        }

        // Return the result
        return (int)$value;

    }
}