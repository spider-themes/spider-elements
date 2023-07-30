<div class="big-circle rounded-circle position-relative d-flex align-items-center justify-content-center ms-lg-5 integration_style_two">
    <!-- /.inner-circle -->
    <?php foreach ($integration_item as $integration) {?>
        <div class="brand-icon icon_01 rounded-circle d-flex align-items-center justify-content-center">
            <img src="<?php echo esc_url($integration['integration_image']['url'])?>" alt="" class="lazy-img" style="">
        </div>
    <?php }?>
</div>