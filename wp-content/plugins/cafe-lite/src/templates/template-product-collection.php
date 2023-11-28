<?php
/**
 * View template for Clever Product Collection.
 *
 * @package CAFE\Templates
 * @copyright 2018 CleverSoft. All rights reserved.
 */

$product_ids = $filter_arr = $cafe_json_config = '';
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
    'posts_per_page' => $settings['posts_per_page'],
    'paged' => $paged,
    'orderby' => $settings['orderby'],
    'order' => $settings['order'],
    'post__not_in' => $product_ids,
);
$categories = array();
$filter_tab = '';
$selected = '';
if (!empty($settings['collections'])) {
    if($settings['display_mod']!='all') {
        $selected = 'active';
    }
    $filter_tab .= '<ul class="cafe-ajax-load filter-cate cafe-horizontal-filter">';
    foreach ($settings['collections'] as $key=>$collection) {
        $product_cat = get_term_by('slug', $collection['collection'], 'product_cat');
        if($settings['display_mod']!='all' && $selected == 'active') {
            $categories[] = $collection['collection'];
        }
        if (isset($product_cat->slug) && $collection['show_title']) {
            $collection_title = $collection['custom_title'] != '' ? $collection['custom_title'] : $product_cat->name;
            $filter_tab .= '<li><a href="' . esc_url(get_term_link($product_cat->slug, 'product_cat')) . '"
                            class="' . esc_attr($selected) . '" 
                            data-type="product_cat" data-value="' . esc_attr($product_cat->slug) . '" 
                            title="' . esc_attr($collection_title) . '">' . esc_html($collection_title) . '</a></li>';
            $selected = '';
        }
    }
    $filter_tab .= '</ul>';
}
if(is_array($categories)){
    $wc_attr['product_cat'] = implode(',', $categories);
}else{
    $wc_attr['product_cat'] = $categories;
}

switch ($settings['asset_type']) {
    case 'featured':
        $meta_query[] = array(
            array(
                'taxonomy' => 'product_visibility',
                'field'    => 'name',
                'terms'    => 'featured',
                'operator' => 'IN'
            ),
        );
        $wc_attr['tax_query'] = $meta_query;
        break;
    case 'onsale':
        $product_ids_on_sale = wc_get_product_ids_on_sale();
        $wc_attr['post__in'] = $product_ids_on_sale;
        break;
    case 'best-selling':
        $wc_attr['meta_key'] = 'total_sales';
        $wc_attr['orderby']  = 'meta_value_num';
        break;
    case 'latest':
        $wc_attr['orderby'] = 'date';
        break;
    case 'toprate':
        $wc_attr['orderby'] = 'meta_value_num';
        $wc_attr['meta_key'] = '_wc_average_rating';
        $wc_attr['order'] = 'DESC';
        break;
    case 'deal':
        $product_ids_on_sale = wc_get_product_ids_on_sale();
        $wc_attr['post__in'] = $product_ids_on_sale;
        $wc_attr['meta_query'] = array(
            'relation' => 'AND',
            array(
                'key' => '_sale_price_dates_to',
                'value' => time(),
                'compare' => '>'
            )
        );
        break;
    default:
        break;
}
$settings['wc_attr'] = $wc_attr;

