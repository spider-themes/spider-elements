<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
?>

<div class="instagram-area">
    <div class="instagram-wrapper">
        <div class="swiper instagram-feed-active">
            <div class="swiper-wrapper">
				<?php
				if ( isset( $data->data ) && is_array( $data->data ) ) {
					foreach ( $data->data as $item ) {
						$media_url     = ! empty( $item->media_url ) ? $item->media_url : '';
						$permalink     = ! empty( $item->permalink ) ? $item->permalink : '';
						$caption       = ! empty( $item->caption ) ? $item->caption : '';
						$media_type    = ! empty( $item->media_type ) ? $item->media_type : '';
						$thumbnail_url = ! empty( $item->thumbnail_url ) ? $item->thumbnail_url : '';

						if ( $media_type == 'VIDEO' ) {
							$media_url = $thumbnail_url;
						}
						?>
                        <div class="swiper-slide">
                            <div class="instagram-feed-item">
                                <?php
                                if ( $media_url ) { ?>
                                    <img src="<?php echo esc_url( $media_url ); ?>" alt="<?php echo esc_attr($caption) ?>" />
                                    <?php
                                }
                                if ( $permalink ) { ?>
                                    <a class="icon-link" href="<?php echo esc_url( $permalink ); ?>">
                                        <span class="instagram-icon">
                                          <i class="fab fa-instagram"></i>
                                        </span>
                                    </a>
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
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>
</div>