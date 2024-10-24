<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
// Get settings for display
$settings = $this->get_settings_for_display();

// Ensure default 'collapse_state' is set to 'yes' for expanded (show) by default
$is_collapsed_class = $settings['collapse_state'] === 'yes' ? 'collapsed' : 'active';
$is_show = $settings['collapse_state'] === 'yes' ? 'show' : ''; // Show by default

// Check if serial numbers and number-circle are enabled
$text_alignment        = $settings['text_alignment'] ?? 'left';
$id                    = $this->get_id(); // Unique widget ID, this is usually defined by Elementor
$cheat_sheet_title     = ! empty( $settings['cheat_sheet_title'] ) ? $settings['cheat_sheet_title'] : 'Default Title'; // Example cheat sheet title
$column_grid2           = $settings['column_grid2'] ?? 2;

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
                <div class="ezd-grid ezd-grid-cols-12 sheet_items_gap">
                    <?php
                    if ( $settings['cheat_sheet_contents'] ) {
                        foreach ( $settings['cheat_sheet_contents'] as $index => $item ) {
                            ?>
                            <div class="ezd-lg-col-<?php echo esc_attr( $column_grid2 ); ?>">
                                <div class="cheat-info-box elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>">
                                    <div class="outline">
                                        <div class="info-box-number">
		                                    <?php echo '<span class="number-circle">' . esc_html( $index + 1 ) . '</span>'; ?>
                                        </div>
                                    </div>
                                    <div class="cheat-info-content" style="text-align: <?php echo esc_attr( $text_alignment ); ?>;">
                                        <h4 class="info-box-heading">
                                            <?php echo esc_html( $item['cs_title'] ); ?>
                                        </h4>
                                        <p class="info-box-description">
                                            <?php echo esc_html( $item['cs_content'] ); ?>
                                        </p>
                                    </div>
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