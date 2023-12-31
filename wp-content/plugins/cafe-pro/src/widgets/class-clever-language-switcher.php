<?php namespace Cafe\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

/**
 * CleverSiteLogo
 */
final class CleverLanguageSwitcher extends CleverWidgetBase
{

    /**
     * Get widget name.
     *
     * Retrieve text editor widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'clever-language-switcher';
    }

    /**
     * Get widget title.
     *
     * Retrieve text editor widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('CAFE Language Switcher', 'cafe-pro');
    }

    /**
     * Get widget icon.
     *
     * Retrieve text editor widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-exchange';
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return ['site', 'language', 'switcher'];
    }

    /**
     * @return array
     */
    public function get_categories()
    {
        return ['clever-builder-elements'];
    }    

    /**
     * Register text editor widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'section_general',
            [
                'label' => __('Language Switcher', 'cafe-pro'),
            ]
        );
        $this->add_control('label', [
            'label' => __('Label', 'cafe-pro'),
            'type' => Controls_Manager::TEXT,
            'default' => esc_html__('Language', 'cafe-pro'),
        ]);
        $this->add_control('show_icon', [
            'label' => __('Show Icon', 'cafe-pro'),
            'type' => Controls_Manager::SWITCHER,
            'return_value' => 'true',
            'default' => 'true',

        ]);
        $this->add_control('icon', [
            'label' => __('Icon', 'cafe-pro'),
            'type' => 'clevericon',
            'default' => 'cs-font clever-icon-place-localizer',
            'condition'     => [
                'show_icon' => 'true',
            ],
        ]);
        $this->add_control('show_flag', [
            'label' => __('Show Flag', 'cafe-pro'),
            'type' => Controls_Manager::SWITCHER,
            'return_value' => 'true',
            'default' => 'true',
        ]);
        $this->add_control('show_language', [
            'label' => __('Show Language Label', 'cafe-pro'),
            'type' => Controls_Manager::SWITCHER,
            'return_value' => 'true',
            'default' => 'true',
        ]);
        $this->end_controls_section();
        $this->start_controls_section(
            'switcher_lang_style',
            [
                'label' => __('Style', 'cafe-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'search_field_typo',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .cafe-language-switcher',
            ]
        );
        $this->add_responsive_control(
            'search_icon_align',
            [
                'label' => __('Icon Alignment', 'cafe-pro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'cafe-pro'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'cafe-pro'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'cafe-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'switcher_color',
            [
                'label' => esc_html__('Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cafe-language-switcher' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'switcher_hv_color',
            [
                'label' => esc_html__('Hover Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cafe-language-switcher .cafe-language-options:hover' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'switcher_btn_border',
                'label'       => __( 'Border', 'cafe-pro' ),
                'placeholder' => '',
                'default'     => '',
                'selector'    => '{{WRAPPER}} .cafe-language-switcher',
                'separator'   => 'before',
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'switcher_lang_box_style',
            [
                'label' => __('Languages Box', 'cafe-pro'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control('box_width',[
            'label'         => esc_html__('Box width', 'cafe-pro' ),
            'type'          => Controls_Manager::SLIDER,
            'range' => [
                'px' =>[
                    'min' => 1,
                    'max' => 500,
                ]
            ],
            'devices' => [ 'desktop', 'tablet', 'mobile' ],
            'selectors' => [
                '{{WRAPPER}} .cafe-language-switcher .cafe-langs' => 'width:{{SIZE}}{{UNIT}}'
            ]
        ]);
        $this->add_control(
            'box_align',
            [
                'label' => 'Box Align',
                'type' => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => [
                    'left' => esc_html__('Left', 'cafe-pro'),
                    'right' => esc_html__('Right', 'cafe-pro')
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'search_field_box_typo',
                'scheme' => Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .cafe-language-switcher .cafe-langs',
            ]
        );
        $this->add_responsive_control(
            'box_text_align',
            [
                'label' => __('Alignment', 'cafe-pro'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'cafe-pro'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'cafe-pro'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'cafe-pro'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cafe-langs' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'switcher_box_color',
            [
                'label' => esc_html__('Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cafe-language-switcher .cafe-langs' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'switcher_hv_box_color',
            [
                'label' => esc_html__('Hover Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cafe-language-switcher li:hover>a' => 'color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'switcher_hv_box_bg',
            [
                'label' => esc_html__('Background Color', 'cafe-pro'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cafe-language-switcher  .cafe-langs' => 'background: {{VALUE}}'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'          => 'switcher_shadow',
                'selector'      => '{{WRAPPER}} .cafe-language-switcher  .cafe-langs'
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'switcher_btn_box_border',
                'label'       => __( 'Border', 'cafe-pro' ),
                'placeholder' => '',
                'default'     => '',
                'selector'    => '{{WRAPPER}} .cafe-language-switcher  .cafe-langs',
                'separator'   => 'before',
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Render text editor widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $this->getViewTemplate('template', 'language-switcher', $settings);
    }
}
