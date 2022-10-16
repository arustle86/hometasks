<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-box/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Product_Box extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Product Box', 'metro-core' );
		$this->rt_base = 'rt-product-box';
		parent::__construct( $data, $args );
	}

	public function rt_fields() {

		$args = array(
			'post_type'           => 'product',
			'posts_per_page'      => -1,
			'post_status'         => 'publish',
			'suppress_filters'    => false,
			'ignore_sticky_posts' => true,
		);
		$products = get_posts( $args );
		$products_dropdown = array();

		foreach ( $products as $product ) {
			$products_dropdown[$product->ID] = $product->post_title;
		}

		$fields = array(
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_general',
				'label'       => __( 'General', 'metro-core' ),
			),
			
			array(
				'type'        => Controls_Manager::SELECT2,
				'id'          => 'p_id',
				'label'       => __( 'Product', 'metro-core' ),
				'options'     => $products_dropdown,
				'default'     => '0',
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
				),
				'default' => '1',
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
				'type'        => Controls_Manager::MEDIA,
				'id'          => 'image',
				'label'       => __( 'Replace Product Image', 'metro-core' ),
			),
			array(
				'mode'     => 'group',
				'type'     => \Elementor\Group_Control_Image_Size::get_type(),
				'id'       => 'thumbnail',
				'label'    => __( 'Product Thumbnail Size', 'metro-core' ),
				'default'  => 'woocommerce_thumbnail',
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
				'mode'        => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'view';

		return $this->rt_template( $template, $data );
	}
}