<div class="testimonial-area">
    <div class="bg-shape">
        <div class="shape"><img src="img/home_two/testimonial-shape.png" alt=""></div>
    </div>
    <div class="ezd-container">
        <div class="ezd-position-relative">
            <div class="testimonial-slider">
                <?php
                if (!empty($testimonials11)) :
                    foreach ($testimonials11 as $item) : ?>
                <div class="single-slide">
                    <div class="ezd-grid ezd-grid-cols-12 testimonial-widget">
                        <div class="ezd-lg-col-6">
                            <span>REVIEWS</span>
                            <?php
                                    echo !empty($item['review_content']) ? '<p class="review-text se_review_content">' . esc_html($item['review_content']) . '</p>' : '';
                                    ?>
                            <div class="author-info">
                                <?php
                                        echo !empty($item['author_name']) ? '<h5 class="se_name">' . esc_html($item['author_name']) . '</h5>' : '';
                                        echo !empty($item['author_position']) ? '<p class="se_designation">' . esc_html($item['author_position']) . '</p>' : '';
                                        ?>
                            </div>
                        </div>
                        <div class="ezd-lg-col-6">
                            <img class="author-img" src="<?php echo esc_url($item['author_image']['url']); ?>" alt="">
                        </div>
                    </div>
                </div>
                <?php
                    endforeach;
                endif;
                ?>


            </div>
            <div class="custom_slider_nav ">
                <div class="slide_info">
                    <div class="current_slide me-2"></div>/
                    <div class="total_slide ms-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>