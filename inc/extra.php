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
