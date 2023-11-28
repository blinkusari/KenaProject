<?php
/**
 * View template for Clever Team Member widget
 *
 * @package CAFE\Templates
 * @copyright 2018 CleverSoft. All rights reserved.
 */
$cafe_wrap_class = 'cafe-team-member has-social has-member-bio ' . $settings['style'] . ' ';

$cafe_json_config = '';
if($settings['layout'] == 'grid'){
    $grid_class                  = 'grid-layout';
    $grid_class = ' cafe-wrap  cafe-grid-lg-' . $settings['columns']['size'] . '-cols cafe-grid-md-' . $settings['columns_tablet']['size'] . '-cols cafe-grid-' . $settings['columns_mobile']['size'] .'-cols';
    $cafe_wrap_class .= $grid_class;

}
if($settings['layout'] == 'carousel'){
    $cafe_wrap_class    .= 'grid-layout carousel';
    $cafe_wrap_class    .= ' ' . $settings['nav_position'];
    $cafe_wrap_class    .= ' cafe-carousel cafe-wrap';

    $settings['autoplay'] = $settings['autoplay'] ? $settings['autoplay'] : 'false';
    $settings['autoplay_tablet'] = $settings['autoplay_tablet']? $settings['autoplay_tablet'] : 'false';
    $settings['autoplay_mobile'] = $settings['autoplay_mobile'] ? $settings['autoplay_mobile'] : 'false';

    $settings['show_pag'] = $settings['show_pag'] ? $settings['show_pag'] : 'false';
    $settings['show_pag_tablet'] = $settings['show_pag_tablet'] ? $settings['show_pag_tablet'] : 'false';
    $settings['show_pag_mobile'] = $settings['show_pag_mobile'] ? $settings['show_pag_mobile'] : 'false';

    $settings['show_nav'] = $settings['show_nav'] ? $settings['show_nav'] : 'false';
    $settings['show_nav_tablet'] = $settings['show_nav_tablet'] ? $settings['show_nav_tablet'] : 'false';
    $settings['show_nav_mobile'] = $settings['show_nav_mobile'] ? $settings['show_nav_mobile'] : 'false';
    $settings['speed']=$settings['speed']?$settings['speed']:3000;
    $cafe_json_config = '{
        "slides_to_show" : ' . $settings['slides_to_show']['size'] . ',
        "slides_to_show_tablet" : ' . ($settings['slides_to_show_tablet']['size']?$settings['slides_to_show_tablet']['size']:3) . ',
        "slides_to_show_mobile" : ' . ($settings['slides_to_show_mobile']['size']?$settings['slides_to_show_mobile']['size']:2) . ',

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

        "wrap": ".cafe-row"
    }';
}?>
<div class="<?php echo esc_attr($cafe_wrap_class) ?> " data-cafe-config='<?php echo esc_attr($cafe_json_config) ?>'>
   <div class="cafe-row">
        <?php
        $repeater = $settings['repeater'];
        $social_html = '';
        $open_link_1 = $open_link_2 = $open_link_3 = $open_link_4 = $open_link_5 = '';
        $close_link_1 = $close_link_2 = $close_link_3 = $close_link_4 = $close_link_5 = '';

        if($repeater && is_array($repeater)){
            foreach ($repeater as $value) { 
                if ($value['member_ava'] != '') {
                    if ($value['social_url_1']['url'] != '') {
                        $open_link_1 = '<li class="cafe-member-social-item"><a href="' . $value['social_url_1']['url'] . '" title="' . $value['social_title_1'] . '"';
                        $open_link_1 .= $value['social_url_1']['is_external'] == 'on' ? ' target="_blank" ' : '';
                        $open_link_1 .= $value['social_url_1']['nofollow'] == 'on' ? ' rel="nofollow" ' : '';
                        $open_link_1 .= '>';
                        $close_link_1 = '</a></li>';
                    }
                    if ($value['social_url_2']['url'] != '') {
                        $open_link_2 = '<li class="cafe-member-social-item"><a href="' . $value['social_url_2']['url'] . '" title="' . $value['social_title_2'] . '"';
                        $open_link_2 .= $value['social_url_2']['is_external'] == 'on' ? ' target="_blank" ' : '';
                        $open_link_2 .= $value['social_url_2']['nofollow'] == 'on' ? ' rel="nofollow" ' : '';
                        $open_link_2 .= '>';
                        $close_link_2 = '</a></li>';
                    }
                    if ($value['social_url_3']['url'] != '') {
                        $open_link_3 = '<li class="cafe-member-social-item"><a href="' . $value['social_url_3']['url'] . '" title="' . $value['social_title_3'] . '"';
                        $open_link_3 .= $value['social_url_3']['is_external'] == 'on' ? ' target="_blank" ' : '';
                        $open_link_3 .= $value['social_url_3']['nofollow'] == 'on' ? ' rel="nofollow" ' : '';
                        $open_link_3 .= '>';
                        $close_link_3 = '</a></li>';
                    }
                    if ($value['social_url_4']['url'] != '') {
                        $open_link_4 = '<li class="cafe-member-social-item"><a href="' . $value['social_url_4']['url'] . '" title="' . $value['social_title_4'] . '"';
                        $open_link_4 .= $value['social_url_4']['is_external'] == 'on' ? ' target="_blank" ' : '';
                        $open_link_4 .= $value['social_url_4']['nofollow'] == 'on' ? ' rel="nofollow" ' : '';
                        $open_link_4 .= '>';
                        $close_link_4 = '</a></li>';
                    }
                    if ($value['social_url_5']['url'] != '') {
                        $open_link_5 = '<li class="cafe-member-social-item"><a href="' . $value['social_url_5']['url'] . '" title="' . $value['social_title_5'] . '"';
                        $open_link_5 .= $value['social_url_5']['is_external'] == 'on' ? ' target="_blank" ' : '';
                        $open_link_5 .= $value['social_url_5']['nofollow'] == 'on' ? ' rel="nofollow" ' : '';
                        $open_link_5 .= '>';
                        $close_link_5 = '</a></li>';
                    }
                    if($value['social_url_1']['url'] || $value['social_url_2']['url'] || $value['social_url_3']['url'] || $value['social_url_4']['url'] || $value['social_url_5']['url']){
                        $social_html = '<ul class="cafe-member-social">';
                        if ($value['social_url_1']['url'] != '') {
                            $social_html .= $open_link_1 . '<i class="' . $value['social_icon_1'] . '"></i>' . $close_link_1;
                        }
                        if ($value['social_url_2']['url'] != '') {
                            $social_html .= $open_link_2 . '<i class="' . $value['social_icon_2'] . '"></i>' . $close_link_2;
                        }
                        if ($value['social_url_3']['url'] != '') {
                            $social_html .= $open_link_3 . '<i class="' . $value['social_icon_3'] . '"></i>' . $close_link_3;
                        }
                        if ($value['social_url_4']['url'] != '') {
                            $social_html .= $open_link_4 . '<i class="' . $value['social_icon_4'] . '"></i>' . $close_link_4;
                        }
                        if ($value['social_url_5']['url'] != '') {
                            $social_html .= $open_link_5 . '<i class="' . $value['social_icon_5'] . '"></i>' . $close_link_5;
                        }       
                        $social_html .= '</ul>';

                    }
                }?>
                <div class="cafe-member cafe-col">
                    <?php
                    if ($value['member_ava'] != '') {
                        ?>
                        <div class="cafe-member-ava">
                            <?php
                            printf('<div class="mask-color"></div><img src="%s" alt="%s"/>', $value['member_ava']['url'], $value['member_name']);
                            if ($settings['style'] == 'style-2') {
                                ?>
                                <div class="cafe-wrap-team-member">
                                    <?php
                                    echo ent2ncr($social_html);
                                    ?>
                                </div>
                                <?php
                            }
                            if ($settings['style'] == 'style-4') {
                                echo ent2ncr($social_html);
                            }
                            ?>
                        </div>
                        <?php
                    }
                    if ($settings['style'] == 'style-1') {
                        ?>
                        <div class="cafe-wrap-team-member">
                            <?php
                            printf('<h3 %s>%s</h3>', $this->get_render_attribute_string('member_name'), $value['member_name']);
                            printf('<div class="cafe-member-des" %s>%s</div>', $this->get_render_attribute_string('member_des'), $value['member_des']);
                            printf('<div class="cafe-member-bio" %s>%s</div>', $this->get_render_attribute_string('member_bio'), $value['member_bio']);
                            echo ent2ncr($social_html);
                            ?>
                        </div>
                    <?php
                    }
                    if($settings['style'] == 'default'){
                        printf('<h3 %s>%s</h3>', $this->get_render_attribute_string('member_name'), $value['member_name']);
                        printf('<div class="cafe-member-des" %s>%s</div>', $this->get_render_attribute_string('member_des'), $value['member_des']);
                        printf('<div class="cafe-member-bio" %s>%s</div>', $this->get_render_attribute_string('member_bio'), $value['member_bio']);
                        echo ent2ncr($social_html);
                    }
                    if($settings['style'] == 'style-4' || $settings['style'] == 'style-2'){
                        printf('<h3 %s>%s</h3>', $this->get_render_attribute_string('member_name'), $value['member_name']);
                        printf('<div class="cafe-member-des" %s>%s</div>', $this->get_render_attribute_string('member_des'), $value['member_des']);
                        printf('<div class="cafe-member-bio" %s>%s</div>', $this->get_render_attribute_string('member_bio'), $value['member_bio']);
                    }
                    if ($settings['style'] == 'style-3') {
                        printf('<h3 class="cafe-member-name" %s>%s</h3>', $this->get_render_attribute_string('member_name'), $value['member_name']);
                        printf('<div class="cafe-member-des" %s>%s</div>', $this->get_render_attribute_string('member_des'), $value['member_des']);
                        if ($settings['style'] == 'style-3') {
                            ?>
                            <div class="wrap-member-bio">
                            <?php
                        }
                        printf('<div class="cafe-member-bio" %s>%s</div>', $this->get_render_attribute_string('member_bio'), $value['member_bio']);
                        if ($settings['style'] == 'style-3') {
                            echo ent2ncr($social_html);
                            ?>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
                <?php
                }  
            }
        ?>
    </div>
</div>