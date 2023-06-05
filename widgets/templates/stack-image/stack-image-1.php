<figure class="stack_image <?php echo "img-position-" .$stack_image_alignment ?>">
    <?php foreach ( $settings['stack_image'] as $image ) {?>
        <?php echo '<img src="' . esc_attr( $image['url'] ) . '">'; ?>  
    <?php } ?>
</figure>