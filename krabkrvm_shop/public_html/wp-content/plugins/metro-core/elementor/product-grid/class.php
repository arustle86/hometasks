<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-list/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Product_Grid extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Product Grid', 'metro-core' );
		$this->rt_base = 'rt-product-grid';
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
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'section_title_display',
				'label'       => __( 'Section Title Display', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => 'yes',
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
				'type'        => Controls_Manager::TEXT,
				'id'          => 'title',
				'label'       => __( 'Title', 'metro-core' ),
				'default'     => 'Lorem Ipsum',
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
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'cat_display',
				'label'       => __( 'Category Name Display', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => 'yes',
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'sale_price_only',
				'label'       => __( 'Display only sale price', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '',
			),
			array(
				'mode'        => 'section_end',
			),
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
				'default'     => 3,
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
		);
		return $fields;
	}

	private function rt_build_query( $data ) {

		if ( !$data['custom_id'] ) {

			// Post type
			$number = $data['number'];
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => $number ? $number : 3,
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

		$data['query'] = $this->rt_build_query( $data );

		$template = 'view';

		return $this->rt_template( $template, $data );
	}
}