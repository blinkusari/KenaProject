<?php 
namespace Cafe\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
/**
 * CleverProductDeal
 *
 * @author CleverSoft <hello.cleversoft@gmail.com>
 * @package CAFE
 */
if (class_exists('WooCommerce')):
    final class CleverProductDeal extends CleverWidgetBase
    {
        /**
         * @return string
         */
        function get_name()
        {
            return 'clever-product-deal';
        }

        /**
         * @return string
         */
        function get_title()
        {
            return __('CAFE Product Deal', 'cafe-pro');
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
            $this->start_controls_section(
                'section_title', [
                    'label' => __('Title', 'cafe-pro')
                ]);

                $this->add_control('title', [
                    'label'		    => __('Title', 'cafe-pro'),
                    'type'		    => Controls_Manager::TEXT,
                    'default'       => __( 'CAFE Woo', 'cafe-pro' ),
                ]);
                $this->add_control('action_title', [
                    'label'         => __('Action title', 'cafe-pro'),
                    'type'          => Controls_Manager::TEXT,
                    'default'       => __( 'Action title', 'cafe-pro' ),
                ]);
                $this->add_control('action_link', [
                    'label'         => __('Action link', 'cafe-pro'),
                    'description'   => __('', 'cafe-pro'),
                    'type'          => Controls_Manager::URL,
                ]);

            $this->end_controls_section();

            $this->start_controls_section(
                'section_filter', [
                    'label' => __('Filter', 'cafe-pro')
                ]);
                $this->add_control('layout_style', [
                    'label'         => __('Layout style', 'cafe-pro'),
                    'description'   => __('', 'cafe-pro'),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'default',
                    'options' => [
                        'default'  => __( 'Default', 'cafe-pro' ),
                        'layout-1' => __( 'Layout 1', 'cafe-pro' ),
                        'layout-2' => __( 'Layout 2', 'cafe-pro' ),
                    ],
                ]);
                $this->add_control('date_time', [
                    'label'         => __('Date for sale', 'cafe-pro'),
                    'description'   => __('', 'cafe-pro'),
                    'type'          => Controls_Manager::DATE_TIME,
                    'condition'     => [
                        'layout_style' => 'layout-1',
                    ],
                ]);
                $this->add_control('date_time_2', [
                    'label'         => __('Date for sale', 'cafe-pro'),
                    'description'   => __('', 'cafe-pro'),
                    'type'          => Controls_Manager::DATE_TIME,
                    'condition'     => [
                        'layout_style' => 'layout-2',
                    ],
                ]);
                $this->add_control('filter_categories', [
                    'label'         => __('Categories', 'cafe-pro'),
                    'description'   => __('', 'cafe-pro'),
                    'type'          => Controls_Manager::SELECT2,
                    'default'       => '',
                    'multiple'      => true,
                    'options'       => $this->get_categories_for_cafe('product_cat', 2 ),
                ]);
                $this->add_control('product_ids', [
                    'label'         => __('Exclude product IDs', 'cafe-pro'),
                    'description'   => __('', 'cafe-pro'),
                    'type'          => Controls_Manager::SELECT2,
                    'multiple'      => true,
                    'options'       => $this->get_list_posts('product'),
                ]);
                
                $this->add_control('orderby', [
                    'label'         => __('Order by', 'cafe-pro'),
                    'description'   => __('', 'cafe-pro'),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'date',
                    'options'       => $this->get_woo_order_by_for_cafe(),
                ]);
                $this->add_control('order', [
                    'label'         => __('Order', 'cafe-pro'),
                    'description'   => __('', 'cafe-pro'),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'desc',
                    'options'       => $this->get_woo_order_for_cafe(),
                ]);
                $this->add_control('posts_per_page', [
                    'label'         => __('Products per pages', 'cafe-pro'),
                    'description'   => __('', 'cafe-pro'),
                    'type'          => Controls_Manager::NUMBER,
                    'default'       => 6,
                ]);
                
            $this->end_controls_section();

            $this->start_controls_section(
                'section_carousel', [
                    'label' => __('Options', 'cafe-pro')
                ]);
                $this->add_control('slides_to_show',[
                    'label'         => __( 'Slides to Show', 'cafe-pro' ),
                    'type'          => Controls_Manager::SLIDER,
                    'range' => [
                        'px' =>[
                            'min' => 1,
                            'max' => 10,
                        ]
                    ],
                    'default' => [
                        'size' => 4,
                        'unit' => 'px',
                    ],
                ]);
                $this->add_control('slides_to_show_tablet',[
                    'label'         => __( 'Slides to Show (Tablet)', 'cafe-pro' ),
                    'type'          => Controls_Manager::SLIDER,
                    'range' => [
                        'px' =>[
                            'min' => 1,
                            'max' => 10,
                        ]
                    ],
                    'default' => [
                        'size' => 3,
                        'unit' => 'px',
                    ],
                ]);$this->add_control('slides_to_show_mobile',[
                    'label'         => __( 'Slides to Show (Mobile)', 'cafe-pro' ),
                    'type'          => Controls_Manager::SLIDER,
                    'range' => [
                        'px' =>[
                            'min' => 1,
                            'max' => 10,
                        ]
                    ],
                    'default' => [
                        'size' => 2,
                        'unit' => 'px',
                    ],
                ]);

                $this->add_control('speed', [
                    'label'         => __('Carousel: Speed to Scroll', 'cafe-pro'),
                    'description'   => __('', 'cafe-pro'),
                    'type'          => Controls_Manager::NUMBER,
                    'default'       => 5000,
                ]);
                $this->add_control('scroll', [
                    'label'         => __('Carousel: Slide to Scroll', 'cafe-pro'),
                    'description'   => __('', 'cafe-pro'),
                    'type'          => Controls_Manager::NUMBER,
                    'default'       => 1,
                ]);
                $this->add_responsive_control('autoplay', [
                    'label'         => __('Carousel: Auto Play', 'cafe-pro'),
                    'description'   => __('', 'cafe-pro'),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'cafe-pro' ),
                    'label_off' => __( 'Hide', 'cafe-pro' ),
                    'return_value' => 'true',
                    'default' => 'true',
                ]);
                $this->add_responsive_control('show_pag', [
                    'label'         => __('Carousel: Pagination', 'cafe-pro'),
                    'description'   => __('', 'cafe-pro'),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'cafe-pro' ),
                    'label_off' => __( 'Hide', 'cafe-pro' ),
                    'return_value' => 'true',
                    'default' => 'true',
                ]);
                $this->add_responsive_control('show_nav', [
                    'label'         => __('Carousel: Navigation', 'cafe-pro'),
                    'description'   => __('', 'cafe-pro'),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'cafe-pro' ),
                    'label_off' => __( 'Hide', 'cafe-pro' ),
                    'return_value' => 'true',
                    'default' => 'true',
                ]);
                $this->add_control('nav_position', [
                    'label'         => __('Carousel: Navigation position', 'cafe-pro'),
                    'description'   => __('', 'cafe-pro'),
                    'type'          => Controls_Manager::SELECT,
                    'default'       => 'middle-nav',
                    'options' => [
                        'top-nav'  => __( 'Top', 'cafe-pro' ),
                        'middle-nav' => __( 'Middle', 'cafe-pro' ),
                    ],
                    'condition'     => [
                        'show_nav' => 'true',
                    ],
                ]);

                


            $this->end_controls_section();

            $this->start_controls_section(
                'normal_style_settings', [
                    'label' => __('Layout', 'cafe-pro'),
                    'tab' => Controls_Manager::TAB_STYLE,
                ]);
                
                $this->add_control('title_color', [
                    'label' => __('Title Color', 'cafe-pro'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cafe-title' => 'color: {{VALUE}};'
                    ]
                ]);
                $this->add_group_control(
                    Group_Control_Typography::get_type(),
                    [
                        'name' => 'title_typography',
                        'selector' => '{{WRAPPER}} .cafe-title',
                        'scheme' => Typography::TYPOGRAPHY_1,
                    ]
                );
                $this->add_control('title_background', [
                    'label' => __('Title Background', 'cafe-pro'),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .cafe-title' => 'background: {{VALUE}};'
                    ]
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
            return ['slick','countdown','cafe-script'];
        }
        /**
         * Render
         */
        protected function render()
        {
            // default settings
            $settings = array_merge([ 
                'title'                 => '',
                'action_title'          => '',
                'action_link'           => '',

                'layout_style'          => 'default',
                'date_time'             => '',
                'date_time_2'             => '',
                'filter_categories'     => '',
                'product_ids'           => '',
                'orderby'               => 'date',
                'order'                 => 'desc',
                'posts_per_page'        => 6,

                'slides_to_show'        => 4,
                'speed'                 => 5000,
                'scroll'                => 1,
                'autoplay'              => 'true',
                'show_pag'              => 'true',
                'show_nav'              => 'true',
                'nav_position'          => 'middle-nav',
                
            ], $this->get_settings_for_display());

            $this->add_inline_editing_attributes('title');

            $this->add_render_attribute('title', 'class', 'cafe-title');

            $this->getViewTemplate('template', 'product-deal', $settings);
        }
    }
endif;