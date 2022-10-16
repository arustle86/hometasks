<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.1
 */

namespace radiustheme\Metro;

class TGM_Config {

	public $prefix;
	public $path;

	public function __construct() {
		$this->prefix = Constants::$theme_prefix;
		$this->path   = Constants::$theme_plugins_dir;

		add_action( 'tgmpa_register', array( $this, 'register_required_plugins' ) );
	}

	public function register_required_plugins(){
		$plugins = array(
			// Bundled
			array(
				'name'         => 'Metro Core',
				'slug'         => 'metro-core',
				'source'       => 'metro-core.zip',
				'required'     =>  true,
				'version'      => '1.6.2'
			),
			array(
				'name'         => 'RT Framework',
				'slug'         => 'rt-framework',
				'source'       => 'rt-framework.zip',
				'required'     =>  true,
				'version'      => '2.8'
			),
			array(
				'name'         => 'RT Demo Importer',
				'slug'         => 'rt-demo-importer',
				'source'       => 'rt-demo-importer.zip',
				'required'     =>  false,
				'version'      => '4.1'
			),
			array(
				'name'         => 'LayerSlider WP',
				'slug'         => 'LayerSlider',
				'source'       => 'LayerSlider.zip',
				'required'     => false,
				'version'      => '6.11.8'

			),
			array(
				'name'         => 'WooCommerce Variation Swatches Pro',
				'slug'         => 'woo-product-variation-swatches-pro',
				'source'       => 'woo-product-variation-swatches-pro.zip',
				'required'     => false,
				'version'      => '1.1.35'
			),
			array(
				'name'         => 'WooCommerce Variation images gallery Pro',
				'slug'         => 'woo-product-variation-gallery-pro',
				'source'       => 'woo-product-variation-gallery-pro.zip',
				'required'     => false,
				'version'      => '1.1.0'
			),
			array(
				'name'         => 'WP SEO Structured Data Schema Pro',
				'slug'         => 'wp-seo-structured-data-schema-pro',
				'source'       => 'wp-seo-structured-data-schema-pro.zip',
				'required'     => false,
				'external_url' => 'https://wpsemplugins.com/',
				'version'      => '1.3.15'
			),
			// Repository
			array(
				'name'     => 'Redux Framework',
				'slug'     => 'redux-framework',
				'required' => true,
			),
			array(
				'name'     => 'Elementor Page Builder',
				'slug'     => 'elementor',
				'required' => true,
			),
			array(
				'name'     => 'Contact Form 7',
				'slug'     => 'contact-form-7',
				'required' => false,
			),
			array(
				'name'     => 'Contact Form 7 Extension For Mailchimp',
				'slug'     => 'contact-form-7-mailchimp-extension',
				'required' => false,
			),
			array(
				'name'     => 'Smash Balloon Instagram Feed',
				'slug'     => 'instagram-feed',
				'required' => false,
			),
			array(
				'name'     => 'WooCommerce',
				'slug'     => 'woocommerce',
				'required' => false,
			),
			array(
				'name'     => 'YITH WooCommerce Quick View',
				'slug'     => 'yith-woocommerce-quick-view',
				'required' => false,
			),
			array(
				'name'     => 'YITH WooCommerce Wishlist',
				'slug'     => 'yith-woocommerce-wishlist',
				'required' => false,
			),
		);

		$config = array(
			'id'           => $this->prefix,            // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => $this->path,              // Default absolute path to bundled plugins.
			'menu'         => $this->prefix . '-install-plugins', // Menu slug.
			'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		);

		tgmpa( $plugins, $config );
	}
}

new TGM_Config;