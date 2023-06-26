<div class="spe_image_slider">
    <div class="spe_slider_inner slider_two">
        <?php foreach( $settings['spe_slider_image'] as $img ) {
            $image_id = !empty($img['id']) ? $img['id'] : '';
            $img_attachment_meta = se_el_image_caption($image_id);
            ?>
            <div>
                <div class="spe_slider_item"> 
                    <?php echo '<img src="' . esc_attr( $img_attachment_meta['src'] ) . '">'; ?> 
                    <div class="spe_slider_content">
                        <h3><?php echo $img_attachment_meta['title']; ?></h3>
                        <p><?php echo $img_attachment_meta['caption']; ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <span class="pagingInfo_two"></span>
    <div class="spe_slider_nav_two">
        <i class="arrow_left slider_left_arrow slick-arrow"></i>
        <button class="spe_slider_btn spe_slider_btn_two play">
            <img class="one" src='<?php echo SE_IMG ?>/play.svg' alt="">
            <img class="two" src='<?php echo SE_IMG ?>/push.svg' alt=""> 
        </button> 
        <i class="arrow_right slider_right_arrow slick-arrow"></i>
    </div>
    <div class="slider-progress">
        <div class="slider_progress_bar"></div>
    </div>
</div>

<script>
    ; (function($){
        'use strict';
        $(document).ready(function () {
        function mainSlider() {
          var sliderTimer = 5000;
          var $imageSlider = $(".slider_two");
          var $statusT = $(".pagingInfo_two");
          var isPauses;
        //   $imageSlider.on(
        //     "init reInit afterChange",
        //     function (event, slick, currentSlide, nextSlide) {
        //       if (!slick.$dots) {
        //         return;
        //       }

        //       var i = (currentSlide ? currentSlide : 0) + 1;
        //       $statusT.text(i + "/" + slick.$dots[0].children.length);
        //     }
        //   );

        $imageSlider.on(
          "init reInit afterChange",
          function (event, slick, currentSlide, nextSlide) {
            var i = (currentSlide ? currentSlide : 0) + 1;
            $statusT.text(i + "/" + slick.slideCount);
          }
        );

          $imageSlider.slick({
            autoplay: false,
            autoplaySpeed: sliderTimer,
            speed: 1500,
            dots: false,
            prevArrow: ".slider_left_arrow",
            nextArrow: ".slider_right_arrow",
            adaptiveHeight: true,
            pauseOnFocus: false,
            pauseOnHover: false,
          });

          $(".spe_slider_btn_two").on("click", function (e) {
            if ($(this).hasClass("pause")) {
              $(".slider_two").slick("slickPause");
              $(this).removeClass("pause");
              isPauses = true;
              $(this).addClass("play");
            } else {
              $(".slider_two").slick("slickPlay");
              isPauses = false;
              $(this).removeClass("play");
              $(this).addClass("pause");
            }
          });

          function progressBar() {
            $(".slider-progress")
              .find(".slider_progress_bar")
              .removeAttr("style");
            $(".slider-progress")
              .find(".slider_progress_bar")
              .removeClass("active");
            setTimeout(function () {
              $(".slider-progress")
                .find(".slider_progress_bar")
                .css("transition-duration", sliderTimer / 1500 + "s")
                .addClass("active");
            }, 100);
          }
          progressBar();
          $imageSlider.on("beforeChange", function (e, slick) {
            progressBar();
          });
        }
        mainSlider();
      });
    })(jQuery)
</script>