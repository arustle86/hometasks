<?php
/**
 * This file can be overridden by copying it to yourtheme/elementor-custom/product-search/class.php
 * 
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Metro_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Product_Search extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Product Search', 'metro-core' );
		$this->rt_base = 'rt-product-search';
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
		$fields = array(

			

			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => __( 'General', 'metro-core' ),
			),

			array(
				'type'        => Controls_Manager::SELECT2,
				'id'          => 'style',
				'label'       => __( 'Search Autocomplete', 'metro-core' ),
				'options'     => array(
					'1' => __( 'Style 1', 'metro-core' ),
					'2' => __( 'Style 2 ( Width Image )', 'metro-core' ),				
					
				),
				
				'default' => '1',
			),
			
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'menu_display',
				'label'       => __( 'Vertical Menu Display', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '',
				'condition'   => array( 'style' => '1' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'autocomplete',
				'label'       => __( 'Autocomplete', 'metro-core' ),
				'label_on'    => __( 'On', 'metro-core' ),
				'label_off'   => __( 'Off', 'metro-core' ),
				'default'     => '',
				'condition'   => array( 'style' => '1' ),
			),
			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();
		if ( $data['autocomplete'] ) {
			wp_enqueue_script( 'jquery-ui-autocomplete' );
		}

		if ( $data['style'] == '1') {
		
			if ( $data['menu_display'] ) {
				$template = 'view-2';
			}else {
				$template = 'view';
			}			

		}else {

			$template = 'view-3';

		}

		return $this->rt_template( $template, $data );
	}
}