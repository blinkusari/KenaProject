<?php
/**
 * WooCommerce functions
 * Functions for check and functions for 3rd plugin.
 * @package     Zoo Theme
 * @version     3.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 
 * @des         All custom functions of WooCommerce will add at this file.
 */

/**
 * zoo_product_hover_effect
 * Hover effect of product item
 * @uses using function zoo_product_hover_effect()
 * @return Hover effect style.
 */
if (!function_exists('zoo_product_hover_effect')) {
    function zoo_product_hover_effect()
    {
        $zoo_hover_effect = get_theme_mod('zoo_product_hover_effect', 'default');
        if (isset($_GET['product_style'])):
            $zoo_hover_effect = $_GET['product_style'];
        endif;
        return $zoo_hover_effect;
    }
}

/**
 * zoo_show_alternate_img
 * Check allow show alternative image, disable in mobile;
 * @uses using function zoo_show_alternate_img()
 * @return allow show or not.
 */
if (!function_exists('zoo_show_alternate_img')) {
    function zoo_show_alternate_img()
    {
        if (get_theme_mod('zoo_enable_alternative_images', '1') != '0' && !wp_is_mobile()) {
            return true;
        }else{
            return false;
        }
    }
}
/**
 * zoo_enable_catalog_mod
 * Enable catalog mod
 * @uses using function zoo_enable_catalog_mod()
 * @return Remove button cart by using hook, and catalog status enable or not.
 */
if (!function_exists('zoo_enable_catalog_mod')) {
    function zoo_enable_catalog_mod()
    {
        $zoo_catalog_status = get_theme_mod('zoo_enable_catalog_mod', '') == '1' ? true : false;
        if (isset($_GET['catalog_mod'])):
            $zoo_catalog_status = true;
        endif;
        return $zoo_catalog_status;
    }
}

//GDPR Hook
remove_action('register_form', array('GDPR', 'consent_checkboxes'));