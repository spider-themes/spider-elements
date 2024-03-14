<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<div class="wrapper tab_shortcode">
    <div class="sticky_tab_item tabs_sliders <?php echo esc_attr($navigation_arrow_class . $sticky_tab_class); ?>">
        <span class="scroller-btn left"><i class="arrow_carrot-left"></i></span>
        <ul class="nav nav-tabs ezd-d-flex slide_nav_tabs ezd-tab-menu <?php echo esc_attr($tab_auto_class); ?>">
            <?php
            $i = 0.2;
            foreach ( $tabs as $index => $item ) :
                $tab_count = $index + 1;
                $tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);
                $active = $tab_count == 1 ? 'active' : '';
                $selected = $tab_count == 1 ? 'true' : 'false';
                $this->add_render_attribute($tab_title_setting_key, [
                    'class' => [ 'nav-link tab-item-title spe_tab_title', $active ],
                    'data-rel' => 'tab-content-' . $id_int . $tab_count,
                ]);
                ?>
                <li class="nav-item wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>s">
                    <button <?php echo $this->get_render_attribute_string($tab_title_setting_key) ?>>
                        <?php if ($is_auto_play == 'yes') : ?>
                            <div class="tab_progress">
                                <div class="progress-bar"></div>
                            </div>
                        <?php endif; ?>
                        <?php if ($is_auto_numb == 'yes') : ?>
                            <span class="numb"><?php echo esc_html($tab_count) ?></span>
                        <?php endif; ?>
                        <?php \Elementor\Icons_Manager::render_icon($item[ 'icon' ]); ?>
                        <?php echo esc_html($item[ 'tab_title' ]); ?>
                    </button>
                </li>
                <?php
                $i = $i + 0.2;
            endforeach;
            ?>
        </ul>
        <span class="scroller-btn right" id="right"><i class="arrow_carrot-right"></i></span>
    </div>
    <div class="tab-content">
        <?php
        foreach ( $tabs as $index => $item ) {
            $tab_count = $index + 1;
            $active = $tab_count == 1 ? 'show active' : '';
            $tab_content_setting_key = $this->get_repeater_setting_key('tab_content', 'tabs', $index);
            $this->add_render_attribute($tab_content_setting_key, [
                'class' => [ 'tab-pane p-0 tab_style ezd-tab-box', 'fade', $active ],
                'id' => 'tab-content-' . $id_int . $tab_count,
            ]);
            ?>
            <div <?php echo $this->get_render_attribute_string($tab_content_setting_key) ?>>
                <?php
                if ('content' == $item[ 'tabs_content_type' ]) {
                    echo do_shortcode($item[ 'tab_content' ]);
                } elseif ('template' == $item[ 'tabs_content_type' ]) {
                    if (!empty($item[ 'primary_templates' ])) {
                        echo wp_kses_post(\Elementor\Plugin::$instance->frontend->get_builder_content($item[ 'primary_templates' ]));
                    }
                }
                ?>
            </div>
            <?php
        }

        if ($is_navigation_arrow == 'yes') { ?>
            <button class="btn btn-info ezd_tab_arrow_btn previous"><i class="arrow_carrot-left"></i></button>
            <button class="btn btn-info ezd_tab_arrow_btn nexts"><i class="arrow_carrot-right"></i></button>
            <?php
        }
        ?>
    </div>
</div>
<script>
    ;(function ($) {
        'use strict';

        <?php if ($is_auto_play == 'yes') : ?>
            $(document).ready(function () {
                // Function to handle tab change
                function changeTab(tabJs, index) {
                    // Remove active class from all tabs within the same menu
                    tabJs.closest(".ezd-tab-menu").find("li button").removeClass("active");

                    tabJs.addClass("active");

                    var target = tabJs.attr("data-rel");

                    $("#" + target)
                        .addClass("active")
                        .siblings(".ezd-tab-box")
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

                // Tab click event handler
                var tabJs = $(".ezd-tab-menu li button");
                var firstTab = tabJs.first();
                changeTab(firstTab, tabJs.index(firstTab));
                updateProgressBar(firstTab.find(".progress-bar"), 5000);
                tabJs.on("click", function (e) {
                    e.preventDefault();
                    changeTab($(this), tabJs.index($(this)));
                    return false;
                });

                // Auto-cycle tabs with progress bar
                var currentIndex = 0;
                var intervalDuration = 5000; // Set the interval duration in milliseconds

                function autoCycleTabs() {
                    var nextIndex = (currentIndex + 1) % tabJs.length;
                    var activeTab = tabJs.eq(nextIndex);
                    changeTab(activeTab, nextIndex);
                    currentIndex = nextIndex;
                }

                var tabCycle = setInterval(autoCycleTabs, intervalDuration);

                // Handle hover to stop and resume tab cycling and progress bar for all tabs
                $(".ezd-tab-menu li button").hover(
                    function () {
                        clearInterval(tabCycle);
                        $(".progress-bar").stop();
                    },
                    function () {
                        tabCycle = setInterval(autoCycleTabs, intervalDuration);
                        updateProgressBar($("button.active .progress-bar"), intervalDuration);
                    }
                );

                // Function to reset progress bar
                function resetProgressBar(progressBar) {
                    progressBar.stop().width(0);
                }
            });
        <?php else : ?>
        let tabJs = $(".ezd-tab-menu li button");
        tabJs.on("click", function (e) {
            e.preventDefault();

            // Remove active class from all tabs within the same menu
            $(this).closest(".ezd-tab-menu").find("li button").removeClass("active");

            // Add active class to the clicked tab
            $(this).addClass("active");

            var target = $(this).attr("data-rel");

            $("#" + target)
                .addClass("active")
                .siblings(".ezd-tab-box")
                .removeClass("active");

            return false;
        });
        <?php endif; ?>
    })(jQuery);
</script>