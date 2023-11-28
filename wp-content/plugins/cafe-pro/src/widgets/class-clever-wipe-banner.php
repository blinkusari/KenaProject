<?php namespace Cafe\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Plugin as ElementorPlugin;

/**
 * CleverWipeBanner
 *
 * @author CleverSoft <hello.cleversoft@gmail.com>
 * @package CAFE
 */
final class CleverWipeBanner extends CleverWidgetBase
{
    /**
     * @return string
     */
    function get_name()
    {
        return 'clever-wipe-banner';
    }

    /**
     * @return string
     */
    function get_title()
    {
        return esc_html__('CAFE Wipe Banner', 'cafe-pro');
    }

    /**
     * @return string
     */
    function get_icon()
    {
        return 'cs-font clever-icon-banner';
    }

    public function get_script_depends()
    {
        return ['mousewheel', 'cafe-script'];
    }

    /**
     * Register controls
     */
    protected function register_controls()
    {
        $repeater = new \Elementor\Repeater();
        $repeater->add_control('image', [
            'label' => esc_html__('Upload Image', 'cafe-pro'),
            'description' => esc_html__('Select an image for the banner.', 'cafe-pro'),
            'type' => Controls_Manager::MEDIA,
            'dynamic' => ['active' => true],
            'show_external' => true,
            'default' => [
                'url' => ''
            ]
        ]);
        $repeater->add_control('link', [
            'label' => esc_html__('Link', 'cafe-pro'),
            'type' => Controls_Manager::URL,
            'description' => esc_html__('Redirect link when click to banner.', 'cafe-pro'),
            'separator' => 'after',
        ]);
        $repeater->add_control('heading_2', [
            'label' => esc_html__('Heading 2', 'cafe-pro'),
            'description' => esc_html__('What is the title of this banner.', 'cafe-pro'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => esc_html__('Heading 2', 'cafe-pro'),
            'label_block' => true
        ]);

        $repeater->add_control('heading_2_tag',
            [
                'label' => esc_html__('HTML Tag', 'cafe-pro'),
                'description' => esc_html__('Select a heading tag for the title. Headings are defined with H1 to H6 tags.', 'cafe-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6'
                ],
                'label_block' => true,
                'separator' => 'after',
            ]);
        $repeater->add_control('heading_3', [
            'label' => esc_html__('Heading 3', 'cafe-pro'),
            'description' => esc_html__('What is the title of this banner.', 'cafe-pro'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => esc_html__('Heading 3', 'cafe-pro'),
            'label_block' => true
        ]);

        $repeater->add_control('heading_3_tag',
            [
                'label' => esc_html__('HTML Tag', 'cafe-pro'),
                'description' => esc_html__('Select a heading tag for the title. Headings are defined with H1 to H6 tags.', 'cafe-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6'
                ],
                'label_block' => true,
                'separator' => 'after',
            ]);
        $this->start_controls_section('general_settings', [
            'label' => esc_html__('General', 'cafe-pro')
        ]);
        $this->add_responsive_control('section_height', [
            'label' => esc_html__('Height', 'cafe-pro'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'vh'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 2000,
                ], '%' => [
                    'min' => 0,
                    'max' => 100,
                ], 'vh' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}}' => 'height: {{SIZE}}{{UNIT}}',
            ]
        ]);
        $this->add_responsive_control('custom_height', [
            'label' => esc_html__('Content Height', 'cafe-pro'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'vh'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 2000,
                ], '%' => [
                    'min' => 0,
                    'max' => 100,
                ], 'vh' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-wipe-banner,{{WRAPPER}} .cafe-wrap-content, {{WRAPPER}} .cafe-banner-img, {{WRAPPER}} .on-screen .cafe-wiper' => 'height: {{SIZE}}{{UNIT}}',
                '{{WRAPPER}} .cafe-wrap-image' => 'min-height: {{SIZE}}{{UNIT}}'
            ]
        ]);
        $this->add_responsive_control('custom_width', [
            'label' => esc_html__('Width', 'cafe-pro'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'vw'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 2000,
                ], '%' => [
                    'min' => 0,
                    'max' => 100,
                ], 'vw' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-wrap-image' => 'width: {{SIZE}}{{UNIT}}'
            ]
        ]);
        $this->add_responsive_control('text_width', [
            'label' => esc_html__('Width of text block', 'cafe-pro'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px', '%', 'vw'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 2000,
                ], '%' => [
                    'min' => 0,
                    'max' => 100,
                ], 'vw' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-wrap-content' => 'width: {{SIZE}}{{UNIT}}'
            ]
        ]);
        $this->add_control('heading_1_heading', [
            'label' => esc_html__('Heading', 'cafe-pro'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'after',
        ]);
        $this->add_control('heading_1', [
            'label' => esc_html__('Heading 1', 'cafe-pro'),
            'description' => esc_html__('What is the title of this banner.', 'cafe-pro'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => esc_html__('Heading 1', 'cafe-pro'),
            'label_block' => true
        ]);

        $this->add_control('heading_1_tag',
            [
                'label' => esc_html__('HTML Tag', 'cafe-pro'),
                'description' => esc_html__('Select a heading tag for the title. Headings are defined with H1 to H6 tags.', 'cafe-pro'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6'
                ],
                'label_block' => true,
                'separator' => 'after',
            ]);
        $this->add_control('content', [
            'label' => __('Content', 'cafe-pro'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $repeater->get_controls(),
            'description' => __('Set content and image.', 'cafe-pro'),
            'title_field' => '{{{ heading_2 }}}',
            'separator' => 'before',
        ]);
        $this->end_controls_section();
        $this->start_controls_section('normal_style_settings', [
            'label' => esc_html__('Normal', 'cafe-pro'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);
        $this->add_responsive_control(
            'text_align',
            [
                'label' => esc_html__('Text Align', 'cafe-pro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'cafe-pro'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'center' => esc_html__('Center', 'cafe-pro'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'cafe-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cafe-wrap-image' => 'text-align: {{VALUE}};'
                ],
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control('horizontal_align', [
            'label' => esc_html__('Horizontal Align', 'cafe-pro'),
            'type' => Controls_Manager::CHOOSE,
            'label_block' => false,
            'options' => [
                'flex-start' => [
                    'title' => esc_html__('Left', 'cafe-pro'),
                    'icon' => 'eicon-h-align-left',
                ],
                'center' => [
                    'title' => esc_html__('Center', 'cafe-pro'),
                    'icon' => 'eicon-h-align-center',
                ],
                'flex-end' => [
                    'title' => esc_html__('Right', 'cafe-pro'),
                    'icon' => 'eicon-h-align-right',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-wipe-banner-wrap' => 'justify-content:{{VALUE}};'
            ],
        ]);
        $this->add_responsive_control('dimensions', [
            'label' => esc_html__('Content Padding', 'cafe-pro'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'separator' => 'after',
            'selectors' => [
                '{{WRAPPER}} .cafe-wrap-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
        $this->add_control('heading_1_color_heading', [
            'label' => esc_html__('Heading 1', 'cafe-pro'),
            'separator' => 'after',
            'type' => Controls_Manager::HEADING
        ]);
        $this->add_control('heading_1_color', [
            'label' => esc_html__('Color', 'cafe-pro'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cafe-heading-1' => 'color: {{VALUE}};'
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_1_typography',
                'selector' => '{{WRAPPER}} .cafe-heading-1',
                'scheme' => Typography::TYPOGRAPHY_1,
            ]
        );
        $this->add_responsive_control('heading_1_margin', [
            'label' => esc_html__('Margin', 'cafe-pro'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .cafe-heading-1' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
        $this->add_control('heading_2_color_heading', [
            'label' => esc_html__('Heading 2', 'cafe-pro'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'after',
        ]);
        $this->add_control('heading_2_color', [
            'label' => esc_html__('Color', 'cafe-pro'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cafe-heading-2' => 'color: {{VALUE}};'
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_2_typography',
                'selector' => '{{WRAPPER}} .cafe-heading-2',
                'scheme' => Typography::TYPOGRAPHY_1,
            ]
        );
        $this->add_responsive_control('heading_2_margin', [
            'label' => esc_html__('Margin', 'cafe-pro'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .cafe-heading-2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
        $this->add_control('heading_3_color_heading', [
            'label' => esc_html__('Heading 3', 'cafe-pro'),
            'type' => Controls_Manager::HEADING,
            'separator' => 'after',
        ]);
        $this->add_control('heading_3_color', [
            'label' => esc_html__('Color', 'cafe-pro'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cafe-heading-3' => 'color: {{VALUE}};'
            ]
        ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'heading_3_typography',
                'selector' => '{{WRAPPER}} .cafe-heading-3',
                'scheme' => Typography::TYPOGRAPHY_1,
            ]
        );
        $this->add_responsive_control('heading_3_margin', [
            'label' => esc_html__('Margin', 'cafe-pro'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'selectors' => [
                '{{WRAPPER}} .cafe-heading-3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();
    }

    /**
     * Render
     */
    protected function render()
    {
        $settings = array_merge([
            'heading_1' => '',
            'heading_1_tag' => 'h3',
        ], $this->get_settings_for_display());

        $this->add_inline_editing_attributes('heading_1');

        $heading_1_html_classes = ['cafe-heading-1 cafe-heading'];
        if (ElementorPlugin::$instance->editor->is_edit_mode()) {
            $heading_html_classes[] = 'cafe-draggable-element';
        }

        $this->add_render_attribute('heading_1', 'class', $heading_1_html_classes);

        $this->getViewTemplate('template', 'wipe-banner', $settings);
    }
}
