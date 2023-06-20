<figure class="sp_image_hover style_one">
    <?php
    if ( !empty($img_attachment_meta['src'] )) {
        echo '<img src="' . $img_attachment_meta['src'] . '" alt="' . $img_attachment_meta['alt'] . '">';}
    ?>
    <figcaption>
        <h3><?php echo $img_attachment_meta['title']; ?></h3>
        <p><?php echo $img_attachment_meta['caption']; ?></p>
        <a href="#"></a>
    </figcaption>			
</figure>