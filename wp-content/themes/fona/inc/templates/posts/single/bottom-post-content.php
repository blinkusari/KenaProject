<?php
/**
 * Block bottom post content
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @core        3.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2018 ZooTemplate
 
 */
if ((get_theme_mod('zoo_enable_blog_tags', '1') == 1 && has_tag()) || (get_theme_mod('zoo_enable_blog_share', '1') == 1 && class_exists('CleverAddons'))) {
?>
<div class="wrap-bottom-content-post col-12 col-lg-10">
    <?php
    if (get_theme_mod('zoo_enable_blog_tags', '1') == 1 && has_tag()) {
        ?>
        <div class="tags-link-wrap tagcloud">
            <?php 
                the_tags('', '', '');
            ?>
        </div>
    <?php } ?>
    <?php
    if (get_theme_mod('zoo_enable_blog_share', '1') == 1 && class_exists('CleverAddons')) {
        ?>
        <div class="wrap-share-post">
            <span class="title-block-bottom-content-post">
            <?php
            esc_html_e('Share:', 'fona');
            ?>
            </span>
            <span class="share-control"><i class="cs-font  clever-icon-share-2"></i></span>
            <ul class="share-links social-icons">
                <li class="facebook border-icon social-icon"><a
                            href="http://www.facebook.com/sharer.php?u=<?php esc_url(the_permalink()); ?>"
                            class="post_share_facebook" onclick="javascript:window.open(this.href,
                  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=220,width=600');return false;"><i
                                class="zoo-icon-facebook"></i></a></li>
                <li class="twitter border-icon social-icon"><a
                            href="https://twitter.com/share?url=<?php esc_url(the_permalink()); ?>" onclick="javascript:window.open(this.href,
                  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=260,width=600');return false;"
                            class="product_share_twitter"><i class="zoo-icon-twitter"></i></a></li>
                <li class="pinterest border-icon social-icon"><a
                            href="http://pinterest.com/pin/create/button/?url=<?php esc_url(the_permalink()); ?>&media=<?php if (function_exists('the_post_thumbnail')) echo esc_url(wp_get_attachment_url(get_post_thumbnail_id())); ?>&description=<?php echo the_title_attribute(); ?>"><i
                                class="zoo-icon-pinterest"></i></a></li>
                <li class="mail border-icon social-icon"><a
                            href="mailto:?subject=<?php the_title_attribute(); ?>&body=<?php echo strip_tags(get_the_excerpt());
                            the_permalink(); ?>"
                            class="product_share_email"><i class="zoo-icon-email"></i></a></li>
            </ul>
        </div>
        <?php
    }
    ?>
</div>
<?php 
}