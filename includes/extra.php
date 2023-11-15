<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Spider_Elements_Assets\includes\Admin\Module_Settings;

add_image_size( 'spe_270x152', 270, 152, true ); // Video Playlist Thumb
add_image_size( 'spe_120x70', 120, 70, true ); // Fullscreen slider Thumb 01

/**
 * Constants for widgets badge
 */
if ( ! defined( 'SPE_TEXT_BADGE' ) ) {
	define(
		'SPE_TEXT_BADGE',
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
function spe_el_title_tags() {
	return [
		'h1'   => __( 'H1', 'spider-elements' ),
		'h2'   => __( 'H2', 'spider-elements' ),
		'h3'   => __( 'H3', 'spider-elements' ),
		'h4'   => __( 'H4', 'spider-elements' ),
		'h5'   => __( 'H5', 'spider-elements' ),
		'h6'   => __( 'H6', 'spider-elements' ),
		'div'  => __( 'Div', 'spider-elements' ),
		'span' => __( 'Span', 'spider-elements' ),
		'p'    => __( 'Paragraph', 'spider-elements' ),
	];
}


/**
 * @param $settings_key
 * @param $is_echo
 *
 * The button link
 *
 * @return void
 */
function spe_the_button( $settings_key, $is_echo = true ) {

	if ( $is_echo == true ) {
		echo ! empty( $settings_key['url'] ) ? "href='{$settings_key['url']}'" : '';
		echo $settings_key['is_external'] ? 'target="_blank"' : '';
		echo $settings_key['nofollow'] ? 'rel="nofollow"' : '';

		if ( ! empty( $settings_key['custom_attributes'] ) ) {
			$attrs = explode( ',', $settings_key['custom_attributes'] );

			if ( is_array( $attrs ) ) {
				foreach ( $attrs as $data ) {
					$data_attrs = explode( '|', $data );
					echo esc_attr( $data_attrs[0] . '=' . $data_attrs[1] );
				}
			}
		}
	}
}


/**
 * Day link to archive page
 **/
function spe_day_link() {
	$archive_year  = get_the_time( 'Y' );
	$archive_month = get_the_time( 'm' );
	$archive_day   = get_the_time( 'd' );
	echo get_day_link( $archive_year, $archive_month, $archive_day );
}


/**
 * Category IDs
 * @return array
 */
function spe_cat_ids() {
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


/**
 * Get title excerpt length
 *
 * @param $settings
 * @param $settings_key
 * @param int $default
 *
 * @return string|void
 */
function spe_get_the_title_length( $settings, $settings_key, $default = 10 ) {

	$title_length = ! empty( $settings[ $settings_key ] ) ? $settings[ $settings_key ] : $default;
	$title        = get_the_title() ? wp_trim_words( get_the_title(), $title_length, '' ) : the_title();

	return $title;
}


/**
 * Post's excerpt text
 *
 * @param $settings_key
 * @param bool $echo
 *
 * @return string
 **/
function spe_get_the_excerpt_length( $settings, $settings_key, $default = 10 ) {

	$excerpt_length = ! empty( $settings[ $settings_key ] ) ? $settings[ $settings_key ] : $default;
	$excerpt        = get_the_excerpt() ? wp_trim_words(
		get_the_excerpt(),
		$excerpt_length,
		'...'
	) : wp_trim_words( get_the_content(), $excerpt_length, '...' );

	return $excerpt;
}


/**
 * Get the first category name
 *
 * @param string $term
 *
 * @return string
 */
function spe_get_the_first_taxonomy( $term = 'category' ) {
	$cats = get_the_terms( get_the_ID(), $term );
	$cat  = is_array( $cats ) ? $cats[0]->name : '';

	return esc_html( $cat );
}


/**
 * Get the first category link
 *
 * @param string $term
 *
 * @return string
 */
function spe_get_the_first_taxonomy_link( $term = 'category' ) {

	$cats = get_the_terms( get_the_ID(), $term );
	$cat  = is_array( $cats ) ? get_category_link( $cats[0]->term_id ) : '';

	return esc_url( $cat );
}


/**
 * Get categories array
 *
 * @param string $term
 *
 * @return array
 */
function spe_get_the_categories( $term = 'category' ) {

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


/**
 * Get categories list
 *
 * @param string $term
 *
 * @return string
 */
function spe_get_post_category_list() {
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

/**
 * Get reading time
 *
 * @param string $term
 *
 * @return string
 */
function spe_get_reading_time( $words_per_minute ) {
	$post_content           = get_post_field( 'post_content', get_the_ID() );
	$word_count             = str_word_count( $post_content );
	$reading_time           = ceil( $word_count / $words_per_minute );
	$formatted_reading_time = $reading_time . esc_html__( ' min read', 'spider-elements' );

	return $formatted_reading_time;
}

/**
 * Get author name array
 *
 * @param string $term
 *
 * @return array
 */
function spe_posted_by() {
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

/**
 * Get Default Image Elementor
 *
 * @param $settins_key
 * @param string $class
 * @param string $alt
 */
function spe_el_image( $settings_key = '', $alt = '', $class = '', $atts = [] ) {
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


/**
 * Get Default Image Elementor
 *
 * @param $settins_key
 * @param string $class
 * @param string $alt
 */
function spe_el_image_caption( $image_id = '' ) {
	$img_attachment = get_post( $image_id );

	return array(
		'alt'     => get_post_meta( $img_attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $img_attachment->post_excerpt,
		'href'    => get_permalink( $img_attachment->ID ),
		'src'     => $img_attachment->guid,
		'title'   => $img_attachment->post_title
	);
}


/**
 * @param string $content Text content to filter.
 *
 * @return string Filtered content containing only the allowed HTML.
 */
function spe_kses_post( $content ) {
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


/**
 * Event Tab data
 *
 * @param $getCats
 * @param $event_schedule_cats
 *
 * @return array
 */
function spe_return_tab_data( $getCats, $event_schedule_cats ) {
	$y = [];
	foreach ( $getCats as $val ) {

		$t = [];
		foreach ( $event_schedule_cats as $data ) {
			if ( $data['tab_title'] == $val ) {
				$t[] = $data;
			}
		}
		$y[ $val ] = $t;
	}

	return $y;
}


/**
 * estimated reading time
 **/
function spe_get_the_reading_time() {
	$content     = get_post_field( 'post_content', get_the_ID() );
	$word_count  = str_word_count( strip_tags( $content ) );
	$readingtime = ceil( $word_count / 200 );
	if ( $readingtime == 1 ) {
		$timer = esc_html__( 'minute', 'spider-elements' );
	} else {
		$timer = esc_html__( 'minutes', 'spider-elements' );
	}

	$totalreadingtime = $readingtime . $timer;

	return $totalreadingtime;
}


/**
 * @param string $post_type
 * @param int $limit
 * @param string $search
 *
 * @return array
 */
function spe_get_query_post_list( $post_type = 'any', $limit = - 1, $search = '' ) {
	global $wpdb;
	$where = '';
	$data  = [];

	if ( - 1 == $limit ) {
		$limit = '';
	} elseif ( 0 == $limit ) {
		$limit = $wpdb->prepare( "LIMIT %d,1", 0 );
	} else {
		$limit = $wpdb->prepare( "LIMIT %d,%d", 0, esc_sql( $limit ) );
	}

	if ( 'any' === $post_type ) {
		$in_search_post_types = get_post_types( [ 'exclude_from_search' => false ] );
		if ( empty( $in_search_post_types ) ) {
			$where .= ' AND 1=0 ';
		} else {
			$placeholders                     = array_fill( 0, count( $in_search_post_types ), '%s' );
			$in_search_post_types             = array_map( 'esc_sql', $in_search_post_types );
			$in_search_post_types_placeholder = implode( ', ', $placeholders );
			$where                            .= $wpdb->prepare( " AND {$wpdb->posts}.post_type IN ($in_search_post_types_placeholder)", ...$in_search_post_types );
		}
	} elseif ( ! empty( $post_type ) ) {
		$where .= $wpdb->prepare( " AND {$wpdb->posts}.post_type = %s", esc_sql( $post_type ) );
	}

	if ( ! empty( $search ) ) {
		$search_term = '%' . esc_sql( $search ) . '%';
		$where       .= $wpdb->prepare( " AND {$wpdb->posts}.post_title LIKE %s", $search_term );
	}

	$query   = $wpdb->prepare( "SELECT post_title, ID FROM $wpdb->posts WHERE post_status = %s $where $limit", 'publish' );
	$results = $wpdb->get_results( $query );
	if ( ! empty( $results ) ) {
		foreach ( $results as $row ) {
			$data[ $row->ID ] = $row->post_title;
		}
	}

	return $data;
}


/**
 * Get all elementor page templates
 *
 * @param null $type
 *
 * @return array
 */
function spe_get_el_templates( $type = null ) {
	$options = [];

	if ( $type ) {
		$args              = [
			'post_type'      => 'elementor_library',
			'posts_per_page' => - 1,
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
		$options = spe_get_query_post_list( 'elementor_library' );
	}

	return $options;
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
		);

		// Save the data in the options table using update_option
		update_option( 'spe_widget_settings', $data );

	}

} );

/**
 * Get information about the server environment.
 *
 * @return array Server environment information.
 */
function spe_get_environment_info() {

    // Figure out cURL version, if installed.
    $curl_version = '';
    if ( function_exists( 'curl_version' ) ) {
        $curl_version = curl_version();
        $curl_version = $curl_version['version'] . ', ' . $curl_version['ssl_version'];
    }

    // WP memory limit.
    $wp_memory_limit = spe_readable_number(WP_MEMORY_LIMIT);
    if ( function_exists( 'memory_get_usage' ) ) {
        $wp_memory_limit = max( $wp_memory_limit, spe_readable_number( @ini_get( 'memory_limit' ) ) );
    }

    return array(
        'home_url'                  => get_option( 'home' ),
        'site_url'                  => get_option( 'siteurl' ),
        'version'                   => SPE_VERSION,
        'wp_version'                => get_bloginfo( 'version' ),
        'wp_multisite'              => is_multisite(),
        'wp_memory_limit'           => $wp_memory_limit,
        'wp_debug_mode'             => ( defined( 'WP_DEBUG' ) && WP_DEBUG ),
        'wp_cron'                   => ! ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ),
        'language'                  => get_locale(),
        'external_object_cache'     => wp_using_ext_object_cache(),
        'server_info'               => isset( $_SERVER['SERVER_SOFTWARE'] ) ? wp_unslash( $_SERVER['SERVER_SOFTWARE'] ) : '',
        'php_version'               => phpversion(),
        'php_post_max_size'         => spe_readable_number( ini_get( 'post_max_size' ) ),
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


/**
 * Convert a human-readable file size into bytes.
 *
 * @param string $size The size string (e.g., "1M", "2G", "500K").
 * @return int The equivalent size in bytes.
 */
function spe_readable_number( $size ) {

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
    return (int) $value;

}