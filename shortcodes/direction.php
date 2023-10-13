<?php
add_shortcode( 'direction', function ( $atts, $content ) {
	ob_start();
	$directions = explode( '>', $content );

	if ( str_contains( $content, '>' ) ) {
		$directions = explode( '>', $content );
	} elseif ( str_contains( $content, '&gt;' ) ) {
		$directions = explode( '&gt;', $content );
	}

	if ( is_array( $directions ) ) :
		?>
        <span class="direction_steps">
            <?php
            if ( is_array( $directions ) ) {
	            foreach ( $directions as $direction ) {
		            echo '<span class="direction_step">';
		            echo esc_html( $direction );
		            echo '</span>';
	            }
            }
            ?>
        </span>
	<?php
	endif;
	$html = ob_get_clean();

	return $html;
} );