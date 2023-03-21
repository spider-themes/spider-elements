<?php
namespace Spider_Elements_Assets;

use Spider_Elements_Assets\PageSettings\Page_Settings;

/**
 * Class Plugin
 *
 * Main Plugin class
 * @since 1.2.0
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @since 1.2.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * widget_scripts
	 *
	 * Load required plugin core files.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function widget_scripts() {
		// wp_register_script( 'Spider_Elements_Assets', plugins_url( '/assets/js/hello-world.js', __FILE__ ), [ 'jquery' ], false, true );
		// wp_enqueue_style( 'bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' );
		// wp_enqueue_script( 'bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js', [ 'jquery' ], false, true );

	}

		/**
		 * Register Widget Styles
		 *
		 * Register custom styles required to run Docy Core.
		 *
		 * @access public
		 */
		public function enqueue_sp_elements_widget_styles() {
			wp_register_style( 'ionicons', 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', '', '2.0.1' );
			wp_register_style( 'prism', plugins_url( 'assets/vendors/prism/prism.min.css', __FILE__ ) );
			wp_register_style( 'nice-select', plugins_url( 'assets/vendors/niceselectpicker/nice-select.css', __FILE__ ) );
			wp_register_style( 'simple-line-icon', plugins_url( 'assets/vendors/simple-line-icon/simple-line-icons.css', __FILE__ ) );
			wp_register_style( 'animated', plugins_url( 'assets/vendors/slick/animated.css', __FILE__ ) );
			wp_register_style( 'slick', plugins_url( 'assets/vendors/slick/slick.css', __FILE__ ) );
			wp_register_style( 'slick-theme', plugins_url( 'assets/vendors/slick/slick-theme.css', __FILE__ ) );
			wp_register_style( 'elegant-icon', plugins_url( 'assets/vendors/elegant-icon/style.css', __FILE__ ) );
			wp_register_style( 'video-js', plugins_url( 'assets/vendors/video/videojs.min.css', __FILE__ ) );
			wp_register_style( 'video-js-theaterMode', plugins_url( 'assets/vendors/video/videojs.theaterMode.css', __FILE__ ) );
		}

		/**
		 * Register Widget Scripts
		 *
		 * Register custom scripts required to run Docy Core.
		 *
		 * @access public
		 */
		public function register_sp_elements_widget_scripts() {
			wp_register_script( 'ajax-chimp', plugins_url( 'assets/js/ajax-chimp.js', __FILE__ ), 'jquery', '1.0', true );
			wp_register_script( 'prism', plugins_url( 'assets/vendors/prism/prism.js', __FILE__ ), array( 'jquery' ), '1.17.1', true );
			wp_register_script( 'tooltipster', plugins_url( 'assets/vendors/tooltipster/js/tooltipster.bundle.min.js', __FILE__ ), array( 'jquery' ), '4.2.8', true );
			wp_register_script( 'parallaxie', plugins_url( 'assets/js/parallaxie.js', __FILE__ ), array( 'jquery' ), '0.5', true );
			wp_register_script( 'nice-select', plugins_url( 'assets/vendors/niceselectpicker/jquery.nice-select.min.js', __FILE__ ), 'jquery', '1.0', true );
			wp_register_script( 'floatThead', plugins_url( 'assets/js/jquery.floatThead.min.js', __FILE__ ), array( 'jquery' ), '2.1.4', true );
			wp_register_script( 'counterup', plugins_url( 'assets/vendors/counterup/jquery.counterup.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_register_script( 'waypoints', plugins_url( 'assets/vendors/counterup/jquery.waypoints.min.js', __FILE__ ), array( 'jquery' ), '4.0.1', true );
			wp_register_script( 'tweenmax', plugins_url( 'assets/js/TweenMax.min.js', __FILE__ ), array( 'jquery' ), '2.0.0', true );
			wp_register_script( 'wavify', plugins_url( 'assets/js/jquery.wavify.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_register_script( 'chart', plugins_url( 'assets/js/Chart.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
			wp_register_script( 'slick', plugins_url( 'assets/vendors/slick/slick.min.js', __FILE__ ), array( 'jquery' ), '1.9.0', true );
			wp_register_script( 'wow', plugins_url( 'assets/vendors/wow/wow.min.js', __FILE__ ), array( 'jquery' ), '1.9.0', true );
			wp_register_script( 'artplayer', plugins_url( 'assets/vendors/video/artplayer.js', __FILE__ ), array( 'jquery' ), '3.5.26', true );
			wp_register_script( 'mcustomscrollbar', plugins_url( 'assets/vendors/mcustomscrollbar/jquery.mCustomScrollbar.concat.min.js', __FILE__ ), array( 'jquery' ), '3.1.13', true );
			wp_register_script( 'parallax-scroll', plugins_url( 'assets/js/jquery.parallax-scroll.js', __FILE__ ), array( 'jquery' ), '3.1.13', true );
			wp_register_script( 'video-js', plugins_url( 'assets/vendors/video/video.min.js', __FILE__ ), array( 'jquery' ), '7.6.0', true );
			wp_register_script( 'video-js-nuevo', plugins_url( 'assets/vendors/video/nuevo.min.js', __FILE__ ), array( 'jquery' ), '7.6.0', true );
		}
		

	/**
	 * Editor scripts
	 *
	 * Enqueue plugin javascripts integrations for Elementor editor.
	 *
	 * @since 1.2.1
	 * @access public
	 */
	public function editor_scripts() {
		add_filter( 'script_loader_tag', [ $this, 'editor_scripts_as_a_module' ], 10, 2 );

		wp_enqueue_script(
			'elementor-hello-world-editor',
			plugins_url( '/assets/js/editor/editor.js', __FILE__ ),
			[
				'elementor-editor',
			],
			'1.2.1',
			true
		);
	}

	/**
	 * Force load editor script as a module
	 *
	 * @since 1.2.1
	 *
	 * @param string $tag
	 * @param string $handle
	 *
	 * @return string
	 */
	public function editor_scripts_as_a_module( $tag, $handle ) {
		if ( 'elementor-hello-world-editor' === $handle ) {
			$tag = str_replace( '<script', '<script type="module"', $tag );
		}

		return $tag;
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *
	 * @since 1.2.0
	 * @access public
	 *
	 * @param Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {
		// Its is now safe to include Widgets files
		require_once( __DIR__ . '/widgets/Tabs.php' );
		require_once( __DIR__ . '/widgets/Video_playlist.php' );

		// Register Widgets
		$widgets_manager->register( new widgets\Tabs() );
		$widgets_manager->register( new widgets\Video_playlist() );
	}

	  // Register category
	  public function Sp_Elements_register_category( $elements_manager ) {
        $elements_manager->add_category(
            'spider-elements', [
                'title' => __( 'SPIDER ELEMENTS', 'spider-elements' ),
            ]
        );
    }

	/**
	 * Add page settings controls
	 *
	 * Register new settings for a document page settings.
	 *
	 * @since 1.2.1
	 * @access private
	 */
	private function add_page_settings_controls() {
		require_once( __DIR__ . '/page-settings/manager.php' );
		new Page_Settings();
	}

	public function core_includes() {
		// Get option values from theme options

		// Extra functions
		require_once __DIR__ . '/inc/extra.php';
		//require_once __DIR__ . '/inc/notices.php';
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function __construct() {

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'widget_scripts' ] );
		$this->core_includes();

		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		 // Register Category
		 add_action( 'elementor/elements/categories_registered', [ $this, 'Sp_Elements_register_category' ] );

		 // Register widget style
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_sp_elements_widget_styles' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_sp_elements_widget_scripts' ] );
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'register_sp_elements_widget_scripts' ] );

		// Register editor scripts
		add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_scripts' ] );
		
		$this->add_page_settings_controls();
	}
}

// Instantiate Plugin Class
Plugin::instance();
