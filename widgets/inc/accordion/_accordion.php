<?php
$get_id             = $settings['_id'] ?? '';
$title_tag          = ! empty ( $settings['title_tag'] ) ? $settings['title_tag'] : 'h6';
$se_accordion       = ! empty ( $settings['se_accordion'] ) ? $settings['se_accordion'] : '';
$se_toggle          = ! empty ( $settings['se-toggle'] ) ? $settings['se-toggle'] : '';
$icon_align         = ! empty ( $settings['icon_align'] ) ? $settings['icon_align'] : 'right';
$icon_align_class   = ! empty ( $icon_align == 'left' ) ? ' icon-align-left' : '';

use \Elementor\Icons_Manager;
$is_toggle = '';
if ( $se_toggle != 'yes' ) {
    $is_toggle = 'accordion-'.$get_id;
}
?>
<div class="accordion" id="<?php echo $is_toggle; ?>">
<?php

if ( ! empty ( $se_accordion ) ) :
    foreach( $se_accordion as $accordions ) :
        $is_coFllapsed_class    = $accordions['collapse_state'] ?? '';
        $is_btn_collapse        = $is_coFllapsed_class == 'yes' ? '' : 'collapsed';
        $is_collapsed           = $is_coFllapsed_class == 'yes' ? 'true' : 'false';
        $id                     = 'toggle-'.$accordions['_id'] ?? '';
        $is_show                = $is_coFllapsed_class == 'yes' ? 'show' : '';
        ?>
        <div class="card doc_accordion">
            <div class="card-header" id="heading-<?php echo esc_attr($accordions['_id']); ?>">
                <<?php echo $title_tag; ?> class="mb-0 title">
                    <button class="btn btn-link <?php echo esc_attr($is_btn_collapse . $icon_align_class ); ?>" data-bs-toggle="collapse" data-bs-target="#<?php echo esc_attr($id) ?>" aria-expanded="<?php echo esc_attr($is_collapsed) ?>" aria-controls="<?php echo esc_attr($id) ?>">
                        <?php
                        echo $accordions['se_accordion_title'] ?? '';
                        ?>
                            <span class="icon-wrapper">
                                <span class="expanded-icon">
                                    <?php Icons_Manager::render_icon( $settings['plus-icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>

                                <span class="collapsed-icon">
                                    <?php Icons_Manager::render_icon( $settings['minus-icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                            </span>

                    </button>
                </<?php echo $title_tag[0] ?? ''; ?>>
            </div>

            <div id="<?php echo esc_attr($id) ?>" class="collapse <?php echo esc_attr($is_show) ?>" aria-labelledby="heading-<?php echo esc_attr($accordions['_id']); ?>" data-bs-parent="#accordion-<?php echo esc_attr($settings['_id'] ?? ''); ?>">
                <div class="card-body toggle_body">

                    <?php
                    $content_type       = $accordions['content_type'] ?? '';
                    if ( $content_type == 'content' ) {
                        echo wp_kses_post($accordions['normal_content'] ?? '' );
                    } else {
                        $template_id    = $accordions['el_content'] ?? '';
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

        <?php
    endforeach;
endif;
?>