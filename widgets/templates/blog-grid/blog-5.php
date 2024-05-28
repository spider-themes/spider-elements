<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="blog_grid_gap ezd-grid ezd-grid-cols-12">
	<?php
	if ( $post_query->have_posts() ) {
		while ( $post_query->have_posts() ) :
			$post_query->the_post();
			?>
            <div class="ezd-lg-col-<?php echo esc_attr( $column_grid ); ?> ezd-sm-col-6 blog-grid">
                <div class="section-title section-tag wow fadeInRight" data-wow-delay="0.1s">
                    <div class="blog-item blog-meta-two">
                        <div class="blog-meta">
                            <div class="author-img">
								<?php echo get_avatar( get_the_author_meta( 'ID' ), 45 ); ?>
                            </div>
                            <div class="author-info">
                                <h5 class="by-author">
									<?php esc_html_e( 'Posted by', 'spider-elements' ) ?>
                                    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
										<?php echo get_the_author(); ?>
                                    </a>
                                </h5>
                                <span><?php echo get_the_date( __( 'M d, Y' ) ) ?></span>
                            </div>
                        </div>
                        <div class="blog-meta blog-meta2">
							<?php echo '<a href="' . esc_url( spel_get_first_taxonomy_link() ) . '" class="tags">' . spel_get_first_taxonomy() . '</a>'; ?>
                            <span class="blog-read"><?php echo spel_get_reading_time(); ?></span>
                        </div>

                        <a class="blog-five-title" href="<?php the_permalink(); ?>">
                            <h2 class="tran3s blog-title"><?php echo spel_get_title_length( $settings, 'title_length' ) ?></h2>
                        </a>

                        <div class="read-more-btn">
                            <a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'spider-elements' ) ?>
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