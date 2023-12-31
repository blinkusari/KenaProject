<?php
/**
 * Typography for theme
 * @core: 3.0
 * @version : 1.0.0
 * @package : zootemplate
 */
return[
    [
        'name' => 'zoo_typography',
        'type' => 'section',
        'label' => esc_html__('Typography', 'fona'),
        'panel' => 'zoo_style',
    ],[
        'name' => 'zoo_typo_base_heading',
        'type' => 'heading',
        'label' => esc_html__('Base', 'fona'),
        'section' => 'zoo_typography',
    ],
    [
        'name'        => 'zoo_typo_base',
        'type'        => 'typography',
        'section'     => 'zoo_typography',
        'title'       => esc_html__('Base Typography', 'fona'),
        'description' => esc_html__('Typography for site', 'fona'),
        'selector'    => "body",
        'css_format'  => 'typography',
        'field_class'=>'no-hide',
        'fields' => array(
            'style' => false,
            'text_decoration' => false,
            'text_transform' => false,
        ),
    ],[
        'name' => 'zoo_typo_heading_heading',
        'type' => 'heading',
        'label' => esc_html__('Heading & Title', 'fona'),
        'section' => 'zoo_typography',
    ],
    [
        'name'        => 'zoo_typo_heading',
        'type'        => 'typography',
        'section'     => 'zoo_typography',
        'title'       => esc_html__('Heading & Title Typography', 'fona'),
        'description' => esc_html__('Typography for heading', 'fona'),
        'selector'    => "h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6",
        'css_format'  => 'typography',
        'field_class'=>'no-hide',
        'fields' => array(
            'style' => false,
            'text_decoration' => false,
            'text_transform' => false,
            'font_size' => false,
        ),
    ],

    [
        'name' => 'zoo_typo_h1_size',
        'type' => 'slider',
        'section' => 'zoo_typography',
        'min' => 0,
        'step' => 1,
        'max' => 100,
        'selector'  => 'h1,.h1',
        'css_format' => 'font-size: {{value}};',
        'label' => esc_html__('H1 Font Size', 'fona'),
    ],[
        'name' => 'zoo_typo_h2_size',
        'type' => 'slider',
        'section' => 'zoo_typography',
        'min' => 0,
        'step' => 1,
        'max' => 100,
        'selector'  => 'h2,.h2',
        'css_format' => 'font-size: {{value}};',
        'label' => esc_html__('H2 Font Size', 'fona'),
    ],[
        'name' => 'zoo_typo_h3_size',
        'type' => 'slider',
        'section' => 'zoo_typography',
        'min' => 0,
        'step' => 1,
        'max' => 100,
        'selector'  => 'h3,.h3',
        'css_format' => 'font-size: {{value}};',
        'label' => esc_html__('H3 Font Size', 'fona'),
    ],[
        'name' => 'zoo_typo_h4_size',
        'type' => 'slider',
        'section' => 'zoo_typography',
        'min' => 0,
        'step' => 1,
        'max' => 100,
        'selector'  => 'h4,.h4',
        'css_format' => 'font-size: {{value}};',
        'label' => esc_html__('H4 Font Size', 'fona'),
    ],[
        'name' => 'zoo_typo_h5_size',
        'type' => 'slider',
        'section' => 'zoo_typography',
        'min' => 0,
        'step' => 1,
        'max' => 100,
        'selector'  => 'h5,.h5',
        'css_format' => 'font-size: {{value}};',
        'label' => esc_html__('H5 Font Size', 'fona'),
    ],[
        'name' => 'zoo_typo_h6_size',
        'type' => 'slider',
        'section' => 'zoo_typography',
        'min' => 0,
        'step' => 1,
        'max' => 100,
        'selector'  => 'h6,.h6',
        'css_format' => 'font-size: {{value}};',
        'label' => esc_html__('H6 Font Size', 'fona'),
    ],[
        'name' => 'zoo_typo_title_loop_blog_size',
        'type' => 'slider',
        'section' => 'zoo_typography',
        'min' => 0,
        'step' => 1,
        'max' => 100,
        'selector'  => '.post-loop-item .entry-title',
        'css_format' => 'font-size: {{value}};',
        'label' => esc_html__('Post Loop Title Font Size', 'fona'),
        'description' => esc_html__('Font size title of post in loop', 'fona'),
    ],[
        'name' => 'zoo_typo_title_single_size',
        'type' => 'slider',
        'section' => 'zoo_typography',
        'min' => 0,
        'step' => 1,
        'max' => 100,
        'selector'  => '.title-detail',
        'css_format' => 'font-size: {{value}};',
        'label' => esc_html__('Post Title Font Size', 'fona'),
        'description' => esc_html__('Font size title of single post', 'fona'),
    ],[
        'name' => 'zoo_typo_widget_title_size',
        'type' => 'slider',
        'section' => 'zoo_typography',
        'min' => 0,
        'step' => 1,
        'max' => 100,
        'selector'  => '.widget .widget-title',
        'css_format' => 'font-size: {{value}};',
        'label' => esc_html__('Widget Title Font Size', 'fona'),
        'description' => esc_html__('Font size title of widget', 'fona'),
    ],
    [
        'name' => 'zoo_typo_woo_heading',
        'type' => 'heading',
        'label' => esc_html__('WooCommerce Typography', 'fona'),
        'section' => 'zoo_typography',
    ],
    [
        'name'        => 'zoo_typo_woo',
        'type'        => 'typography',
        'section'     => 'zoo_typography',
        'title'       => esc_html__('WooCommerce Title Typography', 'fona'),
        'description' => esc_html__('Typography for title product', 'fona'),
        'selector'    => ".product-loop-title,  .product_title",
        'css_format'  => 'typography',
        'field_class'=>'no-hide',
        'fields' => array(
            'style' => false,
            'text_decoration' => false,
            'text_transform' => false,
            'font_size' => false,
        ),
    ],
    [
        'name' => 'zoo_typo_product_loop_size',
        'type' => 'slider',
        'section' => 'zoo_typography',
        'min' => 0,
        'step' => 1,
        'max' => 100,
        'selector' => ".woocommerce ul.products li.product h3.product-loop-title, .woocommerce ul.products li.product .woocommerce-loop-category__title",
        'css_format' => 'font-size: {{value}};',
        'theme_supports' => 'woocommerce',
        'label' => esc_html__('Product Font Size', 'fona'),
        'description' => esc_html__('Font size title of product in loop', 'fona'),
    ],[
        'name' => 'zoo_typo_product_single_size',
        'type' => 'slider',
        'section' => 'zoo_typography',
        'min' => 0,
        'step' => 1,
        'max' => 100,
        'css_format' => 'font-size: {{value}};',
        'selector' => ".woocommerce div.product .product_title",
        'theme_supports' => 'woocommerce',
        'label' => esc_html__('Single Product Font Size', 'fona'),
        'description' => esc_html__('Font size title of Single Product', 'fona'),
    ],
];
