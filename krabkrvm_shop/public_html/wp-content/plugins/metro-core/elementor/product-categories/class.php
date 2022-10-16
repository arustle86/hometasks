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

class rt_product_categories extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Product Categories', 'metro-core' );
		$this->rt_base = 'rt-product-categories';
		$this->rt_translate = array(
			'cols'  => array(
				'12' =>esc_html__( '1 Col', 'medilink-core' ),
				'6'  =>esc_html__( '2 Col', 'medilink-core' ),
				'4'  =>esc_html__( '3 Col', 'medilink-core' ),
				'3'  =>esc_html__( '4 Col', 'medilink-core' ),
				'2'  =>esc_html__( '6 Col', 'medilink-core' ),
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
				'id'          => 'category_layout',
				'label'       => __( 'Category layout Style', 'metro-core' ),
				'options'     => array(
					'1' => __( 'Style 1', 'metro-core' ),
					'2' => __( 'Style 2', 'metro-core' ),
					'3' => __( 'Style 3', 'metro-core' ),
													
				),
				'default' => '1',
			),

			array(
				'type'        => Controls_Manager::SELECT2,
				'id'          => 'select_categories',
				'label'       => __( 'Select Categories', 'metro-core' ),
				'options'     => $category_dropdown,
				'default'     => '0',
				'multiple' => true,
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'cat_image_show',
				'label'       => __( 'Image Show', 'metro-core' ),
				'label_on'    => __( 'Yes', 'metro-core' ),
				'label_off'   => __( 'No', 'metro-core' ),
				'default'     => 'yes',
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'hide_empty_category',
				'label'       => __( 'Hide Empty Category', 'metro-core' ),
				'label_on'    => __( 'Yes', 'metro-core' ),
				'label_off'   => __( 'No', 'metro-core' ),
				'default'     => 'yes',
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'product_count',
				'label'       => __( 'Product Count Show', 'metro-core' ),
				'label_on'    => __( 'Yes', 'metro-core' ),
				'label_off'   => __( 'No', 'metro-core' ),
				'default'     => 'yes',
			),

			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'show_description',
				'label'       => __( 'Show Description', 'metro-core' ),
				'label_on'    => __( 'Yes', 'metro-core' ),
				'label_off'   => __( 'No', 'metro-core' ),
				'default'     => 'yes',
			),

	

			array(
				'type'        => Controls_Manager::TEXT,
				'id'          => 'product_text',
				'label'       => __( 'Product Text', 'metro-core' ),
				'default'     => 'Products',
			),			
			array(
				'type'        => Controls_Manager::NUMBER,
				'id'          => 'number',
				'label'       => __( 'Number of items', 'metro-core' ),
				'default'     => 12,
			),			
			array(
				'type'        => Controls_Manager::TEXT,
				'id'          => 'button_text',
				'label'       => __( 'Button Text', 'metro-core' ),
				'default'     => 'Shop Now',
			),		



			array(
				'mode'        => 'section_end',
			),

			// Responsive Columns
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_responsive',
				'label'   => esc_html__( 'Number of Responsive Columns', 'roofix-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_lg',
				'label'   => esc_html__( 'Desktops: > 1199px', 'roofix-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_md',
				'label'   => esc_html__( 'Desktops: > 991px', 'roofix-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_sm',
				'label'   => esc_html__( 'Tablets: > 767px', 'roofix-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_xs',
				'label'   => esc_html__( 'Phones: < 768px', 'roofix-core' ),
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
		$template = 'view';
		return $this->rt_template( $template, $data );
	}
}