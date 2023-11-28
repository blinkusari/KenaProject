<?php
/**
 * List layout for post
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @core        3.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2020 ZooTemplate
 */

$class = zoo_post_loop_item_css();
$layout = get_theme_mod('zoo_blog_layout', 'list');
?>
<article <?php echo post_class($class) ?>>
    <div class="zoo-post-inner">
        <?php
        if ($layout == "list" || ($layout == "list-2" && is_sticky()) ){
            /**
             * zoo_post_item_cat 20
             *
             */
            do_action('zoo_before_post_item_title'); ?>
            <h3 class="entry-title title-post">
                <?php
                the_title(sprintf('<a href="%s" rel="' . esc_attr__('bookmark', 'fona') . '">', esc_url(get_permalink())), '</a>');
                if (get_theme_mod('zoo_blog_layout', 'list') != 'grid' && get_theme_mod('zoo_blog_layout', 'list') != 'masonry') {
                    get_template_part('inc/templates/posts/global/sticky');
                }
                ?>
            </h3>
            <?php
            zoo_post_item_info();
            /**
             * Zoo After Post Item title
             *
             */
            do_action('zoo_after_post_item_title');
        }
        /**
         * Zoo Before Post Item
         * Zoo Before Post Item title
         *
         */
        do_action('zoo_before_post_item');
        ?>
        <div class="wrap-post-content">
            <?php
            if ($layout != "list") {
            if($layout != 'list-2' || ($layout == 'list-2' && !is_sticky())){
                /**
                 * zoo_post_item_cat 20
                 *
                 */
                do_action('zoo_before_post_item_title'); ?>
                <h3 class="entry-title title-post">
                    <?php
                    the_title(sprintf('<a href="%s" rel="' . esc_attr__('bookmark', 'fona') . '">', esc_url(get_permalink())), '</a>');
                    if (get_theme_mod('zoo_blog_layout', 'list') != 'grid' && get_theme_mod('zoo_blog_layout', 'list') != 'masonry') {
                        get_template_part('inc/templates/posts/global/sticky');
                    }
                    ?>
                </h3>
                <?php

                zoo_post_item_info();
                /**
                 * Zoo After Post Item title
                 *
                 */
                do_action('zoo_after_post_item_title');
            }
            }
            ?>
            <div class="entry-content<?php if (get_theme_mod('zoo_enable_loop_excerpt', 0) == 1) {
                echo esc_attr(' excerpt');
            } ?>"><?php
                if (get_theme_mod('zoo_enable_loop_excerpt', 0) == 1 || is_search()) {
                    the_excerpt();
                } else {
                    the_content();
                }
                ?></div>
            <?php
            /**
             * Zoo After Post Item
             * zoo_post_item_readmore 10
             *
             */
            do_action('zoo_after_post_item');
            ?>
        </div>
    </div>
</article>