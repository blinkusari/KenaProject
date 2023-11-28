<?php
/**
 * Block information for post
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2020 ZooTemplate
 */

$wrap_class = 'list-cat';
if (get_theme_mod('zoo_blog_single_post_info_style', '') == 'icon') {
    $wrap_class .= ' with-icon';
} else {
    $wrap_class .= ' without-icon';
}
if (get_theme_mod('zoo_enable_blog_cat_post', '1') == 1) { ?>
    <div class="<?php echo esc_attr($wrap_class) ?>">
    <?php
    if (get_theme_mod('zoo_blog_single_post_info_style', '') == 'icon') {
        ?>
        <i class="cs-font clever-icon-document"></i>
        <?php echo get_the_term_list(get_the_ID(), 'category', '', ', ', '');
    } else {
        echo get_the_term_list(get_the_ID(), 'category', '', ', ', '');
    }
    ?>
    </div><?php
}
?>

