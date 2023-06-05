<div class="stack_image_container">
    <ul class="stack_image_lists">
        <?php 
        $i = 0;
        foreach ( $settings['stack_image'] as $image ) {?>
            <li class="stack_image_list" style="--i:<?php echo $i++ ?>">
                <?php echo '<img src="' . esc_attr( $image['url'] ) . '">'; ?>
            </li>
        <?php } ?>
    </ul>
</div>