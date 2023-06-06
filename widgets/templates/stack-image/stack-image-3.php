<div class="imgstack">
    <?php foreach ( $settings['stack_image'] as $image )  {?>
        <div class="stack_img">
            <?php echo '<img src="' . esc_attr( $image['url'] ) . '">'; ?>
        </div>
    <?php } ?>
</div>