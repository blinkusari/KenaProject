<?php
/**
 * Theme functions
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2018 Zootemplate
 
 * @des         All custom functions of theme can add here. Dev can add or remove function.
 */

/**
 * Edit the except length characters.
 *
 */
if (!function_exists('zoo_custom_excerpt_length')) {
    function zoo_custom_excerpt_length()
    {
        return get_theme_mod('zoo_loop_excerpt_length', '20');
    }
}
add_filter('excerpt_length', 'zoo_custom_excerpt_length', 999);
/**
 * Change excerpt more
 *
 */
if (!function_exists('zoo_excerpt_more')) {
    function zoo_excerpt_more($more)
    {
        return '...';
    }
}
add_filter('excerpt_more', 'zoo_excerpt_more');

/**
 * Custom COMMENTS an Pings
 * Change template comment of wordpress by list comment of theme
 * @uses   use callback of wordpress comment
 * @return custom template list comment of theme
 **/
if (!function_exists('zoo_custom_comments')) {
    function zoo_custom_comments($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        $GLOBALS['comment_depth'] = $depth;
        ?>
        <li id="comment-<?php comment_ID() ?>" <?php comment_class('clearfix') ?>>
        <div class="comment-wrap clearfix">
            <div class="comment-avatar">
                <?php if (function_exists('get_avatar')) {
                    echo wp_kses(get_avatar($comment, '50'), array('img' => array('class' => array(), 'width' => array(), 'height' => array(), 'alt' => array(), 'src' => array())));
                } ?>
            </div>
            <div class="comment-content">
                <div class="comment-meta">
                    <?php
                    printf('<h6 class="author-name">%1$s</h6>',
                        get_comment_author_link()
                    );
                    echo '<span class="date-post">' . esc_html(get_comment_date('', get_comment_ID())) . '</span>';
                    ?>
                </div>
                <?php if ($comment->comment_approved == '0') wp_kses(__("\t\t\t\t\t<span class='unapproved'>" . esc_html__('Your comment is awaiting moderation.', 'fona') . "</span>\n", 'fona'), array('span' => array('class' => array()))); ?>
                <div class="comment-body">
                    <?php comment_text() ?>
                </div>
                <div class="comment-meta-actions">
                    <?php
                    edit_comment_link(esc_html__('Edit', 'fona'), '<span class="edit-link">', '</span>');
                    ?>
                    <?php if ($args['type'] == 'all' || get_comment_type() == 'comment') :
                        comment_reply_link(array_merge($args, array(
                            'reply_text' => esc_html__('Reply', 'fona'),
                            'login_text' => esc_html__('Log in to reply.', 'fona'),
                            'depth' => $depth,
                            'before' => '<span class="comment-reply">',
                            'after' => '</span>'
                        )));
                    endif; ?>
                </div>
            </div>
        </div>
    <?php }
}
if (!function_exists('zoo_custom_pings')) {
    function zoo_custom_pings($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        $GLOBALS['comment_depth'] = $depth;
        ?>
    <li id="comment-<?php comment_ID() ?>" <?php comment_class('clearfix') ?>>
        <div class="comment-wrap clearfix">
            <div class="comment-content">
                <div class="comment-meta">
                    <?php
                    printf('<h6 class="author-name">%1$s</h6>',
                        get_comment_author_link()
                    );
                    ?>
                </div>
                <?php if ($comment->comment_approved == '0') wp_kses("<span class='unapproved'>" . esc_html__('Your comment is awaiting moderation.', 'fona') . "</span>", array('span' => array('class' => array()))); ?>
                <div class="comment-meta-actions">
                    <?php
                    edit_comment_link(esc_html__('Edit', 'fona'), '<span class="edit-link">', '</span>');
                    ?>
                    <?php if ($args['type'] == 'all' || get_comment_type() == 'comment') :
                        comment_reply_link(array_merge($args, array(
                            'reply_text' => esc_html__('Reply', 'fona'),
                            'login_text' => esc_html__('Log in to reply.', 'fona'),
                            'depth' => $depth,
                            'before' => '<span class="comment-reply">',
                            'after' => '</span>'
                        )));
                    endif; ?>
                </div>
            </div>
        </div>
    <?php }
}
/**
 * Theme search form
 * Override default search form of wordpress by custom search form of theme
 * @uses apply_filters to get_search_form
 * @return Custom search form of theme.
 *
 */
