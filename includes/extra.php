<?php

use Spider_Elements_Assets\includes\Admin\Module_Settings;

add_image_size( 'spe_270x152', 270, 152, true); // Video Playlist Thumb

/**
 * Constants for widgets badge
 */
if (!defined('SPE_TEXT_BADGE')) {
	define('SPE_TEXT_BADGE', '<span class="spe-text-badge-control">SPIDER</span>');
}



/**
 * @return bool
 * Elementor is edit mode
 */
function spider_elements_is_edit () {
	return \Elementor\Plugin::$instance->editor->is_edit_mode();
}

/**
 * @return bool
 * Elementor is preview mode
 */
function spider_elements_is_preview () {
	return \Elementor\Plugin::$instance->preview->is_preview_mode();
}


/**
 * Elementor Title tags
 */
function spe_el_title_tags() {
    return [
        'h1'  => __( 'H1', 'spider-elements' ),
        'h2' => __( 'H2', 'spider-elements' ),
        'h3' => __( 'H3', 'spider-elements' ),
        'h4' => __( 'H4', 'spider-elements' ),
        'h5' => __( 'H5', 'spider-elements' ),
        'h6' => __( 'H6', 'spider-elements' ),
        'div' => __( 'Div', 'spider-elements' ),
        'span' => __( 'Span', 'spider-elements' ),
        'p' => __( 'Paragraph', 'spider-elements' ),
    ];
}


/**
 * @param $settings_key
 * @param $is_echo
 *
 * The button link
 * @return void
 */
function spe_the_button( $settings_key, $is_echo = true ) {

    if ( $is_echo == true ) {
        echo !empty($settings_key['url']) ? "href='{$settings_key['url']}'" : '';
        echo $settings_key['is_external'] == true ? 'target="_blank"' : '';
        echo $settings_key['nofollow'] == true ? 'rel="nofollow"' : '';

        if ( !empty($settings_key['custom_attributes']) ) {
            $attrs = explode(',', $settings_key['custom_attributes']);

            if(is_array($attrs)){
                foreach($attrs as $data) {
                    $data_attrs = explode('|', $data);
                    echo esc_attr( $data_attrs[0].'='.$data_attrs[1] );
                }
            }
        }
    }

}


/**
 * Day link to archive page
 **/
function spe_day_link() {
    $archive_year   = get_the_time( 'Y' );
    $archive_month  = get_the_time( 'm' );
    $archive_day    = get_the_time( 'd' );
    echo get_day_link( $archive_year, $archive_month, $archive_day);
}


/**
 * Category IDs
 * @return array
 */
function spe_cat_ids(){
    $taxonomys = get_terms( array(
        'taxonomy' => 'category',
        'hide_empty' => true,
    ) );
    $taxonomy = [];
	if ( is_array($taxonomys) ) {
		foreach ( $taxonomys as $cat_id ) {
			$taxonomy[ $cat_id->term_id ] = $cat_id->name;
		}
	}

    return $taxonomy;
}


/**
 * Get title excerpt length
 * @param $settings
 * @param $settings_key
 * @param int $default
 * @return string|void
 */
function spe_get_the_title_length ( $settings, $settings_key, $default = 10 ) {

    $title_length = !empty($settings[$settings_key]) ? $settings[$settings_key] : $default;
    $title = get_the_title() ? wp_trim_words(get_the_title(), $title_length, '') : the_title();
    return $title;
}


/**
 * Post's excerpt text
 * @param $settings_key
 * @param bool $echo
 * @return string
 **/
function spe_get_the_excerpt_length ( $settings, $settings_key, $default = 10 ) {

    $excerpt_length = !empty($settings[$settings_key]) ? $settings[$settings_key] : $default;
    $excerpt = get_the_excerpt() ? wp_trim_words(get_the_excerpt(), $excerpt_length, '...') : wp_trim_words(get_the_content(), $excerpt_length, '...');

    return $excerpt;
}


/**
 * Get the first category name
 * @param string $term
 * @return string
 */
function spe_get_the_first_taxonomy( $term = 'category' ) {
    $cats = get_the_terms(get_the_ID(), $term);
    $cat  = is_array($cats) ? $cats[0]->name : '';
    return esc_html($cat);
}


/**
 * Get the first category link
 * @param string $term
 * @return string
 */
function spe_get_the_first_taxonomy_link( $term = 'category' ) {

	$cats = get_the_terms(get_the_ID(), $term);
    $cat  = is_array($cats) ? get_category_link($cats[0]->term_id) : '';

	return esc_url($cat);
}


