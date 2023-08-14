<div class="branding-area overflow-hidden">
    <?php
    if (!empty($settings['left_slides'])) {
    ?>
    <div class="branding-slider">
        <?php

            foreach ($settings['left_slides'] as $image) {
            ?>
        <div>
            <img src="<?php echo $image['url']; ?>"
                alt="<?php esc_attr_e('Marque Gallery Image', 'spider-elements') ?>">
        </div>
        <?php
            } ?>
    </div>
    <?php
    } ?>

    <?php if (!empty($settings['right_slides'])) {
    ?>
    <div class="branding-reverse-slider py-5" dir="rtl">
        <?php
            foreach ($settings['right_slides'] as $image) {
            ?>
        <div>
            <img src="<?php echo $image['url']; ?>"
                alt="<?php esc_attr_e('Marque Gallery Image', 'spider-elements') ?>">
        </div>
        <?php }
            ?>
    </div>
    <?php } ?>
</div>