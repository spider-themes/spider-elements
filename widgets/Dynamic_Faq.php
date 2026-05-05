<?php
namespace SPEL\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Dynamic FAQ Widget
 *
 * Renders posts from any public post type as a collapsible FAQ list.
 * Supports excerpt/content source, word/char limits, reply counts, and stacked avatars.
 */
class Dynamic_Faq extends Widget_Base {

	public function get_name(): string {
		return 'spel_dynamic_faq';
	}

	public function get_title(): string {
		return esc_html__( 'Dynamic FAQ', 'spider-elements' );
	}

	public function get_icon(): string {
		return 'eicon-accordion spel-icon';
	}

	public function get_keywords(): array {
		return [ 'spider', 'faq', 'accordion', 'dynamic', 'posts', 'forum', 'docs', 'help', 'questions' ];
	}

	public function get_categories(): array {
		return [ 'spider-elements' ];
	}

	public function get_style_depends(): array {
		return [ 'spel-main', 'elegant-icon' ];
	}

	protected function register_controls(): void {
		$this->elementor_content_control();
		$this->elementor_style_control();
	}

	// =========================================================================
	// CONTENT CONTROLS
	// =========================================================================

	public function elementor_content_control(): void {

		// =========================================================
		// 1. QUERY SETTINGS — Data source & retrieval
		// =========================================================
		$this->start_controls_section(
			'query_section',
			[
				'label' => esc_html__( 'Query Settings', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$post_types = get_post_types( [ 'public' => true ], 'objects' );
		$pt_options = [];
		foreach ( $post_types as $pt ) {
			$pt_options[ $pt->name ] = $pt->labels->singular_name;
		}

		$this->add_control(
			'post_type',
			[
				'label'   => esc_html__( 'Source (Post Type)', 'spider-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'post',
				'options' => $pt_options,
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__( 'Number of Items', 'spider-elements' ),
				'type'  => Controls_Manager::NUMBER,
				'default' => 5,
				'min'    => 1,
				'max'    => 50,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label'   => esc_html__( 'Order By', 'spider-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'         => esc_html__( 'Date', 'spider-elements' ),
					'modified'     => esc_html__( 'Last Modified', 'spider-elements' ),
					'title'        => esc_html__( 'Title', 'spider-elements' ),
					'rand'         => esc_html__( 'Random', 'spider-elements' ),
					'comment_count' => esc_html__( 'Comment Count', 'spider-elements' ),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label'   => esc_html__( 'Order', 'spider-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC' => esc_html__( 'Descending', 'spider-elements' ),
					'ASC'  => esc_html__( 'Ascending', 'spider-elements' ),
				],
			]
		);

		$this->end_controls_section();

		// =========================================================
		// 2. DISPLAY SETTINGS — Content & visual options
		// =========================================================
		$this->start_controls_section(
			'display_section',
			[
				'label'     => esc_html__( 'Display Settings', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'open_first',
			[
				'label'        => esc_html__( 'Initially Expanded', 'spider-elements' ),
				'description'  => esc_html__( 'Keep the first FAQ item expanded when the page loads', 'spider-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'spider-elements' ),
				'label_off'    => esc_html__( 'No', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'content_source',
			[
				'label'   => esc_html__( 'Content to Display', 'spider-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'content',
				'options' => [
					'excerpt' => esc_html__( 'Excerpt', 'spider-elements' ),
					'content' => esc_html__( 'Full Content', 'spider-elements' ),
				],
			]
		);

		$this->add_control(
			'limit_number',
			[
				'label'       => esc_html__( 'Word Limit', 'spider-elements' ),
				'description' => esc_html__( 'Maximum number of words to display. Set to -1 to show all content without truncation.', 'spider-elements' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => 10,
			]
		);

		$this->add_control(
			'show_meta',
			[
				'label'        => esc_html__( 'Show Meta (Count / Date)', 'spider-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'spider-elements' ),
				'label_off'    => esc_html__( 'Hide', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'show_avatars',
			[
				'label'        => esc_html__( 'Show Reply Avatars', 'spider-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'spider-elements' ),
				'label_off'    => esc_html__( 'Hide', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'avatar_count',
			[
				'label'     => esc_html__( 'Max Avatars', 'spider-elements' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 3,
				'min'       => 1,
				'max'       => 10,
				'condition' => [
					'show_avatars' => 'yes',
				],
			]
		);

		$this->add_control(
			'show_read_more',
			[
				'label'        => esc_html__( 'View Details Link', 'spider-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'spider-elements' ),
				'label_off'    => esc_html__( 'Hide', 'spider-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
			]
		);

		$this->add_control(
			'read_more_text',
			[
				'label'       => esc_html__( 'Link Text', 'spider-elements' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'View Details', 'spider-elements' ),
				'placeholder' => esc_html__( 'View Details', 'spider-elements' ),
				'condition'   => [
					'show_read_more' => 'yes',
				],
			]
		);

		$this->add_control(
			'read_more_new_tab',
			[
				'label'        => esc_html__( 'Open in New Tab', 'spider-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
				'condition'    => [
					'show_read_more' => 'yes',
				],
			]
		);

		$this->end_controls_section();
	}

	// =========================================================================
	// STYLE CONTROLS
	// =========================================================================

	public function elementor_style_control(): void {

		// =========================================================
		// 1. CARD — item wrapper appearance
		// =========================================================
		$this->start_controls_section(
			'style_item_section',
			[
				'label' => esc_html__( 'Card', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_bg_color',
			[
				'label'     => esc_html__( 'Background', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel-faq-item' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'item_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel-faq-item' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'item_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .spel-faq-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'item_box_shadow',
				'selector' => '{{WRAPPER}} .spel-faq-item',
			]
		);

		$this->add_responsive_control(
			'item_gap',
			[
				'label'      => esc_html__( 'Spacing Between Cards', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 60 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .spel-faq-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// =========================================================
		// 2. THUMBNAIL — featured image icon box
		// =========================================================
		$this->start_controls_section(
			'style_icon_section',
			[
				'label' => esc_html__( 'Thumbnail', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => esc_html__( 'Icon Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel-faq-icon'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .spel-faq-icon svg' => 'stroke: {{VALUE}}; fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_bg_color',
			[
				'label'     => esc_html__( 'Background', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel-faq-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_box_size',
			[
				'label'      => esc_html__( 'Box Size', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [ 'min' => 24, 'max' => 80 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .spel-faq-icon' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_font_size',
			[
				'label'      => esc_html__( 'Thumbnail Size', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [ 'min' => 10, 'max' => 48 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .spel-faq-icon i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .spel-faq-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'spider-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem' ],
				'selectors'  => [
					'{{WRAPPER}} .spel-faq-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// =========================================================
		// 3. TYPOGRAPHY — all text groups in one place
		// =========================================================
		$this->start_controls_section(
			'style_content_section',
			[
				'label' => esc_html__( 'Content', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_heading',
			[
				'label' => esc_html__( 'Question Title', 'spider-elements' ),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel-faq-summary-text h3' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'selector' => '{{WRAPPER}} .spel-faq-summary-text h3',
			]
		);

		$this->add_control(
			'meta_heading',
			[
				'label'     => esc_html__( 'Meta Info', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'meta_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel-faq-summary-meta' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'meta_typography',
				'selector' => '{{WRAPPER}} .spel-faq-summary-meta',
			]
		);

		$this->add_control(
			'excerpt_heading',
			[
				'label'     => esc_html__( 'Answer Text', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'excerpt_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel-faq-body p' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'excerpt_typography',
				'selector' => '{{WRAPPER}} .spel-faq-body p',
			]
		);

		// — Reply footer text ("Mira, Jules and 45 others…") —
		$this->add_control(
			'reply_footer_heading',
			[
				'label'     => esc_html__( 'Reply Footer', 'spider-elements' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'helpful_text_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel-faq-reply' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'helpful_typography',
				'selector' => '{{WRAPPER}} .spel-faq-reply',
			]
		);

		$this->end_controls_section();

		// =========================================================
		// 4. AVATARS — stacked commenter / author images
		// =========================================================
		$this->start_controls_section(
			'style_replies_section',
			[
				'label' => esc_html__( 'Avatars', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'avatar_size',
			[
				'label'      => esc_html__( 'Size', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [ 'min' => 16, 'max' => 60 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .spel-avatar-stack span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'avatar_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel-avatar-stack span' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// =========================================================
		// 5. TOGGLE ICON — the expand / collapse indicator
		// =========================================================
		$this->start_controls_section(
			'style_chevron_section',
			[
				'label' => esc_html__( 'Toggle Icon', 'spider-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'chev_icon',
			[
				'label'   => esc_html__( 'Collapsed Icon', 'spider-elements' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-chevron-down',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'chev_icon_active',
			[
				'label'   => esc_html__( 'Expanded Icon', 'spider-elements' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-chevron-up',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_responsive_control(
			'chev_size',
			[
				'label'      => esc_html__( 'Size', 'spider-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [ 'min' => 10, 'max' => 36 ],
				],
				'default'    => [
					'size' => 14,
					'unit' => 'px',
				],
				'selectors'  => [
					'{{WRAPPER}} .spel-faq-chev i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .spel-faq-chev svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'chev_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel-faq-chev'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .spel-faq-chev i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'chev_open_color',
			[
				'label'     => esc_html__( 'Active Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel-faq-item[open] .spel-faq-chev'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .spel-faq-item[open] .spel-faq-chev i' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// =========================================================
		// 6. VIEW DETAILS — the "read more" link
		// =========================================================
		$this->start_controls_section(
			'style_read_more_section',
			[
				'label'     => esc_html__( 'View Details', 'spider-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_read_more' => 'yes',
				],
			]
		);

		$this->add_control(
			'read_more_icon',
			[
				'label'   => esc_html__( 'Icon', 'spider-elements' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-arrow-right',
					'library' => 'fa-solid',
				],
			]
		);

		$this->add_control(
			'read_more_color',
			[
				'label'     => esc_html__( 'Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .spel-faq-read-more' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'read_more_hover_color',
			[
				'label'     => esc_html__( 'Hover Color', 'spider-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .spel-faq-read-more:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'read_more_typography',
				'selector' => '{{WRAPPER}} .spel-faq-read-more',
			]
		);

		$this->end_controls_section();
	}

	// =========================================================================
	// RENDER
	// =========================================================================

	protected function render(): void {
		$settings  = $this->get_settings_for_display();
		$post_type = sanitize_key( $settings['post_type'] ?? 'post' );

		$allowed_orderby = [ 'date', 'modified', 'title', 'rand', 'comment_count' ];
		$orderby         = in_array( $settings['orderby'], $allowed_orderby, true ) ? $settings['orderby'] : 'date';
		$order           = 'ASC' === $settings['order'] ? 'ASC' : 'DESC';

		$query = new WP_Query( [
			'post_type'           => $post_type,
			'posts_per_page'      => absint( $settings['posts_per_page'] ),
			'post_status'         => 'publish',
			'orderby'             => $orderby,
			'order'               => $order,
			'no_found_rows'       => true,
			'ignore_sticky_posts' => true,
		] );

		if ( ! $query->have_posts() ) {
			echo '<p>' . esc_html__( 'No posts found.', 'spider-elements' ) . '</p>';
			return;
		}

		// Post types that use "replies" rather than "comments".
		$forum_types    = [ 'forum', 'docs', 'topic', 'reply', 'doc', 'bbp_topic', 'bbp_reply' ];
		$is_forum       = in_array( $post_type, $forum_types, true );
		$open_first     = 'yes' === ( $settings['open_first'] ?? 'yes' );
		$show_meta      = 'yes' === ( $settings['show_meta'] ?? 'yes' );
		$show_avatars   = 'yes' === ( $settings['show_avatars'] ?? 'yes' );
		$avatar_limit   = absint( $settings['avatar_count'] ?? 3 );
		$show_read_more   = 'yes' === ( $settings['show_read_more'] ?? 'yes' );
		$read_more_text   = ! empty( $settings['read_more_text'] )
			? $settings['read_more_text']
			: esc_html__( 'View Details', 'spider-elements' );
		$read_more_new_tab = 'yes' === ( $settings['read_more_new_tab'] ?? '' );
		$index = 0;

		echo '<div class="spel-faq-wrap">';

		while ( $query->have_posts() ) {
			$query->the_post();

			$content      = $this->get_limited_content( $settings );
			$has_thumb    = has_post_thumbnail();
			$item_classes = 'spel-faq-item' . ( ! $has_thumb ? ' spel-faq-item--no-icon' : '' );

			?>
			<details class="<?php echo esc_attr( $item_classes ); ?>"<?php echo ( $open_first && 0 === $index ) ? ' open' : ''; ?>>
				<summary class="spel-faq-summary">
					<?php if ( $has_thumb ) : ?>
					<span class="spel-faq-icon">
						<?php the_post_thumbnail( [ 38, 38 ] ); ?>
					</span>
					<?php endif; ?>
					<div class="spel-faq-summary-text">
						<h3><?php the_title(); ?></h3>
						<?php if ( $show_meta ) : ?>
						<div class="spel-faq-summary-meta">
							<?php echo wp_kses_post( $this->get_meta_text( $is_forum ) ); ?>
						</div>
						<?php endif; ?>
					</div>
					<span class="spel-faq-chev" aria-hidden="true">
						<?php if ( ! empty( $settings['chev_icon']['value'] ) ) : ?>
							<span class="spel-faq-chev-icon spel-faq-chev-collapsed">
								<?php Icons_Manager::render_icon( $settings['chev_icon'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php else : ?>
							<svg class="spel-faq-chev-icon spel-faq-chev-collapsed" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 9l6 6 6-6"/></svg>
						<?php endif; ?>
						<?php if ( ! empty( $settings['chev_icon_active']['value'] ) ) : ?>
							<span class="spel-faq-chev-icon spel-faq-chev-active">
								<?php Icons_Manager::render_icon( $settings['chev_icon_active'], [ 'aria-hidden' => 'true' ] ); ?>
							</span>
						<?php else : ?>
							<svg class="spel-faq-chev-icon spel-faq-chev-active" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M6 9l6-6 6 6"/></svg>
						<?php endif; ?>
					</span>
				</summary>
				<div class="spel-faq-body">
					<?php if ( $content ) : ?>
						<p><?php echo wp_kses_post( $content ); ?></p>
					<?php endif; ?>
					<?php if ( $show_avatars ) : ?>
					<?php $this->render_reply_row( get_the_ID(), $avatar_limit ); ?>
					<?php endif; ?>
					<?php if ( $show_read_more ) : ?>
					<a href="<?php the_permalink(); ?>" class="spel-faq-read-more"<?php if ( $read_more_new_tab ) : ?> target="_blank" rel="noopener noreferrer"<?php endif; ?>>
						<?php echo esc_html( $read_more_text ); ?>
						<?php if ( ! empty( $settings['read_more_icon']['value'] ) ) : ?>
							<?php Icons_Manager::render_icon( $settings['read_more_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						<?php else : ?>
							<svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
						<?php endif; ?>
					</a>
					<?php endif; ?>
				</div>
			</details>
			<?php

			$index++;
		}

		echo '</div>';
		wp_reset_postdata();
	}

	/**
	 * Returns the content string, trimmed to the configured word limit.
	 * A limit of -1 (or any value < 1) means show all content.
	 */
	private function get_limited_content( array $settings ): string {
		if ( 'content' === $settings['content_source'] ) {
			$content = get_the_content();
		} else {
			$content = get_the_excerpt();
			// Fall back to full content when no excerpt is set.
			if ( '' === trim( $content ) ) {
				$content = get_the_content();
			}
		}

		$content = wp_strip_all_tags( $content );
		$limit   = (int) ( $settings['limit_number'] ?? -1 );

		if ( $limit > 0 ) {
			$content = wp_trim_words( $content, $limit, '&hellip;' );
		}

		return $content;
	}

	/**
	 * Builds the meta line: "Answered · N replies · updated X ago".
	 * Handles singular/plural and zero-count grammar correctly.
	 */
	private function get_meta_text( bool $is_forum ): string {
		$count     = (int) get_comments_number();
		$time_diff = human_time_diff( (int) get_the_modified_time( 'U' ), time() );

		if ( $is_forum ) {
			if ( 0 === $count ) {
				$count_text = esc_html__( 'No reply', 'spider-elements' );
			} elseif ( 1 === $count ) {
				$count_text = esc_html__( '1 reply', 'spider-elements' );
			} else {
				/* translators: %s: number of replies */
				$count_text = sprintf( esc_html__( '%s replies', 'spider-elements' ), number_format_i18n( $count ) );
			}
		} else {
			if ( 0 === $count ) {
				$count_text = esc_html__( 'No comment', 'spider-elements' );
			} elseif ( 1 === $count ) {
				$count_text = esc_html__( '1 comment', 'spider-elements' );
			} else {
				/* translators: %s: number of comments */
				$count_text = sprintf( esc_html__( '%s comments', 'spider-elements' ), number_format_i18n( $count ) );
			}
		}

		return sprintf(
			/* translators: 1: count phrase (e.g. "3 replies"), 2: human time diff */
			__( 'Answered &middot; %1$s &middot; updated %2$s ago', 'spider-elements' ),
			$count_text,
			$time_diff
		);
	}

	/**
	 * Renders the stacked-avatar row with names and helpful count.
	 */
	private function render_reply_row( int $post_id, int $limit ): void {
		// Fetch without type filter so forum replies, topic replies, etc. are included.
		$comments = get_comments( [
			'post_id' => $post_id,
			'number'  => $limit,
			'status'  => 'approve',
		] );

		// Build avatar stack: post author first, then commenters.
		$avatars = [];

		$author_id  = (int) get_the_author_meta( 'ID' );
		$author_url = get_avatar_url( $author_id, [ 'size' => 44 ] );
		if ( $author_url ) {
			$avatars[] = [ 'url' => $author_url, 'name' => get_the_author() ];
		}

		foreach ( $comments as $comment ) {
			if ( count( $avatars ) >= $limit ) {
				break;
			}
			$url = get_avatar_url( $comment, [ 'size' => 44 ] );
			if ( $url && $url !== $author_url ) {
				$avatars[] = [ 'url' => $url, 'name' => $comment->comment_author ];
			}
		}

		echo '<div class="spel-faq-reply">';
		echo '<div class="spel-avatar-stack">';

		foreach ( $avatars as $avatar ) {
			printf(
				'<span style="background-image:url(%s);" title="%s"></span>',
				esc_url( $avatar['url'] ),
				esc_attr( $avatar['name'] )
			);
		}

		echo '</div>'; // .spel-avatar-stack

		echo '<span>';

		if ( ! empty( $comments ) ) {
			$names  = array_map( static fn( $c ) => $c->comment_author, array_slice( $comments, 0, 2 ) );
			$others = max( 0, get_comments_number( $post_id ) - 2 );

			if ( $others > 0 ) {
				printf(
					/* translators: 1: Comma-separated names, 2: extra count */
					esc_html__( '%1$s and %2$s others found this helpful', 'spider-elements' ),
					esc_html( implode( ', ', $names ) ),
					absint( $others )
				);
			} else {
				printf(
					/* translators: 1: Name or names */
					esc_html__( '%s found this helpful', 'spider-elements' ),
					esc_html( implode( ' &amp; ', $names ) )
				);
			}
		} else {
			echo esc_html__( 'Be the first to reply', 'spider-elements' );
		}

		echo '</span>';
		echo '</div>'; // .spel-faq-reply
	}
}
