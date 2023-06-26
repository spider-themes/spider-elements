<div class="spe_image_slider s_wraper">
    <div class="spe_slider_inner slider">
        <?php foreach( $settings['spe_slider_image'] as $img ) {
            $image_id = !empty($img['id']) ? $img['id'] : '';
            $img_attachment_meta = se_el_image_caption($image_id);
            ?>
            <div>
                <div class="spe_slider_item"> 
                    <?php echo '<img src="' . esc_attr( $img_attachment_meta['src'] ) . '">'; ?> 
                    <div class="spe_slider_content">
                        <div class="container">
                            <h3><?php echo $img_attachment_meta['title']; ?></h3>
                            <p><?php echo $img_attachment_meta['caption']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="buttons_control">
        <button class="spe_slider_btn spe_slider_btn_one play">
            <img class="one" src='<?php echo SE_IMG ?>/play.svg' alt="">
            <img class="two" src='<?php echo SE_IMG ?>/push.svg' alt=""> 
        </button> 
        <span class="pagingInfo"></span>
    </div>
    <div class="spe_slider_nav">
        <i class="arrow_left left_arrow slick-arrow"></i>
        <i class="arrow_right right_arrow slick-arrow"></i>
    </div>
    <div class="slider-dots-box"></div>
</div>

<script>
    ; (function($){
        'use strict';
    //     $(document).ready(function () {
    //     var numSlick = 0;
    //     $(".slider_one").each(function () {
    //       var $status = $(".pagingInfo");
    //       numSlick++;
    //       var $slickElement = $(this).addClass("slider-" + numSlick);
    //       $slickElement.on(
    //       "init reInit afterChange",
    //       function (event, slick, currentSlide, nextSlide) {
    //         var i = (currentSlide ? currentSlide : 0) + 1;
    //         $status.text(i + "/" + slick.slideCount);
    //       }
    //     );

    //       $slickElement.slick({
    //         dots: true,
    //         pauseOnHover: false,
    //         arrows: true,
    //         infinite: false,
    //         autoplay: false,
    //         speed: 1500,
    //         slidesToShow: 1,
    //         prevArrow: ".left_arrow",
    //         nextArrow: ".right_arrow",
    //         appendDots: $(".slider-dots-box"),
    //         dotsClass: "slider-dots",
    //       });

    //       $(".spe_slider_btn_one").on("click", function (e) {
    //         if ($(this).hasClass("pause")) {
    //           $(".slider").slick("slickPause");
    //           $(this).removeClass("pause");
    //           isPause = true;
    //           $(this).addClass("play");
    //         } else {
    //           $(".slider").slick("slickPlay");
    //           isPause = false;
    //           $(this).removeClass("play");
    //           $(this).addClass("pause");
    //         }
    //       });

    //       //ticking machine
    //       var percentTime;
    //       var tick, isPause;
    //       var time = 1;
    //       var progressBarIndex = 0;

    //       $(".slider-dots-box button").each(function (index) {
    //         var progress =
    //           "<div class='inProgress inProgress" + index + "'></div>";
    //         $(this).html(progress);
    //       });

    //       function startProgressbar() {
    //         resetProgressbar();
    //         percentTime = 0;
    //         tick = setInterval(interval, 10);
    //       }

    //       function interval() {
    //         if (isPause === false) {
    //           if (
    //             $(
    //               '.slider .slick-track div[data-slick-index="' +
    //                 progressBarIndex +
    //                 '"]'
    //             ).attr("aria-hidden") === "true"
    //           ) {
    //             progressBarIndex = $(
    //               '.slider .slick-track div[aria-hidden="false"]'
    //             ).data("slickIndex");
    //             startProgressbar();
    //           } else {
    //             percentTime += 1 / (time + 5);
    //             $(".inProgress" + progressBarIndex).css({
    //               width: percentTime + "%",
    //             });
    //             if (percentTime >= 100) {
    //               $(".slider").slick("slickNext");
    //               progressBarIndex++;
    //               if (progressBarIndex > 2) {
    //                 progressBarIndex = 0;
    //               }
    //               startProgressbar();
    //             }
    //           }
    //         }
    //       }

    //       function resetProgressbar() {
    //         $(".inProgress").css({
    //           width: 0 + "%",
    //         });
    //         clearInterval(tick);
    //       }
    //       startProgressbar();
    //     });
    //   });
    $(document).ready(function () {
        var $status = $(".pagingInfo");
        var $slickElement = $(".slider");

        $(".spe_image_slider").each(function () {
          $(this)
            .find(".slider")
            .on(
              "init reInit afterChange",
              function (event, slick, currentSlide, nextSlide) {
                //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
                var i = (currentSlide ? currentSlide : 0) + 1;
                $status.text(i + "/" + slick.slideCount);
              }
            );
        });

        $slickElement.slick({
          dots: true,
          pauseOnHover: false,
          arrows: true,
          infinite: false,
          autoplay: false,
          speed: 1500,
          slidesToShow: 1,
          adaptiveHeight: false,
          prevArrow: ".left_arrow",
          nextArrow: ".right_arrow",
          appendDots: $(".slider-dots-box"),
          dotsClass: "slider-dots",
        });

        $(".spe_slider_btn_one").on("click", function (e) {
          if ($(this).hasClass("pause")) {
            $(".slider").slick("slickPause");
            $(this).removeClass("pause");
            isPause = true;
            $(this).addClass("play");
          } else {
            $(".slider").slick("slickPlay");
            isPause = false;
            $(this).removeClass("play");
            $(this).addClass("pause");
          }
        });

        //ticking machine
        var percentTime;
        var tick, isPause;
        var time = 1;
        var progressBarIndex = 0;

        $(".slider-dots-box button").each(function (index) {
          var progress =
            "<div class='inProgress inProgress" + index + "'></div>";
          $(this).html(progress);
        });

        function startProgressbar() {
          resetProgressbar();
          percentTime = 0;
          tick = setInterval(interval, 10);
        }

        function interval() {
          if (isPause === false) {
            if (
              $(
                '.slider .slick-track div[data-slick-index="' +
                  progressBarIndex +
                  '"]'
              ).attr("aria-hidden") === "true"
            ) {
              progressBarIndex = $(
                '.slider .slick-track div[aria-hidden="false"]'
              ).data("slickIndex");
              startProgressbar();
            } else {
              percentTime += 1 / (time + 5);
              $(".inProgress" + progressBarIndex).css({
                width: percentTime + "%",
              });
              if (percentTime >= 100) {
                $(".slider").slick("slickNext");
                progressBarIndex++;
                if (progressBarIndex > 2) {
                  progressBarIndex = 0;
                }
                startProgressbar();
              }
            }
          }
        }

        function resetProgressbar() {
          $(".inProgress").css({
            width: 0 + "%",
          });
          clearInterval(tick);
        }
        startProgressbar();
      });

    })(jQuery)
</script>