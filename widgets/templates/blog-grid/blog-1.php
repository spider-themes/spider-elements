<div class="row gx-xl-5">
    <?php 
        if ( $post_query->have_posts() ) {
            while ( $post_query->have_posts() ) : 
                $post_query->the_post();
        ?>
        <div class="col-lg-<?php echo esc_attr($column_grid);?> col-sm-6">
            <div class="blog-meta-two">
                <figure class="post-img">
                    <a href="<?php the_permalink(); ?>" class="img"><?php the_post_thumbnail(); ?></a>
                    <?php echo '<a href="' . esc_url( se_get_the_first_taxonomy_link() ) . '" class="tags">' . se_get_the_first_taxonomy() . '</a>'; ?>
                </figure>
                <div class="post-data">
                    <div class="date">
                        <?php
                        if ( is_sticky() ) {
                            echo '<span class="sticky-label fw-500 text-dark">' . esc_html__( 'Featured -', 'spider-elements' ) . '</span>';
                        }
                        ?>
                        <a href="<?php echo get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j'));  ?>" class="meta-item">
                            <?php echo get_the_date(__('d M Y')) ?>
                        </a>
                    </div>
                    <a href="<?php the_permalink(); ?>"><?php the_title('<h2 class="tran3s blog-title">', '</h2>') ?></a>
                    <a href="<?php the_permalink(); ?>" class="continue-btn tran3s d-flex align-items-center">
                        <?php echo esc_html("Continue Reading", "spider-elements") ?>
                        <i class="arrow_right"></i>
                    </a>
                </div>
            </div>
        </div>
        <?php
    endwhile; }
    wp_reset_postdata();
    ?>
</div>