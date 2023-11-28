<?php
/**
 * The template for displaying the header
 *
 * @package  Zoo_Theme\Templates
 * @author   zootemplate
 * @link     https://www.zootemplate.com/
 *
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11"/>
        <?php wp_head(); ?>
    </head>
<body <?php body_class(); ?>>
<?php
if (zoo_site_layout() == 'boxed') { ?>
    <div class="wrap-site-boxed container">
    <?php
}
do_action('zoo_render_site_header');
get_template_part('inc/templates/breadcrumbs');
