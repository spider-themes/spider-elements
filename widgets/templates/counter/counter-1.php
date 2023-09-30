<?php

$settings = $this->get_settings_for_display();
$wrap_classes = ['eael-progressbar'];
$circle_wrapper = [];
$progress_bar_title = $settings['counter_title'];
$progress_bar_title_html_tag = $settings['counter_title_html_tag'];
$counter_value = $settings['counter_value']['size'];
$counter_show_count = $settings['counter_show_count'] === 'yes';
$counter_animation_duration = $settings['counter_animation_duration']['size'];

// Output the title with the selected HTML tag
echo '<' . $progress_bar_title_html_tag . ' class="eael-progressbar-title">' . $progress_bar_title . '</' . $progress_bar_title_html_tag . '>';

// Output the counter value and postfix (%)
if ($counter_show_count) {
    echo '<div class="eael-progressbar-count-wrap">';
    echo '<span class="eael-progressbar-count">' . $counter_value . '</span>';
    echo '<span class="postfix">%</span>';
    echo '</div>';
}




