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



//   ==== Tabs1 JS ======= //

jQuery(document).ready(function($) {

  // Define the variables
  var $tab_shortcode = $('.tab_shortcode');
  var $tab_titles = $tab_shortcode.find('.nav-link');
  var $tab_contents = $tab_shortcode.find('.tab-pane');

  // Hide all tab contents except the first one
  $tab_contents.not(':first').hide();

  // Add click event listener to the tab titles
  $tab_titles.on('click', function(e) {
      e.preventDefault();

      // Remove active class from all tab titles
      $tab_titles.removeClass('active');

      // Add active class to the clicked tab title
      $(this).addClass('active');

      // Hide all tab contents
      $tab_contents.hide();

      // Show the corresponding tab content
      var target = $(this).attr('href');
      $(target).show();
  });

});


//   ==== Tabs2 JS ======= //

jQuery(document).ready(function($) {
  var tabItems = $('.header_tab_items .nav-link');
  var tabContent = $('.header_tab_content .tab-pane');

  // Hide all tab content except the first one
  tabContent.not(':first').hide();

  // Add click event handler to tab items
  tabItems.on('click', function() {
      var $this = $(this);

      // Remove active class from all tab items and add it to the clicked one
      tabItems.removeClass('active');
      $this.addClass('active');

      // Hide all tab content and show the corresponding one
      tabContent.hide();
      $( $this.attr('href') ).show();

      return false;
  });
});



  
  