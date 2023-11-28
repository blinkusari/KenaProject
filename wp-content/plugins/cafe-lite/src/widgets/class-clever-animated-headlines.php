<?php
namespace Cafe\Widgets;

use Elementor\Controls_Manager;
use Cafe\Clever_Custom_Control;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;

/**
 * Clever Animated Headlines
 *
 * @author CleverSoft <hello.cleversoft@gmail.com>
 * @package CAFE
 */
final class CleverAnimatedHeadlines extends CleverWidgetBase {
	/**
	 * @return string
	 */
	function get_name() {
		return 'clever-animated-headlines';
	}

	/**
	 * @return string
	 */
	function get_title() {
		return __('CAFE Animated Headlines', 'cafe-lite' );
	}

	/**
	 * @return string
	 */
	function get_icon() {
		return 'cs-font clever-icon-keyboard-and-hands';
	}

	/**
	 * Register controls
	 */
	protected function register_controls() {
		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'text_item',
			[
				'label'       => __( 'Content', 'cafe-lite' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->start_controls_section( 'settings', [
			'label' => __( 'Settings', 'cafe-lite' )
		] );
        $this->add_control('type',
            [
                'label' => esc_html__('Animation Type', 'cafe-lite'),
                'description' => esc_html__('Select type.', 'cafe-lite'),
                'type' => Controls_Manager::SELECT,
                'default' => 'animated-text',
                'options' => [
                    'animated-text' => esc_html__('Animated Text','cafe-lite'),
                    'high-light' => esc_html__('High Light','cafe-lite'),
                ],
                'separator'   => 'before',
            ]);
        $this->add_control('effect',
            [
                'label' => esc_html__('Effect', 'cafe-lite'),
                'description' => esc_html__('Select animated effect.', 'cafe-lite'),
                'type' => Controls_Manager::SELECT,
                'default' => 'clip',
                'options' => [
                    'clip' => esc_html__('Clip','cafe-lite'),
                    'loading-bar' => esc_html__('Loading Bar','cafe-lite'),
                    'scale' => esc_html__('Scale','cafe-lite'),
                    'slide' => esc_html__('Slide','cafe-lite'),
                    'rotate-1' => esc_html__('Rotate 1','cafe-lite'),
                    'rotate-2' => esc_html__('Rotate 2','cafe-lite'),
                    'rotate-3' => esc_html__('Rotate 3','cafe-lite'),
                    'push' => esc_html__('Push','cafe-lite'),
                    'zoom' => esc_html__('Zoom','cafe-lite'),
                    'random-selected' => esc_html__('Random Selected','cafe-lite'),
                    'marquee' => esc_html__('Marquee ','cafe-lite'),
                ],
                'condition' => [
                    'type' => 'animated-text',
                ],
                'separator'   => 'after',
            ]);
        $this->add_control('high_light_effect',
            [
                'label' => esc_html__('Effect', 'cafe-lite'),
                'description' => esc_html__('Select effect for high light text.', 'cafe-lite'),
                'type' => Controls_Manager::SELECT,
                'default' => 'underline',
                'options' => [
                    'underline' => esc_html__('Underline', 'cafe-lite'),
                    'strike-through' => esc_html__('Strike Through', 'cafe-lite'),
                    'popout' => esc_html__('Pop out', 'cafe-lite'),
                ],
                'condition' => [
                    'type' => 'high-light',
                ],
                'separator' => 'after',
            ]);
		$this->add_control( 'text_before', [
			'label'       => __( 'Text Before', 'cafe-lite' ),
			'type'        => Controls_Manager::TEXT,
			'description' => __( 'This text is fixed, not has effect', 'cafe-lite' ),
            'default'     => esc_html__('This is ','cafe-lite'),
            'label_block' => true,
            'condition' => [
                'type' => 'marquee',
                'operator' => '!=',
            ],
		] );
		$this->add_control( 'text', [
			'label'       => __( 'Animated Text', 'cafe-lite' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'description' => __( 'Set text for animated.', 'cafe-lite' ),
            'condition' => [
                'type' => 'animated-text',
            ],
			'title_field' => '{{{ text_item }}}',
			'default'     => [
				[
					'text_item'          => __( 'Animated Headline 1', 'cafe-lite' ),
				],[
					'text_item'          => __( 'Animated Headline 2', 'cafe-lite' ),
				],[
					'text_item'          => __( 'Animated Headline 3', 'cafe-lite' ),
				],
			],

		] );
        $this->add_control( 'speed', [
            'label'       => __( 'Speed', 'cafe-pro' ),
            'type'        => Controls_Manager::NUMBER,
            'default'     => '1',
            'description' => __( 'Apply only number.', 'cafe-pro' ),
            'separator'   => 'before',
            'condition' => [
                'effect' => 'marquee',
            ],
        ] );
        $this->add_control( 'text_high_light', [
            'label'       => __( 'Text High Light', 'cafe-lite' ),
            'type'        => Controls_Manager::TEXT,
            'description' => __( 'This text will be high light', 'cafe-lite' ),
            'default'     => __( 'high light', 'cafe-lite' ),
            'label_block' => true,
            'condition' => [
                'type' => 'high-light',
            ],
        ] );
        $this->add_control( 'separator', [
            'label'     => esc_html__('Separator', 'cafe-lite' ),
            'type'      => Controls_Manager::TEXT,
            'selectors' => [
                '{{WRAPPER}} .cafe-headline.random-selected .cafe-words-wrapper b:after ' => 'content: "{{VALUE}}";',
            ],
            'condition' => [
                'effect' => 'random-selected',
            ],
        ] );
        $this->add_control( 'text_after', [
            'label'       => __( 'Text After', 'cafe-lite' ),
            'type'        => Controls_Manager::TEXT,
            'description' => __( 'This text is fixed, not has effect', 'cafe-lite' ),
            'default'     => '',
            'label_block' => true,
            'condition' => [
                'type' => 'marquee',
                'operator' => '!=',
            ],
        ] );
        $this->add_control('heading_tag',
            [
                'label' => esc_html__('HTML Tag', 'cafe-lite'),
                'description' => esc_html__('Select a heading tag for the title. Headings are defined with H1 to H6 tags.', 'cafe-lite'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h3',
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'p' => 'p',
                    'div' => 'div',
                    'span' => 'span',
                ],
                'separator'   => 'before',
            ]);

		$this->end_controls_section();

		$this->start_controls_section( 'Style settings', [
			'label' => __( 'Style', 'cafe-lite' ),
            'tab'   => Controls_Manager::TAB_STYLE,
		] );
        $this->add_responsive_control(
            'text_align',
            [
                'label'     => __( 'Text Align', 'cafe-lite' ),
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
                    '{{WRAPPER}} .cafe-headline' => 'text-align: {{VALUE}};'
                ]
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .cafe-headline',
                'scheme'   => Typography::TYPOGRAPHY_1,
            ]
        );
		$this->add_control( 'color_fix_text', [
			'label'     => __( 'Color', 'cafe-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cafe-headline' => 'color: {{COLOR}};',
			],
		] );
		$this->add_control('heading_headline_style',[
            'label'     => __( 'Animated text', 'cafe-lite' ),
			'type'      => Controls_Manager::HEADING,
            'separator'   => 'before',
           ]);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'headline_typography',
                'selector' => '{{WRAPPER}} .cafe-headline .cafe-words-wrapper',
                'scheme'   => Typography::TYPOGRAPHY_1,
            ]
        );
		$this->add_control( 'color', [
			'label'     => __( 'Color', 'cafe-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cafe-headline .cafe-words-wrapper' => 'color: {{COLOR}};--color:{{COLOR}}',
			],
		] );
		$this->add_control( 'active_color', [
			'label'     => __( 'Active Color', 'cafe-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cafe-headline .cafe-words-wrapper' => '--active-color:{{COLOR}}',
			],
            'condition' => [
                'effect' => 'random-selected',
            ],
		] );
		$this->add_control( 'dot_color', [
			'label'     => __( 'Dot Color', 'cafe-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cafe-headline .cafe-words-wrapper b:before' => 'background:{{COLOR}}',
			],
            'condition' => [
                'effect' => 'marquee',
            ],
		] );
        $this->add_responsive_control( 'dot_size', [
            'label'     => esc_html__('Dot Size', 'cafe-lite' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-headline .cafe-words-wrapper b:before ' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'effect' => 'marquee',
            ],
        ] );$this->add_control( 'sep_space', [
            'label'     => esc_html__('Separator Space', 'cafe-lite' ),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-headline.random-selected .cafe-words-wrapper b:after ' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
            ],
            'condition' => [
                'effect' => 'random-selected',
            ],
        ] );

