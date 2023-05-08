<?php
use Elementor\Plugin;
?>

<section class="header_tabs_area">
    <div class="header_tab_items">
        <div class="container">
            <ul class="nav nav-tabs" role="tablist">
                <?php
                $i = 0.2;
                foreach ( $tabs as $index => $item ) :
                    $tab_count = $index + 1;
                    $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
                    $active = $tab_count == 1 ? 'active' : '';
                    $selected = $tab_count == 1 ? 'true' : 'false';
                    $this->add_render_attribute( $tab_title_setting_key, [
                        'href' => '#docy-tab-content-' . $id_int . $tab_count,
                        'class' => [ 'nav-link tab-item-title', $active ],
                        'id' => 'docy'.'-tab-'.$id_int . $tab_count,
                        'role' => 'tab',
                        'aria-controls' => 'docy-tab-content-' . $id_int . $tab_count,
                        'data-bs-toggle' => 'tab',
                        'aria-selected' => $selected,
                    ]);
                    ?>
                    <li class="nav-item wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>s">
                        <a <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
                            <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            <?php echo wp_kses_post($item['tab_title']); ?>
                        </a>
                    </li>
                    <?php
                    $i = $i + 0.2;
                endforeach;
                ?>
            </ul>
        </div>
    </div>
    <div class="header_tab_content">
        <div class="tab-content">
            <?php
            foreach ( $tabs as $index => $item ) :
                $tab_count = $index + 1;
                $active = $tab_count == 1 ? 'show active' : '';
                $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );
                $this->add_render_attribute( $tab_content_setting_key, [
                    'class' => [ 'tab-pane p-0', 'fade', $active ],
                    'id' => 'docy-tab-content-' . $id_int . $tab_count,
                    'aria-labelledby' => 'docy'.'-tab-'.$id_int . $tab_count,
                    'role' => 'tabpanel',
                ]);
                ?>
                <div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
                    <?php
                    if ( 'content' == $item['tabs_content_type'] ) {
                        echo do_shortcode($item['tab_content']);
                    } elseif ( 'template' == $item['tabs_content_type'] ) {
                        if ( !empty($item['primary_templates']) ) {
                            echo Plugin::$instance->frontend->get_builder_content($item['primary_templates'], true);
                        }
                    }
                    ?>
                </div>
                <?php
            endforeach;
            ?>
        </div>
    </div>
</section>

<script>
    ;(function ($) {
        "use strict";

        $(document).ready(function () {

            function tabFixed() {
                var windowWidth = $(window).width();
                if ($(".header_tabs_area").length) {
                    if (windowWidth > 576) {
                        var tops = $(".header_tabs_area");
                        var tabs = $(".header_tab_items").height() + 100;
                        var leftOffset = tops.offset().top + tabs;

                        $(window).on("scroll", function () {
                            var scroll = $(window).scrollTop();
                            if (scroll >= leftOffset) {
                                tops.addClass("tab_fixed");
                            } else {
                                tops.removeClass("tab_fixed")
                            }
                            if (scroll >= leftOffset + tops.height()) {
                                tops.removeClass("tab_fixed")
                            }
                        })
                    }
                }
            }

            tabFixed()
        })
    })(jQuery);
</script>