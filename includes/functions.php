<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Check if the pro-plugin and plan is active
 *
 * @return bool
 * @since 1.0.0
 */
function spel_is_premium(): bool {
	return spel_fs()->is_plan( 'pro' ) && spel_fs()->can_use_premium_code();
}

/**
 * Check if the Docy theme is active
 *
 * @return bool
 * @since 1.0.0
 */
function spel_unlock_docy_theme(): bool {
	$theme       = wp_get_theme();
	$theme_name  = $theme->get( 'Name' );
	$docy_themes = [ 'Docy', 'docy', 'Docy Child', 'docy-child' ];

	return in_array( $theme_name, $docy_themes, true ) || spel_is_premium();
}

if ( ! function_exists( 'spel_rtl' ) ) {
	/**
	 * Check if RTL mode is active.
	 *
	 * @return string 'true' or 'false'
	 * @since 1.0.0
	 */
	function spel_rtl(): string {
		return is_rtl() ? 'true' : 'false';
	}
}

/**
 * Elementor is edit mode
 *
 * @return bool
 * @since 1.0.0
 */
function spider_elements_is_edit(): bool {
	return \Elementor\Plugin::$instance->editor->is_edit_mode();
}

/**
 * Elementor is preview mode
 *
 * @return bool
 * @since 1.0.0
 */
function spider_elements_is_preview(): bool {
	return \Elementor\Plugin::$instance->preview->is_preview_mode();
}

/**
 * Elementor Title tags
 *
 * @return array
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_get_title_tags' ) ) {
	function spel_get_title_tags(): array {
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
 * @return void
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_button_link' ) ) {
	function spel_button_link( $settings_key, $is_echo = true ): void {
        if ( $is_echo ) {
            echo ! empty( $settings_key['url'] ) ? 'href="' . esc_url( $settings_key['url'] ) . '"' : '';
            echo $settings_key['is_external'] ? ' target="_blank"' : '';
            echo $settings_key['nofollow'] ? ' rel="nofollow"' : '';

            if ( ! empty( $settings_key['custom_attributes'] ) ) {
                $attrs = explode( ',', $settings_key['custom_attributes'] );

                if ( is_array( $attrs ) ) {
                    foreach ( $attrs as $data ) {
                        $data_attrs = explode( '|', $data, 2 );
                        $attr_name  = trim( $data_attrs[0] );
                        $attr_value = isset( $data_attrs[1] ) ? $data_attrs[1] : '';

                        // Security: Sanitize attribute name (allow alphanumeric, dashes, colons)
                        $attr_name = preg_replace( '/[^a-zA-Z0-9_\-:]/', '', $attr_name );

                        // Security: Prevent XSS by blocking event handlers (on*) and critical attributes
                        if ( preg_match( '/^(on|href|src|formaction)/i', $attr_name ) ) {
                            continue;
                        }

                        if ( ! empty( $attr_name ) ) {
                            echo ' ' . esc_attr( $attr_name ) . '="' . esc_attr( $attr_value ) . '"';
                        }
                    }
                }
            }
        }
    }
}

/**
 * Category IDs
 *
 * @return array
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_cat_ids' ) ) {
	function spel_cat_ids() {
		$taxonomys = get_terms( [
			'taxonomy'   => 'category',
			'hide_empty' => true,
		] );
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
 *
 * @return void
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_day_link' ) ) {
	function spel_day_link(): void {
        $archive_year  = get_the_time( 'Y' );
        $archive_month = get_the_time( 'm' );
        $archive_day   = get_the_time( 'd' );
        echo esc_url( get_day_link( $archive_year, $archive_month, $archive_day ) );
    }
}

/**
 * Retrieve the trimmed post title based on settings.
 *
 * This function fetches the current post title, applies a custom length
 * from the provided settings (or falls back to a default length), and
 * returns the trimmed version of the title. If no title exists, it will
 * safely return an empty string.
 *
 * @param array  $settings     Settings array that may contain the title length.
 * @param string $settings_key Array key used to find the title length inside settings.
 * @param int    $default      Default title length if no value is found in settings. Default 10.
 *
 * @return string The trimmed post title, or empty string if no title exists.
 * @since 1.0.0
 */
