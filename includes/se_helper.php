<?php
/**
 * Landpagy theme helper functions and resources
 */

class Se_Helper {
    /**
     * Hold an instance of Helper_Core_Helper_Class class.
     * @var Se_Helper
     */
    protected static $instance = null;

    /**
     * Main Helper_Core_Helper_Class instance.
     * @return Se_Helper - Main instance.
     */
    public static function instance()
    {

        if (null == self::$instance) {
            self::$instance = new Se_Helper();
        }

        return self::$instance;
    }


}


/**
 * Instance of Helper_Core_Helper_Class class
 */
function Se_Helper() {
    return Se_Helper::instance();
}