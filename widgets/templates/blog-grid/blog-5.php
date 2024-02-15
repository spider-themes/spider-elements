<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<div class="ezd-grid ezd-grid-cols-12">
    <?php
    if ($post_query->have_posts()) {
        while ( $post_query->have_posts() ) :
            $post_query->the_post();
            ?>
            <div class="ezd-lg-col-<?php echo esc_attr($column_grid); ?> ezd-sm-col-6">
                <div class="section-title section-tag wow fadeInRight" data-wow-delay="0.1s">
                    <div class="blog-item blog-meta-two">
                        <div class="blog-meta">
                            <div class="author-img">
                                <?php echo get_avatar(get_the_author_meta('ID'), 45); ?>
                            </div>
                            <div class="author-info">
                                <h5>
                                    <?php esc_html_e('Posted by', 'spider-elements') ?>
                                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>">
                                        <?php echo esc_html(get_the_author()); ?>
                                    </a>
                                </h5>
                                <span><?php echo esc_html(get_the_time(get_option('date_format'))); ?></span>
                            </div>
                        </div>
                        <div class="blog-meta">
                            <?php echo spel_get_first_taxonomy(); ?>
                            <span class="blog-read"><?php echo spel_get_reading_time(); ?></span>
                        </div>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title('<h2 class="blog-title">', '</h2>') ?>
                        </a>
                        <div class="read-more-btn">
                            <a href="<?php the_permalink(); ?>">
                                <?php esc_html_e('Read More', 'spider-elements'); ?>
                                <ion-icon name="arrow-forward-sharp"></ion-icon>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
    }
    wp_reset_postdata();
    ?>
</div>