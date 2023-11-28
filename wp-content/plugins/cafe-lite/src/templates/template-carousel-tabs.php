<?php
/**
 * View template for Auto typing widget
 *
 * @package CAFE\Templates
 * @copyright 2018 CleverSoft. All rights reserved.
 */

$filters = $settings['filter'];
$list_filter = '';
foreach ($filters as $key => $text) {
    if ($text['label_filter'] != '') {
        if ($key == 0) {
            $list_filter .= '<span class="cafe-tab-item active" data-tab="' . preg_replace('/\W+/', '-', strtolower(strip_tags($text['label_filter']))) . '">' . esc_html($text['label_filter']) . '</span>';
        } else {
            $list_filter .= '<span class="cafe-tab-item" data-tab="' . preg_replace('/\W+/', '-', strtolower(strip_tags($text['label_filter']))) . '">' . esc_html($text['label_filter']) . '</span>';
        }
    }
}
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
$settings['scroll'] = $settings['scroll'] ? $settings['scroll'] : 1;
$settings['infinite'] = $settings['infinite'] ? $settings['infinite'] : 'false';
$cafe_json_config = '{
        "slides_to_show" : ' . $settings['slides_to_show']['size'] . ',
        "slides_to_show_tablet" : ' . ($settings['slides_to_show_tablet']['size'] ? $settings['slides_to_show_tablet']['size'] : 2) . ',
        "slides_to_show_mobile" : ' . ($settings['slides_to_show_mobile']['size'] ? $settings['slides_to_show_mobile']['size'] : 1) . ',
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
        "infinite": ' . $settings['infinite'] . '
    }';
if ($list_filter != '') {
    $wrap_class = 'cafe-carousel-tabs cafe-tabs';
    if ($settings['overflow'] == 'true') {
        $wrap_class .= ' visible-content';
    }
    ?>
    <div class="<?php echo esc_attr($wrap_class); ?>">
        <div class="cafe-wrap-tab-head">
            <?php
            $allow_html = array('span' => array(
                'class' => array(),
                'data-tab' => array()
            ),);
            echo wp_kses($list_filter, $allow_html);
            ?>
        </div>
        <div class="cafe-wrap-tabs">
            <?php
            foreach ($filters

                     as $key => $text) {
                $list_img = '';
                $class = 'cafe-tab ' . preg_replace('/\W+/', '-', strtolower(strip_tags($text['label_filter'])));
                if ($key == 0) {
                    $class .= ' active';
                }
                ?>
                <div class="<?php echo esc_attr($class); ?>">
                    <ul class="cafe-carousel"
                        data-cafe-config='<?php echo esc_attr($cafe_json_config) ?>'>
                        <?php
                        $allow_html = array('li' => array(
                            'class' => array(),
                            'data-tab' => array()
                        ), 'img' => array(
                            'class' => array(),
                            'src' => array(),
                            'alt' => array()
                        ), 'span' => array(
                            'class' => array(),
                        ), 'i' => array(
                            'class' => array(),
                        ));

                        if (!empty($text['img'])) {
                            foreach ($text['img'] as $key => $img) {
                                if (!!$img) {
                                    if ($img['url'] != '') {
                                        $list_img .= '<li class="cafe-tab-carousel-item"><img src="' . esc_url($img['url']) . '" alt=""/>';
                                        if ($settings['show_drag_label'] == 'true' && $key == $settings['slides_to_show']['size'] - 1) {
                                            $list_img .= '<span class="cafe-drag-label"><i class="cs-font clever-icon-arrow-left"></i>
                                            ' . esc_html($settings['drag_label']) . '
                                            <i class="cs-font clever-icon-arrow-right"></i>
                                        </span>';
                                        }
                                        $list_img .= '</li>';
                                    }
                                }
                            }
                        }
                        echo wp_kses($list_img, $allow_html);
                        ?>
                    </ul>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
}
