<?php
namespace SPEL\includes\template_library;

/**
 * Class Template_Library
 * @package DocyCore
 * @since 3.3.0
 */
class Template_Library {

	public function __construct() {
		$this->core_includes();
	}

	public function core_includes(): void
    {

		// templates
		include( __DIR__ . '/templates/Import.php');
		include( __DIR__ . '/templates/Init.php');
		include( __DIR__ . '/templates/Load.php');
		include( __DIR__ . '/templates/Api.php');

        \SPEL\includes\template_library\Import::instance()->load();
        \SPEL\includes\template_library\Load::instance()->load();
        \SPEL\includes\template_library\Init::instance()->init();

		if (!defined('DOCY_TEMPLATE_WHITE_LOGO_SRC')){
			define('DOCY_TEMPLATE_WHITE_LOGO_SRC', plugin_dir_url( __FILE__ ) . 'templates/assets/img/template_white_logo.svg');
		}

		if (!defined('DOCY_TEMPLATE_LOGO_SRC')){
			define('DOCY_TEMPLATE_LOGO_SRC', plugin_dir_url( __FILE__ ) . 'templates/assets/img/template_logo.svg');
		}

	}

}