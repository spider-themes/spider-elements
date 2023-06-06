(function ($, elementor) {
    "use strict";
    var $window = $(elementor);

    var spiderElements = {
        onInit: function () {
            var E_FRONT = elementorFrontend;
            var widgetHandlersMap = {
                //"landpagy_pricing_table_switcher.default"     : spiderElements.pricing_table_switcher,
                "landpagy_pricing_table_tabs.default"           : spiderElements.pricing_table_tabs,
                "docy_tabs.default"                             : spiderElements.tabs,
            };

            $.each(widgetHandlersMap, function (widgetName, callback) {
                E_FRONT.hooks.addAction("frontend/element_ready/" + widgetName, callback);
            });

        },


        //======================== Tabs =========================== //
        tabs: function ($scope) {

            let nextBtn = $scope.find('button.next');
            let prevBtn = $scope.find('button.previous');

            if (nextBtn.length > 0) {
                nextBtn.on('click', function () {
                    let activeTab = $scope.find('ul.nav-tabs .nav-item > .active');
                    let nextTab = activeTab.parent().next('li').find('.tab-item-title');
                    nextTab.trigger('click');
                });
            }

            if (prevBtn.length > 0) {
                prevBtn.on('click', function () {
                    let activeTab = $scope.find('ul.nav-tabs .nav-item > .active');
                    let prevTab = activeTab.parent().prev('li').find('.tab-item-title');
                    prevTab.trigger('click');
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

    $window.on("elementor/frontend/init", spiderElements.onInit);

})(jQuery, window);