<?php namespace Cafe\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

/**
 * CleverSiteNavMenu
 */
final class CleverSiteOffCanvas extends CleverWidgetBase
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
        return 'clever-site-off-canvas';
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
        return __('CAFE Site Off Canvas', 'cafe-pro');
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
        return 'cs-font clever-icon-layer';
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
        return ['site', 'nav','menu'];
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
            'section_content',
            [
                'label' => __('Content', 'cafe-pro'),
            ]
        );
        $this->add_control('offcanvas_content', [
            'label'     => esc_html__('Canvas content', 'cafe-pro'),
            'type'      => Controls_Manager::SELECT,
            'default'   => '',
            'options' => $this->list_section_templates(),
        ]);
        $this->add_control(
            'hamburger_text',
            [
                'label' => __('Label', 'cafe-pro'),
                'type' => Controls_Manager::TEXT,
                'default'=>'',
            ]
        );
        $this->add_control(
            'hamburger_style',
            [
                'label' => __('Style', 'cafe-pro'),
                'type' => Controls_Manager::SELECT,
                'default'=>'off-canvas',
                'options' => [
                    'off-canvas' => esc_html__('Off Canvas','cafe-pro'),
                    'off-canvas-2' => esc_html__('Off Canvas 2','cafe-pro'),
                    'fixed-tr-fs' => esc_html__('Fixed Top Right Modal','cafe-pro'),
                    'full-screen' => esc_html__('Full screen','cafe-pro'),
                    'slide-down' => esc_html__('Slide Down','cafe-pro'),
                    'slide-left' => esc_html__('Slide Left','cafe-pro'),
                ],
            ]
        );
        $this->add_control(
            'canvas_position',
            [
                'label' => __('Canvas Position', 'cafe-pro'),
                'type' => Controls_Manager::SELECT,
                'default'=>'left',
                'options' => [
                    'left' => esc_html__('Left','cafe-pro'),
                    'right' => esc_html__('Right','cafe-pro'),
                ],
                'condition'     => [
                    'hamburger_style' => array('off-canvas','off-canvas-2'),
                ],
            ]
        );
        $this->add_responsive_control(
            'menu_icon_align',
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
        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_menu_button',
            [
                'label' => __('Off canvas Button', 'cafe-pro'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs('menu_btn_style_tabs');
        $this->start_controls_tab(
            'menu_btn_style_tab',
            [
                'label'         => esc_html__('Normal', 'cafe-pro'),
            ]
        );

        $this->add_control(
            'menu_btn_color',
            [
                'label'         => esc_html__('Color', 'cafe-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .cafe-hamburger-button'  => '--menu-icon-color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'menu_btn_bg_color',
            [
                'label'         => esc_html__('Background Color', 'cafe-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .cafe-hamburger-button'  => 'background: {{VALUE}}'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'menu_btn_style_hover_tab',
            [
                'label'         => esc_html__('Hover', 'cafe-pro'),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'          => 'menu_btn_typo_text',
                'label'         => __('Typography Label', 'cafe-pro'),
                'scheme'        => Typography::TYPOGRAPHY_1,
                'selector'      => '{{WRAPPER}} .cafe-site-offcanvas .cafe-hamburger-button',
            ]
        );
        $this->add_control(
            'menu_btn_hv_color',
            [
                'label'         => esc_html__('Color', 'cafe-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .cafe-site-offcanvas .cafe-hamburger-button:hover'  => '--menu-icon-color: {{VALUE}}'
                ]
            ]
        );
        $this->add_control(
            'menu_btn_bg_hv_color',
            [
                'label'         => esc_html__('Background Color', 'cafe-pro'),
                'type'          => Controls_Manager::COLOR,
                'selectors'     => [
                    '{{WRAPPER}} .cafe-wrap-hamburger-icon:hover'  => 'background: {{VALUE}}'
                ]
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_control('menu_btn_size',[
            'label'         => __( 'Size', 'cafe-pro' ),
            'type'          => Controls_Manager::SLIDER,
            'separator'   => 'before',
            'range' => [
                'px' =>[
                    'min' => 0,
                    'max' => 100,
                ]
            ],
            'selectors'     => [
                '{{WRAPPER}}  .cafe-wrap-hamburger-icon'  => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
            ]
        ]);
        $this->add_responsive_control('menu_btn_padding',[
            'label'         => __( 'Padding', 'cafe-pro' ),
            'type'          => Controls_Manager::SLIDER,
            'range' => [
                'px' =>[
                    'min' => 0,
                    'max' => 100,
                ]
            ],
            'selectors'     => [
                '{{WRAPPER}} .cafe-wrap-hamburger-icon'  => 'padding:{{SIZE}}{{UNIT}};',
                '{{WRAPPER}} .cafe-hamburger-button .cafe-hamburger-icon'  => 'width:calc(100% - 2*{{SIZE}}{{UNIT}});',
            ]
        ]);
        $this->add_control('menu_btn_border-radius',[
            'label'         => __( 'Border Radius', 'cafe-pro' ),
            'type'          => Controls_Manager::SLIDER,
            'selectors'     => [
                '{{WRAPPER}}  .cafe-wrap-hamburger-icon'  => 'border-radius:{{SIZE}}{{UNIT}};',
            ]
        ]);
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'menu_btn_item_border',
                'label'       => __( 'Border', 'cafe-pro' ),
                'placeholder' => '',
                'default'     => '',
                'selector'    => '{{WRAPPER}} .cafe-wrap-hamburger-icon',
                'separator'   => 'before',
            ]
        );
        $this->end_controls_section();
    }
    /**
     * @return array
     */
    protected function list_section_templates()
    {
        $templates = [];

        $posts = get_posts([
            'post_type' => 'elementor_library',
            'meta_key' => '_elementor_template_type',
            'meta_value' => 'section',
            'posts_per_page' => -1,
            'no_found_rows' => true,
            'update_post_meta_cache' => 0,
            'update_post_term_cache' => 0
        ]);

        if ($posts) {
            $current_post_id = isset($_GET['post']) ? $_GET['post'] : 0;
            foreach ($posts as $post) {
                if ($post->ID == $current_post_id) { // TODO: exclude current template.
                    continue;
                }
                $templates[$post->post_name] = $post->post_title;
            }
        }

        return $templates;
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
       $this->getViewTemplate('template', 'site-off-canvas', $settings);
    }

}
