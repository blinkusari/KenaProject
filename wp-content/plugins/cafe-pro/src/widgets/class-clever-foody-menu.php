<?php 
namespace Cafe\Widgets;

use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
/**
 * CleverFoodyMenu
 *
 * @author CleverSoft <hello.cleversoft@gmail.com>
 * @package CAFE
 */

final class CleverFoodyMenu extends CleverWidgetBase
{
    /**
     * @return string
     */
    function get_name()
    {
        return 'clever-foofy-menu';
    }

    /**
     * @return string
     */
    function get_title()
    {
        return __('CAFE Foody Menu', 'cafe-pro');
    }

    /**
     * @return string
     */
    function get_icon()
    {
        return 'cs-font clever-icon-list-2';
    }
    
    /**
     * Register controls
     */
    protected function register_controls()
    {
        
        $repeater = new \Elementor\Repeater();

        $this->start_controls_section(
            'section_title', [
            'label' => __('Foody Menu', 'cafe-pro')
            ]);
            $repeater->add_control('image', [
                'label' => __('Image', 'cafe-pro'),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'show_external' => true,
                'default' => [
                    'url' => CAFE_URI . '/assets/img/banner-placeholder.png'
                ]
            ]);
            $repeater->add_control('title', [
                'label' => __('Title', 'cafe-pro'),
                'type' => Controls_Manager::TEXT,
            ]);
            $repeater->add_control( 'description', [
                'label'       => __( 'Description', 'cafe-pro' ),
                'type'        => Controls_Manager::TEXT,
            ] );
            $repeater->add_control( 'price', [
                'label'       => __( 'Price', 'cafe-pro' ),
                'type'        => Controls_Manager::TEXT,
            ] );
            $repeater->add_control( 'link', [
                'label'       => __( 'Order link', 'cafe-pro' ),
                'type'        => Controls_Manager::URL,
            ] );
            $repeater->add_control( 'text', [
                'label'       => __( 'Order text', 'cafe-pro' ),
                'type'        => Controls_Manager::TEXT,
            ] );
            $repeater->add_control('star', [
                'label' => __('Star', 'cafe-pro'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'true',
                'default' => 'false',
            ]);
            $this->add_control('repeater',[
                'label' => __( 'Add menu item', 'cafe-pro' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]);
        $this->end_controls_section();
        $this->start_controls_section('style_settings', [
            'label' => esc_html__('Style', 'cafe-pro'),
            'tab' => Controls_Manager::TAB_STYLE,
            ]);
            $this->add_control('title_color', [
                'label' => esc_html__('Title Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cafe-foody-menu .foody-menu-item .cafe-wrap-content .wrap-title h3' => 'color: {{VALUE}};'
                ]
            ]);
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'selector' => '{{WRAPPER}} .cafe-foody-menu .foody-menu-item .cafe-wrap-content .wrap-title h3',
                    'scheme' => Typography::TYPOGRAPHY_1,
                ]
            );
            $this->add_control('des_color', [
                'label' => esc_html__('Description Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cafe-foody-menu .foody-menu-item .cafe-wrap-content .wrap-title p' => 'color: {{VALUE}};'
                ],
                'separator'   => 'before',
            ]);
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'des_typography',
                    'selector' => '{{WRAPPER}} .cafe-foody-menu .foody-menu-item .cafe-wrap-content .wrap-title p',
                    'scheme' => Typography::TYPOGRAPHY_1,
                ]
            );
            $this->add_control('price_color', [
                'label' => esc_html__('Price Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cafe-foody-menu .foody-menu-item .cafe-wrap-content .wrap-price .price' => 'color: {{VALUE}};'
                ],
                'separator'   => 'before',
            ]);
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'price_typography',
                    'selector' => '{{WRAPPER}} .cafe-foody-menu .foody-menu-item .cafe-wrap-content .wrap-price .price',
                    'scheme' => Typography::TYPOGRAPHY_1,
                ]
            );
            $this->add_control('order_color', [
                'label' => esc_html__('Order Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cafe-foody-menu .foody-menu-item .cafe-wrap-content .wrap-price .order a' => 'color: {{VALUE}};'
                ],
                'separator'   => 'before',
            ]);
            $this->add_control('order_bg', [
                'label' => esc_html__('Order Background Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cafe-foody-menu .foody-menu-item .cafe-wrap-content .wrap-price .order a' => 'background: {{VALUE}};'
                ]
            ]);
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'order_typography',
                    'selector' => '{{WRAPPER}} .cafe-foody-menu .foody-menu-item .cafe-wrap-content .wrap-price .order a',
                    'scheme' => Typography::TYPOGRAPHY_1,
                ]
            );
            $this->add_responsive_control('order_padding',[
                'label'         => esc_html__('Menu Padding', 'cafe-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'separator'   => 'before',
                'selectors'     => [
                    '{{WRAPPER}} .cafe-foody-menu .foody-menu-item .cafe-wrap-content .wrap-price .order a'  => 'padding:  {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);
            $this->add_control('star_color', [
                'label' => esc_html__('Star Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cafe-foody-menu .foody-menu-item .cafe-wrap-content .wrap-price .order .star' => 'color: {{VALUE}};'
                ],
                'separator'   => 'before',
            ]);
            $this->add_control('star_bg', [
                'label' => esc_html__('Star Background Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cafe-foody-menu .foody-menu-item .cafe-wrap-content .wrap-price .order .star' => 'background: {{VALUE}};'
                ]
            ]);
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'star_typography',
                    'selector' => '{{WRAPPER}} .cafe-foody-menu .foody-menu-item .cafe-wrap-content .wrap-price .order .star i',
                    'scheme' => Typography::TYPOGRAPHY_1,
                ]
            );
            $this->add_responsive_control('star_padding',[
                'label'         => esc_html__('Menu Padding', 'cafe-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'separator'   => 'before',
                'selectors'     => [
                    '{{WRAPPER}} .cafe-foody-menu .foody-menu-item .cafe-wrap-content .wrap-price .order .star'  => 'padding:  {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]);
            $this->add_responsive_control('menu_padding',[
                'label'         => esc_html__('Menu Padding', 'cafe-pro'),
                'type'          => Controls_Manager::DIMENSIONS,
                'size_units'    => ['px', 'em', '%'],
                'separator'   => 'before',
                'selectors'     => [
                    '{{WRAPPER}} .cafe-foody-menu .foody-menu-item'  => 'padding:  {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'   => 'before',
            ]);
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
     * Retrieve the list of scripts the image carousel widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_script_depends()
    {
        return ['slick', 'cafe-script'];
    }
    /**
     * Render
     */
    protected function render()
    {
        // default settings
        $settings = array_merge([ 
            'menu_image'                 => '',
            'menu_title'                 => '',
            'menu_description'                 => '',
            'menu_price'                 => '',
            'menu_order_link'                 => '',
            'menu_star'                 => '',
            
        ], $this->get_settings_for_display());
        $this->getViewTemplate('template', 'foody-menu', $settings);
    }
}
    
