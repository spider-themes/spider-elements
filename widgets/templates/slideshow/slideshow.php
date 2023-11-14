<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="slideshow">
    <div class="slideshow__deco"></div>
	<?php
	if ( ! empty( $settings['slides'] ) ) {
		foreach ( $settings['slides'] as $slide ) {
			?>
            <div class="slide">
                <div class="slide__img-wrap">
                    <div class="slide__img"
                         style="background-image: url(<?php echo esc_url( $slide['image_url']['url'] ); ?>);"></div>
                </div>
                <div class="slide__side"><?php echo esc_html( $slide['side_text'] ); ?></div>
                <div class="slide__title-wrap">
                    <span class="slide__number"><?php echo esc_html( $slide['slide_number'] ); ?></span>
                    <h3 class="slide__title"><?php echo esc_html( $slide['slide_title'] ); ?></h3>
                    <h4 class="slide__subtitle"><?php echo esc_html( $slide['slide_subtitle'] ); ?></h4>
                </div>
            </div>


			<?php
		}
		?>
        <button class="nav nav--prev">
            <svg class="icon icon--navarrow-prev">
                <use xlink:href="#icon-navarrow"></use>
            </svg>
        </button>
        <button class="nav nav--next">
            <svg class="icon icon--navarrow-next">
                <use xlink:href="#icon-navarrow"></use>
            </svg>
        </button>
		<?php
	}
	?>
</div>