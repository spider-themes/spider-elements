<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/// Example settings array (usually these come from Elementor or database)
$settings = $this->get_settings_for_display(); // Assuming you are in Elementor's widget class
$id = $this->get_ID();

// Ensure default 'collapse_state' is set to 'yes' for expanded (show) by default
$is_collapsed_class = $settings['collapse_state'] === 'yes' ? 'collapsed' : 'active';
$is_show = $settings['collapse_state'] === 'yes' ? 'show' : ''; // Show by default

$cheat_sheet_title = ! empty( $settings['cheat_sheet_title'] ) ? $settings['cheat_sheet_title'] : 'Default Title'; // Example cheat sheet title
$cheat_sheet_contents = ! empty( $settings['cheat_sheet_contents'] ) ? $settings['cheat_sheet_contents'] : []; // Array of cheat sheet contents
$column_grid           = $settings['column_grid'] ?? 3;

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
						if ( is_array( $cheat_sheet_contents ) ) {
							// Loop through the cheat sheet contents and auto-generate serial numbers
							foreach ( $cheat_sheet_contents as $index => $item ) {
								?>
                                <div class="ezd-lg-col-<?php echo esc_attr( $column_grid ); ?>">
                                    <div class="cheatsheet_item">
										<?php
										// Auto-generate serial number using $index + 1
										echo '<div class="cheatsheet_num">' . esc_html( '#' . ( $index + 1 ) ) . '</div>';

										// Display the title if available
										if ( ! empty( $item['cs_title'] ) ) {
											echo '<p>' . esc_html( $item['cs_title'] ) . '</p>';
										}

										// Display the content if available
										if ( ! empty( $item['cs_content'] ) ) {
											echo '<h5>' . esc_html( $item['cs_content'] ) . '</h5>';
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
<?php
