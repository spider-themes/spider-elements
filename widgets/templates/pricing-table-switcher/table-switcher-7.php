<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
$section_id = 'tab-'.$this->get_id();
?>
<div class="pricing-compare-table">
    <div class="product-plan">
        <div class="text-center sub-padding">
            <ul class="nav nav-tabs pricing-switcher-2 d-flex" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="monthly2-tab" data-bs-toggle="tab" data-bs-target="#<?php echo esc_attr( $section_id ); ?>-monthly2" type="button" role="tab" aria-controls="monthly2" aria-selected="true">
                        <?php echo esc_html( $settings['tab1_title2'] ) ?>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="annual2-tab" data-bs-toggle="tab" data-bs-target="#<?php echo esc_attr( $section_id ); ?>-annual2" type="button" role="tab" aria-controls="annual2" aria-selected="false">
                        <?php echo esc_html( $settings['tab2_title2'] ) ?>
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="<?php echo esc_attr( $section_id ); ?>-monthly2" role="tabpanel" aria-labelledby="monthly2-tab">
                    <?php
                    if ( !empty( $settings['tab1_old_price']) ) { ?>
                        <p class="old-price"><?php echo esc_html($settings['tab1_old_price']) ?></p>
                        <?php
                    }
                    if ( !empty( $settings['tab1_current_price']) ) { ?>
                        <p class="current-price"><span><?php echo esc_html($settings['tab1_current_price']) ?></span><?php echo esc_html($settings['tab1_duration']) ?></p>
                        <?php
                    }
                    if ( !empty( $settings['tab1_bottom_content']) ) { ?>
                        <p class="price-format"><?php echo esc_html($settings['tab1_bottom_content']) ?></p>
                        <?php
                    }
                    if ( !empty( $settings['tab1_discount_price']) ) { ?>
                        <p class="saving-price"><?php echo esc_html($settings['tab1_discount_price']) ?></p>
                        <?php
                    }
                    ?>
                </div>
                <div class="tab-pane fade" id="<?php echo esc_attr( $section_id ); ?>-annual2" role="tabpanel" aria-labelledby="annual2-tab">
                    <?php
                    if ( !empty( $settings['tab2_old_price']) ) { ?>
                        <p class="old-price"><?php echo esc_html($settings['tab2_old_price']) ?></p>
                        <?php
                    }
                    if ( !empty( $settings['tab2_current_price']) ) { ?>
                        <p class="current-price"><span>$<?php echo esc_html($settings['tab2_current_price']) ?></span><?php echo esc_html($settings['tab2_duration']) ?></p>
                        <?php
                    }
                    if ( !empty( $settings['tab2_bottom_content']) ) { ?>
                        <p class="price-format"><?php echo esc_html($settings['tab2_bottom_content']) ?></p>
                        <?php
                    }
                    if ( !empty( $settings['tab2_discount_price']) ) { ?>
                        <p class="saving-price"><?php echo esc_html($settings['tab2_discount_price']) ?></p>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
