<div class="cloud-pricing-wrapp wow fadeInRight landpagy-table-switcher" data-wow-delay="0.4s">
    <nav>
        <div class="nav nav-tabs d-flex" id="nav-tab" role="tablist">
            <button class="nav-link active" id="cloud-monthly-tab-<?php echo $this->get_id(); ?>" data-bs-toggle="tab" data-bs-target="#cloud-monthly-<?php echo $this->get_id(); ?>" type="button" role="tab" aria-controls="cloud-monthly" aria-selected="true">
                <span></span>
                <?php echo esc_html( $settings['tab1_title'] ) ?>
            </button>
            <button class="nav-link" id="cloud-annually-tab-<?php echo $this->get_id(); ?>" data-bs-toggle="tab" data-bs-target="#cloud-annually-<?php echo $this->get_id(); ?>" type="button" role="tab" aria-controls="cloud-annually" aria-selected="false">
                <span></span>
                <?php echo esc_html( $settings['tab2_title'] ) ?>
            </button>
        </div>
    </nav>
    <div class="tab-content d-flex">
        <div class="tab-pane fade show active" id="cloud-monthly-<?php echo $this->get_id(); ?>" role="tabpanel" aria-labelledby="cloud-monthly-tab-<?php echo $this->get_id(); ?>">
            <?php
            $delay_time = 0.1;
            if ( !empty($settings['pricing_table_5'])) {
                foreach ( $settings['pricing_table_5'] as $index => $table ) {
                    ?>
                    <div class="cloud-pricing-item">
                        <?php
                        if ( !empty( $table['title'] ) ) { ?>
                            <div class="plan">
                                <p class="label">
                                    <?php echo esc_html($table['title']) ?>
                                    <?php if ($table['is_favorite'] == 'yes') : ?>
                                        <span class="tag"><i class="fas fa-heart"></i></span>
                                    <?php endif; ?>
                                </p>
                                <p class="space"><?php echo esc_html($table['subtitle']) ?></p>
                            </div>
                            <?php
                        }
                        if ( !empty( $table['contents'] ) ) { ?>
                            <div class="content">
                                <p class="plan-text">
                                    <?php echo esc_html($table['contents']) ?>
                                </p>
                            </div>
                            <?php
                        }
                        if ( !empty( $table['price'] ) ) { ?>
                            <div class="price">
                                <p class="type"><?php echo esc_html($table['price']) ?></p>
                                <?php if ( !empty( $table['btn_label'] ) ) : ?>
                                    <a <?php se_the_button($table['btn_url']) ?> class="btn-purchase">
                                        <?php echo esc_html($table['btn_label']) ?>
                                    </a>
                                <?php endif ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <div class="tab-pane fade" id="cloud-annually-<?php echo $this->get_id(); ?>" role="tabpanel" aria-labelledby="cloud-annually-tab-<?php echo $this->get_id(); ?>">
            <?php
            unset( $table );
            $delay_time = 0.1;
            if ( !empty($settings['pricing_table_6'])) {
                foreach ( $settings['pricing_table_6'] as $index => $table ) {
                    ?>
                    <div class="cloud-pricing-item">
                        <?php
                        if ( !empty( $table['title'] ) ) { ?>
                            <div class="plan">
                                <p class="label">
                                    <?php echo esc_html($table['title']) ?>
                                    <?php if ($table['is_favorite'] == 'yes') : ?>
                                        <span class="tag"><i class="fas fa-heart"></i></span>
                                    <?php endif; ?>
                                </p>
                                <p class="space"><?php echo esc_html($table['subtitle']) ?></p>
                            </div>
                            <?php
                        }
                        if ( !empty( $table['contents'] ) ) { ?>
                            <div class="content">
                                <p class="plan-text">
                                    <?php echo esc_html($table['contents']) ?>
                                </p>
                            </div>
                            <?php
                        }
                        if ( !empty( $table['price'] ) ) { ?>
                            <div class="price">
                                <p class="type"><?php echo esc_html($table['price']) ?></p>
                                <?php if ( !empty( $table['btn_label'] ) ) : ?>
                                    <a <?php se_the_button($table['btn_url']) ?> class="btn-purchase">
                                        <?php echo esc_html($table['btn_label']) ?>
                                    </a>
                                <?php endif ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>