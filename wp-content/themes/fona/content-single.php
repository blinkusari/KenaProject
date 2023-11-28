<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2018 Zootemplate
 */

$sidebar = "";
if (class_exists("RW_Meta_Box")) {
    $sidebar = get_post_meta(get_the_ID(), 'zoo_blog_single_sidebar_config', true );
}

if ( $sidebar == "inherit" || $sidebar == "" ) {
    $sidebar = zoo_single_post_sidebar();
}

$class_main="col-12";
if ($sidebar == "none" || $sidebar == "") {
    $class_main .= " col-md-12 wrap-post-content-no-sidebar";
} else {
    $class_main .= " col-md-9 wrap-post-content-has-sidebar";
    if ($sidebar == "left") {
        $class_main .= " sidebar-left";
    }
    if ($sidebar == "right" ) {
        $class_main .= " sidebar-right";
    }
}
?>
<div class="container">
    <?php
    if ($sidebar != 'none' && is_active_sidebar(get_theme_mod('zoo_blog_single_sidebar', 'sidebar'))){
    ?>
    <div class="row">
        <?php
        if ($sidebar == 'left') {
            get_sidebar('single');
        }
        ?>
        <div class="<?php echo esc_attr( $class_main ); ?>">
            <?php
            }
            ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('post-item post-detail'); ?>>
                <div class="header-post col-12 col-lg-10">
                    <?php
                    the_title('<h1 class="title-detail">', '</h1>');
                    get_template_part('inc/templates/posts/single/post-info');
                    ?>
                </div>
                <?php
                if (has_post_format('gallery')) : ?>
                    <?php $zoo_images = get_post_meta(get_the_ID(), '_format_gallery_images', true); ?>
                    <?php if ($zoo_images) :
                        wp_enqueue_style('slick');
                        wp_enqueue_style('slick-theme');
                        wp_enqueue_script('slick');
                        ?>
                        <div class="post-media col-12 col-lg-12<?php echo (is_single()) ? ' single-image' : ''; ?>">
                            <ul class="post-slider">
                                <?php foreach ($zoo_images as $zoo_image) : ?>
                                    <?php $zoo_the_image = wp_get_attachment_image_src($zoo_image, 'full-thumb'); ?>
                                    <?php $zoo_the_caption = get_post_field('post_excerpt', $zoo_image); ?>
                                    <li><img src="<?php echo esc_url($zoo_the_image[0]); ?>"
                                             <?php if ($zoo_the_caption) : ?>title="<?php echo esc_attr($zoo_the_caption); ?>"<?php endif; ?> />
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php elseif (has_post_format('video')) : ?>
                    <div class="post-media col-12 col-lg-12<?php echo (is_single()) ? ' single-video' : ''; ?>">
                        <?php $zoo_video = get_post_meta(get_the_ID(), '_format_video_embed', true); ?>
                        <?php if (wp_oembed_get($zoo_video)) : ?>
                            <?php echo wp_oembed_get($zoo_video); ?>
                        <?php else : ?>
                            <?php echo ent2ncr($zoo_video); ?>
                        <?php endif; ?>
                    </div>
                <?php elseif (has_post_format('audio')) :
                    $zoo_audio = get_post_meta(get_the_ID(), '_format_audio_embed', true);
                    if ($zoo_audio != ''):
                        ?>
                        <div class="post-media audio col-12 col-lg-12<?php echo (is_single()) ? ' single-audio' : ''; ?>">
                            <?php

                            if (wp_oembed_get($zoo_audio)) : ?>
                                <?php echo wp_oembed_get($zoo_audio); ?>
                            <?php else : ?>
                                <?php echo do_shortcode('[audio mp3="' . esc_url($zoo_audio) . '"][/audio]'); ?>
                            <?php endif; ?>
                        </div>
                    <?php
                    endif;
                else : ?>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-media col-12 col-lg-12<?php echo (is_single()) ? ' single-image' : ''; ?>">
                            <?php the_post_thumbnail('full-thumb'); ?>
                        </div>
                    <?php endif; ?>
                <?php endif;
                ?>
                <div class="post-content col-12 col-lg-10">
                    <?php
                    the_content();
                    ?>
                </div>
                <?php
                //do not remove
                get_template_part('inc/templates/pagination', 'detail');
                //Allow custom below
                get_template_part('inc/templates/posts/single/bottom-post-content');
                ?>
            </article>
            <?php
            get_template_part('inc/templates/posts/single/about', 'author');
            get_template_part('inc/templates/posts/single/post', 'navigation');

            if ($sidebar != "none" && $sidebar != "") {
                get_template_part('inc/templates/posts/single/related', 'posts');
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template('', true);
                endif;
            }
            if ($sidebar != 'none' && is_active_sidebar(get_theme_mod('zoo_blog_single_sidebar', 'sidebar'))){
            ?>
        </div><?php
        if ($sidebar == 'right') {
            get_sidebar('single');
        }
        ?>
    </div>
<?php
}
?>
</div>

<?php 
if ($sidebar == "none" || $sidebar == "") {
    get_template_part('inc/templates/posts/single/related', 'posts');
    // If comments are open or we have at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) :
        comments_template('', true);
    endif;
}
 ?>
