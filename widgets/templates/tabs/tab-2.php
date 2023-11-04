<section class="header_tabs_area">
    <div
        class="header_tab_items sticky_tab_item tabs_sliders <?php echo esc_attr($navigation_arrow_class . $sticky_tab_class ); ?>">
        <span class="scroller-btn left"><i class="arrow_carrot-left"></i></span>
        <ul class="nav nav-tabs slide_nav_tabs ezd-tab-menu">
            <?php
            $i = 0.2;
            foreach ( $tabs as $index => $item ) :
                $tab_count = $index + 1;
                $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );
                $active = $tab_count == 1 ? 'active' : '';
                $selected = $tab_count == 1 ? 'true' : 'false';
                $this->add_render_attribute( $tab_title_setting_key, [
                    'class' => [ 'nav-link tab-item-title spe_tab_title', $active ],
                    'id' => 'tab-'.$id_int . $tab_count,
                    'role' => 'tab',
                    'data-bs-toggle' => 'tab',
                    'aria-controls' => 'tab-content-' . $id_int . $tab_count,
                    'data-rel' => 'tab-content-' . $id_int . $tab_count,
                    'aria-selected' => $selected,
                ]);
                ?>
            <li class="nav-item wow fadeInUp" data-wow-delay="<?php echo esc_attr($i); ?>s">
                <button <?php echo $this->get_render_attribute_string( $tab_title_setting_key ); ?>>
                    <?php if ( $is_auto_numb == 'yes' ) : ?>
                    <span class="numb"><?php echo esc_html($tab_count) ?></span>
                    <?php endif; ?>
                    <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <?php echo esc_html($item['tab_title']); ?>
                </button>
            </li>
            <?php
                $i = $i + 0.2;
            endforeach;
            ?>
        </ul>
        <span class="scroller-btn right" id="right"><i class="arrow_carrot-right"></i></span>
    </div>
    <div class="header_tab_content">
        <div class="tab-content">
            <?php
            foreach ( $tabs as $index => $item ) {
                $tab_count = $index + 1;
                $active = $tab_count == 1 ? 'show active' : '';
                $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );
                $this->add_render_attribute( $tab_content_setting_key, [
                    'class' => [ 'tab-pane p-0 ezd-tab-box', 'fade', $active ],
                    'id' => 'tab-content-' . $id_int . $tab_count,
                    'aria-labelledby' => 'tab-'.$id_int . $tab_count,
                    'role' => 'tabpanel',
                ]);
                ?>
            <div <?php echo $this->get_render_attribute_string( $tab_content_setting_key ); ?>>
                <?php
                    if ( 'content' == $item['tabs_content_type'] ) {
                        echo do_shortcode($item['tab_content']);
                    } elseif ( 'template' == $item['tabs_content_type'] ) {
                        if ( !empty($item['primary_templates']) ) {
                            echo \Elementor\plugin::$instance->frontend->get_builder_content($item['primary_templates'], true);
                        }
                    }
                    ?>
            </div>
            <?php
            }

            if ( $is_navigation_arrow == 'yes' ) { ?>
            <button class="ezd_tab_arrow_btn previous"><i class="arrow_carrot-left"></i></button>
            <button class="ezd_tab_arrow_btn next"><i class="arrow_carrot-right"></i></button>
            <?php
            }

            ?>
        </div>
    </div>
</section>