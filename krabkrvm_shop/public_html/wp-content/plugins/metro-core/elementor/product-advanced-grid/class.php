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

class Product_Advanced_Grid extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Product Advanced Grid', 'metro-core' );
		$this->rt_base = 'rt-product-advanced-grid';
		parent::__construct( $data, $args );
		$this->rt_translate = array(
			'cols'  => array(
				'12' => __( '1 Col', 'classipost-core' ),
				'6'  => __( '2 Col', 'classipost-core' ),
				'4'  => __( '3 Col', 'classipost-core' ),
				'3'  => __( '4 Col', 'classipost-core' ),
				'2'  => __( '6 Col', 'classipost-core' ),
			),
		);
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
				'id'          => 'sec_general_title',
				'label'       => __( 'Section Title', 'metro-core' ),
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
					'type'        => Controls_Manager::TEXT,
					'id'          => 'sub_title',
					'label'       => __( 'Sub Title', 'metro-core' ),
					'default'     => 'Lorem Ipsum',
					'condition'   => array( 'section_title_display' => 'yes' ),
				),
			array(
				'mode'        => 'section_end',
			),



			array(
				'mode'        => 'section_start',
				'id'          => 'sec_general',
				'label'       => __( 'Items Display', 'metro-core' ),
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
					'12' => __( 'Style 12', 'metro-core' ),
					'13' => __( 'Style 13', 'metro-core' ),
					'14' => __( 'Style 14', 'metro-core' ),
				),
				'default' => '7',
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
				'id'          => 'compare',
				'label'       => __( 'compare Swatch Display', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '',
				'description' => __( 'Requires plugin WooCommerce Compare to be active', 'metro-core' ),
			),


			array(
				'mode'        => 'section_end',
			),

			// Product Filtering
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_filter',
				'label'       => __( 'Product Filtering', 'metro-core' ),
				
			),
			array(
				'type'        => Controls_Manager::NUMBER,
				'id'          => 'number',
				'label'       => __( 'Number of Items', 'metro-core' ),
				'default'     => 8,				
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
				'label'   => __( 'Number of Responsive Columns', 'classipost-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_xl',
				'label'   => __( 'Desktops: >1199px', 'classipost-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '3',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_lg',
				'label'   => __( 'Desktops: >991px', 'classipost-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '3',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_md',
				'label'   => __( 'Tablets: >767px', 'classipost-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_sm',
				'label'   => __( 'Phones: >575px', 'classipost-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_mobile',
				'label'   => __( 'Small Phones: <576px', 'classipost-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			),
			array(
				'mode' => 'section_end',
			),


		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();
		$args = $this->rt_build_query_args( $data, $data['number'] );
		$data['query'] = new \WP_Query( $args );
		$template = 'view-1';
	
		return $this->rt_template( $template, $data );
	}
}