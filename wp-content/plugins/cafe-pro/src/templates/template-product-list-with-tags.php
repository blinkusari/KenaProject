<?php
/**
 * View template for Clever Product List As Menu.
 *
 * @package CAFE\Templates
 * @copyright 2020 CleverSoft. All rights reserved.
 */
$product_ids = [];
if ($settings['product_ids'] && is_array($settings['product_ids'])) {
    $product_ids = $settings['product_ids'];
}

if (is_front_page()) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
} else {
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
}
$meta_query = WC()->query->get_meta_query();
$wc_attr = array(
    'post_type' => 'product',
    'product_cat' => $settings['product_categories'] != '' ? implode(',', $settings['product_categories']) : '',
    'posts_per_page' => $settings['posts_per_page'],
    'paged' => $paged,
    'orderby' => $settings['orderby'],
    'order' => $settings['order'],
    'post__not_in' => $product_ids,
);

$settings['wc_attr'] = $wc_attr;
$cart_btn_icon='';
if($settings['cart_btn_icon']!=''){
    $cart_btn_icon=$settings['cart_btn_icon'];
}
$product_query = new WP_Query($settings['wc_attr']);
?>
    <ul class="products">
        <?php
        while ($product_query->have_posts()) : $product_query->the_post();
            global $product;
            ?>
            <li <?php post_class("cafe-product-list-item") ?>>
                <div class="product-item-row top-product-item">
                    <?php
                    the_title(sprintf('<h3 class="product-title"><a href="%s" rel="' . esc_attr__('bookmark', 'anon') . '" title="">', esc_url(get_permalink())), '</a></h3>');
                    woocommerce_template_loop_price();
                    ?>
                </div>
                <div class="product-item-row bottom-product-item">
                <?php
                echo wc_get_product_tag_list(get_the_ID(), '<span>/</span>', '<div class="cafe-list-tag">', '</div>');

                if ( $product->is_purchasable() && $product->is_in_stock() ) {
                    $defaults = array(
                        'quantity'   => 1,
                        'class'      => implode(
                            ' ',
                            array_filter(
                                array(
                                    'cafe-btn-cart',
                                    'product_type_' . $product->get_type(),
                                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                    $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                                )
                            )
                        ),
                        'attributes' => array(
                            'data-product_id'  => $product->get_id(),
                            'data-product_sku' => $product->get_sku(),
                            'aria-label'       => $product->add_to_cart_description(),
                            'rel'              => 'nofollow',
                        ),
                    );
                    $args=[];
                    $args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

                    if ( isset( $args['attributes']['aria-label'] ) ) {
                        $args['attributes']['aria-label'] = wp_strip_all_tags( $args['attributes']['aria-label'] );
                    }

                    $btn_label=$product->add_to_cart_text();
                    if($settings['cart_btn_label']!=''){
                        $btn_label=$settings['cart_btn_label'];
                    }

                    echo sprintf('<a href="%s" data-quantity="%s" class="%s" title="%s" %s>%s%s</a>',
                        esc_url($product->add_to_cart_url()),
                        esc_attr(isset($args['quantity']) ? $args['quantity'] : 1),
                        esc_attr(isset($args['class']) ? $args['class'] : 'button'),
                        esc_attr($btn_label),
                        isset($args['attributes']) ? wc_implode_html_attributes($args['attributes']) : '',
                        '<span>'.esc_html($btn_label).'</span>',
                        '<i class="'.esc_attr($cart_btn_icon).'"></i>'
                    );
                }
                ?>
                </div>
            </li>
        <?php
        endwhile;
        ?>
    </ul>
<?php
wp_reset_postdata();
?>