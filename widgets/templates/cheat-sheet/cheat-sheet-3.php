<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
// Get settings for display
$settings = $this->get_settings_for_display();

// Ensure default 'collapse_state' is set to 'yes' for expanded (show) by default
$is_collapsed_class = $settings['collapse_state'] === 'yes' ? 'collapsed' : 'active';
$is_show = $settings['collapse_state'] === 'yes' ? 'show' : ''; // Show by default

$id                    = $this->get_id(); // Unique widget ID, this is usually defined by Elementor
$cheat_sheet_title     = ! empty( $settings['cheat_sheet_title'] ) ? $settings['cheat_sheet_title'] : 'Default Title'; // Example cheat sheet title
$column_grid3           = $settings['column_grid3'] ?? 4;

?>

<div class="cheatsheet_info">
    <div class="accordion cheatsheet_accordion">
        <div id="cheat-<?php echo esc_attr( $id ) ?>" class="card">
			<?php
			if ( 'yes' === $settings['enable_cheat_sheet_title'] ) { ?>
                <div class="card-header" id="headingAtlas-<?php echo esc_attr( $id ) ?>">
					<?php
					if ( $cheat_sheet_title ) { ?>
                        <h2 class="mb-0">
                            <button class="btn btn-link <?php echo esc_attr( $is_collapsed_class ) ?>" type="button">
								<?php echo esc_html( $cheat_sheet_title ) ?>
                                <span class="pluse">[+]</span><span class="minus">[-]</span>
                            </button>
                        </h2>
						<?php
					}
					?>
                </div>
				<?php
			}
			?>
            <div id="collapseAtlas-<?php echo esc_attr( $id ) ?>"
                 class="collapse <?php echo esc_attr( $is_show ) ?>"
                 aria-labelledby="headingAtlas-<?php echo esc_attr( $id ) ?>">
                <div class="ezd-grid ezd-grid-cols-12 cs-items3-gap">
					<?php
					if ( $settings['cheat_sheet_contents'] ) {
						foreach ( $settings['cheat_sheet_contents'] as $index => $item ) {
							?>
                            <div class="ezd-lg-col-<?php echo esc_attr( $column_grid3 ); ?>">
                                <div class="cs-items3 elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>">
                                    <div class="cs-outline3">
                                        <?php echo '<span class="serial-number">' . esc_html( '#' . ( $index + 1 ) ) . '</span>'; ?>
                                        <h4 class="cs3-title">
                                            <?php echo esc_html( $item['cs_title'] ); ?>
                                        </h4>
                                    </div>

                                    <?php
                                    if ( ! empty( $item['cs_content'] ) ) { ?>
                                        <p class="cs-info-desc">
                                            <?php echo esc_html( $item['cs_content'] ); ?>
                                        </p>
                                        <?php
                                    }
                                    ?>

                                    <?php
                                        if ( ! empty( $item['image'] ['url'] ) ) { ?>
                                            <img class="cs-img" src="<?php echo esc_url( $item['image']['url'] ); ?>">
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
							<?php
						}
					}
					?>
                </div>
            </div>
        </div>
    </div>
</div>