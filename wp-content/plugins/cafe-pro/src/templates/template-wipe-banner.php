<?php
/**
 * View template for Clever Banner widget
 *
 * @package CAFE\Templates
 * @copyright 2018 CleverSoft. All rights reserved.
 */

$css_class = 'cafe-wipe-banner ';
$cafe_content = $settings['content'];
?>
<div class="<?php echo esc_attr($css_class) ?>">
    <div class="cafe-wipe-banner-wrap">
        <div class="cafe-wrap-image">
            <div class="cafe-wiper">
                <?php
                foreach ($cafe_content as $item) {
                    $open_link = '';
                    $close_link = '';
                    if ($item['link']['url'] != '') {
                        $open_link = '<a href="' . esc_url($item['link']['url']) . '"';
                        $open_link .= $item['link']['is_external'] == 'on' ? ' target="_blank"' : '';
                        $open_link .= $item['link']['nofollow'] == 'on' ? ' rel="nofollow"' : '';
                        $open_link .= '>';
                        $close_link = '</a>';
                    }
                    echo $open_link;
                    ?>
                    <div class="cafe-banner-img"
                         style="background-image: url(<?php echo esc_url($item['image']['url']) ?>)"></div>
                    <?php
                    echo $close_link;
                } ?>
            </div>
        </div>
        <div class="cafe-wrap-content">
            <?php
            printf('<%s %s>%s</%s>', $settings['heading_1_tag'], $this->get_render_attribute_string('heading_1'), $settings['heading_1'], $settings['heading_1_tag']);
            ?>
            <div class="wrap-heading wrap-heading-2">
                <?php foreach ($cafe_content as $item) {
                    printf('<%s class="cafe-heading-2 cafe-heading">%s</%s>', $item['heading_2_tag'], $item['heading_2'], $item['heading_2_tag']);
                } ?>
            </div>
            <div class="wrap-heading wrap-heading-3">
                <?php foreach ($cafe_content as $item) {
                    printf('<%s class="cafe-heading-3 cafe-heading">%s</%s>', $item['heading_3_tag'], $item['heading_3'], $item['heading_3_tag']);
                } ?>
            </div>
        </div>
    </div>
</div>
