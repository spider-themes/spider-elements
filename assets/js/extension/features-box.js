(function ($) {
    'use strict';

    // Define a flag to track if initialization has occurred
    var isInitialized = false;
    var $window = $(window);
    $window.on('elementor/frontend/init', function () {

        // Check if initialization has already occurred
        if (isInitialized) {
            return;
        }

        // Set the flag to true to indicate initialization
        isInitialized = true;

        //======================== Wrapper Link =========================== //
        function handleWrapperLink(event) {
            var $wrapper = $(this),
                data = $wrapper.data('spe-element-link'),
                id = $wrapper.data('id'),
                anchor = document.createElement('a'),
                timeout;

            anchor.id = 'spider-elements-wrapper-link-' + id;
            anchor.href = data.url;
            anchor.target = data.is_external ? '_blank' : '_self';
            anchor.rel = data.nofollow ? 'nofollow noreferer' : '';
            anchor.style.display = 'none';

            document.body.appendChild(anchor);
            anchor.click();

            timeout = setTimeout(function () {
                document.body.removeChild(anchor);
                clearTimeout(timeout);
            });
        }

        $(document).on('click', '[data-spe-element-link]', handleWrapperLink); // End of Wrapper Link


        // Define the function for handling the container hook
        function handleElementReadyForContainer($scope) {
            let iconClass = $scope.find('.elementor-widget-container').parent().parent().attr('data-spe-element-icon');

            if (iconClass) {
                if ($scope.find('.spe-features-box-enable').length === 0) {
                    $scope.append('<div class="wrapper_icon"></div>');
                }

                let iconTag = $scope.find('.wrapper_icon i');
                if (iconTag.length === 0) { // Use .length to check if iconTag exists
                    iconTag = $('<i>');
                    $scope.find('.wrapper_icon').append(iconTag);
                }

                iconTag.attr('class', 'spe-icon ' + iconClass);
            }
        }

        // Define the function for handling the column hook
        function handleElementReadyForColumn($scope) {

            let iconClass = $scope.find('.elementor-widget-container').parent().parent().parent().attr('data-spe-element-icon');

            if (iconClass) {
                if ($scope.find('.spe-features-box-enable').length === 0) {
                    $scope.append('<div class="wrapper_icon"></div>');
                }

                let iconTag = $scope.find('.wrapper_icon i');
                if (iconTag.length === 0) { // Use .length to check if iconTag exists
                    iconTag = $('<i>');
                    $scope.find('.wrapper_icon').append(iconTag);
                }

                iconTag.attr('class', 'spe-icon ' + iconClass);
            }


        }

        //Container function to the container hook
        elementorFrontend.hooks.addAction('frontend/element_ready/container', handleElementReadyForContainer);

        //Column function to the column hook
        elementorFrontend.hooks.addAction('frontend/element_ready/column', handleElementReadyForColumn);


    });

})(jQuery);