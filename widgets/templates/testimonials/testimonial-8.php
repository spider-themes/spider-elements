<div id="feedBack_carousel" class="carousel slide" data-bs-ride="carousel">
    <div class="row">
        <div class="col-xxl-9 col-lg-8 col-md-10 m-auto">
            <div class="carousel-inner text-center">
                <?php if(!empty($testimonials8)): 
                foreach ($testimonials8 as $index => $item ) : 
                            $i = $index + 1;
							$active = $i == 1 ? 'active' : '';
                        ?>
                <div class="carousel-item <?php echo esc_attr($active)?>">
                    <?php
                        if ( !empty($item['review_content']) ) { ?>
                    <p><?php echo esc_html($item['review_content']) ?>
                    </p>
                    <?php
                        }
                        if ( !empty($item['author_name']) ) { ?>
                    <div class="d-inline-block position-relative name fw-500 text-lg">
                        <?php echo esc_html($item['author_name']); ?><span class="fw-normal opacity-50">
                            <?php echo esc_html($item['author_position']); ?></span>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <?php 
                    endforeach;
                    endif;
                ?>

            </div>
        </div>
    </div>
    <button class="carousel-control-prev carousel-btn" type="button" data-bs-target="#feedBack_carousel"
        data-bs-slide="prev">
        <i class="eicon-angle-left"></i>
    </button>
    <button class="carousel-control-next carousel-btn" type="button" data-bs-target="#feedBack_carousel"
        data-bs-slide="next">
        <i class="eicon-angle-right"></i>
    </button>
    <div class="carousel-indicators">
        <?php if(!empty($testimonials8)):
            foreach ($testimonials8 as $index => $item):
                $i= $index;
                $active = $i == 1 ? 'active' : '';
                $area_selected = $i == 1 ? 'true' : 'false'
            ?>
        <button type="button" class="<?php echo esc_attr($active)?>" data-bs-target="#feedBack_carousel"
            data-bs-slide-to="<?php echo esc_attr($i)?>" aria-current="<?php echo esc_attr($area_selected)?>"
            aria-label="Slide <?php echo esc_attr($i)?>">
            <img src="<?php echo esc_url($item['author_image']['url']);?>" alt="" class="lazy-img rounded-circle">
        </button>
        <?php endforeach; endif; ?>
    </div>
</div>