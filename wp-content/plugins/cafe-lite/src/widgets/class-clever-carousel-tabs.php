<?php
namespace Cafe\Widgets;

use Elementor\Controls_Manager;
use Cafe\Clever_Custom_Control;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

/**
 * Clever Carousel With Filter
 *
 * @author CleverSoft <hello.cleversoft@gmail.com>
 * @package CAFE
 */
final class CleverCarouselTabs extends CleverWidgetBase {
	/**
	 * @return string
	 */
	function get_name() {
		return 'clever-carousel-tabs';
	}

	/**
	 * @return string
	 */
	function get_title() {
		return __('CAFE Carousel Tabs', 'cafe-lite' );
	}

	/**
	 * @return string
	 */
	function get_icon() {
		return 'cs-font clever-icon-web-links';
	}

	/**
	 * Register controls
	 */
	protected function register_controls() {
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'label_filter',
			[
				'label'       => __( 'Label', 'cafe-lite' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);
        $repeater->add_control(
            'img',
            [
                'label'       => __( 'Images', 'cafe-lite' ),
                'type' => Controls_Manager::GALLERY,
                'dynamic' => ['active' => true],
                'show_external' => true,
                'separator' => 'after',
                'default' => [
                    'url' => ''
                ]
            ]
        );
		$this->start_controls_section( 'settings', [
			'label' => __( 'Settings', 'cafe-lite' )
		] );
		$this->add_control( 'filter', [
			'label'       => __( 'Filter', 'cafe-lite' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'description' => __( 'Set Filter option.', 'cafe-lite' ),
			'title_field' => '{{{ label_filter }}}',
			'default'     => [
				[
					'label_filter'          => __( 'Filter 1', 'cafe-lite' ),
					'tag_filter'          => __( 'filter-1', 'cafe-lite' ),
				],[
					'label_filter'          => __( 'Filter 2', 'cafe-lite' ),
					'tag_filter'          => __( 'filter-2', 'cafe-lite' ),
				],
			],

		] );

        // Carousel
        $this->add_control('slides_to_show',[
            'label'         => __( 'Slides to Show', 'cafe-lite' ),
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
            'label'         => __( 'Slides to Show (Tablet)', 'cafe-lite' ),
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
            ]
        ]);
        $this->add_control('slides_to_show_mobile',[
            'label'         => __( 'Slides to Show (Mobile)', 'cafe-lite' ),
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
            ]
        ]);
        $this->add_control('scroll', [
            'label'         => __('Slide to Scroll', 'cafe-lite'),
            'description'   => __('', 'cafe-lite'),
            'type'          => Controls_Manager::NUMBER,
            'default'       => 1,
        ]);
        $this->add_control('speed', [
            'label'         => __('Speed to Scroll', 'cafe-lite'),
            'description'   => __('', 'cafe-lite'),
            'type'          => Controls_Manager::NUMBER,
            'default'       => 5000,
        ]);
        $this->add_responsive_control('autoplay', [
            'label'         => __('Auto Play', 'cafe-lite'),
            'description'   => __('', 'cafe-lite'),
            'type'          => Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'cafe-lite' ),
            'label_off' => __( 'Hide', 'cafe-lite' ),
            'return_value' => 'true',
            'default' => 'true',
        ]);
        $this->add_responsive_control('show_pag', [
            'label'         => __('Pagination', 'cafe-lite'),
            'description'   => __('', 'cafe-lite'),
            'type'          => Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'cafe-lite' ),
            'label_off' => __( 'Hide', 'cafe-lite' ),
            'return_value' => 'true',
            'default' => 'true',
        ]);
        $this->add_responsive_control('show_nav', [
            'label'         => __('Navigation', 'cafe-lite'),
            'description'   => __('', 'cafe-lite'),
            'type'          => Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'cafe-lite' ),
            'label_off' => __( 'Hide', 'cafe-lite' ),
            'return_value' => 'true',
            'default' => 'true',
        ]);

        $this->add_responsive_control('infinite', [
            'label'         => __('Infinite', 'cafe-lite'),
            'description'   => __('', 'cafe-lite'),
            'type'          => Controls_Manager::SWITCHER,
            'label_on' => __( 'Yes', 'cafe-lite' ),
            'label_off' => __( 'No', 'cafe-lite' ),
            'return_value' => 'true',
            'default' => 'true',
        ]);
        $this->add_control('overflow', [
            'label'         => __('Content Overflow', 'cafe-lite'),
            'description'   => __('', 'cafe-lite'),
            'type'          => Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'cafe-lite' ),
            'label_off' => __( 'Hide', 'cafe-lite' ),
            'return_value' => 'true',
            'default' => 'true',
        ]);
        $this->add_control('show_drag_label', [
            'label'         => __('Show Drag label', 'cafe-lite'),
            'description'   => __('', 'cafe-lite'),
            'type'          => Controls_Manager::SWITCHER,
            'label_on' => __( 'Show', 'cafe-lite' ),
            'label_off' => __( 'Hide', 'cafe-lite' ),
            'return_value' => 'true',
            'default' => 'true',
        ]);
        $this->add_control(
            'drag_label',
            [
                'label'       => esc_html__( 'Drag label', 'cafe-lite' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default' => esc_html__('Drag','cafe-lite'),
                'condition' => [
                    'show_drag_label' => 'true'
                ],
            ]
        );
        $this->end_controls_section();
		$this->start_controls_section( 'filter_style_settings', [
			'label' => __( 'Filter', 'cafe-lite' ),
            'tab'   => Controls_Manager::TAB_STYLE,
		] );
        $this->add_responsive_control(
            'filter_align',
            [
                'label'     => __( 'Filter Align', 'cafe-lite' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'cafe-lite' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'cafe-lite' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'cafe-lite' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .cafe-wrap-tab-head' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .cafe-wrap-tab-head .cafe-tab-item',
                'scheme'   => Typography::TYPOGRAPHY_1,
            ]
        );
		$this->add_control( 'color', [
			'label'     => __( 'Color', 'cafe-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cafe-wrap-tab-head .cafe-tab-item' => 'color: {{COLOR}};',
			],
		] );
		$this->add_control('active_color',[
            'label'     => __( 'Active Color', 'cafe-lite' ),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .cafe-wrap-tab-head .cafe-tab-item.active' => 'color: {{COLOR}};--color:{{COLOR}}',
            ],
        ]);
        $this->add_responsive_control( 'filter_gutter', [
            'label'     => esc_html__('Gutter', 'cafe-lite' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-wrap-tab-head .cafe-tab-item' => 'margin-left: calc({{SIZE}}{{UNIT}}/2);margin-right:  calc({{SIZE}}{{UNIT}}/2);',
            ],
        ] );
        $this->add_responsive_control( 'space', [
            'label'     => esc_html__('Space', 'cafe-lite' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 200,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-wrap-tab-head' => 'margin-bottom: {{SIZE}}{{UNIT}};',
            ],
        ] );
        $this->end_controls_section();
        $this->start_controls_section( 'carousel_settings', [
            'label' => __( 'Carousel', 'cafe-lite' ),
            'tab'   => Controls_Manager::TAB_STYLE,
        ] );
        $this->add_control( 'gutter', [
            'label'     => esc_html__('Gutter', 'cafe-lite' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-tab-carousel-item' => 'padding-left: calc({{SIZE}}{{UNIT}}/2);padding-right:  calc({{SIZE}}{{UNIT}}/2);',
                '{{WRAPPER}} .cafe-wrap-tabs' => 'margin-left: calc(-{{SIZE}}{{UNIT}}/2);margin-right:  calc(-{{SIZE}}{{UNIT}}/2);',
            ],
        ] );
        $this->add_control( 'pag_style', [
            'label'     => esc_html__('Pagination Style', 'cafe-lite' ),
            'type'      => Controls_Manager::HEADING,
            'condition' => [
                'show_pag' => 'true'
            ],
        ] );
        $this->add_control( 'pag_size', [
            'label'     => esc_html__('Size', 'cafe-lite' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'condition' => [
                'show_pag' => 'true'
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-carousel ul.slick-dots li' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}}',
            ],
        ] );
        $this->add_control('pag_color',[
            'label'     => __( 'Color', 'cafe-lite' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
                'show_pag' => 'true'
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-carousel ul.slick-dots li' => 'background: {{VALUE}};--pag-color:{{VALUE}}'
            ]
        ]);
        $this->add_control('pag_active_color',[
            'label'     => __( 'Active Color', 'cafe-lite' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
                'show_pag' => 'true'
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-carousel ul.slick-dots li:hover,{{WRAPPER}} .cafe-carousel ul.slick-dots li.slick-active' => 'background: {{VALUE}};--pag-color:{{VALUE}}'
            ]
        ]);
        $this->add_control( 'nav_style', [
            'label'     => esc_html__('Navigation Style', 'cafe-lite' ),
            'type'      => Controls_Manager::HEADING,
            'condition' => [
                'show_nav' => 'true'
            ],
        ] );
        $this->add_control( 'nav_size', [
            'label'     => esc_html__('Size', 'cafe-lite' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'condition' => [
                'show_nav' => 'true'
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-carousel .cafe-carousel-btn' => 'font-size:{{SIZE}}{{UNIT}};',
            ],
        ] );
        $this->add_control('nav_color',[
            'label'     => __( 'Color', 'cafe-lite' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
                'show_nav' => 'true'
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-carousel .cafe-carousel-btn' => 'color: {{VALUE}};'
            ]
        ]);
        $this->add_control('nav_active_color',[
            'label'     => __( 'Hover Color', 'cafe-lite' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
                'show_nav' => 'true'
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-carousel .cafe-carousel-btn:hover' => 'color: {{VALUE}};'
            ]
        ]);
        $this->add_control( 'drag_style', [
            'label'     => esc_html__('Drag Label Style', 'cafe-lite' ),
            'type'      => Controls_Manager::HEADING,
            'condition' => [
                'show_drag_label' => 'true'
            ],
        ] );
        $this->add_control( 'drag_size', [
            'label'     => esc_html__('Size', 'cafe-lite' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 300,
                ],
            ],
            'condition' => [
                'show_drag_label' => 'true'
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-drag-label' => 'width:{{SIZE}}{{UNIT}};height:{{SIZE}}{{UNIT}};',
            ],
        ] );
        $this->add_control( 'drag_font_size', [
            'label'     => esc_html__('Font Size', 'cafe-lite' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'condition' => [
                'show_drag_label' => 'true'
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-drag-label' => 'font-size:{{SIZE}}{{UNIT}};',
            ],
        ] );
        $this->add_control('drag_color',[
            'label'     => __( 'Color', 'cafe-lite' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
                'show_drag_label' => 'true'
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-drag-label' => 'color: {{VALUE}};'
            ]
        ]);$this->add_control('drag_bg_color',[
            'label'     => __( 'Background Color', 'cafe-lite' ),
            'type'      => Controls_Manager::COLOR,
            'condition' => [
                'show_drag_label' => 'true'
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-drag-label' => 'background: {{VALUE}};'
            ]
        ]);
		$this->end_controls_section();
	}

	/**
	 * Load style
	 */
	public function get_style_depends() {
		return [ 'cafe-style' ,'slick'];
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
	public function get_script_depends() {
		return [ 'slick', 'cafe-script' ];
	}

	/**
	 * Render
	 */
	protected function render() {
		$settings = array_merge( [ // default settings
			'text_before'  => '',
			'text'        => '',

		], $this->get_settings_for_display() );
		$this->getViewTemplate( 'template', 'carousel-tabs', $settings );
	}
}
