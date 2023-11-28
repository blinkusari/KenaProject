<?php
/**
 * List of hooks in CW Ajax Product Filter plugin.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

$cwapf = new CWAPF();

add_action('woocommerce_before_shop_loop', array('CWAPF', 'beforeProductsHolder'), 0);
add_action('woocommerce_after_shop_loop', array('CWAPF', 'afterProductsHolder'), 200);
add_action('woocommerce_before_template_part', array('CWAPF', 'beforeNoProducts'), 0);
add_action('woocommerce_after_template_part', array('CWAPF', 'afterNoProducts'), 200);

add_action('paginate_links', array('CWAPF', 'paginateLinks'));

// frontend sctipts
add_action('wp_enqueue_scripts', array($cwapf, 'frontendScripts'));

// filter products
add_action('woocommerce_product_query', array($cwapf, 'setFilter'));

// clear old transients
add_action('create_term', 'cwapf_clear_transients');
add_action('edit_term', 'cwapf_clear_transients');
add_action('delete_term', 'cwapf_clear_transients');

add_action('save_post', 'cwapf_clear_transients');
add_action('delete_post', 'cwapf_clear_transients');