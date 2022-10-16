<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-slider/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Product_Slider extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Product Slider', 'metro-core' );
		$this->rt_base = 'rt-product-slider';
		$this->rt_translate = array(
			'cols'  => array(
				'1' => __( '1 Col', 'metro-core' ),
				'2' => __( '2 Col', 'metro-core' ),
				'3' => __( '3 Col', 'metro-core' ),
				'4' => __( '4 Col', 'metro-core' ),
				'5' => __( '5 Col', 'metro-core' ),
				'6' => __( '6 Col', 'metro-core' ),
			),
		);
		parent::__construct( $data, $args );
	}

	public function rt_fields() {

		$terms             = get_terms( array( 'taxonomy' => 'product_cat' ) );
		$category_dropdown = array( '0' => __( 'All Categories', 'metro-core' ) );

		foreach ( $terms as $category ) {
			$category_dropdown[$category->term_id] = $category->name;
		}

		$fields = array(
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_general',
				'label'       => __( 'General', 'metro-core' ),
			),
			array(
				'type'        => Controls_Manager::SELECT2,
				'id'          => 'style',
				'label'       => __( 'Product Style', 'metro-core' ),
				'options'     => array(
					'1' => __( 'Style 1', 'metro-core' ),
					'2' => __( 'Style 2', 'metro-core' ),
					'3' => __( 'Style 3', 'metro-core' ),
					'4' => __( 'Style 4', 'metro-core' ),
					'5' => __( 'Style 5', 'metro-core' ),
					'6' => __( 'Style 6', 'metro-core' ),
					'7' => __( 'Style 7', 'metro-core' ),
					'8' => __( 'Style 8', 'metro-core' ),
					'9' => __( 'Style 9', 'metro-core' ),
					'10' => __( 'Style 8', 'metro-core' ),
					'11' => __( 'Style 11', 'metro-core' ),
					'12' => __( 'Style 12', 'metro-core' ),
					'13' => __( 'Style 13', 'metro-core' ),
				),
				'default' => '1',
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'section_title_display',
				'label'       => __( 'Section Title Display', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => 'yes',
			),
			array(
				'type'        => Controls_Manager::TEXT,
				'id'          => 'title',
				'label'       => __( 'Title', 'metro-core' ),
				'default'     => 'Lorem Ipsum',
				'condition'   => array( 'section_title_display' => 'yes' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'all_link_display',
				'label'       => __( "View All link Display at Top", 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => 'yes',
				'condition'   => array( 'section_title_display' => 'yes' ),
			),

			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'vswatch_display',
				'label'       => __( 'Variation Swatch Display', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '',
				'description' => __( 'Requires plugin WooCommerce Variation Swatches Pro to be active', 'metro-core' ),
			),

			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'wishlist',
				'label'       => __( 'wishlist Swatch Display', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '',
				'description' => __( 'Requires plugin WooCommerce Variation Swatches Pro to be active', 'metro-core' ),
			),

		array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'quickview',
				'label'       => __( 'Quickview Swatch Display', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '',
				'description' => __( 'Requires plugin WooCommerce Variation Swatches Pro to be active', 'metro-core' ),
			),

			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'cat_display',
				'label'       => __( 'Category Name Display', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => 'yes',
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'rating_display',
				'label'       => __( 'Rating Display', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '',
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'custom_id',
				'label'       => __( 'Custom Product ID', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '',
			),
			array(
				'type'        => Controls_Manager::TEXT,
				'id'          => 'product_ids',
				'label'       => __( "Product ID's, seperated by commas", 'metro-core' ),
				'description' => __( "Put the comma seperated ID's here eg. 23,26,89", 'metro-core' ),
				'condition'   => array( 'custom_id' => 'yes' ),
			),
			array(
				'mode'        => 'section_end',
			),

			// Product Filtering
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_filter',
				'label'       => __( 'Product Filtering', 'metro-core' ),
				'condition'   => array( 'custom_id' => '' ),
			),
			array(
				'type'        => Controls_Manager::NUMBER,
				'id'          => 'number',
				'label'       => __( 'Number of items', 'metro-core' ),
				'default'     => 6,
			),
			array(
				'type'        => Controls_Manager::SELECT2,
				'id'          => 'cat',
				'label'       => __( 'Categories', 'metro-core' ),
				'options'     => $category_dropdown,
				'default'     => '0',
			),
			array(
				'type'        => Controls_Manager::SELECT2,
				'id'          => 'orderby',
				'label'       => __( 'Order By', 'metro-core' ),
				'options'     => array(
					'date'        => __( 'Date (Recents comes first)', 'metro-core' ),
					'title'       => __( 'Title', 'metro-core' ),
					'bestseller'  => __( 'Bestseller', 'metro-core' ),
					'rating'      => __( 'Rating(High-Low)', 'metro-core' ),
					'price_l'     => __( 'Price(Low-High)', 'metro-core' ),
					'price_h'     => __( 'Price(High-Low)', 'metro-core' ),
					'rand'        => __( 'Random(Changes on every page load)', 'metro-core' ),
					'menu_order'  => __( 'Custom Order (Available via Order field inside Page Attributes box)', 'metro-core' ),
				),
				'default'     => 'date',
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'out_stock_hide',
				'label'       => __( 'Hide Out-of-stock Products', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '',
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'featured_only',
				'label'       => __( 'Display only Featured Products', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '',
			),
			array(
				'mode'        => 'section_end',
			),

			// Responsive Columns
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_responsive',
				'label'   => __( 'Number of Responsive Columns', 'metro-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_lg',
				'label'   => __( 'Desktops: > 1199px', 'metro-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_md',
				'label'   => __( 'Desktops: > 991px', 'metro-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_sm',
				'label'   => __( 'Tablets: > 767px', 'metro-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '3',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_xs',
				'label'   => __( 'Phones: < 768px', 'metro-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '2',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_mobile',
				'label'   => __( 'Small Phones: < 480px', 'metro-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '1',
			),
			array(
				'mode'    => 'section_end',
			),

			// Slider options
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_slider',
				'label'       => __( 'Slider Options', 'metro-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_nav',
				'label'       => __( 'Navigation Arrow', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => 'yes',
				'description' => __( 'Enable or disable navigation arrow. Default: On', 'metro-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_dots',
				'label'       => __( 'Navigation Dots', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '',
				'description' => __( 'Enable or disable navigation dots. Default: Off', 'metro-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_autoplay',
				'label'       => __( 'Autoplay', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => 'yes',
				'description' => __( 'Enable or disable autoplay. Default: On', 'metro-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_stop_on_hover',
				'label'       => __( 'Stop on Hover', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => 'yes',
				'description' => __( 'Stop autoplay on mouse hover. Default: On', 'metro-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
			),
			array(
				'type'        => Controls_Manager::SELECT2,
				'id'          => 'slider_interval',
				'label'       => __( 'Autoplay Interval', 'metro-core' ),
				'options'     => array(
					'5000' => __( '5 Seconds', 'metro-core' ),
					'4000' => __( '4 Seconds', 'metro-core' ),
					'3000' => __( '3 Seconds', 'metro-core' ),
					'2000' => __( '2 Seconds', 'metro-core' ),
					'1000' => __( '1 Second',  'metro-core' ),
				),
				'default'     => '5000',
				'description' => __( 'Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds', 'metro-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
			),
			array(
				'type'        => Controls_Manager::NUMBER,
				'id'          => 'slider_autoplay_speed',
				'label'       => __( 'Autoplay Slide Speed', 'metro-core' ),
				'default'     => 200,
				'description' => __( 'Slide speed in milliseconds. Default: 200', 'metro-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_loop',
				'label'       => __( 'Loop', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => 'yes',
				'description' => __( 'Loop to first item. Default: On', 'metro-core' ),
			),
			array(
				'mode'        => 'section_end',
			),
		);
		return $fields;
	}

	private function rt_load_scripts(){
		wp_enqueue_style(  'owl-carousel' );
		wp_enqueue_style(  'owl-theme-default' );
		wp_enqueue_script( 'owl-carousel' );
	}

	private function rt_build_query( $data ) {

		if ( !$data['custom_id'] ) {

			// Post type
			$number = $data['number'];
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => $number ? $number : 6,
				'ignore_sticky_posts' => true,
				'post_status'         => 'publish',
				'suppress_filters'    => false,
			);

			$args['tax_query'] = array();

			// Category
			if ( !empty( $data['cat'] ) ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'product_cat',
					'field'    => 'term_id',
					'terms'    => $data['cat'],
				);
			}

			// Featured only
			if ( $data['featured_only'] ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'product_visibility',
					'field'    => 'slug',
					'terms'    => 'featured',
				);
			}

			// Out-of-stock hide
			if ( $data['out_stock_hide'] ) {
				$args['tax_query'][] = array(
					'taxonomy' => 'product_visibility',
					'field'    => 'slug',
					'terms'    => 'outofstock',
					'operator' => 'NOT IN',
				);
			}

			// Order
			$args['orderby'] = $data['orderby'];
			switch ( $data['orderby'] ) {

				case 'title':
				case 'menu_order':
				$args['order']    = 'ASC';
				break;

				case 'bestseller':
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = 'total_sales';
				break;

				case 'rating':
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = '_wc_average_rating';
				break;

				case 'price_l':
				$args['orderby']  = 'meta_value_num';
				$args['order']    = 'ASC';
				$args['meta_key'] = '_price';
				break;

				case 'price_h':
				$args['orderby']  = 'meta_value_num';
				$args['meta_key'] = '_price';
				break;
			}
		}

		else {

			$posts = array_map( 'trim' , explode( ',', $data['product_ids'] ) );
			$args = array(
				'post_type'      => 'product',
				'ignore_sticky_posts' => true,
				'nopaging'       => true,
				'post__in'       => $posts,
				'orderby'        => 'post__in',
			);
		}

		return new \WP_Query( $args );
	}

	protected function render() {
		$data = $this->get_settings();

		$owl_data = array( 
			'nav'                => $data['slider_nav'] == 'yes' ? true : false,
			'dots'               => $data['slider_dots'] == 'yes' ? true : false,
			'navText'            => array( "<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>" ),
			'autoplay'           => $data['slider_autoplay'] == 'yes' ? true : false,
			'autoplayTimeout'    => $data['slider_interval'],
			'autoplaySpeed'      => $data['slider_autoplay_speed'],
			'autoplayHoverPause' => $data['slider_stop_on_hover'] == 'yes' ? true : false,
			'loop'               => $data['slider_loop'] == 'yes' ? true : false,
			'margin'             => 30,
			'responsive'         => array(
				'0'    => array( 'items' => $data['col_mobile'] ),
				'480'  => array( 'items' => $data['col_xs'] ),
				'768'  => array( 'items' => $data['col_sm'] ),
				'992'  => array( 'items' => $data['col_md'] ),
				'1200' => array( 'items' => $data['col_lg'] ),
			)
		);

		$data['owl_data'] = json_encode( $owl_data );
		$data['query']    = $this->rt_build_query( $data );

		$this->rt_load_scripts();

		$template = 'view';

		return $this->rt_template( $template, $data );
	}
}