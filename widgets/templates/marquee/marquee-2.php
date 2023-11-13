<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<section class="promo_area">
    <div class="marquee">
		<?php
		if ( ! empty ( $brand_name ) ) {
			foreach ( $brand_name as $item ) {
				?>
                <div class="slide">
                    <h2 class="se_marquee_title">
						<?php echo wp_get_attachment_image( $settings['shape_img']['id'], 'full' ); ?>
						<?php echo esc_html( $item['title'] ); ?>
                    </h2>
                </div>
				<?php
			}
		}
		?>
    </div>
</section>


<script>
    (function ($) {
        "use strict";
        $(document).ready(function () {
            if ($(".marquee").length) {
                var Increment = 1; // Amount to move per tick...
                var LoopDelay = 500 / 30; // How fast ticks happen...
                var Loop;

                function DestroyLoop() {
                    clearInterval(Loop);
                }

                function CreateLoop() {
                    Loop = setInterval(function () {
                        var FirstSlide = $(".marquee .slide:first-child");
                        var FirstMargin = parseInt(FirstSlide.css("margin-left")) - Increment;
                        FirstSlide.css({"margin-left": FirstMargin});

                        if (Math.abs(FirstMargin) >= FirstSlide.outerWidth()) {
                            FirstSlide.css({"margin-left": 0});
                            FirstSlide.appendTo($(".marquee"));
                        }
                    }, LoopDelay);
                }

                $(".marquee").on("mouseenter", DestroyLoop);
                $(".marquee").on("mouseleave", CreateLoop);
                CreateLoop();
            }
        });
    })(jQuery)
</script>

<style>
    .marquee {
        width: 100%;
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
    }

    .marquee .slide {
        width: auto;
        display: inline-block;
        padding: 1rem;
    }

    .marquee .slide h2 {
        font-family: "Playfair Display", serif;
        font-style: normal;
        font-weight: 700;
        font-size: 48px;
        line-height: 48px;
        text-transform: capitalize;
        color: #ffffff;
        margin-top: 0;
        margin-bottom: 0;
        padding-bottom: 0;
        padding-top: 0;
    }

    .marquee .slide h2 img {
        vertical-align: bottom;
        margin-right: 40px;
    }
</style>