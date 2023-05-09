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
              var dollar = $('.price .dollar');
              var euro = $('.price .euro');

              $pricing_currency.on('change', function () {
                  if ($('.pricing-currency').val() === 'EURO') {
                      dollar.css('display', 'none');
                      euro.css('display', 'inline-block');
                  } else {
                      euro.css('display', 'none');
                      dollar.css('display', 'inline-block');
                  }
              });
          }

      },


      //============== Mailchimp Form
      mailchimp: function ($scope) {
          var mailchimpContainer = $scope.find(".mailchimp");
          var dataUrl = mailchimpContainer.data('action-url');

          if ( mailchimpContainer.length > 0 ) {
              mailchimpContainer.ajaxChimp({
                  callback: mailchimpCallback,
                  url: dataUrl,
              });
              $(".memail").on("focus", function () {
                  $(".mchimp-errmessage").fadeOut();
                  $(".mchimp-sucmessage").fadeOut();
              });
              $(".memail").on("keydown", function () {
                  $(".mchimp-errmessage").fadeOut();
                  $(".mchimp-sucmessage").fadeOut();
              });
              $(".memail").on("click", function () {
                  $(".memail").val("");
              });

              function mailchimpCallback(resp) {
                  if (resp.result === "success") {
                      $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
                      $(".mchimp-sucmessage").fadeOut(500);
                  } else if (resp.result === "error") {
                      $(".mchimp-errmessage").html(resp.msg).fadeIn(1000);
                  }
              }
          }
      },
  }

  $window.on("elementor/frontend/init", landpagy.onInit);

})(jQuery, window);