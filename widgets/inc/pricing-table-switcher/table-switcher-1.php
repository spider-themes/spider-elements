<section class="choose-plan-area landpagy-table-switcher">
    <?php
    if ( !empty($settings['is_shape_image'] == 'yes') ) {
        ?>
        <div class="bg-shapes">
            <div class="shape"></div>
            <?php
            if ( !empty( $settings['shape1']['id'] ) ) { ?>
                <div class="shape">
                    <?php echo wp_get_attachment_image( $settings['shape1']['id'], 'full' ); ?>
                </div>
                <?php
            }
            ?>
            <div class="shape"></div>
            <?php
            if ( !empty( $settings['shape2']['id'] ) ) { ?>
                <div class="shape">
                    <?php echo wp_get_attachment_image( $settings['shape2']['id'], 'full' ); ?>
                </div>
                <?php
            }
            ?>
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <?php
    }
    ?>
    <div class="container">
        <div class="section-title-center">
            <?php
            if ( !empty( $settings['title'] ) ) { ?>
                <h2 class="title wow fadeInUp"> <?php echo esc_html($settings['title']) ?> </h2>
                <?php
            }
            if ( !empty( $settings['subtitle'] ) ) { ?>
                <p class="subtitle wow fadeInUp" data-wow-delay="0.2s"><?php echo esc_html($settings['subtitle']) ?></p>
                <?php
            }
            ?>
        </div>
        <div class="col-12 wow fadeInUp" data-wow-delay="0.1s">
            <nav>
                <div class="nav justify-content-center pricing-switcher" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-monthly-tab" data-bs-toggle="tab" data-bs-target="#nav-monthly" type="button" role="tab" aria-controls="nav-monthly" aria-selected="true">
                        <?php echo esc_html( $settings['tab1_title'] ) ?>
                    </button>
                    <button class="nav-link" id="nav-annually-tab" data-bs-toggle="tab" data-bs-target="#nav-annually" type="button" role="tab" aria-controls="nav-annually" aria-selected="false">
                        <?php echo esc_html( $settings['tab2_title'] ) ?>
                    </button>
                </div>
            </nav>

            <div class="tab-content features-tab-content" id="nav-tabContent">

                <div class="tab-pane fade show active" id="nav-monthly" role="tabpanel" aria-labelledby="nav-monthly-tab">
                    <div class="row gy-xl-0 gy-4 pricing-item-two-cotnainer">
                        <?php
                        $delay_time = 0.1;
                        if ( !empty($tables)) {
                            foreach ( $tables as $index => $table ) {
                                $active = $index == 1 ? ' active' : '';
                                $is_last_key = $table == end($tables) ? ' mx-auto ' : '';
                                ?>
                                <div class="col-xl-<?php echo esc_attr( $settings['column'] ) ?> col-md-6<?php echo esc_attr($is_last_key) ?>">
                                    <div class="pricing-item-2 wow fadeInUp<?php echo esc_attr($active); ?>" data-wow-delay="<?php echo esc_attr($delay_time) ?>s">
                                        <?php
                                        if ( !empty( $table['table_icon']['id'] ) ) {
                                            echo wp_get_attachment_image( $table['table_icon']['id'], 'full' );
                                        }
                                        if ( !empty( $table['title'] ) ) { ?>
                                            <h4> <?php echo esc_html($table['title']) ?> </h4>
                                            <?php
                                        }
                                        if ( !empty( $table['subtitle'] ) ) { ?>
                                            <p><?php echo esc_html($table['subtitle']) ?> </p>
                                            <?php
                                        }
                                        if ( !empty( $table['price'] ) ) { ?>
                                            <div class="price"> <?php echo esc_html($table['price']) ?> </div>
                                            <?php
                                        }
                                        if ( !empty( $table['contents'] ) ) { ?>
                                            <div class="pack-feature"> <?php echo esc_html($table['contents']) ?> </div>
                                            <?php
                                        }
                                        if ( !empty( $table['btn_label'] ) ) { ?>
                                            <a <?php Se_Core_Helper()->the_button($table['btn_url']) ?> class="btn">
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

                <div class="tab-pane fade" id="nav-annually" role="tabpanel" aria-labelledby="nav-annually-tab">
                    <div class="row gy-xl-0 gy-4 pricing-item-two-cotnainer">
                        <?php
                        unset( $table );
                        unset( $index );
                        foreach ( $tables2 as $index => $table ) {
                            $active     = $index == 1 ? ' active' : '';
                            $is_last_key = $table == end($tables) ? ' mx-auto ' : '';
                            ?>
                            <div class="col-xl-<?php echo esc_attr( $settings['column'] ) ?> col-md-6<?php echo esc_attr($is_last_key) ?>">
                                <div class="pricing-item-2<?php echo esc_attr($active); ?>">
                                    <?php
                                    if ( !empty( $table['table_icon']['id'] ) ) {
                                        echo wp_get_attachment_image( $table['table_icon']['id'], 'full' );
                                    }
                                    if ( !empty( $table['title'] ) ) { ?>
                                        <h4> <?php echo esc_html($table['title']) ?> </h4>
                                        <?php
                                    }
                                    if ( !empty( $table['subtitle'] ) ) { ?>
                                        <p><?php echo esc_html($table['subtitle']) ?> </p>
                                        <?php
                                    }
                                    if ( !empty( $table['price'] ) ) { ?>
                                        <div class="price"> <?php echo esc_html($table['price']) ?> </div>
                                        <?php
                                    }
                                    if ( !empty( $table['contents'] ) ) { ?>
                                        <div class="pack-feature"> <?php echo esc_html($table['contents']) ?> </div>
                                        <?php
                                    }
                                    if ( !empty( $table['btn_label'] ) ) { ?>
                                        <a <?php Se_Core_Helper()->the_button($table['btn_url']) ?> class="btn">
                                            <?php echo esc_html($table['btn_label']) ?>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>