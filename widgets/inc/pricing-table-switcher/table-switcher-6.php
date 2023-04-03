<section class="pricing-banner-2 landpagy-table-switcher">
    <ul class="nav nav-tabs pricing-switcher-2 d-flex" id="myTab" role="tablist">
        <span class="switcher-bg"></span>
        <li class="nav-item" role="presentation">
            <button class="nav-link month active" id="monthly-tab" data-bs-toggle="tab" data-bs-target="#monthly" type="button" role="tab" aria-controls="monthly" aria-selected="true">
                <?php echo esc_html( $settings['tab1_title2'] ) ?>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link annual" id="annual-tab" data-bs-toggle="tab" data-bs-target="#annual" type="button" role="tab" aria-controls="annual" aria-selected="false">
                <?php echo esc_html( $settings['tab2_title2'] ) ?>
            </button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <!-------------------------- Monthly Tabs ------------------------------>
        <div class="tab-pane fade show active" id="monthly" role="tabpanel" aria-labelledby="monthly-tab">
            <?php
            if ( !empty( $settings['old_price']) ) { ?>
                <p class="old-price"><?php echo esc_html($settings['old_price']) ?></p>
                <?php
            }
            if ( !empty( $settings['current_price']) ) { ?>
                <div>
                    <p class="current-price"><?php echo esc_html($settings['current_price']) ?></p>
                    <p class="saving-price ml-15"><?php echo esc_html($settings['discount_price']) ?></p>
                </div>
                <?php
            }
            if ( !empty( $settings['bottom_content']) ) { ?>
                <p class="price-format"><?php echo esc_html($settings['bottom_content']) ?></p>
                <?php
            }
            ?>
        </div>
        <!-------------------------- Yearly Tabs ------------------------------>
        <div class="tab-pane fade" id="annual" role="tabpanel" aria-labelledby="annual-tab">
            <?php
            if ( !empty( $settings['tab2_old_price']) ) { ?>
                <p class="old-price"><?php echo esc_html($settings['tab2_old_price']) ?></p>
                <?php
            }
            if ( !empty( $settings['tab2_current_price']) ) { ?>
                <div>
                    <p class="current-price"><?php echo esc_html($settings['tab2_current_price']) ?></p>
                    <p class="saving-price ml-15"><?php echo esc_html($settings['tab2_discount_price']) ?></p>
                </div>
                <?php
            }
            if ( !empty( $settings['tab2_bottom_content']) ) { ?>
                <p class="price-format"><?php echo esc_html($settings['tab2_bottom_content']) ?></p>
                <?php
            }
            ?>
        </div>
    </div>
</section>