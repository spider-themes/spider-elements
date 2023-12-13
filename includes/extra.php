<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Elementor Title tags
 */
function spel_el_title_tags() {
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


/**
 * @param $settings_key
 * @param $is_echo
 *
 * The button link
 *
 * @return void
 */
function spel_the_button( $settings_key, $is_echo = true ) {

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
function spel_day_link() {
	$archive_year  = get_the_time( 'Y' );
	$archive_month = get_the_time( 'm' );
	$archive_day   = get_the_time( 'd' );
	echo esc_url(get_day_link( $archive_year, $archive_month, $archive_day ));
}


/**
 * Get the first category name
 *
 * @param string $term
 *
 * @return string
 */
function spel_get_the_first_taxonomy( $term = 'category' ) {
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
function spel_get_the_first_taxonomy_link( $term = 'category' ) {

	$cats = get_the_terms( get_the_ID(), $term );
	$cat  = is_array( $cats ) ? get_category_link( $cats[0]->term_id ) : '';

	return esc_url( $cat );
}

/**
 * Get reading time
 *
 * @param string $term
 *
 * @return string
 */
function spel_get_reading_time( $words_per_minute = '200' ) {

    $content     = get_post_field( 'post_content', get_the_ID() );
    $word_count  = str_word_count( strip_tags( $content ) );
    $reading_time = ceil( $word_count / $words_per_minute );
    if ( $reading_time == 1 ) {
        $timer = esc_html__( 'minute', 'spider-elements' );
    } else {
        $timer = esc_html__( 'minutes', 'spider-elements' );
    }

    $total_reading_time = $reading_time . $timer;

    return $total_reading_time;

}

/**
 * Get author name array
 *
 * @param string $term
 *
 * @return array
 */
function spel_posted_by() {
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
 * @param string $content Text content to filter.
 *
 * @return string Filtered content containing only the allowed HTML.
 */
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


/**
 * Event Tab data
 *
 * @param $getCats
 * @param $event_schedule_cats
 *
 * @return array
 */
function spel_return_tab_data( $getCats, $event_schedule_cats ) {
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
 * @param string $post_type
 * @param int $limit
 * @param string $search
 *
 * @return array
 */
function spel_get_query_post_list( $post_type = 'any', $limit = - 1, $search = '' ) {
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
function spel_get_el_templates( $type = null ) {
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
		$options = spel_get_query_post_list( 'elementor_library' );
	}

	return $options;
}