if (!function_exists('zoo_custom_search_form')) {
    function zoo_custom_search_form($form)
    {
        $form = '<form role="search" method="get" id="searchform-' . esc_attr(mt_rand()) . '" class="custom-search-form search-form" action="' . esc_url(home_url('/')) . '" >
                <input type="text" placeholder="' . esc_attr__('Search…', 'fona') . '"  class="search-field" value="' . esc_attr(get_search_query()) . '" name="s" id="s-' . esc_attr(mt_rand()) . '" />
                <button type="submit" value="' . esc_attr__('Search', 'fona') . '"><i class="zoo-icon-search"></i></button>
                </form>';

        return $form;
    }
}
add_filter('get_search_form', 'zoo_custom_search_form');

/**
 * Remove section unused.
 **/
function zoo_site_customizer($wp_customize)
{
    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_section('header_image');
}

add_action('customize_register', 'zoo_site_customizer');

/**
 * Add preset for footer.
 * */
if (!function_exists('zoo_custom_footer_preset')) {
    function zoo_custom_footer_preset()
    {
        return [
            'default' => esc_html__('Default', 'fona'),
            'light' => esc_html__('Light', 'fona'),
            'dark' => esc_html__('Dark', 'fona'),
        ];
    }
}
add_filter('zoo_footer_preset', 'zoo_custom_footer_preset', 1);

/**
 * Remove Contact Form resource, load when page have contact form.
 * */
if (class_exists('WPCF7')) {
    add_filter('wpcf7_load_js', '__return_false');
    add_filter('wpcf7_load_css', '__return_false');
    if (!function_exists('zoo_cf7_shortcode_scripts')) {
        function zoo_cf7_shortcode_scripts()
        {
            global $post;
            if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'contact-form-7')) {
                if (function_exists('wpcf7_enqueue_scripts')) {
                    wpcf7_enqueue_scripts();
                }
                if (function_exists('wpcf7_enqueue_styles')) {
                    wpcf7_enqueue_styles();
                }
            }
        }
    }
    add_action('wp_enqueue_scripts', 'zoo_cf7_shortcode_scripts');
}

/**
 * Add site meta for share.
 * */
if (!function_exists('zoo_meta')) {
    function zoo_meta()
    {
        global $wp;
        $zoo_url = home_url($wp->request);
        $zoo_meta = '';
        $zoo_img = get_theme_mod('zoo_site_featured_imaged', '');
        $zoo_img = $zoo_img != '' ? $zoo_img : get_theme_mod('custom_logo');
        $zoo_img = wp_get_attachment_url($zoo_img);
        $zoo_title = get_bloginfo('name');
        $zoo_des = get_bloginfo('description');
        if (!is_front_page()) {
            if (is_page() || is_single()) {
                $zoo_title = get_the_title();
                $zoo_des = apply_filters('the_excerpt', get_post_field('post_excerpt', get_the_ID()));;
                if (has_post_thumbnail()) {
                    $zoo_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                }
            }
            if (is_archive()) {
                $zoo_title = get_the_archive_title();
                $zoo_des = get_the_archive_description();
            }
            if (class_exists('WooCommerce')) {
                if (is_shop()) {
                    if (get_theme_mod('zoo_shop_cover_img_bg', '') != '') {
                        $zoo_img = get_theme_mod('zoo_shop_cover_img_bg', '');
                    }
                    if (get_theme_mod('zoo_shop_cover_text', '') != '') {
                        $zoo_title = get_theme_mod('zoo_shop_cover_text', '');
                    }
                }
                if (is_product_category()) {
                    global $wp_query;
                    $cat = $wp_query->get_queried_object();
                    if ($cat->description != '') {
                        $zoo_des = $cat->description;
                    }
                    $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
                    if ($thumbnail_id) {
                        $zoo_img = wp_get_attachment_url($thumbnail_id);
                    }
                }
            }
        }
        $zoo_meta .= '<meta property="og:title" content="' . wp_strip_all_tags($zoo_title) . '">
    <meta property="og:description" content="' . esc_attr(strip_tags($zoo_des)) . '">
    <meta property="og:image" content="' . esc_url($zoo_img) . '">
    <meta property="og:url" content="' . esc_url($zoo_url) . '">';
        echo ent2ncr($zoo_meta);
    }
}
if(get_theme_mod('zoo_enable_site_meta',0)==1) {
	add_action( 'wp_head', 'zoo_meta' );
}
/**
 * Change categories count
 */
