<?php namespace CleverSoft\WpPlugin\Cmm4EPro;

/**
 * Register cmm4e shortcode
 */
add_shortcode('cmm4e', function($atts)
{
    $args = [
        'echo' => true,
        'theme_location' => $atts['loc']
    ];

    if (!empty($atts['skin'])) {
        $args['cmm4e_menu_theme'] = strval($atts['skin']);
    }

    return wp_nav_menu($args);
});
