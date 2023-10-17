<?php
/**
 * Use namespace to avoid conflict
 */
namespace Spider_Elements\Widgets;

use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Team
 * @package spider\Widgets
 * @since 1.0.0
 */
class Instagram extends Widget_Base {

	public function get_name() {
		return 'spe_instagram';
	}

	public function get_title() {
		return esc_html__( 'Instagram', 'spider-elements' );
	}

	public function get_icon() {
		return 'eicon-instagram-post spe-icon';
	}

	public function get_keywords() {
		return [ 'spider', 'Instagram', 'Feed', 'Instagram Feed' ];
	}

	public function get_categories() {
		return [ 'spider-elements' ];
	}

	/**
	 * Name: get_style_depends()
	 * Desc: Register the required CSS dependencies for the frontend.
	 */
	public function get_style_depends() {
		return [ 'swiper', 'spe-main' ];
	}

	/**
	 * Name: get_script_depends()
	 * Desc: Register the required JS dependencies for the frontend.
	 */
	public function get_script_depends() {
		return [ 'swiper', 'spe-el-widgets' ];
	}

	/**
	 * Name: register_controls()
	 * Desc: Register controls for these widgets
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	protected function register_controls() {
		$this->elementor_content_control();
		$this->counter_style_control();
	}


	/**
	 * Name: elementor_content_control()
	 * Desc: Register the Content Tab output on the Elementor editor.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */

	public function elementor_content_control() {

		//==================== Select Preset Skin ====================//
		$this->start_controls_section(
			'instagram_preset', [
				'label' => __( 'Preset Skin', 'spider-elements' ),
			]
		);

		$this->add_control(
			'style', [
				'label'   => esc_html__( 'Style', 'spider-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'1' => [
						'icon'  => 'instagram1',
						'title' => esc_html__( '01 : Instagram', 'spider-elements' )
					],
				],
				'default' => '1',
			],
		);

		$this->end_controls_section(); // End Preset Skin


		//=================== Instagram Feed ===================//
		$this->start_controls_section(
			'sec_instagram', [
				'label' => esc_html__( 'Instagram Feed', 'spider-elements' ),
			]
		);

		/*$this->add_control(
			'instagram_app_id', [
				'label'       => esc_html__('Instagram App ID', 'spider-elements'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __('---------------', 'spider-elements')
			]
		);*/

		/*$this->add_control(
			'instagram_app_secret_key', [
				'label'       => esc_html__('Instagram App Secret', 'spider-elements'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __('---------------', 'spider-elements')
			]
		);*/

		$this->add_control(
			'instagram_user_token', [
				'label'       => esc_html__('Instagram Token', 'spider-elements'),
				'description' => esc_html__('Enter instagram User Token if you want to show separated user\'s photos', 'spider-elements'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __('---------------', 'spider-elements')
			]
		);

		$this->end_controls_section(); // End Instagram Feed

	}


	/**
	 * Name: counter_style_control()
	 * Desc: Register the Style Tab output on the Elementor editor.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	public function counter_style_control() {

	}

	/**
	 * Name: elementor_render()
	 * Desc: Render the widget output on the frontend.
	 * Params: no params
	 * Return: @void
	 * Since: @1.0.0
	 * Package: @spider-elements
	 * Author: spider-themes
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		extract( $settings ); //extract all settings array to variables converted to name of key


		$access_token = !empty($instagram_user_token) ? $instagram_user_token : '';

		// Instagram API Endpoint
		$api_url = "https://graph.instagram.com/v13.0/me/media?fields=id,caption,media_type,media_url,thumbnail_url,permalink,timestamp&access_token=$access_token";

		// Fetch Instagram Data
		$response = file_get_contents($api_url);
		$data = json_decode($response);


		//================= Template Parts =================//
		include "templates/instagram/instagram-1.php";

	}



}