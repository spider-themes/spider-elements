(function ($, elementor) {
    "use strict";
    var $window = $(elementor);

    var spiderElements = {
        onInit: function () {
            var E_FRONT = elementorFrontend;
            var widgetHandlersMap = {
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

            //=== Sticky Tab
            let stickyTab = $scope.find('.sticky_tab');
            let windowWidth = $(window).width();

            if (stickyTab.length > 0) {
                if ( windowWidth > 576 ) {
                    let stickyTabHeight = stickyTab.height() + 100;
                    let stickyTabOffset = stickyTab.offset().top + stickyTabHeight;

                    $(window).on('scroll', function () {
                        let scrollTop = $(window).scrollTop();

                        if ( scrollTop >= stickyTabOffset ) {
                            stickyTab.addClass('tab_fixed');
                        } else {
                            stickyTab.removeClass('tab_fixed');
                        }

                        if ( scrollTop >= stickyTabOffset + stickyTab.height() ) {
                            stickyTab.removeClass('tab_fixed');
                        }

                    });
                }
            }

            //=== Tabs Slider
            let tabWrapWidth = $scope.find('.tabs_sliders').outerWidth();
            let totalWidth = 0;

            let slideArrowBtn = $('.scroller-btn');
            let slideBtnLeft = $('.scroller-btn.left');
            let slideBtnRight = $('.scroller-btn.right');
            let navWrap = $('ul.nav-tabs');
            let navWrapItem = $('ul.nav-tabs li');

            navWrapItem.each(function () {
                totalWidth += navWrapItem.outerWidth();
            });

            if (totalWidth > tabWrapWidth) {
                slideArrowBtn.removeClass('inactive');
            }
            else {
                slideArrowBtn.addClass('inactive');
            }

            if (navWrap.scrollLeft() === 0) {
                slideBtnLeft.addClass('inactive');
            } else {
                slideBtnLeft.removeClass('inactive');
            }

            slideBtnRight.on('click', function () {
                navWrap.animate({scrollLeft: '+=200px'}, 300);
                console.log(navWrap.scrollLeft() + " px");
            });

            slideBtnLeft.on('click', function () {
                navWrap.animate({scrollLeft: '-=200px'}, 300);
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
                        slideBtnRight.addClass('inactive');
                    } else {
                        slideBtnRight.removeClass('inactive');
                    }
                    if (newScrollLeft === 0) {
                        slideBtnLeft.addClass('inactive');
                    } else {
                        slideBtnLeft.removeClass('inactive');
                    }
                    scrollLeftPrev = newScrollLeft;
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