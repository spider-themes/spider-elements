(function ($) {
  "use strict";

  $("document").ready(function () {
    setTimeout(function () {
      $(".video_slider_area").addClass("loaded").css("height", "auto");
    }, 3000);

    $(".toggle_btn").click(function (e) {
      e.preventDefault();
    });
    $("#video_0").addClass("show").addClass("active");
    var containers = document.getElementsByClassName("artplayer-app");

    for (var i = 0; i < containers.length; i++) {
      new Artplayer({
        container: containers[i],
        url: containers[i].getAttribute("data-src"),
        title: "Your Name",
        pip: true,
        screenshot: true,
        flip: true,
        fullscreen: true,
        fullscreenWeb: true,
        height: "500px",
      });
    }

    const accordionPanels = document.querySelectorAll(".accordion-panel");
    const accordionHeaders = document.querySelectorAll(".accordion-headers");

  //=============== Pricing Table 06 =========================== //
  const tableSwitcher1 = document.querySelectorAll('.pricing-switcher-2 .nav-link');
    accordionHeaders.forEach((header) => {
      header.addEventListener("click", () => {
        const accordionPanel = header.parentElement;
        const isActive = accordionPanel.classList.contains("active");

        if (!isActive) {
          accordionPanels.forEach((panel) => panel.classList.remove("active"));
          accordionPanel.classList.add("active");
        } else {
          accordionPanel.classList.remove("active");
        }
      });
    });
  });
})(jQuery);

//======================== Counter Up =========================== //

//=============== Pricing Table 06 =========================== //
const se_tableSwitcher1 = document.querySelectorAll(
  ".pricing-switcher-2 .nav-link"
);

if (se_tableSwitcher1.length > 0) {
  se_tableSwitcher1.forEach((switcher) => {
    switcher.addEventListener("click", () => {
      const monthlyTab = document.querySelector("#monthly-tab");
      const switcherBg = document.querySelector(".switcher-bg");

      if (monthlyTab.classList.contains("active")) {
        switcherBg.classList.remove("right");
      } else {
        switcherBg.classList.add("right");
      }
    });
  });
}

// (function ($) {
//     'use strict'

//     $(document).ready(function () {

//         // DOCY FOOTNOTE
//         let docy_note_column  = $('.docy-footnote-footer').attr('docy-data-column');
//         $('.docy-footnote-footer').css('column-count', docy_note_column);

//         $('.docy-footnotes-link-item').each(function() {
//             let docy_note_content = $(this).attr('data-bs-original-title');
//             let docy_note_serial = $(this).attr('docy-note-serial');
//             $(".docy-footnote-footer").append("<div class='note-class-"  + docy_note_serial + "' id='note-name-"  + docy_note_serial + "'>"  + docy_note_serial + '. ' + docy_note_content+ "</div>");
//             $('.note-class-' + docy_note_serial).not(':first').remove();
//         });

//         $('.docy-footnote-footer').children('span').remove();
//         let docy_child_div = $('.docy-footnote-footer').children('div');
//         if( docy_child_div.length > 0 ){
//            $('.docy-footnote-title').show();
//         }

//     })
//   })(jQuery)

// //   ==== Tabs1 JS ======= //

// jQuery(document).ready(function($) {

//   // Define the variables
//   var $tab_shortcode = $('.tab_shortcode');
//   var $tab_titles = $tab_shortcode.find('.nav-link');
//   var $tab_contents = $tab_shortcode.find('.tab-pane');

//   // Hide all tab contents except the first one
//   $tab_contents.not(':first').hide();

//   // Add click event listener to the tab titles
//   $tab_titles.on('click', function(e) {
//       e.preventDefault();

//       // Remove active class from all tab titles
//       $tab_titles.removeClass('active');

//       // Add active class to the clicked tab title
//       $(this).addClass('active');

//       // Hide all tab contents
//       $tab_contents.hide();

//       // Show the corresponding tab content
//       var target = $(this).attr('href');
//       $(target).show();
//   });

// });

// //   ==== Tabs2 JS ======= //

// jQuery(document).ready(function($) {
//   var tabItems = $('.header_tab_items .nav-link');
//   var tabContent = $('.header_tab_content .tab-pane');

//   // Hide all tab content except the first one
//   tabContent.not(':first').hide();

//   // Add click event handler to tab items
//   tabItems.on('click', function() {
//       var $this = $(this);

//       // Remove active class from all tab items and add it to the clicked one
//       tabItems.removeClass('active');
//       $this.addClass('active');

//       // Hide all tab content and show the corresponding one
//       tabContent.hide();
//       $( $this.attr('href') ).show();

//       return false;
//   });
// });

// // ======= Pricing Table Tabs ======= //

// // get all the tab buttons and content sections
// const tabButtons = document.querySelectorAll('.nav-link');
// const tabContents = document.querySelectorAll('.tab-pane');

// // add an event listener to each tab button
// tabButtons.forEach((button) => {
//   button.addEventListener('click', () => {
//     // remove the "active" class from all tab buttons and content sections
//     tabButtons.forEach((button) => button.classList.remove('active',));
//     tabContents.forEach((content) => content.classList.remove('show', 'active'));

//     // add the "active" class to the clicked button and its associated content section
//     const targetContent = document.querySelector(button.dataset.bsTarget);
//     button.classList.add('active');
//     targetContent.classList.add('show', 'active');
//   });
// });
