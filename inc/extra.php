<?php 

/**
 * Elementor Title tags
 */
// function docy_el_title_tags() {
//     return [
//         'h1'  => __( 'H1', 'docy-core' ),
//         'h2' => __( 'H2', 'docy-core' ),
//         'h3' => __( 'H3', 'docy-core' ),
//         'h4' => __( 'H4', 'docy-core' ),
//         'h5' => __( 'H5', 'docy-core' ),
//         'h6' => __( 'H6', 'docy-core' ),
//         'div' => __( 'Div', 'docy-core' ),
//         'span' => __( 'Span', 'docy-core' ),
//         'p' => __( 'Paragraph', 'docy-core' ),
//     ];
// }

/**
 * Day link to archive page
 **/
// function docycore_day_link() {
//     $archive_year   = get_the_time( 'Y' );
//     $archive_month  = get_the_time( 'm' );
//     $archive_day    = get_the_time( 'd' );
//     echo get_day_link( $archive_year, $archive_month, $archive_day);
// }
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
