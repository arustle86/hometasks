<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Custom_Widget_Init {

	public function __construct() {
		$this->section_water_ripple_effect();

		add_action( 'elementor/widgets/widgets_registered',     array( $this, 'init' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'widget_categoty' ) );
		add_action( 'elementor/editor/after_enqueue_styles',    array( $this, 'editor_style' ) );
	}
	public function section_water_ripple_effect() {
		add_filter( 'elementor/controls/animations/additional_animations', array( $this, 'add_ripple_animation_option' ) );
		add_action( 'elementor/frontend/section/before_render',            array( $this, 'render_ripple' ) );
	}
	public function editor_style() {
		$img = plugins_url( 'icon.png', __FILE__ );
		wp_add_inline_style( 'elementor-editor', '.elementor-element .icon .rdtheme-el-custom{content: url('.$img.');width: 28px;}' );
		wp_add_inline_style( 'elementor-editor', '.select2-container--default .select2-selection--single {min-width: 126px !important; min-height: 30px !important;}' );
	}
	public function add_ripple_animation_option( $args ) {
		$args['Theme'] = array( 'rt-ripple' => 'Water Ripple' );
		return $args;
	}
	public function render_ripple( $obj ) {
		$data = $obj->get_settings();
		if ( $data['animation'] == 'rt-ripple' ) {
			$obj->add_render_attribute( '_wrapper', 'class', 'rt-water-ripple' );
			wp_enqueue_script( 'jquery-ripples' );
		}
	}
	public function init() {
		require_once __DIR__ . '/base.php';

		// Widgets -- dirname=>classname /@dev
		
		$widgets1 = array(			
			'title'             => 'Title',
			'post'              => 'Post',
			'logo-slider'       => 'Logo_Slider',
			'text-with-icon'    => 'Text_With_Icon',
			'text-with-button'  => 'Text_With_Button',
			'banner-with-link'  => 'Banner_With_Link',
			'sale-banner-slider'=> 'Sale_Banner_Slider',
			'info-box'          => 'Info_Box',
			'info-box-2'        => 'Info_Box_2',
			'banner-info-box'   => 'Banner_Info_Box',
			'accordion'         => 'Accordion',
			'button'            => 'Button',
			'vertical-menu'     => 'Vertical_Menu',
			'countdown-1'       => 'Product_Countdown_1',
			'countdown-2'       => 'Product_Countdown_2',
			'countdown-3'       => 'Product_Countdown_3',
			'video'             => 'Video',
			'contact'           		  => 'Contact',
			'google-map'        		  => 'Google_Map',
			'modern-banner-slider'        => 'Modern_Banner_Slider',
		);

		$widgets2 = array();
		if ( class_exists( 'WooCommerce' ) ) {
			$widgets2 = array(
				'product-categories-slider'     => 'rt_product_categories_slider',
				'product-search'          		=> 'Product_Search',
				'product-box'             		=> 'Product_Box',
				'product-list'            		=> 'Product_List',
				'product-grid'            		=> 'Product_Grid',
				'product-slider'          		=> 'Product_Slider',
				'product-carousel'          	=> 'Product_Carousel',
				'product-isotope'         		=> 'Product_Isotope',
				'product-fullscreen-grid' 		=> 'Product_Fullscreen_Grid',
				'product-advanced-grid' 		=> 'Product_Advanced_Grid',
			);
		}

		$widgets = array_merge( $widgets1, $widgets2 );

		foreach ( $widgets as $dirname => $class ) {
			$template_name = '/elementor-custom/' . $dirname . '/class.php';
			if ( file_exists( STYLESHEETPATH . $template_name ) ) {
				$file = STYLESHEETPATH . $template_name;
			}
			elseif ( file_exists( TEMPLATEPATH . $template_name ) ) {
				$file = TEMPLATEPATH . $template_name;
			}
			else {
				$file = __DIR__ . '/' . $dirname . '/class.php';
			}

			require_once $file;
			
			$classname = __NAMESPACE__ . '\\' . $class;
			Plugin::instance()->widgets_manager->register_widget_type( new $classname );
		}
	}

	public function widget_categoty( $class ) {
		$id         = METRO_CORE_THEME_PREFIX . '-widgets'; // Category /@dev
		$properties = array(
			'title' => __( 'RadiusTheme Elements', 'metro-core' ),
		);

		Plugin::$instance->elements_manager->add_category( $id, $properties );
	}
}

new Custom_Widget_Init();