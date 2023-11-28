<?php 
namespace Cafe\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
/**
 * CleverProductListTags
 *
 * @author CleverSoft <hello.cleversoft@gmail.com>
 * @package CAFE
 */
if (class_exists('WooCommerce')):
    final class CleverProductListWithTags extends CleverWidgetBase
    {
        /**
         * @return string
         */
        function get_name()
        {
            return 'clever-product-list-with-tags';
        }

        /**
         * @return string
         */
        function get_title()
        {
            return __('CAFE Product List with Tags', 'cafe-pro');
        }

        /**
         * @return string
         */
        function get_icon()
        {
            return 'cs-font clever-icon-cart-3';
        }
        /**
         * @return array
         */
        public function get_categories()
        {
            return ['clever-woocommerce-elements'];
        }
        /**
         * Register controls
         */
        protected function register_controls()
        {
            $this->start_controls_section( 'section_filter', [
                'label' => __( 'General', 'cafe-pro' )
            ] );
            $this->add_control('product_categories', [
                'label' => __('Categories', 'cafe-pro'),
                'description' => __('', 'cafe-pro'),
                'type' => Controls_Manager::SELECT2,
                'default' => '',
                'multiple' => true,
                'options' => $this->get_categories_for_cafe('product_cat', 2),
            ]);
            $this->add_control('product_ids', [
                'label' => __('Exclude product IDs', 'cafe-pro'),
                'description' => __('', 'cafe-pro'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $this->get_list_posts('product'),
            ]);

            $this->add_control('orderby', [
                'label' => __('Order by', 'cafe-pro'),
                'description' => __('', 'cafe-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'date',
                'options' => $this->get_woo_order_by_for_cafe(),
            ]);
            $this->add_control('order', [
                'label' => __('Order', 'cafe-pro'),
                'description' => __('', 'cafe-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'desc',
                'options' => $this->get_woo_order_for_cafe(),
            ]);
            $this->add_control('posts_per_page', [
                'label' => __('Products per pages', 'cafe-pro'),
                'description' => __('', 'cafe-pro'),
                'type' => Controls_Manager::NUMBER,
                'default' => 6,
            ]);
            $this->add_control('cart_btn_icon', [
                'label' => __('Cart Icon', 'cafe-pro'),
                'type' => 'clevericon',
                'default' => 'cs-font clever-icon-star',
            ]);
            $this->add_control('cart_btn_label', [
                'label' => __('Cart Icon', 'cafe-pro'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Add to Cart', 'cafe-pro'),
            ]);
            $this->end_controls_section();

            $this->start_controls_section(
                'general_settings', [
                'label' => __('General', 'cafe-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);
            $this->add_responsive_control( 'item_spacing', [
                'label'     => esc_html__('Spacing', 'cafe-pro' ),
                'description'     => esc_html__('Spacing between product items', 'cafe-pro' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .products .product' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ] );

            $this->end_controls_section();
            $this->start_controls_section(
                'normal_style_settings', [
                'label' => __('Title', 'cafe-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);

            $this->add_control('title_color', [
                'label' => __('Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-title a' => 'color: {{VALUE}};'
                ]
            ]);
            $this->add_control('title_color_hover', [
                'label' => __('Hover Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-title a:hover' => 'color: {{VALUE}};'
                ]
            ]);
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '.elementor-widget-clever-product-list-with-tags .product-title a',
                    'scheme' => Typography::TYPOGRAPHY_1,
                ]
            );


            $this->end_controls_section();

            $this->start_controls_section(
                'price_style_settings', [
                'label' => __('Price', 'cafe-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);

            $this->add_control('price_color', [
                'label' => __('Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price' => 'color: {{VALUE}};'
                ]
            ]);
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'price_typography',
                    'selector' => '{{WRAPPER}} .price',
                    'scheme' => Typography::TYPOGRAPHY_1,
                ]
            );


            $this->end_controls_section();

            $this->start_controls_section(
                'tag_style_settings', [
                'label' => __('Tags', 'cafe-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);

            $this->add_control('tag_color', [
                'label' => __('Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cafe-list-tag' => 'color: {{VALUE}};'
                ]
            ]);
            $this->add_control('tag_color_hover', [
                'label' => __('Hover Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cafe-list-tag a:hover' => 'color: {{VALUE}};'
                ]
            ]);
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'tag_typography',
                    'selector' => '{{WRAPPER}} .cafe-list-tag',
                    'scheme' => Typography::TYPOGRAPHY_1,
                ]
            );


            $this->end_controls_section();
            $this->start_controls_section(
                'cart_style_settings', [
                'label' => __('Cart button', 'cafe-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]);
            $this->start_controls_tabs( 'cart_style_tabs' );

            $this->start_controls_tab( 'cart_style_normal', [ 'label' => esc_html__('Normal', 'cafe-pro' ) ] );
            $this->add_control('cart_btn_color', [
                'label' => __('Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}' => '--btn-color: {{VALUE}};'
                ]
            ]);
            $this->add_control('cart_btn_bg', [
                'label' => __('Background', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}' => '--btn-bg: {{VALUE}};'
                ]
            ]);
            $this->end_controls_tab();
            $this->start_controls_tab( 'cart_style_hover', [ 'label' => esc_html__('Hover', 'cafe-pro' ) ] );
            $this->add_control('cart_btn_color_hover', [
                'label' => __('Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}' => '--btn-hover-color: {{VALUE}};'
                ]
            ]);
            $this->add_control('cart_btn_bg_hover', [
                'label' => __('Background', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}' => '--btn-hover-bg: {{VALUE}};'
                ]
            ]);
            $this->end_controls_tab();
            $this->end_controls_tabs();
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'cart_typography',
                    'selector' => '{{WRAPPER}} .cafe-btn-cart',
                    'scheme' => Typography::TYPOGRAPHY_1,
                ]
            );
            $this->end_controls_section();
        }

        /**
         * Load style
         */
        public function get_style_depends()
        {
            return ['cafe-style'];
        }

        /**
         * Render
         */
        protected function render()
        {
            // default settings
            $settings = array_merge([
                'product_categories' => '',
                'product_ids' => [],
                'orderby' => '',
                'order' => '',
                'cart_btn_label' => '',
                'cart_btn_icon' => '',
                'posts_per_page' => '',

            ], $this->get_settings_for_display());

            $this->getViewTemplate('template', 'product-list-with-tags', $settings);
        }
    }
    
endif;