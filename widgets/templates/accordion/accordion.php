<div class="accordion" id="<?php echo $is_toggle; ?>">
    <?php
    if ( ! empty ( $accordions ) ) {
        foreach( $accordions as $item ) {
            $is_coFllapsed_class    = $item['collapse_state'] ?? '';
            $is_btn_collapse        = $is_coFllapsed_class == 'yes' ? '' : 'collapsed';
            $is_collapsed           = $is_coFllapsed_class == 'yes' ? 'true' : 'false';
            $id                     = 'toggle-'.$item['_id'] ?? '';
            $is_show                = $is_coFllapsed_class == 'yes' ? 'show' : '';
            ?>
            <div class="card doc_accordion">
                <div class="accordion_main_aria">
                    <div class="card-header" id="heading-<?php echo esc_attr($item['_id']); ?>">
                        <<?php echo $title_tag; ?> class="mb-0 title">
                            <button class="btn btn-link <?php echo esc_attr($is_btn_collapse . $icon_align_class ); ?>" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($id) ?>" aria-expanded="<?php echo esc_attr($is_collapsed) ?>" aria-controls="<?php echo esc_attr($id) ?>">
                                <?php echo $item['title'] ?? ''; ?>
                                    <span class="icon-wrapper">
                                        <span class="expanded-icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $settings['plus-icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </span>
                                        <span class="collapsed-icon">
                                            <?php \Elementor\Icons_Manager::render_icon( $settings['minus-icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </span>
                                    </span>
                            </button>
                        </<?php echo $title_tag[0] ?? ''; ?>>
                    </div>

                    <div id="<?php echo esc_attr($id) ?>" class="collapse <?php echo esc_attr($is_show) ?>" aria-labelledby="heading-<?php echo esc_attr($item['_id']); ?>" data-bs-parent="#accordion-<?php echo esc_attr($settings['_id'] ?? ''); ?>">
                        <div class="card-body toggle_body">
                            <?php
                            $content_type       = $item['content_type'] ?? '';
                            if ( $content_type == 'content' ) {
                                echo wp_kses_post($item['normal_content'] );
                            } else {
                                $template_id    = $item['el_content'] ?? '';
                                $args = array(
                                    'post_type'         => 'elementor_library',
                                    'posts_per_page'    => -1,
                                    'p'                 => $template_id
                                );
                                $templates_query        = new WP_Query( $args );

                                if ( $templates_query->have_posts() ) {
                                    while ( $templates_query->have_posts() ) {
                                        $templates_query->the_post();
                                        $content = get_the_content();
                                        echo  apply_filters( 'the_content',  $content );
                                    }
                                    wp_reset_postdata();
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
            <?php
        }
    }
    ?>
</div>
