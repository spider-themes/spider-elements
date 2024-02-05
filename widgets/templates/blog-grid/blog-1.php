<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="ezd-grid ezd-grid-cols-12">
	<?php
	if ( $post_query->have_posts() ) {
		while ( $post_query->have_posts() ) :
			$post_query->the_post();
			?>
            <div class="ezd-lg-col-<?php echo esc_attr( $column_grid ); ?> ezd-sm-col-6">
                <div class="blog-meta-two">
                    <figure class="post-img">
                        <a href="<?php the_permalink(); ?>" class="img">
                            <?php the_post_thumbnail('full'); ?>
                        </a>
						<?php echo '<a href="' . spel_get_first_taxonomy_link() . '" class="tags">' . spel_get_first_taxonomy() . '</a>'; ?>
                    </figure>
                    <div class="post-data">
                        <div class="date">
							<?php
							if ( is_sticky() ) {
								echo '<span class="sticky-label fw-500 text-dark">' . esc_html__( 'Featured -', 'spider-elements' ) . '</span>';
							}
							?>
                            <a href="<?php spel_day_link(); ?>"
                               class="meta-item">
                                <?php echo esc_html(get_the_time(get_option('date_format'))); ?>
                            </a>
                        </div>
                        <a href="<?php the_permalink(); ?>">
							<?php the_title( '<h2 class="tran3s blog-title">', '</h2>' ) ?>
                        </a>
                        <a href="<?php the_permalink(); ?>" class="continue-btn tran3s d-flex align-items-center">
							<?php esc_html_e( 'Continue Reading', 'spider-elements' ) ?>
                            <i class="arrow_right"></i>
                        </a>
                    </div>
                </div>
            </div>
		<?php
		endwhile;
        wp_reset_postdata();
	}
	?>
</div>