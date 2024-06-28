<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="spel-header-builder">
    <?php
    $active_header_template_id = get_option('active_spel_header_template_id');
    if ($active_header_template_id) {
        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($active_header_template_id);
    }
    ?>
</div>
