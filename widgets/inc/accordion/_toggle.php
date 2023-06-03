<?php
if ( $settings['title'] ) :
    $rand = rand();
    $is_collapsed = $settings['collapse_state'] == 'yes' ? 'true' : 'false';
    $collapse_class = $settings['collapse_state'] == 'yes' ? '' : 'collapsed';
    $is_show = $settings['collapse_state'] == 'yes' ? 'show' : '';
    ?>
<a class="toggle_btn <?php echo $collapse_class; ?>" href='javascript:void()' data-bs-toggle="collapse"
    data-bs-target="#toggle-<?php echo $this->get_ID(); ?>" aria-expanded="<?php echo esc_attr($is_collapsed) ?>">
    <?php echo se_get_the_kses_post($settings['title']) ?>
</a>
<?php
    if ( !empty($settings['subtitle']) ) : ?>
<div id="toggle-<?php echo $this->get_ID(); ?>" class="accordion-collapse collapse card card-body toggle_body">
    <?php echo se_get_the_kses_post($settings['subtitle']) ?>
</div>
<?php
    endif;
endif;