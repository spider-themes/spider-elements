<div class="expert-slider-two">
    <?php foreach($team_slider_item as $item) {?>
    <div class="item">
        <div class="card-style-eight">
            <div class="img-meta mb-20">
                <img src="<?php echo esc_url($item['team_slider_image']['url']);?>" alt="" class="m-auto">
            </div>
            <a href="<?php echo esc_url($item['team_link']['url']);?>"
                class="name tran3s fw-500"><?php echo esc_html__($item['team_name']);?></a>
            <div class="post"><?php echo esc_html($item['team_job_position']);?></div>
        </div>
    </div>
    <?php }?>
</div>