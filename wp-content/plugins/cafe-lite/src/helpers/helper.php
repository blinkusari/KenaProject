<?php
/**
 * Helpers function of CAFE
 **/

/**
 * Correct WordPress excerpt
 *
 * @param object $post \WP_Post
 * @param int $length Expected excerpt length.
 * @param string $more Read more string.
 *
 * @return  string
 * @see https://developer.wordpress.org/reference/functions/get_post/
 *
 */
if (!function_exists('cafe_get_excerpt')) {
    function cafe_get_excerpt($length = 55)
    {
        $post = get_post(null);
        $text = $post->post_excerpt ?: $post->post_content;
        $text = do_shortcode($text);
        $text = strip_shortcodes($text);
        $text = str_replace(']]>', ']]&gt;', $text);
        $text = wp_trim_words($text, $length, false);

        return $text . '...';
    }
}

/**
 * Numeric pagination for CAFE widget
 *
 * @range  int number pagination display.
 * @current_query  current query of widget.
 * @pages  maximum pages want display.
 *
 * @see https://developer.wordpress.org/reference/functions/get_post/
 *
 * @return  string
 */
if (!function_exists('cafe_pagination')) {
    function cafe_pagination($range = 2, $current_query = '', $pages = '', $prev_icon = '<i class="cs-font clever-icon-arrow-left"></i>', $next_icon = '<i class="cs-font clever-icon-arrow-right"></i>')
    {
        $showitems = ($range * 2) + 1;

        if ($current_query == '') {
            global $paged;
            if (empty($paged)) $paged = 1;
        } else {
            $paged = $current_query->query_vars['paged'];
        }

        if ($pages == '') {
            if ($current_query == '') {
                global $wp_query;
                $pages = $wp_query->max_num_pages;
                if (!$pages) {
                    $pages = 1;
                }
            } else {
                $pages = $current_query->max_num_pages;
            }
        }
        $allow_html = array(
            "i" => array(
                "class" => array()
            )
        );
        if (1 != $pages) { ?>
            <div class="cafe-pagination clearfix">
                <?php if ($paged > 1) { ?>
                    <a class="cafe-pagination-prev cafe_pagination-item"
                       href="<?php echo esc_url(get_pagenum_link($paged - 1)) ?>"><?php echo wp_kses($prev_icon, $allow_html) ?></a>
                <?php }

                for ($i = 1; $i <= $pages; $i++) {
                    if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                        if ($paged == $i) { ?>
                            <span class="current cafe_pagination-item"><?php echo esc_html($i) ?></span>
                        <?php } else { ?>
                            <a href="<?php echo esc_url(get_pagenum_link($i)) ?>"
                               class="inactive cafe_pagination-item"><?php echo esc_html($i) ?></a>
                            <?php
                        }
                    }
                }
                if ($paged < $pages) { ?>
                    <a class="cafe-pagination-next cafe_pagination-item"
                       href="<?php echo esc_url(get_pagenum_link($paged + 1)) ?>"><?php echo wp_kses($next_icon, $allow_html)?></a>
                <?php } ?>
            </div>
            <?php
        }
    }
}

/**
 * Instagram
 *
 * @return  string
 */

if (!function_exists('cafe_scrape_instagram')) {
    function cafe_scrape_instagram($token, $limit)
    {
        $url_info = "https://graph.instagram.com/me?fields=id,username&access_token=" . $token;
        $remote_info = wp_remote_get($url_info);
        $info_arr = json_decode($remote_info['body'], true);

        $url = 'https://graph.instagram.com/' . $info_arr['id'] . '/media?fields=media_url,thumbnail_url,caption,id,media_type,timestamp,username,comments_count,like_count,permalink,children{media_url,id,media_type,timestamp,permalink,thumbnail_url}&limit=' . $limit . '&access_token=' . $token;

        $remote = wp_remote_get($url);

        if (is_wp_error($remote)) {
            return new WP_Error('site_down', esc_html__('Unable to communicate with Instagram.', 'cafe-lite'));
        }

        if (200 !== wp_remote_retrieve_response_code($remote)) {
            return new WP_Error('invalid_response', esc_html__('Instagram did not return a 200.', 'cafe-lite'));
        }

        $ins_arr = json_decode($remote['body'], true);

        if (!$ins_arr) {
            return new WP_Error('bad_json', esc_html__('Instagram has returned invalid data.', 'cafe-lite'));
        } else {
            return $ins_arr;
        }
    }
}
if (!function_exists('cafe_images_only')) {
    function cafe_images_only($media_item)
    {

        if ($media_item['type'] == 'image')
            return true;

        return false;
    }
}
if (!function_exists('cafe_abbreviate_total_count')) {
    function cafe_abbreviate_total_count($value, $floor = 0)
    {
        if ($value >= $floor) {
            $abbreviations = array(12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => '');

            foreach ($abbreviations as $exponent => $abbreviation) {
                if ($value >= pow(10, $exponent)) {
                    return round(floatval($value / pow(10, $exponent)), 1) . $abbreviation;
                }
            }
        } else {
            return $value;
        }
    }
}

if (!function_exists('cafe_time_elapsed_string')) {
    function cafe_time_elapsed_string($datetime, $full = false)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }
}

/**
 * cafe_oembed_dataparse
 * normally video iframe for video frame.
 * disable if Zoo theme is activated or override by user.
 * @return parameter of video iframe.
 * @uses Use hook for add to oembed_dataparse
 */
if (!function_exists('zoo_oembed_dataparse') || !function_exists('cafe_oembed_dataparse')) {
    function cafe_oembed_dataparse($return, $data, $url)
    {
        if (false === strpos($return, 'youtube.com'))
            return $return;
        $id = explode('watch?v=', $url);
        $add_id = str_replace('allowfullscreen>', 'allowfullscreen id="yt-' . $id[1] . '">', $return);
        $add_id = str_replace('?feature=oembed', '?enablejsapi=1', $add_id);
        return $add_id;
    }
}
add_filter('oembed_dataparse', 'cafe_oembed_dataparse', 10, 3);