<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>

<div class="big-circle rounded-circle position-relative d-flex align-items-center justify-content-center ms-lg-5 integration_style_two">
	<?php
	if ( ! empty( $integration_item ) ) {
		foreach ( $integration_item as $item ) {
            if ( empty( $item[ 'integration_image' ][ 'id' ] ) ) {
	            ?>
                <div class="brand-icon icon_01 rounded-circle d-flex align-items-center justify-content-center">
		            <?php echo wp_get_attachment_image( $item[ 'integration_image' ][ 'id' ], 'full', '', [ 'class' => 'lazy-img' ] ); ?>
                </div>
	            <?php
            }
		}
	}
	?>
</div>