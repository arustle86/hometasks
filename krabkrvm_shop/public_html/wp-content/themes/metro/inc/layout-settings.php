<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

class Layouts {

	use Layout_Trait;

	protected static $instance = null;

	public $prefix;
	public $type;
	public $meta_value;

	public function __construct() {
		$this->prefix  = Constants::$theme_prefix;
		
		add_action( 'template_redirect', array( $this, 'layout_settings' ) );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function layout_settings() {
		// Single Pages
		if( ( is_single() || is_page() ) ) {
			$post_type        = get_post_type();
			$post_id          = get_the_id();
			$this->meta_value = get_post_meta( $post_id, "{$this->prefix}_layout_settings", true );
			
			switch( $post_type ) {
				case 'page':
				$this->type = 'page';
				break;
				case 'post':
				$this->type = 'single_post';
				break;
				case 'product':
				$this->type = 'product';
				break;
				default:
				$this->type = 'page';
				break;
			}

			RDTheme::$layout              = $this->meta_layout_option( 'layout' );
			RDTheme::$sidebar             = $this->meta_layout_option( 'sidebar' );
			RDTheme::$has_top_bar         = $this->meta_layout_global_option( 'top_bar', true );
			RDTheme::$top_bar_style       = $this->meta_layout_global_option( 'top_bar_style' );
			RDTheme::$header_style        = $this->meta_layout_global_option( 'header_style' );
			RDTheme::$has_banner          = $this->meta_layout_global_option( 'banner', true );
			RDTheme::$has_breadcrumb      = $this->meta_layout_global_option( 'breadcrumb', true );
			RDTheme::$bgtype              = $this->meta_layout_global_option( 'bgtype' );
			RDTheme::$bgimg               = $this->bgimg_option( 'bgimg' );
			RDTheme::$bgcolor             = $this->meta_layout_global_option( 'bgcolor' );
			RDTheme::$footer_area_style   = $this->meta_layout_global_option( 'footer_area_style' );
		}

		// Blog and Archive
		elseif( is_home() || is_archive() || is_search() || is_404() || Helper::is_page( 'is_woocommerce' ) || Helper::is_page( 'dokan_is_store_page' ) ) {

			if( is_search() ) {
				$this->type = 'search';
			}
			elseif( is_404() ) {
				$this->type = 'error';
				RDTheme::$options[$this->type . '_layout'] = 'full-width';
			}
			elseif( Helper::is_page( 'is_woocommerce' ) ) {
				$this->type = 'shop';
			}
			elseif( Helper::is_page( 'dokan_is_store_page' ) ) {
				$this->type = 'store';
			}
			else {
				$this->type = 'blog';
			}

			RDTheme::$layout              = $this->layout_option( 'layout' );
			RDTheme::$sidebar             = $this->layout_option( 'sidebar' );
			RDTheme::$has_top_bar         = $this->layout_global_option( 'top_bar', true );
			RDTheme::$top_bar_style       = $this->layout_global_option( 'top_bar_style' );
			RDTheme::$header_style        = $this->layout_global_option( 'header_style' );
			RDTheme::$has_banner          = $this->layout_global_option( 'banner', true );
			RDTheme::$has_breadcrumb      = $this->layout_global_option( 'breadcrumb', true );
			RDTheme::$bgtype              = $this->layout_global_option( 'bgtype' );
			RDTheme::$bgimg               = $this->bgimg_option( 'bgimg', false );
			RDTheme::$bgcolor             = $this->layout_global_option( 'bgcolor' );
			RDTheme::$footer_area_style   = $this->layout_global_option( 'footer_area_style' );
		}
	}
}

Layouts::instance();