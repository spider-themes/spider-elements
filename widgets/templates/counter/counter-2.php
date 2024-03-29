<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<div class="skill_item skill_item_two ezd-text-center">
    <?php
    if ( !empty($counter_value) ) {
        ?>
        <div class="skill_pr">
            <svg class="radial-progress" data-percentage="<?php echo esc_attr($counter_value); ?>" viewBox="0 0 80 80">
                <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                <circle class="complete" cx="40" cy="40" r="35"></circle>
            </svg>
            <span class="percentage counter">
            <?php echo esc_html($counter_value) ?>
        </span>
        </div>
        <?php
    }
    if ( $text_switcher == 'yes') { ?>
        <h6><?php echo esc_html($counter_text); ?></h6>
        <?php
    }
    ?>
</div>

<script type=text/javascript>
    ;(function ($) {
        "use strict";

        $(document).ready(function () {

            // Remove svg.radial-progress .complete inline styling
            var radialProgressElements = document.querySelectorAll("svg.radial-progress");
            radialProgressElements.forEach(function (element) {
                var completeCircle = element.querySelector("circle.complete");
                if (completeCircle) {
                    completeCircle.removeAttribute("style");
                }
            });

            function animateCounter(element, targetValue, duration) {
                var startTime;
                var initialValue = 0;

                function updateCounter(timestamp) {
                    if (!startTime) startTime = timestamp;
                    var progress = timestamp - startTime;
                    var percentage = Math.min(progress / duration, 1);
                    var currentValue = Math.floor(initialValue + percentage * (targetValue - initialValue));
                    element.innerText = currentValue + "%";

                    if (percentage < 1) {
                        requestAnimationFrame(updateCounter);
                    }
                }

                requestAnimationFrame(updateCounter);
            }

            //animateCounter(document.querySelector(".skill_item_two .counter"), <?php echo esc_html($counter_value) ?>, 1000

            window.addEventListener("scroll", function () {
                radialProgressElements.forEach(function (element) {
                    // If svg.radial-progress is approximately 25% vertically into the window when scrolling from the bottom to the top
                    var rect = element.getBoundingClientRect();
                    var windowHeight = window.innerHeight || document.documentElement
                        .clientHeight;
                    if (rect.top <= windowHeight * 0.75 && rect.bottom >= windowHeight * 0.25) {
                        // Get percentage of progress
                        var percent = parseInt(element.getAttribute("data-percentage"));

                        // Get radius of the svg's circle.complete
                        var completeCircle = element.querySelector("circle.complete");
                        if (completeCircle) {
                            var radius = parseInt(completeCircle.getAttribute("r"));

                            // Get circumference (2πr)
                            var circumference = 2 * Math.PI * radius;

                            // Get stroke-dashoffset value based on the percentage of the circumference
                            var strokeDashOffset = circumference - (percent * circumference) /
                                100;

                            // Transition progress for 1.25 seconds
                            completeCircle.style.transition = "stroke-dashoffset 1.25s";
                            completeCircle.style.strokeDashoffset = strokeDashOffset;

                            // Animate counterUp
                        }
                    }
                });
            });

            // Trigger scroll event to initialize animations
            window.dispatchEvent(new Event("scroll"));

        });


    })(jQuery);
</script>