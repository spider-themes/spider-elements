<?php
if ( $settings['title'] ) :
$rand = rand();
$id = 'toggle-'.$this->get_ID();
$is_collapsed = $settings['collapse_state'] == 'yes' ? 'true' : 'false';
$is_collapsed_class = $settings['collapse_state'] == 'yes' ? '' : 'collapsed';
$is_show = $settings['collapse_state'] == 'yes' ? 'show' : '';
    ?>
    <div class="card doc_accordion">
        <div class="card-header" id="heading-<?php echo esc_attr($rand); ?>">
            <h5 class="mb-0 title">
                <button class="btn btn-link <?php echo esc_attr($is_collapsed_class) ?>" data-bs-toggle="collapse"
                        data-bs-target="#<?php echo esc_attr($id) ?>" aria-expanded="<?php echo esc_attr($is_collapsed) ?>" aria-controls="<?php echo esc_attr($id) ?>">
                    <?php echo se_get_the_kses_post($settings['title']) ?>
                    <svg width="14" height="15" viewBox="0 0 14 15" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 7.38812H1M7 1.38812V13.3881V1.38812Z"
                              stroke="#6b707f" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" />
                    </svg>
                    <svg width="14" height="3" viewBox="0 0 14 3" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                        <path d="M13 1.38812H1" stroke="#6b707f" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </h5>
        </div>
        <?php
        if ( !empty($settings['subtitle']) ) : ?>
            <div id="<?php echo esc_attr($id) ?>" class="collapse <?php echo esc_attr($is_show) ?>" aria-labelledby="heading-<?php echo esc_attr($rand); ?>">
                <div class="card-body toggle_body">
                    <?php echo se_get_the_kses_post($settings['subtitle']) ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php
endif;