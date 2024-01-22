<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<div class="big-circle ezd-rounded-circle ezd-position-relative ezd-d-flex ezd-align-items-center ezd-justify-content-center ms-lg-5 integration_style_two">
    <?php
    if (!empty($integration_item)) {
        foreach ( $integration_item as $item ) {
            if (!empty($item[ 'integration_image' ][ 'id' ])) { ?>
                <div class="brand-icon icon_01 ezd-rounded-circle ezd-d-flex ezd-align-items-center ezd-justify-content-center">
                    <?php spel_dynamic_image($item[ 'integration_image' ], 'full', [ 'class' => 'lazy-img' ] ) ?>
                </div>
                <?php
            }
        }
    }
    ?>
</div>