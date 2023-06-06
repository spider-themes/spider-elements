<?php 
$taxonomy = get_terms( array(
    'taxonomy' => 'category',
    'hide_empty' => true,
    'include'   => $settings['cat_name']
) );

$is_collapsed = $settings['collapse_state'] == 'yes' ? 'true' : 'false';
$collapse_class = $settings['collapse_state'] == 'yes' ? '' : 'collapsed';
$is_show = $settings['collapse_state'] == 'yes' ? 'show' : '';
?>

<div class="accordion-article-wrap">
    <?php 
    foreach($taxonomy as $item) :
        $cat_id = $item->slug;
    ?>
    <a class="toggle_btn <?php echo $collapse_class; ?>" data-bs-toggle="collapse" href="#toggle-<?php echo esc_attr( $cat_id ); ?>" role="button" aria-expanded="<?php echo esc_attr($is_collapsed) ?>"
       aria-controls="toggle-<?php echo esc_attr( $cat_id ); ?>">
       <?php echo esc_html( $item->name ); ?>
    </a>
    <div class="collapse multi-collapse <?php echo esc_attr($is_show); ?>" id="toggle-<?php echo esc_attr( $cat_id ); ?>">
        <div class="card-body toggle_body bs-sm">
            <div class="row">
                <?php 
                $cat_posts = get_posts(array(
                    'post_type' => 'post',
                    'numberposts' => -1,
                    'tax_query' => array(
                    array(
                        'taxonomy' => 'category',
                        'field' => 'term_id', 
                        'terms' => $item->term_id,
                        'include_children' => false
                        )
                    )
                ));
                foreach( $cat_posts as $cats ) :
                ?>
                <div class="col-md-4 mt-0">
                    <div class="accordion-article-item">
                        <a href='<?php echo get_the_permalink($cats); ?>'>
                            <h4><?php echo $cats->post_title; ?></h4>
                        </a>
                        <p><?php //echo se_get_the_excerpt_length( $cats, '',12 );  ?></p>
                        <ul class="post-meta list-unstyled">
                            <?php if ( function_exists('spider_reading_time') ) : ?>
                                <li class="reading-titme"> <?php spider_reading_time($cats);?> </li>
                            <?php endif; ?>
                            <li class="reading-titme"> 1 minute </li>
                            <li class="article-date">|</li>
                            <li class="article-date"> <?php echo date( 'F j, Y', strtotime( $cats->post_date ) ); ?></li>
                        </ul>
                    </div>
                </div>
                <?php 
                endforeach; 
                wp_reset_postdata();
                ?>  
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
