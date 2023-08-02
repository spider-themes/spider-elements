(function ($, elementor) {
  "use strict";
  var $window = $(elementor);

  var spiderElements = {
    onInit: function () {
      var E_FRONT = elementorFrontend;
      var widgetHandlersMap = {
        "landpagy_pricing_table_tabs.default":
          spiderElements.pricing_table_tabs,
        "docy_tabs.default": spiderElements.tabs,
        "docy_testimonial.default": spiderElements.testimonial,
        "docly_alerts_box.default": spiderElements.alertBox,
        "docy_videos_playlist.default": spiderElements.videoPlaylist,
        "docy_team_carousel.default": spiderElements.teamslider,
        "spe_after_before_widget.default": spiderElements.beforeAfter,
        "docy_video_popup.default": spiderElements.videoPopup,
      };

      $.each(widgetHandlersMap, function (widgetName, callback) {
        E_FRONT.hooks.addAction(
          "frontend/element_ready/" + widgetName,
          callback
        );
      });
    },

    //Before After Widget
    beforeAfter: function ($scope) {
      let beforeAfter = $scope.find(".beforeAfter");

      if (beforeAfter.length > 0) {
        beforeAfter.beforeAfter({
          movable: true,
          clickMove: true,
          position: 49.65,
          separatorColor: "#fafafa",
          bulletColor: "#fff",
        });
      }
    },

    // video popup js
    videoPopup: function ($scope) {
      let fancy = $scope.find(".fancybox");
      if (fancy.length) {
        fancy.fancybox({
          arrows: true,
          buttons: [
            "zoom",
            //"share",
            "slideShow",
            //"fullScreen",
            //"download",
            "thumbs",
            "close",
          ],
          animationEffect: "zoom-in-out",
          transitionEffect: "zoom-in-out",
        });
      }
    },

    // teamslider js
    teamslider: function ($scope) {
      let teamSlider = $scope.find(".expert-slider-one");
      if (teamSlider.length) {
        teamSlider.slick({
          arrows: true,
          lazyLoad: "ondemand",
          prevArrow: $(".prev_a"),
          nextArrow: $(".next_a"),
          centerPadding: "0px",
          slidesToShow: 4,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 3000,
          responsive: [
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 3,
              },
            },
            {
              breakpoint: 768,
              settings: {
                slidesToShow: 2,
              },
            },
          ],
        });
      }

      if ($(".expert-slider-two").length) {
        $(".expert-slider-two").slick({
          dots: true,
          arrows: false,
          lazyLoad: "ondemand",
          centerPadding: "0px",
          slidesToShow: 4,
          slidesToScroll: 2,
          autoplay: false,
          autoplaySpeed: 3000,
          responsive: [
            {
              breakpoint: 1200,
              settings: {
                slidesToShow: 3,
              },
            },
            {
              breakpoint: 992,
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
    },

    // video playlist js
    videoPlaylist: function ($scope) {
      setTimeout(function () {
        $(".video_slider_area").addClass("loaded").css("height", "auto");
      }, 3000);

      $("#video_0").addClass("show").addClass("active");
      let containers = document.getElementsByClassName("artplayer-app");
      if (containers.length > 0) {
        for (var i = 0; i < containers.length; i++) {
          new Artplayer({
            container: containers[i],
            url: containers[i].getAttribute("data-src"),
            title: "Your Name",
            pip: true,
            screenshot: true,
            flip: true,
            fullscreen: true,
            fullscreenWeb: true,
            height: "500px",
          });
        }
      }
    },

    //======================== Alert Box =========================== //
    alertBox: function ($scope) {
      $(".message_alert button.close").click(function () {
        let btnId = $(this).attr("data-id");
        $(".message_alert[data-id=" + btnId + "]").fadeOut();
      });
    },

    //======================== Testimonial =========================== //
    testimonial: function ($scope) {
      let testimonialSlider = $scope.find(".doc_testimonial_slider");
      let imageSlider = $scope.find(".doc_img_slider");

      // Testi
      if (testimonialSlider.length > 0) {
        testimonialSlider.slick({
          autoplay: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplaySpeed: 2000,
          speed: 2000,
          dots: true,
          arrows: false,
          asNavFor: imageSlider, //.doc_img_slider class
        });
        imageSlider.slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          asNavFor: testimonialSlider, //.doc_testimonial_slider class
          arrows: false,
          fade: true,
          focusOnSelect: true,
        });
      }

      let feedbackSlider = $scope.find(".doc_feedback_slider");
      if (feedbackSlider.length > 0) {
        feedbackSlider.slick({
          autoplay: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplaySpeed: 2000,
          speed: 1000,
          dots: false,
          arrows: true,
          prevArrow: ".prev",
          nextArrow: ".next",
        });
      }

      // Testimonial Style 3
      let testimonialSliderInner = $scope.find(".testimonial-slider-inner");
      if( testimonialSliderInner.length > 0 ){
        var Testimonial = new Swiper(".testimonial-slider-inner", {
          slidesPerView: 1,
          spaceBetween: 10,
          // speed: 500,
          // effect: 'fade',
          loop: true,
          navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
          },
      });
      }

      // Testimonial Style 4
      let testimonialSlide4 = $scope.find(".testimonial-slide-4");
      if( testimonialSlide4.length > 0 ){
        var swiper4 = new Swiper(".testimonial-slide-4", {
          spaceBetween: 10,
          loop: true,
          navigation: false,
          breakpoints: {
              768: {
                  navigation: {
                      nextEl: ".swiper-button-next",
                      prevEl: ".swiper-button-prev",
                  },
              },
          },
      });
      }

      // Testimonial Style 5
      let testimonialSliderActive = $scope.find(".testimonial-slider-active");
      if( testimonialSliderActive.length > 0 ){
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
      
    },

    //======================== Tabs =========================== //
    tabs: function ($scope) {
      let nextBtn = $scope.find("button.next");
      let prevBtn = $scope.find("button.previous");

      if (nextBtn.length > 0) {
        nextBtn.on("click", function () {
          let activeTab = $scope.find("ul.nav-tabs .nav-item > .active");
          let nextTab = activeTab.parent().next("li").find(".tab-item-title");
          nextTab.trigger("click");
        });
      }

      if (prevBtn.length > 0) {
        prevBtn.on("click", function () {
          let activeTab = $scope.find("ul.nav-tabs .nav-item > .active");
          let prevTab = activeTab.parent().prev("li").find(".tab-item-title");
          prevTab.trigger("click");
        });
      }

      // === Tabs Slider
      let tabSliderContainers = $scope.find(".tabs_sliders");

      tabSliderContainers.each(function () {
        let $scope = $(this);
        let tabWrapWidth = $scope.outerWidth();
        let totalWidth = 0;

        let slideArrowBtn = $scope.find(".scroller-btn");
        let slideBtnLeft = $scope.find(".scroller-btn.left");
        let slideBtnRight = $scope.find(".scroller-btn.right");
        let navWrap = $scope.find(".slide_nav_tabs");
        let navWrapItem = $scope.find(".slide_nav_tabs li");

        navWrapItem.each(function () {
          totalWidth += $(this).outerWidth();
        });

        if (totalWidth > tabWrapWidth) {
          slideArrowBtn.removeClass("inactive");
        } else {
          slideArrowBtn.addClass("inactive");
        }

        if (navWrap.scrollLeft() === 0) {
          slideBtnLeft.addClass("inactive");
        } else {
          slideBtnLeft.removeClass("inactive");
        }

        slideBtnRight.on("click", function () {
          navWrap.animate({ scrollLeft: "+=200px" }, 300);
          console.log(navWrap.scrollLeft() + " px");
        });

        slideBtnLeft.on("click", function () {
          navWrap.animate({ scrollLeft: "-=200px" }, 300);
        });

        scrollerHide(navWrap, slideBtnLeft, slideBtnRight);
      });

      function scrollerHide(navWrap, slideBtnLeft, slideBtnRight) {
        let scrollLeftPrev = 0;
        navWrap.scroll(function () {
          let $elem = $(this);
          let newScrollLeft = $elem.scrollLeft(),
            width = $elem.outerWidth(),
            scrollWidth = $elem.get(0).scrollWidth;
          if (scrollWidth - newScrollLeft === width) {
            slideBtnRight.addClass("inactive");
          } else {
            slideBtnRight.removeClass("inactive");
          }
          if (newScrollLeft === 0) {
            slideBtnLeft.addClass("inactive");
          } else {
            slideBtnLeft.removeClass("inactive");
          }
          scrollLeftPrev = newScrollLeft;
        });
      }

      //=== Sticky Tab
      let stickyTab = $scope.find(".sticky_tab");
      let windowWidth = $(window).width();

      if (stickyTab.length > 0) {
        if (windowWidth > 576) {
          let stickyTabHeight = stickyTab.height() + 100;
          let stickyTabOffset = stickyTab.offset().top + stickyTabHeight;

          $(window).on("scroll", function () {
            let scrollTop = $(window).scrollTop();
            if (scrollTop >= stickyTabOffset) {
              stickyTab.addClass("tab_fixed");
            } else {
              stickyTab.removeClass("tab_fixed");
            }
          });
        }
      }
    },

    //======================== Pricing Table Tabs =========================== //
    pricing_table_tabs: function ($scope) {
      //============= Currency Changes
      let pricingCurrency = $scope.find(".pricing-currency");
      if (pricingCurrency.length > 0) {
        pricingCurrency.on("change", function () {
          let dollar_id = $(this).attr("data-id");
          let dollar = $(".price[data-id=" + dollar_id + "] .dollar");
          let euro = $(".price[data-id=" + dollar_id + "] .euro");

          if (
            $(".pricing-currency[data-id=" + dollar_id + "]").val() === "EURO"
          ) {
            dollar.css("display", "none");
            euro.css("display", "inline-block");
          } else {
            euro.css("display", "none");
            dollar.css("display", "inline-block");
          }
        });
      }
    },
  };

  $window.on("elementor/frontend/init", spiderElements.onInit);
})(jQuery, window);
