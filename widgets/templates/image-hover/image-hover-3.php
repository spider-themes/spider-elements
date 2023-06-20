<figure class="hover-fold d-flex align-items-center">
    <div class="text">
        <h3><?php echo $img_attachment_meta['title']; ?></h3>
        <p><?php echo $img_attachment_meta['caption']; ?></p>
    </div>
    <div class="top">
        <div class="front face" style="background-image:url('<?php echo $img_attachment_meta['src']; ?>')">
        </div>
        <div class="back face">
        </div>
    </div>
    <div class="bottom" style="background-image:url('<?php echo $img_attachment_meta['src']; ?>')"></div>
</figure>