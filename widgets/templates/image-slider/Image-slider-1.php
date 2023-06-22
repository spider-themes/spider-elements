<div class="spe_image_slider">
    <div class="spe_slider_inner slider">
        <?php foreach( $settings['spe_slider_image'] as $img ) {
            $image_id = !empty($img['id']) ? $img['id'] : '';
            $img_attachment_meta = se_el_image_caption($image_id);
            ?>
            <div>
                <div class="spe_slider_item"> 
                    <?php echo '<img src="' . esc_attr( $img_attachment_meta['src'] ) . '">'; ?> 
                    <div class="spe_slider_content">
                        <h3><?php echo $img_attachment_meta['title']; ?></h3>
                        <p><?php echo $img_attachment_meta['caption']; ?></p>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="buttons_control">
        <button id='toggle'>play</button>
        <span class="pagingInfo"></span>
    </div>
    <div class="spe_slider_nav">
        <i class="arrow_left left_arrow slick-arrow"></i>
        <i class="arrow_right right_arrow slick-arrow"></i>
    </div>
    <div class="slider-dots-box"></div>
</div>