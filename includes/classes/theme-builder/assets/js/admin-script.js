;(function($){

    'use strict';

    $(document).ready(function(){

        const wrapperId = $('#spel_theme_builder_modal');
        const modalContent = $('.spel_theme_builder_wrapper .modal-content');

        // Function to extract post ID from URL
        function getPostIdFromUrl(url) {
            let urlParams = new URLSearchParams(new URL(url).search);
            return urlParams.get('post');
        }

        // Show the modal when the column edit button is clicked
        $(document).on('click', '.row-actions .edit a', function(event) {
            event.preventDefault();
            wrapperId.addClass('show-popup');
            modalContent.addClass('show-popup');
            wrapperId.css('display', 'block');

            // Redirect the column id create a new attribute 'data-id' in the form tag
            let editColumnDataUrl = $(this).attr('href');
            let columnDataPostId = getPostIdFromUrl(editColumnDataUrl);
            $('#template-modal-input-form').attr('data-id', columnDataPostId);

        });

        // Hide the modal when the close button is clicked
        $(document).on('click', '.modal-header .modal-close', function() {
            wrapperId.css('display', 'none');
            wrapperId.removeClass('show-popup');
            modalContent.removeClass('show-popup');
        });

    })


})(jQuery);