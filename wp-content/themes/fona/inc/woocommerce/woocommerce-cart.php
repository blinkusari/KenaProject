<?php
/**
 * WooCommerce functions for cart, check out, my account page
 * @package     Zoo Theme
 * @version     3.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2020 ZooTemplate
 * @des         All custom functions of WooCommerce for control templates, features of cart, check out, my account page.
 */

/**
 * Return to Shop button
 * Allow back to shop case cart empty
 * @return button return to shop
 *
 * @uses using function zoo_back_to_shop, can apply to default hook of WooCommerce woocommerce_after_mini_cart
 */
if (!function_exists('zoo_back_to_shop')) {
    function zoo_back_to_shop()
    {
        if (!WC()->cart->is_empty()) {
            return;
        }

        if (wc_get_page_id('shop') > 0) : ?>
            <p class="return-to-shop">
                <a class="button wc-backward"
                   href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>">
                    <?php
                    /**
                     * Filter "Return To Shop" text.
                     *
                     * @param string $default_text Default text.
                     * @since 4.6.0
                     */
                    echo esc_html(apply_filters('woocommerce_return_to_shop_text', __('Return to shop', 'fona')));
                    ?>
                </a>
            </p>
        <?php endif;
    }
}
add_action('woocommerce_after_mini_cart', 'zoo_back_to_shop', 5);
/**
 * Free shipping cart notice
 * Allow display free shipping notice in cart and minicart with loading parse bar.
 * @return Free shipping notice template with loading bar.
 *
 * @uses using hook zoo_enable_free_shipping_notice, can apply to default hook of WooCommerce
 */
if (get_theme_mod('zoo_enable_free_shipping_notice', '1') == '1') {
    if (!function_exists('zoo_free_shipping_cart_notice')) {
        function zoo_free_shipping_cart_notice()
        {

            if (WC()->cart->is_empty()) {
                return;
            }
            // Get Free Shipping Methods for Rest of the World Zone & populate array $min_amounts
            $default_zone = new WC_Shipping_Zone(0);

            $default_methods = $default_zone->get_shipping_methods();
            foreach ($default_methods as $key => $value) {
                if ($value->id === "free_shipping") {
                    if ($value->min_amount > 0) {
                        $min_amounts[] = $value->min_amount;
                    }
                }
            }
            // Get Free Shipping Methods for all other ZONES & populate array $min_amounts
            $delivery_zones = WC_Shipping_Zones::get_zones();
            foreach ($delivery_zones as $key => $delivery_zone) {
                foreach ($delivery_zone['shipping_methods'] as $key => $value) {
                    if ($value->id === "free_shipping") {
                        if ($value->min_amount > 0) {
                            $min_amounts[] = $value->min_amount;
                        }
                    }
                }
            }
            // Find lowest min_amount
            if (isset($min_amounts)) {
                if (is_array($min_amounts) && $min_amounts) {
                    $min_amount = min($min_amounts);
                    // Get Cart Subtotal inc. Tax excl. Shipping
                    $current = WC()->cart->subtotal;
                    // If Subtotal < Min Amount Echo Notice
                    // and add "Continue Shopping" button
                    if ($current > 0) {
                        $percent = round(($current / $min_amount) * 100, 2);
                        $percent >= 100 ? $percent = '100' : '';
                        if ($percent < 40) {
                            $parse_class = 'first-parse';
                        } elseif ($percent >= 40 && $percent < 80) {
                            $parse_class = 'second-parse';
                        } else {
                            $parse_class = 'final-parse';
                        }
                        $parse_class .= ' free-shipping-required-notice';
                        $added_text = '<i class="cs-font clever-icon-truck"></i> ';
                        if ($current < $min_amount) {
                            $added_text .= esc_html__('Spend ', 'fona') . wc_price($min_amount - $current) . esc_html__('  to get Free Shipping ', 'fona');
                        } else {
                            $added_text .= esc_html__('Congratulations! You\'ve got free shipping!', 'fona');
                        }
                        $html = '<div class="' . esc_attr($parse_class) . '">';
                        $html .= '<div class="zoo-loading-bar"><div class="load-percent" style="width:' . esc_attr($percent) . '%">';
                        $html .= '</div><span class="label-free-shipping">' . $added_text . '</span></div>';
                        $html .= '</div>';
                        echo ent2ncr($html);
                    }
                }
            }
        }
    }
    add_action('woocommerce_widget_shopping_cart_before_buttons', 'zoo_free_shipping_cart_notice', 5);
    add_action('woocommerce_before_cart_totals', 'zoo_free_shipping_cart_notice', 5);
    add_action('zoo_free_shipping_cart_notice', 'zoo_free_shipping_cart_notice', 5);
    function zoo_body_class_enable_free_shipping_notice($classes)
    {
        $classes[] = 'free-shipping-notice-enable';

        return $classes;
    }

    add_filter('body_class', 'zoo_body_class_enable_free_shipping_notice');
}

/**
 * Change Cross Sell product template location.
 * @return new location of cross sell products.
 * */
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
add_action('woocommerce_after_cart_table', 'woocommerce_cross_sell_display', 5);

if (class_exists('YITH_WC_Social_Login_Frontend')) {
    remove_action('woocommerce_after_template_part', array(
        YITH_WC_Social_Login_Frontend::get_instance(),
        'social_buttons_in_checkout'
    ));
}

if (!function_exists('zoo_woo_cart_trust_badges')) {
    function zoo_woo_cart_trust_badges()
    {
        $trust_badges = get_theme_mod('zoo_cart_trust_badges');
        if (isset($trust_badges['url'])) {
            echo sprintf('<img src="%s" class="trust-badges" alt="%s"/>', $trust_badges['url'], esc_attr__('Trust badges', 'fona'));
        } else {
            return;
        }
    }
}
add_action('woocommerce_cart_collaterals', 'zoo_woo_cart_trust_badges', 20);
add_action('woocommerce_review_order_after_submit', 'zoo_woo_cart_trust_badges', 10);
if (!function_exists('clever_woo_builder_shop_settings') || 'yes' != clever_woo_builder_shop_settings()->get('custom_checkout_page')) {
    function zoo_open_order_review()
    {
        echo wp_kses('<div class="zoo-wrap-order-review">', array('div' => array('class' => array())));
    }

    add_action('woocommerce_checkout_before_order_review_heading', 'zoo_open_order_review', -1);
    function zoo_close_order_review()
    {
        echo wp_kses('</div>', array('div' => array('class')));
    }

    add_action('woocommerce_checkout_after_order_review', 'zoo_close_order_review', 999);
}