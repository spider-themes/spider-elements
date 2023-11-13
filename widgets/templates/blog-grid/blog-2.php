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
                <div class="blog-meta-one">
                    <figure class="post-img m0">
                        <a href="<?php the_permalink(); ?>" class="img">
							<?php the_post_thumbnail( 'full' ); ?>
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
                        <a href="<?php the_permalink(); ?>"><?php the_title( '<h2 class="tran3s blog-title">',
								'</h2>' ) ?></a>
                        <p><?php echo wp_trim_words( get_the_content(), $spe_post_content_limit ); ?></p>
                        <a href="<?php the_permalink(); ?>" class="continue-btn tran3s d-flex align-items-center">
                            <i class="arrow_right"></i>
                        </a>
                    </div>
                </div>
            </div>
		<?php
		endwhile;
	}
	wp_reset_postdata();
	?>
</div>