/**
 * Get categories array
 * @param string $term
 * @return array
 */
function spe_get_the_categories ( $term = 'category' ) {

    $cats = get_terms( array(
        'taxonomy' => $term,
        'hide_empty' => true
    ));

    $cat_array = [];
    $cat_array['all'] = esc_html__('All', 'spider-elements');

	if ( is_array($cats) ) {
		foreach ( $cats as $cat ) {
			$cat_array[ $cat->term_id ] = $cat->name;
		}
	}

    return $cat_array;
}


/**
 * Get categories list
 * @param string $term
 * @return string
 */
function spe_get_post_category_list() {
    $categories = get_categories();

    if ( ! empty( $categories ) ) {
        echo '<span class="blog-category">';

        $category_names = array();

	    if ( is_array($categories) ) {
		    foreach ( $categories as $category ) {
			    $category_link    = get_category_link( $category->term_id );
			    $category_names[] = '<a href="' . esc_url( $category_link ) . '">' . esc_html( $category->name ) . '</a>';
		    }
	    }

        echo implode(', ', $category_names);

        echo '</span>';
    } else {
        echo esc_html__('No categories found.', 'spider-elements');
    }
}

/**
 * Get reading time
 * @param string $term
 * @return string
 */
function spe_get_reading_time($words_per_minute) {
    $post_content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count($post_content);
    $reading_time = ceil($word_count / $words_per_minute);
    $formatted_reading_time = $reading_time . ' min read';

    return $formatted_reading_time;
}

/**
 * Get author name array
 * @param string $term
 * @return array
 */

