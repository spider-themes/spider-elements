<div class="expert-section-one">
    <div class="expert-slider-one slider-<?php echo esc_attr($team_id);?>">
        <?php foreach ($team_slider_item as $item) {?> 
            <div class="item">
                <div class="card-style-three">
                    <div class="img-meta mb-40 lg-mb-20">
                        <img src="<?php echo esc_url($item['team_slider_image']['url']);?>" alt="" class="m-auto"> 
                    </div>
                    <a href="<?php echo esc_url($item['team_link']['url']);?>" class="name text-md fw-500"><?php echo esc_html__($item['team_name']);?></a>
                    <div class="post"><?php echo esc_html__($item['team_job_position']);?></div>
                </div>
            </div>
        <?php } ?>
    </div>
    <ul class="slider-arrows slick-arrow-one d-flex justify-content-center style-none sm-mt-30">
        <li class="prev_a slick-arrow"><i class="arrow_left"></i></li>
        <li class="next_a slick-arrow"><i class="arrow_right"></i></li>
    </ul>
</div>
