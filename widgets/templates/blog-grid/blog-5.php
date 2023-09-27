<div class="row">
    <?php
    if ($post_query->have_posts()) {
        while ($post_query->have_posts()) :
            $post_query->the_post();
    ?>
            <div class="col-lg-<?php echo esc_attr($column_grid); ?> col-sm-6">
                <div class="section-title section-tag wow fadeInRight" data-wow-delay="0.1s">
                    <span class="tag-style heading">&lt;<?php echo esc_html("article", "spider-elements") ?>&gt;</span>
                    <div class="blog-item blog-meta-two">
                        <div class="blog-meta">
                            <div class="author-img">
                                <?php echo get_avatar( get_the_author_meta( 'ID' ), 45 ); ?>
                            </div>
                            <div class="author-info">
                                <h5><?php echo esc_html("Posted by", "spider-elements") ?> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo get_the_author(); ?></a></h5>
                                <span><?php echo get_the_date(__('M d, Y')) ?></span>
                            </div>
                        </div>
                        <div class="blog-meta">
                            <?php echo se_get_post_category_list();?>
                            <span class="blog-read"><?php echo se_get_reading_time('200'); ?></span>
                        </div>
                        <a href="<?php the_permalink(); ?>"><?php the_title('<h2 class="blog-title">', '</h2>') ?></a>
                        <div class="read-more-btn">
                            <a href="<?php the_permalink(); ?>"><?php echo esc_html("Read More", "spider-elements") ?> <ion-icon name="arrow-forward-sharp"></ion-icon></a>
                        </div>
                    </div>
                    <span class="tag-style heading mt-10">&lt;<?php echo esc_html("/article", "spider-elements") ?>&gt;</span>
                </div>
            </div>
    <?php
        endwhile;
    }
    wp_reset_postdata();
    ?>
</div>