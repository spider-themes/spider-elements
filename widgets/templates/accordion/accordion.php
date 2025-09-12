<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<div class="spel-accordion" <?php echo esc_attr( $toggle_id ); ?>>
	<?php
	if ( ! empty( $accordions ) ) {
        foreach ( $accordions as $index => $item ) {
            $is_collapsed_class  = $item['collapse_state'] ?? '';
            $is_btn_collapse     = $is_collapsed_class == 'yes' ? 'collapsed ' : '';
            $is_collapsed        = $is_collapsed_class == 'yes' ? 'true' : 'false';
            $id                  = 'toggle-' . $item['_id'] ?? '';
            $is_show             = $is_collapsed_class == 'yes' ? ' show' : '';
            $border_bottom_class = $index === array_key_last($accordions) ? ' border-bottom-none' : '';
            $is_border_bottom    = !empty($settings['is_border_bottom'] == 'yes') ? '' : $border_bottom_class;
            ?>
            <div class="card<?php echo esc_attr($is_border_bottom) ?> accordion_inner <?php echo esc_attr( $is_btn_collapse ).esc_attr( 'accord-item-'.$item['_id'] ); ?>">

                <div class="card-header" id="heading-<?php echo esc_attr( $item['_id'] ); ?>">
                    <<?php echo esc_html( $title_tag ); ?> class="title">
                        <button class="accordion_btn_link<?php echo esc_attr( $icon_align_class ); ?>">
                            <?php
                            echo esc_html( $item['title'] );

                            if ( ! empty( $settings['plus-icon']['value'] ) || ! empty( $settings['minus-icon']['value'] ) ) :
                                ?>
                                <span class="icon-wrapper">
                                    <span class="expanded-icon">
                                        <?php \Elementor\Icons_Manager::render_icon( $settings['plus-icon'] ); ?>
                                    </span>
                                    <span class="collapsed-icon">
                                        <?php \Elementor\Icons_Manager::render_icon( $settings['minus-icon'] ); ?>
                                    </span>
                                </span>
                                <?php
                            endif;
                            ?>
                        </button>
                    </<?php echo esc_html( $title_tag ) ?>>
                </div>

                <div id="<?php echo esc_attr( $id ) ?>" class="collapse<?php echo esc_attr( $is_show ) ?>" <?php echo esc_attr( $toggle_bs_parent_id ); ?>>
                    <div class="card-body">
                        <?php
                        $content_type = $item['content_type'] ?? '';
                        if ( $content_type == 'content' ) {
                            echo wp_kses_post( $item['normal_content'] );
                        } elseif ( $content_type == 'el_template' ) {
                            if ( ! empty( $item['el_content'] ) ) {
                                echo wp_kses_post(
                                    \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $item['el_content'] )
                                );
                            }
                        }
                        ?>
                    </div>
                </div>

            </div>
            <?php
        }
    }

if ( isset( $settings['faq_schema'] ) && 'yes' === $settings['faq_schema'] ) {
	$json = [
		'@context'   => 'https://schema.org',
		'@type'      => 'FAQPage',
		'mainEntity' => [],
	];

	foreach ( $settings['accordions'] as $index => $item ) {
		$json['mainEntity'][] = [
			'@type'          => 'Question',
			'name'           => wp_strip_all_tags( $item['title'] ),
			'acceptedAnswer' => [
				'@type' => 'Answer',
				'text'  => $this->parse_text_editor( $item['normal_content'] ),
			],
		];
	}
	?>
    <script type="application/ld+json">
          <?php echo wp_json_encode( $json ); ?>


    </script>
	<?php
}
?>
</div>