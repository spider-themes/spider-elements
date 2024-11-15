<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<section class="header_tabs_area">
    <div class="header_tab_items sticky_tab_item tabs_sliders <?php echo esc_attr($navigation_arrow_class . $sticky_tab_class); ?>">
        <span class="scroller-btn left"><i class="arrow_carrot-left"></i></span>
        <ul class="nav nav-tabs slide_nav_tabs spel-tab-menu <?php echo esc_attr($tab_auto_class); ?>">
            <?php
            $i = 0.2;
            if (is_array($tabs) && !empty($tabs)) {
                foreach ( $tabs as $index => $item ) {
                    $tab_count = $index + 1;
                    $tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);
                    $active = $tab_count == 1 ? 'active' : '';
                    $selected = $tab_count == 1 ? 'true' : 'false';
                    $this->add_render_attribute($tab_title_setting_key, [
                        'class' => [ 'nav-link tab-item-title', $active ],
                        'data-rel' => 'tab-content-' . $id_int . $tab_count,
                    ]);
                    ?>
                    <li class="nav-item wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>s">
                        <button <?php echo $this->get_render_attribute_string($tab_title_setting_key); ?>>
                            <?php
                            if ( $is_auto_play == 'yes' ) { ?>
                                <div class="tab_progress">
                                    <div class="progress-bar"></div>
                                </div>
                                <?php
                            }
                            if ( $is_auto_numb == 'yes' ) { ?>
                                <span class="numb"><?php echo esc_html($tab_count) ?></span>
                                <?php
                            }
                            if ( !empty($item['icon']['value']) ) {
                                \Elementor\Icons_Manager::render_icon($item['icon']);
                            }
                            if ( !empty($item['tab_title']) ) {
                                echo esc_html($item[ 'tab_title' ]);
                            }
                            ?>
                        </button>
                    </li>
                    <?php
                    $i = $i + 0.2;
                }
            }
            ?>
        </ul>
        <span class="scroller-btn right" id="right"><i class="arrow_carrot-right"></i></span>
    </div>
    <div class="header_tab_content">
        <div class="tab-content">
            <?php
            if (is_array($tabs) && !empty($tabs)) {
                foreach ( $tabs as $index => $item ) {
                    $tab_count = $index + 1;
                    $active = $tab_count == 1 ? 'show active' : '';
                    $tab_content_setting_key = $this->get_repeater_setting_key('tab_content', 'tabs', $index);
                    $this->add_render_attribute($tab_content_setting_key, [
                        'class' => [ 'tab-pane p-0 tab_style tab-box', 'fade', $active ],
                        'id' => 'tab-content-' . $id_int . $tab_count,
                    ]);
                    ?>
                    <div <?php echo $this->get_render_attribute_string($tab_content_setting_key); ?>>
                        <?php
                        if ('content' == $item[ 'tabs_content_type' ]) {
                            echo do_shortcode($item[ 'tab_content' ]);
                        } elseif ('template' == $item[ 'tabs_content_type' ]) {
                            if (!empty($item[ 'primary_templates' ])) {
                                echo \Elementor\plugin::$instance->frontend->get_builder_content($item[ 'primary_templates' ], true);
                            }
                        }
                        ?>
                    </div>
                    <?php
                }
            }

            if ($is_navigation_arrow == 'yes') { ?>
                <button class="btn btn-info btn-lg previous"><i class="arrow_carrot-left"></i></button>
                <button class="btn btn-info btn-lg next"><i class="arrow_carrot-right"></i></button>
                <?php
            }
            ?>
        </div>
    </div>
</section>

<script>
    ;(function ($) {
        'use strict';

        $(document).ready(function () {
            var isAutoPlay = '<?php echo esc_js($is_auto_play); ?>'; // Get auto-play status from PHP

            // Function to handle tab change (Existing functionality)
            function changeTab(tabJs) {
                // Remove active class from all tabs within the same menu
                tabJs.closest(".spel-tab-menu").find("li button").removeClass("active");

                tabJs.addClass("active");

                var target = tabJs.attr("data-rel");

                $("#" + target)
                    .addClass("active")
                    .siblings(".tab-box")
                    .removeClass("active");

                // Reset progress bar for all tabs except the clicked one
                $(".progress-bar").not(tabJs.find(".progress-bar")).stop().width(0);

                // Update progress bar for the clicked tab
                updateProgressBar(tabJs.find(".progress-bar"), 5000);
            }

            // Function to update progress bar
            function updateProgressBar(progressBar, duration) {
                progressBar.stop().width(0).animate({
                        width: "100%",
                    },
                    duration,
                    "linear"
                );
            }

            // Tab click event handler and auto-cycle tabs
            var tabJs = $(".spel-tab-menu li button");
            var firstTab = tabJs.first();
            changeTab(firstTab);
            updateProgressBar(firstTab.find(".progress-bar"), 5000);

            tabJs.on("click", function (e) {
                e.preventDefault();
                changeTab($(this));
                return false;
            });

            // Auto-cycle tabs with progress bar (if isAutoPlay is enabled)
            var currentIndex = 0;
            var intervalDuration = 5000; // Set the interval duration in milliseconds

            function autoCycleTabs() {
                var nextIndex = (currentIndex + 1) % tabJs.length;
                var activeTab = tabJs.eq(nextIndex);
                changeTab(activeTab);
                currentIndex = nextIndex;
            }

            // Start auto-play if isAutoPlay is 'yes'
            var tabCycle;
            if (isAutoPlay === 'yes') {
                tabCycle = setInterval(autoCycleTabs, intervalDuration);

                // Pause auto-cycle on hover
                $(".spel-tab-menu li button").hover(
                    function () {
                        clearInterval(tabCycle);
                        $(".progress-bar").stop();
                    },
                    function () {
                        tabCycle = setInterval(autoCycleTabs, intervalDuration);
                        updateProgressBar($("button.active .progress-bar"), intervalDuration);
                    }
                );
            }

            // New functionality: check for content overflow and show/hide scroller buttons
            function checkOverflow() {
                var tabContainer = $('.slide_nav_tabs');
                var leftBtn = $('.scroller-btn.left');
                var rightBtn = $('.scroller-btn.right');
                var containerWidth = tabContainer.outerWidth();
                var contentWidth = tabContainer[0].scrollWidth;

                if (contentWidth > containerWidth) {
                    leftBtn.show();
                    rightBtn.show();
                } else {
                    leftBtn.hide();
                    rightBtn.hide();
                }
            }

            // Call checkOverflow initially to check on page load
            checkOverflow();

            // Recheck overflow when the window is resized
            $(window).on('resize', function () {
                checkOverflow();
            });

            // Scroll left button functionality
            $('.scroller-btn.left').on('click', function () {
                $('.slide_nav_tabs').animate({ scrollLeft: '-=100px' }, 'fast');
            });

            // Scroll right button functionality
            $('.scroller-btn.right').on('click', function () {
                $('.slide_nav_tabs').animate({ scrollLeft: '+=100px' }, 'fast');
            });
        });
    })(jQuery);
</script>