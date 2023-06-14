<div class="doc_feedback_info">
    <div class="doc_feedback_slider">
        <?php
        if ( !empty($testimonials2) ) {
            foreach ( $testimonials2 as $item ) {
                ?>
                <div class="item elementor-repeater-item-<?php echo esc_attr($item['_id']); ?>">
                    <?php
                    if ( !empty($item['author_image']['id']) ) { ?>
                        <div class="author_img">
                            <?php echo wp_get_attachment_image( $item['author_image']['id'], 'full' ) ?>
                        </div>
                        <?php
                    }
                    if ( !empty($item['review_content']) ) { ?>
                        <p class="se_review_content"><?php echo esc_html($item['review_content']) ?></p>
	                    <?php
                    }
                    if ( !empty($item['name']) ) { ?>
                        <h5 class="se_name"><?php echo esc_html($item['name']); ?></h5>
	                    <?php
                    }
                    if ( !empty($item['designation']) ) { ?>
                        <h6 class="se_designation"><?php echo esc_html($item['designation']); ?></h6>
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