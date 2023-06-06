<div class="stack_scroll">
    <?php foreach ( $settings['stack_image'] as $image ) {?>
    <figure class="stack_image_scroll">
        <?php echo '<img src="' . esc_attr( $image['url'] ) . '">'; ?>  
    </figure>
    <?php } ?>
</div>
