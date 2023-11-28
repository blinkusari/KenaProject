<?php
/**
 * Theme functions and definitions
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2018 Zootemplate
 
 */

/**
 * Theme functions
 * All theme functions will load below.
 */
include ZOO_THEME_DIR.'inc/theme-functions/helper.php';
include ZOO_THEME_DIR.'inc/theme-functions/theme-features.php';
include ZOO_THEME_DIR.'inc/theme-functions/theme-sidebars.php';
include ZOO_THEME_DIR.'inc/theme-functions/theme-scripts.php';
include ZOO_THEME_DIR.'inc/theme-functions/theme-plugins.php';
include ZOO_THEME_DIR.'inc/theme-functions/theme-functions.php';


/**
 * WooCommerce theme functions
 * All hooks, functions, features will load below.
 */
if (class_exists('WooCommerce', false)) {
    require ZOO_THEME_DIR.'inc/woocommerce/theme-woocommerce.php';
}

/**
 * Theme customize and metaboxes
 */
require ZOO_THEME_DIR.'inc/metaboxes/meta-boxes.php';
require ZOO_THEME_DIR.'inc/customize/customize-style.php';

/**
 * Custom function for Edd plugin.
 * All theme functions will load below.
 */
include ZOO_THEME_DIR.'inc/edd/custom-edd.php';