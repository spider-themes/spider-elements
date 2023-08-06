<div class="branding-area pt-140 pb-145 overflow-hidden">
    <div class="branding-slider">
        <?php foreach ($settings['images'] as $image_item) {
            $is_reverse    = $item['reverse_images'] ?? '';
            $image = $image_item['image'];
            ?>
            <div>
                <img src="<?php echo $image['url']; ?>" alt="">
            </div>
        <?php } ?>
    </div>

    <div class="branding-reverse-slider py-5" dir="rtl">
    <?php foreach ($settings['reverse_images'] as $image_item) {
            $image = $image_item['image'];
            ?>
            <div>
                <img src="<?php echo $image['url']; ?>" alt="">
            </div>
        <?php } ?>
    </div>
</div>




