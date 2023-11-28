<?php
/**
 * Meta box for theme
 *
 * @package     Zoo Theme
 * @version     1.0.0
 * @core        3.0.0
 * @author      Zootemplate
 * @link        https://www.zootemplate.com/
 * @copyright   Copyright (c) 2018 ZooTemplate
 */

if ( class_exists( 'RWMB_Loader' ) ):
	add_filter( 'rwmb_meta_boxes', 'zoo_meta_box_options' );
	if ( ! function_exists( 'zoo_meta_box_options' ) ) {
		function zoo_meta_box_options() {
			$zoo_prefix       = "zoo_";
			$zoo_meta_boxes   = array();
			$zoo_meta_boxes[] = array(
				'id'      => $zoo_prefix . 'single_post_heading',
				'title'   => esc_html__( 'Sidebar Config', 'fona' ),
				'pages'   => array( 'post' ),
				'context' => 'side',
				'fields'  => array(
					array(
						'id'      => $zoo_prefix . "blog_single_sidebar_config",
						'type'    => 'select',
						'options' => array(
							'inherit' => esc_html__( 'Inherit', 'fona' ),
							'left'    => esc_html__( 'Left', 'fona' ),
							'right'   => esc_html__( 'Right', 'fona' ),
							'none'    => esc_html__( 'None', 'fona' ),
						),
						'std'     => 'inherit',
						'desc'    => esc_html__( 'Select sidebar layout you want set for this post.', 'fona' )
					),
				)
			);
			//All page
			$zoo_meta_boxes[] = array(
				'id'      => $zoo_prefix . 'layout_single_heading',
				'title'   => esc_html__( 'Layout Single Product', 'fona' ),
				'pages'   => array( 'product' ),
				'context' => 'advanced',
				'fields'  => array(
					array(
						'name'    => esc_html__( 'Layout Options', 'fona' ),
						'id'      => $zoo_prefix . "single_product_layout",
						'type'    => 'select',
						'options' => array(
							'inherit'          => esc_html__( 'Inherit', 'fona' ),
							'vertical-thumb'   => esc_html__( 'Product V1', 'fona' ),
							'horizontal-thumb' => esc_html__( 'Product V2', 'fona' ),
							'carousel'         => esc_html__( 'Product V3', 'fona' ),
							'grid-thumb'       => esc_html__( 'Product V4', 'fona' ),
							'sticky-1'         => esc_html__( 'Product V5', 'fona' ),
							'sticky-2'         => esc_html__( 'Product V6', 'fona' ),
							'sticky-3'         => esc_html__( 'Product V7', 'fona' ),
							//'accordion'        => esc_html__( 'Product V7', 'fona' ),
							'custom'           => esc_html__( 'Custom', 'fona' ),
						),
						'std'     => 'inherit',
					),
					array(
						'name'    => esc_html__( 'Content Options', 'fona' ),
						'id'      => $zoo_prefix . "single_product_content_layout",
						'type'    => 'select',
						'options' => array(
							'inherit'        => esc_html__( 'Inherit', 'fona' ),
							'right_content'  => esc_html__( 'Right Content', 'fona' ),
							'left_content'   => esc_html__( 'Left Content', 'fona' ),
							'full_content'   => esc_html__( 'Full width Content', 'fona' ),
							'sticky_content' => esc_html__( 'Sticky Content', 'fona' ),
						),
						'std'     => 'inherit',
					),
					array(
						'name'    => esc_html__( 'Gallery Options', 'fona' ),
						'id'      => $zoo_prefix . "product_gallery_layout",
						'type'    => 'select',
						'options' => array(
							'inherit'        => esc_html__( 'Inherit', 'fona' ),
							'vertical-left'  => esc_html__( 'Vertical Left Thumb', 'fona' ),
							'vertical-right' => esc_html__( 'Vertical Right Thumb', 'fona' ),
							'horizontal'     => esc_html__( 'Horizontal', 'fona' ),
							'slider'         => esc_html__( 'Slider', 'fona' ),
							'grid'           => esc_html__( 'Grid', 'fona' ),
							'sticky'         => esc_html__( 'Sticky', 'fona' ),
						),
						'std'     => 'inherit',
					),
					array(
						'name'    => esc_html__( 'Gallery Columns', 'fona' ),
						'id'      => $zoo_prefix . "product_gallery_columns",
						'type'    => 'select',
						'options' => array(
							'6' => esc_html__( '6', 'fona' ),
							'5' => esc_html__( '5', 'fona' ),
							'4' => esc_html__( '4', 'fona' ),
							'3' => esc_html__( '3', 'fona' ),
							'2' => esc_html__( '2', 'fona' ),
							'1' => esc_html__( '1', 'fona' ),
							'inherit' => esc_html__( 'Inherit', 'fona' ),
						),
						'std'     => 'inherit',
					),
				)
			);
			$zoo_meta_boxes[] = array(
				'id'      => $zoo_prefix . 'single_product_image_360_heading',
				'title'   => esc_html__( 'Product image 360 view', 'fona' ),
				'pages'   => array( 'product' ),
				'context' => 'advanced',
				'fields'  => array(
					array(
						'id'   => $zoo_prefix . "single_product_image_360",
						'name' => esc_html__( 'Images', 'fona' ),
						'type' => 'image_advanced',
						'desc' => esc_html__( 'Images for 360 degree view.', 'fona' )
					),
				)
			);
			$zoo_meta_boxes[] = array(
				'id'      => $zoo_prefix . 'single_product_video_heading',
				'title'   => esc_html__( 'Product Video', 'fona' ),
				'pages'   => array( 'product' ),
				'context' => 'side',
				'fields'  => array(
					array(
						'id'   => $zoo_prefix . "single_product_video",
						'type' => 'oembed',
						'desc' => esc_html__( 'Enter your embed video url.', 'fona' )
					),
				)
			);
			$zoo_meta_boxes[] = array(
				'id'      => $zoo_prefix . 'single_product_new_heading',
				'title'   => esc_html__( 'Assign product is New', 'fona' ),
				'pages'   => array( 'product' ),
				'context' => 'side',
				'fields'  => array(
					array(
						'id'   => $zoo_prefix . "single_product_new",
						'std'  => '0',
						'type' => 'checkbox',
						'desc' => esc_html__( 'Is New Product.', 'fona' )
					),
				)
			);
			$zoo_meta_boxes[] = array(
				'id'      => 'title_meta_box',
				'title'   => esc_html__( 'Layout Options', 'fona' ),
				'pages'   => array( 'page', 'post' ),
				'context' => 'advanced',
				'fields'  => array(
					array(
						'name' => esc_html__( 'Title & Breadcrumbs Options', 'fona' ),
						'desc' => esc_html__( '', 'fona' ),
						'id'   => $zoo_prefix . "heading_title",
						'type' => 'heading'
					),
					array(
						'name' => esc_html__( 'Disable Title', 'fona' ),
						'desc' => esc_html__( '', 'fona' ),
						'id'   => $zoo_prefix . "disable_title",
						'std'  => '0',
						'type' => 'checkbox'
					),
					array(
						'name' => esc_html__( 'Disable Breadcrumbs', 'fona' ),
						'desc' => esc_html__( '', 'fona' ),
						'id'   => $zoo_prefix . "disable_breadcrumbs",
						'std'  => '0',
						'type' => 'checkbox'
					),
					array(
						'name' => esc_html__( 'Page Layout', 'fona' ),
						'desc' => esc_html__( '', 'fona' ),
						'id'   => $zoo_prefix . "body_heading",
						'type' => 'heading'
					),
					array(
						'name'    => esc_html__( 'Layout Options', 'fona' ),
						'id'      => $zoo_prefix . "site_layout",
						'type'    => 'select',
						'options' => array(
							'inherit'    => esc_html__( 'Inherit', 'fona' ),
							'normal'     => esc_html__( 'Normal', 'fona' ),
							'boxed'      => esc_html__( 'Boxed', 'fona' ),
							'full-width' => esc_html__( 'Full Width', 'fona' ),
						),
						'std'     => 'inherit',
					),
					array(
						'name' => esc_html__( 'Page Max Width', 'fona' ),
						'desc' => esc_html__( 'Accept only number. If not set, it will follow customize config.', 'fona' ),
						'id'   => $zoo_prefix . "site_max_width",
						'type' => 'number'
					),
				)
			);

			return $zoo_meta_boxes;
		}
	}
endif;