<div class="spe_image_slider s_wraper">
    <div class="spe_slider_inner slider">
        <?php foreach( $settings['spe_slider_image'] as $img ) {
            $image_id = !empty($img['id']) ? $img['id'] : '';
            $img_attachment_meta = se_el_image_caption($image_id);
            ?>
            <div>
                <div class="spe_slider_item"> 
                    <?php echo '<img src="' . esc_attr( $img_attachment_meta['src'] ) . '">'; ?> 
                    <div class="spe_slider_content show">
                        <div class="container position-relative">
                            <h3><?php echo $img_attachment_meta['title']; ?></h3>
                            <div class="content_arrow show">
                              <i class="arrow_carrot-up"></i>
                              <i class="arrow_carrot-down"></i>
                            </div>
                            <p class="description"><?php echo $img_attachment_meta['caption']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="buttons_control">
        <div class="container d-flex">
          <button class="spe_slider_btn spe_slider_btn_one play">
              <img class="one" src='<?php echo SE_IMG ?>/push.svg' alt="">
              <img class="two" src='<?php echo SE_IMG ?>/play.svg' alt=""> 
          </button> 
          <span class="pagingInfo"></span>
        </div>
    </div>
    <div class="spe_slider_nav">
        <div class="left_arrow slick-arrow">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" class="sc-cSkPpf dYfTAr">
            <defs><radialGradient id="left-arrow_gradient" cx="50%" cy="50%" r="50%" fx="50%" fy="50%"><stop offset="0%" stop-opacity="0.5"></stop><stop offset="100%" stop-opacity="0"></stop></radialGradient><filter id="left-arrow_filter" width="236%" height="270%" x="-72%" y="-85%" filterUnits="objectBoundingBox"><feOffset in="SourceAlpha" result="shadowOffsetOuter1"></feOffset><feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation="4"></feGaussianBlur><feColorMatrix in="shadowBlurOuter1" result="shadowMatrixOuter1" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.8 0"></feColorMatrix><feMerge><feMergeNode in="shadowMatrixOuter1"></feMergeNode><feMergeNode in="SourceGraphic"></feMergeNode></feMerge></filter></defs><g fill="none" fill-rule="evenodd" transform="matrix(-1 0 0 1 60 0)"><circle cx="30" cy="30" r="30" fill="url(#left-arrow_gradient)"></circle><g stroke-width="2" filter="url(#left-arrow_filter)" transform="matrix(-1 0 0 1 40 20)"><path d="M9 0L0 9.989 9 20M0 10L22.5 10"></path></g></g>
          </svg>
        </div>
        <div class="right_arrow slick-arrow">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 60 60" class="sc-eJgurS bKelnu">
            <defs>
              <radialGradient id="right-arrow_gradient" cx="50%" cy="50%" r="50%" fx="50%" fy="50%">
                <stop offset="0%" stop-opacity="0.5"></stop><stop offset="100%" stop-opacity="0"></stop></radialGradient>
                <filter id="right-arrow_filter" width="236%" height="270%" x="-72%" y="-85%" filterUnits="objectBoundingBox">
                  <feOffset in="SourceAlpha" result="shadowOffsetOuter1"></feOffset><feGaussianBlur in="shadowOffsetOuter1" result="shadowBlurOuter1" stdDeviation="4">
                  </feGaussianBlur><feColorMatrix in="shadowBlurOuter1" result="shadowMatrixOuter1" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.8 0"></feColorMatrix><feMerge><feMergeNode in="shadowMatrixOuter1"></feMergeNode><feMergeNode in="SourceGraphic"></feMergeNode></feMerge></filter></defs><g fill="none" fill-rule="evenodd"><circle cx="30" cy="30" r="30" fill="url(#right-arrow_gradient)"></circle><g stroke-width="2" filter="url(#right-arrow_filter)" transform="matrix(-1 0 0 1 40 20)"><path d="M9 0L0 9.989 9 20M0 10L22.5 10"></path></g></g>
            </svg>
        </div>
    </div>
    <div class="slider-dots-box"></div>
</div>
 <!-- js code  -->
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
            $(this).addClass("clicked");
          }
        });

        $(".left_arrow,.right_arrow").on('click', function(e){
          $('.spe_slider_btn_one').addClass("clicked");
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
      $('.content_arrow').on('click', function(e){
        if($(this).hasClass('show')){
          $('.content_arrow').removeClass('show');
          $('.spe_slider_content').removeClass('show')
        }else{
          $(this).toggleClass('show');
          $('.spe_slider_content').toggleClass('show')
        }
      });
    })(jQuery)
</script>