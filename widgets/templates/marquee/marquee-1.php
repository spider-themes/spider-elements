<div class="branding-area pt-140 pb-145 overflow-hidden">
    <div class="branding-slider">
        <?php foreach ($settings['images'] as $image_item) {
            $is_reverse    = $item['reverse_images'] ?? '';
            $image = $image_item['image'];
            ?>
            <div>
                <img src="<?php echo $image['url']; ?>" alt="">
            </div>
        <?php } ?>
    </div>

    <div class="branding-reverse-slider py-5" dir="rtl">
    <?php foreach ($settings['reverse_images'] as $image_item) {
            $image = $image_item['image'];
            ?>
            <div>
                <img src="<?php echo $image['url']; ?>" alt="">
            </div>
        <?php } ?>
    </div>
</div>


<script type="text/javascript">

    ;(function ($) {
        "use strict";

        $(document).ready(function () {


            if ($(".branding-slider").length) {
                $(".branding-slider").slick({
                    autoplay: true,
                    infinite: true,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    dots: false,
                    speed: 5000,
                    pauseOnHover: false,

                    cssEase: "linear",
                    autoplaySpeed: 10,
                    responsive: [
                        {
                            breakpoint: 765,
                            settings: {
                                slidesToShow: 2,
                            },
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 1,
                            },
                        },
                    ],
                });
            }


            if ($(".branding-reverse-slider").length) {
                $(".branding-reverse-slider").slick({
                    autoplay: true,
                    infinite: true,
                    rtl: true,
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    dots: false,
                    speed: 5000,
                    pauseOnHover: false,
                    cssEase: "linear",
                    autoplaySpeed: 10,
                    responsive: [
                        {
                            breakpoint: 765,
                            settings: {
                                slidesToShow: 2,
                            },
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 1,
                            },
                        },
                    ],
                });
            }




        });

    })(jQuery);

</script>





