<?php
/**
 * The default template for gallery of post
 *
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2020 ZooTemplate
 */

if (has_post_format('gallery')) :
    $zoo_images = get_post_meta(get_the_ID(), '_format_gallery_images', true);
    if ($zoo_images) :
        wp_enqueue_style('slick');
        wp_enqueue_style('slick-theme');
        wp_enqueue_script('slick');
        ?>
        <div class="post-media single-image">
            <ul class="post-slider">
                <?php foreach ($zoo_images as $zoo_image) :
                    $zoo_the_image = wp_get_attachment_image_src($zoo_image, 'full-thumb');
                    $zoo_the_caption = get_post_field('post_excerpt', $zoo_image); ?>
                    <li><img src="<?php echo esc_url($zoo_the_image[0]); ?>"
                             <?php if ($zoo_the_caption) : ?>title="<?php echo esc_attr($zoo_the_caption); ?>"<?php endif; ?> />
                            <?php if($zoo_the_caption): ?>
                        <span class="post-slider-caption"><?php echo esc_html($zoo_the_caption); ?></span>
                            <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif;
endif;