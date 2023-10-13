<section class="pricing-banner-2 landpagy-table-switcher">
    <ul class="nav nav-tabs pricing-switcher-2 switcher-<?php echo esc_attr( $this->get_id() ); ?> d-flex" id="myTab" role="tablist">
        <span class="switcher-bg switcher-bg-<?php echo esc_attr( $this->get_id() ); ?>"></span>
        <li class="nav-item" role="presentation">
            <button class="nav-link month active monthly-<?php echo esc_attr( $this->get_id() ); ?>" id="monthly-tab" data-bs-toggle="tab" data-bs-target="#monthly-<?php echo esc_attr( $this->get_id() ); ?>" type="button" role="tab" aria-controls="monthly" aria-selected="true">
                <?php echo esc_html( $settings['tab1_title2'] ) ?>
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link annual annual-<?php echo esc_attr( $this->get_id() ); ?>" id="annual-tab" data-bs-toggle="tab" data-bs-target="#annual-<?php echo esc_attr( $this->get_id() ); ?>" type="button" role="tab" aria-controls="annual" aria-selected="false">
                <?php echo esc_html( $settings['tab2_title2'] ) ?>
            </button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <!-------------------------- Monthly Tabs ------------------------------>
        <div class="tab-pane fade show active" id="monthly-<?php echo esc_attr( $this->get_id() ); ?>" role="tabpanel" aria-labelledby="monthly-tab-<?php echo esc_attr( $this->get_id() ); ?>">
            <?php
            if ( !empty( $settings['tab1_old_price']) ) { ?>
                <p class="old-price"><?php echo esc_html($settings['tab1_old_price']) ?></p>
                <?php
            }
            if ( !empty( $settings['tab1_current_price']) ) { ?>
                <div>
                    <p class="current-price"><?php echo esc_html($settings['tab1_current_price']) ?></p>
                    <p class="saving-price ml-15"><?php echo esc_html($settings['tab1_discount_price']) ?></p>
                </div>
                <?php
            }
            if ( !empty( $settings['tab1_bottom_content']) ) { ?>
                <p class="price-format"><?php echo esc_html($settings['tab1_bottom_content']) ?></p>
                <?php
            }
            ?>
        </div>
        <!-------------------------- Yearly Tabs ------------------------------>
        <div class="tab-pane fade" id="annual-<?php echo esc_attr( $this->get_id() ); ?>" role="tabpanel" aria-labelledby="annual-tab-<?php echo esc_attr( $this->get_id() ); ?>">
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

<script>
(function($){
    $(document).ready(function(){
        $('.annual-<?php echo esc_attr( $this->get_id() ); ?>').click(function(){
            $('.switcher-bg-<?php echo esc_attr( $this->get_id() ); ?>').addClass('right');
        });
        $('.monthly-<?php echo esc_attr( $this->get_id() ); ?>').click(function(){
            $('.switcher-bg-<?php echo esc_attr( $this->get_id() ); ?>').removeClass('right');
        });
    })
})(jQuery);
</script>