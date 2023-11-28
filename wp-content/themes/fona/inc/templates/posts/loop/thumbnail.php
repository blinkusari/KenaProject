<?php
/**
 * Media block for post
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2020 ZooTemplate
 */

$img_size = get_theme_mod('zoo_blog_img_size', 'full');
$layout = get_theme_mod('zoo_blog_layout', 'list');
if ($layout != 'list') {
    $img_size = get_theme_mod('zoo_blog_grid_img_size', 'medium');
}
if ($layout == 'list-2' && is_sticky()) {
    $img_size = 'full';
}
$thumb = [];
if ($layout == "masonry") {
    $thumb =get_post_meta(get_the_ID(), "zoo_blog_single_alternate_img");
}
if (has_post_thumbnail() ||  (count($thumb) > 0 && $thumb[0]!="0")) {
    ?>
    <div class="wrap-media">
        <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title_attribute() ?>">
            <?php
            if  (count($thumb) > 0 && $thumb[0]!="0") {
                echo wp_get_attachment_image($thumb[0],'full');
            } else {
                the_post_thumbnail($img_size);
            }
            ?>
        </a>
    </div>
<?php }