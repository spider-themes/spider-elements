;(function ($, elementor) {
    "use strict";

    const $window = $(elementor);

    const spiderElements = {
        onInit: function () {
            const E_FRONT = elementorFrontend;
            const widgetHandlersMap = {
                "landpagy_pricing_table_tabs.default":          spiderElements.pricing_table_tabs,
                "docy_tabs.default":                            spiderElements.tabs,
                "docy_testimonial.default":                     spiderElements.testimonial,
                "docly_alerts_box.default":                     spiderElements.alertBox,
                "docy_videos_playlist.default":                 spiderElements.videoPlaylist,
                "docy_team_carousel.default":                   spiderElements.teamslider,
                "spe_after_before_widget.default":              spiderElements.beforeAfter,
                "docy_video_popup.default":                     spiderElements.videoPopup,
                "spe_instagram.default":                        spiderElements.instagramFeed,
                "spel_accordion.default":                       spiderElements.accordions,
                "docly_cheatsheet.default":                     spiderElements.cheatsheet,
                "docy_blog_grid.default":                       spiderElements.blogGrid,
            };

            $.each(widgetHandlersMap, function (widgetName, callback) {
                E_FRONT.hooks.addAction(
                    "frontend/element_ready/" + widgetName,
                    callback
                );
            });
        },

        //======================== Blog Grid =========================== //
        blogGrid: function ($scope) {


            let blogGrid = $scope.find(".category-slider-one");
            let dataRtlblog = blogGrid.data("rtl");
            if (blogGrid.length > 0) {
                blogGrid.slick({
                    rtl: dataRtlblog,
                    dots: false,
                    arrows: true,
                    lazyLoad: 'ondemand',
                    prevArrow: $('.prev_d'),
                    nextArrow: $('.next_d'),
                    centerPadding: '0px',
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 3000,
                    responsive: [
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });
            }

        },


        /*============ cheatsheet js ==============*/
        cheatsheet: function ($scope) {
            let cheatsht = $scope.find(".card-header button");
            cheatsht.on("click", function (event) {
                event.preventDefault(); // Prevent default behavior
                var $this = $(this);
                var $parent = $this.parents();
                var $collapses = $parent.find("> .collapse").first();
                $(this).toggleClass("active");
                $collapses.slideToggle(300);
                return false;
            });

            // Check if elementor is in edit mode
            if (window.elementor && window.elementor.hasOwnProperty('frontend') && window.elementorFrontend.isEditMode()) {
                // Check if serial number toggle is enabled
                let enableSerial = $scope.find('[data-setting="enable_serial_numbers"]').val() === 'yes';
                let enableNumberCircle = $scope.find('[data-setting="enable_number_circle"]').val() === 'yes';

                if (enableSerial || enableNumberCircle) {
                    // Update serial numbers dynamically based on index
                    setTimeout(function() {
                        $scope.find('.elementor-repeater-fields').each(function(index) {
                            // Dynamically apply serial numbers using the index value
                            if (enableSerial) {
                                $(this).find('.cheatsheet_num').text('#' + (index + 1));
                            }
                            if (enableNumberCircle) {
                                $(this).find('.number-circle').text('#' + (index + 1));
                            }
                        });
                    }, 100);

                    // Update serial numbers when new items are added
                    window.elementor.on('click', '.elementor-repeater-add', function() {
                        setTimeout(function() {
                            $scope.find('.elementor-repeater-fields').each(function(index) {
                                if (enableSerial) {
                                    $(this).find('.cheatsheet_num').text('#' + (index + 1));
                                }
                                if (enableNumberCircle) {
                                    $(this).find('.number-circle').text('#' + (index + 1));
                                }
                            });
                        }, 100);
                    });
                }
            }
        },

        //=============== accordion js ===============//

        accordions: function ($scope) {
            let speAccordion = $scope.find(".spe_accordion_inner > .spe-accordion");
            speAccordion.on("click", function () {
                var $this = $(this);
                var $parent = $this.parent();
                var $collapse = $parent.find("> .collapse").first();

                $collapse.slideToggle(300);
                $parent.siblings().find("> .collapse").hide(300);

                if ($parent.hasClass("spe-collapsed")) {
                    $parent.removeClass("spe-collapsed");
                } else {
                    speAccordion.parent().removeClass("spe-collapsed");
                    $parent.addClass("spe-collapsed");
                }

                return false;
            });
        },

        //======================== Instagram Feed =========================== //
        instagramFeed: function ($scope) {
            let instagramFeed = $scope.find(".instagram-feed-active");

            if (instagramFeed.length > 0) {
                var portfolio = new Swiper(".instagram-feed-active", {
                    slidesPerView: 1,
                    spaceBetween: 24,
                    loop: true,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    breakpoints: {
                        480: {
                            slidesPerView: 2,
                        },
                        768: {
                            slidesPerView: 3,
                        },
                        992: {
                            slidesPerView: 4,
                        },
                        1200: {
                            slidesPerView: 5,
                        },
                    },
                });
            }
        },

        //============================== Start Before After =============================//
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
        }, //End Before After

        //============================== Video Popup =============================//
        videoPopup: function ($scope) {
            let fancy = $scope.find(".fancybox");
            if (fancy.length) {
                fancy.fancybox({
                    arrows: true,
                    buttons: [
                        "zoom",
                        "slideShow",
                        "thumbs",
                        "close",
                    ],
                    animationEffect: "zoom-in-out",
                    transitionEffect: "zoom-in-out",
                });
            }

            // Layout 03
            let textElement = document.querySelector(".btn-circle .text p");
            if (textElement) {
                textElement.innerHTML = textElement.innerText // Split the text into characters and apply rotation to each character
                    .split("")
                    .map(
                        (char, i) =>
                            `<span style="transform:rotate(${i * 9.5}deg)">${char}</span>`
                    )
                    .join("");
            }
        }, //End Video Popup

        //============================== Team Slider =============================//
        teamslider: function ($scope) {

            let teamSlider = $scope.find(".expert-slider-one");
            let dataRtlTeam1 = teamSlider.data("rtl");
            if (teamSlider.length) {
                teamSlider.slick({
                    rtl: dataRtlTeam1,
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
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                            },
                        },
                    ],
                });
            }

            let teamSlider2 = $scope.find(".expert-slider-two");
            let dataRtlTeam2 = teamSlider2.data("rtl");
            if (teamSlider2.length) {
                teamSlider2.slick({
                    rtl: dataRtlTeam2,
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
        }, //End Team Slider

        //============================== Video Playlist =============================//
        videoPlaylist: function ($scope) {
            let video = $scope.find("#video_0");
            setTimeout(function () {
                $(".video_slider_area").addClass("loaded").css("height", "auto");
            }, 3000);

            video.addClass("show").addClass("active");
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
            let dataRtldoc = testimonialSlider.data("rtl");
            let imageSlider = $scope.find(".doc_img_slider");
            let dataRtlimg = imageSlider.data("rtl");

            // Testi
            if (testimonialSlider.length > 0) {
                testimonialSlider.slick({
                    autoplay: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    rtl: dataRtlimg,
                    autoplaySpeed: 2000,
                    speed: 2000,
                    dots: true,
                    arrows: false,
                    asNavFor: imageSlider, //.doc_img_slider class
                });
                imageSlider.slick({
                    rtl: dataRtldoc,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    asNavFor: testimonialSlider, //.doc_testimonial_slider class
                    arrows: false,
                    fade: true,
                    focusOnSelect: true,
                });
            }

            //==== testimonial Style 2
            let feedbackSlider = $scope.find(".doc_feedback_slider");
            let dataRtlfdb = feedbackSlider.data("rtl");
            if (feedbackSlider.length > 0) {
                feedbackSlider.slick({
                    rtl: dataRtlfdb,
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

            //==== Testimonial Style 3
            let testimonialSliderInner = $scope.find(".testimonial-slider-inner");
            if (testimonialSliderInner.length > 0) {
                var Testimonial = new Swiper(".testimonial-slider-inner", {
                    slidesPerView: 1,
                    spaceBetween: 10,
                    loop: true,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                });
            }

            //=== Testimonial Style 4
            let testimonialSlide4 = $scope.find(".testimonial-slide-4");
            if (testimonialSlide4.length > 0) {
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

            //=== Testimonial Style 5
            let testimonialSliderActive = $scope.find(".testimonial-slider-active");
            if (testimonialSliderActive.length > 0) {
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

            //== Testimonial Style 6
            let testimonial6 = $scope.find(".feedback-slider-one");
            let dataRtl6 = testimonial6.data("rtl");
            if (testimonial6.length > 0) {
                testimonial6.each(function () {
                    $(this).slick({
                        rtl: dataRtl6,
                        dots: false,
                        arrows: true,
                        lazyLoad: "ondemand",
                        prevArrow: $(this).parent().find(".prev_f"),
                        nextArrow: $(this).parent().find(".next_f"),
                        centerPadding: "0px",
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        autoplay: true,
                        autoplaySpeed: 3000000,
                        responsive: [
                            {
                                breakpoint: 768,
                                settings: {
                                    slidesToShow: 1,
                                },
                            },
                        ],
                    });
                });
            }

            // feedback-slider-two slider js
            let testimonial8 = $scope.find(".feedback-slider-two");
            let dataRtl8 = testimonial8.data("rtl");
            if (testimonial8.length) {
                testimonial8.slick({
                    rtl: dataRtl8,
                    dots: true,
                    arrows: false,
                    lazyLoad: "ondemand",
                    centerPadding: "0px",
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 300000,
                    responsive: [
                        {
                            breakpoint: 768,
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

            //=== Testimonial Style 10
            let testimonial10_a = $scope.find(".feedback-slider-three-a");
            let dataRtl10a = testimonial10_a.data("rtl");
            let testimonial10_b = $scope.find(".feedback-slider-three-b");
            let dataRtl10b = testimonial10_b.data("rtl");

            if (testimonial10_a.length > 0) {
                testimonial10_a.slick({
                    rtl: dataRtl10b,
                    dots: false,
                    arrows: true,
                    prevArrow: $('.prev_d'),
                    nextArrow: $('.next_d'),
                    lazyLoad: 'ondemand',
                    centerPadding: '0px',
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: true,
                    fade: true,
                    autoplaySpeed: 300000,
                    asNavFor: '.feedback-slider-three-b',
                });
            }

            if (testimonial10_b.length > 0 ) {
                testimonial10_b.slick({
                    rtl: dataRtl10a,
                    dots: true,
                    arrows: false,
                    lazyLoad: 'ondemand',
                    centerPadding: '0px',
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    autoplay: true,
                    autoplaySpeed: 300000,
                    asNavFor: '.feedback-slider-three-a',
                    responsive: [
                        {
                            breakpoint: 992,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 576,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });
            }


            // Testimonial Style 11
            let testimonial11 = $scope.find(".testimonial-slider");
            let dataRtl11 = testimonial11.data("rtl");
            if (testimonial11.length) {
                testimonial11.slick({
                    rtl: dataRtl11,
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
                    function (event, slick, currentSlide, nextSlide) {
                        if (nextSlide < 9) {
                            $(".current_slide").text(`0${nextSlide + 1}`);
                        } else {
                            $(".current_slide").text(nextSlide + 1);
                        }
                    }
                );
            }
        },

        //======================== Tabs =========================== //
        tabs: function ($scope) {

            let nextBtn = $scope.find("button.ezd_tab_arrow_btn.nexts");
            let prevBtn = $scope.find("button.ezd_tab_arrow_btn.previous");

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


            // Tabs Arrow Icons show/hide automatic when item is more than container
            let tabSliderContainers = $scope.find(".tabs_sliders");

            tabSliderContainers.each(function () {
                let tabWrapWidth = $(this).outerWidth();
                let totalWidth = 0;

                let slideBtnLeft = $(this).find("#scroll_left_btn");
                let slideBtnRight = $(this).find("#scroll_right_btn");
                let navWrap = $(this).find(".slide_nav_tabs");
                let navWrapItem = navWrap.children("li");

                navWrapItem.each(function () {
                    totalWidth += $(this).outerWidth();
                });

                // Set initial scroll position to zero
                navWrap.scrollLeft(0);

                if (totalWidth > tabWrapWidth) {
                    slideBtnLeft.removeClass("inactive-left-arrow");
                    slideBtnRight.removeClass("inactive-right-arrow");
                } else {
                    slideBtnLeft.addClass("inactive-left-arrow");
                    slideBtnRight.addClass("inactive-right-arrow");
                }

                function updateScrollerButtons() {
                    let scrollLeft = navWrap.scrollLeft();
                    let scrollWidth = navWrap[0].scrollWidth;
                    let navWidth = navWrap.outerWidth();

                    if (scrollLeft <= 0) {
                        slideBtnLeft.addClass("inactive-left-arrow");
                    } else {
                        slideBtnLeft.removeClass("inactive-left-arrow");
                    }

                    if (scrollLeft + navWidth >= scrollWidth - 1) {
                        slideBtnRight.addClass("inactive-right-arrow");
                    } else {
                        slideBtnRight.removeClass("inactive-right-arrow");
                    }
                }

                slideBtnRight.on("click", function () {
                    navWrap.animate({ scrollLeft: "+=200px" }, 300, function() {
                        updateScrollerButtons();
                    });
                });

                slideBtnLeft.on("click", function () {
                    navWrap.animate({ scrollLeft: "-=200px" }, 300, function() {
                        updateScrollerButtons();
                    });
                });

                navWrap.on('scroll', updateScrollerButtons);
                updateScrollerButtons();

                // Center the active tab on load
                let activeTab = navWrap.find(".nav-item .nav-link.active");
                if (activeTab.length) {
                    let activeTabPosition = activeTab.position().left;
                    let activeTabWidth = activeTab.outerWidth();
                    let navWrapCenter = navWrap.outerWidth() / 2;

                    navWrap.scrollLeft(activeTabPosition - navWrapCenter + (activeTabWidth / 2));
                    updateScrollerButtons();
                }
            });


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

            // custom tab js
            let pricingTabjs = $scope.find(".ezd-tab-menu li button");
            pricingTabjs.on("click", function (e) {
                e.preventDefault();

                // Remove active class from all tabs within the same menu
                $(this)
                    .closest(".ezd-tab-menu")
                    .find("li button")
                    .removeClass("active");

                // Add active class to the clicked tab
                $(this).addClass("active");

                var target = $(this).attr("data-rel");

                $("#" + target)
                    .addClass("active")
                    .siblings(".ezd-tab-box")
                    .removeClass("active");

                return false;
            });
        },


    };

    $window.on("elementor/frontend/init", spiderElements.onInit);
})(jQuery, window);