function spe_posted_by() {
    global $post;
    $byline = sprintf(
        /* translators: %s: post author. */
        esc_html_x( '%s', 'post author', 'jobi' ),
        '<span class="author">By: <a class="url fn n" href="' . esc_url( get_author_posts_url( $post->post_author) ) . '">' . esc_html(get_the_author_meta( 'display_name',$post->post_author) ) . '</a></span>'
    );

    echo wp_kses_post($byline) ; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Get Default Image Elementor
 * @param $settins_key
 * @param string $class
 * @param string $alt
 */
function spe_el_image( $settings_key = '', $alt = '', $class = '', $atts = [] ) {
    if ( !empty($settings_key['id']) ) {
        echo wp_get_attachment_image( $settings_key['id'], 'full', '', array('class' => $class) );
    }
    elseif ( !empty($settings_key['url']) && empty($settings_key['id']) ) {
        $class = !empty($class) ? "class='$class'" : '';
        $attss = '';
        if ( !empty($atts) ) {
            foreach ( $atts as $k => $att ) {
                $attss .= "$k=". "'$att'";
            }
        }
        echo "<img src='{$settings_key['url']}' $class alt='$alt' $attss>";
    }
}


/**
 * Get Default Image Elementor
 * @param $settins_key
 * @param string $class
 * @param string $alt
 */
function spe_el_image_caption( $image_id = '' ) {
	$img_attachment = get_post( $image_id );
	return array(
		'alt' => get_post_meta( $img_attachment->ID, '_wp_attachment_image_alt', true ),
		'caption' => $img_attachment->post_excerpt,
		'href' => get_permalink( $img_attachment->ID ),
		'src' => $img_attachment->guid,
		'title' => $img_attachment->post_title
	);
}



/**
 * @param string  $content Text content to filter.
 * @return string Filtered content containing only the allowed HTML.
 */
function spe_get_the_kses_post($content) {
    $allowed_tag = array(
        'strong' => [],
        'br' => [],
        'p' => [
            'class' => [],
            'style' => [],
        ],
        'i' => [
            'class' => [],
            'style' => [],
        ],
        'ul' => [
            'class' => [],
            'style' => [],
        ],
        'li' => [
            'class' => [],
            'style' => [],
        ],
        'span' => [
            'class' => [],
            'style' => [],
        ],
        'a' => [
            'href' => [],
            'class' => [],
            'title' => []
        ],
        'div' => [
            'class' => [],
            'style' => [],
        ],
        'h1' => [
            'class' => [],
            'style' => []
        ],
        'h2' => [
            'class' => [],
            'style' => []
        ],
        'h3' => [
            'class' => [],
            'style' => []
        ],
        'h4' => [
            'class' => [],
            'style' => []
        ],
        'h5' => [
            'class' => [],
            'style' => []
        ],
        'h6' => [
            'class' => [],
            'style' => []
        ],
        'img' => [
            'class' => [],
            'style' => [],
            'height' => [],
            'width' => [],
            'src' => [],
            'srcset' => [],
            'alt' => [],
        ],

    );
    return wp_kses($content, $allowed_tag);
}


/**
 * Event Tab data
 * @param $getCats
 * @param $event_schedule_cats
 * @return array
 */
function spe_return_tab_data( $getCats, $event_schedule_cats ) {
    $y = [];
    foreach ( $getCats as $val ) {

        $t = [];
        foreach( $event_schedule_cats as $data ) {
            if( $data['tab_title'] == $val ) {
                $t[] = $data;
            }
        }
        $y[$val] = $t;
    }

    return $y;
}


/**
 * estimated reading time
 **/
function spe_get_the_reading_time($minute_label = 'minute', $minutes_label = 'minutes') {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $readingtime = ceil($word_count / 200);
    if ($readingtime == 1) {
        $timer = esc_html__( " {$minute_label}", 'spider-elements' );
    } else {
        $timer = esc_html__( " {$minutes_label}", 'spider-elements' );
    }

    $totalreadingtime = $readingtime . $timer;

    return $totalreadingtime;
}

/**
 * Get all elementor page templates
 *
 * @param  null  $type
 *
 * @return array
 */
function spe_get_el_templates($type = null)
{
	$options = [];

	if ($type) {
		$args = [
			'post_type' => 'elementor_library',
			'posts_per_page' => -1,
		];
		$args['tax_query'] = [
			[
				'taxonomy' => 'elementor_library_type',
				'field' => 'slug',
				'terms' => $type,
			],
		];

		$page_templates = get_posts($args);

		if (!empty($page_templates) && !is_wp_error($page_templates)) {
			foreach ($page_templates as $post) {
				$options[$post->ID] = $post->post_title;
			}
		}
	} else {
		$options = spe_get_query_post_list('elementor_library');
	}

	return $options;
}


/**
 * @param string $post_type
 * @param int $limit
 * @param string $search
 * @return array
 */
function spe_get_query_post_list($post_type = 'any', $limit = -1, $search = '') {
	global $wpdb;
	$where = '';
	$data = [];

	if (-1 == $limit) {
		$limit = '';
	} elseif (0 == $limit) {
		$limit = "limit 0,1";
	} else {
		$limit = $wpdb->prepare(" limit 0,%d", esc_sql($limit));
	}

	if ('any' === $post_type) {
		$in_search_post_types = get_post_types(['exclude_from_search' => false]);
		if (empty($in_search_post_types)) {
			$where .= ' AND 1=0 ';
		} else {
			$where .= " AND {$wpdb->posts}.post_type IN ('" . join("', '",
					array_map('esc_sql', $in_search_post_types)) . "')";
		}
	} elseif (!empty($post_type)) {
		$where .= $wpdb->prepare(" AND {$wpdb->posts}.post_type = %s", esc_sql($post_type));
	}

	if (!empty($search)) {
		$where .= $wpdb->prepare(" AND {$wpdb->posts}.post_title LIKE %s", '%' . esc_sql($search) . '%');
	}

	$query = "select post_title,ID  from $wpdb->posts where post_status = 'publish' $where $limit";
	$results = $wpdb->get_results($query);
	if (!empty($results)) {
		foreach ($results as $row) {
			$data[$row->ID] = $row->post_title;
		}
	}
	return $data;
}

/*
add_action('admin_head', function () {

	echo 'Hello sdfdsf';
	echo get_option('spider_elements_save_settings');

	update_post_meta(1, 'docy_accordion', 1);
	echo get_post_meta(1, 'docy_accordion', true);

});*/


add_action('admin_head', function() {

	$elements = Module_Settings::get_widget_settings();
	$names = array(); // Create an array to store the 'name' values

	/*if (!empty($elements)) {
		foreach ($elements as $element) {
			if (is_array($element)) {
				foreach ($element as $k => $v) {
					if ($k == 'name') {
						$names[$v] = $v; // Add the 'name' value to the $names array
					}
				}
			}
		}
	}*/

	if ( isset($_POST['elements-submit'])) {
		$elements = Module_Settings::get_widget_settings();

	}

	echo '<pre>';
	print_r($names);
	echo '</pre>';

	// Now you can save the serialized names into an option
	update_option('spider_elements_names_option', $names);

});