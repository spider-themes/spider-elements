<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="ezd-grid ezd-grid-cols-12">
	<?php
	if ( $post_query->have_posts() ) {
		while ( $post_query->have_posts() ) {
			$post_query->the_post();
			?>
            <div class="ezd-lg-col-<?php echo esc_attr( $column_grid ); ?> ezd-sm-col-6 blog-grid">
                <div class="blog-meta-one">
                    <figure class="post-img m0">
                        <a href="<?php the_permalink(); ?>" class="img"><?php the_post_thumbnail(); ?></a>
                    </figure>
                    <div class="post-data">
						<?php echo '<a href="' . esc_url( spel_get_the_first_taxonomy_link() ) . '" class="tags">' . spel_get_the_first_taxonomy() . '</a>'; ?>
                        <a class="blog-tow-title" href="<?php the_permalink(); ?>">
                            <h2 class="tran3s blog-title"><?php echo spel_get_the_title_length( $settings, 'title_length' ) ?></h2>
                        </a>
                        <?php spel_get_post_author_name(); ?>
                        <h5 class="by-author">
							<?php esc_html_e( 'by', 'spider-elements' ) ?>
                            <a class="author-name"
                               href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
								<?php echo get_the_author(); ?>
                            </a>
                        </h5>


                    </div>
                </div>
            </div>
			<?php
		}
		wp_reset_postdata();
	}
	?>
</div>