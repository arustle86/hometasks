<?php
/**
 * Plugin Name: WP SEO Structured Data Schema Pro
 * Plugin URI: https://wpsemplugins.com/
 * Description: Comprehensive JSON-LD based Structured Data solution for WordPress for adding schema for organizations, businesses, blog posts, ratings & more.
 * Version: 1.3.15
 * Author: WPSEMPlugins
 * Author URI: https://wpsemplugins.com/
 * Text Domain:  wp-seo-structured-data-schema-pro
 * Domain Path:  /languages
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Define KCSEO_VERSION VERSION.
if ( ! defined( 'KCSEO_VERSION' ) ) {
	$plugin_data = get_file_data( __FILE__, array( 'version' => 'Version' ), false );
	define( 'KCSEO_VERSION', $plugin_data['version'] );
}
if ( ! defined( 'JSON_UNESCAPED_SLASHES' ) ) {
	define( 'JSON_UNESCAPED_SLASHES', 64 );
}
if ( ! defined( 'JSON_PRETTY_PRINT' ) ) {
	define( 'JSON_PRETTY_PRINT', 128 );
}
if ( ! defined( 'JSON_UNESCAPED_UNICODE' ) ) {
	define( 'JSON_UNESCAPED_UNICODE', 256 );
}

$plugin_data = get_file_data( __FILE__, array(
	'version' => 'Version',
	'name'    => 'Plugin Name',
	'author'  => 'Author'
), false );
define( 'KCSEO_WP_SCHEMA_VERSION', $plugin_data['version'] );
define( 'KCSEO_WP_SCHEMA_NAME', $plugin_data['name'] );
define( 'KCSEO_WP_SCHEMA_AUTHOR', $plugin_data['author'] );
define( 'EDD_KCSEO_WP_SCHEMA_STORE_URL', 'https://wpsemplugins.com' );
define( 'EDD_KCSEO_WP_SCHEMA_ITEM_ID', 45 );
define( 'KCSEO_WP_SCHEMA_SLUG', 'wp-seo-structured-data-schema-pro' );
define( 'KCSEO_WP_SCHEMA_PATH', dirname( __FILE__ ) );
define( 'KCSEO_WP_SCHEMA_PLUGIN_ACTIVE_FILE_NAME', __FILE__ );
define( 'KCSEO_WP_SCHEMA_URL', plugins_url( '', __FILE__ ) );
define( 'KCSEO_WP_SCHEMA_LANGUAGE_PATH', dirname( plugin_basename( __FILE__ ) ) . '/languages' );

require( 'lib/init.php' );
register_uninstall_hook( __FILE__, 'KCSEO_uninstall' );

if ( ! function_exists( 'KCSEO_uninstall' ) ) {
	function KCSEO_uninstall() {
		$settings = get_option( kcseo()->options['main_settings'] );
		$pt       = ! empty( $settings['post-type'] ) ? $settings['post-type'] : array( 'post', 'page' );
		if ( ! empty( $settings['delete-data'] ) ) {
			$schemaFields = KcSeoOptions::getSchemaTypes();

			$args  = array(
				'post_type'      => $pt,
				'posts_per_page' => '-1'
			);
			$pages = new WP_Query ( $args );
			if ( $pages->have_posts() ) {

				while ( $pages->have_posts() ) {
					$pages->the_post();
					foreach ( $schemaFields as $schemaID => $schema ) {
						delete_post_meta( get_the_ID(), '_schema_' . $schemaID );
						delete_post_meta( get_the_ID(), '_schema_' . $schemaID . "_multiple" );
					}
				}
				wp_reset_postdata();
			}
		}

	}
}