add_filter('wp_list_categories', 'zoo_cat_count_span');
add_filter('get_archives_link', 'zoo_cat_count_span');
if (!function_exists('zoo_cat_count_span')) {
    function zoo_cat_count_span($links)
    {
        $links = str_replace('</a>&nbsp;(', '</a> <span class="count">', $links);
        $links = str_replace('</a> (', '</a> <span  class="count">', $links);
        $links = str_replace(')', '</span>', $links);
        return $links;
    }
}
/**
 * Add site meta for share.
 * */
if (!function_exists('zoo_meta')) {
    function zoo_meta()
    {
        global $wp;
        $zoo_url = home_url($wp->request);
        $zoo_meta = '';
        $zoo_img = get_theme_mod('zoo_site_featured_imaged', '');
        $zoo_img = $zoo_img != '' ? $zoo_img : get_theme_mod('custom_logo');
        $zoo_img = wp_get_attachment_url($zoo_img);
        $zoo_title = get_bloginfo('name');
        $zoo_des = get_bloginfo('description');
        if (!is_front_page()) {
            if (is_page() || is_single()) {
                $zoo_title = get_the_title();
                $zoo_des = apply_filters('the_excerpt', get_post_field('post_excerpt', get_the_ID()));;
                if (has_post_thumbnail()) {
                    $zoo_img = get_the_post_thumbnail_url(get_the_ID(), 'full');
                }
            }
            if (is_archive()) {
                $zoo_title = get_the_archive_title();
                $zoo_des = get_the_archive_description();
            }
            if (class_exists('WooCommerce')) {
                if (is_shop()) {
                    if (get_theme_mod('zoo_shop_cover_img_bg', '') != '') {
                        $zoo_img = get_theme_mod('zoo_shop_cover_img_bg', '');
                    }
                    if (get_theme_mod('zoo_shop_cover_text', '') != '') {
                        $zoo_title = get_theme_mod('zoo_shop_cover_text', '');
                    }
                }
                if (is_product_category()) {
                    global $wp_query;
                    $cat = $wp_query->get_queried_object();
                    if ($cat->description != '') {
                        $zoo_des = $cat->description;
                    }
                    $thumbnail_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
                    if ($thumbnail_id) {
                        $zoo_img = wp_get_attachment_url($thumbnail_id);
                    }
                }
            }
        }
        $zoo_meta .= '<meta property="og:title" content="' . wp_strip_all_tags($zoo_title) . '">
    <meta property="og:description" content="' . esc_attr(strip_tags($zoo_des)) . '">
    <meta property="og:image" content="' . esc_url($zoo_img) . '">
    <meta property="og:url" content="' . esc_url($zoo_url) . '">';
        echo ent2ncr($zoo_meta);
    }
}
add_action('wp_head', 'zoo_meta');
/**
 * Add custom image size
 */
add_image_size('zoo-medium-crop', 450, 450, true);
add_filter('image_size_names_choose', 'zoo_custom_img_sizes');
if(!function_exists('zoo_custom_img_sizes')){
	function zoo_custom_img_sizes($imgsizes)
	{
		return array_merge($imgsizes, array(
			'zoo-medium-crop' => esc_html__('Custom Medium Crop', 'fona'),
		));
	}
}