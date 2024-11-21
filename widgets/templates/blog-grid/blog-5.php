<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<section class="blog-section-six">
    <div class="card-wrapper category-slider-one" data-rtl="<?php echo esc_attr(spel_rtl()) ?>">
		<?php
		while ( $post_query->have_posts() ) {
			$post_query->the_post();
			$thumbnail_url = get_the_post_thumbnail_url( get_the_ID(), 'full' );
			$thumbnail_url = $thumbnail_url ? 'style="background-image: url(' . esc_url( $thumbnail_url ) . ');"' : '';
			?>
            <div class="item item-margin">
                <div class="card-style-six position-relative" <?php echo $thumbnail_url ?>>
                    <a href="<?php the_permalink(); ?>" class="blog-item-six w-100 h-100 d-flex align-items-end">
                        <h2 class="blog-six-title text-lg"><?php echo spel_get_title_length( $settings, 'title_length' ) ?></h2>
                    </a>
                </div>
            </div>
			<?php
		}
		wp_reset_postdata();
		?>
    </div>
	<?php
	if ( ! empty( $settings['left_arrow_icon']['value'] ) || ! empty( $settings['right_arrow_icon']['value'] ) ) { ?>
        <span class="blog-slider-arrows ezd-d-flex justify-content-center">
            <span class="prev_d blog-slick-arrow">
                <?php \Elementor\Icons_Manager::render_icon( $settings['left_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </span>
            <span class="next_d blog-slick-arrow">
                <?php \Elementor\Icons_Manager::render_icon( $settings['right_arrow_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </span>
        </span>
		<?php
	}
	?>
</section>