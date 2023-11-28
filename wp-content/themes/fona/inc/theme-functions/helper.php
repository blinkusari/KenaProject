<?php
/**
 * Password form template for detail post
 * @uses: hook to the_password_form
 * @return html of password form
 * */
if (!function_exists('zoo_password_form')) {
    function zoo_password_form()
    {
        global $post;
        $zoo_id = 'pwbox-' . (empty($post->ID) ? rand() : $post->ID);
        $zoo_form = '<div class="zoo-form-login"><form action="' . esc_url(site_url('wp-login.php?action=postpass', 'login_post')) . '" method="post"><h4>
    ' . esc_html__('To view this protected post, enter the password below:', 'fona') . '</h4>
    <input name="post_password" id="' . $zoo_id . '" type="password" size="20" maxlength="20" placeholder="' . esc_attr__('Enter Password', 'fona') . ' " /><br><input type="submit" name="Submit" value="' . esc_attr__('Submit', 'fona') . '" />
    </form></div>
    ';
        return $zoo_form;
    }
}
add_filter('the_password_form', 'zoo_password_form');

/**
 * Site layout
 * @uses: call function zoo_site_layout()
 * @return site layout
 * */
if (!function_exists('zoo_site_layout')) {
    function zoo_site_layout()
    {
        $zoo_site_layout = get_theme_mod('zoo_site_layout', 'normal');
        if (is_page() && get_post_meta(get_the_ID(), 'zoo_site_layout', true) != '' && get_post_meta(get_the_ID(), 'zoo_site_layout', true) != 'inherit') {
            $zoo_site_layout = get_post_meta(get_the_ID(), 'zoo_site_layout', true);
        }
        if (isset($_GET['zoo_site_layout'])) {
            $zoo_site_layout = $_GET['zoo_site_layout'];
        }
        return $zoo_site_layout;
    }
}
/**
 * Site full width
 * @uses: call function zoo_site_width()
 * @return css for site full width
 * */
if (!function_exists('zoo_site_width')) {
    function zoo_site_width()
    {
        $zoo_site_width = '';
        if (zoo_site_layout() != 'full-width') {
            $zoo_site_width = get_theme_mod('zoo_site_max_width', '1530');
            if (is_page() && get_post_meta(get_the_ID(), 'zoo_site_max_width', true) != '') {
                $zoo_site_width = get_post_meta(get_the_ID(), 'zoo_site_max_width', true);
            }
            if (isset($_GET['zoo_site_max_width'])) {
                $zoo_site_width = $_GET['zoo_site_max_width'];
            }
        }
        if ($zoo_site_width == 0 || $zoo_site_width == '') {
            $zoo_site_width = '100%;padding-left:40px;padding-right:40px';
        } else {
            $zoo_site_width = $zoo_site_width . 'px';
        }
        return $zoo_site_width;
    }
}

/**
 * Check single post sidebar
 * @uses: call function zoo_single_post_sidebar()
 * @return sidebar option
 * */
if (!function_exists('zoo_single_post_sidebar')) {
    function zoo_single_post_sidebar()
    {
        $sidebar = get_post_meta(get_the_id(), 'zoo_blog_single_sidebar_config', true);
        if ($sidebar != 'inherit' && $sidebar) {
            return $sidebar;
        } else {
            return get_theme_mod('zoo_blog_single_sidebar_config', 'none');
        }
    }
}
/**
 * Check GDPG plugin is installed
 * @uses: call function zoo_gdpr_consent()
 * @return boolean
 * */
if (!function_exists('zoo_gdpr_consent')) {
    function zoo_gdpr_consent()
    {
        if (class_exists('GDPR')) {
            return GDPR::get_consent_checkboxes();
        } else {
            return false;
        }
    }
}
/**
 * Get Preset Color
 * @uses: call function zoo_theme_preset()
 * @return color
 * */
if (!function_exists('zoo_theme_preset')) {
    function zoo_theme_preset()
    {
        $preset = get_theme_mod('zoo_color_preset', 'default');
        if (isset($_GET['preset'])) {
            $preset = $_GET['preset'];
        }
        switch ($preset) {
            case 'custom':
                $preset = get_theme_mod('zoo_primary_color', '');
                break;
            case 'black':
                $preset = '#000';
                break;
            case 'blue':
                $preset = '#0366d6';
                break;
            case 'red':
                $preset = '#fc2929';
                break;
            case 'yellow':
                $preset = '#FFFF00';
                break;
            case 'green':
                $preset = '#269f42';
                break;
            case 'grey':
                $preset = '#778899';
                break;
            default:
                $preset = '';
                break;
        }
        return $preset;
    }
}
/**
 * Get list image sizes
 * @return array image size
 */
if(!function_exists('zoo_get_image_sizes')) {
	function zoo_get_image_sizes() {
		global $_wp_additional_image_sizes;
		$output = array();
		$imgs_size = get_intermediate_image_sizes();
		foreach ( $imgs_size as $size ) :
			if ( in_array( $size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) :
				$output[ $size ] = ucwords( str_replace( array( '_', ' - ' ), array(
						' ',
						' '
					), $size ) ) . ' (' . get_option( "{$size}_size_w" ) . 'x' . get_option( "{$size}_size_h" ) . ')';
			elseif ( isset( $_wp_additional_image_sizes[ $size ] ) ) :
				$output[ $size ] = ucwords( str_replace( array( '_', '-' ), array(
						' ',
						' '
					), $size ) ) . ' (' . $_wp_additional_image_sizes[ $size ]['width'] . 'x' . $_wp_additional_image_sizes[ $size ]['height'] . ')';
			endif;
		endforeach;
		$output['full'] = esc_html__( 'Full', 'fona' );

		return $output;
	}
}
/**
 * Get all pages
 * @return array pages
 * */
function zoo_get_pages() {
	$pages     = array();
	$all_pages = get_posts( array(
			'posts_per_page' => - 1,
			'post_type'      => 'page',
		)
	);
	$pages[0]=esc_html__('None','fona');
	if ( ! empty( $all_pages ) && ! is_wp_error( $all_pages ) ) {
		foreach ( $all_pages as $page ) {
			$pages[ $page->ID ] = $page->post_title;
		}
	}
	return $pages;
}