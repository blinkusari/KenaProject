<?php
/** Logo
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2018 Zootemplate
 
 */
$zoo_page_logo='';
if (is_single() || is_page()) {
    $zoo_page_logo=get_post_meta(get_the_ID(), 'zoo_logo_page', true);
}
$zoo_logo_height=get_theme_mod('zoo_logo_height','');
if ($zoo_page_logo != '' && $zoo_page_logo != 0):?>
    <p id="logo" class="site-logo"><a href="<?php echo esc_url(home_url('/')); ?>" <?php if($zoo_logo_height!=''){?>
            style="height:<?php echo esc_attr($zoo_logo_height);?>px"<?php }?> rel="<?php esc_attr_e('home','fona'); ?>"
                                      title="<?php bloginfo('name'); ?>">
            <img src="<?php echo esc_url(wp_get_attachment_url($zoo_page_logo)) ?>" alt="<?php bloginfo('name'); ?>"/></a></p>
    <?php
else:
 if (!get_theme_mod('custom_logo')) { ?>
    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="<?php esc_attr_e('home','fona'); ?>"
                              title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></h1>
<?php } else {
         ?>
         <p id="logo" class="site-logo"><a href="<?php echo esc_url(home_url('/')); ?>" rel="<?php esc_attr_e('home','fona'); ?>"
                                           title="<?php bloginfo('name'); ?>"><?php
                 echo  wp_get_attachment_image(get_theme_mod('custom_logo'),'full');
                 ?></a>
         </p>
     <?php
 }
?>
<?php endif;
if (display_header_text()) {
    $zoo_site_description = get_bloginfo('description', 'display');
    if ($zoo_site_description || is_customize_preview()) { ?>
        <p class="site-description"><?php echo esc_html($zoo_site_description); ?></p>
    <?php }
}
