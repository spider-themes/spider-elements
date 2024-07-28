(function ($) {
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
        var eventDisable = document.getElementById("disable"),
            eventEnable = document.getElementById("enabled"),
            eventSwitcher = document.getElementById("switcher");

        if (eventDisable && eventEnable && eventSwitcher) {
            eventDisable.addEventListener("click", function () {
                eventSwitcher.checked = false;
                eventDisable.classList.add("toggler--is-active");
                eventEnable.classList.remove("toggler--is-active");
            });

            eventEnable.addEventListener("click", function () {
                eventSwitcher.checked = true;
                eventEnable.classList.add("toggler--is-active");
                eventDisable.classList.remove("toggler--is-active");
            });

            eventSwitcher.addEventListener("click", function () {
                eventEnable.classList.toggle("toggler--is-active");
                eventDisable.classList.toggle("toggler--is-active");
            });
        }
    }); // end switcher js

    $(".spe-tab-menu li a").on("click", function () {
        $(this).closest(".spe-tab-menu").find("li a").removeClass("active");

        // Add active class to the clicked tab
        $(this).addClass("active");

        var target = $(this).attr("href");

        $(".spe-tab-box")
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
        var expires = "";
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
    function keep_spe_settings_current_tab() {

        var activeButton = getCookie('spe_settings_current_tab');
        if (activeButton) {
            // Tab active
            $('.spe_dashboard .spe-tab-menu .tab-menu-link[data-content="' + activeButton + '"]').addClass('active');
            $('.spe_dashboard .spe-tab-menu .tab-menu-link:not([data-content="' + activeButton + '"])').removeClass('active');

            // Tab content active
            $('.spe_dashboard .tab_contents .spe-tab-box#' + activeButton).addClass('active');
            $('.spe_dashboard .tab_contents .spe-tab-box:not(#' + activeButton + ')').removeClass('active');
        }

        // Handle button clicks
        $('.spe-tab-menu .tab-menu-link').on('click', function () {
            $('.spe-tab-menu .tab-menu-link').removeClass('active');
            $(this).addClass('active');

            // Set a cookie to remember the active button
            setCookie('spe_settings_current_tab', $(this).data('content'), 1);
        });
    }

    keep_spe_settings_current_tab();

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
        var filter = $("#elements_gallery");
        // Add isotope click function
        $("#elements_filter div").on("click", function () {
            $("#elements_filter div").removeClass("active");
            $(this).addClass("active");

            var selector = $(this).attr("data-filter");
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
        let elementsList = $(".spe_element_right .spe-widget-list");
        elementsList.on("click", function () {
            // Check if the checkbox is checked
            if ($(this).is(":checked")) {
                $(".spe_dashboard_btn").addClass("save-now");
            } else {
                $(".spe_dashboard_btn")
                    .removeClass("save-now")
                    .removeAttr("disabled")
                    .css("cursor", "pointer");
            }
        });

        // Global Switcher for all widgets
        let globalSwitcher = $('.menu_right_content .spel_element_global_switcher, .menu_right_content .spel_element_global_switcher');
        globalSwitcher.on("click", function () {
            let status = $(this).prop("checked");
            let dataId = $(this).data("id");
            let alignClass = ".spe_widget_checkbox." + dataId + ":enabled";

            $(alignClass).each(function () {
                $(this).prop("checked", status).change();
            });

            $(".spe_dashboard_btn")
                .addClass("save-now")
                .removeAttr("disabled")
                .css("cursor", "pointer");
        });

        // Individual Switcher for each widget
        let widgetSwitcher = $(".spe_element_right .spe-widget-list:checked");
        widgetSwitcher.on("click", function () {
            $(".spe_dashboard_btn")
                .addClass("save-now")
                .removeAttr("disabled")
                .css("cursor", "pointer");
        });

        // Button Setting Switcher Enable/Disable
        let elementsSettingBtn = $(
            ".spe_elements_tab_menu .menu_right_content .save_btn"
        );
        elementsSettingBtn.on("click", function (event) {
            //event.preventDefault();
            //alert('Saved Successfully');
        });
    }

    elementsSaveNowButton();
})(jQuery);
