<?php
add_image_size( 'se_270x152', 270, 152, true); // Video Playlist Thumb

/**
 * Elementor Title tags
 */
function se_el_title_tags() {
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
function se_the_button( $settings_key, $is_echo = true ) {

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
function se_day_link() {
    $archive_year   = get_the_time( 'Y' );
    $archive_month  = get_the_time( 'm' );
    $archive_day    = get_the_time( 'd' );
    echo get_day_link( $archive_year, $archive_month, $archive_day);
}


/**
 * Category IDs
 * @return array
 */
function se_cat_ids(){
    $taxonomys = get_terms( array(
        'taxonomy' => 'category',
        'hide_empty' => true,
    ) );
    $taxonomy = [];
    foreach( $taxonomys as $cat_id){
        $taxonomy[$cat_id->term_id]= $cat_id->name;    
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
function se_get_the_title_length ( $settings, $settings_key, $default = 10 ) {

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
function se_get_the_excerpt_length ( $settings, $settings_key, $default = 10 ) {

    $excerpt_length = !empty($settings[$settings_key]) ? $settings[$settings_key] : $default;
    $excerpt = get_the_excerpt() ? wp_trim_words(get_the_excerpt(), $excerpt_length, '...') : wp_trim_words(get_the_content(), $excerpt_length, '...');

    return $excerpt;
}


/**
 * Get the first category name
 * @param string $term
 * @return string
 */
function se_get_the_first_taxonomy( $term = 'category' ) {
    $cats = get_the_terms(get_the_ID(), $term);
    $cat  = is_array($cats) ? $cats[0]->name : '';
    return esc_html($cat);
}


/**
 * Get the first category link
 * @param string $term
 * @return string
 */
function se_get_the_first_taxonomy_link( $term = 'category' ) {

	$cats = get_the_terms(get_the_ID(), $term);
    $cat  = is_array($cats) ? get_category_link($cats[0]->term_id) : '';

	return esc_url($cat);
}


/**
 * Get categories array
 * @param string $term
 * @return array
 */
function se_get_the_categories ( $term = 'category' ) {

    $cats = get_terms( array(
        'taxonomy' => $term,
        'hide_empty' => true
    ));

    $cat_array = [];
    $cat_array['all'] = esc_html__('All', 'spider-elements');

    foreach ($cats as $cat) {
        $cat_array[$cat->term_id] = $cat->name;
    }

    return $cat_array;
}

/**
 * Get author name array
 * @param string $term
 * @return array
 */

function se_posted_by() {
    global $post;
    $byline = sprintf(
        /* translators: %s: post author. */
        esc_html_x( '%s', 'post author', 'jobi' ),
        '<span class="author">By: <a class="url fn n" href="' . esc_url( get_author_posts_url( $post->post_author) ) . '">' . esc_html(get_the_author_meta( 'display_name',$post->post_author) ) . '</a></span>'
    );

    echo $byline ; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}



/**
 * @param $html_data
 * @return mixed
 */
function se_html_return($html_data) {
    return $html_data;
}


// Arrow icon left right position
function se_arrow_left_right() {
    $arrow_icon = is_rtl() ? 'arrow_left' : 'arrow_right';
    echo esc_attr($arrow_icon);
}


/**
 * Get Default Image Elementor
 * @param $settins_key
 * @param string $class
 * @param string $alt
 */
function se_el_image( $settings_key = '', $alt = '', $class = '', $atts = [] ) {
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
function se_el_image_caption( $image_id = '' ) {
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
function se_get_the_kses_post($content) {
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
function se_return_tab_data( $getCats, $event_schedule_cats ) {
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
function se_get_the_reading_time($minute_label = 'minute', $minutes_label = 'minutes') {
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
 * Get all contact form 7
 *
 * @return array
 */
function se_get_contact_form7() {

    $forms = get_posts(array(
        'post_type' => 'wpcf7_contact_form',
        'posts_per_page' => -1,
    ));

    $results = [];
    if ( $forms ) {
        $results[] = __( 'Select A Form', 'spider-elements' );
        foreach ( $forms as $form ) {
            $results[ $form->ID ] = $form->post_title;
        }
    } else {
        $results[] =  __( 'No contact forms found', 'hostim-core' ) ;
    }

    return $results;
}


/**
 * Get all elementor page templates
 *
 * @param  null  $type
 *
 * @return array
 */
function se_get_el_templates($type = null)
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
		$options = se_get_query_post_list('elementor_library');
	}

	return $options;
}


/**
 * @param string $post_type
 * @param int $limit
 * @param string $search
 * @return array
 */
function se_get_query_post_list($post_type = 'any', $limit = -1, $search = '') {
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


/**
 * Add new font group (Custom) to the top of the list
 */
add_filter( 'elementor/fonts/groups', function( $font_groups ) {
    $se_font_group = array( 'se_custom_font' => __( 'Se Custom Font' ) );
    return array_merge( $se_font_group, $font_groups );
} );

/**
 * Add fonts to the new font group
 */
add_filter( 'elementor/fonts/additional_fonts', function( $additional_fonts ) {
    //Font name/font group
    $additional_fonts['gordita'] = 'se_custom_font';
    return $additional_fonts;

} );