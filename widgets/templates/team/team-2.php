<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="expert-slider-two" data-rtl="<?php echo esc_attr(spel_rtl()) ?>">
	<?php
	if ( ! empty( $team_slider_item ) ) {
		foreach ( $team_slider_item as $item ) { ?>
            <div class="item">
                <div class="card-style-eight">
					<?php
					if ( ! empty( $item['team_slider_image']['id'] ) ) { ?>
                        <div class="img-meta mb-20">
							<?php spel_dynamic_image( $item['team_slider_image'], 'full', [ 'class' => 'm-auto' ] ) ?>
                        </div>
						<?php
					}
					if ( ! empty( $item['team_name'] ) ) { ?>
                        <a <?php spel_button_link( $item['team_link'] ) ?> class="name tran3s fw-500">
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