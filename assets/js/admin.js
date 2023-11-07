(function ($) {
  "use strict";

  // Remove svg.radial-progress .complete inline styling
  $("svg.radial-progress").each(function (index, value) {
    $(this).find($("circle.complete")).removeAttr("style");
  });

  $(window)
    .scroll(function () {
      $("svg.radial-progress").each(function (index, value) {
        // If svg.radial-progress is approximately 25% vertically into the window when scrolling from the top or the bottom
        if (
          $(window).scrollTop() >
            $(this).offset().top - $(window).height() * 0.75 &&
          $(window).scrollTop() <
            $(this).offset().top + $(this).height() - $(window).height() * 0.25
        ) {
          // Get percentage of progress
          var percent = $(value).data("percentage");

          // Get radius of the svg's circle.complete
          var radius = $(this).find($("circle.complete")).attr("r");

          // Get circumference (2πr)
          var circumference = 2 * Math.PI * radius;

          // Get stroke-dashoffset value based on the percentage of the circumference
          var strokeDashOffset =
            circumference - (percent * circumference) / 100;

          // Transition progress for 1.25 seconds
          $(this)
            .find($("circle.complete"))
            .animate({ "stroke-dashoffset": strokeDashOffset }, 1250);
        }
      });
    })
    .trigger("scroll");

  // switcher js
  var e = document.getElementById("disable"),
    d = document.getElementById("enabled"),
    t = document.getElementById("switcher");

  e.addEventListener("click", function () {
    t.checked = false;
    e.classList.add("toggler--is-active");
    d.classList.remove("toggler--is-active");
  });

  d.addEventListener("click", function () {
    t.checked = true;
    d.classList.add("toggler--is-active");
    e.classList.remove("toggler--is-active");
  });

  t.addEventListener("click", function () {
    d.classList.toggle("toggler--is-active");
    e.classList.toggle("toggler--is-active");
  });
  // end switcher js

  $(".spe-tab-menu li a").on("click", function (e) {
    e.preventDefault();

    // Remove active class from all tabs within the same menu
    $(this).closest(".spe-tab-menu").find("li a").removeClass("active");

    // Add active class to the clicked tab
    $(this).addClass("active");

    var target = $(this).attr("href");

    $(".spe-tab-box")
      .removeClass("active")
      .fadeOut(200, function () {
        $(target).addClass("active").fadeIn(200);
      });

    // Trigger Isotope filtering after the tab is clicked
    filterMasonry();
    filterMasonryTwo();

    return false;
  });

  // filter js
  /*===========elements isotope js===========*/
  function filterMasonry() {
    var filter = $("#elements_gallery");
    if (filter.length) {
      filter.imagesLoaded(function () {
        // images have loaded
        // Activate isotope in container
        filter.isotope({
          // ... (your Isotope options)
        });
      });
    }
  }

  $(document).ready(function () {
    // Initialize Isotope on page load
    filterMasonry();
    var filter = $("#elements_gallery");
    // Add isotope click function
    $("#elements_filter div").on("click", function () {
      $("#elements_filter div").removeClass("active");
      $(this).addClass("active");

      var selector = $(this).attr("data-filter");
      filter.isotope({
        filter: selector,
        animationOptions: {
          // ... (your animation options)
        },
      });
      return false;
    });
  });

  function filterMasonryTwo() {
    var filters = $("#api_setting");
    if (filters.length) {
      filters.imagesLoaded(function () {
        // images have loaded
        // Activate isotope in container
        filters.isotope({
          // ... (your Isotope options)
        });
      });
    }
  }

  $(document).ready(function () {
    // Initialize Isotope on page load
    filterMasonryTwo();
    var filters = $("#api_setting");
    // Add isotope click function
    $("#api_filter div").on("click", function () {
      $("#api_filter div").removeClass("active");
      $(this).addClass("active");

      var selector = $(this).attr("data-filter");
      filters.isotope({
        filter: selector,
        animationOptions: {
          // ... (your animation options)
        },
      });
      return false;
    });
  });

  $(".pro_popup").on("click", function (e) {
    $("#elements_popup1").addClass("popup-visible");
    console.log("hi");
  });
  $(".pro-close").on("click", function (e) {
    $("#elements_popup1").removeClass("popup-visible");
  });

  if ($(".spe_popup_youtube").length) {
    $(".spe_popup_youtube").fancybox({
      type: "iframe", //<--added
      maxWidth: 800,
      maxHeight: 600,
      fitToView: false,
      width: "70%",
      height: "70%",
      autoSize: false,
      closeClick: false,
      openEffect: "elastic",
      closeEffect: "elastic",
    });
  }
})(jQuery);
