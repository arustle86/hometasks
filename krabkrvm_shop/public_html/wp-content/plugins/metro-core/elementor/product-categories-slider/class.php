<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/Product-categories-slider/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class rt_product_categories_slider extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Product Categories Slider', 'metro-core' );
		$this->rt_base = 'rt-product-categories-slider';
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

	
	protected function render() {
		$data = $this->get_settings();
		$this->rt_load_scripts();
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
		$template = 'view';
		return $this->rt_template( $template, $data );
	}
}