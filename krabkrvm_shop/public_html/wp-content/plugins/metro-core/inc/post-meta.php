<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use radiustheme\Metro\Helper;

if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'RT_Postmeta' ) ) {
	return;
}

$Postmeta = \RT_Postmeta::getInstance();

$prefix = METRO_CORE_THEME_PREFIX;

/*-------------------------------------
#. Layout Settings
---------------------------------------*/
$nav_menus = wp_get_nav_menus( array( 'fields' => 'id=>name' ) );
$nav_menus = array( 'default' => __( 'Default', 'metro-core' ) ) + $nav_menus;
$sidebars  = array( 'default' => __( 'Default', 'metro-core' ) ) + Helper::custom_sidebar_fields();

$Postmeta->add_meta_box( "{$prefix}_page_settings", __( 'Layout Settings', 'metro-core' ), array( 'page', 'post' ), '', '', 'high', array(
	'fields' => array(
		"{$prefix}_layout_settings" => array(
			'label'   => __( 'Layouts', 'metro-core' ),
			'type'    => 'group',
			'value'  => array(
				'layout' => array(
					'label'   => __( 'Layout', 'metro-core' ),
					'type'    => 'select',
					'options' => array(
						'default'       => __( 'Default', 'metro-core' ),
						'full-width'    => __( 'Full Width', 'metro-core' ),
						'left-sidebar'  => __( 'Left Sidebar', 'metro-core' ),
						'right-sidebar' => __( 'Right Sidebar', 'metro-core' ),
					),
					'default'  => 'default',
				),
				'sidebar' => array(
					'label'    => __( 'Custom Sidebar', 'metro-core' ),
					'type'     => 'select',
					'options'  => $sidebars,
					'default'  => 'default',
				),
				'top_bar' => array(
					'label'   => __( 'Top Bar', 'metro-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'metro-core' ),
						'on'	  => __( 'Enable', 'metro-core' ),
						'off'	  => __( 'Disable', 'metro-core' ),
					),
					'default'  => 'default',
				),
				'top_bar_style' => array(
					'label'   => __( 'Top Bar Layout', 'metro-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default',  'metro-core' ),
						'1'       => __( 'Layout 1', 'metro-core' ),
						'2'       => __( 'Layout 2', 'metro-core' ),
						'3'       => __( 'Layout 3', 'metro-core' ),
						'4'       => __( 'Layout 4', 'metro-core' ),
					),
					'default'  => 'default',
				),
				'header_style' => array(
					'label'   => __( 'Header Layout', 'metro-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default',  'metro-core' ),
						'1'       => __( 'Layout 1', 'metro-core' ),
						'2'       => __( 'Layout 2', 'metro-core' ),
						'3'       => __( 'Layout 3', 'metro-core' ),
						'4'       => __( 'Layout 4', 'metro-core' ),
						'5'       => __( 'Layout 5', 'metro-core' ),
						'6'       => __( 'Layout 6', 'metro-core' ),
						'7'       => __( 'Layout 7', 'metro-core' ),
						'8'       => __( 'Layout 8', 'metro-core' ),
						'9'       => __( 'Layout 9', 'metro-core' ),
						'10'       => __( 'Layout 10', 'metro-core' ),
						'11'       => __( 'Layout 11', 'metro-core' ),
					),
					'default'  => 'default',
				),

				'banner' => array(
					'label'   => __( 'Banner', 'metro-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'metro-core' ),
						'on'	  => __( 'Enable', 'metro-core' ),
						'off'	  => __( 'Disable', 'metro-core' ),
					),
					'default'  => 'default',
				),
				'breadcrumb' => array(
					'label'   => __( 'Breadcrumb', 'metro-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'metro-core' ),
						'on'      => __( 'Enable', 'metro-core' ),
						'off'	  => __( 'Disable', 'metro-core' ),
					),
					'default'  => 'default',
				),
				'bgtype' => array(
					'label'   => __( 'Banner Background Type', 'metro-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'metro-core' ),
						'bgimg'   => __( 'Background Image', 'metro-core' ),
						'bgcolor' => __( 'Background Color', 'metro-core' ),
					),
					'default' => 'default',
				),
				'bgimg' => array(
					'label' => __( 'Banner Background Image', 'metro-core' ),
					'type'  => 'image',
					'desc'  => __( 'If not selected, default will be used', 'metro-core' ),
				),
				'bgcolor' => array(
					'label' => __( 'Banner Background Color', 'metro-core' ),
					'type'  => 'color_picker',
					'desc'  => __( 'If not selected, default will be used', 'metro-core' ),
				),
				'footer_area_style' => array(
					'label'   => __( 'Display Dark Footer', 'metro-core' ),
					'type'    => 'select',
					'options' => array(
						'default' => __( 'Default', 'metro-core' ),
						'on'	  => __( 'Enable', 'metro-core' ),
						'off'	  => __( 'Disable', 'metro-core' ),
					),
					'default'  => 'default',
				),
			)
		)
	)
) );

/*-------------------------------------
#. Product Category Meta
---------------------------------------*/
$TaxMeta = \RT_TaxMeta::getInstance();
$TaxMeta->add_tax_meta( "{$prefix}_product_cat", 'product_cat', 10, array(
	"{$prefix}_icon" => array(
		'label' => __( 'Icon', 'metro-core' ),
		'type'  => 'image',
		'desc'  => __( 'Upload an icon. Supported image type: JPG, PNG, SVG', 'metro-core' ),
	),
));