<?php
/**
 * Plugin Name:         Variation Images Gallery for WooCommerce Pro
 * Plugin URI:          https://radiustheme.com
 * Description:         Great plugin for WooCommerce Variation images gallery. This is most flexible WooCommerce variation product image gallery plugin.
 * Version:             1.1.0
 * Author:              RadiusTheme
 * Author URI:          https://radiustheme.com
 * Requires at least:   4.8
 * Tested up to:        5.5
 * WC requires at least:3.2
 * WC tested up to:     4.0
 * Domain Path:         /languages
 * Text Domain:         woo-product-variation-gallery
 */

defined('ABSPATH') or die('Keep Silent');

// Define RTWPVG_PRO_PLUGIN_FILE.
if (!defined('RTWPVG_PRO_PLUGIN_FILE')) {
    define('RTWPVG_PRO_PLUGIN_FILE', __FILE__);
}

// Define RTWPVG_PRO_VERSION.
if (!defined('RTWPVG_PRO_VERSION')) {
    $plugin_data = get_file_data(RTWPVG_PRO_PLUGIN_FILE, array('version' => 'Version', 'author' => 'Author'), false);
    define('RTWPVG_PRO_VERSION', $plugin_data['version']);
    define('RTWPVG_PRO_AUTHOR', $plugin_data['author']);
}

if (!class_exists('WooProductVariationGalleryPro')) {
    require_once("app/WooProductVariationGalleryPro.php");
}
