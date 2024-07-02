<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="icon_box">
    <div class="box_bg_shape">
        <a <?php spel_button_link($settings[ 'box_link' ]) ?> class="full_box_link">
			<?php if ( ! empty( $settings['i_box_icon'] ) ) { ?>
                <div class="box_icon">
                    <span class="box_main_icon"><?php \Elementor\Icons_Manager::render_icon( $settings['i_box_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                </div>
				<?php
			}
			?>
            <div class="icon_box_content">
				<?php
        if ( ! empty( $settings['title'] ) ) { ?>
            <<?php echo esc_attr( $box_title_tag ); ?> class="box_title">
				<?php echo esc_html( $settings['title'] ); ?>
            </<?php echo esc_attr( $box_title_tag ) ?>>
		<?php
		    }
		if ( ! empty( $settings['description'] ) ) {
			?>
            <p class="icon_box_description">
				<?php echo $settings['description']; ?>
            </p>
			<?php
		}
		?>
        </a>
		<?php
		if ( ! empty( $settings['btn_text'] ) )
		{
			?>
            <div class="icon_box_button">
                <a <?php spel_button_link($settings[ 'box_link' ]) ?> class="button_items">
                    <span  class="box_button"><?php echo $settings['btn_text']; ?></span>
					<?php
					if ( ! empty( $settings['btn_icon'] ) ) { ?>
						<?php \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						<?php
					}
					?>
                </a>
            </div>
			<?php
		}
		?>
    </div>
</div>
</div>


