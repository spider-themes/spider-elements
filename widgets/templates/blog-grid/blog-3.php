<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<div class="ezd-grid ezd-grid-cols-12">
    <?php
    if ($post_query->have_posts()) {
        while ( $post_query->have_posts() ) {
            $post_query->the_post();
            ?>
            <div class="ezd-lg-col-<?php echo esc_attr($column_grid); ?> ezd-sm-col-6">
                <div class="blog-meta-one">
                    <figure class="post-img m0">
                        <a href="<?php the_permalink(); ?>" class="img"><?php the_post_thumbnail(); ?></a>
                    </figure>
                    <div class="post-data">
                        <?php echo '<a href="' . spel_get_the_first_taxonomy_link() . '" class="tags">' . spel_get_the_first_taxonomy() . '</a>'; ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title('<h2 class="tran3s blog-title">', '</h2>') ?>
                        </a>
                        <?php spel_get_author_name(); ?>
                    </div>
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();
    }
    ?>
</div>