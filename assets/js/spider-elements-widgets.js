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
                "docly_hotspot.default": spiderElements.hotspot,
                "docy_flip_box.default": spiderElements.flipbox,
                "docy_image_slider.default": spiderElements.imageSlider,
                "docy_videos_playlist.default": spiderElements.videoPlaylist,
            };

            $.each(widgetHandlersMap, function (widgetName, callback) {
                E_FRONT.hooks.addAction(
                    "frontend/element_ready/" + widgetName,
                    callback
                );
            });
        },


        //================ Video Playlist =================//
        videoPlaylist: function ($scope) {

            /*setTimeout(function () {
                $(".video_slider_area").addClass("loaded").css("height", "auto");
            }, 3000);*/

            /*$(".toggle_btn").click(function (e) {
                e.preventDefault();
            });*/

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

            const accordionPanels = document.querySelectorAll(".accordion-panel");
            const accordionHeaders = document.querySelectorAll(".accordion-headers");

            accordionHeaders.forEach((header) => {
                header.addEventListener("click", () => {
                    const accordionPanel = header.parentElement;
                    const isActive = accordionPanel.classList.contains("active");

                    if (!isActive) {
                        accordionPanels.forEach((panel) => panel.classList.remove("active"));
                        accordionPanel.classList.add("active");
                    } else {
                        accordionPanel.classList.remove("active");
                    }
                });
            });
        }, //End Video Playlist


        imageSlider: function ($scope) {
            var $status = $(".pagingInfo");
            var $slickElement = $(".slider");

            $slickElement.on(
                "init reInit afterChange",
                function (event, slick, currentSlide, nextSlide) {
                    //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
                    var i = (currentSlide ? currentSlide : 0) + 1;
                    $status.text(i + "/" + slick.slideCount);
                }
            );

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

            $("#toggle").click(function () {
                if ($(this).html() == "pause") {
                    $(".slider").slick("slickPause");
                    isPause = true;
                    $(this).html("play");
                } else {
                    $(".slider").slick("slickPlay");
                    isPause = false;
                    $(this).html("pause");
                }
            });

            //ticking machine
            var percentTime;
            var tick, isPause;
            var time = 1;
            var progressBarIndex = 0;

            $(".slider-dots-box button").each(function (index) {
                var progress = "<div class='inProgress inProgress" + index + "'></div>";
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

            // var $status = $(".pagingInfo");
            // var $slickElement = $(".slider");

            // $slickElement.on(
            //   "init reInit afterChange",
            //   function (event, slick, currentSlide, nextSlide) {
            //     //currentSlide is undefined on init -- set it to 0 in this case (currentSlide is 0 based)
            //     var i = (currentSlide ? currentSlide : 0) + 1;
            //     $status.text(i + "/" + slick.slideCount);
            //   }
            // );
        },
        //===================== flipbox ======================//
        flipbox: function () {
            $(".flip_button").each(function (i) {
                $(this).on("click", function () {
                    $(".spe_flip_box_inner").eq(i).addClass("flip");
                });
            });

            $(".flip_button_close,.flip_overlay").on("click", function () {
                $(".spe_flip_box_inner").removeClass("flip");
            });
        },
        //======================== hotspot =========================== //
        hotspot: function ($scope) {
            setInterval(function () {
                var active = $(".hotspot_list li.active");
                active.removeClass("active");
                if (active.next("li").length == 0) {
                    active
                        .parent(".hotspot_list")
                        .find("li:first-child")
                        .addClass("active");
                } else {
                    active.next("li").addClass("active");
                }
            }, 3000);
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

                        if (scrollTop >= stickyTabOffset + stickyTab.height()) {
                            stickyTab.removeClass("tab_fixed");
                        }
                    });
                }
            }

            //=== Tabs Slider
            let tabWrapWidth = $scope.find(".tabs_sliders").outerWidth();
            let totalWidth = 0;

            let slideArrowBtn = $(".scroller-btn");
            let slideBtnLeft = $(".scroller-btn.left");
            let slideBtnRight = $(".scroller-btn.right");
            let navWrap = $("ul.nav-tabs");
            let navWrapItem = $("ul.nav-tabs li");

            navWrapItem.each(function () {
                totalWidth += navWrapItem.outerWidth();
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
                navWrap.animate({scrollLeft: "+=200px"}, 300);
                console.log(navWrap.scrollLeft() + " px");
            });

            slideBtnLeft.on("click", function () {
                navWrap.animate({scrollLeft: "-=200px"}, 300);
            });

            scrollerHide();

            function scrollerHide() {
                let scrollLeftPrev = 0;
                navWrap.scroll(function () {
                    let $elem = navWrap;
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
        },

        //======================== Pricing Table Tabs =========================== //
        pricing_table_tabs: function ($scope) {
            //============= Currency Changes
            let $pricing_currency = $scope.find(".pricing-currency");
            if ($pricing_currency.length > 0) {
                $pricing_currency.on("change", function () {
                    var dollar_id = $(this).attr("data_id");
                    var dollar = $(".price[data_id=" + dollar_id + "] .dollar");
                    var euro = $(".price[data_id=" + dollar_id + "] .euro");

                    if (
                        $(".pricing-currency[data_id=" + dollar_id + "]").val() === "EURO"
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
