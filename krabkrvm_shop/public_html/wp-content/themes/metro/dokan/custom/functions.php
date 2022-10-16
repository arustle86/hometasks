<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

class Dokan_Functions {

	protected static $instance = null;

	public function __construct() {
		/* Title */
		add_filter( 'rdtheme_page_title',           array( $this, 'store_title' ) );

		/* Breadcrumb */
		add_filter( 'breadcrumb_trail_items',       array( $this, 'breadcrumb_items' ) );

		/* Product Edit page container */
		add_action( 'dokan_dashboard_wrap_before',  array( $this, 'start_wrapper' ) );
		add_action( 'dokan_dashboard_wrap_after',   array( $this, 'end_wrapper' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function store_title( $title ) {
		if ( dokan_is_store_page() ) {
			$store_user = dokan()->vendor->get( get_query_var( 'author' ) );
			$title = $store_user->get_shop_name();
		}
		
		return $title;
	}

	public function breadcrumb_items( $crumbs ) {
		if ( ! dokan_is_store_page() ) {
			return $crumbs;
		}

		$custom_store_url = dokan_get_option( 'custom_store_url', 'dokan_general', 'store' );
		$store_url        = site_url() . '/' . $custom_store_url;
		$author           = get_query_var( $custom_store_url );

		$crumbs[] = sprintf('<a href="%s">%s</a>', $store_url, ucwords( $custom_store_url ) );
		$crumbs[] = ucwords( $author );

		return $crumbs;
	}

	public function start_wrapper() {
		if ( !dokan_is_product_edit_page() ) {
			return;
		}

		echo '<div id="primary" class="content-area"><div class="container"><div id="main-content" class="main-content">';
	}

	public function end_wrapper() {
		if ( !dokan_is_product_edit_page() ) {
			return;
		}

		echo '</div></div></div>';
	}
}

Dokan_Functions::instance();