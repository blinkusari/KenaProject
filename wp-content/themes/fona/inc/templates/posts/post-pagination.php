<?php
/**
 * Post pagination template
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @core        3.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2018 ZooTemplate
 
 */

$zoo_pag_type = get_theme_mod( 'zoo_blog_pagination', 'numeric' );
 if ( $zoo_pag_type == 'infinity' || $zoo_pag_type == 'ajaxload' ) {
   $args = array(
      'type'                 => $zoo_pag_type,                             // Default: infinity.
      'delay'                => 500,
      'container_selector'   => '.zoo-container',
      'item_selector'        => '.post',
      'more_text'            => esc_html__('Load More', 'fona'),     // or use filter hook: zoo_ajax_pagination_more_text
      'no_more_text'         => esc_html__('No More Posts', 'fona'), // or use filter hook: zoo_ajax_pagination_no_more_text
   );

   zoo_ajax_pagination( $GLOBALS['wp_query'], $args );

 } else if ( $zoo_pag_type == 'simple' ) {
     ?>
     <div class="zoo-wrap-pagination primary-font simple">
         <div class="prev-page">
             <?php
             previous_posts_link(esc_html__('Previous page', 'fona'));
             ?>
         </div>
         <div class="next-page">
             <?php
             next_posts_link(esc_html__('Next page', 'fona'));
             ?>
         </div>
     </div>
     <?php
 } else if ( $zoo_pag_type == 'numeric' ) {
     the_posts_pagination( array(
         'prev_text'          =>'<i class="zoo-icon-long-arrow-left"></i>',
         'next_text'          => '<i class="zoo-icon-long-arrow-right"></i>',
         'before_page_number' => '',
     ) );
 }