		$this->add_control( 'loading_bar_color', [
			'label'     => __( 'Loading bar Color', 'cafe-lite' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cafe-headline.loading-bar .cafe-words-wrapper::after' => 'background-color: {{COLOR}}',
			],
            'condition' => [
                'type' => 'animated-text',
                'effect' => 'loading-bar',
            ],
		] );
        $this->add_responsive_control('dimensions', [
            'label' => esc_html__('Content Padding', 'cafe-lite'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', '%', 'em'],
            'separator'   => 'before',
            'condition' => [
                'effect' => 'marquee'
            ],
            'selectors' => [
                '{{WRAPPER}} .cafe-words-wrapper b' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);
		$this->end_controls_section();
	}

	/**
	 * Load style
	 */
	public function get_style_depends() {
		return [ 'cafe-style' ];
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
		return [ 'typed', 'cafe-script' ];
	}

	/**
	 * Render
	 */
	protected function render() {
		$settings = array_merge( [ // default settings
			'text_before'  => '',
			'text'        => '',

		], $this->get_settings_for_display() );

		$this->add_inline_editing_attributes( 'text_before' );
		$this->add_render_attribute( 'text_before', 'class', 'cafe-headline-text-before' );
		$this->add_inline_editing_attributes( 'text_after' );
		$this->add_render_attribute( 'text_after', 'class', 'cafe-headline-text-after' );

		$this->getViewTemplate( 'template', 'animated-headlines', $settings );
	}
}
