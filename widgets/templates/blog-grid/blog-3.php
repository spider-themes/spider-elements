<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>

<div class="row gx-xxl-5">
	<?php
	if ( $post_query->have_posts() ) {
		while ( $post_query->have_posts() ) :
			$post_query->the_post();
			?>
            <div class="col-lg-<?php echo esc_attr( $column_grid ); ?> col-sm-6">
                <div class="blog-meta-one">
                    <figure class="post-img m0">
                        <a href="<?php the_permalink(); ?>" class="img"><?php the_post_thumbnail(); ?></a>
                    </figure>
                    <div class="post-data">
						<?php echo '<a href="' . esc_url( spe_get_the_first_taxonomy_link() ) . '" class="tags">' . spe_get_the_first_taxonomy() . '</a>'; ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title( '<h2 class="tran3s blog-title">', '</h2>' ) ?>
                        </a>
						<?php spe_posted_by(); ?>
                    </div>
                </div>
            </div>
		<?php
		endwhile;
	}
	wp_reset_postdata();
	?>
</div>