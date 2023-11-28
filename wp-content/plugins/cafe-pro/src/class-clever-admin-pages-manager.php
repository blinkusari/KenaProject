<?php namespace CafePro;

/**
 * AdminPagesManager
 */
final class AdminPagesManager
{
    /**
     * Nope constructor
     */
    function __construct()
    {
        add_action('admin_menu', [$this, '_add'], 1000);
    }

    /**
     * Add to admin menu
     */
    function _add($context = '')
    {
		add_submenu_page(
			'clever-addons-for-elementor',
			esc_html__('Site Header', 'cafe-pro'),
			esc_html__('Site Header', 'cafe-pro'),
			'edit_posts',
			admin_url('edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=site_header')
		);

		add_submenu_page(
			'clever-addons-for-elementor',
			esc_html__('Site Footer', 'cafe-pro'),
			esc_html__('Site Footer', 'cafe-pro'),
			'edit_posts',
			admin_url('edit.php?post_type=elementor_library&tabs_group=library&elementor_library_type=site_footer')
		);
    }
}

return new AdminPagesManager();
