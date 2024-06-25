;(function($){

    'use strict';

    $(document).ready(function(){

        const wrapperId = $('#spel_theme_builder_modal');
        const modalContent = $('.spel_theme_builder_wrapper .modal-content');
        const formModalId = $('#template-modal-input-form');

        /**
         * Extracts the post ID from a given URL.
         * @param {string} url - The URL containing the post ID as a query parameter.
         * @return {string|null} The post ID extracted from the URL, or null if not found.
         */
        function getPostIdFromUrl(url) {
            let urlParams = new URLSearchParams(new URL(url).search);
            return urlParams.get('post');
        }

        /**
         * Shows the modal popup.
         * Adds necessary classes and sets display property to block.
         */
        function showPopupModal() {
            wrapperId.addClass('show-popup');
            modalContent.addClass('show-popup');
            wrapperId.css('display', 'block');
        }

        /**
         * Hides the modal popup.
         * Removes classes and sets display property to none.
         */
        function hidePopupModal() {
            wrapperId.css('display', 'none');
            wrapperId.removeClass('show-popup');
            modalContent.removeClass('show-popup');
        }

        /**
         * Event handler for click events on the column edit button.
         * Event handler for click events on the "Add New" button for the custom post type.
         * Shows the modal and sets the data-id attribute in the form.
         */
        $(document).on('click', '.row-actions .edit a, .page-title-action', function(event) {
            event.preventDefault();

            let editColumnDataUrl = $(this).attr('href');
            let columnDataPostId = getPostIdFromUrl(editColumnDataUrl);


            // Check if it is an edit operation
            if (columnDataPostId) {
                $.ajax({
                    url: spel_template_object.ajaxurl,
                    method: 'POST',
                    data: {
                        action: 'spel_edit_template_post',
                        post_id: columnDataPostId,
                        security: spel_template_object.nonce
                    },
                    success: function(response) {
                        if (response.success) {
                            formModalId.attr('data-id', columnDataPostId);
                            $('.template-modal-input-title').val(response.data.post_title); // Set the value attribute
                            $('#spel_template_type').val(response.data.type);
                            $('#spel_template_condition').val(response.data.condition);
                            $('#spel_template_status').prop('checked', response.data.status === 'yes');
                            showPopupModal();
                        } else {
                            alert('Error loading template.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX Error: ', status, error);
                    }
                });
            } else {
                formModalId.removeAttr('data-id'); // Clear any existing data-id
                $('.template-modal-input-title').val(''); // Clear the title input field

                $('#spel_template_type').val('header');
                $('#spel_template_condition').val('entire_site');
                $('#spel_template_status').prop('checked', true);

                showPopupModal();
            }

        });

        /**
         * Event handler for click events on the modal close button.
         * Hides the modal.
         */
        $(document).on('click', '.modal-header .modal-close', function() {
            hidePopupModal();
        });


        /**
         * Event handler for form submission.
         * Submits the form data via AJAX to create or update a post.
         */
        $(document).on('submit', '#template-modal-input-form', function(event) {
            event.preventDefault();

            let formData = $(this).serialize();
            let dataId = $(this).attr('data-id');

            $.ajax({
                url: spel_template_object.ajaxurl, // Use the localized AJAX URL
                method: 'POST',
                data: {
                    action: 'spel_create_template_post',
                    form_data: formData,
                    post_id: dataId,
                    security: spel_template_object.nonce // Include the nonce
                },
                success: function(response) {
                    if (response.success) {
                        alert('Template created successfully.');
                        location.reload();
                    } else {
                        alert('Error saving template.');
                    }
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error: ', status, error);
                }

            })

            console.log(formData)

        })


    })


})(jQuery);