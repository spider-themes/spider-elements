<div class="accordion-article-wrap">
    <?php
    if ( is_array( $taxonomy ) && count ( $taxonomy) > 0 ) {
        foreach ( $taxonomy as $key => $item ) {
	        $cat_id = $item->slug;
            ?>
            <a class="toggle_btn se_tab_title <?php echo $collapse_class; ?>" data-bs-toggle="collapse" href="#toggle-<?php echo esc_attr( $cat_id ); ?>" role="button" aria-expanded="<?php echo esc_attr($is_collapsed) ?>"
               aria-controls="toggle-<?php echo esc_attr( $cat_id ); ?>">
		        <?php echo esc_html( $item->name ); ?>
            </a>
            <div class="collapse multi-collapse <?php echo esc_attr($is_show); ?>" id="toggle-<?php echo esc_attr( $cat_id ); ?>">
                <div class="card-body toggle_body bs-sm">
                    <div class="row">
				        <?php
				        $args = [
					        'post_type' => 'post',
					        'post_status' => 'publish',
				        ];
                        if ( !empty($show_count) ) {
					        $args['posts_per_page'] = $show_count;
				        }

				        if ( !empty($order) ) {
					        $args['order'] = $order;
				        }

				        if ( !empty($orderby) ) {
					        $args['orderby'] = $orderby;
				        }

				        if ( !empty($exclude) ) {
					        $args['post__not_in'] = $exclude;
				        }

				        $args['tax_query'] = [
					        [
						        'taxonomy' => 'category',
						        'field'    => 'term_id',
						        'terms' => $item->term_id,
						        'include_children' => false
					        ]
				        ];

				        $cat_posts = new \WP_Query( $args );

                        while ( $cat_posts->have_posts() ) : $cat_posts->the_post();
                            ?>
                            <div class="col-md-4">
                                <div class="accordion-article-item se_accordion_item">
                                    <a href='<?php the_permalink(); ?>'>
                                        <h4><?php echo se_get_the_title_length( $settings, 'title_length' );  ?></h4>
                                    </a>
                                    <p><?php echo se_get_the_excerpt_length( $settings, 'excerpt_length' );  ?></p>
                                    <ul class="post-meta list-unstyled">
                                        <li class="reading-titme"><?php echo se_get_the_reading_time();?></li>
                                        <li class="article-date">|</li>
                                        <li class="article-date"><?php echo get_the_time(get_option( 'date_format' )) ?></li>
                                    </ul>
                                </div>
                            </div>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>
