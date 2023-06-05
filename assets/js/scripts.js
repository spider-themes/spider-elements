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


    setInterval(function(){
      var active = $('.hotspot_list li.active');
      active.removeClass('active');
      if(active.next('li').length == 0){
        active.parent('.hotspot_list').find('li:first').addClass('active');
      }else{
        active.next('li').addClass('active');
      }
    }, 6000 );


    //Close Notice Message On click Event
    $(".message_alert button.close").click(function () {
      let btnId = $(this).attr("data-id");
      $(".message_alert[data-id="+btnId+"]").fadeOut();
    } );


  });
})(jQuery);