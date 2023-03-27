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
        
    })
  })(jQuery)
  