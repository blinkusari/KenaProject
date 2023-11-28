<?php namespace CleverSoft\WpPlugin\Cmm4EPro;

use Elementor\Scheme_Color;
use Elementor\Controls_Manager;

/**
 * Cmm4eMenuPostType
 */
final class Cmm4eDocument
{
    /**
     * Nope constructor
     */
    private function __construct()
    {

    }

    /**
     * Singleton
     */
    static function init()
    {
        static $self = null;

        if (null === $self) {
            $self = new self;
            add_action('elementor/element/wp-post/document_settings/after_section_end', [$self, '_modGeneralSettings'], PHP_INT_MAX);
        }
    }

    /**
     * @internal  Used as a callback
     */
    function _modGeneralSettings($document)
    {
        $post = $document->get_post();

        if ('cmm4e_menu' !== $post->post_type) {
            return;
        }

        $viewers = ['role_anyone' => esc_html__('Anyone', 'clever-mega-menu-pro-for-elementor')];
        $roles = wp_roles()->roles;

        foreach ($roles as $role => $cap) {
            $viewers['role_'.$role] = $cap['name'];
        }

        $document->remove_control('post_title');

        remove_all_actions('elementor/documents/register_controls');

		$document->start_injection([
			'of' => 'post_status'
		]);
		$document->add_control(
			'enable_mega',
			[
				'label' => esc_html__( 'Mega Menu', 'clever-mega-menu-pro-for-elementor' ),
				'type' => Controls_Manager::SWITCHER
			]
		);
		$document->add_control(
			'disable_link',
			[
				'label' => esc_html__( 'Disable Link', 'clever-mega-menu-pro-for-elementor' ),
				'type' => Controls_Manager::SWITCHER
			]
		);

		$document->add_control(
			'hide_on_mobile',
			[
				'label' => esc_html__('Hide on Mobile', 'clever-mega-menu-pro-for-elementor'),
				'type' => Controls_Manager::SWITCHER
			]
		);

		$document->add_control(
			'hide_on_desktop',
			[
				'label' => esc_html__('Hide on Desktop', 'clever-mega-menu-pro-for-elementor'),
				'type' => Controls_Manager::SWITCHER
			]
		);

		$document->add_control(
			'hide_sub_on_mobile',
			[
				'label' => esc_html__('Hide Sub on Mobile', 'clever-mega-menu-pro-for-elementor'),
				'type' => Controls_Manager::SWITCHER
			]
		);

		$document->add_control(
			'cmm4e_icon',
			[
				'label' => esc_html__('Icon', 'clever-mega-menu-pro-for-elementor'),
				'label_block' => true,
				'type' => class_exists('CleverAddonsForElementor\Controls\CleverIcon') ? 'clevericon' : Controls_Manager::ICON
			]
		);

		$document->add_control(
			'viewers',
			[
				'label' => esc_html__('Role & Restrictions', 'clever-mega-menu-pro-for-elementor'),
                'label_block' => true,
				'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $viewers,
                'default' => 'role_anyone'
			]
		);

		$document->add_control(
			'show_badge',
			[
				'label' => esc_html__('Show Badge', 'clever-mega-menu-pro-for-elementor'),
				'type' => Controls_Manager::SWITCHER
			]
		);

		$document->add_control(
			'badge_label',
			[
				'label' => esc_html__('Badge Label', 'clever-mega-menu-pro-for-elementor'),
				'type' => Controls_Manager::TEXT,
                'default' => esc_html__('New', 'clever-mega-menu-pro-for-elementor'),
                'condition' => [
                    'show_badge' => 'yes'
                ]
			]
		);

		$document->add_control(
			'badge_label_color',
			[
				'label' => esc_html__('Badge Label Color', 'clever-mega-menu-pro-for-elementor'),
				'type' => Controls_Manager::COLOR,
        		'selectors' => [
        			'.cmm4e-current-edit-item > .cmm4e-nav-link .menu-item-badge' => 'color: {{VALUE}} !important;',
        		],
                'condition' => [
                    'show_badge' => 'yes',
                    'badge_label!' => ''
                ]
			]
		);

		$document->add_control(
			'badge_background_color',
			[
				'label' => esc_html__('Badge Background Color', 'clever-mega-menu-pro-for-elementor'),
				'type' => Controls_Manager::COLOR,
        		'selectors' => [
        			'.cmm4e-current-edit-item > .cmm4e-nav-link .menu-item-badge' => 'background-color: {{VALUE}} !important;',
        		],
                'condition' => [
                    'show_badge' => 'yes',
                    'badge_label!' => ''
                ]
			]
		);

		$document->add_control(
			'badge_border_radius',
			[
				'label' => esc_html__( 'Badge Border Radius', 'elementor' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px'],
				'selectors' => [
					'.cmm4e-current-edit-item > .cmm4e-nav-link .menu-item-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
				],
                'condition' => [
                    'show_badge' => 'yes',
                    'badge_label!' => ''
                ]
			]
		);

        $document->end_injection();

        $document->start_controls_section(
			'flyout_panel_settings',
			[
				'label' => esc_html__('Flyout Panel Settings', 'clever-mega-menu-pro-for-elementor'),
				'tab' => Controls_Manager::TAB_SETTINGS,
			]
		);

		$document->add_control(
			'flyout_panel_width',
			[
				'label' => esc_html__( 'Width', 'clever-mega-menu-pro-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'vw', 'px'],
				'range' => [
					'%' => [
						'min' => 10,
						'max' => 50
					],
					'px' => [
						'min' => 150,
						'max' => 400
					]
				],
				'default' => [
					'unit' => 'px',
					'size' => 260,
				],
				'selectors' => [
					'.cmm4e-menu-item.cmm4e-current-edit-item > .cmm4e-sub-container' => 'width: {{SIZE}}{{UNIT}} !important;',
				],
			]
		);

        $document->end_controls_section();

		$document->start_controls_section(
			'mega_panel_settings',
			[
				'label' => esc_html__('Mega Panel Settings', 'clever-mega-menu-pro-for-elementor'),
				'tab' => Controls_Manager::TAB_SETTINGS,
			]
		);

		$document->add_control(
			'mega_panel_width',
			[
				'label' => esc_html__( 'Width', 'clever-mega-menu-pro-for-elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['%', 'vw', 'px'],
				'range' => [
					'%' => [
						'min' => 30,
						'max' => 100
					],
					'px' => [
						'min' => 400,
						'max' => 1920
					]
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'#cmm4e-menu-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$document->add_control(
			'relative',
			[
				'label' => esc_html__( 'Relative Menu Item', 'clever-mega-menu-pro-for-elementor' ),
				'type' => Controls_Manager::SWITCHER,
			]
		);
		$document->add_control(
			'position',
			[
				'label' => esc_html__( 'Position Mega Menu', 'clever-mega-menu-pro-for-elementor' ),
				'type' => Controls_Manager::SELECT,
				'default'=> 'left',
				'options'=>[
					'left' => esc_html__('Left', 'clever-mega-menu-pro-for-elementor'),
					'center' => esc_html__('Center', 'clever-mega-menu-pro-for-elementor'),
					'right' => esc_html__('Right', 'clever-mega-menu-pro-for-elementor')
				],
			]
		);

        $document->end_controls_section();
    }
}
Cmm4eDocument::init();
