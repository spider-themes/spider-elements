<div class="ezd-grid ezd-grid-cols-12">
    <div class="ezd-lg-col-6">
        <div class="doc_testimonial_slider">
            <?php
			if ( !empty($testimonials) ) {
				foreach ( $testimonials as $item ) {
					?>
            <div class="item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                <?php echo !empty($item['review_content']) ? '<h3 class="se_review_content">'.esc_html($item['review_content']).'</h3>' : ''; ?>
                <div class="name">
                    <?php
							echo !empty($item['name']) ? '<h5 class="se_name">'.esc_html($item['name']).'</h5>' : '';
							echo !empty($item['designation']) ? '<span class="se_designation">'.esc_html($item['designation']).'</span>' : '';
							?>
                </div>
                <?php if ( !empty($item['signature']['id']) ) : ?>
                <div class="sign">
                    <?php echo wp_get_attachment_image( $item['signature']['id'], 'full' ) ?>
                </div>
                <?php endif; ?>
            </div>
            <?php
				}
			}
			?>
        </div>
    </div>
    <div class="ezd-lg-col-6">
        <div class="doc_img_slider">
            <?php
			if ( !empty($testimonials) ) {
				foreach ( $testimonials as $item ) {
					?>
            <div class="item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                <?php
						if ( !empty($settings['shape']['id']) ) :
							echo wp_get_attachment_image( $settings['shape']['id'], 'full', '', array( 'class' => 'dot' ) );
						endif;

						echo '<div class="round one"></div>';
						echo '<div class="round two"></div>';

						if ( !empty($item['author_image']['id']) ) :
							echo wp_get_attachment_image( $item['author_image']['id'], 'full' );
						endif;
						?>
            </div>
            <?php
				}
			}
			?>
        </div>
    </div>
</div>