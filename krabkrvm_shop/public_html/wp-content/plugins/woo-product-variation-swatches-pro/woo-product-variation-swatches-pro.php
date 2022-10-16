<?php
/**
 * Plugin Name:             Variation Swatches for WooCommerce Pro
 * Plugin URI:              https://radiustheme.com
 * Description:             Variation Swatches for WooCommerce change beautiful colors, images and buttons variation swatches for WooCommerce product attributes
 * Version:                 1.1.35
 * Author:                  RadiusTheme
 * Author URI:              https://radiustheme.com
 * Requires at least:       4.8
 * Tested up to:            5.5
 * WC requires at least:    3.2
 * WC tested up to:         4.0
 * Domain Path:             /languages
 * Text Domain:             woo-product-variation-swatches
 */

// Define RTWPVS_PRO_PLUGIN_FILE.
if ( ! defined( 'RTWPVS_PRO_PLUGIN_FILE' ) ) {
	define( 'RTWPVS_PRO_PLUGIN_FILE', __FILE__ );
}

// Define RTCL_PLUGIN_FILE.
if ( ! defined( 'RTWPVS_PRO_VERSION' ) ) {
	$plugin_data = get_file_data( __FILE__, array( 'version' => 'Version', 'author' => 'Author' ), false );
	define( 'RTWPVS_PRO_VERSION', $plugin_data['version'] );
	define( 'RTWPVS_PRO_AUTHOR', $plugin_data['author'] );
}


if ( ! class_exists( 'WooProductVariationSwatchesPro' ) ) {
	require_once( "app/WooProductVariationSwatchesPro.php" );
}