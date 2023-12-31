<?php
/**
 * View template for Clever Icon widget
 *
 * @package CAFE\Templates
 * @copyright 2018 CleverSoft. All rights reserved.
 */

$open_link  = '';
$close_link = '';
$url        = '#';
$target     = '';
$follow     = '';
if ( $settings['icon'] != '' ) {
	$icon = '<i class="' . $settings['icon'] . '"></i>';

	if ( $settings['link']['url'] != '' ) {
		$url    = $settings['link']['url'];
		$target = $settings['link']['is_external'] == 'on' ? 'target="_blank"' : '';
		$follow = $settings['link']['nofollow'] == 'on' ? 'rel="nofollow"' : '';
		printf( '<a href="%s" %s %s>', $url, $target, $follow );
	}
	if($icon){
		printf( '<span class="cafe-icon">%s</span>', $icon );
	}
	if($settings['title']){
		printf( '<h3 %s>%s</h3>', $this->get_render_attribute_string( 'title' ), $settings['title'] );
	}
	if($settings['des']){
		printf( '<p %s>%s</p>', $this->get_render_attribute_string( 'des' ), $settings['des'] );
	}
	if ( $settings['link']['url'] != '' ) {
		?>
        </a>
		<?php
	}
}
