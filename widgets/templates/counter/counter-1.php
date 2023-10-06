
<?php
$settings = $this->get_settings_for_display();

// Get Flexbox control values
$flex_display = $settings['flex_display'];
$flex_direction = $settings['flex_direction'];
$flex_justify_content = $settings['flex_justify_content'];
$flex_align_items = $settings['flex_align_items'];
$flex_gap = $settings['flex_gap']['size'] . $settings['flex_gap']['unit'];

//  Flexbox styles to the container
?>
<div class="counters-container" style="display: <?php echo esc_attr($flex_display); ?>;
    flex-direction: <?php echo esc_attr($flex_direction); ?>;
    justify-content: <?php echo esc_attr($flex_justify_content); ?>;
    align-items: <?php echo esc_attr($flex_align_items); ?>;
    gap: <?php echo esc_attr($flex_gap); ?>; /* Add the gap property */
    /* Add any other Flexbox styles as needed */
">
    <?php
    // Loop through counters and render them
    if (!empty($settings['counters'])) {
        foreach ($settings['counters'] as $counter) {
            $counter_value = $counter['counter_value'];
            $counter_text = $counter['counter_text'];
            ?>
            <div class="skill_item text-center">
                <!-- Render your counters here -->
                <svg class="radial-progress" data-percentage="<?php echo esc_attr($counter_value); ?>" viewBox="0 0 80 80">
                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                    <circle class="complete" cx="40" cy="40" r="35"></circle>
                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)"><?php echo esc_html($counter_value) . '%'; ?></text>
                </svg>
                <h6><?php echo esc_html($counter_text); ?></h6>
            </div>
            <?php
        }
    }
    ?>
</div>





