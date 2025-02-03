<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="doc_feedback_info">
    <div class="doc_feedback_slider" data-rtl="<?php echo esc_attr(spel_rtl()) ?>">
		<?php
		if ( ! empty( $testimonials2 ) ) {
			foreach ( $testimonials2 as $item ) {
				?>
                <div class="item elementor-repeater-item-<?php echo esc_attr( $item[ '_id' ] ); ?>">
					<?php
					if ( ! empty( $item['author_image']['id'] ) ) { ?>
                        <div class="author_img">
							<?php spel_dynamic_image( $item['author_image'] ) ?>
                        </div>
						<?php
					}
					if ( ! empty( $item['content'] ) ) { ?>
                        <div class="se_review_content">
                            <?php echo spel_kses_post( $item['content'] ) ?>
                        </div>
						<?php
					}
					if ( ! empty( $item['name'] ) ) { ?>
                        <h5 class="se_name"><?php echo esc_html( $item['name'] ); ?></h5>
						<?php
					}
					if ( ! empty( $item['designation'] ) ) { ?>
                        <h6 class="se_designation"><?php echo esc_html( $item['designation'] ); ?></h6>
						<?php
					}
					?>
                </div>
				<?php
			}
		}
		?>
    </div>
    <div class="slider_nav">
        <div class="prev">
            <span class="arrow"></span>
        </div>
        <div class="next">
            <span class="arrow"></span>
        </div>
    </div>
</div>