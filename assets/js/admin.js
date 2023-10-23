(function ($) {
  "use strict";

  $("document").ready(function () {
    // custom tab js
    $(".spe-tab-menu li a").on("click", function (e) {
      e.preventDefault();

      // Remove active class from all tabs within the same menu
      $(this).closest(".spe-tab-menu").find("li a").removeClass("active");

      // Add active class to the clicked tab
      $(this).addClass("active");

      var target = $(this).attr("href");

      $(target)
        .addClass("active")
        .siblings(".spe-tab-box")
        .removeClass("active");

      return false;
    });
  });
})(jQuery);
