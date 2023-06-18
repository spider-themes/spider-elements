<section class="choose-plan-area-three landpagy-table-switcher">
    <nav>
        <div class="nav justify-content-center pricing-switcher" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-monthly-tab-<?php echo $this->get_id(); ?>" data-bs-toggle="tab" data-bs-target="#nav-monthly-<?php echo $this->get_id(); ?>" type="button" role="tab" aria-controls="nav-monthly" aria-selected="true">
                <?php echo esc_html( $settings['tab1_title'] ) ?>
            </button>
            <button class="nav-link" id="nav-annually-tab-<?php echo $this->get_id(); ?>" data-bs-toggle="tab" data-bs-target="#nav-annually-<?php echo $this->get_id(); ?>" type="button" role="tab" aria-controls="nav-annually" aria-selected="false">
                <?php echo esc_html( $settings['tab2_title'] ) ?>
            </button>
        </div>
    </nav>
    <div class="tab-content features-tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-monthly-<?php echo $this->get_id(); ?>" role="tabpanel" aria-labelledby="nav-monthly-tab-<?php echo $this->get_id(); ?>">
            <div class="row gy-xl-0 gy-4 pricing-item-two-cotnainer">
                <?php
                $key = 1;
                $delay_time = 0.1;
                if ( !empty($settings['pricing_table_9'])) {
                    foreach ( $settings['pricing_table_9'] as $key => $table ) {
                        $align_class = $key == 2 ? ' mx-auto' : '';
                        $active = $key == 1 ? ' active' : '';
                        ?>
                        <div class="col-xl-<?php echo esc_attr( $settings['column'] ) ?> col-md-6<?php echo esc_attr($align_class) ?>">
                            <div class="pricing-item<?php echo esc_attr($active) ?> wow fadeInUp elementor-repeater-item-<?php echo esc_attr($table['_id']) ?>" data-wow-delay="0.1s">
                                <?php
                                if ( !empty( $table['title'] ) ) { ?>
                                    <h4> <?php echo esc_html($table['title']) ?> </h4>
                                    <?php
                                }
                                if ( !empty( $table['price'] ) ) { ?>
                                    <div class="price">
                                        <?php echo esc_html($table['price']) ?>
                                        <span><?php echo esc_html($table['duration']) ?></span>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="list-wrapp">
                                    <?php
                                    if ( !empty( $table['f_title'] ) ) { ?>
                                        <p class="list-title"><?php echo esc_html($table['f_title']) ?></p>
                                        <?php
                                    }
                                    echo !empty($table['contents']) ? se_get_the_kses_post($table['contents']) : '';
                                    ?>
                                </div>
                                <?php
                                if ( !empty( $table['btn_label'] ) ) { ?>
                                    <a <?php se_the_button($table['btn_url']) ?> class="btn">
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

        <div class="tab-pane fade" id="nav-annually-<?php echo $this->get_id(); ?>" role="tabpanel" aria-labelledby="nav-annually-tab-<?php echo $this->get_id(); ?>">
            <div class="row gy-xl-0 gy-4 pricing-item-two-cotnainer">
                <?php
                unset($key);
                unset($table);
                $key = 1;
                $delay_time = 0.1;
                if ( !empty($settings['pricing_table_10'])) {
                    foreach ( $settings['pricing_table_10'] as $key => $table ) {
                        $align_class = $key == 2 ? ' mx-auto' : '';
                        $active = $key == 1 ? ' active' : '';
                        ?>
                        <div class="col-xl-<?php echo esc_attr( $settings['column'] ) ?> col-md-6<?php echo esc_attr($align_class) ?>">
                            <div class="pricing-item<?php echo esc_attr($active) ?> wow fadeInUp elementor-repeater-item-<?php echo esc_attr($table['_id']) ?>" data-wow-delay="0.1s">
                                <?php
                                if ( !empty( $table['title'] ) ) { ?>
                                    <h4> <?php echo esc_html($table['title']) ?> </h4>
                                    <?php
                                }
                                if ( !empty( $table['price'] ) ) { ?>
                                    <div class="price">
                                        <?php echo esc_html($table['price']) ?>
                                        <span><?php echo esc_html($table['duration']) ?></span>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="list-wrapp">
                                    <?php
                                    if ( !empty( $table['f_title'] ) ) { ?>
                                        <p class="list-title"><?php echo esc_html($table['f_title']) ?></p>
                                        <?php
                                    }
                                    echo !empty($table['contents']) ? se_get_the_kses_post($table['contents']) : '';
                                    ?>
                                </div>
                                <?php
                                if ( !empty( $table['btn_label'] ) ) { ?>
                                    <a <?php se_the_button($table['btn_url']) ?> class="btn">
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
</section>