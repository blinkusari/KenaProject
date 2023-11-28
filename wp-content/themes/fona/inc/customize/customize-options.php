<?php
/**
 * Import customize style
 *
 * @return Css inline at header.
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2018 Zootemplate
 
 */

// Render css customize
add_action('wp_enqueue_scripts', 'zoo_customze_options_inline', 99999);

if( !function_exists('zoo_customze_options_inline')){
    function zoo_customze_options_inline(){
        wp_add_inline_style('zoo-styles', zoo_customize_options());
    }
}

if (!function_exists('zoo_customize_options')) {
    function zoo_customize_options()
    {
        
        /*===============Theme Customize Style============== */
            $css = null;
            // Accent color
            $zoo_color_preset           = get_theme_mod('zoo_color_preset');

            $zoo_primary_color          = '#000';
            $zoo_site_color             = '#959595';
            $zoo_site_link_color        = '#000';
            $zoo_site_link_color_hover  = '#959595';
            $zoo_site_heading_color     = '#000';
            switch ($zoo_color_preset) {
                case 'black':
                    $zoo_primary_color          = '#000';
                    $zoo_site_color             = '#424242';
                    $zoo_site_link_color        = '#959595';
                    $zoo_site_link_color_hover  = '#FF3738';
                    $zoo_site_heading_color     = '#252525';
                    break;
                case 'blue':
                    $zoo_primary_color          = '#0000FF';
                    $zoo_site_color             = '#424242';
                    $zoo_site_link_color        = '#959595';
                    $zoo_site_link_color_hover  = '#FF3738';
                    $zoo_site_heading_color     = '#252525';
                    break;
                case 'red':
                    $zoo_primary_color          = '#FF0000';
                    $zoo_site_color             = '#424242';
                    $zoo_site_link_color        = '#959595';
                    $zoo_site_link_color_hover  = '#FF3738';
                    $zoo_site_heading_color     = '#252525';
                    break;
                case 'yellow':
                    $zoo_primary_color          = '#FFFF00';
                    $zoo_site_color             = '#424242';
                    $zoo_site_link_color        = '#959595';
                    $zoo_site_link_color_hover  = '#FF3738';
                    $zoo_site_heading_color     = '#252525';
                    break;
                case 'green':
                    $zoo_primary_color          = '#008000';
                    $zoo_site_color             = '#424242';
                    $zoo_site_link_color        = '#959595';
                    $zoo_site_link_color_hover  = '#FF3738';
                    $zoo_site_heading_color     = '#252525';
                    break;
                case 'grey':
                    $zoo_primary_color          = '#808080';
                    $zoo_site_color             = '#424242';
                    $zoo_site_link_color        = '#959595';
                    $zoo_site_link_color_hover  = '#FF3738';
                    $zoo_site_heading_color     = '#252525';
                    break;
                case 'custom':
                    $zoo_primary_color          = get_theme_mod('zoo_primary_color');
                    $zoo_site_color             = get_theme_mod('zoo_site_color');
                    $zoo_site_link_color        = get_theme_mod('zoo_site_link_color');
                    $zoo_site_link_color_hover  = get_theme_mod('zoo_site_link_color_hover');
                    $zoo_site_heading_color     = get_theme_mod('zoo_site_heading_color');
                    break;
                default:

                    break;
            }

            /* Primary color page option */
            if(get_post_meta(get_the_ID(),'zoo_primary_color', true)){
                $zoo_primary_color = get_post_meta(get_the_ID(),'zoo_primary_color', true);
            }
            // Primary color
            $css .= '
                .wp-block-search__label,
                body a,
                .widget ul li .count,
                .widget ul li .count:before,
                .widget ul li .count:after,
            .list-cat a:hover
            {color:'.$zoo_primary_color.'}';
            // Site color
            $css .= '
                body{color:'.$zoo_site_color.'}';

            // Site link color
            $css .= '
                body a{color:'.$zoo_site_link_color.'}';

            // Site link hover color
            $css .= '
                body a:hover,
                .post-loop-item .zoo-post-inner .entry-title a:hover,
                .entry-content a:hover,
                .sidebar.widget-area .widget ul li a:hover
            
            {color:'.$zoo_site_link_color_hover.'}';

            $css .= '.main-content .error-404 svg{fill:'.$zoo_primary_color.'}';

            // Button
            $zoo_button_color = get_theme_mod('zoo_button_color','#fff');
            $zoo_button_background_color = get_theme_mod('zoo_button_background_color','#000');
            $zoo_button_border_color = get_theme_mod('zoo_button_border_color','#000');

            $zoo_button_color_hover = get_theme_mod('zoo_button_color_hover','#fff'); 
            $zoo_button_background_color_hover = get_theme_mod('zoo_button_background_color_hover','#959595');
            $zoo_button_border_color_hover = get_theme_mod('zoo_button_border_color_hover','#959595');

            if($zoo_button_color){
                $css .= '
                #zoo-theme-dev-actions .button,
                .woocommerce .woocommerce-cart-form .button,
                .main-content .widget .tagcloud a,
                .wpcf7-form .wpcf7-submit,
                .woocommerce #respond input#submit, 
                .woocommerce-checkout #payment .button, 
                .woocommerce-checkout #payment .button, 
                .woocommerce-checkout #payment .added_to_cart, 
                #add_payment_method .wc-proceed-to-checkout a.checkout-button, 
                .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, 
                .woocommerce .widget_shopping_cart .buttons a,
                #zoo-theme-dev-actions .button,
                .btn, 
                input[type="submit"], 
                .button,.wp-block-search__button, 
                button, 
                .wp-block-button.is-style-squared .wp-block-button__link, 
                .wp-block-button .wp-block-button__link,
                .entry-content .wp-block-file__button
                  
                {color:'.$zoo_button_color.'}';
            }
            if($zoo_button_background_color){
                $css .= '
                #zoo-theme-dev-actions .button,
                .woocommerce .woocommerce-cart-form .button,
                .main-content .widget .tagcloud a,
                .wpcf7-form .wpcf7-submit,
                .woocommerce #respond input#submit, 
                .woocommerce-checkout #payment .button, 
                .woocommerce-checkout #payment .button, 
                .woocommerce-checkout #payment .added_to_cart, 
                #add_payment_method .wc-proceed-to-checkout a.checkout-button, 
                .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, 
                .woocommerce .widget_shopping_cart .buttons a,
                #zoo-theme-dev-actions .button,
                .btn, 
                input[type="submit"], 
                .button, .wp-block-search__button,
                button, 
                .wp-block-button.is-style-squared .wp-block-button__link, 
                .wp-block-button .wp-block-button__link,
                .entry-content .wp-block-file__button
                
                {background:'.$zoo_button_background_color.'}';
            }
            if($zoo_button_border_color){
                $css .= '
                #zoo-theme-dev-actions .button,
                .woocommerce .woocommerce-cart-form .button,
                .main-content .widget .tagcloud a,
                .wpcf7-form .wpcf7-submit,
                .woocommerce #respond input#submit, 
                .woocommerce-checkout #payment .button, 
                .woocommerce-checkout #payment .button, 
                .woocommerce-checkout #payment .added_to_cart, 
                #add_payment_method .wc-proceed-to-checkout a.checkout-button, 
                .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, 
                .woocommerce .widget_shopping_cart .buttons a,
                #zoo-theme-dev-actions .button,
                .btn, 
                input[type="submit"], 
                .button, .wp-block-search__button,
                button, 
                .wp-block-button.is-style-squared .wp-block-button__link, 
                .wp-block-button .wp-block-button__link,
                .entry-content .wp-block-file__button
                
                {border-color:'.$zoo_button_border_color.'}';
            }
            if($zoo_button_color_hover){
                $css .= '
                .sidebar.widget-area .widget.widget_tag_cloud .tagcloud a:hover,
                #site-main-content .navigation.pagination .nav-links .page-numbers.current, 
                #site-main-content .navigation.pagination .nav-links .page-numbers:hover,
                #zoo-theme-dev-actions .button:hover,
                .woocommerce .woocommerce-cart-form .button:hover,
                .main-content .widget .tagcloud a:hover,
                .wpcf7-form .wpcf7-submit:hover,
                .woocommerce #respond input#submit:hover, 
                .woocommerce-checkout #payment .button:hover, 
                .woocommerce-checkout #payment .button:hover, 
                .woocommerce-checkout #payment .added_to_cart:hover, 
                #add_payment_method .wc-proceed-to-checkout a.checkout-button:hover, 
                .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, 
                .woocommerce .widget_shopping_cart .buttons a:hover,
                #zoo-theme-dev-actions .button:hover,
                .btn:hover, 
                input[type="submit"]:hover, 
                .button:hover, .wp-block-search__button:hover,
                button:hover, 
                .wp-block-button.is-style-squared .wp-block-button__link:hover,
                .wp-block-button .wp-block-button__link:hover,
                .entry-content .wp-block-file__button:hover
                   
                {color:'.$zoo_button_color_hover.'}';
            }
            if($zoo_button_background_color_hover){
                $css .= '
                .sidebar.widget-area .widget.widget_tag_cloud .tagcloud a:hover,
                #site-main-content .navigation.pagination .nav-links .page-numbers:not(.current):hover,
                #zoo-theme-dev-actions .button:hover,
                .woocommerce .woocommerce-cart-form .button:hover,
                .main-content .widget .tagcloud a:hover,
                .wpcf7-form .wpcf7-submit:hover,
                .woocommerce #respond input#submit:hover, 
                .woocommerce-checkout #payment .button:hover, 
                .woocommerce-checkout #payment .button:hover, 
                .woocommerce-checkout #payment .added_to_cart:hover, 
                #add_payment_method .wc-proceed-to-checkout a.checkout-button:hover, 
                .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, 
                .woocommerce .widget_shopping_cart .buttons a:hover,
                #zoo-theme-dev-actions .button:hover,
                .btn:hover, 
                input[type="submit"]:hover, 
                .button:hover, .wp-block-search__button:hover,
                button:hover, 
                .wp-block-button.is-style-squared .wp-block-button__link:hover,
                .wp-block-button .wp-block-button__link:hover,
                .entry-content .wp-block-file__button:hover
                
                {background:'.$zoo_button_background_color_hover.'}';
            }
            if($zoo_button_border_color_hover){
                $css .= '
                .sidebar.widget-area .widget.widget_tag_cloud .tagcloud a:hover, 
                #site-main-content .navigation.pagination .nav-links .page-numbers:not(.current):hover,
                #zoo-theme-dev-actions .button:hover,
                .woocommerce .woocommerce-cart-form .button:hover,
                .main-content .widget .tagcloud a:hover,
                .wpcf7-form .wpcf7-submit:hover,
                .woocommerce #respond input#submit:hover, 
                .woocommerce-checkout #payment .button:hover, 
                .woocommerce-checkout #payment .button:hover, 
                .woocommerce-checkout #payment .added_to_cart:hover, 
                #add_payment_method .wc-proceed-to-checkout a.checkout-button:hover, 
                .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, 
                .woocommerce .widget_shopping_cart .buttons a:hover,
                #zoo-theme-dev-actions .button:hover,
                .btn:hover, 
                input[type="submit"]:hover, 
                .button:hover, .wp-block-search__button:hover,
                button:hover, 
                .wp-block-button.is-style-squared .wp-block-button__link:hover,
                .wp-block-button .wp-block-button__link:hover,
                .entry-content .wp-block-file__button:hover
                
                {border-color:'.$zoo_button_border_color_hover.'}';
            }

            if($zoo_site_heading_color){
                $css .= '
                h1,h2,h3,h4,h5,h6,
                .h1,.h2,.h3,.h4,.h5,.h6
                
                {color:'.$zoo_site_heading_color.'}';
            }

            //Main Content
            $zoo_body_background = get_post_meta(get_the_ID(),'zoo_body_background', true);
            if( $zoo_body_background ){
                $css .= '.page-main-content{background: '.$zoo_body_background.'}';
            }
            if(!get_theme_mod('zoo_enable_rtl', '1')){
                $css .= '#zoo-theme-dev-actions{display: none}';
            }
            $css.='.wrap-shop-title.has-img-cover{min-height:'.get_theme_mod('zoo_shop_banner_height','350').'px}';

        /* ==============End Theme Customize Style ===========================*/
        return $css;
    }
}