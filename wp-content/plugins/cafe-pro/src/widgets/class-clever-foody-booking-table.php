<?php 
namespace Cafe\Widgets;

use Elementor\Controls_Manager;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
/**
 * CleverFoodyBookingTable
 *
 * @author CleverSoft <hello.cleversoft@gmail.com>
 * @package CAFE
 */

final class CleverFoodyBookingTable extends CleverWidgetBase
{
    /**
     * @return string
     */
    function get_name()
    {
        return 'clever-foofy-booking-table';
    }

    /**
     * @return string
     */
    function get_title()
    {
        return __('CAFE Foody Booking Table', 'cafe-pro');
    }

    /**
     * @return string
     */
    function get_icon()
    {
        return 'cs-font clever-icon-list-2';
    }
    
    /**
     * Register controls
     */
    protected function register_controls()
    {
        
        $this->start_controls_section(
            'section_title', [
            'label' => __('Foody Booking Table', 'cafe-pro')
            ]);
            $this->add_control('id_restaurant', [
                'label' => esc_html__('OpenTable Restaurant ID', 'cafe-pro'),
                'type' => Controls_Manager::TEXT,
                'default'=>'72394',
            ]);
            $this->add_control('domain', [
                'label'         => __('Country', 'cafe-pro'),
                'type'          => Controls_Manager::SELECT,
                'default'       => 'com',
                'options' => [
                    'com'   =>__('Global / U.S.', 'cvca'),
                    'de'    =>__('Germany', 'cvca'),
                    'co.uk' =>__('United Kingdom', 'cvca'),
                    'jp'    =>__('Japan', 'cvca'),
                    'com.mx'=>__('Mexico', 'cvca'),
                    'domain_other'=>__('Other', 'cvca'),
                ],
            ]);
            $this->add_control('domain_other', [
                'label'         => __('Country Domain', 'cafe-pro'),
                'description'   => __('', 'cafe-pro'),
                'type'          => Controls_Manager::TEXT,
                'default'       => '',
                'condition'     => [
                    'domain' => 'domain_other',
                ],
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
        return ['slick', 'cafe-script'];
    }
    /**
     * Render
     */
    protected function render()
    {
        // default settings
        $settings = array_merge([ 
            'id_restaurant'          => '',
            'domain'                 => '',
            'domain_other'           => '',
            
        ], $this->get_settings_for_display());
        $this->getViewTemplate('template', 'foody-booking-table', $settings);
    }
}
    
