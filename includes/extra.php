<?php
add_image_size( 'se_370x300', 370, 300, true); // Screenshot carousel style 6
add_image_size( 'se_70x70', 70, 70, true); // Recent posts thumbnail
add_image_size( 'se_16x16', 16, 16, true); // Forums list widget forum thumbnail image
add_image_size( 'se_60x40', 60, 40, true); // Forums list widget forum thumbnail image
add_image_size( 'se_270x152', 270, 152, true); // Forums list widget forum thumbnail image
add_image_size( 'se_671x411', 671, 411, true); // Video Carousel Thumb Single
add_image_size( 'se_40x40', 40, 40, true); // Forum user image

add_image_size( 'se_370x300', 370, 300, true); // Screenshot carousel style 6
add_image_size( 'se_70x70', 70, 70, true); // Recent posts thumbnail
add_image_size( 'se_16x16', 16, 16, true); // Forums list widget forum thumbnail image
add_image_size( 'se_60x40', 60, 40, true); // Forums list widget forum thumbnail image
add_image_size( 'se_270x152', 270, 152, true); // Forums list widget forum thumbnail image
add_image_size( 'se_671x411', 671, 411, true); // Video Carousel Thumb Single
add_image_size( 'se_40x40', 40, 40, true); // Forum user image
add_image_size( 'se_270x152px', 270, 152,  true );

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
    $cat_array['all'] = esc_html__('All', 'landpagy-core');

    foreach ($cats as $cat) {
        $cat_array[$cat->term_id] = $cat->name;
    }

    return $cat_array;
}

/**
 * @param $html_data
 * @return mixed
 */
function html_return($html_data) {
    return $html_data;
}


/**
 * Get Default Image Elementor
 * @param $settins_key
 * @param string $class
 * @param string $alt
 */
function se_el_image( $settings_key = '', $alt = '', $class = '' ) {
    if ( !empty($settings_key['id']) ) {
        echo wp_get_attachment_image($settings_key['id'], 'full', '', array( 'class' => $class ));
    }
    elseif ( !empty($settings_key['url']) && empty($settings_key['id']) ) {
        $class = !empty($class) ? "class='$class'" : '';
        echo "<img src='{$settings_key['url']}' $class alt='$alt'>";
    }
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
function spider_el_image( $settings_key = '', $alt = '', $class = '', $atts = [] ) {
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
function get_the_reading_time() {
    $content = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $readingtime = ceil($word_count / 200);
    if ($readingtime == 1) {
        $timer = esc_html__( " minute read", 'landpagy' );
    } else {
        $timer = esc_html__( " minutes read", 'landpagy' );
    }

    $totalreadingtime = $readingtime . $timer;

    return $totalreadingtime;
}


function get_contact_form7() {

    $forms = get_posts(array(
        'post_type' => 'wpcf7_contact_form',
        'posts_per_page' => -1,
    ));

    $results = [];
    if ( $forms ) {
        $results[] = __( 'Select A Form', 'landpagy-core' );
        foreach ( $forms as $form ) {
            $results[ $form->ID ] = $form->post_title;
        }
    } else {
        $results[] =  __( 'No contact forms found', 'hostim-core' ) ;
    }

    return $results;
}