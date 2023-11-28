<?php

namespace Cafe\Widgets;

use Elementor\Controls_Manager;

/**
 * CleverInstagram
 *
 * @author CleverSoft <hello.cleversoft@gmail.com>
 * @package CAFE
 */
final class CleverInstagram extends CleverWidgetBase
{
    /**
     * @return string
     */
    function get_name()
    {
        return 'clever-instagram';
    }

    /**
     * @return string
     */
    function get_title()
    {
        return esc_html__('CAFE Instagram', 'cafe-lite');
    }

    /**
     * @return string
     */
    function get_icon()
    {
        return 'cs-font clever-icon-landscape-image';
    }

    /**
     * Register controls
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_setting', [
            'label' => esc_html__('Settings', 'cafe-lite')
        ]);

        $this->add_control('title', [
            'label' => esc_html__('Title', 'cafe-lite'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('CAFE Instagram', 'cafe-lite'),
        ]);
        $this->add_control('token', [
            'label' => esc_html__('Add Your Token', 'cafe-lite'),
            'description' => '<a href="https://doc.cleveraddon.com/clever-addon-for-elementor/#/instagram" target="_blank">Click here to known how to get Instagram Token</a>',
            'type' => Controls_Manager::TEXTAREA,
        ]);
        $this->add_control('number', [
            'label' => esc_html__('Photos count', 'cafe-lite'),
            'type' => Controls_Manager::NUMBER,
        ]);
        
        $this->add_control('show_likes', [
            'label' => esc_html__('Show likes', 'cafe-lite'),
            'description' => esc_html__('', 'cafe-lite'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'cafe-lite'),
            'label_off' => esc_html__('Hide', 'cafe-lite'),
            'return_value' => 'true',
            'default' => 'true',
        ]);
        $this->add_control('show_comments', [
            'label' => esc_html__('Show comments', 'cafe-lite'),
            'description' => esc_html__('', 'cafe-lite'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'cafe-lite'),
            'label_off' => esc_html__('Hide', 'cafe-lite'),
            'return_value' => 'true',
            'default' => 'true',
        ]);
        $this->add_control('show_type', [
            'label' => esc_html__('Show icons type( image/video )', 'cafe-lite'),
            'description' => esc_html__('', 'cafe-lite'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'cafe-lite'),
            'label_off' => esc_html__('Hide', 'cafe-lite'),
            'return_value' => 'true',
            'default' => 'true',
        ]);
        $this->add_control('show_time', [
            'label' => esc_html__('Show time', 'cafe-lite'),
            'description' => esc_html__('', 'cafe-lite'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'cafe-lite'),
            'label_off' => esc_html__('Hide', 'cafe-lite'),
            'return_value' => 'true',
            'default' => 'true',
        ]);

        $this->add_control('layout', [
            'label' => esc_html__('Layout', 'cafe-lite'),
            'description' => esc_html__('', 'cafe-lite'),
            'type' => Controls_Manager::SELECT,
            'default' => 'grid',
            'options' => [
                'grid' => esc_html__('Grid', 'cafe-lite'),
                'carousel' => esc_html__('Carousel', 'cafe-lite'),
            ],
        ]);

        //Grid
        $this->add_control('columns', [
            'label' => esc_html__('Columns for row', 'cafe-lite'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'col' => [
                    'min' => 1,
                    'max' => 6,
                ]
            ],
            'default' => [
                'size' => 4,
                'unit' => 'col',
            ],
            'condition' => [
                'layout' => 'grid',
            ],
        ]);
        $this->add_control('columns_tablet', [
            'label' => esc_html__('Columns for row (Tablet)', 'cafe-lite'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'col' => [
                    'min' => 1,
                    'max' => 6,
                ]
            ],
            'default' => [
                'size' => 3,
                'unit' => 'col',
            ],
            'condition' => [
                'layout' => 'grid',
            ],
        ]);
        $this->add_control('columns_mobile', [
            'label' => esc_html__('Columns for row (Mobile)', 'cafe-lite'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'col' => [
                    'min' => 1,
                    'max' => 6,
                ]
            ],
            'default' => [
                'size' => 2,
                'unit' => 'col',
            ],
            'condition' => [
                'layout' => 'grid',
            ],
        ]);
        $this->add_responsive_control('space', [
            'label' => esc_html__('Space', 'cafe-lite'),
            'description' => esc_html__('Space between each item', 'cafe-lite'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ]
            ],
            'default' => [
                'size' => 30,
            ],
            'devices' => ['desktop', 'tablet', 'mobile'],
            'selectors' => [
                '{{WRAPPER}} .instagram-item' => 'padding: calc({{SIZE}}{{UNIT}}/2)',
                '{{WRAPPER}} .wrap-instagram' => 'margin-left: calc(-{{SIZE}}{{UNIT}}/2);margin-right: calc(-{{SIZE}}{{UNIT}}/2);'
            ]
        ]);
        //Slide
        $this->add_control('slides_to_show', [
            'label' => esc_html__('Slides to Show', 'cafe-lite'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 10,
                ]
            ],
            'default' => [
                'size' => 4,
                'unit' => 'px',
            ],
            'condition' => [
                'layout' => 'carousel',
            ],

        ]);
        $this->add_control('slides_to_show_tablet', [
            'label' => esc_html__('Slides to Show (Tablet)', 'cafe-lite'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 10,
                ]
            ],
            'default' => [
                'size' => 3,
                'unit' => 'px',
            ],
            'mobile_default' => [
                'size' => 2,
                'unit' => 'px',
            ],
            'condition' => [
                'layout' => 'carousel',
            ],

        ]);
        $this->add_control('slides_to_show_mobile', [
            'label' => esc_html__('Slides to Show (Mobile)', 'cafe-lite'),
            'type' => Controls_Manager::SLIDER,
            'range' => [
                'px' => [
                    'min' => 1,
                    'max' => 10,
                ]
            ],
            'default' => [
                'size' => 2,
                'unit' => 'px',
            ],
            'condition' => [
                'layout' => 'carousel',
            ],
        ]);

        $this->add_control('speed', [
            'label' => esc_html__('Carousel: Speed to Scroll', 'cafe-lite'),
            'description' => esc_html__('', 'cafe-lite'),
            'type' => Controls_Manager::NUMBER,
            'default' => 5000,
            'condition' => [
                'layout' => 'carousel',
            ],
        ]);
        $this->add_control('scroll', [
            'label' => esc_html__('Carousel: Slide to Scroll', 'cafe-lite'),
            'description' => esc_html__('', 'cafe-lite'),
            'type' => Controls_Manager::NUMBER,
            'default' => 1,
            'condition' => [
                'layout' => 'carousel',
            ],
        ]);
        $this->add_responsive_control('autoplay', [
            'label' => esc_html__('Carousel: Auto Play', 'cafe-lite'),
            'description' => esc_html__('', 'cafe-lite'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'cafe-lite'),
            'label_off' => esc_html__('Hide', 'cafe-lite'),
            'return_value' => 'true',
            'default' => 'true',
            'condition' => [
                'layout' => 'carousel',
            ],
        ]);
        $this->add_responsive_control('show_pag', [
            'label' => esc_html__('Carousel: Pagination', 'cafe-lite'),
            'description' => esc_html__('', 'cafe-lite'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'cafe-lite'),
            'label_off' => esc_html__('Hide', 'cafe-lite'),
            'return_value' => 'true',
            'default' => 'true',
            'condition' => [
                'layout' => 'carousel',
            ],
        ]);
        $this->add_responsive_control('show_nav', [
            'label' => esc_html__('Carousel: Navigation', 'cafe-lite'),
            'description' => esc_html__('', 'cafe-lite'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => esc_html__('Show', 'cafe-lite'),
            'label_off' => esc_html__('Hide', 'cafe-lite'),
            'return_value' => 'true',
            'default' => 'true',
            'condition' => [
                'layout' => 'carousel',
            ],
        ]);
        $this->add_control('nav_position', [
            'label' => esc_html__('Carousel: Navigation position', 'cafe-lite'),
            'description' => esc_html__('', 'cafe-lite'),
            'type' => Controls_Manager::SELECT,
            'default' => 'middle-nav',
            'options' => [
                'top-nav' => esc_html__('Top', 'cafe-lite'),
                'middle-nav' => esc_html__('Middle', 'cafe-lite'),
            ],
            'condition' => [
                'show_nav' => 'true',
                'layout' => 'carousel',
            ],
        ]);

        $this->end_controls_section();

    }

    /**
     * Load style
     */
    public function get_style_depends()
    {
        return ['cafe-style','slick'];
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
            'title' => '',
            'token' => '',
            'user_id' => '',
            'number' => '',

            'img_size' => 'large',
            'show_likes' => '',
            'show_comments' => '',
            'show_type' => '',
            'show_time' => '',
            'time_layout' => 'elapsed',
            'date_format' => '',
            'layout' => 'carousel',
            'columns' => '',

            'slides_to_show' => 4,
            'speed' => 5000,
            'scroll' => 1,
            'autoplay' => 'true',
            'show_pag' => 'true',
            'show_nav' => 'true',
            'nav_position' => 'middle-nav',

        ], $this->get_settings_for_display());

        $this->add_inline_editing_attributes('title');

        $this->getViewTemplate('template', 'instagram', $settings);
    }
}

