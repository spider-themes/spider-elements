<div class="imgstack">
    <?php foreach ($settings['stack_image_list'] as $images ) {?>
        <div class="stack_img elementor-repeater-item-<?php echo $images['_id']; ?>">
            <?php echo wp_get_attachment_image($images['stack_tab_image']['id'], 'full'); ?>
        </div>
    <?php } ?>
</div>