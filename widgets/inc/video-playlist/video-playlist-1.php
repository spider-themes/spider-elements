<section class="video_list_area">
    <div class="video_player">
        <div class="tab-content video_tabs" id="<?php echo the_ID(); ?>">
            <?php
            $all_videos         = $settings['tabs'] ?? '';
            $i                  = '0';
            $active             = '';
            foreach( $all_videos as $videos ){
                $child_videos   = $videos['se-video-upload'] ?? '';
                        
                foreach( $child_videos as $child_video ) :
                    ?>
                    <div class="tab-pane fade <?php echo esc_attr( $active ); ?>" id="video_<?php echo esc_attr( $i++ ); ?>">                    
                        <div class="artplayer-app" data-src="<?php echo esc_url($child_video['video_upload']['url']); ?>"></div>
                    </div>
                    <?php 
                endforeach;
            }
            wp_reset_postdata();
            ?>
        </div>
    </div>
                
    <div class="video_list">

    
        <h3 class="title" data-animation="wow fadeInUp" data-wow-delay="0.2s">
            <?php 
            $title_tag = $settings['title_tag'] ?? 'h3';
            echo '<'.$title_tag.' class="title">' . esc_html( $settings['title'] ) . '</'.$title_tag.'>';
            ?>
        </h3>
        <div class="video_list_inner scroll">
            <div class="accordion" id="accordionExample">
                
            <?php 
             $all_videos        = $settings['tabs'] ?? '';
             $i                 = '0';
             $count = '0';
             $collapse = '';
             foreach( $all_videos as $videos ) :
                $count++;
                 $child_videos  = $videos['se-video-upload'] ?? '';
                 
                $total_item = count($child_videos);
                $total_item = $total_item - 0;
                
                if ( $total_item < 10 ) {
                    $total_item = '0'.$total_item;
                }
                
                ?>
                
                <div class="card accordion-panel">
                        <div class="card-header">
                            <button class="text-left accordion-header" data-bs-toggle="collapse" data-bs-target="#configuration<?php echo $count; ?>" aria-expanded="true" aria-controls="configuration<?php echo $count; ?>" type="button">
                                <span class="title"> <?php echo esc_html( $videos['title'] ); ?> </span>
                                <span class="count">(<?php echo esc_html( $total_item ); ?>)</span>
                                <span class="plus-minus">
                                    <i class="icon_plus"></i>
                                    <i class="icon_minus-06"></i>
                                </span>
                            </button>
                        </div>
                        <div id="configuration<?php echo $count; ?>" class="accordion-content <?php if ( $count == 1 ) { echo 'collapse show'; } ?>" aria-labelledby="configuration<?php echo $count; ?>-tab" data-parent="#accordionExample">
                            <div class="card-body">
                                <ul class="nav nav-tabs" role="tablist">
                                    
                                    <?php                                    
                                    foreach( $child_videos as $child_video ) :
                                        ?>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link <?php if ( $i == 0 ) { echo 'active'; } ?>" data-bs-toggle="tab" href="#video_<?php echo esc_attr($i++); ?>">
                                                <div class="media d-flex">
                                                    <div class="d-flex">
                                                        <div class="video_tab_img">
                                                            <img loading="lazy" width="60" height="40" src="<?php echo $child_video['thumbnail']['url'] ?? ''; ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <h4><?php echo esc_html( $child_video['title2'] ); ?></h4>
                                                        <div class="list">
                                                            <div> 
                                                                <ion-icon name="person-outline" role="img" class="md hydrated" aria-label="person outline"></ion-icon> 
                                                                <?php 
                                                                $author = $child_video['current_author'] ?? '';
                                                                echo ucwords($author);
                                                                ?>
                                                            </div>
                                                            <div> 
                                                                <ion-icon name="calendar-clear-outline" role="img" class="md hydrated" aria-label="calendar clear outline"></ion-icon>
                                                                <?php echo $child_video['current_date'] ?? ''; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                        <?php 
                                    endforeach; 
                                    wp_reset_postdata();
                                    ?>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>

                    <?php 
                endforeach;
                wp_reset_postdata();
                ?>
                
            </div>
        </div>
    </div>
</section>