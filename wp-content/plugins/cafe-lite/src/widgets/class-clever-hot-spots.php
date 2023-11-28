<?php namespace Cafe\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

/**
 * Clever Hot Spots
 *
 * @author CleverSoft <hello.cleversoft@gmail.com>
 * @package CAFE
 */
final class CleverHotSpots extends CleverWidgetBase
{
    /**
     * @return string
     */
    function get_name()
    {
        return 'clever-hot-spots';
    }

    /**
     * @return string
     */
    function get_title()
    {
        return esc_html__('CAFE Hot Spots', 'cafe-lite');
    }

    /**
     * @return string
     */
    function get_icon()
    {
        return 'cs-font clever-icon-map-2';
    }

    /**
     * Register controls
     */
    protected function register_controls()
    {
        $this->start_controls_section('settings', [
            'label' => esc_html__('Settings', 'cafe-lite')
        ]);
        $repeater = new \Elementor\Repeater();
        $repeater->add_control(
            'spot_icon',
            [
                'label' => esc_html__('Icon', 'cafe-lite'),
                'type' => 'clevericon',
                'default' => 'cs-font clever-icon-plus',
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'spot_title',
            [
                'label' => esc_html__('Title', 'cafe-lite'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Hot Spot', 'cafe-lite'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'spot_des',
            [
                'label' => esc_html__('Description', 'cafe-lite'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => '',
            ]
        );
        $repeater->add_control('spot_content_pos',
            [
                'label' => esc_html__('Content Position', 'cafe-lite'),
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'top' => esc_html__('Top', 'cafe-lite'),
                    'right' => esc_html__('Right', 'cafe-lite'),
                    'bottom' => esc_html__('Bottom', 'cafe-lite'),
                    'left' => esc_html__('Left', 'cafe-lite'),
                ],
                'label_block' => true,
            ]);
        $repeater->add_control(
            'spot_loc_heading',
            [
                'label' => esc_html__('Position', 'cafe-lite'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $repeater->add_responsive_control('spot_top', [
            'label' => esc_html__('Top', 'cafe-lite'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', 'vh', '%'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 3000,
                ],
                'vh' => [
                    'min' => 0,
                    'max' => 100,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'size' => 50,
                'unit' => '%',
            ],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}}.cafe-hot-spot' => 'top: {{SIZE}}{{UNIT}};',
            ],
        ]);
        $repeater->add_responsive_control('spot_left', [
            'label' => esc_html__('Left', 'cafe-lite'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', 'vw', '%'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 3000,
                ],
                'vw' => [
                    'min' => 0,
                    'max' => 100,
                ],
                '%' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default' => [
                'size' => 50,
                'unit' => '%',
            ],
            'selectors' => [
                '{{WRAPPER}} {{CURRENT_ITEM}}.cafe-hot-spot' => 'left: {{SIZE}}{{UNIT}};',
            ],
        ]);

        $this->add_control('img', [
            'label' => esc_html__('Image', 'cafe-lite'),
            'type' => Controls_Manager::MEDIA,
        ]);
        $this->add_control('hot_spot_effect',
            [
                'label' => esc_html__('Hot Spot Effect', 'cafe-lite'),
                'type' => Controls_Manager::SELECT,
                'default' => 'wave',
                'options' => [
                    'wave' => esc_html__('Wave', 'cafe-lite'),
                    'blink' => esc_html__('Blink', 'cafe-lite'),
                    'none' => esc_html__('None', 'cafe-lite'),
                ],
                'label_block' => true,
            ]);
        $this->add_control('hot_spot_content_effect',
            [
                'label' => esc_html__('Content Effect', 'cafe-lite'),
                'type' => Controls_Manager::SELECT,
                'default' => 'fade-in',
                'options' => [
                    'fade-in' => esc_html__('Fade In', 'cafe-lite'),
                    'rotate' => esc_html__('Rotate', 'cafe-lite'),
                    'zoom-in' => esc_html__('Zoom In', 'cafe-lite'),
                ],
                'label_block' => true,
            ]);
        $this->add_control('hot_spots', [
            'label' => esc_html__('Hot Spots', 'cafe-lite'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'title_field' => '{{{spot_title}}}',
            'default' => [
                [
                    'spot_title' => __('Hot Spot 1', 'cafe-lite'),
                ], [
                    'spot_title' => __('Hot Spot 2', 'cafe-lite'),
                ], [
                    'spot_title' => __('Hot Spot 3', 'cafe-lite'),
                ],
            ],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('spot_block_style', [
            'label' => esc_html__('Hot Spot Style', 'cafe-lite'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_responsive_control('hot_spot_size', [
            'label' => esc_html__('Size', 'cafe-lite'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'default' => [
                'size' => 40,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-hot-spot' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
            ],
        ]);
        $this->add_responsive_control('hot_spot_icon_size', [
            'label' => esc_html__('Font Size', 'cafe-lite'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', 'em', 'rem'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
                'em' => [
                    'min' => 0,
                    'max' => 10,
                ],
                'rem' => [
                    'min' => 0,
                    'max' => 10,
                ],
            ],
            'default' => [
                'size' => 1,
                'unit' => 'rem',
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-hot-spot' => 'font-size: {{SIZE}}{{UNIT}}',
            ],
        ]);
        $this->add_control('hot_spot_color', [
            'label' => esc_html__('Color', 'cafe-lite'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cafe-hot-spot-icon' => 'color: {{VALUE}};'
            ]
        ]);
        $this->add_control('hot_spot_bg', [
            'label' => esc_html__('Background Color', 'cafe-lite'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cafe-hot-spot-icon' => 'background: {{VALUE}};'
            ]
        ]);
        $this->end_controls_section();
        $this->start_controls_section('block_style', [
            'label' => esc_html__('Content Block', 'cafe-lite'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_responsive_control(
            'text_align',
            [
                'label' => esc_html__('Content Align', 'cafe-lite'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'cafe-lite'),
                        'icon' => 'eicon-text-align-left',
                    ], 'center' => [
                        'title' => esc_html__('Center', 'cafe-lite'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'cafe-lite'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wrap-content-hot-spot' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        $this->add_responsive_control('content_padding', [
            'label' => esc_html__('Content Padding', 'cafe-lite'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'separator' => 'before',
            'selectors' => [
                '{{WRAPPER}} .wrap-content-hot-spot' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
        $this->add_responsive_control('content_width', [
            'label' => esc_html__('Content Width', 'cafe-lite'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 5000,
                ],
            ],
            'default' => [
                'size' => 250,
                'unit' => 'px',
            ],
            'selectors' => [
                '{{WRAPPER}} .wrap-content-hot-spot' => 'width: {{SIZE}}{{UNIT}};',
            ],
        ]);
        $this->add_control('content_bg', [
            'label' => esc_html__('Background Color', 'cafe-lite'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .wrap-content-hot-spot' => '--bg-block: {{VALUE}};'
            ]
        ]);
        $this->add_control('content_title_style', [
            'label' => esc_html__('Title', 'cafe-lite'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $this->add_control('content_title_color', [
            'label' => esc_html__('Color', 'cafe-lite'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .hot-spot-title' => 'color: {{VALUE}};'
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_title_typo',
                'selector' => '{{WRAPPER}} .hot-spot-title',
                'scheme' => Typography::TYPOGRAPHY_1,
            ]
        );
        $this->add_control('content_des_style', [
            'label' => esc_html__('Description', 'cafe-lite'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'before',
        ]);
        $this->add_control('content_des_color', [
            'label' => esc_html__('Color', 'cafe-lite'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .hot-spot-des' => 'color: {{VALUE}};'
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_des_typo',
                'selector' => '{{WRAPPER}} .hot-spot-des',
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
        return ['cafe-script'];
    }

    /**
     * Render
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->getViewTemplate('template', 'hot-spots', $settings);
    }
}
