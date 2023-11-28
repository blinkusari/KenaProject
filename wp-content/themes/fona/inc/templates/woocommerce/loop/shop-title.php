<?php
/**
 * Template display cover image of Archive WooCommerce Page template.
 * @since: zoo-theme 3.0.0
 * @Ver: 3.0.0
 */
if (is_product()) {
    return;
}

$enable_shop_heading = get_theme_mod('zoo_enable_shop_heading', 1);

$allowhtml = array(
    'span' => array('class' => array()),
    'ul' => array('class' => array()),
    'li' => array('class' => array()),
    'a' => array('class' => array(), 'href' => array(), 'title' => array()),
);
$count_text = '';
if (get_theme_mod('zoo_enable_shop_heading_product_count', 1) == 1) {
    $count_text = '<span class="total-product"> (' . wc_get_loop_prop('total');
    if ($count_text > 1) {
        $count_text .= esc_html__(' Items', 'fona');
    } else {
        $count_text .= esc_html__(' Item', 'fona');
    }
    $count_text .= ')</span>';
}
$thumb_img = get_theme_mod('zoo_shop_banner', '');
if (isset($thumb_img['url'])) {
    $thumb_img = $thumb_img['url'];
}
$categories = '';
if (get_theme_mod('zoo_enable_shop_heading_categories', 1) == 1) {
    if (is_shop()) {
        $current_cat_id = 0;
    } else {
        $current_cat_id = get_queried_object_id();
    }
    $cat_args = array(
        'orderby' => 'name',
        'order' => 'asc',
        'hide_empty' => true,
        'parent' => $current_cat_id
    );
    $product_categories = get_terms('product_cat', $cat_args);
    if (!empty($product_categories)) {
        $categories = '<ul class="list-product-categories">';
        foreach ($product_categories as $key => $category) {
            $categories .= '<li class="category">';
            $categories .= '<a href="' . get_term_link($category) . '" title="' . $category->name . '">';
            $categories .= $category->name;
            $categories .= '</a>';
            $categories .= '</li>';
        }
        $categories .= '</ul>';
    }
}

if (is_shop()) {
    if ($enable_shop_heading && get_post_meta(get_the_id(), 'zoo_disable_title', true) != 1) {
        if( (get_theme_mod('zoo_shop_banner_full_width', 1) != 1) ){
            ?>
            <div class="container">
            <?php
        }
        ?>
        <div class="wrap-shop-title<?php if ($thumb_img != '') echo esc_attr(' has-img-cover') ?>">
            <?php if (get_theme_mod('zoo_enable_shop_title', 1) == 1) { ?>
                <h2 class="shop-title"><?php echo woocommerce_page_title();
                    echo wp_kses($count_text, $allowhtml); ?></h2>
                <?php
                if ($categories != '') {
                    echo wp_kses($categories, $allowhtml);
                }
            }
            get_template_part('inc/templates/woocommerce/loop/shop', 'description');
            ?>
        </div>
        <?php
    if( (get_theme_mod('zoo_shop_banner_full_width', 1) != 1) ){
        ?>
        </div>
        <?php
    }
    }
} else {
    if ($enable_shop_heading) {
        if( (get_theme_mod('zoo_shop_banner_full_width', 1) != 1) ){
            ?>
            <div class="container">
            <?php
        }
        ?>
        <div class="wrap-shop-title<?php if ($thumb_img != '') echo esc_attr(' has-img-cover') ?>">
            <?php if (get_theme_mod('zoo_enable_shop_title', 1) == 1) { ?>
                <h2 class="shop-title"><?php echo woocommerce_page_title();
                    echo wp_kses($count_text, $allowhtml); ?></h2>
                <?php
                if ($categories != '') {
                    echo wp_kses($categories, $allowhtml);
                }
            }
            get_template_part('inc/templates/woocommerce/loop/shop', 'description');
            ?>
        </div>
        <?php
        if( (get_theme_mod('zoo_shop_banner_full_width', 1) != 1) ){
            ?>
            </div>
            <?php
        }
    }
}
