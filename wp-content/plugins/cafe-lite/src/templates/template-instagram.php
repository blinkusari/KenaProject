<?php
/**
 * View template for Clever Instagram
 *
 * @package CAFE\Templates
 * @copyright 2018 CleverSoft. All rights reserved.
 */

$cafe_json_config = $target = $limit = $img_size = $count = '';
if (!empty($settings['link_target']) && $settings['link_target'] == '_blank') {
    $target = 'target="_blank"';
}
$limit = !empty($settings['number']) ? $settings['number'] : 8;
$token = $settings['token'];
$img_size = !empty($settings['img_size']) ? $settings['img_size'] : 'large';

$cafe_wrap_class = "woocommerce cafe-products-wrap";
$cafe_json_config = '';
if ($settings['layout'] == 'carousel') {
    $class = 'grid-layout carousel';
    $class .= ' ' . $settings['nav_position'];
    $cafe_wrap_class .= ' cafe-carousel';

    $settings['autoplay'] = $settings['autoplay'] ? $settings['autoplay'] : 'false';
    $settings['autoplay_tablet'] = $settings['autoplay_tablet'] ? $settings['autoplay_tablet'] : 'false';
    $settings['autoplay_mobile'] = $settings['autoplay_mobile'] ? $settings['autoplay_mobile'] : 'false';

    $settings['show_pag'] = $settings['show_pag'] ? $settings['show_pag'] : 'false';
    $settings['show_pag_tablet'] = $settings['show_pag_tablet'] ? $settings['show_pag_tablet'] : 'false';
    $settings['show_pag_mobile'] = $settings['show_pag_mobile'] ? $settings['show_pag_mobile'] : 'false';

    $settings['show_nav'] = $settings['show_nav'] ? $settings['show_nav'] : 'false';
    $settings['show_nav_tablet'] = $settings['show_nav_tablet'] ? $settings['show_nav_tablet'] : 'false';
    $settings['show_nav_mobile'] = $settings['show_nav_mobile'] ? $settings['show_nav_mobile'] : 'false';
    $settings['speed'] = $settings['speed'] ? $settings['speed'] : 3000;
    $cafe_json_config = '{
        "slides_to_show" : ' . $settings['slides_to_show']['size'] . ',
        "slides_to_show_tablet" : ' . $settings['slides_to_show_tablet']['size'] . ',
        "slides_to_show_mobile" : ' . $settings['slides_to_show_mobile']['size'] . ',

        "speed": ' . $settings['speed'] . ',
        "scroll": ' . $settings['scroll'] . ',

        "autoplay": ' . $settings['autoplay'] . ',
        "autoplay_tablet": ' . $settings['autoplay_tablet'] . ',
        "autoplay_mobile": ' . $settings['autoplay_mobile'] . ',

        "show_pag": ' . $settings['show_pag'] . ',
        "show_pag_tablet": ' . $settings['show_pag_tablet'] . ',
        "show_pag_mobile": ' . $settings['show_pag_mobile'] . ',

        "show_nav": ' . $settings['show_nav'] . ',
        "show_nav_tablet": ' . $settings['show_nav_tablet'] . ',
        "show_nav_mobile": ' . $settings['show_nav_mobile'] . ',
        "wrap": ".wrap-instagram"
    }';
} else {
    $cafe_wrap_class = "woocommerce cafe-products-wrap";
    $class = 'grid-layout';
    $grid_class = '  cafe-grid-lg-' . $settings['columns']['size'] . '-cols cafe-grid-md-' . $settings['columns_tablet']['size'] . '-cols cafe-grid-' . $settings['columns_mobile']['size'] . '-cols';
    $cafe_wrap_class .= $grid_class;
}

?>
<div class="<?php echo esc_attr($cafe_wrap_class) ?> " data-cafe-config='<?php echo esc_attr($cafe_json_config) ?>'>
    <?php if (isset($settings['title']) && $settings['title'] != '') :
        printf('<h3 %s>%s</h3>', $this->get_render_attribute_string('title'), $settings['title']);
    endif; ?>
    <div class="wrap-instagram">
        <?php
        if ($token) {
            $ins_arr = cafe_scrape_instagram($token, $limit);
            $media_url = $thumbnail_url = $caption = $id = $media_type = $timestamp = $username = $permalink = $comments_count = $like_count = '';
            foreach ($ins_arr as $ins) {
                foreach ($ins as $items) {
                    if (isset($items['media_url'])) {
                        $media_url = $items['media_url'];
                    }
                    if (isset($items['thumbnail_url'])) {
                        $thumbnail_url = $items['thumbnail_url'];
                    }
                    if (isset($items['caption'])) {
                        $caption = $items['caption'];
                    }
                    if (isset($items['id'])) {
                        $id = $items['id'];
                    }
                    if (isset($items['media_type'])) {
                        $media_type = $items['media_type'];
                    }
                    if (isset($items['timestamp'])) {
                        $timestamp = $items['timestamp'];
                    }
                    if (isset($items['username'])) {
                        $username = $items['username'];
                    }
                    if (isset($items['permalink'])) {
                        $permalink = $items['permalink'];
                    }
                    if (isset($items['comments_count'])) {
                        $comments_count = $items['comments_count'];
                    }
                    if (isset($items['like_count'])) {
                        $like_count = $items['like_count'];
                    }
                    if (isset($items['before'])) {
                        $before = $items['before'];
                        if ($before) {
                            break;
                        }
                    }
                    ?>
                    <div class="instagram-item post">
                        <div class="instagram-item-inner">
                            <a href="<?php echo esc_url($permalink); ?>"<?php echo $target; ?>>
                                <div class="wrap-content">
                                    <?php if ($settings['show_type']) : ?>

                                        <?php if ($media_type == 'VIDEO') : ?>
                                            <span class="type type-video"><i
                                                        class="cs-font  clever-icon-play-2"></i></span>
                                        <?php else : ?>
                                            <span class="type type-image"><i class="cs-font clever-icon-compare-6"></i></span>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <span class="group-items">
                                <?php if (!empty($settings['show_likes']) && $settings['show_likes']) : ?>
                                    <span class="likes"><i
                                                class="cs-font clever-icon-heart-1"></i><?php echo esc_html($like_count); ?></span>
                                <?php endif; ?>

                                        <?php if (!empty($settings['show_comments']) && $settings['show_comments']) : ?>
                                            <span class="comments"><i
                                                        class="cs-font clever-icon-consulting-message"></i><?php echo esc_html($comments_count); ?></span>
                                        <?php endif; ?>
                            </span>

                                    <?php if (!empty($settings['show_time']) && $settings['show_time']) : ?>
                                        <span class="time elapsed-time"><?php echo esc_html($timestamp); ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php if ($media_type == 'VIDEO') { ?>
                                    <img src="<?php echo esc_url($thumbnail_url); ?>"
                                         alt="<?php echo esc_attr($caption); ?>" class="instagram-photo"/>
                                    <?php
                                } else { ?>
                                    <img src="<?php echo esc_url($media_url); ?>"
                                         alt="<?php echo esc_attr($caption); ?>" class="instagram-photo"/>
                                    <?php
                                } ?>

                            </a>
                        </div>
                    </div>
                    <?php
                }
            }
        } ?>
    </div>
</div>
