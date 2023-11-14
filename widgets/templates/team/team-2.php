<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="expert-slider-two">
	<?php
	if ( ! empty( $team_slider_item ) ) {
		foreach ( $team_slider_item as $item ) { ?>
            <div class="item">
                <div class="card-style-eight">
					<?php
					if ( ! empty( $item['team_slider_image']['id'] ) ) { ?>
                        <div class="img-meta mb-20">
							<?php echo wp_get_attachment_image( $item['team_slider_image']['id'], 'full', '', [ 'class' => 'm-auto' ] ) ?>
                        </div>
						<?php
					}
					if ( ! empty( $item['team_name'] ) ) { ?>
                        <a <?php spe_the_button( $item['team_link'] ) ?> class="name tran3s fw-500">
							<?php echo esc_html( $item['team_name'] ); ?>
                        </a>
						<?php
					}
					if ( ! empty( $item['team_job_position'] ) ) { ?>
                        <div class="post"><?php echo esc_html( $item['team_job_position'] ); ?></div>
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