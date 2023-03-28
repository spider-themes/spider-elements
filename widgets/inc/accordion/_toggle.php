<?php
if ( $settings['title'] ) :
    $rand = rand();
    $is_collapsed = $settings['collapse_state'] == 'yes' ? 'true' : 'false';
    $collapse_class = $settings['collapse_state'] == 'yes' ? '' : 'collapsed';
    $is_show = $settings['collapse_state'] == 'yes' ? 'show' : '';
    ?>
    <a class="toggle_btn <?php echo $collapse_class; ?>" data-bs-toggle="collapse" href="#toggle-<?php echo $this->get_ID(); ?>" role="button" aria-expanded="<?php echo esc_attr($is_collapsed) ?>"
       aria-controls="toggle-<?php echo $this->get_ID(); ?>">
        <?php echo wp_kses_post($settings['title']) ?>
    </a>
    <?php
    if ( !empty($settings['subtitle']) ) : ?>
        <div class="collapse multi-collapse <?php echo esc_attr($is_show); ?>" id="toggle-<?php echo $this->get_ID(); ?>">
            <div class="card card-body toggle_body">
                <?php echo wp_kses_post($settings['subtitle']) ?>
            </div>
        </div>
        <?php
    endif;
endif;