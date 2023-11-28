<?php
/**
 * The default template for media of post
 *
 * Display thumbnail, video, auto at here
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2020 ZooTemplate
 */
if (!has_post_format('gallery')) {
    if (has_post_format('video')) :
        $zoo_video = get_post_meta(get_the_ID(), '_format_video_embed', true);
        if ($zoo_video != ''):
            ?>
            <div class="post-media single-video">
                <?php if (wp_oembed_get($zoo_video)) :
                    echo wp_oembed_get($zoo_video);
                else :
                    echo ent2ncr($zoo_video);
                endif;
                ?>
            </div>
        <?php
        endif;
    elseif (has_post_format('audio')) :
        $zoo_audio = get_post_meta(get_the_ID(), '_format_audio_embed', true);
        if ($zoo_audio != ''):
            ?>
            <div class="post-media audio single-audio">
                <?php
                if (wp_oembed_get($zoo_audio)) :
                    echo wp_oembed_get($zoo_audio);
                else :
                    echo do_shortcode('[audio mp3="' . esc_url($zoo_audio) . '"][/audio]');
                endif; ?>
            </div>
        <?php
        endif;
    else : if (has_post_thumbnail()) : ?>
        <div class="post-media single-image">
            <?php the_post_thumbnail('full-thumb'); ?>
        </div>
    <?php endif;
    endif;
}