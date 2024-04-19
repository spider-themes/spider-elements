<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<div class="icon_box_two">
	<?php if ( ! empty( $settings['i_box_icon'] ) ) { ?>
        <span class="box_main_icon"><?php \Elementor\Icons_Manager::render_icon( $settings['i_box_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
    <?php
	}
    ?>
	<?php if ( ! empty( $settings['pro_box_icon'] ) ) { ?>
        <span class="box_pro_icon"><?php \Elementor\Icons_Manager::render_icon( $settings['pro_box_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
	<?php
	}
    ?>

	<?php if ( ! empty( $settings['title'] ) ) { ?>
        <a <?php spel_button_link($settings[ 'box_link' ]) ?> class="box2_url">
            <<?php echo esc_attr( $box_title_tag ); ?> class="box_two_title">
                <?php echo esc_html( $settings['title'] ); ?>
            </<?php echo esc_attr( $box_title_tag ) ?>>
        </a>
    <?php
    }
    ?>
</div>
