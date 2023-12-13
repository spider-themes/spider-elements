<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<section class="choose-plan-area landpagy-table-switcher">
    <div class="wow fadeInUp" data-wow-delay="0.1s">
        <nav>
            <div class="nav justify-content-center pricing-switcher" id="nav-tab" role="tablist">

                <?php
                if ( ! empty( $settings['tab1_title'] ) ) {
                    ?>
                    <button class="nav-link spe_pricing_title active"
                            id="nav-monthly-tab-<?php echo esc_attr( $this->get_id() ); ?>" data-bs-toggle="tab"
                            data-bs-target="#nav-monthly-<?php echo esc_attr( $this->get_id() ); ?>" type="button"
                            role="tab"
                            aria-controls="nav-monthly" aria-selected="true">
                        <?php echo esc_html( $settings['tab1_title'] ) ?>
                    </button>
                    <?php
                }

                if ( ! empty( $settings['tab2_title'] ) ) {
                    ?>
                    <button class="nav-link spe_pricing_title"
                            id="nav-annually-tab-<?php echo esc_attr( $this->get_id() ); ?>" data-bs-toggle="tab"
                            data-bs-target="#nav-annually-<?php echo esc_attr( $this->get_id() ); ?>" type="button"
                            role="tab"
                            aria-controls="nav-annually" aria-selected="false">
                        <?php echo esc_html( $settings['tab2_title'] ) ?>
                    </button>
                    <?php
                }
                ?>
            </div>
        </nav>
        <div class="tab-content features-tab-content" id="nav-tabContent">

            <div class="tab-pane fade show active" id="nav-monthly-<?php echo esc_attr( $this->get_id() ); ?>"
                 role="tabpanel" aria-labelledby="nav-monthly-tab-<?php echo esc_attr( $this->get_id() ); ?>">
                <div class="ezd-grid ezd-grid-cols-12 pricing-item-two-cotnainer">
					<?php
					$delay_time = 0.1;
					if ( ! empty( $tables ) ) {
						foreach ( $tables as $index => $table ) {
							$active      = $index == 1 ? ' active' : '';
							$is_last_key = $table == end( $tables ) ? ' mx-auto ' : '';
							?>
                            <div class="ezd-lg-col-<?php echo esc_attr( $settings['column'] ) ?> ezd-md-col-6<?php echo esc_attr( $is_last_key ) ?>">
                                <div class="pricing-item-2 spe_pricing_item_wrapper wow fadeInUp<?php echo esc_attr( $active ); ?>"
                                     data-wow-delay="<?php echo esc_attr( $delay_time ) ?>s">
									<?php
									if ( ! empty( $table['table_icon']['id'] ) ) {
										echo wp_get_attachment_image( $table['table_icon']['id'], 'full' );
									}
									if ( ! empty( $table['title'] ) ) { ?>
                                        <h4 class="spe_pricing_item_header"> <?php echo esc_html( $table['title'] ) ?> </h4>
										<?php
									}
									if ( ! empty( $table['subtitle'] ) ) { ?>
                                        <p class="spe_pricing_item_content"><?php echo esc_html( $table['subtitle'] ) ?> </p>
										<?php
									}
									if ( ! empty( $table['price'] ) ) { ?>
                                        <div class="price spe_price"> <?php echo esc_html( $table['price'] ) ?> </div>
										<?php
									}
									if ( ! empty( $table['contents'] ) ) { ?>
                                        <div class="pack-feature spe_pricing_item_content">
											<?php echo esc_html( $table['contents'] ) ?> </div>
										<?php
									}
									if ( ! empty( $table['btn_label'] ) ) { ?>
                                        <a <?php spel_the_button( $table['btn_url'] ) ?>
                                                class="btn spe_pricing_item_btn">
											<?php echo esc_html( $table['btn_label'] ) ?>
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

            <div class="tab-pane fade" id="nav-annually-<?php echo esc_attr( $this->get_id() ); ?>" role="tabpanel"
                 aria-labelledby="nav-annually-tab-<?php echo esc_attr( $this->get_id() ); ?>">
                <div class="ezd-grid ezd-grid-cols-12 pricing-item-two-cotnainer">
					<?php
					unset( $table );
					unset( $index );
					foreach ( $tables2 as $index => $table ) {
						$active      = $index == 1 ? ' active' : '';
						$is_last_key = $table == end( $tables ) ? ' mx-auto ' : '';
						?>
                        <div class="ezd-lg-col-<?php echo esc_attr( $settings['column'] ) ?> ezd-md-col-6<?php echo esc_attr( $is_last_key ) ?>">
                            <div class="spe_pricing_item_wrapper pricing-item-2<?php echo esc_attr( $active ); ?>">
								<?php
								if ( ! empty( $table['table_icon']['id'] ) ) {
									echo wp_get_attachment_image( $table['table_icon']['id'], 'full' );
								}
								if ( ! empty( $table['title'] ) ) { ?>
                                    <h4 class="spe_pricing_item_header"><?php echo esc_html( $table['title'] ) ?></h4>
									<?php
								}
								if ( ! empty( $table['subtitle'] ) ) { ?>
                                    <p class="spe_pricing_item_content"><?php echo esc_html( $table['subtitle'] ) ?> </p>
									<?php
								}
								if ( ! empty( $table['price'] ) ) { ?>
                                    <div class="price spe_price"><?php echo esc_html( $table['price'] ) ?></div>
									<?php
								}
								if ( ! empty( $table['contents'] ) ) { ?>
                                    <div class="pack-feature spe_pricing_item_content">
										<?php echo esc_html( $table['contents'] ) ?></div>
									<?php
								}
								if ( ! empty( $table['btn_label'] ) ) { ?>
                                    <a <?php spel_the_button( $table['btn_url'] ) ?> class="btn spe_pricing_item_btn">
										<?php echo esc_html( $table['btn_label'] ) ?>
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
</section>