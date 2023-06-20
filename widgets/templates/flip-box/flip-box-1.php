<div class="spe_flip_box_inner <?php echo esc_attr($settings['style'])?>">
    <div class="flip_overlay"></div>
    <div class="font_face">
        <?php if(!empty($settings['font_box_title'])):?>
            <h3> <?php echo wp_kses_post($settings['font_box_title']) ?></h3>
        <?php endif;?>
        <?php if(!empty($settings['font_box_image']['url'])):?>
            <div class="text-center">
                <img src="<?php echo $settings['font_box_image']['url'];?>" alt="card">
            </div>
        <?php endif; ?>
        <button class="flip_button"><i class="icon_plus icon"></i></button>
    </div>
    <div class="back_face">
        <div class="back_face_content">
        <?php if(!empty($settings['back_box_title'])):?>
            <h3> <?php echo wp_kses_post($settings['back_box_title']) ?></h3>
        <?php endif;?>
        <?php if(!empty($settings['back_box_content'])): ?>
            <p><?php echo wp_kses_post($settings['back_box_content']) ?></p>
            <?php endif;?>
        </div>
        <?php if(!empty($settings['back_box_image']['url'])):?>
            <div class="image-column text-end">
                <img src="<?php echo esc_url($settings['back_box_image']['url']);?>" alt="mobile">
            </div>
        <?php endif;?>
        
        <button class="flip_button_close"><i class="icon_close"></i></button>
    </div>
</div>