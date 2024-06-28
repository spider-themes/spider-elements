<div class="spel-footer-builder">
    <?php
    $active_footer_template_id = get_option('active_spel_footer_template_id');
    if ($active_footer_template_id) {
        echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($active_footer_template_id);
    }
    ?>
</div>

<?php wp_footer(); ?>

</body>
</html>