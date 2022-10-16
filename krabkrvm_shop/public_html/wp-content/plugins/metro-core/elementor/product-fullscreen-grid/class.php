<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-fullscreen-grid/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Product_Fullscreen_Grid extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Product Fullscreen Grid', 'metro-core' );
		$this->rt_base = 'rt-product-fullscreen-grid';
		parent::__construct( $data, $args );
	}

	private function rt_build_items( $data ) {

		if ( !$data['custom_id'] ) {
			$args = $this->rt_build_query_args( $data, 7 );
			$posts = get_posts( $args );
			$items = array_map(function($post){return $post->ID;}, $posts);
		}

		else {
			$items = array_map( 'trim' , explode( ',', $data['product_ids'] ) );
			$items = array_filter( $items ); // remove empty values
			$items = array_values( $items ); // reorder array keys
		}

		return $items;
	}

	private function rt_build_query_args( $data, $number ) {
		// Post type
		$args = array(
			'post_type'           => 'product',
			'posts_per_page'      => $number,
			'post_status'         => 'publish',
			'suppress_filters'    => false,
			'ignore_sticky_posts' => true,
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
				$args['orderby']    = 'menu_order';
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

		return $args;
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
				'id'          => 'layout',
				'label'       => __( 'Layout', 'metro-core' ),
				'options'     => array(
					'1' => __( 'Layout 1', 'metro-core' ),
					'2' => __( 'Layout 2', 'metro-core' ),
					'3' => __( 'Layout 3', 'metro-core' ),
					'4' => __( 'Layout 4', 'metro-core' ),
				),
				'default' => '1',
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
					'10' => __( 'Style 10', 'metro-core' ),
					'11' => __( 'Style 11', 'metro-core' ),
				),
				'default' => '7',
			),
			array(
				'type'        => Controls_Manager::NUMBER,
				'id'          => 'number',
				'label'       => __( 'Number of Items', 'metro-core' ),
				'default'     => 6,
				'condition'   => array( 'layout' => '1' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'custom_id',
				'label'       => __( 'Custom Product ID', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '',
				'condition'   => array( 'layout' => '2' ),
			),
			array(
				'type'        => Controls_Manager::TEXTAREA,
				'id'          => 'product_ids',
				'label'       => __( "Product ID's, seperated by commas", 'metro-core' ),
				'description' => __( "Put the comma seperated product ID's here eg. 23,26,89. Please put the exact 7(seven) ID's, not more/less than that", 'metro-core' ),
				'conditions' => array( 
					'terms' => array(
						array(
							'name' => 'custom_id',
							'operator' => '==',
							'value' => 'yes',
						),
						array(
							'name' => 'layout',
							'operator' => '==',
							'value' => '2',
						),
					),
				),
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
				'id'          => 'cat_display',
				'label'       => __( 'Category Name Display', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '',
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

	protected function render() {
		$data = $this->get_settings();

		if ( $data['layout'] == '2' ) {
			$data['items'] = $this->rt_build_items( $data, 7 );
			$template = 'view-2';
		}
		elseif( $data['layout'] == '3' ) {
			$data['items'] = $this->rt_build_items( $data, 11 );
			$template = 'view-3';
		}
		elseif( $data['layout'] == '4' ) {
			$args = $this->rt_build_query_args( $data, $data['number'] );
			$data['query'] = new \WP_Query( $args );
			$template = 'view-4';
		}
		else {
			$args = $this->rt_build_query_args( $data, $data['number'] );
			$data['query'] = new \WP_Query( $args );
			$template = 'view-1';
		}

		return $this->rt_template( $template, $data );
	}
}