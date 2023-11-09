<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>

<div class="counters-container">
    <div class="skill_item ezd-text-center">
        <svg class="radial-progress" data-percentage="<?php echo esc_attr( $counter_value ); ?>" viewBox="0 0 80 80">
            <circle class="incomplete" cx="40" cy="40" r="35"></circle>
            <circle class="complete" cx="40" cy="40" r="35"></circle><text class="percentage" x="50%" y="57%"
                transform="matrix(0, 1, -1, 0, 80, 0)"><?php echo esc_html( $counter_value ) . '%'; ?></text>
        </svg>
        <h6><?php echo esc_html( $counter_text ); ?></h6>
    </div>
</div>

<script type=text/javascript>
document.addEventListener("DOMContentLoaded", function() {
    "use strict";

    // Remove svg.radial-progress .complete inline styling
    var radialProgressElements = document.querySelectorAll("svg.radial-progress");
    radialProgressElements.forEach(function(element) {
        var completeCircle = element.querySelector("circle.complete");
        if (completeCircle) {
            completeCircle.removeAttribute("style");
        }
    });

    window.addEventListener("scroll", function() {
        radialProgressElements.forEach(function(element) {
            // If svg.radial-progress is approximately 25% vertically into the window when scrolling from the top or the bottom
            var rect = element.getBoundingClientRect();
            var windowHeight = window.innerHeight || document.documentElement.clientHeight;
            if (
                rect.top <= windowHeight * 0.75 &&
                rect.bottom >= windowHeight * 0.25
            ) {
                // Get percentage of progress
                var percent = parseInt(element.getAttribute("data-percentage"));

                // Get radius of the svg's circle.complete
                var completeCircle = element.querySelector("circle.complete");
                if (completeCircle) {
                    var radius = parseInt(completeCircle.getAttribute("r"));

                    // Get circumference (2πr)
                    var circumference = 2 * Math.PI * radius;

                    // Get stroke-dashoffset value based on the percentage of the circumference
                    var strokeDashOffset = circumference - (percent * circumference) / 100;

                    // Transition progress for 1.25 seconds
                    completeCircle.style.transition = "stroke-dashoffset 1.25s";
                    completeCircle.style.strokeDashoffset = strokeDashOffset;
                }
            }
        });
    });

    // Trigger scroll event to initialize animations
    window.dispatchEvent(new Event("scroll"));
});
</script>