<?php 

/**
 * Elementor Title tags
 */
function docy_el_title_tags() {
    return [
        'h1'  => __( 'H1', 'docy-core' ),
        'h2' => __( 'H2', 'docy-core' ),
        'h3' => __( 'H3', 'docy-core' ),
        'h4' => __( 'H4', 'docy-core' ),
        'h5' => __( 'H5', 'docy-core' ),
        'h6' => __( 'H6', 'docy-core' ),
        'div' => __( 'Div', 'docy-core' ),
        'span' => __( 'Span', 'docy-core' ),
        'p' => __( 'Paragraph', 'docy-core' ),
    ];
}

/**
 * Day link to archive page
 **/
function docycore_day_link() {
    $archive_year   = get_the_time( 'Y' );
    $archive_month  = get_the_time( 'm' );
    $archive_day    = get_the_time( 'd' );
    echo get_day_link( $archive_year, $archive_month, $archive_day);
}
/**
 * Category IDs
 * @return array
 */
function docy_cat_ids(){
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
 * Post's excerpt text
 * @param $settings_key
 * @param bool $echo
 * @return string
 **/
function spider_excerpt($settings_key, $limit = 10) {
    echo wp_trim_words( wpautop( get_the_excerpt( $settings_key ) ), $limit, '');
}


/**
 * Event Tab data
 * @param $getCats
 * @param $event_schedule_cats
 * @return array
 */
function return_tab_data( $getCats, $event_schedule_cats ) {
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
 * Get Default Image Elementor
 * @param $settins_key
 * @param string $class
 * @param string $alt
 */
function landpagy_el_image( $settings_key = '', $alt = '', $class = '' ) {
    if ( !empty($settings_key['id']) ) {
        echo wp_get_attachment_image($settings_key['id'], 'full', '', array( 'class' => $class ));
    }
    elseif ( !empty($settings_key['url']) && empty($settings_key['id']) ) {
        $class = !empty($class) ? "class='$class'" : '';
        echo "<img src='{$settings_key['url']}' $class alt='$alt'>";
    }
}
/**
 * Elementor URL field output
 * @param $settings_key
 * @param bool $echo
 * @return string
 */
function docy_el_btn( $settings_key, $echo = true ) {
    if ( $echo == true ) {
        echo $settings_key['is_external'] == true ? 'target="_blank"' : '';
        echo $settings_key['nofollow'] == true ? 'rel="nofollow"' : '';
        echo !empty($settings_key['url']) ? 'href="'.esc_url($settings_key['url']).'"' : '';
    } else {
        $output = $settings_key['is_external'] == true ? 'target="_blank"' : '';
        $output .= $settings_key['nofollow'] == true ? 'rel="nofollow"' : '';
        $output .= !empty($settings_key['url']) ? 'href="'.esc_url($settings_key['url']).'"' : '';
        return $output;
    }
}

// Arrow icon left right position
function docycore_arrow_left_right() {
    $arrow_icon = is_rtl() ? 'arrow_left' : 'arrow_right';
    echo esc_attr($arrow_icon);
}

/**
 * Get Default Image Elementor
 * @param $settins_key
 * @param string $class
 * @param string $alt
 */
function docy_el_image( $settings_key = '', $alt = '', $class = '', $atts = [] ) {
    if ( !empty($settings_key['id']) ) {
        echo wp_get_attachment_image( $settings_key['id'], 'full', '', array('class' => $class) );
    }
    elseif ( !empty($settings_key['url']) && empty($settings_key['id']) ) {
        $class = !empty($class) ? "class='$class'" : '';
        $attss = '';
        //echo print_r($atts);
        if ( !empty($atts) ) {
            foreach ( $atts as $k => $att ) {
                $attss .= "$k=". "'$att'";
            }
        }
        echo "<img src='{$settings_key['url']}' $class alt='$alt' $attss>";
    }
}
