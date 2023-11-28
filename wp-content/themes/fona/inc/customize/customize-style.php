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
add_action('wp_enqueue_scripts', 'zoo_enqueue_render', 1000);
// Enqueue scripts for theme.
function zoo_enqueue_render()
{
    //Load font
    $zoo_fonts = array();
    if (get_theme_mod('zoo_typo_base', '') == '' || get_theme_mod('zoo_typo_base')['font'] == '') {
        $zoo_fonts[] = array('font-family' => 'San Francisco Pro', 'variant' => '400');
    }
    if (get_theme_mod('zoo_typo_heading', '') == '' || get_theme_mod('zoo_typo_heading')['font'] == '') {
        $zoo_fonts[] = array('font-family' => 'San Francisco Pro', 'variant' => '600');
    }
    if (get_theme_mod('zoo_typo_woo', '') == '' || get_theme_mod('zoo_typo_woo')['font'] == '') {
        $zoo_fonts[] = array('font-family' => 'San Francisco Pro', 'variant' => '600');
    }
    $zoo_local_font = array();
    $zoo_google_font = array();
    foreach ($zoo_fonts as $font) {
        if ($font) {
            if (in_array('San Francisco Pro', $font)) {
                $zoo_local_font[] = 'San Francisco Pro';
            } else {
                $zoo_google_font[] = $font;
            }
        }
    }
    if (!empty(array_filter($zoo_google_font))) {
        $zoo_google_font = zoo_import_google_fonts($zoo_google_font);
        wp_enqueue_style('zoo-font', $zoo_google_font, false, '');
    }
    // Load custom style
    wp_add_inline_style('zoo-styles', zoo_customize_style($zoo_local_font));
    if (get_theme_mod('zoo_custom_js') != '') {
        wp_add_inline_script('zoo-scripts', zoo_customize_js());
    }
}

if (!function_exists('zoo_customize_js')) {
    function zoo_customize_js()
    {
        $zoo_script = '';
        if (get_theme_mod('zoo_custom_js') != '') {
            $zoo_script = get_theme_mod('zoo_custom_js');
        }
        return $zoo_script;
    }
}
if (!function_exists('zoo_customize_style')) {
    function zoo_customize_style($zoo_local_font = array())
    {
        /* ----------------------------------------------------------
                                    Responsive control
                            Control Breakpoint of header Layout
                            Don't remove this section
        ---------------------------------------------------------- */
        $css = '';
        $theme_settings = get_option(ZOO_SETTINGS_KEY, []);
        $mobile_breakpoint = !empty($theme_settings['mobile_breakpoint_width']) ? strval(intval($theme_settings['mobile_breakpoint_width'])) : '992';
        $css .= '@media(min-width: ' . $mobile_breakpoint . 'px) {
          .wrap-site-header-mobile {
            display: none;
          }
          .show-on-mobile {
            display: none;
          }
        }
        
        @media(max-width: ' . $mobile_breakpoint . 'px) {
          .wrap-site-header-desktop {
            display: none;
          }
          .show-on-desktop {
            display: none;
          }
        }';
        /* ----------------------------------------------------------
                            End Responsive control
                    Control Breakpoint of header Layout
                    Don't remove this section
        ---------------------------------------------------------- */
        /* ----------------------------------------------------------
                                    Typography
                            All typography must add here
        ---------------------------------------------------------- */
        if (!empty($zoo_local_font)) {
            if (in_array('San Francisco Pro', $zoo_local_font)) {
                $css .= '@font-face {
                    font-family: \'San Francisco Pro\';
                    src: url(\'' . ZOO_THEME_URI.'assets/fonts/SanFranciscoPro/SF-Pro-Text-Light.otf\') format(\'truetype\');
                    font-weight: 300;
                    font-style: normal;
                    font-display: auto;
                }

                @font-face {
                    font-family: \'San Francisco Pro\';
                    src: url(\'' . ZOO_THEME_URI.'assets/fonts/SanFranciscoPro/SF-Pro-Text-Regular.otf\') format(\'truetype\');
                    font-weight: 400;
                    font-style: normal;
                	font-display: auto;
                }

                @font-face {
                    font-family: \'San Francisco Pro\';
                    src: url(\'' . ZOO_THEME_URI.'assets/fonts/SanFranciscoPro/SF-Pro-Text-Medium.otf\') format(\'truetype\');
                    font-weight: 500;
                    font-style: normal;
                	font-display: auto;
                }

                @font-face {
                    font-family: \'San Francisco Pro\';
                    src: url(\'' . ZOO_THEME_URI.'assets/fonts/SanFranciscoPro/SF-Pro-Text-Semibold.otf\') format(\'truetype\');
                    font-weight: 600;
                    font-style: normal;
                font-display: auto;
                }

                @font-face {
                    font-family: \'San Francisco Pro\';
                    src: url(\'' . ZOO_THEME_URI.'assets/fonts/SanFranciscoPro/SF-Pro-Text-Bold.otf\') format(\'truetype\');
                    font-weight: 700;
                    font-style: normal;
                font-display: auto;
                }
                ';
            }
        }

        $css .= '@media(min-width:1500px){.container{max-width:' . zoo_site_width() . ';width:100%}}';

        /* ----------------------------------------------------------
                               Load Font
        ---------------------------------------------------------- */
        $body_font = get_theme_mod('zoo_typo_base', '');
        if (isset($body_font['font-size'])) {
            $css .= "html{";
            $css .= "font-size:" . $body_font['font-size'];
            $css .= "}";
        }

        /*Typography generate Css*/
        if ($body_font == '' || $body_font['font'] == '') {
            $css .= "html{";
            $css .= "font-size: 16px;";
            $css .= "}";
            $css .= zoo_generate_css_font('body', array('font-family' => 'San Francisco Pro', 'variant' => '400'));
        }
        if (get_theme_mod('zoo_typo_heading', '') == '' || get_theme_mod('zoo_typo_heading')['font'] == '') {
            $css .= zoo_generate_css_font('h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6', array('font-family' => 'San Francisco Pro', 'variant' => '500'));
            $css .= zoo_generate_css_font('h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6', array('font-family' => 'San Francisco Pro', 'variant' => '600'));
            $css .= zoo_generate_css_font('h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6', array('font-family' => 'San Francisco Pro', 'variant' => '700'));
        }
        if (get_theme_mod('zoo_typo_woo', '') == '' || get_theme_mod('zoo_typo_woo')['font'] == '') {
            $css .= zoo_generate_css_font('.product-loop-title,  .product_title', array('font-family' => 'San Francisco Pro', 'variant' => '600'));
        }
        /*Preset Color*/
        if (zoo_theme_preset() != '') {
            //put all css class follow accent color to $accent_class
            $accent_class = '.accent-class';
            $css .= $accent_class . '{color:' . zoo_theme_preset() . '}';
        }
        if (class_exists('WooCommerce')) {
            $gutter = zoo_product_gutter();
            $css .= '.products .product{padding-left:' . $gutter . 'px;padding-right:' . $gutter . 'px}';
            $css .= 'ul.products, .woocommerce ul.products{margin-left:-' . $gutter . 'px !important;margin-right:-' . $gutter . 'px !important;width:calc(100% + ' . ($gutter * 2) . 'px)}';
        }
        if (get_theme_mod('zoo_custom_css') != '') {
            $css .= get_theme_mod('zoo_custom_css');
        }
        return $css;
    }
}