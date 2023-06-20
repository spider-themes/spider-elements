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

    // setInterval(function () {
    //   var active = $(".hotspot_list li");
    //   active.removeClass("active");
    //   if (active.next("li").length == 0) {
    //     active.parent(".hotspot_list").find("li").addClass("active");
    //   } else {
    //     active.next("li").addClass("active");
    //   }
    // }, 3000);
    var pause = false;
    //save items that with number
    var item = $(".hotspot");
    //save blocks
    // var block=  $('.bg-block');
    //variable for counter
    var k = 0;
    setInterval(function () {
      if (!pause) {
        var $this = item.eq(k);

        if (item.hasClass("active")) {
          item.removeClass("active");
        }
        //  block.removeClass('active').eq(k).addClass('active');
        $this.addClass("active");
        //increase k every 1.5 sec
        k++;
        //if k more then number of blocks on page
        // if (k >= block.length ) {
        //   //rewrite variable to start over
        //     k = 0;
        // }
      }
      //every 1.5 sec
      console.log(hi);
    }, 3000);
  });
})(jQuery);
