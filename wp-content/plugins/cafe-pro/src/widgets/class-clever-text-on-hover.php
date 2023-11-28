<?php namespace Cafe\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
/**
 * CleverTextOnHover
 *
 * @author CleverSoft <hello.cleversoft@gmail.com>
 * @package CAFE
 */
final class CleverTextOnHover extends CleverWidgetBase
{
    /**
     * @return string
     */
    function get_name()
    {
        return 'clever-text-on-hover';
    }

    /**
     * @return string
     */
    function get_title()
    {
        return esc_html__('CAFE Text On Hover', 'cafe-pro');
    }

    /**
     * @return string
     */
    function get_icon()
    {
        return 'cs-font clever-icon-finger-touch-screen';
    }
    public function get_script_depends()
    {
        return ['cafe-script' ];
    }
    /**
     * Register controls
     */
    protected function register_controls()
    {
        $this->start_controls_section('general_settings', [
            'label' => esc_html__('General', 'cafe-pro')
        ]);
        $this->add_control('label', [
            'label' => esc_html__('Label', 'cafe-pro'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('Text On Hover', 'cafe-pro'),
            'separator'   => 'after',
            'label_block' => false
        ]); $this->add_control('media_url', [
            'label' => esc_html__('Video url', 'cafe-pro'),
            'description' => esc_html__('Link to your source video file.', 'cafe-pro'),
            'type' => Controls_Manager::URL,
            'label_block' => false
        ]);
        $this->add_control('heading_or', [
            'label' => esc_html__('OR', 'cafe-pro'),
            'type' => Controls_Manager::HEADING,
            'separator'   => 'both',
        ]);
        $this->add_control('image', [
            'label' => esc_html__('Upload Media', 'cafe-pro'),
            'description' => esc_html__('Media show below text when hover.', 'cafe-pro'),
            'type' => Controls_Manager::MEDIA,
            'dynamic' => ['active' => true],
            'show_external' => true,

            'default' => [
                'url' => ''
            ]
        ]);
        $this->add_control('css_class', [
            'label' => esc_html__('Custom HTML Class', 'cafe-pro'),
            'type' => Controls_Manager::TEXT,
            'separator'   => 'before',
            'description' => esc_html__('You may add a custom HTML class to style element later.', 'cafe-pro'),
        ]);
        $this->end_controls_section();
        $this->start_controls_section('normal_style_settings', [
            'label' => esc_html__('Style', 'cafe-pro'),
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
                    '{{WRAPPER}}  .cafe-text-on-hover' => 'text-align: {{VALUE}};'
                ],
                'separator'   => 'after',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .cafe-text-on-hover .cafe-text',
                'scheme' => Typography::TYPOGRAPHY_1,
            ]
        );
        $this->add_control('color', [
            'label' => esc_html__('Outline text Color', 'cafe-pro'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cafe-text-on-hover' => '--text-color: {{VALUE}};'
            ]
        ]);
        $this->add_control('hover_color', [
            'label' => esc_html__('Hover Text Color', 'cafe-pro'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cafe-text-on-hover:hover' => '--text-color: {{VALUE}};'
            ]
        ]);
        $this->add_responsive_control('text_padding', [
            'label' => esc_html__('Padding', 'cafe-pro'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'separator'   => 'before',
            'selectors' => [
                '{{WRAPPER}} .cafe-text-on-hover .cafe-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
        $this->add_responsive_control('hover_box_size', [
            'label' => esc_html__('Hover box size', 'cafe-pro'),
            'type' => Controls_Manager::SLIDER,
            'size_units' => ['px','%'],
            'range' => [
                'px' => [
                    'min' => 0,
                    'max' => 1000,
                ],'%' => [
                    'min' => 0,
                    'max' => 100,
                ]
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-text-on-hover.active .cafe-bg-cursor' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}}'
            ]
        ]);
        $this->end_controls_section();
    }

    /**
     * Render
     */
    protected function render()
    {
        $settings = array_merge([ // default settings
            'label' => esc_html__('Text On Hover', 'cafe-pro'),
            'css_class' => '',
        ], $this->get_settings_for_display());

        $this->add_inline_editing_attributes('label');

        $button_class = 'cafe-text';
        $this->add_render_attribute('label', 'class', $button_class);

        $this->getViewTemplate('template', 'text-hover', $settings);
    }
}
