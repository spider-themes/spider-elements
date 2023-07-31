    <!-- Testimonials Section -->
    <section class="testimonial-area testimonial-area-8">
        <div class="testimonial-slider-active swiper">
            <div class="swiper-wrapper">
                <?php
                if (!empty($testimonials5)) :
                    foreach ($testimonials5 as $item) : ?>
                        <div class="swiper-slide">
                            <div class="testimonial testimonial-item">
                                <?php
                                echo !empty($item['company_name']) ? '<span class="category">' . esc_html($item['company_name']) . '</span>' : '';

                                echo !empty($item['review_content']) ? '<h3 class="testimonial-title">' . esc_html($item['review_content']) . '</h3>' : '';

                                echo !empty($item['title']) ? '<span class="testimonial-subtitle">' . esc_html($item['title']) . '</span>' : '';
                                ?>
                                <div class="author-name">
                                    <?php
                                    if (!empty($item['author_image']['id'])) :
                                        echo wp_get_attachment_image($item['author_image']['id'], 'full', ['class' => 'author-img']);
                                    endif;
                                    echo !empty($item['name']) ? '<span class="author-title">' . esc_html($item['name']) . '</span>' : '';
                                    ?>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
        <div class="navigation">
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>
    <!-- Testimonials Section -->

    <script>
        ;
        (function($) {
            "use strict";
            $(document).ready(function() {
                if (jQuery(".testimonial-slider-active").length) {
                    var swiper5 = new Swiper(".testimonial-slider-active", {
                        slidesPerView: 1,
                        spaceBetween: 24,
                        grabCursor: true,
                        loop: true,
                        speed: 500,
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                        breakpoints: {
                            576: {
                                slidesPerView: 2,
                            },
                            1200: {
                                slidesPerView: 4,
                            },
                        },
                    });
                }
            });
        })(jQuery)
    </script>