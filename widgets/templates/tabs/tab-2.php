<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<section class="header_tabs_area spel-tabs">
    <div class="header_tab_items sticky_tab_item tabs_sliders<?php echo esc_attr($navigation_arrow_class . $sticky_tab_class); ?>">
        <span class="scroller-btn left" id="scroll_left_btn"><i class="arrow_carrot-left"></i></span>
        <ul class="nav nav-tabs slide_nav_tabs spel-tab-menu<?php echo esc_attr($tab_auto_class); ?>" <?php echo esc_attr($data_auto_play); ?>>
            <?php
            $i = 0.2;
            if ( is_array($tabs) && !empty($tabs) ) {
                foreach ( $tabs as $index => $item ) {
                    $tab_count = $index + 1;
                    $tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);
                    $active = $tab_count == 1 ? 'active' : '';
                    $selected = $tab_count == 1 ? 'true' : 'false';
                    $this->add_render_attribute($tab_title_setting_key, [
                        'class' => [ 'nav-link tab-item-title', $active ],
                        'data-rel' => 'tab-content-' . $id_int . $tab_count,
                        'id' => 'docy'.'-tab-'.$id_int . $tab_count,
                    ]);
                    ?>
                    <li class="nav-item wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>s">
                        <button <?php echo wp_kses_post( $this->get_render_attribute_string($tab_title_setting_key) ); ?>>
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
        <span class="scroller-btn right" id="scroll_right_btn"><i class="arrow_carrot-right"></i></span>
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
                    <div <?php echo wp_kses_post( $this->get_render_attribute_string($tab_content_setting_key) ); ?>>
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
                <button class="btn btn-info tab_arrow_btn previous"><i class="arrow_carrot-left"></i></button>
                <button class="btn btn-info tab_arrow_btn next"><i class="arrow_carrot-right"></i></button>
                <?php
            }
            ?>
        </div>
    </div>
</section>

<?php
if ( $is_auto_play == 'yes' ) {
    ?>
    <script>
        (function ($) {
            'use strict';

            $(document).ready(function () {
                const intervalDuration = 5000; // Set the interval duration in milliseconds
                let currentIndex = 0; // Start with the first tab
                const tabBtns = $(".spel-tab-menu li button");
                const progressBars = $(".spel-tab-menu .progress-bar");
                let autoplayInterval;

                // Function to reset and start the progress bar animation
                function startProgressBar(index) {
                    progressBars.width(0); // Reset all progress bars
                    progressBars.eq(index).css("transition-duration", `${intervalDuration}ms`).width("100%"); // Animate the current progress bar
                }

                // Function to switch tabs
                function changeTab(index) {
                    tabBtns.removeClass("active"); // Remove active class from all tabs
                    progressBars.width(0); // Reset all progress bars
                    tabBtns.eq(index).addClass("active"); // Activate the current tab

                    const target = tabBtns.eq(index).attr("data-rel");
                    $("#" + target)
                        .addClass("active show")
                        .siblings(".tab-box")
                        .removeClass("active show");

                    startProgressBar(index); // Start progress bar for the current tab
                }

                // Auto-cycle tabs with progress bar
                function autoCycleTabs() {
                    currentIndex = (currentIndex + 1) % tabBtns.length;
                    changeTab(currentIndex);
                }

                // Pause autoplay on hover
                tabBtns.on("mouseenter", function () {
                    clearInterval(autoplayInterval);
                    progressBars.stop(); // Stop the progress bar animation
                });

                // Resume autoplay on mouse leave
                tabBtns.on("mouseleave", function () {
                    autoplayInterval = setInterval(autoCycleTabs, intervalDuration);
                    const activeIndex = tabBtns.index(tabBtns.filter(".active"));
                    startProgressBar(activeIndex); // Restart progress bar animation for the active tab
                });

                // Initialize autoplay
                if (tabBtns.length > 0) {
                    changeTab(currentIndex); // Start with the first tab
                    autoplayInterval = setInterval(autoCycleTabs, intervalDuration); // Start autoplay
                }

                // Optional: Pause autoplay when user interacts with the tab content (e.g., scroll)
                $(".tab-content").on("mouseenter", function () {
                    clearInterval(autoplayInterval);
                    progressBars.stop();
                }).on("mouseleave", function () {
                    autoplayInterval = setInterval(autoCycleTabs, intervalDuration);
                    const activeIndex = tabBtns.index(tabBtns.filter(".active"));
                    startProgressBar(activeIndex);
                });
            });
        })(jQuery);
    </script>
    <?php
}
?>