$cafe_wrap_class = "woocommerce cafe-products-wrap append-class";
$cafe_wrap_class .= " heading-".$settings['header_type'];
$cafe_json_config = '';
if ($settings['layout'] == 'grid') {
    $class = 'grid-layout';
    $grid_class = '  cafe-grid-lg-' . $settings['columns']['size'] . '-cols cafe-grid-md-' . $settings['columns_tablet']['size'] . '-cols cafe-grid-' . $settings['columns_mobile']['size'] . '-cols';
    $cafe_wrap_class .= $grid_class;

}
if ($settings['layout'] == 'carousel') {
    $class = 'grid-layout carousel';
    $class .= ' ' . $settings['nav_position'];
    $cafe_wrap_class .= ' cafe-carousel';
    $cols=$settings['slides_to_show']['size'];
    $cols_table=$settings['slides_to_show_tablet']['size']?$settings['slides_to_show_tablet']['size']:3;
    $cols_mobile=$settings['slides_to_show_mobile']['size']?$settings['slides_to_show_mobile']['size']:2;


    $cafe_wrap_class .= '  cafe-grid-lg-' . $cols . '-cols cafe-grid-md-' . $cols_table . '-cols cafe-grid-' . $cols_mobile . '-cols';

    $settings['autoplay'] = $settings['autoplay'] ? $settings['autoplay'] : 'false';
    $settings['autoplay_tablet'] = $settings['autoplay_tablet'] ? $settings['autoplay_tablet'] : 'false';
    $settings['autoplay_mobile'] = $settings['autoplay_mobile'] ? $settings['autoplay_mobile'] : 'false';

    $settings['show_pag'] = $settings['show_pag'] ? $settings['show_pag'] : 'false';
    $settings['show_pag_tablet'] = $settings['show_pag_tablet'] ? $settings['show_pag_tablet'] : 'false';
    $settings['show_pag_mobile'] = $settings['show_pag_mobile'] ? $settings['show_pag_mobile'] : 'false';

    $settings['show_nav'] = $settings['show_nav'] ? $settings['show_nav'] : 'false';
    $settings['show_nav_tablet'] = $settings['show_nav_tablet'] ? $settings['show_nav_tablet'] : 'false';
    $settings['show_nav_mobile'] = $settings['show_nav_mobile'] ? $settings['show_nav_mobile'] : 'false';
    $settings['speed'] = $settings['speed'] ? $settings['speed'] : 3000;

    $cafe_json_config = '{
        "slides_to_show" : ' . $cols . ',
        "slides_to_show_tablet" : ' . $cols_table . ',
        "slides_to_show_mobile" : ' . $cols_mobile . ',

        "speed": ' . $settings['speed'] . ',
        "scroll": ' . $settings['scroll'] . ',

        "autoplay": ' . $settings['autoplay'] . ',
        "autoplay_tablet": ' . $settings['autoplay_tablet'] . ',
        "autoplay_mobile": ' . $settings['autoplay_mobile'] . ',

        "show_pag": ' . $settings['show_pag'] . ',
        "show_pag_tablet": ' . $settings['show_pag_tablet'] . ',
        "show_pag_mobile": ' . $settings['show_pag_mobile'] . ',

        "show_nav": ' . $settings['show_nav'] . ',
        "show_nav_tablet": ' . $settings['show_nav_tablet'] . ',
        "show_nav_mobile": ' . $settings['show_nav_mobile'] . ',
        "wrap": "ul.products"
    }';
}
$filter_arr = array(
    'product_ids' => $settings['product_ids'],
    'orderby' => $settings['orderby'],
    'order' => $settings['order'],
    'posts_per_page' => $settings['posts_per_page'],
);

if (function_exists('zoo_product_hover_effect')) {
    $class .= ' hover-effect-' . zoo_product_hover_effect();
}

$product_query = new WP_Query($settings['wc_attr']);

?>
<div class="<?php echo esc_attr($cafe_wrap_class) ?> "
     data-args='<?php echo json_encode($filter_arr); ?>'
     data-url="<?php echo esc_url(admin_url('admin-ajax.php')); ?>"
     data-cafe-config='<?php echo esc_attr($cafe_json_config) ?>'>
    <?php if ($filter_tab != '') { ?>
        <div class="cafe-head-product-filter has-tabs">
            <?php
            if($settings['header_title']!='' || $settings['header_sec_title']!=''){
                ?>
                <div class="cafe-wrap-header-title">
                    <?php
                    printf('<h3 %s>%s</h3>', $this->get_render_attribute_string('header_title'), $settings['header_title']);
                    printf('<div %s>%s</div>', $this->get_render_attribute_string('header_sec_title'), $settings['header_sec_title']);
                    ?>
                </div>
            <?php
            }
            ?>
            <?php echo $filter_tab; ?>
        </div>
    <?php } ?>
    <ul class="products <?php echo esc_attr($class) ?>">
        <?php
        while ($product_query->have_posts()) : $product_query->the_post();
            wc_get_template_part('content', 'product');
        endwhile;
        ?>
    </ul>
    <?php if ($settings['pagination'] != 'none' && $settings['layout'] == 'grid') :
        $zoo_pag_type = $settings['pagination'];
        if ($zoo_pag_type == 'ajaxload' || $zoo_pag_type == 'infinity'): wp_enqueue_script('infinite-scroll'); ?>
            <div class="pagination-ajax">
        <?php endif;
        cafe_pagination(3, $product_query, '', '<i class="zoo-icon-long-arrow-left"></i> ' . esc_html__('', 'cafe-lite'), esc_html__('', 'cafe-lite') . ' <i class="zoo-icon-long-arrow-right"></i>');
        if ($zoo_pag_type == 'ajaxload' || $zoo_pag_type == 'infinity') : ?>

            <div class="scroller-status">
                <div class="infinite-scroll-request">
                    <div class="pagination-loading"><span
                                class="loading"><?php echo esc_html__('LOADING...', 'cafe-lite') ?></span></div>
                </div>
                <p class="infinite-scroll-last"><?php echo esc_html__('All items loaded', 'cafe-lite'); ?></p>
                <p class="infinite-scroll-error"><?php echo esc_html__('No more page', 'cafe-lite'); ?></p>
            </div>
            <?php if ($zoo_pag_type == 'ajaxload') { ?>
                <p class="view-more-button"><span><?php echo esc_html__('Load More', 'cafe-lite') ?></span></p>
            <?php } ?>
            </div>
        <?php endif;
    endif;
    wp_reset_postdata();
    ?>
</div>