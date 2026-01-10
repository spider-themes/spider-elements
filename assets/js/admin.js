; (function ($) {

    "use strict";

    // ===== Toast Notification System =====
    window.SpelToast = {
        show: function (title, message, type = 'success') {
            // Remove existing toasts
            $('.spel_toast').remove();

            const iconClass = type === 'success' ? 'icon-check' : 'icon-close';
            const toast = $(`
                <div class="spel_toast ${type === 'error' ? 'toast_error' : ''}">
                    <span class="toast_icon"><i class="${iconClass}"></i></span>
                    <div class="toast_content">
                        <h4>${title}</h4>
                        <p>${message}</p>
                    </div>
                    <span class="toast_close"><i class="icon-close"></i></span>
                </div>
            `);

            $('body').append(toast);

            // Show toast
            setTimeout(() => toast.addClass('show'), 100);

            // Auto-hide after 4 seconds
            setTimeout(() => {
                toast.removeClass('show');
                setTimeout(() => toast.remove(), 300);
            }, 4000);

            // Close button
            toast.find('.toast_close').on('click', function () {
                toast.removeClass('show');
                setTimeout(() => toast.remove(), 300);
            });
        }
    };

    // ===== Search Functionality =====
    function initSearchFunctionality() {
        // Widget Search
        $('#spel_widget_search').on('input', function () {
            const searchTerm = $(this).val().toLowerCase().trim();
            const $items = $('#elements_list .ezd-colum-space-4');
            let visibleCount = 0;

            $items.each(function () {
                const widgetName = $(this).data('widget-name') || '';
                const isMatch = widgetName.includes(searchTerm);

                if (isMatch || searchTerm === '') {
                    $(this).show().css('opacity', '1');
                    visibleCount++;
                } else {
                    $(this).hide().css('opacity', '0');
                }
            });

            // Update count
            const totalWidgets = $items.length;
            const countText = searchTerm
                ? `${visibleCount} of ${totalWidgets} widgets`
                : `${totalWidgets} widgets`;
            $('#spel_search_count').text(countText);

            // Re-apply isotope layout
            $('#elements_list').isotope('layout');
        });

        // Feature Search
        $('#spel_feature_search').on('input', function () {
            const searchTerm = $(this).val().toLowerCase().trim();
            const $items = $('#features_gallery .ezd-colum-space-4');
            let visibleCount = 0;

            $items.each(function () {
                const featureName = $(this).data('feature-name') || '';
                const isMatch = featureName.includes(searchTerm);

                if (isMatch || searchTerm === '') {
                    $(this).show().css('opacity', '1');
                    visibleCount++;
                } else {
                    $(this).hide().css('opacity', '0');
                }
            });

            // Update count
            const totalFeatures = $items.length;
            const countText = searchTerm
                ? `${visibleCount} of ${totalFeatures} features`
                : `${totalFeatures} features`;
            $('#spel_feature_search_count').text(countText);

            // Re-apply isotope layout
            $('#features_gallery').isotope('layout');
        });
    }

    // Remove svg.radial-progress .complete inline styling
    $("svg.radial-progress").each(function (index, value) {
        $(this).find($("circle.complete")).removeAttr("style");
    });

    $(window).scroll(function () {
        $("svg.radial-progress").each(function (index, value) {
            // If svg.radial-progress is approximately 25% vertically into the window when scrolling from the top or the bottom
            if (
                $(window).scrollTop() >
                $(this).offset().top - $(window).height() * 0.75 &&
                $(window).scrollTop() <
                $(this).offset().top + $(this).height() - $(window).height() * 0.25
            ) {
                // Get percentage of progress
                let percent = $(value).data("percentage");

                // Get radius of the svg's circle.complete
                let radius = $(this).find($("circle.complete")).attr("r");

                // Get circumference (2πr)
                let circumference = 2 * Math.PI * radius;

                // Get stroke-dashoffset value based on the percentage of the circumference
                let strokeDashOffset =
                    circumference - (percent * circumference) / 100;

                // Transition progress for 1.25 seconds
                $(this).find($("circle.complete")).animate({ "stroke-dashoffset": strokeDashOffset }, 1250);
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
        }


    }); // end switcher js


    $(document).ready(function () {

        // Initialize search functionality
        initSearchFunctionality();

        // Map of tab content names to WordPress admin submenu page slugs
        const tabToSubmenuMap = {
            'welcome': 'spider_elements_settings',
            'elements': 'spider_elements_elements',
            'features': 'spider_elements_features',
            'integration': 'spider_elements_integration'
        };

        // LocalStorage key for tab persistence
        const STORAGE_KEY = 'spel_active_tab';

        // Function to update WordPress admin menu active state
        function updateAdminMenuActiveState(tabName) {
            let submenuSlug = tabToSubmenuMap[tabName];
            if (submenuSlug) {
                // Remove current class from all Spider Elements submenu items
                $('#toplevel_page_spider_elements_settings ul.wp-submenu li').removeClass('current');

                // Add current class to the matching submenu item
                $('#toplevel_page_spider_elements_settings ul.wp-submenu li a[href*="' + submenuSlug + '"]').parent().addClass('current');
            }
        }

        // Function to save active tab to localStorage
        function saveActiveTab(tabName) {
            try {
                localStorage.setItem(STORAGE_KEY, tabName);
            } catch (e) {
                console.warn('Spider Elements: Could not save tab state to localStorage', e);
            }
        }

        // Function to get active tab from localStorage
        function getActiveTab() {
            try {
                return localStorage.getItem(STORAGE_KEY);
            } catch (e) {
                console.warn('Spider Elements: Could not read tab state from localStorage', e);
                return null;
            }
        }

        // Set up event listener for tab click
        $(".tab-menu li a").on("click", function () {
            $(this).closest(".tab-menu").find("li a").removeClass("active");

            // Add active class to the clicked tab
            $(this).addClass("active");

            let target = $(this).attr("href");
            let tabName = $(this).data('content');

            $(".tab-box")
                .removeClass("active")
                .fadeOut(0, function () {
                    $(target).addClass("active").fadeIn(0);
                });

            // Trigger Isotope filtering after the tab is clicked
            filterMasonry();
            filterMasonryTwo();
            filterMasonryThree();

            // Save active tab to localStorage for persistence after page refresh
            saveActiveTab(tabName);

            // Update WordPress admin menu active state
            updateAdminMenuActiveState(tabName);

            // Update hidden input field for form submission
            $('#spel_active_tab').val(tabName);

            // Update form action URL to redirect to the correct submenu after save
            let submenuSlug = tabToSubmenuMap[tabName];
            if (submenuSlug) {
                let newAction = 'admin.php?page=' + submenuSlug;
                $('#spel_settings').attr('action', newAction);
            }

            return false;
        });

        // Remain the last active settings tab after page refresh
        function spel_keep_settings_current_tab() {
            // Check if we're on the Spider Elements dashboard page
            let spelDashboard = $('#spel_settings');
            if (!spelDashboard.length) {
                return;
            }

            // Priority 1: Check for active tab from localStorage (user's last selection)
            let activeTab = getActiveTab();

            // Priority 2: Fallback to server-side data attribute
            if (!activeTab) {
                activeTab = spelDashboard.data('active-tab');
            }

            // Priority 3: Default to 'welcome' tab
            if (!activeTab) {
                activeTab = 'welcome';
            }

            // Update sidebar tab-menu active state
            $('.tab-menu .tab-menu-link').removeClass('active');
            $('.tab-menu .tab-menu-link[data-content="' + activeTab + '"]').addClass('active');

            // Update tab content active state
            $('.tab_contents .tab-box').removeClass('active');
            $('.tab_contents .tab-box#' + activeTab).addClass('active');

            // Sync WordPress admin menu active state
            updateAdminMenuActiveState(activeTab);

            // Update hidden input field
            $('#spel_active_tab').val(activeTab);
        }

        spel_keep_settings_current_tab();

    });

    // filter js
    /*===========elements isotope js===========*/
    function filterMasonry() {
        var filter = $("#elements_list");
        if (filter.length) {
            filter.imagesLoaded(function () {
                // images have loaded
                // Activate isotope in container
                filter.isotope({
                    itemSelector: ".ezd-colum-space-4",
                    filter: "*",
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });
            });
        }
    }

    $(document).ready(function () {
        // Initialize Isotope on page load
        filterMasonry();
        let filter = $("#elements_list, #features_gallery");

        // Add isotope click function
        $("#elements_filter div").on("click", function () {
            $("#elements_filter div").removeClass("active");
            $(this).addClass("active");

            // Clear search when filter is clicked
            $('#spel_widget_search').val('');
            $('#elements_list .ezd-colum-space-4').show().css('opacity', '1');

            let selector = $(this).attr("data-filter");
            filter.isotope({
                filter: selector,
            });

            // Update count
            const visibleItems = selector === '*'
                ? $('#elements_list .ezd-colum-space-4').length
                : $('#elements_list .ezd-colum-space-4' + selector).length;
            const totalItems = $('#elements_list .ezd-colum-space-4').length;
            $('#spel_search_count').text(visibleItems + ' widgets');

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
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });
            });
        }
    }

    $(document).ready(function () {
        // Initialize Isotope on page load
        filterMasonryThree();
        var filter = $("#features_gallery");

        // Add isotope click function for features
        $("#features_filter div").on("click", function () {
            $("#features_filter div").removeClass("active");
            $(this).addClass("active");

            // Clear search when filter is clicked
            $('#spel_feature_search').val('');
            $('#features_gallery .ezd-colum-space-4').show().css('opacity', '1');

            var selector = $(this).attr("data-filter");
            filter.isotope({
                filter: selector,
            });

            // Update count
            const visibleItems = selector === '*'
                ? $('#features_gallery .ezd-colum-space-4').length
                : $('#features_gallery .ezd-colum-space-4' + selector).length;
            $('#spel_feature_search_count').text(visibleItems + ' features');

            return false;
        });
    });

    $(".pro_popup").on("click", function (e) {
        $("#elements_popup1").addClass("popup-visible");
    });
    $(".pro-close").on("click", function (e) {
        $("#elements_popup1").removeClass("popup-visible");
    });

    // Close popup on background click
    $(".elements_pro_popup").on("click", function (e) {
        if ($(e.target).hasClass('elements_pro_popup')) {
            $(this).removeClass("popup-visible");
        }
    });

    // Close popup on Escape key
    $(document).on("keyup", function (e) {
        if (e.key === "Escape") {
            $(".elements_pro_popup").removeClass("popup-visible");
        }
    });

    if ($(".popup_youtube").length) {
        $(".popup_youtube").fancybox({
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
                $(".dashboard_btn.save_btn").addClass("save-now");
            } else {
                $(".dashboard_btn.save_btn")
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

            $(".dashboard_btn.save_btn")
                .addClass("save-now")
                .removeAttr("disabled")
                .css("cursor", "pointer");
        });

        // Individual Switcher for each widget
        let widgetSwitcher = $(".element_right .widget-list:checked");
        widgetSwitcher.on("click", function () {
            $(".dashboard_btn.save_btn")
                .addClass("save-now")
                .removeAttr("disabled")
                .css("cursor", "pointer");
        });

        // Button Setting Switcher Enable/Disable
        let elementsSettingBtn = $(".elements_tab_menu .menu_right_content .save_btn");
        elementsSettingBtn.on("click", function (event) {
            // Show toast on save (optional - form will submit normally)
            // SpelToast.show('Settings Saved', 'Your settings have been saved successfully.');
        });
    }

    elementsSaveNowButton();

    // ===== Keyboard Shortcuts =====
    $(document).on('keydown', function (e) {
        // Only work on Spider Elements dashboard
        if (!$('.spel_dashboard').length) return;

        // Ctrl/Cmd + S to save
        if ((e.ctrlKey || e.metaKey) && e.key === 's') {
            e.preventDefault();
            $('.save_btn:visible').first().trigger('click');
        }

        // Ctrl/Cmd + F to focus search
        if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
            const $activeTab = $('.tab-box.active');
            const $searchInput = $activeTab.find('input[type="text"]').first();
            if ($searchInput.length) {
                e.preventDefault();
                $searchInput.focus().select();
            }
        }
    });

})(jQuery);
