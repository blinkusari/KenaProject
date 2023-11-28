<?php namespace CleverSoft\WpPlugin\Cmm4EPro;

use WP_Post;

/**
 * MenuLocationPostType
 */
final class MenuLocationPostType
{
    /**
     * Post type
     *
     * @var    object
     *
     * @see    https://developer.wordpress.org/reference/functions/register_post_type/
     */
    public $post_type;

    /**
     * Constructor
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
            add_action('init', [$self, '_register'], 10, 0);
            add_action('post_updated_messages', [$self, '_notify']);
            add_action('after_setup_theme', [$self, '_addMenuLocations'], 10, 0);
            add_filter('post_row_actions', [$self, '_remove_quick_edit'], PHP_INT_MAX, 2);
            add_filter('manage_cmm4e_menu_location_posts_columns', [$self, '_add_shortcode_column']);
            add_action('manage_cmm4e_menu_location_posts_custom_column', [$self, '_the_shortcode_cell_content'], 10, 2);
        }
    }

    /**
     * Register portfolio post type
     *
     * @internal    Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     */
    function _register()
    {
        $labels = array(
            'name'          => esc_html__('Menu Locations', 'clever-mega-menu-pro-for-elementor'),
            'singular_name' => esc_html__('Menu Location', 'clever-mega-menu-pro-for-elementor'),
            'all_items'     => esc_html__('Menu Locations', 'clever-mega-menu-pro-for-elementor'),
            'add_new'       => esc_html__('Add New Menu Location', 'clever-mega-menu-pro-for-elementor'),
            'add_new_item'  => esc_html__('Add New Menu Location', 'clever-mega-menu-pro-for-elementor'),
            'edit_item'     => esc_html__('Edit Menu Location', 'clever-mega-menu-pro-for-elementor')
        );

        $args = array(
            'labels'        => $labels,
            'public'        => false,
            'show_ui'       => true,
            'show_in_menu'  => 'cmm4e-dashboard-page',
            'supports'      => ['title']
        );

        $this->post_type = register_post_type('cmm4e_menu_location', $args);
    }

    /**
     * Do notification
     *
     * @internal  Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     *
     * @see  https://developer.wordpress.org/reference/hooks/post_updated_messages/
     */
    function _notify($messages)
    {
        $messages['cmm4e_menu_location'] = array(
            0  => '', // Unused. Messages start at index 1.
            1  => esc_html__('Menu location updated.', 'clever-mega-menu-pro-for-elementor'),
            2  => esc_html__('Custom field updated.', 'clever-mega-menu-pro-for-elementor'),
            3  => esc_html__('Custom field deleted.', 'clever-mega-menu-pro-for-elementor'),
            4  => esc_html__('Menu location updated.', 'clever-mega-menu-pro-for-elementor'),
            5  => isset($_GET['revision']) ? esc_html__('Menu location restored to revision from', 'clever-mega-menu-pro-for-elementor') . ' ' . wp_post_revision_title(absint($_GET['revision'])) : false,
            6  => esc_html__('Menu location published.', 'clever-mega-menu-pro-for-elementor'),
            7  => esc_html__('Menu location saved.', 'clever-mega-menu-pro-for-elementor'),
            8  => esc_html__('Menu location submitted.', 'clever-mega-menu-pro-for-elementor'),
            9  => esc_html__('Menu location scheduled.', 'clever-mega-menu-pro-for-elementor'),
            10 => esc_html__('Menu location draft updated.', 'clever-mega-menu-pro-for-elementor')
        );

        return $messages;
    }

    /**
     * Disable quick edit
     *
     * @internal    Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     *
     * @see    https://developer.wordpress.org/reference/hooks/post_row_actions-5/
     */
    function _remove_quick_edit($actions, WP_Post $post)
    {
        if ('cmm4e_menu_location' !== $post->post_type) {
            return $actions;
        }

        unset($actions['inline hide-if-no-js']);

        return $actions;
    }

    /**
     * Add shortcode column on posts list table
     *
     * @internal    Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     *
     * @param    array    $columns    Default columns.
     *
     * @return    array    $columns    New columns.
     */
    function _add_shortcode_column($columns)
    {
        $date = $columns['date'];

        unset( $columns['date'] );

        $columns['shortcode'] = esc_html__('Shortcode', 'clever-mega-menu-pro-for-elementor');

        $columns['date'] = $date;

        return $columns;
    }

    /**
     * Get shortcode column content
     *
     * @internal    Used as a callback. PLEASE DO NOT RECALL THIS METHOD DIRECTLY!
     *
     * @param    string    $col        Column slug.
     * @param    int       $post_id    Current post's ID.
     */
    function _the_shortcode_cell_content($col, $post_id)
    {
        $post = get_post($post_id);

        echo '[cmm4e loc="' . $post->post_name . '"]';
    }

    /**
     * @internal Used as a callback.
     */
    function _addMenuLocations()
    {
        global $wpdb;

        $locations = $wpdb->get_results("SELECT post_name, post_title FROM $wpdb->posts WHERE post_type='cmm4e_menu_location' AND post_status='publish'");

        if (!empty($locations)) {
            foreach ($locations as $location) {
                register_nav_menu($location->post_name, $location->post_title);
            }
        }
    }
}
MenuLocationPostType::init();