function spel_get_title_length( array $settings, string $settings_key, int $default = 10 ): string {
	$title        = get_the_title();
	$title_length = ! empty( $settings[ $settings_key ] ) ? (int) $settings[ $settings_key ] : $default;

	return $title ? wp_trim_words( $title, $title_length, '' ) : '';
}


/**
 * Post's excerpt text
 *
 * @param array  $settings
 * @param string $settings_key
 * @param int    $default
 *
 * @return string
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_get_excerpt_length' ) ) {
	function spel_get_excerpt_length( $settings, $settings_key, $default = 10 ): string {
		$excerpt_length = ! empty( $settings[ $settings_key ] ) ? $settings[ $settings_key ] : $default;

		return get_the_excerpt() ? wp_trim_words( get_the_excerpt(), $excerpt_length, '...' ) : wp_trim_words( get_the_content(), $excerpt_length, '...' );
	}
}


/**
 * Get the first category name
 *
 * @param string $term
 *
 * @return string
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_get_first_taxonomy' ) ) {
	function spel_get_first_taxonomy( $term = 'category' ): string {
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
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_get_first_taxonomy_link' ) ) {
	function spel_get_first_taxonomy_link( $term = 'category' ): string {

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
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_get_categories' ) ) {
	function spel_get_categories( $term = 'category' ) {

        $cats = get_terms( [
            'taxonomy'   => $term,
            'hide_empty' => true,
        ] );

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
 * Get a category list
 *
 * @return void
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_get_post_category_list' ) ) {
	function spel_get_post_category_list(): void {
        $categories = get_categories();

        if ( ! empty( $categories ) ) {
            echo '<span class="blog-category">';

            $category_names = [];

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
 * Get an author name array
 *
 * @return void
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_get_post_author_name' ) ) {
	function spel_get_post_author_name(): void {
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
 * @param array  $settings_key
 * @param string $alt
 * @param string $class
 * @param array  $atts
 * @return void
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_el_image' ) ) {
	function spel_el_image( $settings_key = [], $alt = '', $class = '', $atts = [] ): void {
		if ( ! empty( $settings_key['id'] ) ) {
			// WordPress handles escaping internally here
			echo wp_get_attachment_image( $settings_key['id'], 'full', false, [ 'class' => esc_attr( $class ) ] );
		} elseif ( ! empty( $settings_key['url'] ) && empty( $settings_key['id'] ) ) {
			$class_attr = ! empty( $class ) ? ' class="' . esc_attr( $class ) . '"' : '';
			$atts_str   = '';

			if ( ! empty( $atts ) ) {
				foreach ( $atts as $k => $att ) {
					$atts_str .= ' ' . esc_attr( $k ) . '="' . esc_attr( $att ) . '"';
				}
			}

			printf(
				'<img src="%1$s"%2$s alt="%3$s"%4$s />',
				esc_url( $settings_key['url'] ),
				// $class_attr contains safe HTML attribute string
				$class_attr, // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				esc_attr( $alt ),
				// $atts_str contains safe HTML attribute string
				$atts_str // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			);
		}
	}
}



/**
 * Get Default Image Elementor Caption
 *
 * @param string $image_id
 * @return array
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_el_image_caption' ) ) {
	function spel_el_image_caption( $image_id = '' ): array {
        $img_attachment = get_post( $image_id );

        return [
            'alt'     => get_post_meta( $img_attachment->ID, '_wp_attachment_image_alt', true ),
            'caption' => $img_attachment->post_excerpt,
            'href'    => get_permalink( $img_attachment->ID ),
            'src'     => $img_attachment->guid,
            'title'   => $img_attachment->post_title,
        ];
    }
}


/**
 * Filter text content to allow only safe HTML.
 *
 * @param string $content Text content to filter.
 *
 * @return string Filtered content containing only the allowed HTML.
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_kses_post' ) ) {
    function spel_kses_post( $content ): string
    {
        $allowed_tag = [
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

        ];

        return wp_kses( $content, $allowed_tag );
    }
}


/**
 * Tab data
 *
 * @param array $getCats
 * @param array $schedule_cats
 *
 * @return array
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_get_tab_data' ) ) {
	function spel_get_tab_data( $getCats, $schedule_cats ): array {
		$tab_data = [];

		foreach ( $getCats as $val ) {
			$matching_data = [];

			foreach ( $schedule_cats as $data ) {
				if ( $val === $data['tab_title'] ) {
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
 * @param int $words_per_minute
 *
 * @return string
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_get_reading_time' ) ) {
	function spel_get_reading_time( $words_per_minute = 200 ): string {
        $content      = get_post_field( 'post_content', get_the_ID() );
        $word_count   = str_word_count( wp_strip_all_tags( $content ) );
        $reading_time = ceil( $word_count / $words_per_minute );
        $timer        = _n( 'minute', 'minutes', $reading_time, 'spider-elements' );

        return sprintf( '%d %s', $reading_time, $timer );
    }
}

/**
 * Render Dynamic Image
 *
 * @param array  $key
 * @param string $size
 * @param array  $atts
 * @return void
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_dynamic_image' ) ) {
	function spel_dynamic_image( $key, $size = 'full', $atts = [] ): void {
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
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_get_query_post_list' ) ) {
	function spel_get_query_post_list( $post_type = 'any', $limit = -1, $search = '' ): array {
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
 * @param string|null $type
 *
 * @return array
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_get_el_templates' ) ) {
	function spel_get_el_templates( $type = null ): array {
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


/**
 * Get information about the server environment.
 *
 * @return array Server environment information.
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_get_environment_info' ) ) {
	function spel_get_environment_info(): array {

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

        return [
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
        ];

    }
}


/**
 * Convert a human-readable file size into bytes.
 *
 * @param string $size The size string (e.g., "1M", "2G", "500 K").
 * @return int The equivalent size in bytes.
 */
