<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro;

class Activation {

	protected static $instance = null;

	public function __construct() {
		add_action( 'after_switch_theme', array( $this, 'init' ) );
		$this->woo_product_variation_swatches_pro_init();
		$this->woo_product_variation_gallery_pro_init();
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	public function init() {
		if ( !get_option( 'metro_activated_before' ) ) {
			update_option( 'metro_activated_before', 'yes' );
			$this->custom_sidebar();
			$this->set_elementor_default_options();
			$this->set_woocommerce_default_options();
		}
	}

	public function custom_sidebar() {
		$widget = array (
			'rdtheme-sidebar-woocommerce-sidebar' => array (
				'id' => 'rdtheme-sidebar-woocommerce-sidebar',
				'name' => 'Woocommerce Sidebar',
				'class' => 'rdtheme-custom',
				'description' => '',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget' => '</aside>',
				'before_title' => '<h3 class="widget-title">',
				'after_title' => '</h3>',
			),
		);

		update_option( 'metro_custom_sidebars', $widget );
	}

	public function set_elementor_default_options() {
		$data = array(
			'elementor_disable_typography_schemes' => 'yes',
			'elementor_disable_color_schemes'      => 'yes',
			'elementor_css_print_method'           => 'internal',
			'elementor_cpt_support'                => array( 'page' ),
			'elementor_container_width'            => '1310',
			'elementor_viewport_lg'                => '992',

			'_elementor_general_settings'          => array(
				'default_generic_fonts' => 'Sans-serif',
				'global_image_lightbox' => 'yes',
				'container_width'       => '1310',
			),
			'_elementor_global_css' 	=> array(
				'time'   => '1534145031',
				'fonts'  => array(),
				'status' => 'inline',
				'0'      => false,
				'css'    => '.elementor-section.elementor-section-boxed > .elementor-container{max-width:1310px;}',
			),
		);

		foreach ( $data as $key => $value ) {
			update_option( $key, $value );
		}
	}

	public function set_woocommerce_default_options() {
		update_option( 'woocommerce_single_image_width', '570' ); // 570x653
		update_option( 'woocommerce_thumbnail_image_width', '360' );
		update_option( 'woocommerce_thumbnail_cropping', 'custom' );
		update_option( 'woocommerce_thumbnail_cropping_custom_width', '5' );
		update_option( 'woocommerce_thumbnail_cropping_custom_height', '6' );
	}

	public function woo_product_variation_swatches_pro_init() {
		add_filter( 'rtwpvs_settings_fields', function( $fields ){
			foreach ( $fields['archive']['fields'] as $key => $value ) {
				if ( $value['id'] == 'archive_swatches_image_selector' ) {
					$fields['archive']['fields'][$key]['default'] = '';
				}
				if ( $value['id'] == 'archive_swatches_position' ) {
					$fields['archive']['fields'][$key]['default'] = 'before_title_and_price';
				}
				if ( $value['id'] == 'show_clear_on_archive' ) {
					$fields['archive']['fields'][$key]['default'] = false;
				}
			}

			return $fields;
		} );
	}

	public function woo_product_variation_gallery_pro_init() {
		add_filter( 'rtwpvg_settings_fields', function( $fields ){
			foreach ( $fields['general']['fields'] as $key => $value ) {
				if ( $value['id'] == 'thumbnails_gap' ) {
					$fields['general']['fields'][$key]['default'] = 10;
				}
				if ( $value['id'] == 'gallery_width' ) {
					$fields['general']['fields'][$key]['default'] = 100;
				}
			}

			foreach ( $fields['advanced']['fields'] as $key => $value ) {
				if ( $value['id'] == 'zoom_position' ) {
					$fields['advanced']['fields'][$key]['default'] = 'bottom-right';
				}
			}

			return $fields;
		} );
	}
}

Activation::instance();