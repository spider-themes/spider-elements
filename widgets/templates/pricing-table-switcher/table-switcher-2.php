<section class="pricing-area-two landpagy-table-switcher">
    <div class="text-center wow fadeInUp" data-wow-delay="0.2s">
        <ul class="nav nav-tabs pricing-tabs-two" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab-<?php echo $this->get_id(); ?>" data-bs-toggle="tab" data-bs-target="#home-<?php echo $this->get_id(); ?>" type="button" role="tab" aria-controls="home" aria-selected="true">
                    <?php echo esc_html( $settings['tab1_title'] ) ?>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab-<?php echo $this->get_id(); ?>" data-bs-toggle="tab" data-bs-target="#profile-<?php echo $this->get_id(); ?>" type="button" role="tab" aria-controls="profile" aria-selected="false">
                    <?php echo esc_html( $settings['tab2_title'] ) ?>
                </button>
            </li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade show active" id="home-<?php echo $this->get_id(); ?>" role="tabpanel" aria-labelledby="home-tab-<?php echo $this->get_id(); ?>">
            <div class="row align-items-end gy-4 gy-lg-0">
                <?php
                $key = 1;
                $delay_time = 0.1;
                if ( !empty($settings['pricing_table_3'])) {
                    foreach ( $settings['pricing_table_3'] as $key => $table ) {
                        $col_class = $key == 1 ? ' mx-auto' : '';
                        $align_class = $key == 1 ? ' middle' : '';
                        ?>
                        <div class="col-lg-<?php echo esc_attr( $settings['column'] ) ?> col-md-6 <?php echo esc_attr($col_class) ?>">
                            <div class="pricing-item-3 spe_pricing_item_wrapper<?php echo esc_attr($align_class) ?> elementor-repeater-item-<?php echo esc_attr($table['_id']) ?>">
                                <?php
                                if ( !empty( $table['title'] ) ) { ?>
                                    <h5 class="spe_pricing_item_header"> <?php echo esc_html($table['title']) ?> </h5>
                                    <?php
                                }
                                ?>
                                <div class="price-body">
                                    <?php
                                    if ( !empty( $table['price'] ) ) { ?>
                                        <div class="price spe_price"><?php echo esc_html($table['price']) ?><?php if ( !empty($table['duration']) ) : ?><span>/</span><span><?php echo esc_html($table['duration']) ?></span><?php endif; ?>
                                        </div>
                                        <?php
                                    }

                                    echo !empty($table['contents']) ? se_get_the_kses_post($table['contents']) : '';

                                    if ( !empty( $table['btn_label'] ) ) { ?>
                                        <a <?php se_the_button($table['btn_url']) ?> class="btn spe_pricing_item_btn">
                                            <?php echo esc_html($table['btn_label']) ?>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $delay_time += 0.2;
                    }
                }
                ?>
            </div>
        </div>
        <div class="tab-pane fade" id="profile-<?php echo $this->get_id(); ?>" role="tabpanel" aria-labelledby="profile-tab-<?php echo $this->get_id(); ?>">
            <div class="row align-items-end gy-4 gy-lg-0">
                <?php
                unset( $table );
                unset( $key );
                $key = 1;
                $delay_time = 0.1;
                if ( !empty($settings['pricing_table_4'])) {
                    foreach ( $settings['pricing_table_4'] as $key => $table ) {
                        $col_class = $key == 1 ? ' mx-auto' : '';
                        $align_class = $key == 1 ? ' middle' : '';
                        ?>
                        <div class="col-lg-<?php echo esc_attr( $settings['column'] ) ?> col-md-6 <?php echo esc_attr($col_class) ?>">
                            <div class="pricing-item-3 spe_pricing_item_wrapper wow fadeInUp<?php echo esc_attr($align_class) ?> elementor-repeater-item-<?php echo esc_attr($table['_id']) ?>" data-wow-delay="<?php echo esc_attr($delay_time) ?>s">
                                <?php
                                if ( !empty( $table['title'] ) ) { ?>
                                    <h5 class="spe_pricing_item_header"> <?php echo esc_html($table['title']) ?> </h5>
                                    <?php
                                }
                                ?>
                                <div class="price-body">
                                    <?php
                                    if ( !empty( $table['price'] ) ) { ?>
                                        <div class="price spe_price">
                                            <?php echo esc_html($table['price']) ?><?php if ( !empty($table['duration']) ) : ?><span>/</span><span><?php echo esc_html($table['duration']) ?></span><?php endif; ?>
                                        </div>
                                        <?php
                                    }

                                    echo !empty($table['contents']) ? se_get_the_kses_post($table['contents']) : '';

                                    if ( !empty( $table['btn_label'] ) ) { ?>
                                        <a <?php se_the_button($table['btn_url']) ?> class="btn spe_pricing_item_btn">
                                            <?php echo esc_html($table['btn_label']) ?>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php
                        $delay_time += 0.2;
                    }
                }
                ?>
            </div>
        </div>
    </div>
</section>