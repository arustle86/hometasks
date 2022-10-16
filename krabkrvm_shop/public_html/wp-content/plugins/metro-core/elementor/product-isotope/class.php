<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-isotope/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Product_Isotope extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Product Isotope', 'metro-core' );
		$this->rt_base = 'rt-product-isotope';
		$this->rt_translate = array(
			'cols'  => array(
				'12' => __( '1 Col', 'classipost-core' ),
				'6'  => __( '2 Col', 'classipost-core' ),
				'4'  => __( '3 Col', 'classipost-core' ),
				'3'  => __( '4 Col', 'classipost-core' ),
				'2'  => __( '6 Col', 'classipost-core' ),
			),
		);
		parent::__construct( $data, $args );
	}

	private function rt_cat_dropdown_1() {
		$terms = get_terms( array( 'taxonomy' => 'product_cat' ) );
		$category_dropdown = array( '0' => __( 'All Categories', 'metro-core' ) );

		foreach ( $terms as $category ) {
			$category_dropdown[$category->term_id] = $category->name;
		}

		return $category_dropdown;
	}

	private function rt_cat_dropdown_2() {
		$terms = get_terms( array( 'taxonomy' => 'product_cat', 'parent' => 0, 'hide_empty' => false ) );
		$category_dropdown = array();
		foreach ( $terms as $category ) {
			$category_dropdown[$category->term_id] = $category->name;
		}

		return $category_dropdown;
	}

	public function rt_fields() {
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
					'5' => __( 'Layout 5', 'metro-core' ),
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
					'12' => __( 'Style 12', 'metro-core' ),
				),
				'default' => '1',
			),
			array(
				'type'        => Controls_Manager::SELECT2,
				'id'          => 'navtype',
				'label'       => __( 'Navigation Type', 'metro-core' ),
				'options'     => array(
					'items' => __( 'Selected Items', 'metro-core' ),
					'cats'  => __( 'Selected Categories', 'metro-core' ),
				),
				'default' => 'items',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'navitems',
				'label'   => __( 'Items to Show', 'metro-core' ),
				'options' => array(
					'featured' => __( 'Featured', 'metro-core' ),
					'new'      => __( 'New', 'metro-core' ),
					'popular'  => __( 'Popular', 'metro-core' ),
					'rating'   => __( 'Best Rated', 'metro-core' ),
					'sale'     => __( 'Sale', 'metro-core' ),
				),
				'multiple'  => true,
				'default'   => array( 'featured', 'new', 'popular'),
				'condition' => array( 'navtype' => 'items' ),
			),
			array(
				'type'        => Controls_Manager::SELECT2,
				'id'          => 'navcats',
				'label'       => __( 'Categories to Show', 'metro-core' ),
				'options'     => $this->rt_cat_dropdown_2(),
				'multiple'    => true,
				'description' => __( 'If empty then all categories will be displayed', 'metro-core' ),
				'condition'   => array( 'navtype' => 'cats' ),
			),
			array(
				'type'        => Controls_Manager::SELECT2,
				'id'          => 'cat',
				'label'       => __( 'Category', 'metro-core' ),
				'options'     => $this->rt_cat_dropdown_1(),
				'default'     => '0',
				'condition'   => array( 'navtype' => 'items' ),
			),
			array(
				'type'        => Controls_Manager::NUMBER,
				'id'          => 'number',
				'label'       => __( 'Number of Products/Per Item', 'metro-core' ),
				'default'     => 4,
				'condition'   => array( 'navtype' => 'items' ),
				//'mode' 		  => 'responsive',
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
				'id'          => 'vswatch_display',
				'label'       => __( 'Variation Swatch Display', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '',
				'description' => __( 'Requires plugin WooCommerce Variation Swatches Pro to be active', 'metro-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'all_link_display',
				'label'       => __( "View All link Display", 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '',
			),
			array(
				'type'        => Controls_Manager::TEXT,
				'id'          => 'all_link_text',
				'label'       => __( "View All link Text", 'metro-core' ),
				'default'     => __( 'View All', 'metro-core' ),
				'condition'   => array( 'all_link_display' => 'yes' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'allfilter_display',
				'label'       => __( 'Filter- ALL Button Display', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '1',
				
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

	private function rt_load_scripts(){
		wp_enqueue_script( 'images-loaded' );
		wp_enqueue_script( 'isotope' );
	}

	private function rt_isotope_item_navigation( $data ) {
		$navs = array(
			'featured' => __( 'Featured', 'metro-core' ),
			'new'      => __( 'New', 'metro-core' ),
			'popular'  => __( 'Popular', 'metro-core' ),
			'sale'     => __( 'Sale', 'metro-core' ),
			'rating'   => __( 'Best Rated', 'metro-core' ),
		);

		$navs = apply_filters( 'metro_isotope_item_navigations', $navs );

		foreach ( $navs as $key => $value ) {
			if ( !in_array( $key , $data['navitems'] ) ) {
				unset($navs[$key]);
			}
		}

		return $navs;
	}

	private function rt_isotope_item_query( $data ) {

		$result = array();

		// Post type
		$args = array(
			'post_type' => array('product', 'product_variation'),
			'ignore_sticky_posts' => true,
			'post_status'         => 'publish',
			'suppress_filters'    => false,
			'posts_per_page'      => $data['number'],
		);

		// Category
		if ( !empty( $data['cat'] ) ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $data['cat'],
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

		$args2 = array();
		
		if ( in_array( 'new' , $data['navitems'] ) ) {
			$result['new'] = new \WP_Query( $args );
		}

		if ( in_array( 'featured' , $data['navitems'] ) ) {
			$args2['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'slug',
				'terms'    => 'featured',
			);
			$result['featured'] = new \WP_Query( $args + $args2 );
			$args2 = array();
		}

		if ( in_array( 'popular' , $data['navitems'] ) ) {
			$args2['meta_key'] = 'total_sales';
			$args2['orderby']  = 'meta_value_num';
			$args2['order']    = 'DSC';
			$result['popular'] = new \WP_Query( $args + $args2 );
			$args2 = array();
		}

		if ( in_array( 'rating' , $data['navitems'] ) ) {
			$args2['meta_key'] = '_wc_average_rating';
			$args2['orderby']  = 'meta_value_num';
			$args2['order']    = 'DSC';
			$result['rating']  = new \WP_Query( $args + $args2 );
			$args2 = array();
		}
		if ( in_array( 'sale' , $data['navitems'] ) ) {
			$args2['meta_query'][] = array(
				'key'     => '_sale_price',
				'compare' => '!=',
				'value'   => ''
			);
			$result['sale'] = new \WP_Query( $args + $args2 );
			$args2 = array();
		}


		return $result;
	}

	private function rt_isotope_cats_navigation( $data ) {
		$category_dropdown = array();
		if ( $data['navcats'] ) {
			$terms = get_terms( array( 'taxonomy' => 'product_cat', 'include' => $data['navcats'], 'orderby'  => 'include' ) );
		}
		else {
			$terms = get_terms( array( 'taxonomy' => 'product_cat', 'parent' => 0 ) );
		}

		foreach ( $terms as $term ) {
			$category_dropdown[$term->slug] = $term->name;
		}

		return $category_dropdown;	
	}

	private function rt_isotope_cats_item_query( $data ) {
		// Post type
		$args = array(
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => -1,
		);

		// Out-of-stock hide
		if ( $data['out_stock_hide'] ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'slug',
				'terms'    => 'outofstock',
				'operator' => 'NOT IN',
			);
		}

		if ( $data['navcats'] ) {
			$args['tax_query'][] = array(
				'taxonomy' => 'product_cat',
				'field'    => 'term_id',
				'terms'    => $data['navcats'],
			);	
		}

		return new \WP_Query( $args );
	}

	protected function render() {
		$data = $this->get_settings();
		$this->rt_load_scripts();

		if ( $data['layout'] == '5' ) {
			if ( $data['navtype'] == 'cats' ) {
				$data['navs']  = $this->rt_isotope_cats_navigation( $data );
				$data['query'] = $this->rt_isotope_cats_item_query( $data );
				$template = 'view-5';
			}
			else {
				$data['navs']    = $this->rt_isotope_item_navigation( $data );
				$data['queries'] = $this->rt_isotope_item_query( $data );
				$template = 'view-4';
			}

		}elseif ( $data['layout'] == '4' ) {
			$data['navs']  = $this->rt_isotope_cats_navigation( $data );
			$data['query'] = $this->rt_isotope_cats_item_query( $data );
			$template = 'view-3';
		}else{
			if ( $data['navtype'] == 'cats' ) {
				$data['navs']  = $this->rt_isotope_cats_navigation( $data );
				$data['query'] = $this->rt_isotope_cats_item_query( $data );
				$template = 'view-2';
			}
			else {
				$data['navs']    = $this->rt_isotope_item_navigation( $data );
				$data['queries'] = $this->rt_isotope_item_query( $data );
				$template = 'view-1';
			}
		}
		return $this->rt_template( $template, $data );
	}
}