<?php
/**
 * View template for Clever Text on Hover widget
 *
 * @package CAFE\Templates
 * @copyright 2018 CleverSoft. All rights reserved.
 */
?>
<div class="cafe-text-on-hover" data-image="<?php if ($settings['image']['url'] != ''){echo esc_url($settings['image']['url']);}?>"data-video="<?php if ($settings['media_url']['url'] != ''){echo esc_url($settings['media_url']['url']);}?>">
   <?php printf( '<span %s>%s</span>', $this->get_render_attribute_string( 'label' ), $settings['label'] );?>
</div>
