;(function ($) {
    "use strict";

    // Remove svg.radial-progress .complete inline styling
    $("svg.radial-progress").each(function (index, value) {
        $(this).find($("circle.complete")).removeAttr("style");
    });

    $(window)
        .scroll(function () {
            $("svg.radial-progress").each(function (index, value) {
                // If svg.radial-progress is approximately 25% vertically into the window when scrolling from the top or the bottom
                if (
                    $(window).scrollTop() >
                    $(this).offset().top - $(window).height() * 0.75 &&
                    $(window).scrollTop() <
                    $(this).offset().top + $(this).height() - $(window).height() * 0.25
                ) {
                    // Get percentage of progress
                    var percent = $(value).data("percentage");

                    // Get radius of the svg's circle.complete
                    var radius = $(this).find($("circle.complete")).attr("r");

                    // Get circumference (2πr)
                    var circumference = 2 * Math.PI * radius;

                    // Get stroke-dashoffset value based on the percentage of the circumference
                    var strokeDashOffset =
                        circumference - (percent * circumference) / 100;

                    // Transition progress for 1.25 seconds
                    $(this)
                        .find($("circle.complete"))
                        .animate({"stroke-dashoffset": strokeDashOffset}, 1250);
                }
            });
        })
        .trigger("scroll");

    // switcher js

    document.addEventListener("DOMContentLoaded", function () {

        // Handling for element_switcher
        let elementDisable = document.getElementById("element_disabled"),
            elementEnable = document.getElementById("element_enabled"),
            elementSwitcher = document.getElementById("element_switcher");

        if (elementDisable && elementEnable && elementSwitcher) {
            elementDisable.addEventListener("click", function () {
                elementSwitcher.checked = false;
                elementDisable.classList.add("toggler--is-active");
                elementEnable.classList.remove("toggler--is-active");
            });

            elementEnable.addEventListener("click", function () {
                elementSwitcher.checked = true;
                elementEnable.classList.add("toggler--is-active");
                elementDisable.classList.remove("toggler--is-active");
            });

            elementSwitcher.addEventListener("click", function () {
                elementEnable.classList.toggle("toggler--is-active");
                elementDisable.classList.toggle("toggler--is-active");
            });
        }

        // Handling for feature_switcher
        let featureDisable = document.getElementById("features_disabled"),
            featureEnable = document.getElementById("features_enabled"),
            featureSwitcher = document.getElementById("features_switcher");

        if (featureDisable && featureEnable && featureSwitcher) {
            console.log('Feature switcher found.');
            featureDisable.addEventListener("click", function () {
                featureSwitcher.checked = false;
                featureDisable.classList.add("toggler--is-active");
                featureEnable.classList.remove("toggler--is-active");
            });

            featureEnable.addEventListener("click", function () {
                featureSwitcher.checked = true;
                featureEnable.classList.add("toggler--is-active");
                featureDisable.classList.remove("toggler--is-active");
            });

            featureSwitcher.addEventListener("click", function () {
                featureEnable.classList.toggle("toggler--is-active");
                featureDisable.classList.toggle("toggler--is-active");
            });
        } else {
            console.log('Feature switcher not found.');
        }


    }); // end switcher js

    $(".spe-tab-menu li a").on("click", function () {
        $(this).closest(".spe-tab-menu").find("li a").removeClass("active");

        // Add active class to the clicked tab
        $(this).addClass("active");

        let target = $(this).attr("href");

        $(".spel-tab-box")
            .removeClass("active")
            .fadeOut(0, function () {
                $(target).addClass("active").fadeIn(0);
            });

        // Trigger Isotope filtering after the tab is clicked
        filterMasonry();
        filterMasonryTwo();
        filterMasonryThree();
        return false;
    });


    // Function to set a cookie
    function setCookie(name, value, days) {
        let expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    // Function to get a cookie
    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    // Remain the last active settings tab
    function spel_keep_settings_current_tab() {

        var activeButton = getCookie('spe_settings_current_tab');
        if (activeButton) {
            // Tab active
            $('.spe_dashboard .spe-tab-menu .tab-menu-link[data-content="' + activeButton + '"]').addClass('active');
            $('.spe_dashboard .spe-tab-menu .tab-menu-link:not([data-content="' + activeButton + '"])').removeClass('active');

            // Tab content active
            $('.spe_dashboard .tab_contents .spel-tab-box#' + activeButton).addClass('active');
            $('.spe_dashboard .tab_contents .spel-tab-box:not(#' + activeButton + ')').removeClass('active');
        }

        // Handle button clicks
        $('.spe-tab-menu .tab-menu-link').on('click', function () {
            $('.spe-tab-menu .tab-menu-link').removeClass('active');
            $(this).addClass('active');

            // Set a cookie to remember the active button
            setCookie('spe_settings_current_tab', $(this).data('content'), 1);
        });
    }

    spel_keep_settings_current_tab();

    // filter js
    /*===========elements isotope js===========*/
    function filterMasonry() {
        var filter = $("#elements_gallery");
        if (filter.length) {
            filter.imagesLoaded(function () {
                // images have loaded
                // Activate isotope in container
                filter.isotope({
                    itemSelector: ".ezd-colum-space-4",
                    filter: "*",
                });
            });
        }
    }

    $(document).ready(function () {
        // Initialize Isotope on page load
        filterMasonry();
        let filter = $("#elements_gallery, #features_gallery");

        // Add isotope click function
        $("#elements_filter div").on("click", function () {
            $("#elements_filter div").removeClass("active");
            $(this).addClass("active");

            let selector = $(this).attr("data-filter");
            filter.isotope({
                filter: selector,
            });
            return false;
        });
    });

    /*===========elements isotope js===========*/

    /*===========api isotope js===========*/
    function filterMasonryTwo() {
        var filters = $("#api_setting");
        if (filters.length) {
            filters.imagesLoaded(function () {
                // images have loaded
                // Activate isotope in container
                filters.isotope({
                    itemSelector: ".ezd-colum-space-4",
                    filter: "*",
                });
            });
        }
    }

    $(document).ready(function () {
        // Initialize Isotope on page load
        filterMasonryTwo();
        var filter = $("#api_setting");
        // Add isotope click function
        $("#api_filter div").on("click", function () {
            $("#api_filter div").removeClass("active");
            $(this).addClass("active");

            var selector = $(this).attr("data-filter");
            filter.isotope({
                filter: selector,
            });
            return false;
        });
    });

    /*===========api isotope js===========*/

    /* ============features isotope js ============*/
    function filterMasonryThree() {
        var filter = $("#features_gallery");
        if (filter.length) {
            filter.imagesLoaded(function () {
                // images have loaded
                // Activate isotope in container
                filter.isotope({
                    itemSelector: ".ezd-colum-space-4",
                    filter: "*",
                });
            });
        }
    }

    $(document).ready(function () {
        // Initialize Isotope on page load
        filterMasonryThree();
        var filter = $("#features_gallery");
        // Add isotope click function
        $("#features_filter div").on("click", function () {
            $("#features_filter div").removeClass("active");
            $(this).addClass("active");

            var selector = $(this).attr("data-filter");
            filter.isotope({
                filter: selector,
            });
            return false;
        });
    });

    $(".pro_popup").on("click", function (e) {
        $("#elements_popup1").addClass("popup-visible");
    });
    $(".pro-close").on("click", function (e) {
        $("#elements_popup1").removeClass("popup-visible");
    });

    if ($(".spe_popup_youtube").length) {
        $(".spe_popup_youtube").fancybox({
            type: "iframe", //<--added
            maxWidth: 800,
            maxHeight: 600,
            fitToView: false,
            width: "70%",
            height: "70%",
            autoSize: false,
            closeClick: false,
            openEffect: "elastic",
            closeEffect: "elastic",
        });
    }

    // Elements list Save Now Button
    function elementsSaveNowButton() {
        let elementsList = $(".element_right .widget-list");
        elementsList.on("click", function () {
            // Check if the checkbox is checked
            if ($(this).is(":checked")) {
                $(".dashboard_btn").addClass("save-now");
            } else {
                $(".dashboard_btn")
                    .removeClass("save-now")
                    .removeAttr("disabled")
                    .css("cursor", "pointer"
                );
            }
        });

        // Global Switcher for all widgets
        let globalSwitcher = $('.menu_right_content .element_global_switcher, .menu_right_content .features_global_switcher');
        globalSwitcher.on("click", function () {
            let status = $(this).prop("checked");
            let dataId = $(this).data("id");
            let alignClass = ".widget_checkbox." + dataId + ":enabled";

            $(alignClass).each(function () {
                $(this).prop("checked", status).change();
            });

            $(".dashboard_btn")
                .addClass("save-now")
                .removeAttr("disabled")
                .css("cursor", "pointer");
        });

        // Individual Switcher for each widget
        let widgetSwitcher = $(".element_right .widget-list:checked");
        widgetSwitcher.on("click", function () {
            $(".dashboard_btn")
                .addClass("save-now")
                .removeAttr("disabled")
                .css("cursor", "pointer");
        });

        // Button Setting Switcher Enable/Disable
        let elementsSettingBtn = $(".elements_tab_menu .menu_right_content .save_btn");
        elementsSettingBtn.on("click", function (event) {
            //event.preventDefault();
            //alert('Saved Successfully');
        });
    }

    elementsSaveNowButton();

})(jQuery);
