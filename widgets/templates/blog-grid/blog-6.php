<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<section class="category-section-three mt-20">
    <div class="card-wrapper category-slider-one">
        <?php
        while ( $post_query->have_posts() ) {
            $post_query->the_post();
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
            $thumbnail_url = $thumbnail_url ? 'style="background-image: url(' . esc_url($thumbnail_url) . ');"' : '';
            ?>
            <div class="item">
                <div class="card-style-six position-relative" <?php echo $thumbnail_url ?>>
                    <a href="<?php the_permalink(); ?>" class="w-100 h-100 ps-4 pb-20 d-flex align-items-end">
                        <div class="title text-white fw-500 text-lg"><?php the_title() ?></div>
                    </a>
                </div>
            </div>
            <?php
        }
        wp_reset_postdata();
        ?>
    </div>

    <ul class="slider-arrows slick-arrow-two d-flex justify-content-center style-none sm-mt-20">
        <li class="prev_d slick-arrow"><i class="bi bi-chevron-left"></i></li>
        <li class="next_d slick-arrow"><i class="bi bi-chevron-right"></i></li>
    </ul>
</section>