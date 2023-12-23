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
            <div class="ezd-lg-col-<?php echo esc_attr( $column_grid ); ?> ezd-sm-col-6 blog-grid">
                <div class="blog-meta-two">
                    <figure class="post-img">
                        <a href="<?php the_permalink(); ?>" class="img">
							<?php the_post_thumbnail(); ?>
                        </a>
                    </figure>
                    <div class="post-data">
                        <div class="date">
							<?php
							if ( is_sticky() ) {
								echo '<span class="sticky-label fw-500 text-dark">' . esc_html__( 'Featured -', 'spider-elements' ) . '</span>';
							}
							?>
                            <a href="<?php echo get_day_link( get_post_time( 'Y' ), get_post_time( 'm' ), get_post_time( 'j' ) ); ?>"
                               class="meta-item">
								<?php echo get_the_date( __( 'd M Y' ) ) ?>
                            </a>
                        </div>
                        <a class="blog-one-title" href="<?php the_permalink(); ?>">
                            <h2 class="tran3s blog-title"><?php echo spe_get_the_title_length( $settings, 'title_length' ) ?>
                                <h2>
                        </a>
                        <a href="<?php the_permalink(); ?>" class="continue-btn tran3s btn-seven">
							<?php esc_html_e( 'Read More', 'spider-elements' ) ?>
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