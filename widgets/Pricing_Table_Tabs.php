<?php
namespace Spider_Elements_Assets\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Pricing_Table_Tabs
 * @package LandpagyCore\Widgets
 */
class Pricing_Table_Tabs extends Widget_Base {
	public function get_name() {
		return 'landpagy_pricing_table_tabs';
	}

	public function get_title() {
		return __( 'Pricing Table Tabs', 'landpagy-core' );
	}

	public function get_icon() {
		return 'eicon-price-table';
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}


    /**
     * Name: register_controls()
     * Desc: Register controls for these widgets
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @landpagy
     * Author: spider-themes
     */
    protected function register_controls() {
        $this->elementor_content_control();
        $this->elementor_style_control();
    }


    /**
     * Name: elementor_content_control()
     * Desc: Register content
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @landpagy
     * Author: spider-themes
     */
    public function elementor_content_control() {

        // ------------------------------------------- Pricing Table Tabs ----------------------------------------- //
        $this->start_controls_section(
            'pricing_table_tabs', [
                'label' => __( 'Pricing Tables', 'landpagy-core' ),
            ]
        );

        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'is_active',
            [
                'label' => __( 'Active Table', 'landpagy-core' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $repeater->add_control(
            'tab_title', [
                'label' => __( 'Tab Title', 'landpagy-core' ),
                'type' => Controls_Manager::TEXT,
                'separator' => 'after'
            ]
        );

        $repeater->add_control(
            'discount', [
                'label' => __( 'Discount Badge', 'landpagy-core' ),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'title', [
                'label' => __( 'Title', 'landpagy-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Free'
            ]
        );

        $repeater->add_control(
            'price_dollar', [
                'label' => __( 'Price USD', 'landpagy-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '$5'
            ]
        );

        $repeater->add_control(
            'price_euro', [
                'label' => __( 'Price EURO', 'landpagy-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '€4.43'
            ]
        );

        $repeater->add_control(
            'duration', [
                'label' => __( 'Duration', 'landpagy-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => '/user/mo'
            ]
        );

        $repeater->add_control(
            'description', [
                'label' => __( 'Description', 'landpagy-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => '1 user'
            ]
        );

        $repeater->add_control(
            'contents', [
                'label' => __( 'Contents', 'landpagy-core' ),
                'type' => Controls_Manager::WYSIWYG,
            ]
        );

        $repeater->add_control(
            'btn_group_heading', [
                'label' => __( 'Button Group', 'landpagy-core' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'btn_label_1', [
                'label' => __( 'Button Title 01', 'landpagy-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Continue'
            ]
        );

        $repeater->add_control(
            'btn_url_1', [
                'label' => __( 'Button URL 01', 'landpagy-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ],
                'separator' => 'before'
            ]
        );

        $repeater->add_control(
            'btn_label_2', [
                'label' => __( 'Button Title 02', 'landpagy-core' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => 'Continue'
            ]
        );

        $repeater->add_control(
            'btn_url_2', [
                'label' => __( 'Button URL 02', 'landpagy-core' ),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#'
                ],
                'separator' => 'after'
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Background::get_type(), [
                'name' => 'item_box_bg_color',
                'label' => __( 'Background', 'landpagy-core' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}}',
            ]
        );

        $this->add_control(
            'pricing_tables', [
                'label' => __( 'Pricing Table', 'landpagy-core' ),
                'type' => Controls_Manager::REPEATER,
                'prevent_empty' => false,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->add_control(
            'ribbon_label', [
                'label' => __( 'Ribbon Label', 'landpagy-core' ),
                'type' => Controls_Manager::MEDIA,
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

    }


    /**
     * Name: elementor_style_control()
     * Desc: Register style content
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @landpagy
     * Author: spider-themes
     */
    public function elementor_style_control () {


    }


    /**
     * Name: elementor_render()
     * Desc: Render widget output on the frontend.
     * Params: no params
     * Return: @void
     * Since: @1.0.0
     * Package: @landpagy
     * Author: spider-themes
     */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$pricing_tables = $settings['pricing_tables'];
		$cats       = array_column( $pricing_tables, 'tab_title' );
		$getCats    = array_unique( $cats );
		$table_data = return_tab_data( $getCats , $pricing_tables );

		?>
		<div class="row">
			<div class="col-8">
				<ul class="nav nav-tabs pricing-tabs" id="myTab" role="tablist">
					<?php
					if ( is_array( $pricing_tables ) && count( $pricing_tables ) > 0 ){
						$tabs   = '';
						$i      = 0;
						foreach ( $getCats as $cat ) {
							$catForFilter = sanitize_title_with_dashes( $cat );
							$catForFilter = str_replace( '-', '', $catForFilter );
							$i++;
							$active = $i == 1 ? ' active' : '';
							$aria_selected = $i==1 ? 'true' : 'false';
							$tabs .= '<li class="nav-item" role="presentation">
                                     <button class="nav-link'. esc_attr( $active ) .'" id="'.esc_attr( $catForFilter ).'-tab" data-bs-toggle="tab" data-bs-target="#'.esc_attr( $catForFilter ).'" type="button" role="tab" aria-controls="'.esc_attr( $catForFilter ).'" aria-selected="'. esc_attr( $aria_selected ) .'">
                                        '. esc_html( $cat ) .'
                                     </button>
                                 </li>';
							$i++;
						}
						echo $tabs;
					}
					?>
				</ul>
			</div>
			<div class="col-4">
                <select class="pricing-currency">
                    <option data-display="USD"><?php esc_html_e( 'USD', 'landpagy-core' ); ?></option>
                    <option data-display="EURO"><?php esc_html_e( 'EURO', 'landpagy-core' ); ?></option>
                </select>
			</div>
		</div>
		<div class="tab-content" id="myTabContent">
			<?php
			if ( !empty( $table_data ) ) {
				$i = 0;
				foreach ($table_data as $key => $value) {
					$tagforfilter = sanitize_title_with_dashes($key);
					$catForFilter = str_replace( '-', '', $tagforfilter );
					$i++;
					$active = $i == 1 ? ' show active' : '';
					?>
					<div class="tab-pane fade<?php echo $active ?>" id="<?php echo esc_attr($catForFilter); ?>" role="tabpanel" aria-labelledby="<?php echo esc_attr($catForFilter); ?>-tab">
						<div class="row">
							<?php
							foreach ( $value as $table_item ) {
							    $id = wp_unique_id($catForFilter.'-1');
								?>
								<div class="col-sm-6 col-xl-3" id="<?php echo esc_attr($id); ?>">
									<div class="pricing-item elementor-repeater-item-<?php echo esc_attr($table_item['_id']) ?><?php echo esc_attr($table_item['is_active'] == 'yes' ? ' active' : '') ?>">
										<?php
										if ( !empty($table_item['discount']) ) {
											?>
											<div class="badge"><?php echo esc_html($table_item['discount']) ?></div>
											<?php
										}
										if ( !empty($table_item['title']) ) {
											?>
											<h3 class="pricing-title"><?php echo esc_html($table_item['title']) ?></h3>
											<?php
										}
										if ( !empty($table_item['price']) ) {
											?>
											<div class="price">
                                                <?php
                                                if ( !empty($table_item['price_dollar']) ) { ?>
                                                    <span class="dollar"><?php echo esc_html($table_item['price_dollar']) ?></span>
                                                    <?php
                                                }
                                                if ( !empty($table_item['price_euro']) ) { ?>
                                                    <span class="euro"><?php echo esc_html($table_item['price_euro']) ?></span>
                                                    <?php
                                                }
                                                if ( !empty($table_item['duration']) ) { ?>
                                                    <sup> <?php echo esc_html($table_item['duration']) ?></sup>
                                                    <?php
                                                }
                                                ?>
											</div>
											<?php
										}
										if ( !empty($table_item['description']) ) { ?>
											<span class="pricing-item-user"><?php echo esc_html($table_item['description']) ?></span>
											<?php
										}
										if ( !empty($table_item['btn_label_1']) ) { ?>
											<a <?php Se_Core_Helper()->the_button($table_item['btn_url_1']) ?> class="pricing-btn">
												<?php echo esc_html($table_item['btn_label_1']) ?>
											</a>
											<?php
										}
										if ( !empty($table_item['contents']) ) { ?>
											<?php echo Se_Core_Helper()->kses_post($table_item['contents']) ?>
											<?php
										}
										if ( !empty($table_item['btn_label_2']) ) { ?>
											<a <?php Se_Core_Helper()->the_button($table_item['btn_url_2']) ?> class="pricing-btn">
												<?php echo esc_html($table_item['btn_label_2']) ?>
											</a>
											<?php
										}
										?>
									</div>
								</div>
								<?php
							}
							?>
						</div>
						<?php landpagy_el_image($settings['ribbon_label'], 'Popular', 'popular d-none d-lg-block') ?>
					</div>
					<?php
				}
			}
			?>
		</div>
		<?php
	}
}