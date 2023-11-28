<?php
/**
 * WooCommerce Single Product functions for control features and templates.
 * @package     Zoo Theme
 * @version     3.0.0
 * @author      Zootemplate
 * @link        http://www.zootemplate.com
 * @copyright   Copyright (c) 2017 Zootemplate
 * @des         All custom functions, hooks, template of single product WooCommerce.
 */


/**
 * Add custom image size
 */
add_image_size('zoo-gallery-thumb', get_theme_mod('zoo-gallery-thumbnail_width','120'), get_theme_mod('zoo-gallery-thumbnail_height','120'), get_theme_mod('zoo-gallery-thumbnail_crop','0'));
add_filter('image_size_names_choose', 'zoo_custom_gallery_img_sizes');
if(!function_exists('zoo_custom_gallery_img_sizes')){
    function zoo_custom_gallery_img_sizes($imgsizes)
    {
        return array_merge($imgsizes, array(
            'zoo-gallery-thumb' => esc_html__('Custom Product Gallery Thumbnail', 'fona'),
        ));
    }
}

/**
 * Change Image thumbnail gallery size
 *
 * */
add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) {
    return 'zoo-gallery-thumb';
} );

/**
 * Remove single add to cart button
 * If catalog mod is enable, cart button will remove.
 * @uses override function woocommerce_template_single_add_to_cart and return false
 * @return false
 *
 */
if ( zoo_enable_catalog_mod() ) {
    function woocommerce_template_single_add_to_cart() {
        return false;
    }
}
/**
 *  Add theme support product gallery light box and zoom if that features is activated.
 * @uses: Must hook to action after_setup_theme for it work.
 */
if ( ! function_exists( 'zoo_enable_product_gallery_features' ) ) {
    function zoo_enable_product_gallery_features() {
        if ( get_theme_mod( 'zoo_enable_product_lb', '1' ) == 1 ) {
            add_theme_support( 'wc-product-gallery-lightbox' );
        }
        if ( get_theme_mod( 'zoo_enable_product_zoom', '1' ) == 1 ) {
            add_theme_support( 'wc-product-gallery-zoom' );
        }
    }
}
add_action( 'after_setup_theme', 'zoo_enable_product_gallery_features' );
//Remove avatar for review form
remove_action('woocommerce_review_before','woocommerce_review_display_gravatar');
if ( ! class_exists( 'Clever_Woo_Builder' ) ) {
    add_filter('woocommerce_product_description_heading', '__return_null');
}