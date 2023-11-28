<?php
/**
 * View template for Clever Site Nav Menu
 *
 * @package CAFE\Templates
 * @copyright 2018 CleverSoft. All rights reserved.
 */

$container_class = 'cafe-site-offcanvas hamburger';
if ($settings['hamburger_style'] != '')
    $container_class .= ' cafe-hamburger-' . $settings['hamburger_style'] . '-effect';
if ($settings['canvas_position'] != '')
    $container_class .= ' ' . $settings['canvas_position'];

$elementor_fontend_builder = Elementor\Plugin::$instance->frontend;

if ($settings['offcanvas_content'] != '') {
    $toggle_id = 'cafe-hamburger-toggle-' . uniqid();
    ?>
    <div class="<?php echo esc_attr($container_class) ?>">
        <input id="<?php echo esc_attr($toggle_id); ?>" class="cafe-hamburger-input-control" type="checkbox"/>
        <label class="cafe-hamburger-button" for="<?php echo esc_attr($toggle_id); ?>">
            <span class="cafe-wrap-hamburger-icon"><span class="cafe-hamburger-icon"></span></span>
            <?php echo $settings['hamburger_text'] ?>
        </label>
        <div class="cafe-wrap-offcanvas">
            <label class="cafe-hamburger-close-button" for="<?php echo esc_attr($toggle_id); ?>">
                <i class="cs-font clever-icon-close"></i>
            </label>
            <?php
            $template = get_page_by_path($settings['offcanvas_content'], OBJECT, 'elementor_library');
            if ($template) {
                echo $elementor_fontend_builder->get_builder_content_for_display($template->ID, false);
            }
            ?>
        </div>
        <label class="cafe-hamburger-mask" for="<?php echo esc_attr($toggle_id); ?>"></label>
    </div>
    <?php
}