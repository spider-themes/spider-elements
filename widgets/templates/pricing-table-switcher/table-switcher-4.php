<section class="app-pricing-area landpagy-table-switcher">
    <div class="bg-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <?php
        if ( !empty($settings['obj1']['id']) ) {
            ?>
            <div class="shape">
                <?php echo wp_get_attachment_image($settings['obj1']['id'], 'full' ) ?>
            </div>
            <?php
        }
        if ( !empty($settings['obj2']['id']) ) {
            ?>
            <div class="shape">
                <?php echo wp_get_attachment_image($settings['obj2']['id'], 'full' ) ?>
            </div>
            <?php
        }
        ?>
    </div>
    <div class="container">

        <div class="row">
            <div class="col-12 wow fadeInUp" data-wow-delay="0.3s">

                <nav>
                    <div class="nav d-flex justify-content-center app-pricing-switcher" id="nav-tab" role="tablist">
                        <button class="nav-link spe_pricing_title active" id="app-monthly-tab-<?php echo $this->get_id(); ?>" data-bs-toggle="tab" data-bs-target="#app-monthly-<?php echo $this->get_id(); ?>" type="button" role="tab" aria-controls="nav-monthly" aria-selected="true">
                            <?php echo esc_html($settings['tab1_title']) ?>
                        </button>
                        <button class="nav-link spe_pricing_title" id="app-annual-tab-<?php echo $this->get_id(); ?>" data-bs-toggle="tab" data-bs-target="#app-annual-<?php echo $this->get_id(); ?>" type="button" role="tab" aria-controls="app-annual" aria-selected="false">
                            <?php echo esc_html($settings['tab2_title']) ?>
                        </button>
                    </div>
                </nav>

                <div class="tab-content pricing-tab-content" id="nav-tabContent">

                    <div class="tab-pane fade show active" id="app-monthly-<?php echo $this->get_id(); ?>" role="tabpanel" aria-labelledby="app-monthly-tab-<?php echo $this->get_id(); ?>">
                        <div class="row">
                            <?php
                            $delay_time = 0.1;
                            if ( !empty($settings['pricing_table_7']) ) {
                                foreach ( $settings['pricing_table_7'] as $index => $table ) {
                                    ?>
                                    <div class="col-lg-<?php echo esc_attr($settings['column']) ?> col-md-6">
                                        <div class="app-pricing-item spe_pricing_item_wrapper wow fadeInUp" data-wow-delay="<?php echo esc_attr($delay_time) ?>s">
                                            <?php
                                            if ( !empty( $table['title'] ) ) { ?>
                                                <h4 class="item-title spe_pricing_item_header"><?php echo esc_html($table['title']) ?></h4>
                                                <?php
                                            }
                                            if ( !empty( $table['subtitle'] ) ) { ?>
                                                <p class="item-label spe_pricing_item_content"><?php echo esc_html($table['subtitle']) ?></p>
                                                <?php
                                            }
                                            if ( !empty( $table['price'] ) ) { ?>
                                                <p class="item-price">
                                                <span class="dollar spe_price">
                                                    <?php echo esc_html($table['price']) ?>
                                                    <svg width="41" height="8" viewBox="0 0 41 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                      <path fill-rule="evenodd" clip-rule="evenodd" d="M40.9227 3.61575C30.3041 -0.930024 14.6626 -0.415833 0.823485 4.01138L1.12818 4.96383C10.3105 2.02637 20.2436 0.849144 28.9038 1.72135C20.0616 1.36716 10.0547 3.17743 0.909575 6.68782L1.24441 7.62199C14.788 2.42321 30.13 1.04242 40.5827 4.8419L40.945 3.89921C40.9036 3.88417 40.8621 3.86921 40.8206 3.85433L40.9227 3.61575Z" fill="#EC595A"/>
                                                    </svg>
                                                </span>
                                                    <span class="time"><?php echo esc_html($table['duration']) ?></span>
                                                </p>
                                                <?php
                                            }
                                            if ( !empty( $table['contents'] ) ) {
                                                echo se_get_the_kses_post($table['contents']);
                                            }
                                            if ( !empty( $table['btn_label'] ) ) { ?>
                                                <a <?php se_the_button($table['btn_url']) ?> class="btn spe_pricing_item_btn">
                                                    <?php echo esc_html($table['btn_label']) ?>
                                                </a>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                    </div>
                                    <?php
                                    $delay_time += 0.2;
                                }
                            }
                            ?>
                        </div>
                    </div>


                    <div class="tab-pane fade" id="app-annual-<?php echo $this->get_id(); ?>" role="tabpanel" aria-labelledby="app-annual-tab-<?php echo $this->get_id(); ?>">
                        <div class="row">
                            <?php
                            unset( $table );
                            $delay_time = 0.1;
                            if ( !empty($settings['pricing_table_8']) ) {
                                foreach ( $settings['pricing_table_8'] as $index => $table ) {
                                    ?>
                                    <div class="col-lg-<?php echo esc_attr($settings['column']) ?> col-md-6">
                                        <div class="app-pricing-item spe_pricing_item_wrapper wow fadeInUp" data-wow-delay="<?php echo esc_attr($delay_time) ?>s">
                                            <?php
                                            if ( !empty( $table['title'] ) ) { ?>
                                                <h4 class="item-title spe_pricing_item_header"><?php echo esc_html($table['title']) ?></h4>
                                                <?php
                                            }
                                            if ( !empty( $table['subtitle'] ) ) { ?>
                                                <p class="item-label spe_pricing_item_content"><?php echo esc_html($table['subtitle']) ?></p>
                                                <?php
                                            }
                                            if ( !empty( $table['price'] ) ) { ?>
                                                <p class="item-price">
                                                <span class="dollar spe_price">
                                                    <?php echo esc_html($table['price']) ?>
                                                    <svg width="41" height="8" viewBox="0 0 41 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                      <path fill-rule="evenodd" clip-rule="evenodd" d="M40.9227 3.61575C30.3041 -0.930024 14.6626 -0.415833 0.823485 4.01138L1.12818 4.96383C10.3105 2.02637 20.2436 0.849144 28.9038 1.72135C20.0616 1.36716 10.0547 3.17743 0.909575 6.68782L1.24441 7.62199C14.788 2.42321 30.13 1.04242 40.5827 4.8419L40.945 3.89921C40.9036 3.88417 40.8621 3.86921 40.8206 3.85433L40.9227 3.61575Z" fill="#EC595A"/>
                                                    </svg>
                                                </span>
                                                    <span class="time"><?php echo esc_html($table['duration']) ?></span>
                                                </p>
                                                <?php
                                            }
                                            if ( !empty( $table['contents'] ) ) {
                                                echo se_get_the_kses_post($table['contents']);
                                            }
                                            if ( !empty( $table['btn_label'] ) ) { ?>
                                                <a <?php se_the_button($table['btn_url']) ?> class="btn spe_pricing_item_btn">
                                                    <?php echo esc_html($table['btn_label']) ?>
                                                </a>
                                                <?php
                                            }
                                            ?>

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
            </div>
        </div>
    </div>
</section>
