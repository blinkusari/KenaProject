<?php
/**
 * View template for Hot Spots widget
 *
 * @package CAFE\Templates
 * @copyright 2020 CleverSoft. All rights reserved.
 */
if ($settings['img']['url'] != '') {
    $class = 'cafe-hot-spots';
    if ($settings['hot_spot_effect'] != 'none') {
        $class .= ' ' . $settings['hot_spot_effect'] . '-effect';
    }
    $class .= ' content-' . $settings['hot_spot_content_effect'] . '-effect';
    ?>
    <div class="<?php echo esc_attr($class); ?>">
        <img src="<?php echo esc_url($settings['img']['url']) ?>" class="cafe-hot-spots-img" alt=""/>
        <?php
        foreach ($settings['hot_spots'] as $hot_spot) {
            ?>
            <div class="elementor-repeater-item-<?php echo esc_attr($hot_spot['_id']); ?> cafe-hot-spot">
                <span class="cafe-hot-spot-icon"><i class="<?php echo esc_attr($hot_spot['spot_icon']) ?>"></i></span>
                <?php if ($hot_spot['spot_title'] != '' || $hot_spot['spot_des'] != '') { ?>
                    <div class="cafe-hot-spot-content <?php echo esc_attr('content-' . $hot_spot['spot_content_pos']); ?>">
                        <div class="wrap-content-hot-spot">
                            <?php
                            if ($hot_spot['spot_title'] != '') {
                                ?>
                                <h3 class="hot-spot-title"><?php echo esc_html($hot_spot['spot_title']); ?></h3>
                                <?php
                            }
                            if ($hot_spot['spot_des'] != '') {
                                ?>
                                <div class="hot-spot-des"><?php echo wp_kses_post($hot_spot['spot_des']); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>