if ( ! function_exists( 'spel_readable_number' ) ) {
	function spel_readable_number( $size ): int {
		$size = trim( $size );
		// Get the last character of the size string
		$suffix = substr( $size, -1 );
		// Remove the last character from the size string
		$value = substr( $size, 0, -1 );
		// Convert suffix to lowercase for case-insensitive comparison
		$suffix = strtolower( $suffix );

		switch ( $suffix ) {
			case 'p':
				$value *= 1024;
				// Fallthrough
			case 't':
				$value *= 1024;
				// Fallthrough
			case 'g':
				$value *= 1024;
				// Fallthrough
			case 'm':
				$value *= 1024;
				// Fallthrough
			case 'k':
				$value *= 1024;
				break;
		}

		// Return the result
		return (int) $value;
	}
}


/**
 * Render pagination
 *
 * @param WP_Query $query
 * @param string   $class
 * @param string   $prev
 * @param string   $next
 * @return void
 * @since 1.0.0
 */
if ( ! function_exists( 'spel_pagination' ) ) {
	function spel_pagination( $query, $class = 'spel-pagination', $prev = '', $next = '' ): void {

        if ( $query->max_num_pages <= 1 ) {
            return; // No pagination needed if only one page
        }

        $default_prev = '<img src="' . esc_url(SPEL_IMG . '/icons/prev.svg') . '" alt="' . esc_attr__('arrow-left',  'spider-elements') . '" class="me-2" />' . esc_html__('Prev',  'spider-elements');
        $default_next = esc_html__('Next',  'spider-elements') . '<img src="' . esc_url(SPEL_IMG . '/icons/next.svg') . '" alt="' . esc_attr__('arrow-right',  'spider-elements') . '" class="ms-2" />';

        $prev_text = !empty($prev) ? $prev : $default_prev;
        $next_text = !empty($next) ? $next : $default_next;

        echo '<ul class="' . esc_attr($class) . '">';

            $big = 999999999; // need an unlikely integer
            $current = max(1, get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1));

            echo wp_kses_post(
                paginate_links( [
                    'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    'format'    => '?paged=%#%',
                    'current'   => $current,
                    'total'     => $query->max_num_pages,
                    'prev_text' => $prev_text,
                    'next_text' => $next_text,
                ] )
            );


        echo '</ul>';
    }
}

/**
 * Jobus pagination (Deprecated)
 *
 * @param WP_Query $query
 * @return void
 * @since 1.0.0
 * @deprecated 1.8.0 No longer needed as we rely on native query handling.
 */
if ( ! function_exists( 'spel_archive_query' ) ) {
	function spel_archive_query( $query ): void {
		// Optimization: Removed unbounded query override to prevent performance issues on archive pages
	}
	// add_action('pre_get_posts', 'spel_archive_query');
}