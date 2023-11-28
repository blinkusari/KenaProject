<?php
/**
 * View template for Clever Banner widget
 *
 * @package CAFE\Templates
 * @copyright 2018 CleverSoft. All rights reserved.
 */

use Elementor\Utils;

$cafe_wrap_class = '';
$cafe_json_config = '';

if ($settings['layout'] == 'grid') {
    $grid_class = 'grid-layout';
    $grid_class .= ' cafe-wrap  cafe-grid-lg-' . $settings['columns']['size'] . '-cols cafe-grid-md-' . $settings['columns_tablet']['size'] . '-cols cafe-grid-' . $settings['columns_mobile']['size'] . '-cols';
    $cafe_wrap_class .= $grid_class;

}
if ($settings['layout'] == 'masonry') {
    wp_enqueue_script('isotope');
    $grid_class = 'masonry-layout';
    $grid_class .= ' cafe-wrap  cafe-grid-lg-' . $settings['columns']['size'] . '-cols cafe-grid-md-' . $settings['columns_tablet']['size'] . '-cols cafe-grid-' . $settings['columns_mobile']['size'] . '-cols';
    $cafe_wrap_class .= $grid_class;

}
if ($settings['layout'] == 'carousel') {
    $cafe_wrap_class .= 'grid-layout carousel';
    $cafe_wrap_class .= ' ' . $settings['nav_position'];
    $cafe_wrap_class .= ' cafe-carousel cafe-wrap';

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
        "slides_to_show_tablet" : ' . ($settings['slides_to_show_tablet']['size'] ? $settings['slides_to_show_tablet']['size'] : 3) . ',
        "slides_to_show_mobile" : ' . ($settings['slides_to_show_mobile']['size'] ? $settings['slides_to_show_mobile']['size'] : 2) . ',

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
        "arrow_left": "' . $settings['arrow_left_icon'] . '",
        "arrow_right": "' . $settings['arrow_right_icon'] . '",

        "wrap": ".cafe-row"
    }';
} ?>
<div class="<?php echo esc_attr($cafe_wrap_class) ?> " data-cafe-config='<?php echo esc_attr($cafe_json_config) ?>'>
    <div class="cafe-row">
        <?php
        $css_class = 'cafe-banner cafe-col ';
        if ($settings['overlay_banner'] == 'true') {
            $css_class .= $settings['effect'] . ' cafe-overlay-content cafe-col';
        }
        $css_class .= $settings['css_class'];

        $repeater = $settings['repeater'];

        if ($repeater && is_array($repeater)) {
            foreach ($repeater as $value) { ?>
                <?php
                $open_link = '';
                $close_link = '';
                if ($value['link']['url'] != '') {
                    $open_link = '<a href="' . esc_url($value['link']['url']) . '"';
                    $open_link .= $value['link']['is_external'] == 'on' ? 'target="_blank"' : '';
                    $open_link .= $value['link']['nofollow'] == 'on' ? 'rel="nofollow"' : '';
                    $open_link .= '>';
                    $close_link = '</a>';
                }
                $allow_html = array(
                    'a' => array(
                        'class' => array(),
                        'href' => array(),
                        'rel' => array(),
                        'target' => array(),
                    )
                )
                ?>
                <div class="<?php echo esc_attr($css_class) ?>">
                    <?php
                    echo wp_kses($open_link, $allow_html);
                    ?>
                    <div class="cafe-wrap-image">
                        <img src="<?php echo esc_url($value['image']['url']) ?>"/>
                    </div>
                    <div class="cafe-wrap-content">
                        <div class="cafe-wrap-content-inner">
                            <?php
                            if ($value['title']) {
                                printf('<%s %s>%s</%s>', Utils::validate_html_tag($value['title_tag']), $this->get_render_attribute_string('title'), $value['title'], Utils::validate_html_tag($value['title_tag']));
                            }
                            ?>
                            <div class="cafe-wrap-extend-content">
                                <?php
                                if ($value['des']) {
                                    printf('<div %s>%s</div>', $this->get_render_attribute_string('des'), $value['des']);
                                }
                                $icon_left = '';
                                $icon_right = '';
                                if ($value['button_label'] != '') {
                                    if ($value['button_icon'] != '') {
                                        if ($value['button_icon_pos'] == 'before') {
                                            $icon_left = '<i class="' . $value['button_icon'] . '"></i>';
                                        } else {
                                            $icon_right = '<i class="' . $value['button_icon'] . '"></i>';
                                        }
                                    }
                                    if ($value['button_label']) {
                                        printf('<span %s>%s %s %s</span>', $this->get_render_attribute_string('button_label'), $icon_left, $value['button_label'], $icon_right);
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                    echo wp_kses($close_link, $allow_html);
                    ?>
                </div>
                <?php
            }
        }
        ?>
    </div>
</div>