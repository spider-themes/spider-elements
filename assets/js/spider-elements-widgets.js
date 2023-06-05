(function ($, price) {
    "use strict";
    var $window = $(price);

    var landpagy = {
        onInit: function () {
            var E_FRONT = elementorFrontend;
            var widgetHandlersMap = {
                "landpagy_pricing_table_switcher.default"    : landpagy.pricing_table_switcher,
                "landpagy_pricing_table_tabs.default"        : landpagy.pricing_table_tabs,
            };

            $.each(widgetHandlersMap, function (widgetName, callback) {
                E_FRONT.hooks.addAction("frontend/element_ready/" + widgetName, callback);
            });

        },
        //======================== Pricing Table Tabs =========================== //
        screenFeatures: function ($scope) {

            //============= Currency Changes
            let $screen_features = $scope.find('#how_it_works_desktop');
            if ( $screen_features.length > 0 ) {
                window.addEventListener('scroll', function () {
                    var how_it_works_desktop = document.getElementById('how_it_works_desktop');
                    var how_it_works_desktop_box_each = how_it_works_desktop.offsetHeight / 4;

                    if (window.scrollY + window.innerHeight > how_it_works_desktop.offsetTop) {
                        how_it_works_desktop.classList.add('animate_active');
                        how_it_works_desktop.classList.add('box1');
                        how_it_works_desktop.classList.remove('box2');
                    }
                    if (
                        window.scrollY + window.innerHeight > how_it_works_desktop.offsetTop + how_it_works_desktop.offsetHeight ||
                        window.scrollY + window.innerHeight < how_it_works_desktop.offsetTop
                    ) {
                        how_it_works_desktop.classList.remove('animate_active');
                    }

                    if (window.scrollY + window.innerHeight > how_it_works_desktop.offsetTop + how_it_works_desktop_box_each * 2) {
                        how_it_works_desktop.classList.add('box2');
                        how_it_works_desktop.classList.remove('box1');
                        how_it_works_desktop.classList.remove('box3');
                    }

                    if (window.scrollY + window.innerHeight > how_it_works_desktop.offsetTop + how_it_works_desktop_box_each * 3) {
                        how_it_works_desktop.classList.add('box3');
                        how_it_works_desktop.classList.remove('box2');
                    }
                });

            }
        },
        //======================== Pricing Table Tabs =========================== //
        pricing_table_tabs: function ($scope) {
            //============= Currency Changes
            let $pricing_currency = $scope.find('.pricing-currency');
            if ( $pricing_currency.length > 0 ) {

                $pricing_currency.on('change', function () {

                    var dollar_id = $(this).attr('data_id');
                    var dollar    = $('.price[data_id='+dollar_id+'] .dollar');
                    var euro      = $('.price[data_id='+dollar_id+'] .euro');

                    if ($('.pricing-currency[data_id='+dollar_id+']').val() === 'EURO') {
                        dollar.css('display', 'none');
                        euro.css('display', 'inline-block');
                    } else {
                        euro.css('display', 'none');
                        dollar.css('display', 'inline-block');
                    }
                });
            }
        },
    }

    $window.on("elementor/frontend/init", landpagy.onInit);

})(jQuery, window);