<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>
<div class="wrapper tab_shortcode">
    <div class="sticky_tab_item tabs_sliders <?php echo esc_attr($navigation_arrow_class . $sticky_tab_class); ?>">
        <span class="scroller-btn left" id="scroll_left_btn"><i class="arrow_carrot-left"></i></span>
        <ul class="nav nav-tabs ezd-d-flex slide_nav_tabs spel-tab-menu <?php echo esc_attr($tab_auto_class); ?>">
            <?php
            $i = 0.2;
            foreach ( $tabs as $index => $item ) :
                $tab_count = $index + 1;
                $tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);
                $active = $tab_count == 1 ? ' active' : '';
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
            endforeach;
            ?>
        </ul>
        <span class="scroller-btn right" id="scroll_right_btn"><i class="arrow_carrot-right"></i></span>
    </div>

    <?php
    if ( !empty($tabs) ) { ?>
        <div class="tab-content">
            <?php
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
                            echo \Elementor\Plugin::$instance->frontend->get_builder_content($item[ 'primary_templates' ], true);
                        }
                    }
                    ?>
                </div>
                <?php
            }

            if ($is_navigation_arrow == 'yes') { ?>
                <button class="btn btn-info tab_arrow_btn previous"><i class="arrow_carrot-left"></i></button>
                <button class="btn btn-info tab_arrow_btn next"><i class="arrow_carrot-right"></i></button>
                <?php
            }
            ?>
        </div>
        <?php
    }
    ?>
</div>
<script>
    ;(function ($) {
        'use strict';

        <?php if ( $is_auto_play == 'yes') : ?>

            $(document).ready(function () {

                // Function to handle tab change
                function changeTab(tabJs, index) {

                    // Remove active class from all tabs within the same menu
                    tabJs.closest(".spel-tab-menu").find("li button").removeClass("active");

                    tabJs.addClass("active");

                    let target = tabJs.attr("data-rel");

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

                // Tab click event handler
                let tabJs = $(".spel-tab-menu li button");
                let firstTab = tabJs.first();
                changeTab(firstTab, tabJs.index(firstTab));
                updateProgressBar(firstTab.find(".progress-bar"), 5000);
                tabJs.on("click", function (e) {
                    e.preventDefault();
                    changeTab($(this), tabJs.index($(this)));
                    return false;
                });

                // Auto-cycle tabs with progress bar
                let currentIndex = 0;
                let intervalDuration = 5000; // Set the interval duration in milliseconds

                function autoCycleTabs() {
                    let nextIndex = (currentIndex + 1) % tabJs.length;
                    let activeTab = tabJs.eq(nextIndex);
                    changeTab(activeTab, nextIndex);
                    currentIndex = nextIndex;
                }

                let tabCycle = setInterval(autoCycleTabs, intervalDuration);

                // Handle hover to stop and resume tab cycling and progress bar for all tabs
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

                // Function to reset progress bar
                function resetProgressBar(progressBar) {
                    progressBar.stop().width(0);
                }
            });
        <?php endif; ?>

    })(jQuery);
</script>