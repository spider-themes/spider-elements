<div class="row feedback-slider-one">
    <?php if(!empty($testimonials6)): 
        foreach ($testimonials6 as $item ) : ?>
    <div class="item">
        <div class="feedback-block-one color-two">
            <div class="logo">
                <img src="images/logo/media_27.png" alt="">
            </div>
            <blockquote class="fw-500 mt-50 md-mt-30 mb-50 md-mb-30 text-white">“Seattle opera simplifies Performance
                planning with deski eSignature.”</blockquote>
            <div class="name text-white"><span class="fw-500">Rashed kabir,</span> Lead Designer</div>
            <div class="review pt-40 md-pt-20 mt-40 md-mt-30 d-flex justify-content-between align-items-center">
                <div class="text-md fw-500 text-white">4.5 Excellent</div>
                <ul class="style-none d-flex">
                    <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                    <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                    <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                    <li><a href="#"><i class="bi bi-star-fill"></i></a></li>
                    <li><a href="#"><i class="bi bi-star"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <?php 
    endforeach;
    endif;
    ?>
</div>