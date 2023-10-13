<div class="testimonial-area">
    <div class="bg-shape">
        <div class="shape"><img src="img/home_two/testimonial-shape.png" alt=""></div>
    </div>
    <div class="container">
        <div class="position-relative">
            <div class="testimonial-slider">
                <?php
                if (!empty($testimonials11)) :
                    foreach ($testimonials11 as $item) : ?>
                        <div class="single-slide">
                            <div class="row testimonial-widget">
                                <div class="col-lg-6">
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
                                <div class="col-lg-6">
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


<script type="text/javascript">
    if ($(".testimonial-slider").length) {
        $(".testimonial-slider").slick({
            autoplay: true,
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            nextArrow: '<div class="next"><span class="arrow"></span></div>',
        });

        var getSlickItem = $(".testimonial-slider").slick("getSlick");
        if (getSlickItem.currentSlide < 9) {
            $(".current_slide").text(`0${getSlickItem.currentSlide + 1}`);
        } else {
            $(".current_slide").text(getSlickItem.currentSlide + 1);
        }
        if (getSlickItem.getDotCount() < 9) {
            $(".total_slide").text(`0${getSlickItem.getDotCount() + 1}`);
        } else {
            $(".total_slide").text(getSlickItem.getDotCount() + 1);
        }

        $(".testimonial-slider").on(
            "beforeChange",
            function(event, slick, currentSlide, nextSlide) {
                if (nextSlide < 9) {
                    $(".current_slide").text(`0${nextSlide + 1}`);
                } else {
                    $(".current_slide").text(nextSlide + 1);
                }
            }
        );
    }
</script>