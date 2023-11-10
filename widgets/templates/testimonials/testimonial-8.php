<div id="feedBack_carousel" class="carousel slide">
    <div class="feedback_slider">
        <div class="carousel-inner ezd-text-center">
            <?php if(!empty($testimonials8)): 
                foreach ($testimonials8 as $index => $item ) : 
                            $i = $index + 1;
							$active = $i == 1 ? 'active' : '';
                        ?>
            <div class="item carousel-item <?php echo esc_attr($active)?>">
                <?php
                        if ( !empty($item['review_content']) ) { ?>
                <p><?php echo esc_html($item['review_content']) ?>
                </p>
                <?php
                        }
                        if ( !empty($item['author_name']) ) { ?>
                <div class="ezd-d-inline-block ezd-position-relative name fw-500 text-lg">
                    <?php echo esc_html($item['author_name']); ?><span class="fw-normal opacity-50">
                        <?php echo esc_html($item['author_position']); ?></span>
                </div>
                <?php
                        }
                    ?>
            </div>
            <?php 
            endforeach;
            endif;
        ?>
        </div>
    </div>
    <button class="carousel-control-prev carousel-btn" type="button" data-target="#feedBack_carousel"
        data-bs-slide="prev">
        <i class="eicon-angle-left"></i>
    </button>
    <button class="carousel-control-next carousel-btn" type="button" data-target="#feedBack_carousel"
        data-bs-slide="next">
        <i class="eicon-angle-right"></i>
    </button>
    <div class="carousel-indicators">
        <?php if(!empty($testimonials8)):
            foreach ($testimonials8 as $index => $item):
                $i= $index;
                $active = $i == 0 ? 'active' : '';
                $area_selected = $i == 1 ? 'true' : 'false'
            ?>
        <button type="button" class="<?php echo esc_attr($active)?>" data-target="#feedBack_carousel"
            data-slide-to="<?php echo esc_attr($i)?>">
            <?php echo wp_get_attachment_image( $item['author_image']['id'], ' lazy-img ezd-rounded-circle' ) ?>
        </button>
        <?php endforeach; endif; ?>
        >>>>>>> development
    </div>
</div>
<script>
(function($) {

    $(document).ready(function() {
        var carousel = $(".carousel");
        var items = $(".carousel-item");
        var indicators = $(".carousel-indicators button");
        var itemCount = items.length;
        var currentIndex = 0;

        function showSlide(index) {
            if (index < 0) {
                index = itemCount - 1;
            } else if (index >= itemCount) {
                index = 0;
            }
            var translateX = -index * 100 + "%";
            $(".carousel-inner").css("transform", "translateX(" + translateX + ")");
            currentIndex = index;

            // Update the active indicator
            indicators.removeClass("active");
            indicators.eq(index).addClass("active");
            items.removeClass("active");
            items.eq(index).addClass("active");
        }

        indicators.click(function() {
            var index = $(this).data("slide-to");
            showSlide(index);
        });

        $(".carousel-control-prev").click(function(e) {
            e.preventDefault();
            showSlide(currentIndex - 1);
        });

        $(".carousel-control-next").click(function(e) {
            e.preventDefault();
            showSlide(currentIndex + 1);
        });
    });


})(jQuery);
</script>