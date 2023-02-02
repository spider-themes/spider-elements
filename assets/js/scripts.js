(function ($) {
    'use strict'
  
    $(document).ready(function () {
     
        // DOCY FOOTNOTE        
        let docy_note_column  = $('.docy-footnote-footer').attr('docy-data-column');
        $('.docy-footnote-footer').css('column-count', docy_note_column);
  
        $('.docy-footnotes-link-item').each(function() {
            let docy_note_content = $(this).attr('data-bs-original-title');
            let docy_note_serial = $(this).attr('docy-note-serial');
            $(".docy-footnote-footer").append("<div class='note-class-"  + docy_note_serial + "' id='note-name-"  + docy_note_serial + "'>"  + docy_note_serial + '. ' + docy_note_content+ "</div>");
            $('.note-class-' + docy_note_serial).not(':first').remove();
        });

        $('.docy-footnote-footer').children('span').remove();
        let docy_child_div = $('.docy-footnote-footer').children('div');
        if( docy_child_div.length > 0 ){
           $('.docy-footnote-title').show();
        }





        // Copy the current page link to clipboard
        if ( $('.share-this-doc').length ) {
            $('.share-this-doc').on('click', function (e) {
                e.preventDefault();
                let success_message = $(this).data('success-message');
                let $temp = $("<input>");
                $("body").append($temp);
                $temp.val($(location).attr('href')).select();
                document.execCommand("copy");
                $temp.remove();
                
                setTimeout(function () {
                    $('.docy-link-copied-wrap').text(success_message).addClass('copied');
                }, 500);

                setTimeout(function () {
                    $('.docy-link-copied-wrap').removeClass('copied');
                }, 3500);

            });           
        } 
        $('.docy-link-copied-wrap').click(function(){
            $(this).removeClass('copied');
        });

        $.fn.ezd_social_popup = function (e, intWidth, intHeight, strResize, blnResize) {
            
            // Prevent default anchor event
            e.preventDefault();
            
            // Set values for window
            intWidth = intWidth || '500';
            intHeight = intHeight || '400';
            strResize = (blnResize ? 'yes' : 'no');
        
            // Set title and open popup with focus on it
            var strTitle = ((typeof this.attr('title') !== 'undefined') ? this.attr('title') : 'Social Share'),
                strParam = 'width=' + intWidth + ',height=' + intHeight + ',resizable=' + strResize,            
                objWindow = window.open(this.attr('href'), strTitle, strParam).focus();
        }
        $('.social-links a:not(:first)').on("click", function(e) {
            $(this).ezd_social_popup(e);
        });
        
    })
  })(jQuery)
  