<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>
<div class="accordion" <?php echo esc_attr($toggle_id); ?>>
    <?php
	if (!empty($accordions)) {
		foreach ($accordions as $item) {
			$is_coFllapsed_class = $item['collapse_state'] ?? '';
			$is_btn_collapse     = $is_coFllapsed_class == 'yes' ? 'spe-collapsed' : '';
			$is_collapsed        = $is_coFllapsed_class == 'yes' ? 'true' : 'false';
			$id                  = 'toggle-' . $item['_id'] ?? '';
			$is_show             = $is_coFllapsed_class == 'yes' ? 'show' : '';
	        ?>
            <div class="card doc_accordion spe_accordion_inner <?php echo esc_attr($is_btn_collapse) ?>">
                <div class="card-header spe-accordion" id="heading-<?php echo esc_attr($item['_id']); ?>">
                    <h3 class="title">
                        <button class="btn btn-link <?php echo esc_attr($icon_align_class); ?>">
                            <?php

                            echo esc_html($item['title']);

                            if (!empty($settings['plus-icon']['value']) || !empty($settings['minus-icon']['value'])) { ?>
                                <span class="icon-wrapper">
                                    <span class="expanded-icon">
                                        <?php \Elementor\Icons_Manager::render_icon($settings['plus-icon'], ['aria-hidden' => 'true']); ?>
                                    </span>
                                    <span class="collapsed-icon">
                                        <?php \Elementor\Icons_Manager::render_icon($settings['minus-icon'], ['aria-hidden' => 'true']); ?>
                                    </span>
                                </span>
                                <?php
                            }
                            ?>
                        </button>
                    </h3>
                </div>

                <div id="<?php echo esc_attr($id) ?>" class="collapse <?php echo esc_attr($is_show) ?>"
                    <?php echo esc_attr($toggle_bs_parent_id); ?>>
                    <div class="card-body toggle_body">
                        <?php
                        $content_type = $item['content_type'] ?? '';
                        if ($content_type == 'content') {
                            echo wp_kses_post($item['normal_content']);
                        } elseif ($content_type == 'el_template') {
                            if (!empty($item['el_content'])) {
                                echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($item['el_content']);
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
		}
	}
    ?>
</div>